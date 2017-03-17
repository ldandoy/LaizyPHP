<?php

namespace app\controllers\cockpit;

use \system\AuthController;
use \system\Session;
use \system\Email;

class CockpitController extends AuthController
{
    public function __construct($request)
    {
        parent::__construct($request);

        $this->usersTable = 'administrators';
        $this->loginPage = 'cockpit_administrators_login';
        $this->loginLayout = 'cockpit'.DS.'login';
        $this->loginPageTitle = 'Connexion au Cockpit';
        $this->afterLoginPage = 'cockpit';

        if (!$this->isConnected()) {
            //$this->redirect($this->loginPage);
        }
    }
}
