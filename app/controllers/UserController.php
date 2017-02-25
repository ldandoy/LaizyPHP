<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use app\models\User;

use system\Router;
use system\Session;
use system\Password;

class UserController extends ApplicationController
{
    public function signin()
    {
        $errors = array();
        $post = $this->request->post;

        if (!empty($post)) {
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
