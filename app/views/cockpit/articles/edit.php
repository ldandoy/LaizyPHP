<h1 class="page-header"><?php echo $params['pageTitle']; ?></h1>
<form action="<?php echo $params['formAction']; ?>" method="post">
<?php
echo $this->Form->input(array(
    'label' => 'title',
    'value' => $params['article']->title
));
?>
<?php
echo $this->Form->textarea(array(
    'label' => 'content',
    'value' => $params['article']->content
));
echo $this->Form->input(array(
    'label' => 'user_id',
    'value' => $params['article']->user_id
));
?>
<?php echo $this->Form->btn(array(
    'label' => 'send',
    'value' => 'Mettre à jour',
    'color' => 'primary',
    'align' => 'right',
    'type'  => 'submit'
))
?>
</form>
