<h1 class="page-title"><?php echo $params['pageTitle'] ?></h1>
<form id="loginForm" class="form form-horizontal" action="<?php echo $params['formAction']; ?>" method="post">
<?php
echo system\Form::text(array(
    'name' => 'email',
    'label' => 'Login',
    'value' => $params['email']
));
echo system\Form::password(array(
    'name' => 'password',
    'label' => 'Mot de passe'
));
echo system\Form::submit(array(
    'name' => 'login',
    'label' => 'Se connecter',
    'formId' => 'loginForm',
    'value' => 'login',
    'type' => 'primary'
));
?>
</form>
