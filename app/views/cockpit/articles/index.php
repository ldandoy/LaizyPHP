<h1 class="page-title"><i class="fa fa-columns"></i> Mes articles</h1>

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Liste des Utilisateurs</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo system\Router::url('cockpit_articles_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
					<th>Titre</th>
					<th width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($params['articles'] as $article) {
    echo '<tr>';
    echo '<td>'.$article->id.'</td>';
    echo '<td>'.$article->title.'</td>';
    echo '<td>';
    echo '<a href="'. system\Router::url("cockpit_articles_edit", array('id' => $article->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> ';
    echo '<a href="'. system\Router::url("cockpit_articles_delete", array('id' => $article->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
			</tbody>
		</table>
	</div>
</div>