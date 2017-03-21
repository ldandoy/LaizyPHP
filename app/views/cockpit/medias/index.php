<h1 class="page-title">Medias</h1>
<div>
	{% button url="cockpit_administrators_new" type="success" content="Ajouter un media" icon="plus" %}
	{% button url="cockpit_administrators_new" type="danger" content="Test button" icon="gear" id="button_test" class="button-class" %}
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th width="1%">ID</th>
			<th>Nom</th>
			<th>Email</th>
			<th width="10%">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($params['administrators'] as $administrator) {
	echo '<tr>';
	echo '<td>'.$administrator->id.'</td>';
	echo '<td>'.trim(implode(' ', array($administrator->lastname, $administrator->firstname))).'</td>';
	echo '<td>'.$administrator->email.'</td>';
	echo '<td>';
	echo '<a href="'.system\Router::url('cockpit_administrators_edit', array('id' => $administrator->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>';
	echo '<a href="'.system\Router::url('cockpit_administrators_delete', array('id' => $administrator->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
	echo '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>