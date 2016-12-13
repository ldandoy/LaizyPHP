<?php

namespace app\controllers;

use system\Controller;
use app\models\Article;

class articlesController extends Controller
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
