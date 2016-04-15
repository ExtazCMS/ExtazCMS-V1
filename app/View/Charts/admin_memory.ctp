<?php $this->assign('title', 'Mémoire vive du serveur'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="memory_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>