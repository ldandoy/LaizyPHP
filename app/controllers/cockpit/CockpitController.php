<?php

namespace app\controllers\cockpit;

use system\Controller;

class CockpitController extends Controller
{
    public $administrator = null;

    public function __construct($request)
    {
        parent::__construct($request);

        //$this->administrator = isset($_SESSION['administrator']) $_SESSION['administrator'] ? : null;

        if($this->administrator === null)
        {
            $this->redirect('cockpit_cockpit_login');
        }
    }

    public function login($goto = null)
    {
        if(isset($_POST['login'])) {
            var_dump($_POST);
            //$this->redirect($goto);
        }

        $this->render('login', array(
            'formAction' => Router::url('cockpit_cockpit_login')
        ));
    }
}
