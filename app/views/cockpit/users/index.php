<h1 class="page-title"><i class="fa fa-users"></i> Utilisateurs</h1>

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Liste des Utilisateurs</h3>

        <div class="box-tools pull-right">
            <a href="<?php echo System\Router::url('cockpit_users_new'); ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="1%">ID</th>
					<th>Nom</th>
					<th>Email</th>
					<th>Adresse</th>
					<th width="10%">Actions</th>
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
    echo '<a href="'.System\Router::url('cockpit_users_edit', array('id' => $user->id)).'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> ';
    echo '<a href="'.System\Router::url('cockpit_users_delete', array('id' => $user->id)).'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>';
    echo '</td>';
    echo '</tr>';
}
?>
			</tbody>
		</table>
	</div>
</div>