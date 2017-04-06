<?php

namespace app\models;

use System\Model;

class {{modelName}} extends Model
{
    protected $permittedColumns = array(
        {{permittedColumns}}
    );

    public function getValidations()
    {
        $validations = parent::getValidations();

        $validations = array_merge(
            $validations,
            array(
                {{validations}}
            )
        );

        return $validations;
    }
}
