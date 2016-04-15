<?php $this->assign('title', 'Mes tickets'); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer cette réponse ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
            <ul class="timeline-v2">
                <li>
                    <time class="cbp_tmtime" datetime=""><span><?php echo $this->Time->format('d/m/Y', $data['Support']['created']); ?></span> <span><?php echo $this->Time->format('H\hi', $data['Support']['created']); ?></span></time>
                    <i class="cbp_tmicon rounded-x hidden-xs"></i>
                    <div class="cbp_tmlabel">
                        <h2>
                            <?php if($role > 0){ ?>
                                <?php
                                if($data['User']['username'] == null){
                                    echo 'Ticket de <u>Compte supprimé</u>';
                                }
                                else{
                                    ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'edit', $data['User']['id'], 'admin' => true]); ?>">
                                        Ticket de <?php echo $data['User']['username']; ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            <?php } else { ?>
                                Ticket de <?php echo $data['User']['username']; ?>
                            <?php } ?>
                            <?php if($role > 0){ ?>
                                <?php if($data['Support']['resolved'] == 0){ ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'close_ticket', 'id' => $data['Support']['id']]); ?>" class="btn btn-default btn-sm pull-right">
                                        <i class="fa fa-lock"></i>Clôturer ce ticket
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'open_ticket', 'id' => $data['Support']['id']]); ?>" class="btn btn-default btn-sm pull-right">
                                        <i class="fa fa-unlock"></i>Ouvrir ce ticket
                                    </a>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if($data['Support']['resolved'] == 0){ ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'close_my_ticket', 'id' => $data['Support']['id']]); ?>" class="btn btn-default btn-sm pull-right">
                                        <i class="fa fa-lock"></i>Fermer mon ticket
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </h2>
                        <p>
                            <?php echo $data['Support']['message']; ?>
                        </p>
                    </div>
                </li>
                <?php if($nbComments != 0){ ?>
	                <?php foreach($comments as $comment){ ?>
	                <li>
	                    <time class="cbp_tmtime" datetime=""><span><?php echo $this->Time->format('d/m/Y', $comment['supportComments']['created']); ?></span> <span><?php echo $this->Time->format('H\hi', $comment['supportComments']['created']); ?></span></time>
	                    <i class="cbp_tmicon rounded-x hidden-xs"></i>
	                    <div class="cbp_tmlabel">
	                        <h2>
                                <?php
                                if($comment['User']['username'] == null){
                                    echo 'Réponse de <u>Compte supprimé</u>';
                                }
                                else{
                                    echo 'Réponse de '.$comment['User']['username'];
                                }
                                ?>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_support_comment', 'id' => $comment['supportComments']['id']]); ?>" class="tooltips btn btn-default btn-sm pull-right confirm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Supprimer cette réponse"><font color="red"><i class="fa fa-times"></i> Supprimer</font></a>
	                        </h2>
	                        <p class="text-justify">
	                            <?php echo $comment['supportComments']['message']; ?>
	                        </p>
	                    </div>
	                </li>
                    <?php } ?>
	            <?php } else { ?>
                    <?php if($data['Support']['resolved'] == 0){ ?>
        	            <li>
                            <time class="cbp_tmtime" datetime=""></time>
                            <i class="cbp_tmicon rounded-x hidden-xs"></i>
                            <div class="cbp_tmlabel">
                                <h3>
                                    <small>Aucune réponse pour le moment</small>
                                </h3>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
	            <?php if($data['Support']['resolved'] == 0){ ?>
                <li>
                    <time class="cbp_tmtime" datetime=""></time>
                    <i class="cbp_tmicon rounded-x hidden-xs"></i>
                    <div class="cbp_tmlabel">
                        <h3>
                            <div class="repondre">
                                <?php echo $this->Form->create('Pages', ['action' => 'answer_ticket', 'class' => '', 'inputDefaults' => ['error' => false]]); ?>
                                        <?php echo $this->Form->input('id', ['type' => 'hidden', 'value' => $this->params['pass'][0], 'class' => 'form-control']); ?>
                                        <?php echo $this->Form->textarea('message', ['placeholder' => 'Laisser une réponse', 'class' => 'form-control']); ?><br>
                                        <button class="btn-u btn-brd-hover rounded btn-u btn-u-xs pull-right" style="margin-top:-15px;" type="submit">Envoyer</button>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </h3>
                    </div>
                </li>
                <?php } else { ?>
                <li>
                    <time class="cbp_tmtime" datetime=""></time>
                    <i class="cbp_tmicon rounded-x hidden-xs"></i>
                    <div class="cbp_tmlabel">
                        <h3>
                            <i class="fa fa-lock"></i> Ce ticket est fermé
                        </h3>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- End Content -->
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->