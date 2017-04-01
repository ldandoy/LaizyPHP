<?php

namespace app\controllers\cockpit;

use app\controllers\ApplicationController;
use System\Session;
use System\Email;

class CockpitController extends ApplicationController
{
    public function __construct($request)
    {
        parent::__construct($request);

        // checked if the current_administrator is set
        $this->current_administrator = null;
        if (!Session::isConnected('current_administrator')) {
            $this->redirect('cockpit_administratorsauth_login');
        } else {
            $this->current_administrator = Session::get('current_administrator');
        }
    }
}
