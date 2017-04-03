<?php

namespace app\models;

use System\Model;
use System\Query;
use System\Password;

class Administrator extends Model
{
    protected $permittedColumns = array(
        'lastname',
        'firstname',
        'email',
        'password',
        'email_verification_code',
        'email_verification_date',
        'active'
    );

    public function getValidations()
    {
        $validations = parent::getValidations();

        $validations[] = array(
            
        )

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
    }

    /**
     * Set default properties values
     */
    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->active = 1;
    }

    /**
     * Get an administrator by email
     *
     * @param string $email
     *
     * @return app\model\Administrator | bool
     */
    public static function findByEmail($email)
    {
        $query = new Query();
        $query->select('*');
        $query->where('email = :email');
        $query->from(self::getTableName());

        return $query->executeAndFetch(array('email' => $email));
    }
}
