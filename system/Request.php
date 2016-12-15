<?php
/**
 * File system\Request.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class gérant les requètes arrivant au serveur
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Request
{
    public $url;
    public $params;

    /**
     * Constructeur
     *
     * Dans cette fonction on récupére l'url et on en génère une url correction
     * avec le prefix, le controller et l'action
     *
     * @return void
     */
    public function __construct()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $this->url = $_SERVER['PATH_INFO'];
            
            /* Ici on regarde si on a bien au moins un controller et une action */
            if (count(array_filter(explode('/', $this->url), 'fillarray')) < 2) {
                if ($this->url == '/cockpit/') {
                    $this->url = str_replace('//', '/', $this->url."/pages/index");
                } else {
                    $this->url = str_replace('//', '/', $this->url."/index");
                }
            }
        } else {
            $this->url = '/'.Config::getValueG('controller').'/'.Config::getValueG('action');
        }

        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $this->params[$k] = $v;
            }
        }
    }
}
