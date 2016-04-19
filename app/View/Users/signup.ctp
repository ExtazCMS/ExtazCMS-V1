<?php $this->assign('title', 'Inscription'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <?php echo $this->Form->create('User', array('class' => 'sky-form', 'inputDefaults' => array('error' => false)));?>
                <div class="reg-header">
                    <header>Inscription</header>
                </div>
                <fieldset>
                    <section>
                        <font color="#A94442"><small><?php echo $this->Form->error('username'); ?></small></font>
                        <label class="input">
                            <i class="icon-prepend fa fa-user"></i>
                            <i class="icon-append fa fa-question-circle"></i>
                            <?php
                            if(isset($this->request->query['username']) && !empty($this->request->query['username'])){
                                $username = $this->request->query['username'];
                                echo $this->Form->input('username', array('type' => 'text', 'value' => $username, 'class' => 'form-control', 'label' => false, 'div' => false, 'required' => 'required'));
                            }
                            else{
                                echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Pseudo', 'class' => 'form-control', 'label' => false, 'div' => false, 'required' => 'required'));
                            }
                            ?>
                            <b class="tooltip tooltip-bottom-right">
                                Veuillez entrer votre véritable pseudo Minecraft, celui que vous utiliser sur le serveur.<br>
                                De plus il est nécessaire de bien respecter les majuscules, merci !
                            </b>
                        </label>
                    </section>
                </fieldset> 
                <fieldset>
                    <section>
                        <font color="#A94442"><small><?php echo $this->Form->error('email'); ?></small></font>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <?php echo $this->Form->input('email', array('type' => 'email', 'placeholder' => 'Adresse email', 'class' => 'form-control', 'label' => false, 'div' => false, 'required' => 'required')); ?>
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <font color="#A94442"><small><?php echo $this->Form->error('password'); ?></small></font>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Mot de passe', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <font color="#A94442"><small><?php echo $this->Form->error('password_confirmation'); ?></small></font>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <?php echo $this->Form->input('password_confirmation', array('type' => 'password', 'placeholder' => 'Confirmation', 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                        </div>
                    </section>
                </fieldset>
                <footer>
                <input name="captcha" class="btn-u pull-right" type="Submit" value="Confirmer l'inscription">
                </footer>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div><!--/container-->     
<!--=== End Content Part ===-->