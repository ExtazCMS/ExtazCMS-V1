<?php
$this->assign('title', 'Mon compte');
$player = $api->call('players.name', [$username]);
?>
<script>
$(document).ready(function(){
    var users = [
        <?php
        foreach($users as $user){
            echo '{ value: "'.$user['User']['username'].'", role: "'.$user['User']['role'].'" },';
        }
        ?>
    ];

    $('#autocomplete').autocomplete({
        lookup: users,
        onSelect: function(suggestion){
            if(suggestion.role == 2){
                humane.log('<i class="fa fa-exclamation-triangle"></i> Attention ' + suggestion.value + ' est un administrateur', { timeout: 4000, clickToClose: true, addnCls: 'humane-flatty-warning' });
            }
            if(suggestion.role == 1){
                humane.log('<i class="fa fa-exclamation-triangle"></i> Attention ' + suggestion.value + ' est un modérateur', { timeout: 4000, clickToClose: true, addnCls: 'humane-flatty-warning' });
            }
        }
    });
    <?php
    $tab = $this->request->query;
    if(in_array('send_tokens', $tab)){
        ?>
        $('#infos').removeClass().addClass('tab-pane fade in');
        $('#send_tokens').removeClass().addClass('tab-pane fade in active');
        $('#li_infos').removeClass();
        $('#li_send_tokens').addClass('active');
        <?php
    }
    if(in_array('avatar', $tab)){
        ?>
        $('#infos').removeClass().addClass('tab-pane fade in');
        $('#avatar').removeClass().addClass('tab-pane fade in active');
        $('#li_infos').removeClass();
        $('#li_avatar').addClass('active');
        <?php
    }
    ?>
});
</script>
<!--=== Content Part ===-->
<div class="container content">     
    <div class="row">
        <div class="col-md-9">
            <div class="tab-v1">
                <ul class="nav nav-tabs">
                    <li class="active" id="li_infos"><a href="#infos" data-toggle="tab">Informations</a></li>
                    <li id="li_avatar"><a href="#avatar" data-toggle="tab">Avatar</a></li>
                    <?php if($use_store == 1){ ?>
                        <li id="li_send_tokens"><a href="#send_tokens" data-toggle="tab">Envoyer des <?php echo $site_money; ?></a></li>
                        <li id="li_history"><a href="#history" data-toggle="tab">Historiques</a></li>
                    <?php } ?>
                </ul>                
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="infos">
                        <?php echo $this->Form->create('User', ['action' => 'update_account', 'class' => 'sky-form']); ?>
                            <div class="reg-header">  
                                <header>Mes informations personnelles</header>
                            </div>
                            <fieldset>
                                <section>
                                    <i class="fa fa-trophy"></i> Inscrit depuis le <?php echo $this->Time->format('d/m/Y', $data['User']['created']); ?>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('username', array('type' => 'text', 'value' => $data['User']['username'], 'class' => 'form-control', 'label' => 'Pseudo', 'disabled')); ?>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('email', array('type' => 'text', 'value' => $data['User']['email'], 'class' => 'form-control', 'label' => 'Email', 'disabled')); ?>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Nouveau mot de passe', 'class' => 'form-control', 'label' => 'Mot de passe', 'required' => false)); ?>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('password_confirmation', array('type' => 'password', 'placeholder' => 'Confirmation', 'class' => 'form-control', 'label' => 'Mot de passe')); ?>
                                </section>
                            </fieldset>

                            <footer>
                                <button class="btn-u pull-right" type="submit">Enregistrer les modifications</button>
                            </footer>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="tab-pane fade in" id="avatar">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>
                                    <span class="avatar-message">
                                         Votre avatar actuel <span class="avatar"><?php echo $this->Html->image($avatar, ['height' => 24, 'width' => 24, 'class' => 'avatar-rounded', 'style' => 'margin-top: 12px;']); ?></span> <small>(<?php echo $this->Html->link('supprimer', ['controller' => 'avatars', 'action' => 'delete']); ?>)</small>
                                    </span>
                                </h2>
                                <?php echo $this->Form->create('Avatars', ['action' => 'add', 'class' => 'dropzone', 'id' => 'myAwesomeDropzone', 'type' => 'file']); ?>
                                    <div class="fallback">
                                        <input type="file" name="file">
                                    </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="send_tokens">
						<?php if($ban != 1){ ?>
                        <?php echo $this->Form->create('Pages', ['action' => 'send_tokens', 'class' => 'sky-form']); ?>
                            <div class="reg-header">  
                                <header>Envoyer des tokens à un autre joueur</header>
                            </div>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('username', array('type' => 'text', 'id' => 'autocomplete', 'class' => 'form-control', 'placeholder' => 'Insensible à la casse', 'label' => 'Pseudo du destinataire', 'required' => 'required')); ?>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <?php echo $this->Form->input('nb_tokens', array('type' => 'number', 'class' => 'form-control', 'placeholder' => 'Vous avez '.$tokens.' '.$site_money, 'label' => 'Nombre de '.$site_money.' à envoyer', 'required' => 'required')); ?>
                                </section>
                            </fieldset>

                            <footer>
                                <button class="btn-u pull-right" type="submit">Envoyer</button>
                            </footer>
                        <?php echo $this->Form->end(); ?>
						<?php } else { ?>
							<div class="alert alert-info">
								<i class="fa fa-info-circle"></i> "Vous avez été banni du site. Vous ne pouvez plus reçevoir ou envoyer de token!"
							</div>
						<?php } ?>
                    </div>
                    <div class="tab-pane fade in" id="history">
                        <div class="panel-group acc-v1" id="accordion-1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-One" aria-expanded="true">
                                            Achats boutique
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-One" class="panel-collapse collapse" aria-expanded="true">
                                    <div class="panel-body">
                                        <?php
                                        if($count_shop_history > 0){
                                            foreach($shop_history as $shop_h){
                                                if($shop_h['shopHistory']['money'] == 'site'){
                                                    $money = $site_money;
                                                }
                                                else{
                                                    $money = $money_server;
                                                }
                                                echo '<span class="text-highlights text-highlights-green"><i class="fa fa-clock-o"></i> '.$this->Time->format('d/m/Y H:i:s', $shop_h['shopHistory']['created']).'</span> Vous avez achetez <b>'.$shop_h['shopHistory']['item'].' (x'.$shop_h['shopHistory']['quantity'].')</b> pour '.$shop_h['shopHistory']['price'].' '.$money.'<br>';
                                            }
                                        }
                                        else{
                                            echo '<span class="text-highlights text-highlights-blue"><i class="fa fa-info-circle"></i> Aucun élément disponible dans l\'historique</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Two" aria-expanded="false">
                                            Achats Starpass
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-Two" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <?php
                                        if($count_starpass_history > 0){
                                            foreach($starpass_history as $starpass_h){
                                                echo '<span class="text-highlights text-highlights-green"><i class="fa fa-clock-o"></i> '.$this->Time->format('d/m/Y H:i:s', $starpass_h['starpassHistory']['created']).'</span> Vous avez achetez '.$starpass_h['starpassHistory']['tokens'].' '.$site_money.'<br>';
                                            }
                                        }
                                        else{
                                            echo '<span class="text-highlights text-highlights-blue"><i class="fa fa-info-circle"></i> Aucun élément disponible dans l\'historique</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php if($use_paypal == 1){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Three" aria-expanded="false">
                                            Achats PayPal
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-Three" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body">
                                        <?php
                                        if($count_paypal_history > 0){
                                            foreach($paypal_history as $paypal_h){
                                                echo '<span class="text-highlights text-highlights-green"><i class="fa fa-clock-o"></i> '.$this->Time->format('d/m/Y H:i:s', $paypal_h['paypalHistory']['created']).'</span> Vous avez achetez '.$paypal_h['paypalHistory']['item_name'].' '.$site_money.'<br>';
                                            }
                                        }
                                        else{
                                            echo '<span class="text-highlights text-highlights-blue"><i class="fa fa-info-circle"></i> Aucun élément disponible dans l\'historique</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Four" aria-expanded="false">
                                            Envois de <?php echo $site_money; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-Four" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <?php
                                        if($count_send_tokens_history > 0){
                                            foreach($send_tokens_history as $send_tokens_h){
                                                echo '<span class="text-highlights text-highlights-green"><i class="fa fa-clock-o"></i> '.$this->Time->format('d/m/Y H:i:s', $send_tokens_h['sendTokensHistory']['created']).'</span> Vous avez envoyé '.$send_tokens_h['sendTokensHistory']['nb_tokens'].' '.$site_money.', et '.$send_tokens_h['sendTokensHistory']['recipient'].' a reçu '.$send_tokens_h['sendTokensHistory']['nb_tokens_with_loss_rate'].' '.$site_money.'<br>';
                                            }
                                        }
                                        else{
                                            echo '<span class="text-highlights text-highlights-blue"><i class="fa fa-info-circle"></i> Aucun élément disponible dans l\'historique</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Five" aria-expanded="false">
                                            Codes cadeaux utilisés
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-Five" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <?php
                                        if($count_codes_history > 0){
                                            foreach($codes_history as $codes_h){
                                                echo '<span class="text-highlights text-highlights-green"><i class="fa fa-clock-o"></i> '.$this->Time->format('d/m/Y H:i:s', $codes_h['Code']['updated']).'</span> Vous avez utilisé le code <small><b>'.$codes_h['Code']['code'].'</b></small> qui vous a octroyé '.$codes_h['Code']['value'].' '.$site_money.'<br>';
                                            }
                                        }
                                        else{
                                            echo '<span class="text-highlights text-highlights-blue"><i class="fa fa-info-circle"></i> Aucun élément disponible dans l\'historique</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->
</div><!--/container-->     
<!--=== End Content Part ===-->