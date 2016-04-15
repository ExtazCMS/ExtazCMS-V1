<?php
echo $this->assign('title', 'Maintenance');
if((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))){
    $this->layout = 'default';
}
?>
<!--=== Content Part ===-->
<div class="container content">     
    <!--Error Block-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <div class="hidden-xs hidden-sm">
                    <?php echo $this->Html->image('maintenance.jpg'); ?>
                </div>
            	<h3>
            		L'équipe de <b><?php echo $name_server; ?></b> s'éfforce de rétablir l'accès au site web.<br>
            		Excusez-nous pour la gêne occasionée. Restez au courant de l'actualité du serveur en nous suivant sur les réseaux sociaux !<br><br>
            	</h3>
            	<h4>
            		Le staff <b><?php echo $name_server; ?></b>.
            	</h4>
				<hr>
				<?php // v1 à v7 ?>
		        <div class="tag-box tag-box-v4">
                    <center>
						<?php if(!$connected){ ?>
                    		<a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'login']); ?>" class="btn-u btn-u btn-u-xs" style="margin-bottom: 3px;margin-top: 3px"><i class="fa fa-user"></i> Connexion</a> 
                    	<?php } else { ?>
                    		<a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'logout']); ?>" class="btn-u btn-u btn-u-xs" style="margin-bottom: 3px;margin-top: 3px"><i class="fa fa-sign-out"></i> Déconnexion</a> 
                    	<?php } ?>
                    	<?php
                        if(!empty($buttons)){
	                        foreach($buttons as $b){
	                            echo '<a href="'.$b['Button']['url'].'" target="_blank" class="btn-u btn-u-'.$b['Button']['color'].' btn-u-xs" style="margin-bottom: 3px;margin-top: 3px" type="button"><i class="fa fa-'.$b['Button']['icon'].'"></i> '.$b['Button']['content'].'</a> ';
	                        }
	                    }
                        ?>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!--End Error Block-->
</div>  
<!--=== End Content Part ===-->