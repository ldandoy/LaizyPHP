<?php

    namespace app\controllers\cokpit;

use system\Controller;
    use system\Utils;

    class articlesController extends Controller
    {
        public function indexAction()
        {
            $this->loadModel("Article");
            $articles = $this->Article->findAll();

            $this->render('index', array(
                'articles'    => $articles
            ));
        }

        public function editAction($id)
        {
            /*if ($this->request->params) {
                $this->loadModel("Article");
                $this->Article->save($this->request->params);
            }*/

            $this->render('edit', array(
                'id'    => $id
            ));
        }

        public function deleteAction($id)
        {


            // $this->loadModel("Article");
            // $this->Article->delete($id)
            $this->Session->setFlash('Le contenu a bien été supprimé');

            $this->redirect('cokpit_articles');
        }
    }
