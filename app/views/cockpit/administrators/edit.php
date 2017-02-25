<h1 class="page-title"><?php echo $params['pageTitle']; ?></h1>
<form id="formAdministrator" method="post" action="<?php echo $params['formAction']; ?>" class="form form-horizontal">
<?php
echo system\Form::text(array(
    'name' => 'lastname',
    'label' => 'Nom',
    'value' => isset($this->administrator->lastname) ? $this->administrator->lastname : '',
    'error' => isset($this->administrator->errors['lastname']) ? $this->administrator->errors['lastname'] : ''
));
echo system\Form::text(array(
    'name' => 'firstname',
    'label' => 'Prénom',
    'value' => isset($this->administrator->firstname) ? $this->administrator->firstname : '',
    'error' => isset($this->administrator->errors['firstname']) ? $this->administrator->errors['firstname'] : ''
));
echo system\Form::text(array(
    'name' => 'email',
    'label' => 'Email',
    'value' => isset($this->administrator->email) ? $this->administrator->email : '',
    'error' => isset($this->administrator->errors['email']) ? $this->administrator->errors['email'] : ''
));
if (isset($this->administrator->id)) {
    echo system\Form::password(array(
        'name' => 'newPassword',
        'label' => 'Nouveau mot de passe',
        'value' => '',
        'autocomplete' => 'off',
        'error' => isset($this->administrator->errors['newPassword']) ? $this->administrator->errors['newPassword'] : ''
    ));
}
echo system\Form::submit(array(
    'name' => 'submit',
    'label' => 'Enregistrer',
    'value' => 'save',
    'formId' => 'formAdministrator',
    'class' => 'btn-primary'
));
?>
</form>