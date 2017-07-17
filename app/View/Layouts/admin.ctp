<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="ExtazCMS Admin">
        <meta name="keywords" content="ExtazCMS">
        <meta name="author" content="ExtazCMS">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ExtazCMS <?php echo $version; ?> - <?php echo $this->fetch('title'); ?></title>
        <?php echo $this->Html->meta('favicon.png', $logo_url, array('type' => 'icon')); ?>
        <?php echo $this->Html->css('admin/bootstrap.min'); ?>
        <?php echo $this->Html->css('/files/font-awesome/css/font-awesome'); ?>
        <?php echo $this->Html->css('admin/plugins/toastr/toastr.min'); ?>
        <?php echo $this->Html->css('admin/plugins/gritter/jquery.gritter'); ?>
        <?php echo $this->Html->css('admin/plugins/dataTables/dataTables.bootstrap'); ?>
        <?php echo $this->Html->css('admin/plugins/dataTables/dataTables.responsive'); ?>
        <?php echo $this->Html->css('admin/plugins/dataTables/dataTables.tableTools.min'); ?>
        <?php echo $this->Html->css('admin/animate'); ?>
        <?php echo $this->Html->css('admin/style'); ?>
        <?php echo $this->Html->css('admin/dropzone'); ?>
        <?php echo $this->Html->css('admin/jquery.selectBoxIt'); ?>
        <?php echo $this->Html->css('admin/custom'); ?>
        <?php echo $this->Html->css('custom'); ?>
        <?php echo $this->Html->script('admin/jquery-2.1.1'); ?>
        <?php echo $this->Html->script('admin/jquery-ui-1.10.4.min'); ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
        <?php echo $this->Html->script('jquery.counterup'); ?>
        <?php echo $this->Html->script('jquery.confirm'); ?>
        <?php echo $this->Html->script('admin/jquery.selectBoxIt'); ?>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.send-command').submit(function(){
                var command = $('#command').val();
                var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'send_command')); ?>';
                $('#loading').attr('class', 'fa fa-spinner fa-spin');
                $.post(url, {command: command}, function(data){
                    $('#command').val('');
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 3000
                    };
                    if(data.result == 'success'){
                        toastr.success(data.message);
                    }
                    else{
                        toastr.error(data.message);
                    }
                    $('#loading').attr('class', 'fa fa-bars');
                }, 'json');
                return false;
            });
        });
        </script>
    </head>
    <body class="fixed-sidebar pace-done">
        <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element center">
                            <span>
                                <?php echo $this->Html->image($avatar, ['alt' => 'Avatar', 'class' => 'img-rounded', 'height' => 40, 'width' => 40]); ?>
                            </span>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'stats', 'admin' => true]); ?>">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold"><?php echo $username; ?></strong>
                                    </span>
                                    <?php if($role > 1): ?>
                                        <span class="text-muted text-xs block">Administrateur</span>
                                    <?php else: ?>
                                        <span class="text-muted text-xs block">Modérateur</span>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            <?php echo $this->Html->image($avatar, ['alt' => 'Avatar', 'class' => 'img-rounded', 'height' => 30, 'width' => 30]); ?>
                        </div>
                    </li>
                    <?php if($role > 1){ ?>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'informations', 'action' => 'index', 'admin' => true]); ?>"><i class="fa fa-wrench"></i> <span class="nav-label">Configuration</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'update', 'action' => 'index', 'admin' => true]); ?>"><i class="fa fa-wrench"></i> <span class="nav-label">Mettre à jour</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'all', 'admin' => true]); ?>"><i class="fa fa-users"></i> <span class="nav-label">Utilisateurs</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'stats', 'admin' => true]); ?>"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistiques</span></a>
                        </li>
                    <?php } ?>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'manage_tickets', 'admin' => true]); ?>"><i class="fa fa-support"></i> <span class="nav-label">Support</span> <span class="label label-success pull-right"><?php echo $nb_tickets_admin; ?></span></a>
                        </li>
                    <?php if($role > 1){ ?>
                        <?php if($api->call('server.bukkit.version')[0]['result'] == 'success'){ ?>
                            <li>
                                <a href="#"><i class="fa fa-cloud"></i> <span class="nav-label">Serveur</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'memory', 'admin' => true]); ?>">Mémoire vive</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'disk', 'admin' => true]); ?>">Disque dur</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'plugins', 'action' => 'index', 'admin' => true]); ?>">Plugins</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'index', 'admin' => true]); ?>">Joueurs</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($use_faq == 1){ ?>
                        <li>
                            <a href="<?php echo $this->Html->url(['controller' => 'faq', 'action' => 'index', 'admin' => true]); ?>"><i class="fa fa-question-circle"></i> <span class="nav-label">F.A.Q</span></a>
                        </li>
                        <?php } ?>
                        <?php if($use_store == 1){ ?>
                            <li>
                                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Boutique</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'add', 'admin' => true]); ?>">Ajouter un produit</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'add_shop_categories', 'admin' => true]); ?>">Ajouter une catégorie</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'list', 'admin' => true]); ?>">Liste des produits</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_shop_categories', 'admin' => true]); ?>">Liste des catégories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-heart"></i> <span class="nav-label">Donateurs</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'donator', 'admin' => true]); ?>">Graphique</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_donator', 'admin' => true]); ?>">Liste</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Actualités</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'add', 'admin' => true]); ?>">Ajouter</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'list', 'admin' => true]); ?>">Liste</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'drafts', 'admin' => true]); ?>">Brouillons</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-comments-o"></i> <span class="nav-label">Commentaires</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo $this->Html->url(['controller' => 'comments', 'action' => 'list', 'admin' => true]); ?>">Liste</a></li>
                            </ul>
                        </li>
                    <?php if($role > 1){ ?>
                        <?php if($use_store == 1){ ?>
                            <li>
                                <a href="#"><i class="fa fa-history"></i> <span class="nav-label">Historiques</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'send_tokens_history', 'admin' => true]); ?>">Transactions</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'shop_history', 'admin' => true]); ?>">Boutique</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'starpass_history', 'admin' => true]); ?>">Starpass</a></li>
                                    <?php if($use_paypal == 1){ ?>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'paypal_history', 'admin' => true]); ?>">PayPal</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-suitcase"></i> <span class="nav-label">Equipe</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'add_member', 'admin' => true]); ?>">Ajouter un membre</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]); ?>">Liste des membres</a></li>
                            </ul>
                        </li>
                        <?php if($use_store == 1){ ?>
                            <li>
                                <a href="#"><i class="fa fa-gift"></i> <span class="nav-label">Codes</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'codes', 'action' => 'generate', 'admin' => true]); ?>">Générer</a></li>
                                    <li><a href="<?php echo $this->Html->url(['controller' => 'codes', 'action' => 'list', 'admin' => true]); ?>">Liste</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-photo"></i> <span class="nav-label">Theme</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo $this->Html->url(['controller' => 'informations', 'action' => 'background', 'admin' => true]); ?>">Background</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'index', 'admin' => true]); ?>">Boutons</a></li>
                                <li>
                                    <a href="#">Widgets <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level collapse">
                                        <li><a href="<?php echo $this->Html->url(['controller' => 'widgets', 'action' => 'add', 'admin' => true]); ?>">Ajouter</a></li>
                                        <li><a href="<?php echo $this->Html->url(['controller' => 'widgets', 'action' => 'list', 'admin' => true]); ?>">Liste</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'add_redirection', 'admin' => true]); ?>">Redirection</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'add', 'admin' => true]); ?>">Créer</a></li>
                                <li><a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'list', 'admin' => true]); ?>">Liste</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                        <?php if($api->call('server.bukkit.version')[0]['result'] == 'success'){ ?>
                            <li>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'chat_messages', 'admin' => true]); ?>"><i class="fa fa-comments"></i> <span class="nav-label">Chat</span></a>
                            </li>
                        <?php } ?>
                        <li class="landing_link">
                            <a target="_blank" href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'index', 'admin' => false]); ?>"><i class="fa fa-star"></i> <span class="nav-label">Retour au site</span></a>
                        </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars" id="loading"></i> </a>
                <?php if($api->call('server.bukkit.version')[0]['result'] == 'success'){ ?>
                <div class="navbar-header">
                    <form class="navbar-form-custom send-command">
                        <div class="form-group">
                            <input type="text" placeholder="Envoyer une commande au serveur..." class="form-control" id="command">
                        </div>
                    </form>
                </div>
                <?php } ?>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'logout', 'admin' => false]); ?>">
                            <i class="fa fa-sign-out"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </nav>
            </div>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>

        <!-- Mainly scripts -->
        <?php echo $this->Html->script('admin/bootstrap.min'); ?>
        <?php echo $this->Html->script('admin/plugins/metisMenu/jquery.metisMenu'); ?>
        <?php echo $this->Html->script('admin/plugins/slimscroll/jquery.slimscroll.min'); ?>

        <!-- Flot -->
        <?php echo $this->Html->script('admin/plugins/flot/jquery.flot'); ?>
        <?php echo $this->Html->script('admin/plugins/flot/jquery.flot.tooltip.min'); ?>
        <?php echo $this->Html->script('admin/plugins/flot/jquery.flot.spline'); ?>
        <?php echo $this->Html->script('admin/plugins/flot/jquery.flot.resize'); ?>
        <?php echo $this->Html->script('admin/plugins/flot/jquery.flot.pie'); ?>

        <!-- Peity -->
        <?php echo $this->Html->script('admin/plugins/peity/jquery.peity.min'); ?>
        <?php echo $this->Html->script('admin/demo/peity-demo'); ?>

        <!-- Custom and plugin javascript -->
        <?php echo $this->Html->script('admin/inspinia'); ?>
        <?php
        if($this->request->params['action'] != 'admin_chat_messages'){
            echo $this->Html->script('admin/plugins/pace/pace.min');
        }
        ?>
        
        <!-- Sparkline -->
        <?php echo $this->Html->script('admin/plugins/sparkline/jquery.sparkline.min'); ?>

        <!-- Sparkline demo data  -->
        <?php echo $this->Html->script('admin/demo/sparkline-demo'); ?>

        <!-- ChartJS-->
        <?php echo $this->Html->script('admin/plugins/chartJs/Chart.min'); ?>

        <!-- Toastr -->
        <?php echo $this->Html->script('admin/plugins/toastr/toastr.min'); ?>

         <!-- Gritter -->
        <?php echo $this->Html->script('admin/plugins/gritter/jquery.gritter.min'); ?>

        <!-- Idle Timer plugin -->
        <?php echo $this->Html->script('admin/plugins/idle-timer/idle-timer.min'); ?>

        <!-- Datatable -->
        <?php echo $this->Html->script('admin/plugins/dataTables/jquery.dataTables'); ?>
        <?php echo $this->Html->script('admin/plugins/dataTables/dataTables.bootstrap'); ?>
        <?php echo $this->Html->script('admin/plugins/dataTables/dataTables.responsive'); ?>
        <?php echo $this->Html->script('admin/plugins/dataTables/dataTables.tableTools.min'); ?>

        <!-- CounterUP -->
        <?php echo $this->Html->script('jquery.counterup'); ?>

        <!-- Autocomplete -->
        <?php echo $this->Html->script('jquery.autocomplete'); ?>
        
       

        <!-- Dropzone -->
        <?php echo $this->Html->script('admin/dropzone'); ?>

        <script src="https://cdn.ckeditor.com/4.5.1/full/ckeditor.js"></script>

    </body>
</html>
</script>