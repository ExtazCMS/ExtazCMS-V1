<?php $this->assign('title', 'Chat en jeu'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.player', function(){
            var message = $('#message').val();
            $('#message').val('@' + this.id + ' ' + message).focus();
        });
        setInterval(function(){
                var url_chat_messages = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages', 'admin' => true)); ?>';
                var url_chat_update = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_update', 'admin' => true)); ?>';
                $.get(url_chat_messages, function(data){
                    $('.chat-messages').html(data);
                }, 'json');
                $.get(url_chat_update, function(data){
                    $('.chat-update').html(data);
                }, 'json');
        }, 5000);
        $('.send-message').on('click', function(){
            var message = $('#message').val();
            var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'send_message', 'admin' => true)); ?>';
            if(message != ''){
                $('.send-message').html('<i class="fa fa-spinner fa-spin"></i>');
                $.post(url, {message: message}, function(data){
                    $('#message').val('').focus();
                    $('.send-message').html('<i class="fa fa-chevron-right"></i>');
                    var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages', 'admin' => true)); ?>';
                    $.get(url, function(data){
                        $('.chat-messages').html(data);
                    }, 'json');
                }, 'json');
            }
            return false;
        });
    });
</script>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-9">
        <?php if($ban != 1){ ?>
            <div class="header"> <h4 style="margin-top: 0;">Chat en jeu</h4></div><br>
                <div class="ibox-content">
                    <div class="chat-update">
                        <i class="fa fa-clock-o"></i> <?php echo 'Dernière mise à jour à '.date('H:i:s').', il y a '.@$count_players.' joueur(s) connecté(s)'; ?>
                    </div>
                    <div class="chat-messages">
                        <?php
                        $messages = $api->call('streams.chat.latest', [100])[0]['success'];
                        if(count($messages) >= $chat_nb_messages){
                            foreach($messages as $m){
                                if(empty($m['player'])){
                                    $explode = explode(']', $m['message']);
                                    $explode = str_replace('[', '', $explode);
                                    $player = $explode[0];
                                    $message = $explode[1];
                                }
                                else{
                                    $player = $m['player'];
                                    $message = $m['message'];
                                }
                                echo '<small>['.date('H:i:s', $m['time']).']</small> <b class="player" id="'.$player.'"> '.$player.'</b> '.$message.'<br>';
                            }
                        }
                        else{
                            echo '<div class="alert alert-warning alert-dismissable"><small>Désolé mais il n\'y a pas assez de messages pour afficher le chat (minimum '.$chat_nb_messages.')</small></div>';
                        }
                        ?>
                    </div>
                    <hr>
                    <?php if($connected) { ?>
                    <div class="hidden-xs">
                        <form>
                            <div class="input-group">
                                <?php echo $this->Form->input('message', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Envoyer un message', 'required' => 'required', 'label' => false]); ?>
                                <span class="input-group-btn">
				                        <button class="btn btn-white send-message" type="submit"><i class="fa fa-chevron-right"></i></button>
				                    </span>
                            </div>
                        </form>
                    </div>
                    <div class="visible-xs">
                        <form>
                            <div class="input-group">
                                <?php echo $this->Form->input('message', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Indisponible sur mobile', 'disabled' => 'disabled', 'label' => false]); ?>
                                <span class="input-group-btn">
				                        <button class="btn btn-white send-message" disabled="disabled" type="submit"><i class="fa fa-chevron-right"></i></button>
				                    </span>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                </div>
        <?php } else { ?>
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> "Vous avez été banni du site. Vous n'avez plus accès à cette page!"
            </div>
        <?php } ?>
        </div>
        <!-- End Left Sidebar -->
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->
</div><!--/container-->
<!--=== End Content Part ===-->