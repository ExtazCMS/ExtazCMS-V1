<?php $this->assign('title', 'Mot de passe oublié'); ?>
<!--=== Content Part ===-->
<div class="container content">     
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('class' => 'sky-form')); ?>
                <div class="reg-header">  
                    <header>Mot de passe oublié</header>
                </div>
                <fieldset>
                    <section>
                        <small>1) Entrez l'adresse email avec laquelle vous vous êtes inscrit</small><br>
                        <small>2) Un nouveau mot de passe vous sera envoyé à l'email indiqué</small><br>
                        <small>3) Connectez vous avec ce nouveau mot de passe</small><br>
                        <small>4) Puis modifiez le depuis votre profil</small>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <?php echo $this->Form->input('email', array('type' => 'email', 'placeholder' => 'Votre adresse email', 'class' => 'form-control', 'label' => false)); ?>
                        </div>
                    </section>
                </fieldset>
                <footer>
                <div class="row">
                    <button class="btn-u pull-right" type="submit">Envoyer l'email</button>
                </div>
            </footer>
            <?php echo $this->Form->end(); ?>
        </div>
    </div><!--/row-->
</div><!--/container-->     
<!--=== End Content Part ===-->