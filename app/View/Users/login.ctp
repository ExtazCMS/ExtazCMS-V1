<?php $this->assign('title', 'Connexion'); ?>
<script>
$(document).ready(function(){
    $('#UserUsername').focus();
    $('#create_account').on('click', function(){
        $('.password').hide();
        $('.footer_login').hide();
        $('.footer_create_account').fadeIn(350);
        $('header[class=login]').hide();
        $('header[class=create_account]').fadeIn(350);
        var url = '<?php echo $this->Html->url(['controller' => 'users', 'action' => 'signup', '?' => ['username' => '']]); ?>';
        var username = $('#UserUsername').val();
        var link = url + username;
        $('#link_create_account').attr('href', link);
        $('#UserUsername').focus();
    });
    $('#login').on('click', function(){
        $('.password').fadeIn(350);
        $('.footer_login').fadeIn(350);
        $('.footer_create_account').hide();
        $('header[class=login]').fadeIn(350);
        $('header[class=create_account]').hide();
        $('#UserPassword').focus();
    });
});
</script>
<!--=== Content Part ===-->
<div class="container content">     
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('class' => 'sky-form')); ?>
                <div class="reg-header">  
                    <header class="login">Connexion à l'espace membre</header>
                    <header class="create_account" style="display:none;">Inscription</header>
                </div>
                <fieldset>
                    <section>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Pseudo', 'class' => 'form-control', 'label' => false)); ?>
                        </div>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                Vous avez déjà un compte ?
                            </div>
                            <div class="col-md-6 pull-left">
                                <label class="radio">
                                    <input type="radio" name="radio" id="create_account" checked=""><i class="rounded-x"></i>Non en créer un maintenant
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio" id="login" checked="checked"><i class="rounded-x"></i>Oui mon mot de passe est
                                </label>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <fieldset class="password">
                    <section>
                        <label class="input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Mot de passe', 'class' => 'form-control', 'label' => false)); ?>
                            </div>
                        </label>
                        <div class="note pull-right">
                            <?php echo $this->Html->link('Mot de passe oublié ?', ['controller' => 'users', 'action' => 'forgot_password'], array('class' => 'modal-opener')); ?>
                        </div>
                        <br>
                    </section>
                </fieldset>
                <footer class="footer_login">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="checkbox">
                                <input type="checkbox" name="data[User][rememberMe]" id="UserRememberMe" checked=""><i></i> Rester connecté
                            </label>
                        </div>
                        <div class="col-md-8">
                            <button class="btn-u pull-right" type="submit">Se connecter</button>                        
                        </div>
                    </div>
                </footer>
                <footer class="footer_create_account" style="display:none;">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn-u pull-right" type="submit" id="link_create_account">Poursuivre mon inscription</a>                        
                        </div>
                    </div>
                </footer>
            <?php echo $this->Form->end(); ?>
        </div>
    </div><!--/row-->
</div><!--/container-->     
<!--=== End Content Part ===-->