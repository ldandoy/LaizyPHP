<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Administrator;

use system\Router;
use system\Session;
use system\Password;

class AdministratorsController extends CockpitController
{
    public function indexAction()
    {
        $administrators = Administrator::findAll();

        $this->render('index', array(
            'administrators' => $administrators
        ));
    }

    public function newAction()
    {
        $administrator = Session::get('administrator');
        if ($administrator === null) {
            $administrator = new Administrator();
        }

        $this->render('edit', array(
            'id' => 0,
            'administrator' => $administrator,
            'pageTitle' => 'Nouvel administrateur',
            'formAction' => Router::url('cockpit_administrators_create')
        ));
    }

    public function editAction($id)
    {
        $administrator = Session::get('administrator');
        if ($administrator === null) {
            $administrator = Administrator::findById($id);
        }

        $this->render('edit', array(
            'id' => $id,
            'administrator' => $administrator,
            'pageTitle' => 'Modification administrateur n°'.$id,
            'formAction' => Router::url('cockpit_administrators_update_'.$id)
        ));
    }

    public function createAction()
    {
        $administrator = new Administrator();
        $administrator->setData($this->request->post);

        if ($administrator->valid()) {
            if ($administrator->create((array)$administrator)) {
                Session::addFlash('Administrateur ajouté', 'success');
                Session::remove('administrator');
                $this->redirect('cockpit_administrators');
            } else {
                Session::addFlash('Erreur insertion base de données', 'danger');
                Session::set('administrator', $administrator);
                $this->redirect('cockpit_administrators_new');
            };
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            Session::set('administrator', $administrator);
            $this->redirect('cockpit_administrators_new');
        }
    }

    public function updateAction($id)
    {
        $administrator = Administrator::findById($id);
        $administrator->setData($this->request->post);

        if ($administrator->valid()) {
            $newPassword = $this->request->post['newPassword'];
            if (Password::validPassword($newPassword)) {
                $administrator->password = Password::crypt($newPassword);
            } else {
                $administrator->errors['newPassword'] = 'Mot de passe invalide';
            }
        }

        if (empty($administrator->errors)) {
            if ($administrator->update((array)$administrator)) {
                Session::addFlash('Administrateur modifié', 'success');
                Session::remove('administrator');
                $this->redirect('cockpit_administrators');
            } else {
                Session::addFlash('Erreur mise à jour base de données', 'danger');
                Session::set('administrator', $administrator);
                $this->redirect('cockpit_administrators_edit_'.$id);
            }
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            Session::set('administrator', $administrator);
            $this->redirect('cockpit_administrators_edit_'.$id);
        }
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

        if (!empty($post) && isset($post['email']) && isset($post['password']) ) {
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
