<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use app\models\User;

use system\Router;
use system\Session;
use system\Password;

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

        $this->render('signup', array(
            'id' => 0,
            'user' => $this->user,
            'pageTitle' => 'Création de compte',
            'formAction' => Router::url('user_signup')
        ));
    }

    public function loginAction($goto = null)
    {
        $errors = array();
        $post = $this->request->post;

        if (!empty($post) && isset($post['email']) && isset($post['password'])) {
            if (trim($post['email']) == '') {
                $errors['email'] = 'Champs obligatoire';
            }
            else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email invlaide';
            }

            if (trim($post['password']) == '') {
                $errors['password'] = 'Champs obligatoire';
            }
            if(empty($errors)) {
                $user = User::findByEmail($post['email']);
                if ($user && Password::check($post['password'], $user->password)) {
                    Session::set('connectedUser', $user);
                    $this->redirect('');
                } else {
                    Session::addFlash('Identifiant ou mot de passe incorrect', 'danger', true);
                }
            }
        }

        $this->render('login', array(
            'pageTitle' => 'Connection à votre espace client',
            'formAction' => Router::url('user_login'),
            'errors' => $errors
        ));
    }

    public function logoutAction()
    {
        Session::remove('connectedUser');
        $this->connectedUser = null;
        $this->redirect('user_login');
    }
}
