<?php

namespace app\controllers;

use app\controllers\ApplicationController;
use Helper\Datetime;
use Media\models\Media;
use Auth\models\Group;

class TestController extends FrontController
{
    public function indexAction()
    {
        $params = array(
            'pageTitle' => 'Test Helpers',
            'tableTest' => array(
                'columns' => array(
                    array(
                        'name' => 'col1',
                        'type' => 'int',
                        'title' => 'Col 1'
                    ),
                    array(
                        'name' => 'col2',
                        'type' => 'string',
                        'title' => 'Col 2'
                    ),
                    array(
                        'name' => 'col3',
                        'type' => 'string',
                        'title' => 'Col 3'
                    ),
                    array(
                        'name' => 'col4',
                        'type' => 'datetime',
                        'format' => Datetime::FORMAT_DATE_LONG,
                        'title' => 'Col 4'
                    )
                ),
                'data' => array(
                    array(
                        'col1' => 1,
                        'col2' => 'aaa',
                        'col3' => 'zzz',
                        'col4' => '2017-01-01 12:00:00'
                    ),
                    array(
                        'col1' => 2,
                        'col2' => 'bbb',
                        'col3' => 'yyy',
                        'col4' => '2017-02-01 11:30:00'
                    ),
                    array(
                        'col1' => 3,
                        'col2' => 'ccc',
                        'col3' => 'xxx',
                        'col4' => '2017-03-02 10:15:30'
                    ),
                    array(
                        'col1' => 4,
                        'col2' => 'ddd',
                        'col3' => 'www',
                        'col4' => '2017-01-04 09:59:59'
                    ),
                    array(
                        'col1' => 1,
                        'col2' => 'aaa',
                        'col3' => 'zzz',
                        'col4' => '2017-01-01 12:00:00'
                    ),
                    array(
                        'col1' => 2,
                        'col2' => 'bbb',
                        'col3' => 'yyy',
                        'col4' => '2017-02-01 11:30:00'
                    ),
                    array(
                        'col1' => 3,
                        'col2' => 'ccc',
                        'col3' => 'xxx',
                        'col4' => '2017-03-02 10:15:30'
                    ),
                    array(
                        'col1' => 4,
                        'col2' => 'ddd',
                        'col3' => 'www',
                        'col4' => '2017-01-04 09:59:59'
                    ),
                    array(
                        'col1' => 1,
                        'col2' => 'aaa',
                        'col3' => 'zzz',
                        'col4' => '2017-01-01 12:00:00'
                    ),
                    array(
                        'col1' => 2,
                        'col2' => 'bbb',
                        'col3' => 'yyy',
                        'col4' => '2017-02-01 11:30:00'
                    ),
                    array(
                        'col1' => 3,
                        'col2' => 'ccc',
                        'col3' => 'xxx',
                        'col4' => '2017-03-02 10:15:30'
                    ),
                    array(
                        'col1' => 4,
                        'col2' => 'ddd',
                        'col3' => 'www',
                        'col4' => '2017-01-04 09:59:59'
                    )
                )
            ),
            'formAction' => 'test',
            'selectOptions' => array(
                array('value' => '', 'label' => '----'),
                array('value' => 'val1', 'label' => 'Value 1'),
                array('value' => 'val2', 'label' => 'Value 2'),
                array('value' => 'val3', 'label' => 'Value 3')
            ),
            'checkboxgroupOptions' => array(
                array('value' => 'val1', 'label' => 'Value 1'),
                array('value' => 'val2', 'label' => 'Value 2'),
                array('value' => 'val3', 'label' => 'Value 3')
            ),
            'radiogroupOptions' => array(
                array('value' => 'val1', 'label' => 'Value 1'),
                array('value' => 'val2', 'label' => 'Value 2'),
                array('value' => 'val3', 'label' => 'Value 3')
            )
        );

        $params = array_merge($params, $this->request->post);

        $medias = Media::findAll('id=1');
        if (!empty($medias)) {
            $media = $medias[count($medias)-1];
            $params['media'] = $media;
        }

        $this->render(
            'test::index',
            $params
        );
    }
}
