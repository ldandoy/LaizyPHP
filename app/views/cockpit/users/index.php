<h1 class="page-header">Utilisateurs</h1>
<br />
<div class="">
	<a href="<?php echo system\Router::url('cockpit_users_new'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
</div>
<br />
<table class="table table-hover">
	<thead>
		<tr>
			<th width="1%">ID</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Adresse</th>
			<th width="10%">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($params['users'] as $user) {
    echo '<tr>';
    echo '<td>'.$user->id.'</td>';
    echo '<td>'.trim(implode(' ', array($user->lastname, $user->firstname))).'</td>';
    echo '<td>'.$user->email.'</td>';
    echo '<td>'.$user->address.'</td>';
    echo '<td>';
    echo '<a href="'. system\Router::url("cockpit_users_edit", array('id' => $user->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>';
    echo '<a href="'. system\Router::url("cockpit_users_delete", array('id' => $user->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
	</tbody>
</table>