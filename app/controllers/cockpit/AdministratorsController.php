<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Administrator;

use system\Router;
use system\Session;

use system\form\Form;
use system\form\FormElementText;
use system\form\FormElementPassword;
use system\form\FormElementSubmit;

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
        $administrator = new Administrator();

        $form = Form::createFromModel($administrator, Router::url('cockpit_administrators_create'));

        $this->render('edit', array(
            'id' => 0,
            'administrator' => $administrator,
            'pageTitle' => 'Nouvel administrateur',
            'form' => $form
        ));
    }

    public function editAction($id)
    {
        $administrator = Administrator::findById($id);

        $form = Form::createFromModel($administrator, Router::url('cockpit_administrators_update'));

        $this->render('edit', array(
            'id' => $id,
            'administrator' => $administrator,
            'pageTitle' => 'Modification administrateur n°'.$id,
            'form' => $form
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
        $form = new Form(array(
            'id' => 'formLogin',
            'action' => Router::url('cockpit_administrators_login'),
            'submit' => 'login'
        ));
        $form->addElement(new FormElementText(array(
            'id' => 'email',
            'label' => 'Identifiant',
            'required' => true,
            'validations' => array(
                array(
                    'type' => FORMELEMENT_VALIDATION_EMAIL,
                    'message' => 'Email invalide'
                )
            ),
            'value' => isset($this->request->post['email']) ? $this->request->post['email'] : ''
        )));
        $form->addElement(new FormElementPassword(array(
            'id' => 'password',
            'label' => 'Mot de passe',
            'required' => true,
            'value' => ''
        )));
        $form->addElement(new FormElementSubmit(array(
            'id' => 'login',
            'label' => 'Se connecter',
            'value' => 'login'
        )));

        if ($form->isValid()) {
            $administrator = Administrator::findByEmail($form->getElement('email')->value);
            if ($administrator && $administrator->password == $form->getElement('password')->value) {
                Session::set('administrator', $administrator);
                $this->redirect('cockpit');
            }
        }

        $this->render('login', array(
            'pageTitle' => 'Connection au Cockpit',
            'form' => $form
        ));
    }

    public function logoutAction()
    {
        Session::remove('administrator');
        $this->administrator = null;
        $this->redirect('cockpit_administrators_login');
    }
}
