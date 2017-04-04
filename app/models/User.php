<?php

namespace app\models;

use System\Model;
use System\Query;
use System\Password;

class User extends Model
{
    protected $permittedColumns = array(
        'lastname',
        'firstname',
        'email',
        'password',
        'address',
        'email_verification_code',
        'email_verification_date',
        'active'
    );

    /**
     * Set default properties values
     */
    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->active = 1;
    }

    /**
     * Get an user by email
     *
     * @param string $email
     *
     * @return app\model\User | bool
     */
    public static function findByEmail($email)
    {
        $query = new Query();
        $query->select('*');
        $query->where('email = :email');
        $query->from(self::getTableName());

        return $query->executeAndFetch(array('email' => $email));
    }

    /**
     * Validate the object and fill $this->errors with error messages
     *
     * @return bool
     */
    public function valid()
    {
        $this->lastname = trim($this->lastname);
        if ($this->lastname == '') {
            $this->errors['lastname'] = 'Nom obligatoire';
        }

        $this->firstname = trim($this->firstname);
        if ($this->firstname == '') {
            $this->errors['firstname'] = 'Prénom obligatoire';
        }

        $this->email = trim($this->email);
        if ($this->email == '') {
            $this->errors['email'] = 'Email obligatoire';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email invalide';
        }

        $this->address = trim($this->address);
        if ($this->address == '') {
            // $this->errors['address'] = 'Adresse obligatoire';
        }

        return empty($this->errors);
    }

    /**
     * Get fullname : <lastname>[ <firstname>]
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->lastname.ltrim(' '.$this->firstname);
    }

    /**
     * Get user list for options in a select input
     */
    public static function getOptions()
    {
        $options = array();

        $users = self::findAll();

        foreach ($users as $user) {
            $options[$user->id] = array(
                'value' => $user->id,
                'label' => $user->getFullName()
            );
        }

        return $options;
    }
}
