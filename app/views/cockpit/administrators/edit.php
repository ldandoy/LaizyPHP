<h1 class="page-title"><?php echo $params['pageTitle']; ?></h1>
<form id="formAdministrator" method="post" action="<?php echo $params['formAction']; ?>" class="form form-horizontal">
<?php
$administrator = $params['administrator'];
echo system\Form::text(array(
    'name' => 'lastname',
    'label' => 'Nom',
    'value' => isset($administrator->lastname) ? $administrator->lastname : '',
    'error' => isset($administrator->errors['lastname']) ? $administrator->errors['lastname'] : ''
));
echo system\Form::text(array(
    'name' => 'firstname',
    'label' => 'Prénom',
    'value' => isset($administrator->firstname) ? $administrator->firstname : '',
    'error' => isset($administrator->errors['firstname']) ? $administrator->errors['firstname'] : ''
));
echo system\Form::text(array(
    'name' => 'email',
    'label' => 'Email',
    'value' => isset($administrator->email) ? $administrator->email : '',
    'error' => isset($administrator->errors['email']) ? $administrator->errors['email'] : ''
));
echo system\Form::password(array(
    'name' => 'newPassword',
    'label' => 'Mot de passe',
    'value' => '',
    'error' => isset($administrator->errors['newPassword']) ? $administrator->errors['newPassword'] : ''
));
echo system\Form::submit(array(
    'name' => 'submit',
    'label' => 'Enregistrer',
    'value' => 'save',
    'formId' => 'formAdministrator',
    'class' => 'btn-primary'
));
?>
</form>