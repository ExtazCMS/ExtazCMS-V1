<?php $this->assign('title', 'Modifier un utilisateur'); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer le compte de cet utilisateur ?",
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
                        <h5>Modifier un utilisateur</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'all']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('User', ['class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('username'); ?></small></font>
                                <?php echo $this->Form->input('username', array('type' => 'text', 'value' => $data['User']['username'], 'class' => 'form-control', 'label' => 'Pseudo')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('email'); ?></small></font>
                                <?php echo $this->Form->input('email', array('type' => 'email', 'value' => $data['User']['email'], 'class' => 'form-control', 'label' => 'Email')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('tokens'); ?></small></font>
                                <?php echo $this->Form->input('tokens', array('type' => 'number', 'value' => $data['User']['tokens'], 'class' => 'form-control', 'label' => 'Tokens')); ?>
                                </section>
                            </div>
                            <div class="form-group">
                                <label>Rang</label>
                                <font color="#A94442"><small><?php echo $this->Form->error('role'); ?></small></font>
                                <?php if($data['User']['role'] == 2){ ?>
                                <select name="data[User][role]" class="form-control" label="Rang" id="UserRole">
                                    <option value="2">Administrateur</option>
                                    <option value="1">Modérateur</option>
                                    <option value="0">Utilisateur</option>
                                </select>
                                <?php } elseif($data['User']['role'] == 1) { ?>
                                <select name="data[User][role]" class="form-control" label="Rang" id="UserRole">
                                    <option value="1">Modérateur</option>
                                    <option value="2">Administrateur</option>
                                    <option value="0">Utilisateur</option>
                                </select>
                                <?php } else { ?>
                                <select name="data[User][role]" class="form-control" label="Rang" id="UserRole">
                                    <option value="0">Utilisateur</option>
                                    <option value="1">Modérateur</option>
                                    <option value="2">Administrateur</option>
                                </select>
                                <?php } ?>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-sm btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer la modification</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'delete', $data['User']['id']]); ?>" class="btn btn-sm btn-danger confirm"><i class="fa fa-trash-o"></i> Supprimer ce compte</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php if($use_store == 1){ ?>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Octroyer un prérequis à cet utilisateur</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'all']); ?>">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?php echo $this->Form->create('Shop', ['action' => 'add_prerequisite', 'class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                                <?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $data['User']['id'])); ?>
                                <div class="form-group">
                                    <select name="data[Shop][item]" class="form-control" id="ShopItem">
                                        <?php
                                        foreach($items as $i){
                                            echo '<option value="'.$i['Shop']['id'].'">'.$i['Shop']['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <button class="btn btn-w-m btn-sm btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer l'ajout</button>
                                    </div>
                                </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Avatar</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'all']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <p>
                            Vous pouvez réinitialiser l'avatar de cet utilisateur en utilisant le bouton ci-dessous
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                            <hr>
                            <span class="bordered">
                                <?php echo $this->Html->image($data['User']['avatar'], ['height' => 22, 'width' => 22]); ?> Avatar de <?php echo $data['User']['username']; ?>
                            </span>
                            <a class="btn btn-w-m btn-primary btn-sm pull-right" href="<?php echo $this->Html->url(['controller' => 'avatars', 'action' => 'reset', $data['User']['id']]); ?>"><i class="fa fa-check"></i> Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

</div>