<h1 class="page-title"><?php echo $params['pageTitle']; ?></h1>
<form id="formUser" method="post" action="<?php echo $params['formAction']; ?>" class="form form-horizontal">
<?php
echo System\Form::text(array(
    'name' => 'lastname',
    'label' => 'Nom',
    'value' => isset($this->user->lastname) ? $this->user->lastname : '',
    'error' => isset($this->user->errors['lastname']) ? $this->user->errors['lastname'] : ''
));
echo System\Form::text(array(
    'name' => 'firstname',
    'label' => 'Prénom',
    'value' => isset($this->user->firstname) ? $this->user->firstname : '',
    'error' => isset($this->user->errors['firstname']) ? $this->user->errors['firstname'] : ''
));
echo System\Form::text(array(
    'name' => 'email',
    'label' => 'Email',
    'value' => isset($this->user->email) ? $this->user->email : '',
    'error' => isset($this->user->errors['email']) ? $this->user->errors['email'] : ''
));
if (isset($this->user->id)) {
    echo System\Form::password(array(
        'name' => 'newPassword',
        'label' => 'Mot de passe',
        'value' => '',
        'autocomplete' => 'off',
        'error' => isset($this->user->errors['newPassword']) ? $this->user->errors['newPassword'] : ''
    ));
}
echo System\Form::textarea(array(
    'name' => 'address',
    'label' => 'Adresse',
    'rows' => 5,
    'value' => isset($this->user->address) ? $this->user->address : '',
    'error' => isset($this->user->errors['address']) ? $this->user->errors['address'] : ''
));
echo System\Form::submit(array(
    'name' => 'submit',
    'label' => 'Enregistrer',
    'value' => 'save',
    'formId' => 'formUser',
    'class' => 'btn-primary'
));
?>
</form>