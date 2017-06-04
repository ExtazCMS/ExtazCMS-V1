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
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Créer une page de redirection</h5>
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
                                    <?php echo $this->Form->input('slug', array('type' => 'text', 'placeholder' => 'Slug, mots clefs dans l\'url (par ex: background-du-serveur)', 'class' => 'form-control', 'onkeypress' => 'return verif(event);', 'required' => 'required', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php 
                                    echo $this->Form->label('visible', '&nbsp;&nbsp; Rendre visible ?');
                                    echo $this->Form->checkbox('visible', array('class' => 'pull-left'));
                                ?>
                            </div>

                            <div class="form-group">
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <?php echo $this->Form->input('url', array('type' => 'url', 'placeholder' => 'Localisateur uniforme de ressource (URL)', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <i class="fa fa-info-circle"></i> Cette page aura pour effet de rediriger les utilisateurs vers l'url indiquée
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