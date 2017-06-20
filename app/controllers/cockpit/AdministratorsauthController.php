<?php
/**
 * File app\controllers\cockpit\AdministratorsAuthController.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace app\controllers\cockpit;

use Auth\controllers\AuthController;

/**
 * Auth controller
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class AdministratorsauthController extends AuthController
{
    public function loginAction()
    {
        $this->loginPage        = 'cockpit_administratorsauth_login';
        $this->signupURL        = 'cockpit_administratorsauth_signup';
        $this->tableName        = 'administrators';
        $this->sessionKey       = 'current_administrator';
        $this->model            = 'Auth\\models\\Administrator';
        $this->pageTitle        = '';
        $this->afterLoginPage   = 'cockpit';

        parent::loginAction();
        $this->render('auth::login', $this->params);
    }

    public function signupAction()
    {
        $this->loginPage        = 'cockpit_administratorsauth_login';
        $this->signupURL        = 'cockpit_administratorsauth_signup';
        $this->model            = 'Auth\\models\\Administrator';
        $this->afterSignupPage  = 'cockpit';
        $this->pageTitle        = 'Création d\'un compte administrator';

        parent::signupAction();
    }

    public function logoutAction()
    {
        $this->sessionKey        = 'current_administrator';
        $this->afterLogoutPage   = 'cockpit';

        parent::logoutAction();
    }
}
