<?php if(!isset($server_ip)) exit('Erreur: impossible de communiquer avec la base de donn&eacute;es'); ?>
<!DOCTYPE html>
<!--[if IE 8]><html lang="fr" class="ie8"><![endif]-->  
<!--[if IE 9]><html lang="fr" class="ie9"><![endif]-->  
<!--[if !IE]><!--><html lang="fr"><!--<![endif]-->  
<head>
    <title><?php echo $name_server. " &raquo; " .$this->fetch('title'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site web du serveur <?= $name_server; ?>, propulsé par ExtazCMS Reloaded">
    <meta name="author" content="TristanCode">
	
    <link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/nav.css">
	<link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/theme/<?php echo $theme ?>/css/blog.css">
    <?php
    // Favicon
    echo $this->Html->meta('favicon.png', $logo_url, array('type' => 'icon'));

    // CSS Global Compulsory
	echo $this->Html->css('style');
    echo $this->Html->css('404');
    echo $this->Html->css('profile');
    echo $this->Html->css('timeline');
    echo $this->Html->css('summernote');

    // CSS Implementing Plugins
    echo $this->Html->css('/files/line-icons/line-icons');
    echo $this->Html->css('/files/flexslider/flexslider');
    echo $this->Html->css('/files/parallax-slider/css/parallax-slider');
    echo $this->Html->css('/files/sky-forms/css/custom-sky-forms');
    echo $this->Html->css('dropzone');

    // CSS Theme
    echo $this->Html->css('default/default');
    echo $this->Html->css('flatty');

    // CSS Customization
    echo $this->Html->css('custom');
    ?>
    <!-- <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.js"></script>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>	
<body>
    <section class="row top">
        <div class="container">
            <div class="col-sm-8 infos">
                <span class="icon glyphicon glyphicon-play-circle"></span> IP: <a class="top-text server-ip">
				
				  <?php
                    // Si le port est 25565 alors il est inutile de l'afficher
                        if($server_port != 25565 && $server_port != null){
                            echo ''.$server_ip.':'.$server_port.'';
                        }
                        else{
                            echo ''.$server_ip.'';
                        }
                  ?>
				
				
				</a>
            </div>
            </div>
    </section>
	<br>
    <header class="top-head-4" data-sticky="true">
         <div class="container">
            <div class="row"> 
            <p align="center">
					
				<?php if(!empty($banner_url)){ ?>

					<img src="<?php echo $banner_url ?>" class="zoomEffect hatch" style="margin-left: -3px;width:50%;height:50%;">	

				<?php } else { ?>
					
					<img src="/actuality/images/logo.png" class="zoomEffect hatch" style="margin-left: -3px;width:30%;height:30%;">
					
				<?php } ?>	
			    
			</p>
            </div>
        </div>
		<br>
        <div class="container" id="main_nav">
                        <div class="nav-4">
                            <div class="gray-nav">
                            <nav class="top-nav mega-menu news">
                            <ul class="def-effect" id="mnu-eft">
                                <li><a class="btn-menu-rev" href="<?= Router::url("/accueil"); ?>"><span class="btn-menu-rev-span">Accueil</span></a></li>
								<?php if($use_store == 1){ ?>
                                    <li><a class="btn-menu-rev" href="<?= Router::url("/boutique"); ?>"><span class="btn-menu-rev-span">Boutique</span></a></li>
								<?php } ?>
								<?php if($use_votes == 1){ ?>
                                <li><a class="btn-menu-rev" href="<?= Router::url("/votes"); ?>"><span class="btn-menu-rev-span">Votes</span></a></li>
                                <?php } ?>
								<?php if($nb_cpages == 1){ ?>
								<li class="none">
									<?php echo $this->Html->link($cpages[0]['Cpage']['name'], ['controller' => 'cpages', 'action' => 'read', 'slug' => $cpages[0]['Cpage']['slug']]); ?>
								</li>
								<?php } elseif($nb_cpages != 0 && $nb_cpages > 1) { ?>
								<li class="dropdown">
									<a href="javascript:void(0);" class="btn-menu-rev dropdown-toggle" data-toggle="dropdown">
										<span class="btn-menu-rev-span">Autre</span><span class="caret"></span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
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
								<li><a class="btn-menu-rev" href="<?= Router::url("/reglement"); ?>"><span class="btn-menu-rev-span">Règlement</span></a></li>
								<?php } ?>
								<?php if($use_team == 1){ ?>
								<li><a class="btn-menu-rev" href="<?= Router::url("/equipe"); ?>"><span class="btn-menu-rev-span">Équipe</span></a></li>
								<?php } ?>
								<?php if($use_igchat == 1) { ?>
								<li><a class="btn-menu-rev" href="<?= Router::url("/chat"); ?>"><span class="btn-menu-rev-span">Chat IG</span></a></li>
								<?php } ?>
								<li class="dropdown">
											<a href="javascript:void(0);" class="btn-menu-rev dropdown-toggle" data-toggle="dropdown">
											  <span class="btn-menu-rev-span">Support</span><span class="caret"></span>
											</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li>
											<?php echo $this->Html->link('Rediger un ticket', ['controller' => 'pages', 'action' => 'add_ticket']); ?>                             
										</li>
										<li>
											<?php echo $this->Html->link('Consulter mes tickets', ['controller' => 'pages', 'action' => 'list_tickets']); ?>                             
										</li>
									</ul>
								</li>
								<?php if($use_contact == 1){ ?>
								<li><a class="btn-menu-rev" href="<?= Router::url("/contact"); ?>"><span class="btn-menu-rev-span">Contact</span></a></li>
								<?php } ?>
								<?php if($use_faq == 1){ ?>
								<li><a class="btn-menu-rev" href="<?= Router::url("/faq"); ?>"><span class="btn-menu-rev-span">F.A.Q</span></a></li>
								<?php } ?>
								<li><a class="btn-menu-rev" href="<?= Router::url("/cgv"); ?>"><span class="btn-menu-rev-span">CGV/CGU</span></a></li>
                            </ul>
							</nav>
                            </div>
                        </div>
                    </div>
   </header>
<br>
<br>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
        <div class="slider-text slideRight">
                    <h1><font class="dosis-font"><a><font color="#E82C2C" class="dosis-font"><?php echo $name_server. "</a></font> &raquo; " .$this->fetch('title'); ?></font></h1>
          </div>
    </div>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </section>
	
	    <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
		
		        <?php if($happy_hour == 1){ ?>
            <div class="happy-hour">
                <?php
                if($use_paypal == 1 && $use_starpass ==1){
                    ?>
                    <span class="glyphicon glyphicon-chevron-right"></span> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $starpass_tokens.' '.$site_money.' + '.$starpass_happy_hour_bonus.' gratuits '; ?> via Starpass ou <?php echo $paypal_tokens.' '.$site_money.' + '.$paypal_happy_hour_bonus.' gratuits'; ?> via PayPal !
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn-u btn-brd-hover btn-u-green btn-u-xs happy-hour-close rounded-2x"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn-u btn-brd-hover btn-u-red btn-u-xs happy-hour-close rounded-2x"> Fermer !</button>
                    <?php
                }
                elseif($use_paypal == 0 && $use_starpass == 1){
                    ?>
                    <span class="glyphicon glyphicon-chevron-right"></span> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $starpass_tokens.' '.$site_money.' + '.$starpass_happy_hour_bonus.' gratuits '; ?> via Starpass !
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn-u btn-brd-hover btn-u-green btn-u-xs happy-hour-close rounded-2x"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn-u btn-brd-hover btn-u-red btn-u-xs happy-hour-close rounded-2x"> Fermer !</button>
                    <?php
                }
                elseif($use_paypal == 1 && $use_starpass == 0){
                    ?>
                    <span class="glyphicon glyphicon-chevron-right"></span> Happy hour en cours, <?php echo $happy_hour_bonus.'% de '.$site_money.' gratuits'; ?>. Achetez <?php echo $paypal_tokens.' '.$site_money.' + '.$paypal_happy_hour_bonus.' gratuits'; ?> via PayPal !
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'reload']); ?>" class="btn-u btn-brd-hover btn-u-green btn-u-xs happy-hour-close rounded-2x"><i class="fa fa-shopping-cart"></i> Recharger</a>
                    <button class="btn-u btn-brd-hover btn-u-red btn-u-xs happy-hour-close rounded-2x"> Fermer !</button>
                    <?php
                }
                elseif($use_paypal == 0 && $use_starpass == 0){
                    ?>
                    <span class="glyphicon glyphicon-chevron-right"></span> Happy hour en cours... ouai ! C'est bien joli mais aucun moyen de paiement n'est connu dont voila quoi...</b>
                    <button class="btn-u btn-brd-hover btn-u-red btn-u-xs happy-hour-close rounded-2x"> Fermer !</button>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    <br>
            <div class="copyright">
                <div class="container">
                    <p class="text-center">
                        <a href="<?php echo $url_site; ?>"><?php echo $name_server; ?></a> propulsé par <a href="http://extaz-cms.fr">ExtazCMS</a> &copy; <?= date("Y"); ?> Clyese Systems - Tous droits réservés.<br />Lire les <a href='<?php echo $url_site; ?>/cgv'>CGV/CGU</a> du site.<br /><a href="http://riikogdev.fr" target="_blank">Thème par Riikog</a>
                    </p>
                </div> 
            </div><!--/copyright--> 
        </div>   
        <!--=== End Footer ===-->
    <?php
    // JS Global Compulsory
    echo $this->Html->script('/files/bootstrap/js/bootstrap.min');

    // JS Implementing Plugins
    echo $this->Html->script('/files/back-to-top');
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
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    <?php
    if(!empty($analytics) && $analytics != 0){
        ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
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