<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="icon" href="" type="image/png" />
		<title><?php echo isset($params['title']) ? $params['title'] : system\Config::$config['GENERAL']['title'] ?></title>
		<?php $this->loadCss(); ?>
		<?php $this->loadJs(); ?>
	</head>
	<body id="front">

		<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Titre du site</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo url('articles_index'); ?>">Articles <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if ($this->current_user !== null) { ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->current_user->firstname.' '.$this->current_user->lastname; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="">Mon compte</a></li>
									<li role="separator" class="divider"></li>
									<li>
										<a href="<?php echo url('auth_auth_logout'); ?>" title="Se déconnecter">Se déconnecter</a>
									</li>
								</ul>
							</li>
						<?php } else { ?>
							<li><a href="<?php echo url('auth_auth_login'); ?>" class="" title="Se déconnecter"><i class="fa fa-login"></i> Se connecter</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php echo system\Session::flash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
