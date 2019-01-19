<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;

use Auth\models\User;
use Cms\models\Page;
use Media\models\Media;
use Cms\models\Article;

class DefaultsController extends CockpitController
{
    public function indexAction()
    {
        $userCount = User::count();
        $pageCount = Page::count();
        $mediaCount = Media::count();
        $mediaCount = Media::count();
        $articleCount = Article::count();

        $this->render(
            'index',
            array(
                'userCount'     => $userCount,
                'pageCount'     => $pageCount,
                'mediaCount'    => $mediaCount,
                'articleCount'  => $articleCount
            )
        );
    }
}
