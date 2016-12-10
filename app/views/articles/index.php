<h1 class="page-header">Articles :</h1>

<?php 
    foreach ($params['articles'] as $article) {
        echo "<h2>".$article->titre."</h2>";
        echo '<p>'.$article->contenu.'</p>';
    }
?>

<h1 class="page-header">Users :</h1>
<?php 
    foreach ($params['users'] as $user) {
        echo "<h1>".$user->nom.' '.$user->prenom."</h1>";
    }
?>