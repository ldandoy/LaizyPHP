<?php

namespace app\controllers\Cockpit;

use system\Controller;
use app\models\Page;

class pagesController extends Controller
{

	function indexAction() {
		# Récuperation des pages de la bdd
		$pages = Page::findAll();

		$this->render('index', array(
			'titre' 	=> 'Listes des pages',
			'tables'	=> $pages,
        ));
	}

	function newAction() {
		$this->render('new');
	}

	function createAction() {
		Page::create($this->request->params);
		// $this->redirect('cockpit_pages_index');
	}
}