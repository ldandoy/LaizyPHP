<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Article;

use system\Router;

class ArticlesController extends CockpitController
{
    public function indexAction()
    {
        $articles = Article::findAll();

        $this->render('index', array(
            'articles'    => $articles
        ));
    }

    public function newAction()
    {
        $article = new Article();

        $this->render('edit', array(
            'id'        => 0,
            'article'   => $article,
            'pageTitle' => 'Nouvel article',
            'formAction' => Router::url('cockpit_articles_create')
        ));
    }

    public function editAction($id)
    {
        $article = Article::findById($id);

        $this->render('edit', array(
            'id'        => $id,
            'article'   => $article,
            'pageTitle' => 'Editer l\'article n°'.$id,
            'formAction' => Router::url('cockpit_articles_update', array('id' => $id))
        ));
    }

    public function createAction()
    {
        $article = new Article();
        if ($article->create($this->request->post)) {
            $this->Session->setFlash('Article ajouté');
            $this->redirect('cockpit_articles');
        } else {
            $this->Session->setFlash('Erreur...');
            $this->redirect('cockpit_articles_new');
        };
    }

    public function updateAction($id)
    {
        $article = Article::findById($id);
        $article->update($this->request->post);
        $this->Session->setFlash('Article modifié');
        $this->redirect('cockpit_articles');
    }

    public function deleteAction($id)
    {
        $article = Article::findById($id);
        $article->delete();
        $this->Session->setFlash('Article supprimé');
        $this->redirect('cockpit_articles');
    }
}
