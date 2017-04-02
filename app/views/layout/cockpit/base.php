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
						<?php if ($this->current_administrator !== null) { ?>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->current_administrator->firstname.' '.$this->current_administrator->lastname; ?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="">Mon compte</a></li>
										<li role="separator" class="divider"></li>
										<li>
											<a href="<?php echo system\Router::url('cockpit_administratorsauth_logout'); ?>" title="Se déconnecter">Se déconnecter</a>
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
			<div class="row">
				<div class="col-lg-2" id="nav-menu-left">
					<div class="title">
						<?php if ($this->current_administrator !== null) { ?>
							<a href="#" class=""><?php echo $this->current_administrator->firstname.' '.$this->current_administrator->lastname; ?></a>
						<?php } ?>
					</div>
					<ul class="nav nav-pills nav-stacked">
						<li>{% link url="cockpit" content="Accueil" %}</li>
						<li>{% link url="cockpit_administrators" content="Administrateurs" %}</li>
						<li>{% link url="cockpit_users" content="Utilisateurs" %}</li>
						<li>{% link url="cockpit_articles" content="Articles" %}</li>
						<li>{% link url="cockpit_pages" content="Pages" %}</li>
						<li>{% link url="cockpit_media_medias" content="Medias" %}</li>
						<li>
							{% link url="cockpit_catalog_products" content="Catalogue" %}
							<ul class="nav nav-pills nav-stacked under-menu-1">
								<li>{% link url="cockpit_catalog_products" content="Produits" %}</li>
								<li>{% link url="cockpit_catalog_categories" content="Catégories" %}</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-lg-10" id="content">
					<?php echo system\Session::flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
