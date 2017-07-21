<?php 
//Redirection vers le dossier install
if(!file_exists(ROOT . DS . APP_DIR . DS .'Config'. DS . 'database.php')){
header('Location:' .$_SERVER['name'] .'/install/');
exit();
//Si installation faite - message de prévention
}elseif(file_exists(ROOT . DS . APP_DIR . DS .'Config'. DS . 'database.php') && is_dir(ROOT . DS . 'install')){
echo "<font color='red'>Erreur: Vous devez supprimer votre dossier install ou le renommer! </font><br>";
}
if(!isset($server_ip)) exit('Erreur: impossible de communiquer avec la base de donn&eacute;es'); 
?>
<!DOCTYPE html>
<head>
    <title><?php echo $name_server. " &raquo; " .$this->fetch('title'); ?> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site web du serveur <?php echo $name_server; ?>, propulsé par ExtazCMS">
    <meta name="author" content="ExtazCMS">
    <?php
        // Favicon
        echo $this->Html->meta('favicon.png', $logo_url, array('type' => 'icon'));
        // CSS Global Compulsory
        echo $this->Html->css('/files/bootstrap/css/bootstrap.min');
        echo $this->Html->css('/files/font-awesome/css/font-awesome.min');
        echo $this->Html->css('style');
        echo $this->Html->css('404');
        echo $this->Html->css('blog');
        echo $this->Html->css('profile');
        echo $this->Html->css('timeline');
        echo $this->Html->css('summernote');
        //JS
        echo $this->Html->script('admin/jquery-2.1.1');
        // CSS Implementing Plugins
        echo $this->Html->css('/files/line-icons/line-icons');
        echo $this->Html->css('/files/flexslider/flexslider');
        echo $this->Html->css('/files/parallax-slider/css/parallax-slider');
        echo $this->Html->css('/files/sky-forms/css/custom-sky-forms');
        echo $this->Html->css('dropzone');
        // CSS Theme
        echo $this->Html->css('themes/default');
        echo $this->Html->css('flatty');
        // CSS Customization
        echo $this->Html->css('custom');
    ?>
    <link href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.js"></script>
