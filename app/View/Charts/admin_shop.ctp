<?php $this->assign('title', 'Achats boutique'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="shop_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>