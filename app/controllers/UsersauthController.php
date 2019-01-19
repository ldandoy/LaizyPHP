<?php
/**
 * File app\controllers\UsersAuthController.php
 *
 * @category app
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace app\controllers;

use Auth\controllers\AuthController;

/**
 * Auth controller
 *
 * @category app
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class UsersauthController extends AuthController
{
    public function loginAction()
    {
        $this->afterLoginPage = $this->site->home_page;
        parent::loginAction();

        $this->render('auth::login', $this->params);
    }

    public function signupAction()
    {
        parent::signupAction();
    }

    public function logoutAction()
    {
        parent::logoutAction();
    }
}
