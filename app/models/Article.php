<?php

namespace app\models;

use System\Model;

class Article extends Model
{
    protected $permittedColumns = array('title', 'content', 'user_id');
    
    public $parent = array(
        "User" => "user_id"
    );

    /**
     * Get list of associed table(s)
     *
     * @return mixed
     */
    public function getAssociations()
    {
        return array(
            'category' => array(
                'type' => '1',
                'model' => 'app\\models\\User',
                'key' => 'user_id'
            )
        );
    }
}
