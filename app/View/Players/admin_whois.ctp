<?php
$this->assign('title', 'Whois...');
$username = $this->params['pass'][0];
$game = $api->call('players.name', [$username])[0]['success'];
$username = $player['User']['username'];
$email = $player['User']['email'];
$tokens = $player['User']['tokens'];
$allow_email = $player['User']['allow_email'];
$inscription = $player['User']['created'];
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="widget report-widget">
                    <div class="widget-head br-red">
                        <h3><i class="fa fa-table"></i>Informations à propos de <?php echo $username; ?></h3>
                    </div>
                    <div class="widget-body no-padd">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="fa fa-user"></i></td>
                                    <td>Pseudo</td>
                                    <td><?php echo $username; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-envelope"></i></td>
                                    <td>Adresse Email</td>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-envelope"></i></td>
                                    <td>Accepte de recevoir des emails</td>
                                    <td>
                                        <?php
                                        if($allow_email == 1){
                                            echo 'Oui';
                                        }
                                        else{
                                            echo 'Non';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-eur"></i></td>
                                    <td><?php echo ucfirst($site_money); ?></td>
                                    <td><?php echo $tokens; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-eur"></i></td>
                                    <td>Nombre d'achats Starpass</td>
                                    <td><?php echo $achatsStarpass; ?></td>
                                </tr>  
                                <tr>
                                    <td class="text-center"><i class="fa fa-eur"></i></td>
                                    <td>Nombre d'achats PayPal</td>
                                    <td><?php echo $achatsPaypal; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-shopping-cart"></i></td>
                                    <td>Nombre d'achats Boutique</td>
                                    <td><?php echo $achatsBoutique; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-globe"></i></td>
                                    <td>Adresse IP</td>
                                    <td><?php echo $game['ip']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-bolt"></i></td>
                                    <td>Opérateur (OP)</td>
                                    <td>
                                        <?php
                                        if($game['op'] == 1){
                                            echo 'Oui';
                                        }
                                        else{
                                            echo 'Non';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-bolt"></i></td>
                                    <td>Gamemode (GM)</td>
                                    <td><?php echo $game['gameMode']; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-calendar"></i></td>
                                    <td>Première connexion en jeu</td>
                                    <td><?php echo date('Y-m-d à H:i:s', $game['firstPlayed']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-calendar"></i></td>
                                    <td>Dernière connexion en jeu</td>
                                    <td><?php echo date('Y-m-d à H:i:s', $game['lastPlayed']); ?></td>
                                </tr> 
                                <tr>
                                    <td class="text-center"><i class="fa fa-map-marker"></i></td>
                                    <td>Position</td>
                                    <td><?php echo $game['worldInfo']['name'].' (x:'.round($game['location']['x']).' y:'.round($game['location']['y']).' z:'.round($game['location']['z']).')'; ?></td>
                                </tr> 
                                <tr>
                                    <td class="text-center"><i class="fa fa-trophy"></i></td>
                                    <td>Niveau</td>
                                    <td><?php echo $game['level']; ?></td>
                                </tr> 
                                <tr>
                                    <td class="text-center"><i class="fa fa-heart"></i></td>
                                    <td>Santé</td>
                                    <td>
                                        <?php
                                        echo round($game['health']).' '.$this->Html->image('minecraft/heart.png', ['width' => 10, 'height' => 10]).' ';
                                        echo $game['foodLevel'].' '.$this->Html->image('minecraft/food.png', ['width' => 10, 'height' => 10]);
                                        ?>
                                    </td>
                                </tr>                                              
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-foot">
                        <span class="pull-left"><i class="fa fa-calendar"></i> Inscrit le <?php echo $this->Time->format('d/m/Y à H:i', $inscription); ?></span>
                        <a href="" class="btn btn-xs pull-right btn-default"><i class="fa fa-refresh"></i> Rafraîchir</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>