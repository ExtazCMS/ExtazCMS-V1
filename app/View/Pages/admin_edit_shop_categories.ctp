<?php $this->assign('title', 'Modifier une catégorie'); ?>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modifier une catégorie de la boutique</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_shop_categories']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Pages', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('name', array('type' => 'text', 'value' => $data['shopCategories']['name'], 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-plus"></i> Modifier cette catégorie</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_shop_category']); ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Annuler</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>