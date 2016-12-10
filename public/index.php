<?php

    # On charge les constantes gobales
    # On charge la configuration du site (config.ini)
    # On charge les fichiers dont on a besoin (autoload)
    # On fait la connexion à la bdd (database.php)

    # On charge les classes de models (model.php / article.php)

    $debut = microtime(true);

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT_DIR', dirname(dirname(__File__)));
    define('CONFIG_DIR', ROOT_DIR.DS."config");
    define('SYSTEM_DIR', ROOT_DIR.DS."system");
    define('APP_DIR', ROOT_DIR.DS."app");
    define('MODEL_DIR', APP_DIR.DS."models");
    define('CONTROLLER_DIR', APP_DIR.DS."controllers");
    define('VIEW_DIR', APP_DIR.DS."views");
    define('PUBLIC_DIR', ROOT_DIR.DS."public");
    define('CSS_DIR', PUBLIC_DIR.DS."assets".DS."css");
    define('JS_DIR', PUBLIC_DIR.DS."assets".DS."js");

    require SYSTEM_DIR.DS.'autoload.php';

    use system\Dispatcher;

    new Dispatcher();

    echo '<div class="infos">Page généré en '.(round(microtime(true) - $debut, 5)*100). " en ms.</div>";
