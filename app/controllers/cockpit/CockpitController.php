<?php

namespace app\controllers\cockpit;

use \system\Controller;
use \system\Session;

class CockpitController extends Controller
{
    public $connectedAdministrator = null;

    public function __construct($request)
    {
        parent::__construct($request);

        $this->connectedAdministrator = Session::get('connectedAdministrator');

        if ($this->connectedAdministrator === null) {
            $this->redirect('cockpit_administrators_login');
        }
    }
}
