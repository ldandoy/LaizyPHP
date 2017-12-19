<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">{{ pageTitle }}</h1>
<?php if (isset($media) && $media !== null): ?>
            <div class="card">
                <div class="card-header">
                    <h5>Medias</h5>
                </div>
                <div class="card-block">
                    <h3>Images</h3>
                    {% input_media options="[aaa:xxx;bbb:yyy]" %}
                    {% media id="50" format="large" %}
                    <img src="<?php echo $media->getUrl(); ?>" />
                    <img src="<?php echo $media->getUrl('large'); ?>" />
                    <img src="<?php echo $media->getUrl('medium'); ?>" />
                    <img src="<?php echo $media->getUrl('small'); ?>" />
                </div>
            </div>
<?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h2>Widget</h2>
                </div>
                <div class="card-block">
                    <h3>Gallery</h3>
                    {% widget type="gallery" id="1" %}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Form helpers</h2>
                    {% input_datetime name="datetime" type="datetime" label="Date / Time" %}
                </div>
                <div class="card-block">
                    <form id="form_test" action="{{ formAction }}" class="form form-horizontal" enctype="multipart/form-data" method="post">
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>HTML helpers</h2>
                </div>
                <div class="card-block">
                    <h3>Button</h3>
                    {% button url="test_index" type="success" content="Bouton test" icon="gear" hint="Bouton test" id="button_test" class="button-test" confirmation="Etes-vous sûr?" %}
                </div>
                <div class="card-block">
                    <h3>Lien</h3>
                    {% link url="test_index" content="Lien test" id="link_test" class="link-test" %}
                </div>
                <div class="card-block">
                    <h3>Image</h3>
                    {% image src="stormtrooper.jpg" id="image_test" class="image-test" %}
                </div>
                <div class="card-block">
                    <h3>Table</h3>
                    {% table dataset="tableTest" id="table_test" class="table-test" %}
                </div>
            </div>
        </div>
    </div>
</div>