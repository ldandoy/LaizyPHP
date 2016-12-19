<?php

namespace app\controllers\cockpit;

use app\controllers\BaseController;
use app\models\Article;

class ArticlesController extends BaseController
{
    public function indexAction()
    {
        $articles = Article::findAll();

        $this->render('index', array(
            'articles'    => $articles
        ));
    }

    public function editAction($id)
    {
        $article = Article::findById($id);

        $this->render('edit', array(
            'id'        => $id,
            'article'   => $article
        ));
    }

    public function updateAction($id)
    {
        $article = Article::findById($id);
        $article->update($this->request->post);
        die();
        $this->redirect('cockpit_articles');
    }

    public function deleteAction($id)
    {
        // $this->loadModel("Article");
        // $this->Article->delete($id)
        $this->Session->setFlash('Le contenu a bien été supprimé');
        $this->redirect('cockpit_articles');
    }
}
