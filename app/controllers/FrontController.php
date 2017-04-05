<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use System\Session;
use Cms\models\Menu;

class FrontController extends ApplicationController
{
    public function __construct($request)
    {
        parent::__construct($request);

        // checked if the current_user is set
        $this->current_user = null;
        if (Session::isConnected('current_user')) {
            $this->current_user = Session::get('current_user');
        }

        // Set menu
        $this->menu = Menu::findAllWithChildren();
    }
}
