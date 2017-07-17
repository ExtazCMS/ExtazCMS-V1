<?php $this->assign('title', 'Profil de '.$data['User']['username'].''); ?>
<?php $player = $api->call('players.name', [$data['User']['username']]); ?>
<!--=== Content Part ===-->
<div class="container content">     
    <div class="row">
        <div class="col-md-9">
            <?php echo $this->Form->create('User', ['action' => 'update_account']); ?>
                <div class="profile-header">  
                    <header><?php echo $this->Html->image('https://cravatar.eu/helmavatar/'.$data['User']['username'].'', ['alt' => 'Player head', 'style' => 'margin-right:4px;']); ?> Informations à propos de <?php echo $data['User']['username']; ?></header>
                </div>
                <div class="panel panel-default">
                    <table class="table raleway">
                        <tbody>
                            <tr>
                                <td>Inscription</td>
                                <td><b><?php echo $this->Time->format('d/m/Y', $data['User']['created']); ?></b></td>
                            </tr>
                            <?php
                            if($use_store == 1){
                                if($use_economy == 1){
                                $balance = number_format($api->call('players.name.bank.balance', [$data['User']['username']])[0]['success'], 0, ',', ' ');
                                ?>
                                <tr>
                                    <td>Argent sur le serveur</td>
                                    <td><b><?php echo $balance.' '.$money_server; ?></b></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>Argent sur le site</td>
                                    <td><b><?php echo $data['User']['tokens'].' '.$site_money; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo ucfirst($site_money); ?> achetés au total</td>
                                    <td><b><?php echo $tokens_buy; ?></b></td>
                                </tr>
                            <?php } ?>
                            <?php if($use_votes == 1 && $use_votes_ladder == 1){ ?>
                                <tr>
                                    <td>Classement des votes</td>
                                    <td>
                                        <b>
                                            <?php
                                            if($data['User']['role'] == 0){
                                                $nb = 0;
                                                foreach($ladder_vote as $l){
                                                    $nb++;
                                                    if($l['User']['username'] == $data['User']['username']){
                                                        if($nb == 1){
                                                            echo $nb.'<small>er</small>';
                                                        }
                                                        else{
                                                            echo $nb.'<small>ème</small>';
                                                        }
                                                    }
                                                }
                                            }
                                            else{
                                                echo 'Non classé';
                                            }
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre de votes</td>
                                    <td><b><?php echo $nb_votes; ?></b></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Connecté en jeu</td>
                                <td>
                                    <b>
                                        <?php
                                        if($player[0]['is_success']){
                                            echo 'Oui';
                                        }
                                        else{
                                            echo 'Non';
                                        }
                                        ?>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->
</div><!--/container-->     
<!--=== End Content Part ===-->