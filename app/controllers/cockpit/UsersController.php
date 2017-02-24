<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\User;

use system\Router;
use system\Session;
use system\Password;

class UsersController extends CockpitController
{
    public function indexAction()
    {
        $users = User::findAll();

        $this->render('index', array(
            'users' => $users
        ));
    }

    public function newAction()
    {
        $user = Session::get('user');
            var_dump(0);
        if ($user === null) {
            $user = new User();
            var_dump(1);
        }

        $this->render('edit', array(
            'id' => 0,
            'user' => $user,
            'pageTitle' => 'Nouvel utilisateur',
            'formAction' => Router::url('cockpit_users_create')
        ));
    }

    public function editAction($id)
    {
        $user = Session::get('user');
        if ($user === null) {
            $user = User::findById($id);
        }

        $this->render('edit', array(
            'id' => $id,
            'user' => $user,
            'pageTitle' => 'Modification utilisateur n°'.$id,
            'formAction' => Router::url('cockpit_users_update_'.$id)
        ));
    }

    public function createAction()
    {
        $user = new User();
        $user->setData($this->request->post);

        if ($user->valid()) {
            if ($user->create((array)$user)) {
                Session::addFlash('Utilisateur ajouté', 'success');
                Session::remove('user');
                $this->redirect('cockpit_users');
            } else {
                Session::addFlash('Erreur insertion base de données', 'danger');
                Session::set('user', $user);
                $this->redirect('cockpit_users_new');
            };
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            Session::set('user', $user);
            $this->redirect('cockpit_users_new');
        }

        $user = new User();
        if ($user->create($this->request->post)) {
            $this->Session->setFlash('Utilisateur ajouté');
            $this->redirect('cockpit_users');
        } else {
            $this->Session->setFlash('Erreur...');
            $this->redirect('cockpit_users_new');
        };
    }

    public function updateAction($id)
    {
        $user = User::findById($id);
        $user->setData($this->request->post);

        if ($user->valid()) {
            $newPassword = $this->request->post['newPassword'];
            if (Password::validPassword($newPassword)) {
                $user->password = Password::crypt($newPassword);
            } else {
                $user->errors['newPassword'] = 'Mot de passe invalide';
            }
        }

        if (empty($user->errors)) {
            if ($user->update((array)$user)) {
                Session::addFlash('Utilisateur modifié', 'success');
                Session::remove('user');
                $this->redirect('cockpit_users');
            } else {
                Session::addFlash('Erreur mise à jour base de données', 'danger');
                Session::set('user', $user);
                $this->redirect('cockpit_users_edit_'.$id);
            }
        } else {
            Session::addFlash('Erreur(s) dans le formulaire', 'danger');
            Session::set('user', $user);
            $this->redirect('cockpit_users_edit_'.$id);
        }
    }

    public function deleteAction($id)
    {
        $user = User::findById($id);
        $user->delete();
        $this->Session->setFlash('Utilisateur supprimé', 'success');
        $this->redirect('cockpit_users');
    }
}
