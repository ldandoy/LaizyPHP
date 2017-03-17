<?php

namespace app\models;

use System\Model;

class Media extends Model
{
    protected $permittedColumns = array('label', 'name', 'origin_name');
}
