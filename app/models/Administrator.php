<?php

namespace app\models;

use system\Model;
use system\Query;

class Administrator extends Model
{
    protected $permittedColumns = array(
        'lastname',
        'firstname',
        'email',
        'password'
    );

    public static function getModel()
    {
        return array(
            'lastname' => array(
                'type' => 'string',
                'maxlength' => 255
            ),
            'firstname' => array(
                'type' => 'string',
                'maxlength' => 255
            ),
            'email' => array(
                'type' => 'string',
                'maxlength' => 255
            ),
            'password' => array(
                'type' => 'string',
                'maxlength' => 255
            )
        );
    }

    public static function findByEmail($email)
    {
        $query = new Query();
        $query->select('*');
        $query->where('email = :email');
        $query->from(self::getTableName());

        return $query->executeAndFetch(array('email' => $email));var_dump($res);
    }
}
