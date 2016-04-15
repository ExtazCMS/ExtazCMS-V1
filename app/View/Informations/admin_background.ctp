<?php $this->assign('title', 'Backgrounds'); ?>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Télécharger un background</h5>
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
                        <?php if($nb_backgrounds > 0){ ?>
                            <?php echo $this->Form->create('Informations', ['action' => 'add_background', 'class' => 'dropzone', 'id' => 'myAwesomeDropzone', 'type' => 'file']); ?>
                                <div class="fallback">
                                    <input type="file" name="file">
                                </div>
                            <?php echo $this->Form->end(); ?>
                        <?php } else { ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> Aucun background trouvé, ajoutez en un ci-dessous
                            </div>
                            <?php echo $this->Form->create('Informations', ['action' => 'add_background', 'class' => 'dropzone', 'id' => 'myAwesomeDropzone', 'type' => 'file']); ?>
                                <div class="fallback">
                                    <input type="file" name="file">
                                </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>  
        </div>
        <div class="row">
            <?php foreach($backgrounds as $background){ ?>
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <p>
                                <i class="fa fa-file"></i> <b>Nom du fichier</b> : <?php echo $background; ?>
                            </p>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <center>
                                    <div class="hidden-xs hidden-sm hidden-md">
                                        <?php echo $this->Html->image('bg/'.$background, ['class' => '', 'width' => 200, 'height' => 200]); ?>
                                    </div>
                                    <div class="hidden-lg">
                                        <?php echo $this->Html->image('bg/'.$background, ['class' => '', 'width' => 100, 'height' => 100]); ?>
                                    </div>
                                </center>
                            </div>
                            <div class="ibox-content profile-content">
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo $this->Html->url(['controller' => 'informations', 'action' => 'update_background', $background]); ?>" class="btn btn-primary btn-xs btn-block"><i class="fa fa-check"></i> Utiliser</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo $this->Html->url(['controller' => 'informations', 'action' => 'delete_background', $background]); ?>" class="btn btn-white btn-xs btn-block"><i class="fa fa-trash-o"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>