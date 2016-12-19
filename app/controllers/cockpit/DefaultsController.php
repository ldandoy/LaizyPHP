<?php

namespace app\controllers\cockpit;

use system\Controller;

class DefaultsController extends Controller
{
    public function indexAction()
    {
        $this->render('index');
    }
}
