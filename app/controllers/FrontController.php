<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use System\Session;
use Cms\models\Menu;

class FrontController extends ApplicationController
{
    /**
     * Auth\models\User
     */
    public $current_user = null;

    public function __construct($request)
    {
        parent::__construct($request);

        // Get the current connected user
        $this->current_user = Session::get('current_user');

        // Set menu
        $this->menu = Menu::findAllWithChildren();
    }
}
