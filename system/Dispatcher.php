<?php
/**
 * File system\Dispatcher.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

use app\controllers\articlesController;

/**
 * Class qui appel le bon controller en fonction de la bonne url.
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Dispatcher
{
    public $request;

    public function __construct()
    {
        $this->request = new Request();
        Router::parse($this->request);
        $this->checkUrl();
        $controller = $this->loadController();
        if (!in_array($this->request->action."Action", get_class_methods($controller))) {
            $this->error("Erreur d'action", "Le controller ".$this->request->controller. ' n\'a pas de fonction '.$this->request->action."Action");
        }
        call_user_func_array(array($controller, $this->request->action."Action"), $this->request->params);
    }

    public function checkUrl()
    {
        if (!isset($this->request->controller)) {
            $this->error("Erreur de crontroller", "Vous n'avez pas spécifié de controller, ou il n'est pas valide.");
        } 

        if (!isset($this->request->action)) {
            $this->error("Erreur d'action", "Vous n'avez pas spécifié d'action ou elle n'est pas valide.");
        }
    }

    public function error($titre, $message)
    {
        $controller = new Controller($this->request);
        $controller->Session = new Session();
        $controller->e404($titre, $message);
    }

    public function loadController()
    {
        if (is_file(CONTROLLER_DIR.DS.$this->request->controller.'Controller.php')) {
            $name = '\app\\controllers\\'.str_replace('/', '\\', $this->request->controller)."Controller";
            if (class_exists($name)) {
                $controller = new $name($this->request);
                $controller->Session = new Session();
                $controller->Form = new Form($controller);
                return $controller;
            } else {
                $this->error("Erreur de crontroller", 'Le controller '.$name.' n\'existe pas.');
            }
        } else {
            $this->error("Erreur de crontroller", 'Le fichier '.CONTROLLER_DIR.DS.$this->request->controller.'Controller.php n\'existe pas.');
        }
    }
}
