<?php

namespace app\models;

use system\Model;

class Media extends Model
{
    protected $permittedColumns = array('label', 'name', 'origin_name');
}
