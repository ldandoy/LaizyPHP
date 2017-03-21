<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use app\models\User;

use System\Router;
use System\Session;
use System\Password;

class UserController extends ApplicationController
{
    /*
     * @var app\models\User
     */
    public $user = null;

    public function signupAction()
    {
        $this->user = new User();

        if (!empty($this->request->post)) {
            $this->user->setData($this->request->post);

            if ($this->user->valid()) {
                $password = Password::generatePassword();
                $cryptedPassword = Password::crypt($password);
                $this->user->password = $cryptedPassword;

                $this->user->email_verification_code = Password::generateToken();
                $this->user->email_verification_date = date('Y-m-d H:i:s');
                $this->user->active = 0;

                if ($this->user->create((array)$this->user)) {
                    Session::addFlash('Compte créé', 'success');
                    $this->redirect('user_login');
                } else {
                    Session::addFlash('Erreur insertion base de données', 'danger');
                };
            } else {
                Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            }
        }

        $columns = array(
            array(
                'name' => 'a',
                'title' => 'A',
                'type' => 'string'
            ),
            array(
                'name' => 'b',
                'title' => 'B',
                'type' => 'string'
            ),
            array(
                'name' => 'c',
                'title' => 'C',
                'type' => 'string'
            )
        );

        $data = array(
            array(
                'a' => 'aaa',
                'b' => 'bbb',
                'c' => 'ccc',
            ),
            array(
                'a' => 'ddd',
                'b' => 'eee',
                'c' => 'fff',
            ),
            array(
                'a' => 'ggg',
                'b' => 'hhh',
                'c' => 'iii',
            )
        );

        $this->render('signup', array(
            'id' => 0,
            'user' => $this->user,
            'pageTitle' => 'Création de compte',
            'formAction' => Router::url('user_signup'),
            'data' => $data,
            'columns' => $columns
        ));
    }
}
