<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Administrator;

use system\Router;
use system\Session;
use system\Password;

class AdministratorsController extends CockpitController
{
    /*
     * @var app\models\Administrator
     */
    public $administrator = null;
    public $layout = null;

    public function indexAction()
    {
        $administrators = Administrator::findAll();

        $this->render('index', array(
            'administrators' => $administrators
        ));
    }

    public function newAction()
    {
        if ($this->administrator === null) {
            $this->administrator = new Administrator();
        }

        $this->render('edit', array(
            'id' => 0,
            'administrator' => $this->administrator,
            'pageTitle' => 'Nouvel administrateur',
            'formAction' => Router::url('cockpit_administrators_create')
        ));
    }

    public function editAction($id)
    {
        if ($this->administrator === null) {
            $this->administrator = Administrator::findById($id);
        }

        $this->render('edit', array(
            'id' => $id,
            'administrator' => $this->administrator,
            'pageTitle' => 'Modification administrateur n°'.$id,
            'formAction' => Router::url('cockpit_administrators_update_'.$id)
        ));
    }

    public function createAction()
    {
        $this->administrator = new Administrator();
        $this->administrator->setData($this->request->post);

        if ($this->administrator->valid()) {
            $password = Password::generatePassword();
            $cryptedPassword = Password::crypt($password);
            $this->administrator->password = $cryptedPassword;

            $this->administrator->email_verification_code = Password::generateToken();
            $this->administrator->email_verification_date = date('Y-m-d H:i:s');
            $this->administrator->active = 0;

            if ($this->administrator->create((array)$this->administrator)) {
                Session::addFlash('Administrateur ajouté', 'success');
                $this->redirect('cockpit_administrators');
            } else {
                Session::addFlash('Erreur insertion base de données', 'danger');
            };
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function updateAction($id)
    {
        $this->administrator = Administrator::findById($id);
        $this->administrator->setData($this->request->post);

        if ($this->administrator->valid()) {
            $newPassword = trim($this->request->post['newPassword']);
            if ($newPassword != '') {
                if (Password::validPassword($newPassword)) {
                    $this->administrator->password = Password::crypt($newPassword);
                } else {
                    $this->administrator->errors['newPassword'] = 'Mot de passe invalide';
                }
            }

            if (empty($this->administrator->errors)) {
                if ($this->administrator->update((array)$this->administrator)) {
                    Session::addFlash('Administrateur modifié', 'success');
                    $this->redirect('cockpit_administrators');
                } else {
                    Session::addFlash('Erreur mise à jour base de données', 'danger');
                }
            } else {
                Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            }
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $administrator = Administrator::findById($id);
        $administrator->delete();
        Session::addFlash('Administrateur supprimé', 'success');
        $this->redirect('cockpit_administrators');
    }

    public function loginAction($goto = null)
    {
        $errors = array();
        $post = $this->request->post;
        $this->layout = $this->request->prefix.DS."login";

        if (!empty($post) && isset($post['email']) && isset($post['password'])) {
            /*
            $administrator = Administrator::check($post);
            if ($administrator) {
                Session::set('connectedAdministrator', $administrator);
                $this->redirect('cockpit');
            } else {
                // On devrait aussi inverser les arguments de cette fonction.
                Session::addFlash($administrator->getErrorMessage(), 'danger');
            }
            */


            if (trim($post['email']) == '') {
                $errors['email'] = 'Champs obligatoire';
            } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email invlaide';
            }

            if (trim($post['password']) == '') {
                $errors['password'] = 'Champs obligatoire';
            }

            if (empty($errors)) {
                $administrator = Administrator::findByEmail($post['email']);
                if ($administrator && Password::check($post['password'], $administrator->password)) {
                    Session::set('connectedAdministrator', $administrator);
                    $this->redirect('cockpit');
                } else {
                    Session::addFlash('Identifiant ou mot de passe incorrect', 'danger');
                }
            }
        }

        $this->render('login', array(
            'pageTitle' => 'Connection au Cockpit',
            'formAction' => Router::url('cockpit_administrators_login'),
            'errors' => $errors
        ));
    }

    public function logoutAction()
    {
        Session::remove('connectedAdministrator');
        $this->connectedAdministrator = null;
        $this->redirect('cockpit_administrators_login');
    }
}
