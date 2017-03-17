<?php

namespace app\controllers;

use Auth\AuthController;
use System\Session;

class ApplicationController extends AuthController
{
    public $user = null;

    public function __construct($request)
    {
        parent::__construct($request);

        $this->usersTable = 'users';
        $this->loginPage = 'user_login';
        $this->loginPageTitle = 'Connexion à votre compte';
        $this->afterLoginPage = '';
    }
}
