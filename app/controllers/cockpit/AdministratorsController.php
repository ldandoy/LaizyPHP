<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Administrator;

use system\Router;

class AdministratorsController extends CockpitController
{
    public function indexAction()
    {
        $users = Administrator::findAll();

        $this->render('index', array(
            'administrators'    => $users
        ));
    }

    public function newAction()
    {
        $user = new Administrator();

        $this->render('edit', array(
            'id'        => 0,
            'administrator'   => $user,
            'pageTitle' => 'Nouvel administrateur',
            'formAction' => Router::url('cockpit_administrators_create')
        ));
    }

    public function editAction($id)
    {
        $user = Administrator::findById($id);

        $this->render('edit', array(
            'id'        => $id,
            'administrator'   => $user,
            'pageTitle' => 'Modification administrateur n°'.$id,
            'formAction' => Router::url('cockpit_administrators_update', array('id' => $id))
        ));
    }

    public function createAction()
    {
        $user = new Administrator();
        if ($user->create($this->request->post)) {
            $this->Session->setFlash('Administrateur ajouté');
            $this->redirect('cockpit_administrators');
        } else {
            $this->Session->setFlash('Erreur...');
            $this->redirect('cockpit_administrators_new');
        };
    }

    public function updateAction($id)
    {
        $user = Administrator::findById($id);
        $user->update($this->request->post);
        $this->Session->setFlash('Administrateur modifié');
        $this->redirect('cockpit_administrators');
    }

    public function deleteAction($id)
    {
        $user = Administrator::findById($id);
        $user->delete();
        $this->Session->setFlash('Administrateur supprimé');
        $this->redirect('cockpit_administrators');
    }

    public function loginAction($goto = null)
    {
        var_dump($this->request->post);
        if (isset($this->request->post['email']) && isset($this->request->post['password'])) {
            if ($this->request->post['email'] != '' && $this->request->post['password'] != '') {

            } else {
            }

            if ($goto !== null) {
                // $this->redirect($goto);
            }            
        }

        $this->render('login', array(
            'email' => isset($this->request->post['email']) ? $this->request->post['email'] : '',
            'pageTitle' => 'Connection au Cockpit',
            'formAction' => Router::url('cockpit_administrators_login')
        ));
    }

    public function logoutAction()
    {
        if ($goto !== null) {
            $this->redirect($goto);
        }
    }

}
