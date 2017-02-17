<h1 class="page-header"><?php echo $params['pageTitle']; ?></h1>
<form action="<?php echo $params['formAction']; ?>" method="post">
<?php
echo $this->Form->input(array(
    'label' => 'email',
    'value' => $params['administrator']->email
));
echo $this->Form->input(array(
    'label' => 'lastname',
    'value' => $params['administrator']->lastname
));
echo $this->Form->input(array(
    'label' => 'firstname',
    'value' => $params['administrator']->firstname
));
echo $this->Form->btn(array(
    'label' => 'send',
    'value' => 'Mettre à jour',
    'color' => 'primary',
    'align' => 'right',
    'type'  => 'submit'
))
?>
</form>
