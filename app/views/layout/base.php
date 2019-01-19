<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <link rel="icon" href="/assets/images/logo-lazyphp-32px.png" type="image/png" />
        <title><?php echo isset($params['title']) ? $params['title'] : Core\Config::$config['GENERAL']['title'] ?></title>
        <?php $this->loadCss(); ?>
        <?php $this->loadJs(); ?>
    </head>
    <body id="front">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-faded">
            <div class="container position-navbar">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->site->home_page; ?>">
                    <img src="<?php echo $this->site->brand_logo; ?>" alt="Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php $this->mainMenu->render(); ?>
                </div>
            </div>
        </nav>

        <?php echo $this->getFlash(); ?>
        <?php echo $yeslp; ?>
    </body>
</html>
