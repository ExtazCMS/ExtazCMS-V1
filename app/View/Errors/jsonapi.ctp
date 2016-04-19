<?php
echo $this->assign('title', 'Erreur');
if((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))){
    $this->layout = 'default';
}
?>
<!--=== Content Part ===-->
<div class="container content">     
    <!-- Error Block-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <div class="hidden-xs hidden-sm">
                    <?php echo $this->Html->image('creeper.jpg', ['width' => '40%', 'height' => '40%', 'style' => 'margin-bottom: 15px;opacity: 0.8;']); ?>
                </div>
            	<h3>
            		Impossible de recevoir des données depuis le serveur, si vous êtes l'administrateur de ce site web vérifiez les réglages de JSONAPI.
            	</h3>
            </div>
        </div>
    </div>
    <!-- End Error Block-->
</div>  
<!--=== End Content Part ===-->