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
            if (count(array_filter(explode('/', $this->url), function($v) {return ($v == null) ? true : false; })) <= 2) {
                $this->url = str_replace('//', '/', $this->url."/index");
            }
        } else {
            $this->url = '/'.Config::getValueG('controller').'/'.Config::getValueG('action');
        }

        if (!empty($_POST)) {
            $this->params = new \stdClass();
            foreach ($_POST as $k => $v) {
                $this->params->$k = $v;
            }
        }
    }
}
