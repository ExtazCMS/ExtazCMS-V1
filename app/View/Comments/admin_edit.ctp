<?php $this->assign('title', 'Editer un commentaire'); ?>
<?php
if($data['User']['username'] == null){
    $data['User']['username'] = '{Compte supprimé}';
}
?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer ce commentaire ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<div class="main-content">
    <div class="container">  
        <div class="row">
            <div class="col-md-4">
                <div class="page-content">
                    <div class="single-head">
                        <h3 class="pull-left"><i class="fa fa-pencil-square-o"></i>Editer un commentaire</h3>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo $this->Form->create('Comments', ['class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                        <div class="form-group">
                            <?php echo $this->Form->input('author', array('type' => 'text', 'value' => $data['User']['username'], 'class' => 'form-control', 'label' => 'Pseudo', 'disabled' => 'disabled')); ?>
                            </section>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('ip', array('type' => 'text', 'value' => $data['Comment']['ip'], 'class' => 'form-control', 'label' => 'Adresse IP', 'disabled' => 'disabled')); ?>
                            </section>
                        </div>
                        <div class="form-group">
                            <label>Commentaire</label>
                            <?php echo $this->Form->textarea('comment', array('type' => 'text', 'value' => $data['Comment']['comment'], 'class' => 'form-control')); ?>
                            </section>
                        </div>
                        <hr>
                        <button class="btn btn-black pull-right" type="submit"><i class="fa fa-check"></i> Confirmer la modification</button>
                        <a href="<?php echo $this->Html->url(['controller' => 'comments', 'action' => 'delete', $data['Comment']['id'], 'edit']); ?>" class="btn btn-danger confirm"><i class="fa fa-trash-o"></i> Supprimer ce commentaire</a>
                    <?php echo $this->Form->end(); ?>
                </div>
            <div class="col-md-8"></div>
        </div>
    </div>
</div>