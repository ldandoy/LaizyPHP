<?php

namespace app\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use app\models\Media;

class MediasController extends CockpitController
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
