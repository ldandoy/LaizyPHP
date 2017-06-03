<?php

namespace app\controllers\cockpit;

use app\controllers\ApplicationController;

class CockpitController extends ApplicationController
{
    /**
     * Auth\models\Administrator
     */
    public $current_administrator = null;

    public function __construct($request)
    {
        parent::__construct($request);

        // Check if an administrator is connected
        $this->current_administrator = $this->session['current_administrator'];
        if ($this->current_administrator === null) {
            $this->redirect('cockpit_administratorsauth_login');
        }
    }
}
