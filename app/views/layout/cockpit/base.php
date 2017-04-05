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
			<div class="row">
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
						{% link url="cockpit" content="<i class='fa fa-home'></i>&nbsp; Accueil" %}
						{% link url="cockpit_cms_menus" content="<i class='fa fa-bars'></i>&nbsp; Menu" %}
						{% link url="cockpit_auth_administrators" content="<i class='fa fa-user-secret'></i>&nbsp; Administrateurs" %}
						{% link url="cockpit_auth_users" content="<i class='fa fa-users'></i>&nbsp; Utilisateurs" %}
						{% link url="cockpit_cms_articles" content="<i class='fa fa-columns'></i>&nbsp; Articles" %}
						{% link url="cockpit_cms_pages" content="<i class='fa fa-file-text'></i>&nbsp; Pages" %}
						{% link url="cockpit_media_medias" content="<i class='fa fa-picture-o'></i>&nbsp; Medias" %}
						{% link url="cockpit_catalog_products" content="<i class='fa fa-table'></i>&nbsp; Catalogue" %}
						<div class="nav-menu-1">
							{% link url="cockpit_catalog_products" content="<i class='fa fa-product-hunt'></i>&nbsp; Produits <span class="pull-right">12</span>" %}
							{% link url="cockpit_catalog_categories" content="<i class='fa fa-object-group'></i>&nbsp; Catégories" %}
						</div>
					</div>
				</div>
				<div class="col-lg-10" id="content">
					<?php echo system\Session::flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
