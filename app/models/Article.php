<?php

namespace app\models;

use system\Model;

class Article extends Model
{
    public $permittedColunms = array('titre', 'contenu');
    
    public $parent = array(
        "User" => "user_id"
    );
}
