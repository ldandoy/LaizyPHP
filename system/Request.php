<?php

namespace system;

class Request
{
    public $url;
    public $params;

    public function __construct()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $this->url = $_SERVER['PATH_INFO'];
            
            # Ici on regarde si on a bien au moins un controller et une action
            if (count(array_filter(explode('/', $this->url), function ($v) {
                return ($v == null) ? false : true;
            })) < 2) {
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
