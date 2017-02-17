<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use app\models\Article;

class DefaultsController extends ApplicationController
{
    public function indexAction()
    {
        $this->render('index');
    }
}
