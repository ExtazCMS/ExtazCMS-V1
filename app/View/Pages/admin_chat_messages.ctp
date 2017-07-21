<?php $this->assign('title', 'Chat du serveur'); ?>
<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click', '.player', function(){
    	var message = $('#message').val();
    	$('#message').val('@' + this.id + ' ' + message).focus();
    });
    setInterval(function(){
    	if($('.update').is(":checked")){
	    	var url_chat_messages = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages')); ?>';
	    	var url_chat_update = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_update')); ?>';
	        $.get(url_chat_messages, function(data){
				$('.chat-messages').html(data);
			}, 'json');
			$.get(url_chat_update, function(data){
				$('.chat-update').html(data);
			}, 'json');
		}
    }, 5000);
    $('.send-message').on('click', function(){
        var message = $('#message').val();
        var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'send_message')); ?>';
        if(message != ''){
	        $('.send-message').html('<i class="fa fa-spinner fa-spin"></i>');
	        $.post(url, {message: message}, function(data){
	        	$('#message').val('').focus();
	        	$('.send-message').html('<i class="fa fa-chevron-right"></i>');
	        	var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages')); ?>';
		        $.get(url, function(data){
					$('.chat-messages').html(data);
				}, 'json');
				if(data.result == "success"){
					toastr.options = {
				        closeButton: true,
				        progressBar: true,
				        showMethod: 'slideDown',
				        timeOut: 2000
				    };
				    toastr.success('Message envoyé !');
				}
				else{
					toastr.options = {
				        closeButton: true,
				        progressBar: true,
				        showMethod: 'slideDown',
				        timeOut: 2000
				    };
				    toastr.error('Erreur');
				}
	        }, 'json');
        }
        return false;
    });
	$(document).idleTimer(60000);
	$(document).on("idle.idleTimer", function(event, elem, obj){
        $('#update').prop('checked', false);
        $('.timeout').fadeIn(500);
    });

    $(document).on("active.idleTimer", function(event, elem, obj, triggerevent){
        $('#update').prop('checked', true);
        $('.timeout').fadeOut(500);
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Chat en temps réel</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
	                    <div class="alert alert-info timeout" style="display: none;">
	                    	<i class="fa fa-info-circle"></i> Oops, vous êtes inactif, pour garantir de bonnes performances, les messages ne sont plus mis à jour automatiquement, bougez votre souris pour montrer que vous êtes là :)
	                    </div>
                    	<div class="pull-left" style="margin-right: 5px;">
                            <div class="onoffswitch">
                            	<input name="update" type="checkbox" class="checkboxes onoffswitch-checkbox update" checked="checked" id="update">
                                <label for="update" class="onoffswitch-label">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>
						<label for="update">Mise à jour automatique ?</label>
						<hr>
						<div class="chat-update">
							<i class="fa fa-clock-o"></i> <?php echo 'Dernière mise à jour à '.date('H:i:s').', il y a '.$count_players.' joueur(s) connecté(s)'; ?>
						</div>
						<hr>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>