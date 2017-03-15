<h1 class="page-title">{{ pageTitle }}</h1>
<form id="formLogin" method="post" action="<?php echo $params['formAction']; ?>" class="form form-horizontal">
    {% input_text name="email" model="email" label="Identifiant" %}
    {% input_password name="password" model="password" value="" label="Mot de passe" autocomplete="off" %}
    {% input_submit name="submit" value="login" formId="formLogin" label="Se connecter" class="btn-primary" %}

<?php
/*echo system\Form::text(array(
	'name' => 'email',
	'label' => 'Identifiant',
	'value' => isset($params['email']) ? $params['email'] : '',
	'error' => isset($params['errors']['email']) ? $params['errors']['email'] : ''
));
echo system\Form::password(array(
	'name' => 'password',
	'label' => 'Mot de passe',
	'value' => '',
	'error' => isset($params['errors']['password']) ? $params['errors']['password'] : ''
));
echo system\Form::submit(array(
	'name' => 'submit',
	'label' => 'Se connecter',
	'value' => 'login',
	'formId' => 'formLogin',
	'class' => 'btn-primary'
));*/
?>
</form>

<p>
	Pas encore de compte? <a href="<?php echo system\Router::url('user_signup'); ?>">S'inscrire</a>
</p>