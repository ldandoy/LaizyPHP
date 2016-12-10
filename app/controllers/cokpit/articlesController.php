<?php

	namespace app\controllers\cokpit;

	use system\Controller;
	use system\Utils;

	class articlesController extends Controller {

		function indexAction() {
			$this->loadModel("Article");
			$articles = $this->Article->findAll();

			$this->render('index', array(
				'articles' 	=> $articles
			));
		}

		function editAction($id) {
			$this->render('edit', array(
				'id' 	=> $id
			));
		}

		public function deleteAction($id) {


			// $this->loadModel("Article");
			// $this->Article->delete($id)
			$this->Session->setFlash('Le contenu a bien été supprimé');

			$this->redirect('cokpit_articles');
		}
	}