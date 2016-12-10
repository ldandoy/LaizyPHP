<h1>Article : <?php echo $params['article']->titre; ?></h1>
<p>
	<?php echo $params['article']->contenu; ?>

	<?php echo $params['article']->user->nom; ?>
</p>
