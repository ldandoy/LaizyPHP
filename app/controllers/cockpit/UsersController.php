<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\User;

use system\Router;

class UsersController extends CockpitController
{
    public function indexAction()
    {
        $users = User::findAll();

        $this->render('index', array(
            'users'    => $users
        ));
    }

    public function newAction()
    {
        $user = new User();

        $this->render('edit', array(
            'id'        => 0,
            'user'   => $user,
            'pageTitle' => 'Nouvel utilisateur',
            'formAction' => Router::url('cockpit_users_create')
        ));
    }

    public function editAction($id)
    {
        $user = User::findById($id);

        $this->render('edit', array(
            'id'        => $id,
            'user'   => $user,
            'pageTitle' => 'Modification utilisateur n°'.$id,
            'formAction' => Router::url('cockpit_users_update', array('id' => $id))
        ));
    }

    public function createAction()
    {
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
        $user->update($this->request->post);
        $this->Session->setFlash('Utilisateur modifié');
        $this->redirect('cockpit_users');
    }

    public function deleteAction($id)
    {
        $user = User::findById($id);
        $user->delete();
        $this->Session->setFlash('Utilisateur supprimé');
        $this->redirect('cockpit_users');
    }
}
