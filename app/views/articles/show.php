{% title titre %}

<p><?php echo $params['article']->contenu; ?></p>

<p>Par <?php echo $params['article']->user->prenom; ?> <?php echo $params['article']->user->nom; ?></p>
