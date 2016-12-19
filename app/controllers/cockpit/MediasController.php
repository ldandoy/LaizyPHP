<?php

namespace app\controllers\cockpit;

use app\controllers\ApplicationController;
use app\models\Media;

class MediasController extends ApplicationController
{
    public function indexAction()
    {
        $medias = Media::findAll();

        $this->render(
            'index',
            array(
                'medias'   => $medias,
            )
        );
    }
}
