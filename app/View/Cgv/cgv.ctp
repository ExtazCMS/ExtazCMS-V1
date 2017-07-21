<?php $this->assign('title', 'Conditions Générales de Vente'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
			<?php if(!empty($cgvandcgu)){
				echo $cgvandcgu ?><br />
				<?php if($connected){
					if($cgvcgu == 0) { ?>
						<center>
							<a href="<?php echo $this->Html->url(['controller' => 'cgv', 'action' => 'ok']); ?>" class="btn-u btn-u-dark btn-u-lg"></i> J'accepte les CGV/CGU</a>
						</center>
					<?php } else { ?>
						<center>
							<a href="<?php echo $this->Html->url(['controller' => 'cgv', 'action' => 'cgv']); ?>" class="btn-u btn-u-dark btn-u-lg"> CGV/CGU déjà acceptées</a>
						</center>
					<?php }
				} else { ?>
					<div class="alert alert-info">
						<i class="fa fa-info-circle"></i> "Vous devez vous connecter pour accepter les CGV/CGU !"
					</div>
				<?php }
			} else { ?>
				<div class="alert alert-info">
					<i class="fa fa-info-circle"></i> "Les CGV/CGU n'ont pas encore été rédigé!"
				</div>
			<?php } ?>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->