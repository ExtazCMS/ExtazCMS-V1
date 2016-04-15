<?php $this->assign('title', 'Utilisateurs inscrits'); ?>
<div class="wrapper wrapper-content" style="width:750px;">
    <div class="animated fadeInRightBig">
		<div id="user_chart"></div>
		<?php echo $this->Highcharts->render($chartName); ?>
	</div>
</div>