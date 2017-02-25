<?php

namespace app\models;

use system\Model;
use system\Query;
use system\Password;

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

    /**
     * Validate the object and fill $this->errors with error messages
     *
     * @return bool
     */
    public function valid()
    {
        $this->errors = array();

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

        /*$this->password = trim($this->password);
        if ($this->password == '') {
            $this->errors['password'] = 'Mot de passe obligatoire';
        } else if (!Password::valid($this->password)) {
            $this->errors['password'] = 'Mot de passe invalide';
        }*/

        return empty($this->errors);
    }
}
