<?php

namespace app\controllers;

use app\controllers\FrontController;

class DefaultsController extends FrontController
{
    public function indexAction()
    {
        $this->render('index');
    }
}
