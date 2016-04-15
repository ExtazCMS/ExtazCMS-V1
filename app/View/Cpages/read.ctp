<?php $this->assign('title', $data['Cpage']['name']); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <?php
        if($data['Cpage']['sidebar'] == 1){
        	echo '<div class="col-md-9">';
        }
        else{
        	echo '<div class="col-md-12">';
        }
        ?>
            <?php echo $content; ?>
        </div>
        <!-- End Content -->
        <?php if($data['Cpage']['sidebar'] == 1) echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->