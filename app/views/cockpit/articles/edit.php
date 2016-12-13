<h1 class="page-header">Editer l'article N° <?php echo $params['id'] ?></h1>

<form action="<?php echo system\Router::url('cockpit_articles_edit', array('id' => $params['id'])); ?>" method="post">
	<?php echo $this->Form->input('title') ?>
	<?php echo $this->Form->textarea('contenu') ?>
	<?php echo $this->Form->submit('send', 'Mettre à jour', 'primary', 'right') ?>
</form>
