<h1 class="page-header">Editer l'article N° <?php echo $params['id'] ?></h1>

<form action="<?php echo system\Router::url('cokpit_articles_edit', array('id' => $params['id'])); ?>">
	<?php echo $this->Form->input('title') ?>
	<?php echo $this->Form->textarea('contenu') ?>
</form>