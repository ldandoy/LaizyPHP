<?php

namespace app\controllers;

use system\Controller;
use system\Utils;

class articlesController extends Controller
{
    public function indexAction()
    {
        $this->loadModel("Article");
        $articles = $this->Article->findAll();
        
        $this->loadModel("User");
        $users = $this->User->findAll();

        $this->render('index', array(
            'articles'    => $articles,
            'users'    => $users
        ));
    }

    public function showAction($id)
    {
        $this->loadModel("Article");
        $article = $this->Article->findById($id);

        if (empty($article)) {
            $this->e404("Enregistrement non trouvé.");
        }

        $this->render('show', array(
            'article' => $article
        ));
    }
}
