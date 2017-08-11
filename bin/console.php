<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__File__)));

require_once ROOT_DIR.DS.'config'.DS.'config.php';

$action = isset($argv[1]) ? strtolower($argv[1]) : '';
$object = isset($argv[2]) ? strtolower($argv[2]) : '';
$name = isset($argv[3]) ? strtolower($argv[3]) : '';

if (count($argv) > 4) {
    $params = parseParams(array_slice($argv, 4));
} else {
    $params = array();
}

_log();
_log(str_pad('| LazyPHP console |', 80, '=', STR_PAD_BOTH));
_log();

try {
    switch ($action) {
        case 'generate':
        case 'g':
            switch ($object) {
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

                case 'link':
                case 'l':
                    generateSymlink();
                    break;
                
                default:
                    throw new Exception('Unknown object "'.$object.'" : php bin/console.php generate <object> <name>[ <options>]]');
                    break;
            }
            break;

        case 'delete':
        case 'd':
            switch ($object) {
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
                    throw new Exception('Unknown object "'.$object.'" : php bin/console.php delete <object> <name>[ <options>]]');
                    break;
            }
            break;
        
        case 'db_migrate':
            dbMigrate();
            break;

        default:
            throw new Exception('Unknown action "'.$action.'" : php bin/console.php <action>[ <object> <name>[ <options>]]');
            break;
    }
} catch (Exception $e) {
    _log('ERROR : '.$e->getMessage());
}

_log();
_log(str_pad('| END |', 80, '=', STR_PAD_BOTH));
_log();

