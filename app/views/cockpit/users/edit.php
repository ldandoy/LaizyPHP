<h1 class="page-title"><?php echo $params['pageTitle']; ?></h1>
<form id="formUser" method="post" action="<?php echo $params['formAction']; ?>" class="form form-horizontal">
<?php
$user = $params['user'];
echo system\Form::text(array(
    'name' => 'lastname',
    'label' => 'Nom',
    'value' => isset($user->lastname) ? $user->lastname : '',
    'error' => isset($user->errors['lastname']) ? $user->errors['lastname'] : ''
));
echo system\Form::text(array(
    'name' => 'firstname',
    'label' => 'Prénom',
    'value' => isset($user->firstname) ? $user->firstname : '',
    'error' => isset($user->errors['firstname']) ? $user->errors['firstname'] : ''
));
echo system\Form::text(array(
    'name' => 'email',
    'label' => 'Email',
    'value' => isset($user->email) ? $user->email : '',
    'error' => isset($user->errors['email']) ? $user->errors['email'] : ''
));
echo system\Form::password(array(
    'name' => 'newPassword',
    'label' => 'Mot de passe',
    'value' => '',
    'error' => isset($user->errors['newPassword']) ? $user->errors['newPassword'] : ''
));
echo system\Form::textarea(array(
    'name' => 'address',
    'label' => 'Adresse',
    'rows' => 5,
    'value' => isset($user->address) ? $user->address : '',
    'error' => isset($user->errors['address']) ? $user->errors['address'] : ''
));
echo system\Form::submit(array(
    'name' => 'submit',
    'label' => 'Enregistrer',
    'value' => 'save',
    'formId' => 'formUser',
    'class' => 'btn-primary'
));
?>
</form>