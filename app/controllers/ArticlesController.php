<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use app\models\Article;

class ArticlesController extends ApplicationController
{
    public function indexAction()
    {
        $articles = Article::findAll();

        $this->render(
            'index',
            array(
                'articles'   => $articles,
                'titre'      => 'Articles'
            )
        );
    }

    public function showAction($id)
    {
        $article = Article::findById($id);

        if (empty($article)) {
            $this->e404("Enregistrement non trouvé.");
        }
        
        $this->render('show', array(
            'article'   => $article,
            'titre'     => $article->titre
        ));
    }
}
