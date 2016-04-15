<?php echo $this->assign('title', 'Erreur'); ?>
<!--=== Content Part ===-->
<div class="container content">		
    <!--Error Block-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <span class="error-v1-title">404</span>
                <span>Une erreur est survenue !</span>
                <p>La page à laquelle vous tentez d'accéder n'existe pas.</p>
                <?php echo $this->Html->link('Retour à l\'accueil', '/', array('class' => 'btn-u btn-bordered')); ?>
            </div>
        </div>
    </div>
    <!--End Error Block-->
</div>	
<!--=== End Content Part ===-->