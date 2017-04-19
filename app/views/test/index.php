<h1 class="page-title">{{ pageTitle }}</h1>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Widget</h2>
	</div>
	<div class="panel-body">
		<h3>Gallery</h3>
		{% widget type="gallery" id="3" %}
	</div>
	<div class="panel-heading">
		<h2>Form helpers</h2>
	</div>
	<div class="panel-body">
		<form id="form_test" action="{{ formAction }}" class="form form-horizontal" enctype="multipart/form-data" method="post">
		</form>
	</div>
	<div class="panel-heading">
		<h2>HTML helpers</h2>
	</div>
	<div class="panel-body">
		<h3>Button</h3>
		{% button url="test_index" type="success" content="Bouton test" icon="gear" hint="Bouton test" id="button_test" class="button-test" confirmation="Etes-vous sûr?" %}
		<h3>Lien</h3>
		{% link url="test_index" content="Lien test" id="link_test" class="link-test" %}
		<h3>Image</h3>
		{% image src="stormtrooper.jpg" id="image_test" class="image-test" %}
		<h3>Table</h3>
		{% table dataset="tableTest" id="table_test" class="table-test" %}
	</div>
</div>
