<?php $this->assign('title', 'Achats Starpass'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="starpass_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>