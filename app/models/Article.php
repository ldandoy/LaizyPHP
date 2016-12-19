<?php

namespace app\models;

use system\Model;

class Article extends Model
{
    protected $permittedColumns = array('titre', 'contenu', 'user_id');
    
    public $parent = array(
        "User" => "user_id"
    );
}
