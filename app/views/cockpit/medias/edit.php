<h1 class="page-title">{{ pageTitle }}></h1>
<form id="formMedias" method="post" action="{{ formAction }}$" enctype="multipart/form-data" class="form form-horizontal">
	{% input_select name="media_type" model="media.media_type" label="Type" %}
	{% input_text name="name" model="media.name" label="Nom" %}
	{% input_file name="file" model="media.file" label="Fichier" %}
	{% input_submit name="submit" value="save" label="Enregistrer" %}
</form>