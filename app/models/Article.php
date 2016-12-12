<?php

namespace app\models;

use system\Model;

class Article extends Model
{
    public $parent = array(
        "users" => "user_id"
    );
}
