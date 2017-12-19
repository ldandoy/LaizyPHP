<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use Core\Session;
use Cms\models\Menu;
use Cms\models\MenuItem;

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
        $this->current_user = $this->session->get('current_user');

        $this->mainMenu = null;
        if ($this->site !== null) {
            // Set Main menu
            $menus = Menu::findAll('position = \'main\' AND site_id = '.$this->site->id);
            if (!empty($menus)) {
                $this->mainMenu = $menus[0];
            }
        }
    }
}
