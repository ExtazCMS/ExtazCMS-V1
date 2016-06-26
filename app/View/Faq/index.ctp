<?php $this->assign('title', 'F.A.Q'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-9">
            <div class="header"> <h4 style="margin-top: 0;">F.A.Q</h4></div>
            <div class="ibox-content">
                <div class="chat-messages">
                    <?php foreach($data as $faq) { ?>
                        <div class="faq_q"><?= $faq["Faq"]["question"]; ?></div>
                        <div class="faq_a"><?= $faq["Faq"]["answer"]; ?></div>
                    <?php } ?>
                </div>
                <hr>
            </div>
        </div>
        <!-- End Left Sidebar -->
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->
</div><!--/container-->
<!--=== End Content Part ===-->