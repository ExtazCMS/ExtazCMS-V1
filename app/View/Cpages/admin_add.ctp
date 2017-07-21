<?php $this->assign('title', 'Ajouter une page'); ?>
<script type="text/javascript">
function verif(evt) {
    var keyCode = evt.which ? evt.which : evt.keyCode;
    var accept = 'abcdefghijklmnopqrstuvwxyz0123456789-';
    if(accept.indexOf(String.fromCharCode(keyCode)) >= 0){
        return true;
    }
    else{
        return false;
    }
}
$(document).ready(function(){
    $(window).load(function(){
        $('#chargement').empty();
        $('#content').fadeIn();
    });
    $("select").selectBoxIt({
        showFirstOption: false
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ajouter une page</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Cpages', array('class' => 'sky-form', 'inputDefaults' => array('error' => false))); ?>
                            <div class="form-group">
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                    <?php echo $this->Form->input('name', array('type' => 'text', 'placeholder' => 'Titre de la page', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <?php 
                                        
                                        echo $this->Form->input('slug', array('type' => 'text', 'placeholder' => 'Slug, mots clefs dans l\'url (par ex: background-du-serveur)', 'class' => 'form-control', 'onkeypress' => 'return verif(event);', 'required' => 'required', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php 
                                    echo $this->Form->label('visible', '&nbsp;&nbsp; Rendre visible ?');
                                    echo $this->Form->checkbox('visible', array('class' => 'pull-left'));
                                ?>
                            </div>
                            <div class="form-group">
                                <div id="chargement"><?php echo $this->Html->image('loader.gif', array('alt' => 'chargement')); ?> Chargement de l'éditeur de texte en cours, veuillez patienter</div>
                                <div id="content" style="display:none;">
                                    <?php echo $this->Form->textarea('content', array('type' => 'textarea', 'rows' => '5', 'cols' => '5', 'class' => 'ckeditor', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <button class="btn btn-w-m btn-primary pull-right pull-right" type="submit"><i class="fa fa-plus"></i> Ajouter</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>