<?php

namespace app\controllers\cockpit;

use app\controllers\ApplicationController;

class DefaultsController extends ApplicationController
{
    public function indexAction()
    {
        $this->render('index');
    }
}
