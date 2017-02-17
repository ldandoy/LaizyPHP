<?php

namespace app\models;

use system\Model;

class User extends Model
{
    protected $permittedColumns = array('lastname', 'firstname', 'email', 'address');
}
