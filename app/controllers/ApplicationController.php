<?php

namespace app\controllers;

use \system\Controller;
use \system\Session;

class ApplicationController extends Controller
{
    public $user = null;

    public function __construct($request)
    {
        parent::__construct($request);

        $this->connectedUser = Session::get('connectedUser');
    }
}
