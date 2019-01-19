<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="icon" href="/assets/images/logo-lazyphp-32px.png" type="image/png" />
		<title><?php echo isset($params['title']) ? $params['title'] : core\Config::$config['GENERAL']['title'] ?></title>
		<?php $this->loadCss(); ?>
		<?php $this->loadJs(); ?>
	</head>
	<body id="login">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php echo $this->getFlash(); ?>
					<?php echo $yeslp; ?>
				</div>
			</div>
		</div>
	</body>
</html>
