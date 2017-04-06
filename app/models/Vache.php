<?php

namespace app\models;

use System\Model;

class Vache extends Model
{
    protected $permittedColumns = array(
        'Array',
        'Array',
        'Array',
    );

    public function getValidations()
    {
        $validations = parent::getValidations();

        $validations = array_merge(
            $validations,
            array(
                'nom' => array(
                    'type' => 'required',
                    'error' => 'nom obligatoire'
                ),
                'couleur' => array(
                    'type' => 'required',
                    'error' => 'couleur obligatoire'
                ),
                'etable' => array(
                    'type' => 'required',
                    'error' => 'etable obligatoire'
                ),
            )
        );

        return $validations;
    }
}
