<?php

namespace app\models;

use system\Model;

class User extends Model
{
    protected $permittedColumns = array('nom', 'prenom', 'email');
}
