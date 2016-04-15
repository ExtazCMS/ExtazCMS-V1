<?php $this->assign('title', 'Espace disque du serveur'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="disk_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>