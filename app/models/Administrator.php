<?php

namespace app\models;

use system\Model;

class Administrator extends Model
{
    protected $permittedColumns = array('lastname', 'firstname', 'email');
}
