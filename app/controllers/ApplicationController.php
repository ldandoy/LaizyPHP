<?php

namespace app\controllers;

use System\Controller;
use System\Session;
use Auth\controllers\AuthController;

class ApplicationController extends Controller
{
    // public $user = null;
    

    public function __construct($request)
    {
        parent::__construct($request);

        /*$this->usersTable = 'users';
        $this->loginPage = 'user_login';
        $this->loginPageTitle = 'Connexion à votre compte';
        $this->afterLoginPage = '';*/
    }
}
