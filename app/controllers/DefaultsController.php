<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use Auth\controllers\AuthController;
use System\Session;

class DefaultsController extends ApplicationController
{
    public function before()
    {
        /*if (!AuthController::isConnected('user')) {
            $this->redirect('/auth/auth/login');
        } else {
            $this->ConnectedUser = Session::get('connectedUser');
        }*/
    }

    public function indexAction()
    {
        $this->render('index');
    }
}
