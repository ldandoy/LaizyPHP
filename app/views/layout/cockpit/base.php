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
        <?php if ($this->current_user !== null) { ?>
            <nav class="navbar navbar-expand-md fixed-top navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand col-lg-2" href="/cockpit">Bureau Virtuel de <?php echo $this->site->label; ?></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?php if ($this->current_user->group_id == 1) { ?>
                            <form action="/cockpit/sites/changehost" method="post" class="form-inline form-site my-lg-0">
                                <input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <select name="site_id" id="changeHost" class="form-control hosts">
                                    <?php foreach (Core\models\Site::findAll("active = 1") as $key => $value) { ?>
                                        <?php if ($this->site->id == $value->id) { $site_url = $value->host; } ?>
                                        <option <?php if ($this->site->id == $value->id) { ?>selected="selected"<?php } ?> value="<?php echo $value->id; ?>"><?php echo $value->label; ?>: <?php echo $value->host; ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        <?php } ?>
                        <li class="nav-item">
                            {% button url="<?php echo $this->site->home_page != '' ? $this->site->home_page : '/'; ?>" type="link" icon="eye" content="Voir mon site" newWindow="1" class="preview-site nav-link" %}
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right ml-auto">
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->current_user->firstname.' '.$this->current_user->lastname; ?> <span class="caret"></span></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php if ($this->current_user !== null && $this->current_user->site_id === null) { ?>
                                    {% link url="cockpit_core_sites_index" content="Sites" class="dropdown-item" icon="snowflake-o" %}
                                <?php } else { ?>
                                    {% link url="cockpit_core_sites_show_<?php echo $this->current_user->site_id; ?>" content="Site" class="dropdown-item" icon="snowflake-o" %}
                                <?php } ?>
<!--                                <?php if ($this->current_user !== null && $this->current_user->site_id === null) { ?>
                                    {% link url="cockpit_auth_administrators" content="Administrateurs" class="dropdown-item" icon="user-secret" %}
                                <?php } ?> -->
                                {% link url="cockpit_auth_users" content="Utilisateurs" class="dropdown-item" icon="user" %}
                                <?php if ($this->current_user !== null && $this->current_user->group->code == 'administrators'): ?>
                                    {% link url="cockpit_auth_groups" content="Groupes" class="dropdown-item" icon="users" %}
                                    {% link url="cockpit_auth_roles" content="Rôles" class="dropdown-item" icon="tasks" %}
                                <?php endif; ?>
                                <?php if ($this->current_user !== null && $this->current_user->site_id === null) { ?>
                                    {% link url="cockpit_system_config_index" content="Configuration" class="dropdown-item" icon="cogs" %}
                                <?php } ?>
                                {% link url="usersauth_logout" content="Se déconnecter" icon="power-off fa-orange" class="dropdown-item" %}
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php } ?>

        <div class="container-fluid" style="height: 100%; min-height: 100%;">
            <div class="row" style="height: 100%; min-height: 100%;">
                <div class="col-lg-2" id="nav-menu-left">
                    <div class="user-panel">
                        <div class="pull-left image">
<?php if ($this->current_user->media !== null): ?>
                            <img src="<?php echo $this->current_user->media->getUrl(); ?>" class="img-circle" alt="User Image" />
<?php endif; ?>
                        </div>
                        <?php if ($this->current_user !== null) { ?>
                            <div class="pull-left info">
                                {% link url="cockpit_auth_administrators_show_<?php echo $this->current_user->id; ?>" content="<?php echo $this->current_user->getFullName(); ?>" %}
                                <br />
                                <?php echo $this->current_user->email ?>
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
                                {% link url="cockpit_media_mediacategories" content=" Catégories <span class='pull-right'><?php echo Media\models\MediaCategory::count(); ?></span>" icon="object-group text-brown" %}
                                {% link url="cockpit_media_mediaformats" content=" Formats <span class='pull-right'><?php echo Media\models\MediaFormat::count(); ?></span>" icon="object-group text-brown" %}
                                {% link url="cockpit_media_medias" content=" Medias <span class='pull-right'><?php echo Media\models\Media::count(); ?></span>" icon="picture-o text-brown" %}
                            </div>
                        </div>
                        <div>
                            {% link url="cockpit_widget_galleries" content="Widgets <span class='pull-right'><span class='caret'></span></span>" icon="table text-ciel" class="ss-menu" %}
                            <div class="nav-ss-menu">
                                {% linl url="cockpit_widget_galleries" content=" Galleries" icon="object-group text-ciel" %}
                            </div>
                        </div>
                        <div>
                            {% link url="cockpit_catalog_products" content=" Catalogue <span class='pull-right'><span class='caret'></span></span>" icon="table text-orange" class="ss-menu" %}
                            <div class="nav-ss-menu">
                                {% link url="cockpit_catalog_categories" content=" Catégories <span class='pull-right'><?php echo Catalog\models\ProductCategory::count(); ?></span>" icon="object-group text-orange" %}
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
            $(document).ready(function() {
                $('#changeHost').bind('change',function() {
                    $(this).parent().submit();
                });

                $(document).on('click', '.ss-menu', function(event) {
                    event.preventDefault();
                    if ($(this).next('div').css('display') == "none") {
                        $(this).next('div').show();
                    } else {
                        $(this).next('div').hide();
                    }
                });
            });
        </script>
    </body>
</html>
