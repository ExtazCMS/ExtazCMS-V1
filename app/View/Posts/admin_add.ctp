<?php $this->assign('title', 'Rédiger un article'); ?>
<script type="text/javascript">
function verif(evt) {
 var keyCode = evt.which ? evt.which : evt.keyCode;
 var accept = 'abcdefghijklmnopqrstuvwxyz-';
 
	if(evt.which == 8 || evt.which == 0 || accept.indexOf(String.fromCharCode(keyCode)) >= 0 ) {

	return true; 
	}else{
	evt.preventDefault();
	return false;
	}
 
}
$(document).ready(function(){
    $(window).load(function(){
        $('#chargement').empty();
        $('#content').fadeIn();
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Rédiger un article</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Post', array('class' => 'sky-form', 'type' => 'file', 'inputDefaults' => array('error' => false))); ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('title'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                    <?php echo $this->Form->input('title', array('type' => 'text', 'placeholder' => 'Titre', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('cat'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <?php echo $this->Form->input('cat', array('type' => 'text', 'placeholder' => 'Catégorie', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('slug'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <?php echo $this->Form->input('slug', array('type' => 'text', 'placeholder' => 'Slug, mots clefs dans l\'url (par ex: nouveau-serveur-pvp)', 'class' => 'form-control', 'onkeypress' => 'return verif(event);', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('img_file'); ?></small></font>
                                <input type="file" name="data[Post][img_file]" id="PostImgFile" onchange="this.parentNode.nextSibling.value = this.value">
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('img'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                    <?php echo $this->Form->input('img', array('type' => 'text', 'placeholder' => 'Ou insérez une url (850x400)', 'class' => 'form-control', 'label' => false, 'required' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="chargement"><?php echo $this->Html->image('loader.gif', array('alt' => 'chargement')); ?> Chargement de l'éditeur de texte en cours, veuillez patienter</div>
                                <div id="content" style="display:none;">
                                    <font color="#A94442"><small><?php echo $this->Form->error('content'); ?></small></font>
                                    <?php echo $this->Form->textarea('content', array('type' => 'textarea', 'rows' => '5', 'cols' => '5', 'class' => 'ckeditor', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <i class="fa fa-info-circle"></i> Cet article sera enregistré en tant que brouillon
                                    <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-plus"></i> Ajouter cet article</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>