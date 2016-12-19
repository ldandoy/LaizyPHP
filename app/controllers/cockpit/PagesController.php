<?php

namespace app\controllers\Cockpit;

use app\controllers\ApplicationController;
use app\models\Page;

class PagesController extends ApplicationController
{

    public function indexAction()
    {
        /* Récuperation des pages de la bdd */
        $pages = Page::findAll();

        $this->render(
            'index',
            array(
                'titre'     => 'Listes des pages',
                'tables'    => $pages
            )
        );
    }

    public function newAction()
    {
        $this->render('new');
    }

    public function createAction()
    {
        if (Page::create($this->request->post)) {
            $this->redirect('cockpit_pages_index');
        }
    }
}
