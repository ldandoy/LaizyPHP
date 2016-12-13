<?php

namespace app\models;

use system\Model;

class User extends Model
{
    public $attr = array('nom', 'prenom', 'email');
}
