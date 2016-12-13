<?php

namespace app\controllers\Cockpit;

use system\Controller;

class pagesController extends Controller
{

	function indexAction() {
		# Récuperation des pages de la bdd
		$this->loadModel("Page");
		$pages = $this->Page->findAll();

		debug($pages);die;
		$this->render('index', array(
			'titre' 	=> 'Listes des pages',
			'tables'	=> $pages,
        ));
	}

	function newAction() {
		$this->render('new');
	}

	function createAction() {
		$this->loadModel("Page");
		$this->Page->create($this->request->params);
		$this->redirect('cockpit_pages_index');
	}
}