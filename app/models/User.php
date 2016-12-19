<?php

namespace app\models;

use system\Model;

class User extends Model
{
    public $permittedColunms = array('nom', 'prenom', 'email');
}
