<?php $this->assign('title', $post['Post']['title']); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer cet article ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });

    $(".confirm-comment").confirm({
        text: "Voulez vous vraiment supprimer ce commentaire ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });

    var nb_likes = <?php echo $nb_likes; ?>;

    $('#like').click(function(){
        $('#like').hide();
        $('#dislike').fadeIn(500);
        nb_likes++;
        $('#dislike').html('<font color="red"><i class="fa fa-heart"></i></font>J\'aime (' + nb_likes + ')');	
        var id = '<?php echo $this->params['pass'][1]; ?>';
        $.post('<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'like']); ?>', {id: id}, function(){  
        });
    });

    $('#dislike').click(function(){
        $('#dislike').hide();
        $('#like').fadeIn(500);
		nb_likes--;
        $('#like').html('<i class="fa fa-heart"></i> J\'aime (' + nb_likes + ')');	
        var id = '<?php echo $this->params['pass'][1]; ?>';
        $.post('<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'like']); ?>', {id: id}, function(){     
        });
    });
});
</script>
<!--=== Content Part ===-->
<div class="container content blog-page blog-item">     
    <!--Post-->
    <div class="row magazine-page">
        <div class="col-md-9">
            <div class="blog margin-bottom-40">
                <div class="blog-img">
                    <?php
                    if(filter_var($post['Post']['img'], FILTER_VALIDATE_URL)){
                        echo $this->Html->image($post['Post']['img'], array('class' => 'img-responsive', 'style' => 'width:100%;'));
                    }
                    else{
                        echo $this->Html->image('/img/posts/'.$post['Post']['img'], array('class' => 'img-responsive', 'style' => 'width:100%;'));
                    }
                    ?>
                </div>
                <br>
                <h3><font color="#7AC02C"><?php echo $post['Post']['title']; ?></font></h3>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-post-tags">
                            <ul class="list-unstyled list-inline blog-info">
                                <li><i class="fa fa-user"></i> Posté par <?php echo $post['Post']['author']; ?></li>
                                <li>
                                    <?php if($post['Post']['draft'] == 1){ ?>
                                    <i class="fa fa-calendar"></i> Non publié
                                    <?php } else { ?>
                                    <i class="fa fa-calendar"></i> <?php echo $this->Time->timeAgoInWords($post['Post']['posted']); ?>
                                    <?php } ?>
                                </li>
                                <li><i class="fa fa-tags"></i> <?php echo $post['Post']['cat']; ?></li>
                            </ul>                    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <?php if($liked){ ?>
                                <button class="btn btn-default btn-xs rounded-3x" id="dislike">
                                    <font color="red"><i class="fa fa-heart"></i></font> <span class="open-sans">J'aime (<?php echo $nb_likes; ?>)</span>
                                </button>
                                <button class="btn btn-default btn-xs rounded-3x" id="like" style="display:none;">
                                    <i class="fa fa-heart"></i> <span class="open-sans">J'aime (<?php echo $nb_likes; ?>)</span>
                                </button>
                            <?php } else { ?>
                                <button class="btn btn-default btn-xs rounded-3x" id="dislike" style="display:none;">
                                    <font color="red"><i class="fa fa-heart"></i></font> <span class="open-sans">J'aime (<?php echo $nb_likes; ?>)</span>
                                </button>
                                <button class="btn btn-default btn-xs rounded-3x" id="like">
                                    <i class="fa fa-heart"></i> <span class="open-sans">J'aime (<?php echo $nb_likes; ?>)</span>
                                </button>
                            <?php } ?>        
                            <button class="btn btn-default btn-xs rounded-3x" id="chargement" style="display:none;">
                                <?php echo $this->Html->image('like_loader.gif', array('alt' => 'chargement')); ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php if($role > 1){ ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="btn-group">
                                <a class="btn btn-default btn-xs" href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'edit', $post['Post']['id'], 'admin' => true]); ?>">
                                    <font color="#777777"><i class="fa fa-pencil"></i> Editer</font>
                                </a>
                                <a class="confirm btn btn-default btn-xs" href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'lock', $post['Post']['id'], 'admin' => true]); ?>">
                                    <font color="red"><i class="fa fa-times"></i> Supprimer</font>
                                </a>
								
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="btn-group pull-right">
                                <?php
                                if($post['Post']['draft'] == 1){
                                    echo '<a class="btn btn-danger btn-xs" href=""><i class="fa fa-lock"></i> Cet article est enregistré en tant que brouillon</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <hr>
                <?php echo $post['Post']['content']; ?>
            </div>
            <?php if($role > 1){
				if($connected){?>
					<br>
					<?php echo $this->Form->create('Comments', ['action' => 'write', 'class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
						<div class="reg-header">
							<?php $nb_comments = count($post['Comment']); ?>
							<?php if($nb_comments > 1){ $comment = 'Commentaires'; } else { $comment = 'Commentaire'; } ?>
							<header><?php echo $comment.' ('.$nb_comments.'). |Privilèges admin|'; ?></header>
						</div>
						<fieldset>
							<section>
								<?php echo $this->Form->input('post_id', array('type' => 'hidden', 'value' => $this->params['id'], 'label' => false)); ?>
								<?php echo $this->Form->textarea('comment', array('type' => 'text', 'placeholder' => 'Partagez votre avis', 'class' => 'form-control', 'rows' => '5', 'cols' => '5', 'label' => false)); ?>
							</section>
						</fieldset>
						<footer>
							<button class="btn-u pull-right" type="submit">Envoyer</button>      
						</footer>
					<?php echo $this->Form->end(); ?>
					<br>
				<?php } else { ?>
					<hr>
					<div class="tag-box tag-box-v4 margin-bottom-40">
						<h3><i class="fa fa-lock"></i> Vous devez être connecté pour poster un commentaire</h3>
					</div>
				<?php }
			} else {
				if($post['Post']['locked'] != 1){
					if($connected){ ?>
						<br>
						<?php echo $this->Form->create('Comments', ['action' => 'write', 'class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
							<div class="reg-header">
								<?php $nb_comments = count($post['Comment']); ?>
								<?php if($nb_comments > 1){ $comment = 'Commentaires'; } else { $comment = 'Commentaire'; } ?>
								<header><?php echo $comment.' ('.$nb_comments.')'; ?></header>
							</div>
							<fieldset>
								<section>
									<?php echo $this->Form->input('post_id', array('type' => 'hidden', 'value' => $this->params['id'], 'label' => false)); ?>
									<?php echo $this->Form->textarea('comment', array('type' => 'text', 'placeholder' => 'Partagez votre avis', 'class' => 'form-control', 'rows' => '5', 'cols' => '5', 'label' => false)); ?>
								</section>
							</fieldset>
							<footer>
								<button class="btn-u pull-right" type="submit">Envoyer</button>      
							</footer>
						<?php echo $this->Form->end(); ?>
						<br>
					<?php } else { ?>
						<hr>
						<div class="tag-box tag-box-v4 margin-bottom-40">
							<h3><i class="fa fa-lock"></i> Vous devez être connecté pour poster un commentaire</h3>
						</div>
					<?php }
				} else {?>
					<hr>
					<div class="tag-box tag-box-v4 margin-bottom-40">
						<h3><i class="fa fa-lock"></i> Les commentaires ne sont pas autorisés !</h3>
					</div>
				<?php }
			}?>
            <div class="row">
                <?php foreach($comments as $comment){ ?>
                    <?php $username = $comment['User']['username']; ?>
                    <div class="col-sm-1">
                        <div class="thumbnail">
                            <?php
                            if($username == null){
                                echo $this->Html->image('https://cravatar.eu/helmavatar/Steve', ['alt' => 'Player head', 'class' => 'img-responsive avatar-rounded', 'height' => 35, 'width' => 35]);
                            }
                            else{
                                echo $this->Html->image($comment['User']['avatar'], ['alt' => 'Player head', 'class' => 'img-responsive avatar-rounded', 'height' => 35, 'width' => 35]);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <?php
                                    if($username == null){
                                        echo '<u>Compte supprimé</u>';
                                    }
                                    else{
                                        echo $this->Html->link($username, ['controller' => 'users', 'action' => 'profile', 'username' => $username], ['class' => 'text-default']);
                                    }
                                    ?>
                                </strong>
                                <span class="text-muted"><?php echo $this->Time->timeAgoInWords($comment['Comment']['created']); ?></span>
                                <?php if($role > 0){ ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'comments', 'action' => 'delete', $comment['Comment']['id'], 'read', 'admin' => true]); ?>" class="confirm-comment btn btn-default btn-xs pull-right">
                                        <font color="red">
                                            <i class="fa fa-times"></i>
                                        </font>
                                    </a>
                                    <a href="<?php echo $this->Html->url(['controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'], 'admin' => true]); ?>" class="btn btn-default btn-xs pull-right">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="panel-body">
                                <?php echo htmlentities($comment['Comment']['comment']); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--End Post-->
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!--=== End Content Part ===-->