<?php $this->assign('title', 'Meilleurs donateurs'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="donator_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>