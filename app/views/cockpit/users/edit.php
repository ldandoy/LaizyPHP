<h1 class="page-title"><?php echo $params['pageTitle']; ?></h1>
<form action="<?php echo $params['formAction']; ?>" method="post">
<?php
echo $this->Form->input(array(
    'label' => 'email',
    'value' => $params['user']->email
));
echo $this->Form->input(array(
    'label' => 'lastname',
    'value' => $params['user']->lastname
));
echo $this->Form->input(array(
    'label' => 'firstname',
    'value' => $params['user']->firstname
));
echo $this->Form->textarea(array(
    'label' => 'address',
    'value' => $params['user']->address
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
