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
					<a class="navbar-brand" href="/"><?php echo isset($params['title']) ? $params['title'] : system\Config::$config['GENERAL']['title'] ?></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
<?php foreach ($this->menuitems as $menuitem) { ?>
	<?php if (!empty($menuitem->children)) { ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuitem->label ?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<?php foreach ($menuitem->children as $child) { ?>
					<li <?php if ($this->request->url == $child->link) { ?>class="active"<?php } ?>><a href="<?php echo url($menu->link); ?>"><?php echo $child->label ?></a></li>
				<?php } ?>
			</ul>
		</li>
	<?php } else { ?>
		<li <?php if ($this->request->url == $menuitem->link) { ?>class="active"<?php } ?>><a href="<?php echo url($menuitem->link); ?>"><?php echo $menuitem->label ?></a></li>
	<?php } ?>
<?php
}
?>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<?php if ($this->current_user !== null) { ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<?php if ($this->current_user->media_id !== null): ?>
										<img class="user-avatar" src="<?php echo $this->current_user->media->getUrl(); ?>" />&nbsp;
									<?php endif; ?>
									<?php echo $this->current_user->firstname.' '.$this->current_user->lastname; ?>&nbsp;<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										{% link url="users_edit_"<?php echo $this->current_user->id; ?> content="Mon compte" icon="user" %}
									</li>
									<li role="separator" class="divider"></li>
									<li>
										{% link url="auth_logout" content="Se déconnecter" icon="user-times" %}
									</li>
								</ul>
							</li>
						<?php } else { ?>
							<li>{% link url="auth_login" content="Se connecter" icon="user" %}</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>

		<?php echo $yeslp; ?>
	</body>
</html>
