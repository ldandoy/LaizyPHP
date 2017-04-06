<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$action = isset($argv[1]) ? strtolower($argv[1]) : '';
$type = isset($argv[2]) ? strtolower($argv[2]) : '';
$name = isset($argv[3]) ? strtolower($argv[3]) : '';

if (count($argv) > 4) {
    $params = parseParams(array_slice($argv, 4));
} else {
    $params = array();
}

echo "\n".str_pad('| LazyPHP console |', 80, '=', STR_PAD_BOTH)."\n\n";

switch ($action) {
    case 'generate':
    case 'g':
        switch ($type) {
            case 'controller':
            case 'c':
                generateController($name, $params);
                break;

            case 'model':
            case 'm':
                generateModel($name, $params);
                break;

            case 'view':
            case 'v':
                generateView($name, $params);
                break;

            case 'mvc':
                generateController($name, $params);
                generateModel($name, $params);
                generateView($name, $params);
                break;
            
            default:
                echo "Erreur de commande: php bin/console.php <action> <object> <name> [<options>]\n";
                break;
        }
        break;

    case 'delete':
    case 'd':
        switch ($type) {
            case 'controller':
            case 'c':
                //deleteController($name);
                break;

            case 'model':
            case 'm':
                //deleteModel($name);
                break;

            case 'view':
            case 'v':
                //deleteView($name);
                break;

            default:
                echo "Erreur de commande: php bin/console.php <action> <object> <name> [<options>]\n";
                break;
        }
        break;
    
    default:
        echo "Erreur de commande: php bin/console.php <action> <object> <name> [<options>]\n";
        break;
}

echo "\n".str_pad('| END |', 80, '=', STR_PAD_BOTH)."\n\n";

function generateController($name, $params)
{
    if ($name != '') {
        $controllerName = plural(ucfirst($name));
        $modelName = ucfirst($name);
        $viewName = plural($name);

        if (in_array('cockpit', $params['options'])) {
            $cockpitDir = '/cockpit';
        } else {
            $cockpitDir = '';
        }

        echo '=> Generate controller : '.$controllerName."\n";

        $content = file_get_contents(ROOT.'/bin/tpl/controller.tpl');
        $content = str_replace(
            array(
                '{{controllerName}}'
            ),
            array(
                $controllerName
            ),
            $content
        );

        $file = ROOT.'/app/controllers/'.$controllerName.'Controller.php';
        writeFile($file, $content);
        echo '    -> /app/controllers/'.$controllerName.'Controller.php'."\n";
    }
}

function generateModel($name, $params)
{
    if ($name != '') {
        $modelName = ucfirst($name);

        echo '=> Generate model : '.$modelName."\n";

        $permittedColumns = '';
        $validations = '';
        foreach ($params['columns'] as $c) {
            $c = explode(':', $c);
            $permittedColumns .= str_repeat('    ', 2).'\''.$c.'\','."\n";

            $validations .=
                str_repeat('    ', 4).'\''.$c[0].'\' => array('."\n".
                    str_repeat('    ', 5).'\'type\' => \'required\','."\n".
                    str_repeat('    ', 5).'\'error\' => \''.$c[0].' obligatoire\''."\n".
                str_repeat('    ', 4).'),'."\n";
        }
        $permittedColumns = trim($permittedColumns);
        $validations = trim($validations);

        $content = file_get_contents(ROOT.'/bin/tpl/model.tpl');
        $content = str_replace(
            array(
                '{{modelName}}',
                '{{permittedColumns}}',
                '{{validations}}'
            ),
            array(
                $modelName,
                $permittedColumns,
                $validations
            ),
            $content
        );

        $file = ROOT.'/app/models/'.$modelName.'.php';
        writeFile($file, $content);
        echo '    -> /app/models/'.$modelName.'.php'."\n";
    }
}

function generateView($name, $params)
{
    if ($name != '') {
        $viewName = plural($name);

        if (in_array('cockpit', $params['options'])) {
            $cockpitDir = '/cockpit';
        } else {
            $cockpitDir = '';
        }

        echo '=> Generate view : '.$viewName."\n";

        $content = file_get_contents(ROOT.'/bin/tpl/view_index.tpl');
        $content = str_replace(
            array(
            ),
            array(
            ),
            $content
        );

        $file = ROOT.'/app/views'.$cockpitDir.'/'.$viewName.'/index.php';
        writeFile($file, $content);
        echo '    -> /app/views'.$cockpitDir.'/'.$viewName.'/index.php'."\n";
    }
}

function parseParams($params)
{
    $res = array(
        'options' => array(),
        'columns' => array()
    );

    while (count($params) > 0) {
        $p = array_shift($params);
        if (strpos($p, '-') !== false) {
            $p = ltrim($p, '-');
            $res['options'][] = $p;
        } else {
            $res['columns'][] = $p;
        }
    }

    return $res;
}

function plural($name)
{
    $specialPlurals = array(
        'category' => 'categories',
        'gallery' => 'galleries'
    );

    if (isset($specialPlurals[$name])) {
        return $specialPlurals[$name];
    } else {
        return $name.'s';
    }
}

function writeFile($file, $content)
{
    $dir = dirname($file);
    if (!file_exists($dir)) {
        mkdir($dir);
    }
    file_put_contents($file, $content);
}
