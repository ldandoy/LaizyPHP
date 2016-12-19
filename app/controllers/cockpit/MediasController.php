<?php

namespace app\controllers\cockpit;

use system\Controller;
use app\models\Media;

class MediasController extends Controller
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
