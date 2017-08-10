<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="icon" href="" type="image/png" />
		<title><?php echo isset($params['title']) ? $params['title'] : Core\Config::$config['GENERAL']['title'] ?></title>
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
						<?php if (Core\Config::getValueG('multisite')) { ?>
							<form action="/cockpit/sites/changehost" method="post" class="navbar-form navbar-left form-site">
								<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
								<div class="form-group">
									<select name="site_id" class="form-control hosts">
										<?php foreach (Core\models\Site::findAll('active = 1') as $key => $value) { ?>
											<option<?php if ($this->site->id == $value->id) { echo ' selected="selected"'; } ?> value="<?php echo $value->id; ?>"><?php echo $value->label; ?></option>
										<?php } ?>
									</select>
								</div>
							</form>
						<?php } ?>

						<?php if ($this->current_administrator !== null) { ?>
							<ul class="nav navbar-nav navbar-right ml-auto">
								<li class="nav-item dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->current_administrator->firstname.' '.$this->current_administrator->lastname; ?> <span class="caret"></span></a>
									<div class="dropdown-menu">
										{% link url="cockpit_auth_administrators_show_<?php echo $this->current_administrator->id; ?>" content="Mon compte" icon="user" class="dropdown-item" %}
										<li role="separator" class="divider"></li>
										{% link url="cockpit_core_sites_index" content="Sites" icon="snowflake-o" class="dropdown-item" %}
										{% link url="cockpit_auth_administrators" content="Administrateurs" icon="user-secret" class="dropdown-item" %}
										{% link url="cockpit_auth_users" content="Utilisateurs" icon="user" class="dropdown-item" %}
										{% link url="cockpit_auth_groups" content="Groupes" icon="users" class="dropdown-item" %}
										{% link url="cockpit_auth_roles" content="Rôles" icon="tasks" class="dropdown-item" %}
										<li role="separator" class="divider">
										{% link url="cockpit_system_config_index" content="Configuration" icon="cogs" class="dropdown-item" %}
										<li role="separator" class="divider"></li>
										{% link url="cockpit_administratorsauth_logout" content="Se déconnecter" hint="Se déconnecter" class="dropdown-item" %}
									</div>
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
								{% link url="cockpit_auth_administrators_show_<?php echo $this->current_administrator->id; ?>" content="<?php echo $this->current_administrator->getFullName(); ?>" icon="user" %}
								<br />
								<?php echo $this->current_administrator->email ?>
							</div>
						<?php } ?>
					</div>

					<div class="clearfix"></div>

					<div class="nav-menu">
						{% link url="cockpit" content=" Accueil" icon="home text-blue" %}
						{% link url="cockpit_cms_menus" content=" Menu <span class='pull-right'><?php echo Cms\models\Menu::count('site_id = '.$this->site->id); ?></span>" icon="bars text-green" %}
						{% link url="cockpit_cms_articles" content=" Articles <span class='pull-right'><?php echo Cms\models\Article::count('site_id = '.$this->site->id); ?></span>" icon="columns text-red" %}
						{% link url="cockpit_cms_pages" content=" Pages <span class='pull-right'><?php echo Cms\models\Page::count('site_id = '.$this->site->id); ?></span>" icon="file-text text-purple" %}
						<div>
							{% link url="cockpit_media_medias" content=" Medias <span class='pull-right'><span class="caret"></span></span>" icon="picture-o text-brown" class="ss-menu" %}
							<div class="nav-ss-menu">
								{% link url="cockpit_media_mediacategories" content=" Catégories de media <span class='pull-right'><?php echo Media\models\MediaCategory::count(); ?></span>" icon="object-group text-brown" %}
								{% link url="cockpit_media_mediaformats" content=" Formats de media <span class='pull-right'><?php echo Media\models\MediaFormat::count(); ?></span>" icon="object-group text-brown" %}
								{% link url="cockpit_media_medias" content=" Medias <span class='pull-right'><?php echo Media\models\Media::count(); ?></span>" icon="picture-o text-brown" %}
							</div>
						</div>
						<div>
							{% link url="cockpit_widget_galleries" content="Widgets <span class='pull-right'><span class='caret'></span></span>" icon="table text-ciel" class="ss-menu" %}
							<div class="nav-ss-menu">
								{% linl url="cockpit_widget_galleries" content=" Galleries" icon="object-group text-ciel" %}
								{% link url="cockpit_widget_sliders" content=" Sliders" icon="object-group text-ciel" %}
							</div>
						</div>
						<div>
							{% link url="cockpit_catalog_products" content=" Catalogue <span class='pull-right'><span class='caret'></span></span>" icon="table text-orange" class="ss-menu" %}
							<div class="nav-ss-menu">
								{% link url="cockpit_catalog_categories" content=" Catégories de produit <span class='pull-right'><?php echo Catalog\models\Category::count(); ?></span>" icon="object-group text-orange" %}
								{% link url="cockpit_catalog_products" content=" Produits <span class='pull-right'><?php echo Catalog\models\Product::count(); ?></span>" icon="product-hunt text-orange" %}
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-10" id="content">
					<?php echo $this->getFlash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$('.hosts').bind('change',function() {
        		$(this).parent().parent().submit();
    		});

			$(document).on('click', '.ss-menu', function(event) {
				event.preventDefault();
				if ($(this).next('div').css('display') == "none") {
					$(this).next('div').show();
				} else {
					$(this).next('div').hide();
				}
			});
		</script>
	</body>
</html>
