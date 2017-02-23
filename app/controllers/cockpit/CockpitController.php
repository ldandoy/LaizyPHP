<?php

namespace app\controllers\cockpit;

use \system\Session;
use \system\Controller;

class CockpitController extends Controller
{
    public $administrator = null;

    public function __construct($request)
    {
        parent::__construct($request);

        $this->administrator = Session::get('administrator');

        if ($this->administrator === null) {
            $this->redirect('cockpit_administrators_login');
        }
    }
}