</head>
<?php
if(isset($_GET['debug'])) {
    echo "Version $version";
    exit();
}
?>
<body cz-shortcut-listen="true" class="boxed-layout container" background="<?php echo $this->webroot.'img/bg/'.$background; ?>">
    <div class="wrapper">
        <!--Header-->    
        <div class="header header-v4">
            <!-- Topbar -->
            <div class="topbar-v1 sm-margin-bottom-20">
                <div class="container">
                    <div class="row">
                        <!-- Topbar -->
                        <div class="topbar">
                            <div class="container">
                                <!-- Topbar Navigation -->
                                <div class="topbar-server-ip">
                                    <?php
                                    // Si le port est 25565 alors il est inutile de l'afficher
                                    if(!empty($server_ip)){
                                        if($server_port != 25565 && $server_port != null){
                                            echo '<i class="fa fa-wifi"></i> '.$xml->header->message_1.' : <span class="server-ip">'.$server_ip.':'.$server_port.'</span>';
                                        }
                                        else{
                                            echo '<i class="fa fa-wifi"></i> '.$xml->header->message_1.' : <span class="server-ip">'.$server_ip.'</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- End Topbar Navigation -->
                            </div>
                        </div>
                        <!-- End Topbar -->
                    </div>
                <?php if(!empty($banner_url)){ ?>
                    <center><a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'index']); ?>"><img class="img-responsive" src="<?php echo $banner_url; ?>" alt="Top banner"></a></center><br /> 
                <?php } else { ?>
                    <center><a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'index']); ?>"><img class="img-responsive" src="<?php echo $this->webroot.'banner.png'; ?>" alt="Default banner"></a></center><br />
                <?php } ?>  
                </div>
            </div>
            <!-- End Topbar -->
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars"></span>
                        </button>
                    </div>
                </div>          
                <!-- End Search Block -->
                <div class="clearfix"></div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="container">
                        <ul class="nav navbar-nav">
                            <li class="none">
                                <?php echo $this->Html->link('Accueil', '/'); ?>
                            </li>
                            <?php if($use_store == 1){ ?>
                            <li class="none">
                                <?php echo $this->Html->link('Boutique', ['controller' => 'shops', 'action' => 'index']); ?>
                            </li>
                            <?php } ?>
                            <?php if($use_votes == 1){ ?>
                            <li class="none">
                                <?php echo $this->Html->link('Vote et gagne', ['controller' => 'votes', 'action' => 'index']); ?>
                            </li>
                            <?php } ?>
                            <?php if($nb_cpages == 1){ ?>
                            <li class="none">
                                <?php 
                                    
                                        echo $this->Html->link($cpages[0]['Cpage']['name'], ['controller' => 'cpages', 'action' => 'read', 'slug' => $cpages[0]['Cpage']['slug']]);
                                    ?>
                            </li>
                            <?php } elseif($nb_cpages != 0 && $nb_cpages > 1) { ?>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Autre <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach($cpages as $cp){
                                        ?>
                                            <li>
                                                <?php echo $this->Html->link($cp['Cpage']['name'], ['controller' => 'cpages', 'action' => 'read', 'slug' => $cp['Cpage']['slug']]); ?>
                                            </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if($use_rules == 1){ ?>
                            <li class="none">
                                <?php echo $this->Html->link('Règlement', ['controller' => 'pages', 'action' => 'rules']); ?>
                            </li>
                            <?php } ?>
                            <?php if($use_team == 1){ ?>
                            <li class="none">
                                <?php echo $this->Html->link('Équipe', ['controller' => 'pages', 'action' => 'team']); ?>
                            </li>
                            <?php } ?>
                            <?php if($use_igchat == 1) { ?>
                                <li class="none">
                                    <?php echo $this->Html->link('Chat en Jeu', ['controller' => 'chat', 'action' => 'index']); ?>
                                </li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Support <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo $this->Html->link('Rediger un ticket', ['controller' => 'pages', 'action' => 'add_ticket']); ?>                             
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link('Consulter mes tickets', ['controller' => 'pages', 'action' => 'list_tickets']); ?>                             
                                    </li>
                                    <?php if($use_contact == 1){ ?>
                                        <li class="none">
                                            <?php echo $this->Html->link('Contact', ['controller' => 'pages', 'action' => 'contact']); ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if($use_faq == 1){ ?>
                                <li class="none">
                                    <?php echo $this->Html->link('F.A.Q.', ['controller' => 'faq', 'action' => 'index']); ?>
                                </li>
                            <?php } ?>
                            <li class="none">
                                <?php echo $this->Html->link('CGV/CGU', ['controller' => 'cgv', 'action' => 'cgv']); ?>
                            </li>
                        </ul>
                    </div>    
                </div><!--/navbar-collapse-->
            </div>            
            <!-- End Navbar -->
        </div>
        <!--End Header-->
        <?php if($happy_hour == 1){ ?>
            <div class="happy-hour">
                <?php
                if($use_paypal == 1 && $use_starpass ==1){
                    ?>
                    <i class="fa fa-gift"></i><b> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $starpass_tokens.' '.$site_money.' + '.$starpass_happy_hour_bonus.' gratuits '; ?> via Starpass ou <?php echo $paypal_tokens.' '.$site_money.' + '.$paypal_happy_hour_bonus.' gratuits'; ?> via PayPal !</b>
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn btn-default btn-xs happy-hour-btn"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn btn-default btn-xs happy-hour-close"><i class="fa fa-times"></i></button>
                    <?php
                }
                elseif($use_paypal == 0 && $use_starpass == 1){
                    ?>
                    <i class="fa fa-gift"></i><b> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $starpass_tokens.' '.$site_money.' + '.$starpass_happy_hour_bonus.' gratuits '; ?> via Starpass !</b>
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn btn-default btn-xs happy-hour-btn"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn btn-default btn-xs happy-hour-close"><i class="fa fa-times"></i></button>
                    <?php
                }
                elseif($use_paypal == 1 && $use_starpass == 0){
                    ?>
                    <i class="fa fa-gift"></i><b> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $paypal_tokens.' '.$site_money.' + '.$paypal_happy_hour_bonus.' gratuits'; ?> via PayPal !</b>
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn btn-default btn-xs happy-hour-btn"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn btn-default btn-xs happy-hour-close"><i class="fa fa-times"></i></button>
                    <?php
                }
                elseif($use_paypal == 0 && $use_starpass == 0){
                    ?>
                    <i class="fa fa-gift"></i><b> Happy hour en cours... ouai ! C'est bien joli mais aucun moyen de paiement n'est connu dont voila quoi...</b>
                    <button class="btn btn-default btn-xs happy-hour-close"><i class="fa fa-times"></i></button>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
        
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    
    <!-- Il est interdit de modifier ou suprimer les ligne de code ci dessous -->
            <div class="copyright">
                <div class="container">
                    <p class="text-center">
                        
                      <a href="<?php echo $url_site; ?>"><?php echo $name_server; ?></a> propulsé par <a href="https://extaz-cms.fr">ExtazCMS<br />Lire les <a href='<?php echo $url_site; ?>/cgv'>CGV/CGU</a> du site
                    </p>
                </div> 
            </div><!--/copyright--> 
        </div>   
    <!-- Il est interdit de modifier ou suprimer les ligne de code ci dessus -->
        <!--=== End Footer ===-->
    </div><!--/wrapper-->
    <?php
        // JS Global Compulsory
        echo $this->Html->script('/files/bootstrap/js/bootstrap.min');
        // JS Implementing Plugins
        echo $this->Html->script('/files/flexslider/jquery.flexslider-min');
        echo $this->Html->script('/files/parallax-slider/js/modernizr');
        echo $this->Html->script('/files/parallax-slider/js/jquery.cslider');
        echo $this->Html->script('dropzone');
        // JS Page Level
        echo $this->Html->script('app');
        echo $this->Html->script('jquery.confirm');
        echo $this->Html->script('jquery.bootstrap-growl');
        echo $this->Html->script('index');
        echo $this->Html->script('jquery.autocomplete');
        echo $this->Html->script('summernote');
        echo $this->Html->script('summernote-fr-FR');
        echo $this->Html->script('humane');
        echo $this->Html->script('custom');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            App.init();
            App.initSliders();
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    <?php
    if(!empty($analytics) && $analytics != 0){
        ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', '<?= $analytics; ?>', 'auto');
            ga('send', 'pageview');
        </script>
        <?php
    }
    ?>
    <!--[if lt IE 9]>
        <script src="files/respond.js"></script>
        <script src="files/html5shiv.js"></script>    
    <![endif]-->
</body>
</html> 
