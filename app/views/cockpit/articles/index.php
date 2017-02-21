<h1 class="page-title">Mes articles</h1>
<br />
<div class="">
	<a href="<?php echo system\Router::url('cockpit_articles_new'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter un article</a>
</div>
<br />
<table class="table table-hover">
	<thead>
		<tr>
			<th width="1%">ID</th>
			<th>Titre</th>
			<th width="10%">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($params['articles'] as $article) {
    echo '<tr>';
    echo '<td>'.$article->id.'</td>';
    echo '<td>'.$article->title.'</td>';
    echo '<td>';
    echo '<a href="'. system\Router::url("cockpit_articles_edit", array('id' => $article->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>';
    echo '<a href="'. system\Router::url("cockpit_articles_delete", array('id' => $article->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
	</tbody>
</table>