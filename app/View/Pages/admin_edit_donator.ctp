<?php $this->assign('title', 'Modifier un utilisateur'); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment retirer cet utilisateur du classement ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modifier un utilisateur dans le classement</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_donator']); ?>">
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
                                <font color="#A94442"><small><?php echo $this->Form->error('username'); ?></small></font>
                                <?php echo $this->Form->input('username', array('type' => 'text', 'value' => $data['User']['username'], 'class' => 'form-control', 'label' => 'Pseudo', 'disabled' => 'disabled')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('email'); ?></small></font>
                                <?php echo $this->Form->input('email', array('type' => 'email', 'value' => $data['User']['email'], 'class' => 'form-control', 'label' => 'Email', 'disabled' => 'disabled')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('tokens'); ?></small></font>
                                <?php echo $this->Form->input('tokens', array('type' => 'number', 'value' => $data['User']['tokens'], 'class' => 'form-control', 'label' => ucfirst($site_money).' (actuel)', 'disabled' => 'disabled')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('tokens_ladder'); ?></small></font>
                                <?php echo $this->Form->input('tokens_ladder', array('type' => 'number', 'value' => $data['donationLadder']['tokens'], 'class' => 'form-control', 'label' => ucfirst($site_money).' achetés (total)')); ?>
                                </section>
                            </div>
                            <?php echo $this->Form->input('updated', array('type' => 'hidden', 'value' => $data['donationLadder']['updated'])); ?>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer la modification</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_donator', $data['donationLadder']['id']]); ?>" class="btn btn-danger confirm"><i class="fa fa-trash-o"></i> Retirer du classement</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>