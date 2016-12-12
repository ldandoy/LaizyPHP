<?php

namespace app\controllers;

use system\Controller;
use system\Query;

class defaultsController extends Controller
{
    public function indexAction() {

        $this->loadModel('Article');
        $articles = $this->Article->findAll();

        // debug($articles);

        $this->render('index', array(
            'articles'    => $articles
        ));
    }
}
