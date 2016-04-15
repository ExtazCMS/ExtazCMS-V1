<?php $this->assign('title', 'Achats PayPal'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="paypal_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>