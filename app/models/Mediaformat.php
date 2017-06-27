<?php

namespace app\models;

use Core\Model;

class Mediaformat extends Model
{
    protected $permittedColumns = array(
        
    );

    public function getValidations()
    {
        $validations = parent::getValidations();

        $validations = array_merge(
            $validations,
            array(
                
            )
        );

        return $validations;
    }
}
