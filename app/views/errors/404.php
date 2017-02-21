<header>
	<h1 class="page-title"><?php echo $params['title']; ?></h1>
</header>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2><?php echo $params['title']; ?></h2>
			<div class="well"><?php echo $params['message']; ?></div>
			<h2>Request</h2>
			<pre>
<?php
    print_r($this->request);
?>
			</pre>
		</div>
	</div>
</div>