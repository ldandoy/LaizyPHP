<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;

class DefaultsController extends CockpitController
{
    public function indexAction()
    {
        $this->render('index');
    }
}
