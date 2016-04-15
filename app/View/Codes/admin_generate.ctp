<?php $this->assign('title', 'Générer un code cadeau'); ?>
<script type="text/javascript">
$(function() {
    $("select").selectBoxIt({
        showFirstOption: false
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Génération de codes cadeaux</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'codes', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Codes', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('value', array('type' => 'number', 'placeholder' => 'Valeur du/des code(s) (en '.$site_money.')', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('number', array('type' => 'number', 'placeholder' => 'Nombre de codes à générer (max: 250)', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'stats']); ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Annuler</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>