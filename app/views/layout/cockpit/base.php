<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="icon" href="" type="image/png" />
		<title><?php echo isset($params['title']) ? $params['title'] : system\Config::$config['GENERAL']['title'] ?></title>
		<?php $this->loadCss(); ?>
		<?php $this->loadJs(); ?>
	</head>
	<body id="cockpit">
		<nav class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="/cockpit/">Cockpit</a>
						</div>
					</div>
				
					<div class="col-lg-10">
						<?php if (system\Config::getValueG('multisite')) { ?>
							<form action="/cockpit/multisite/changehost" method="post" class="navbar-form navbar-left form-site">
								<div class="form-group">
									<select name="site_id" class="form-control hosts">
										<?php foreach (MultiSite\models\Site::findAll() as $key => $value) { ?>
											<option <?php if (System\Session::get('site_id') == $value->id) { ?>selected="selected"<?php } ?> value="<?php echo $value->id; ?>"><?php echo $value->label; ?></option>
										<?php } ?>
									</select>
								</div>
							</form>
						<?php } ?>

						<?php if ($this->current_administrator !== null) { ?>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->current_administrator->firstname.' '.$this->current_administrator->lastname; ?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="">Mon compte</a></li>
										<li role="separator" class="divider"></li>
										<li>{% link url="cockpit_multisite_sites_index" content="Sites" icon="snowflake-o" %}</li>
										<li>{% link url="cockpit_auth_administrators" content="Administrateurs" icon="user-secret" %}</li>
										<li>{% link url="cockpit_auth_users" content="Utilisateurs" icon="users" %}</li>
										<li role="separator" class="divider"></li>
										<li>
											<a href="<?php echo url('cockpit_administratorsauth_logout'); ?>" title="Se déconnecter">Se déconnecter</a>
										</li>
									</ul>
								</li>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row" style="height: 100%; min-height: 100%;">
				<div class="col-lg-2" id="nav-menu-left">
					<div class="user-panel">
						<div class="pull-left image">
							<img src="/assets/images/cockpit/user2-160x160.jpg" class="img-circle" alt="User Image" />
						</div>
						<?php if ($this->current_administrator !== null) { ?>
							<div class="pull-left info">
								<a href="#" class=""><?php echo $this->current_administrator->firstname.' '.$this->current_administrator->lastname; ?></a>
								<br />
								<?php echo $this->current_administrator->email ?>
							</div>
						<?php } ?>
					</div>

					<div class="clearfix"></div>

					<div class="nav-menu">
						{% link url="cockpit" content=" Accueil" icon="home" %}
						{% link url="cockpit_cms_menus" content=" Menu" icon="bars" %}
						{% link url="cockpit_cms_articles" content=" Articles" icon="columns" %}
						{% link url="cockpit_cms_pages" content=" Pages" icon="file-text" %}
						{% link url="cockpit_media_medias" content=" Medias" icon="picture-o" %}
						{% link url="cockpit_widget_galleries" content=" Widgets" icon="table" %}
						<div class="nav-menu-1">
							{% link url="cockpit_widget_galleries" content=" Galleries" icon="object-group" %}
							{% link url="cockpit_widget_sliders" content=" Sliders" icon="object-group" %}
						</div>
						{% link url="cockpit_catalog_products" content=" Catalogue" icon="table" %}
						<div class="nav-menu-1">
							{% link url="cockpit_catalog_categories" content=" Catégories" icon="object-group" %}
							{% link url="cockpit_catalog_products" content=" Produits <span class='pull-right'>12</span>" icon="product-hunt" %}
						</div>
					</div>
				</div>
				<div class="col-lg-10" id="content">
					<?php echo system\Session::flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			
			$('.hosts').bind('change',function() {
        		$(this).parent().parent().submit();
    		});

		</script>
	</body>
</html>