function _log($str = '')
{
    echo $str.LF;
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
            if (strpos($p, ':') === false) {
                $p .= ':string';
            }
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

function generateController($name, $params)
{
    if ($name != '') {
        $controllerName = plural(ucfirst($name));
        $modelName = ucfirst($name);
        $viewName = plural($name);

        if (in_array('cockpit', $params['options'])) {
            $cockpitDir = '/cockpit';
            $namespace = 'app\controllers\cockpit';
            $usedParentControllerClass = 'app\controllers\cockpit\CockpitController';
            $parentControllerClass = 'CockpitController';
        } else {
            $cockpitDir = '';
            $namespace = 'app\controllers';
            $usedParentControllerClass = 'app\controllers\FrontController';
            $parentControllerClass = 'FrontController';
        }

        _log('=> Generate controller : '.$controllerName);

        $content = file_get_contents(ROOT_DIR.'/bin/tpl/controller.tpl');
        $content = str_replace(
            array(
                '{{namespace}}',
                '{{usedParentControllerClass}}',
                '{{controllerName}}',
                '{{parentControllerClass}}'
            ),
            array(
                $namespace,
                $usedParentControllerClass,
                $controllerName,
                $parentControllerClass
            ),
            $content
        );

        $file = ROOT_DIR.'/app/controllers'.$cockpitDir.'/'.$controllerName.'Controller.php';
        writeFile($file, $content);
        _log('    -> /app/controllers'.$cockpitDir.'/'.$controllerName.'Controller.php');
    }
}

function generateModel($name, $params)
{
    if ($name != '') {
        $modelName = ucfirst($name);

        _log('=> Generate model : '.$modelName);

        $permittedColumns = '';
        $validations = '';
        foreach ($params['columns'] as $c) {
            $c = explode(':', $c);
            if (!isset($c[1])) {
                $c[1] = 'string';
            }

            $permittedColumns .= str_repeat('    ', 2).'\''.$c[0].'\','.LF;

            $validations .=
                str_repeat('    ', 4).'\''.$c[0].'\' => array('.LF.
                    str_repeat('    ', 5).'\'type\' => \'required\','.LF.
                    str_repeat('    ', 5).'\'error\' => \''.$c[0].' obligatoire\''.LF.
                str_repeat('    ', 4).'),'.LF;
        }

        $permittedColumns = trim($permittedColumns);
        $validations = trim($validations);

        $content = file_get_contents(ROOT_DIR.'/bin/tpl/model.tpl');
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

        $file = ROOT_DIR.'/app/models/'.$modelName.'.php';
        writeFile($file, $content);
        _log('    -> /app/models/'.$modelName.'.php');

        $table = plural($name);
        $sql = generateCreateTable($table, $params['columns']);
        $migrationId = date('YmdHis');
        $file = ROOT_DIR.'/sql/migrations/'.$migrationId.'_create_'.$table.'.sql';
        writeFile($file, $sql);
        _log('    -> migration, create table "'.$table.'" : /sql/migrations/'.$migrationId.'_create_'.$table.'.sql');
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

        _log('=> Generate view : '.$viewName);

        $content = file_get_contents(ROOT_DIR.'/bin/tpl/view_index.tpl');
        $content = str_replace(
            array(
            ),
            array(
            ),
            $content
        );

        $file = ROOT_DIR.'/app/views'.$cockpitDir.'/'.$viewName.'/index.php';
        writeFile($file, $content);
        _log('    -> /app/views'.$cockpitDir.'/'.$viewName.'/index.php');

        $content = file_get_contents(ROOT_DIR.'/bin/tpl/view_edit.tpl');
        $content = str_replace(
            array(
            ),
            array(
            ),
            $content
        );

        $file = ROOT_DIR.'/app/views'.$cockpitDir.'/'.$viewName.'/edit.php';
        writeFile($file, $content);
        _log('    -> /app/views'.$cockpitDir.'/'.$viewName.'/edit.php');
    }
}

function generateCreateTable($table, $columns)
{
    $sql =
        'CREATE TABLE `'.$table.'` ('.LF.
        '    `id` int(11) NOT NULL AUTO_INCREMENT,'.LF;

    foreach ($columns as $column) {
        $c = explode(':', $column);

        $name = strtolower($c[0]);

        switch ($c[1]) {
            case 'string':
                $dateType = 'varchar(255)';
                break;

            case 'text':
                $dateType = 'text';
                break;

            case 'int':
            case 'integer':
            case 'bool':
            case 'boolean':
                $dateType = 'int';
                break;

            case 'float':
                $dateType = 'float';
                break;

            case 'currency':
                $dateType = 'decimal(19,4)';
                break;

            case 'datetime':
                $dateType = 'datetime';
                break;

            case 'date':
                $dateType = 'date';
                break;

            case 'time':
                $dateType = 'time';
                break;

            default:
                $dateType = strtoupper($c[1]);
                break;
        }

        switch ($c[1]) {
            case 'boolean':
                $notNull = ' NOT NULL';
                $default = ' DEFAULT 1';
                break;
            
            default:
                $notNull = '';
                $default = '';
                break;
        }

        $sql .=
            '    `'.$name.'` '.$dateType.$notNull.$default.','.LF;
    }

    $sql .=
        '    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,'.LF.
        '    `updated_at` datetime,'.LF.
        '    PRIMARY KEY (`id`)'.LF.
        ') ENGINE=InnoDB;'.LF;

    return $sql;
}

function dbMigrate()
{
    _log('=> Execute migrations');

    try {
        $db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
        $res = $db->query('select max(id) lastMigration from migrations');
        if ($res !== false) {
            $res = $res->fetchAll(PDO::FETCH_OBJ);
            $lastMigration = $res[0]->lastMigration;

            $dir = ROOT_DIR.'/sql/migrations';

            $files = array();
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $migrationId = substr($file, 0, strpos($file, '_'));
                        if ($lastMigration === null || $migrationId > $lastMigration) {
                            $files[$migrationId] = $file;
                        }
                    }
                }
                closedir($dh);
            }
            ksort($files);

            foreach ($files as $migrationId => $file) {
                $sql = file_get_contents($dir.'/'.$file);
                $res = $db->exec($sql);
                if ($res === false) {
                    $errorInfo = $db->errorInfo();
                    throw new Exception($errorInfo[2]);
                } else {
                    $res = $db->exec('insert into migrations(id) values('.$migrationId.')');
                    _log('    -> '.$file);
                }
            }
        } else {
            $errorInfo = $db->errorInfo();
            throw new Exception($errorInfo[2]);
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function generateSymlink()
{
    if (!is_link("public/assets/auth")) {
        symlink("vendor/overconsulting/lazyphp-auth/Auth/assets", "public/assets/auth");
    }
    if (!is_link("public/assets/catalog")) {
        symlink("vendor/overconsulting/lazyphp-catalog/Catalog/assets", "public/assets/catalog");
    }
    if (!is_link("public/assets/cms")) {
        symlink("../../vendor/overconsulting/lazyphp-cms/Cms/assets", "public/assets/cms");
    }
    if (!is_link("public/assets/helper")) {
        symlink("vendor/overconsulting/lazyphp-helper/Helper/assets", "public/assets/helper");
    }
    if (!is_link("public/assets/media")) {
        symlink("vendor/overconsulting/lazyphp-media/Media/assets", "public/assets/media");
    }
    if (!is_link("public/assets/widget")) {
        symlink("vendor/overconsulting/lazyphp-widget/Widget/assets", "public/assets/widget");
    }
}
