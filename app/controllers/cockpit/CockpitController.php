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
        //$gotoLogin = \system\Session::get('gotoLogin');

        if ($this->administrator === null/* && $gotoLogin === null*/) {
            //system\Session::set('gotoLogin', true);
            $this->redirect('cockpit_administrators_login');
        }

        /*if ($gotoLogin !== null) {
           system\Session::remove('gotoLogin');
        }*/
    }
}
