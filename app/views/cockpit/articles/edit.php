<h1 class="page-header">Editer l'article N° <?php echo $params['id'] ?></h1>

<form action="<?php echo system\Router::url('cockpit_articles_update', array('id' => $params['id'])); ?>" method="post">
<?php
echo $this->Form->input(array(
    'label' => 'titre',
    'value' => $params['article']->titre
));
?>
<?php
echo $this->Form->textarea(array(
    'label' => 'contenu',
    'value' => $params['article']->contenu
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
