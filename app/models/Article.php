<?php

namespace app\models;

use system\Model;

class Article extends Model
{
    protected $permittedColumns = array('title', 'content', 'user_id');
    
    public $parent = array(
        "User" => "user_id"
    );
}
