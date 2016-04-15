<?php $this->assign('title', 'Editer un widget'); ?>
<script>
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
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editer un widget</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'widgets', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Widget', ['class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('name', array('type' => 'text', 'value' => $data['Widget']['name'], 'class' => 'form-control', 'label' => 'Nom du widget')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('order', array('type' => 'number', 'value' => $data['Widget']['order'], 'class' => 'form-control', 'label' => 'Ordre d\'affichage')); ?>
                            </div>
                            <div class="form-group">
                                <div id="chargement"><?php echo $this->Html->image('loader.gif', array('alt' => 'chargement')); ?> Chargement de l'éditeur de texte en cours, veuillez patienter</div>
                                <div id="content" style="display:none;">
                                    <font color="#A94442"><small><?php echo $this->Form->error('content'); ?></small></font>
                                    <?php echo $this->Form->textarea('content', array('type' => 'textarea', 'rows' => '5', 'cols' => '5', 'value' => $data['Widget']['content'], 'class' => 'ckeditor', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Editer ce widget</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>