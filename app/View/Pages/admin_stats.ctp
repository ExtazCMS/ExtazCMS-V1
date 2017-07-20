<?php echo $this->assign('title', 'Statistiques'); ?>
<script>
$(document).ready(function($){
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-6">
            <?php

	    if ($last_version == null) {
                echo "<div class='alert alert-danger'>Impossible de joindre le serveur de mise à jour.<br> Si le problème persiste veuillez ouvrir une <a href=\"https://extaz-cms.fr/forum/\">demande d'aide sur notre forum</a> <br><br><a  class='btn btn-sm btn-danger r' onclick='window.location.reload(false)'><i class='fa fa-wrench'></i>Réessayer</a><br></div>";
            } else {
		$comp = version_compare($version, $last_version);
		if($comp == 0) {
                    echo "<div class='alert alert-info'>Votre CMS est à jour ! Version : {$version}</div>";
                } else if ($comp < 0) {
                    echo "<div class='alert alert-danger'>Votre CMS n'est plus à jour! Télécharger la dernière version {$last_version}<br><br><a href='./admin/update' class='btn btn-sm btn-danger r'><i class='fa fa-wrench'></i> Mettre à jour</a></div>";
                } else {
		    echo "<div class='alert alert-info'>Votre CMS est en avance ! Votre version : {$version}, la dernière disponible : {$last_version} <br></div>";
		}
	    }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Achats boutique aujourd'hui</span>
                            <?php if($use_store == 1){ ?>
                                <h2 class="font-bold counter">
                                    <?php echo $achatsAujourdhui; ?>
                                </h2>
                                <?php } else { ?>
                                <h2 class="font-bold">
                                    Désactivé
                                </h2>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-eur fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Achats Starpass aujourd'hui</span>
                            <?php if($use_starpass == 1) { ?>
                                <h2 class="font-bold counter">
                                    <?php echo $starpassAujourdhui; ?>
                                </h2>
                                <?php } else { ?>
                                <h2 class="font-bold">
                                    Désactivé
                                </h2>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($use_paypal == 1){ ?>
                <div class="col-md-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-paypal fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Achats PayPal aujourd'hui</span>
                            <?php if($use_store == 1){ ?>
                                <h2 class="font-bold counter">
                                    <?php echo $paypalAujourdhui; ?>
                                </h2>
                                <?php } else { ?>
                                <h2 class="font-bold">
                                    Désactivé
                                </h2>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-paypal fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Achats PayPal aujourd'hui</span>
                                <h2 class="font-bold">Désactivé</h2>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Utilisateurs inscrits aujourd'hui</span>
                            <h2 class="font-bold counter"><?php echo $utilisateursAujourdhui; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if($use_store == 1){ ?>
                <hr>
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th><center>Achats boutique</center></th>
                            <th><center>Achats Starpass</center></th>
                            <?php if($use_paypal == 1){ ?>
                            <th><center>Achats PayPal</center></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total</td>
                            <td><center><?php echo $achatsDepuisToujours; ?></center></td>
                            <td><center><?php echo $starpassDepuisToujours; ?></center></td>
                            <?php if($use_paypal == 1){ ?>
                            <td><center><?php echo $paypalDepuisToujours; ?></center></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Les 7 derniers jours</td>
                            <td><center><?php echo $achatsCetteSemaine; ?></center></td>
                            <td><center><?php echo $starpassCetteSemaine; ?></center></td>
                            <?php if($use_paypal == 1){ ?>
                            <td><center><?php echo $paypalCetteSemaine; ?></center></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Aujourd'hui</td>
                            <td>
                                <center>
                                    <?php
                                    $achatsDifference = $achatsAujourdhui - $achatsHier;
                                    if($achatsAujourdhui == $achatsHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$achatsAujourdhui.' (+0)</span>';
                                    }
                                    elseif($achatsAujourdhui < $achatsHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$achatsAujourdhui.' ('.$achatsDifference.')</span>';
                                    }
                                    elseif($achatsAujourdhui > $achatsHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$achatsAujourdhui.' (+'.$achatsDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php
                                    $starpassDifference = $starpassAujourdhui - $starpassHier;
                                    if($starpassAujourdhui == $starpassHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$starpassAujourdhui.' (+0)</span>';
                                    }
                                    elseif($starpassAujourdhui < $starpassHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$starpassAujourdhui.' ('.$starpassDifference.')</span>';
                                    }
                                    elseif($starpassAujourdhui > $starpassHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$starpassAujourdhui.' (+'.$starpassDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                            <?php if($use_paypal == 1){ ?>
                            <td>
                                <center>
                                    <?php
                                    $paypalDifference = $paypalAujourdhui - $paypalHier;
                                    if($paypalAujourdhui == $paypalHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$paypalAujourdhui.' (+0)</span>';
                                    }
                                    elseif($paypalAujourdhui < $paypalHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$paypalAujourdhui.' ('.$paypalDifference.')</span>';
                                    }
                                    elseif($paypalAujourdhui > $paypalHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$paypalAujourdhui.' (+'.$paypalDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Hier</td>
                            <td><center><?php echo $achatsHier; ?></center></td>
                            <td><center><?php echo $starpassHier; ?></center></td>
                            <?php if($use_paypal == 1){ ?>
                            <td><center><?php echo $paypalHier; ?></center></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
                <hr>
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th><center>Utilisateurs inscrits</center></th>
                            <th><center>Nombre de tickets support</center></th>
                            <th><center>Nombre de réponses aux tickets</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total</td>
                            <td><center><?php echo $utilisateursDepuisToujours; ?></center></td>
                            <td><center><?php echo $ticketsDepuisToujours; ?></center></td>
                            <td><center><?php echo $reponsesDepuisToujours; ?></center></td>
                        </tr>
                        <tr>
                            <td>Les 7 derniers jours</td>
                            <td><center><?php echo $utilisateursCetteSemaine; ?></center></td>
                            <td><center><?php echo $ticketsCetteSemaine; ?></center></td>
                            <td><center><?php echo $reponsesCetteSemaine; ?></center></td>
                        </tr>
                        <tr>
                            <td>Aujourd'hui</td>
                            <td>
                                <center>
                                    <?php
                                    $utilisateursDifference = $utilisateursAujourdhui - $utilisateursHier;
                                    if($utilisateursAujourdhui == $utilisateursHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$utilisateursAujourdhui.' (+0)</span>';
                                    }
                                    elseif($utilisateursAujourdhui < $utilisateursHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$utilisateursAujourdhui.' ('.$utilisateursDifference.')</span>';
                                    }
                                    elseif($utilisateursAujourdhui > $utilisateursHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$utilisateursAujourdhui.' (+'.$utilisateursDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php
                                    $ticketsDifference = $ticketsAujourdhui - $ticketsHier;
                                    if($ticketsAujourdhui == $ticketsHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$ticketsAujourdhui.' (+0)</span>';
                                    }
                                    elseif($ticketsAujourdhui < $ticketsHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$ticketsAujourdhui.' ('.$ticketsDifference.')</span>';
                                    }
                                    elseif($ticketsAujourdhui > $ticketsHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$ticketsAujourdhui.' (+'.$ticketsDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php
                                    $reponsesDifference = $reponsesAujourdhui - $reponsesHier;
                                    if($reponsesAujourdhui == $reponsesHier){
                                        echo '<span class="badge badge-plain"><i class="fa fa-exchange"></i> '.$reponsesAujourdhui.' (+0)</span>';
                                    }
                                    elseif($reponsesAujourdhui < $reponsesHier){
                                        echo '<span class="badge badge-danger"><i class="fa fa-arrow-circle-down red"></i> '.$reponsesAujourdhui.' ('.$reponsesDifference.')</span>';
                                    }
                                    elseif($reponsesAujourdhui > $reponsesHier){
                                        echo '<span class="badge badge-success"><i class="fa fa-arrow-circle-up green"></i> '.$reponsesAujourdhui.' (+'.$reponsesDifference.')</span>';
                                    }
                                    ?>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>Hier</td>
                            <td><center><?php echo $utilisateursHier; ?></center></td>
                            <td><center><?php echo $ticketsHier; ?></center></td>
                            <td><center><?php echo $reponsesHier; ?></center></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
