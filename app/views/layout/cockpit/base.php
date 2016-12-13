<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="icon" href="" type="image/png" />
		<title><?php echo isset($params['title']) ? $params['title'] : \system\Config::$config['GENERAL']['title'] ?></title>
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
					<a class="navbar-brand" href="/">Cockpit</a>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<ul class="nav nav-pills nav-stacked nav-menu-left">
						<li role="presentation" class="active"><a href="<?php echo system\Router::url('cockpit'); ?>">Accueil</a></li>
						<li role="presentation"><a href="<?php echo system\Router::url('cockpit_pages_index'); ?>">Pages</a></li>
					</ul>
				</div>
				<div class="col-lg-9">
					<?php echo $this->Session->flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
