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

		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/cockpit/">Cockpit</a>
				</div>
<?php if (isset($this->connectedUser) && $this->connectedUser !== null) : ?>
				<div class="pull-right connected-administrator">
					<span><?php echo $this->connectedUser->lastname.' '.$this->connectedUser->firstname; ?></span>
					<a href="<?php echo system\Router::url('cockpit_administrators_logout'); ?>" class="btn btn-danger" title="Se déconnecter"><i class="fa fa-remove"></i></a>
				</div>
				<div class="clearfix"></div>
<?php endif; ?>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<ul class="nav nav-pills nav-stacked" id="nav-menu-left">
						<li>{% link url="cockpit" content="Accueil" %}</li>
						<li>{% link url="cockpit_administrators" content="Administrateurs" %}</li>
						<li>{% link url="cockpit_users" content="Utilisateurs" %}</li>
						<li>{% link url="cockpit_articles" content="Articles" %}</li>
						<li>{% link url="cockpit_pages" content="Pages" %}</li>
						<li>{% link url="cockpit_medias" content="Medias" %}</li>
						<li>
							{% link url="cockpit_catalog_products" content="Catalogue" %}
							<ul class="nav nav-pills nav-stacked nav-menu-left">
								<li>{% link url="cockpit_catalog_products" content="Produits" %}</li>
								<li>{% link url="cockpit_catalog_categories" content="Catégories" %}</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-lg-9">
					<?php echo system\Session::flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
