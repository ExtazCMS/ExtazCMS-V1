<?php $this->assign('title', 'Vote et gagne'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
        	<div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
						<?php if($ban != 1){ ?>
						<?php if($role >= 0){ ?>
							<div class="col-md-12">
								<center>
									<div class="alert alert-info">
										<i class="fa fa-info-circle"></i>
										<?php
										if($nb_votes == 0){
											echo "Vous n'avez jamais voté pour le serveur";
										}
										else{
											echo "Vous avez voté $nb_votes fois, merci";
										}
										?>
									</div>
									<p><h2><?php echo $votes_description; ?></h2></p>
									<hr>
												<?php if(!empty($votes_url_1)){ ?>
														<?php if($time_to_vote_in_minutes_1 > 0){ ?>
															<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-red btn-u-lg"><center>Dispo dans<br />
															<?php if($time_to_vote_in_seconds_1 > 3600){
																if($time_to_vote_in_hours_1 > 1){
																	echo $time_to_vote_in_hours_1; ?> heures
																<?php } else {
																	echo $time_to_vote_in_hours_1; ?> heure
																<?php }
															} elseif($time_to_vote_in_seconds_1 < 60) {
																if($time_to_vote_in_seconds_1 > 1){
																	echo $time_to_vote_in_seconds_1; ?> secondes
																<?php } else {
																	echo $time_to_vote_in_seconds_1; ?> seconde
																<?php }
															} else {
																if($time_to_vote_in_minutes_1 > 1){
																	echo $time_to_vote_in_minutes_1; ?> minutes
																<?php } else {
																	echo $time_to_vote_in_minutes_1; ?> minute
																<?php }
															} ?>
															</center></a>
														<?php } else { ?>
														<a style="width:150px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $votes_url_1; ?>" class="btn-u btn-u-dark btn-u-lg" id="vote1" target="_blank" onclick="setTimeout(vote111, 1000); setTimeout(vote1111, 15000); setTimeout(vote1, 15000); setTimeout(vote11, 1000)"><center>Voter sur<br /><?php echo $votes_name_1; ?></center></a>
															<strong id="recompense1att">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-yellow btn-u-lg">
																	<center>En attente<br />de validation</center>
																</a>
															</strong>
															<strong id="recompense1">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'vote1']); ?>" class="btn-u btn-u-green btn-u-lg">
																	
																	<center>Confirmer<br />le vote</center>
																</a>
															</strong>
														<?php } ?>
												<?php } ?>
												<?php if(!empty($votes_url_2)){ ?>
														<?php if($time_to_vote_in_minutes_2 > 0){ ?>
															<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-red btn-u-lg"><center>Dispo dans<br />
															<?php if($time_to_vote_in_seconds_2 > 3600){
																if($time_to_vote_in_hours_2 > 1){
																	echo $time_to_vote_in_hours_2; ?> heures
																<?php } else {
																	echo $time_to_vote_in_hours_2; ?> heure
																<?php }
															} elseif($time_to_vote_in_seconds_2 < 60) {
																if($time_to_vote_in_seconds_2 > 1){
																	echo $time_to_vote_in_seconds_2; ?> secondes
																<?php } else {
																	echo $time_to_vote_in_seconds_2; ?> seconde
																<?php }
															} else {
																if($time_to_vote_in_minutes_2 > 1){
																	echo $time_to_vote_in_minutes_2; ?> minutes
																<?php } else {
																	echo $time_to_vote_in_minutes_2; ?> minute
																<?php }
															} ?>
															</center></a>
														<?php } else { ?>
														<a style="width:150px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $votes_url_2; ?>" class="btn-u btn-u-dark btn-u-lg" id="vote2" target="_blank" onclick="setTimeout(vote222, 1000); setTimeout(vote2222, 15000); setTimeout(vote2, 15000); setTimeout(vote22, 1000)"><center>Voter sur<br /><?php echo $votes_name_2; ?></center></a>
															<strong id="recompense2att">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-yellow btn-u-lg">
																	<center>En attente<br />de validation</center>
																</a>
															</strong>
															<strong id="recompense2">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'vote2']); ?>" class="btn-u btn-u-green btn-u-lg">
																	<center>Confirmer<br />le vote</center>
																</a>
															</strong>
														<?php } ?>
												<?php } ?>
												<?php if(!empty($votes_url_3)){ ?>
														<?php if($time_to_vote_in_minutes_3 > 0){ ?>
															<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-red btn-u-lg"><center>Dispo dans<br />
															<?php if($time_to_vote_in_seconds_3 > 3600){
																if($time_to_vote_in_hours_3 > 1){
																	echo $time_to_vote_in_hours_3; ?> heures
																<?php } else {
																	echo $time_to_vote_in_hours_3; ?> heure
																<?php }
															} elseif($time_to_vote_in_seconds_3 < 60) {
																if($time_to_vote_in_seconds_3 > 1){
																	echo $time_to_vote_in_seconds_3; ?> secondes
																<?php } else {
																	echo $time_to_vote_in_seconds_3; ?> seconde
																<?php }
															} else {
																if($time_to_vote_in_minutes_3 > 1){
																	echo $time_to_vote_in_minutes_3; ?> minutes
																<?php } else {
																	echo $time_to_vote_in_minutes_3; ?> minute
																<?php }
															} ?>
															</center></a>
														<?php } else { ?>
														<a style="width:150px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $votes_url_3; ?>" class="btn-u btn-u-dark btn-u-lg" id="vote3" target="_blank" onclick="setTimeout(vote333, 1000); setTimeout(vote3333, 15000); setTimeout(vote3, 15000); setTimeout(vote33, 1000)"><center>Voter sur<br /><?php echo $votes_name_3; ?></center></a>
															<strong id="recompense3att">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-yellow btn-u-lg">
																	<center>En attente<br />de validation</center>
																</a>
															</strong>
															<strong id="recompense3">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'vote3']); ?>" class="btn-u btn-u-green btn-u-lg">
																	<center>Confirmer<br />le vote</center>
																</a>
															</strong>
														<?php } ?>
												<?php } ?>
												<?php if(!empty($votes_url_4)){ ?>
														<?php if($time_to_vote_in_minutes_4 > 0){ ?>
															<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-red btn-u-lg"><center>Dispo dans<br />
															<?php if($time_to_vote_in_seconds_4 > 3600){
																if($time_to_vote_in_hours_4 > 1){
																	echo $time_to_vote_in_hours_4; ?> heures
																<?php } else {
																	echo $time_to_vote_in_hours_4; ?> heure
																<?php }
															} elseif($time_to_vote_in_seconds_4 < 60) {
																if($time_to_vote_in_seconds_4 > 1){
																	echo $time_to_vote_in_seconds_4; ?> secondes
																<?php } else {
																	echo $time_to_vote_in_seconds_4; ?> seconde
																<?php }
															} else {
																if($time_to_vote_in_minutes_4 > 1){
																	echo $time_to_vote_in_minutes_4; ?> minutes
																<?php } else {
																	echo $time_to_vote_in_minutes_4; ?> minute
																<?php }
															} ?>
															</center></a>
														<?php } else { ?>
														<a style="width:150px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $votes_url_4; ?>" class="btn-u btn-u-dark btn-u-lg" id="vote4" target="_blank" onclick="setTimeout(vote444, 1000); setTimeout(vote4444, 15000); setTimeout(vote4, 15000); setTimeout(vote44, 1000)"><center>Voter sur<br /><?php echo $votes_name_4; ?></center></a>
															<strong id="recompense4att">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-yellow btn-u-lg">
																	<center>En attente<br />de validation</center>
																</a>
															</strong>
															<strong id="recompense4">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'vote4']); ?>" class="btn-u btn-u-green btn-u-lg">
																	<center>Confirmer<br />le vote</center>
																</a>
															</strong>
														<?php } ?>
												<?php } ?>
												<?php if(!empty($votes_url_5)){ ?>
														<?php if($time_to_vote_in_minutes_5 > 0){ ?>
															<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-red btn-u-lg"><center>Dispo dans<br />
															<?php if($time_to_vote_in_seconds_5 > 3600){
																if($time_to_vote_in_hours_5 > 1){
																	echo $time_to_vote_in_hours_5; ?> heures
																<?php } else {
																	echo $time_to_vote_in_hours_5; ?> heure
																<?php }
															} elseif($time_to_vote_in_seconds_5 < 60) {
																if($time_to_vote_in_seconds_5 > 1){
																	echo $time_to_vote_in_seconds_5; ?> secondes
																<?php } else {
																	echo $time_to_vote_in_seconds_5; ?> seconde
																<?php }
															} else {
																if($time_to_vote_in_minutes_5 > 1){
																	echo $time_to_vote_in_minutes_5; ?> minutes
																<?php } else {
																	echo $time_to_vote_in_minutes_5; ?> minute
																<?php }
															} ?>
															</center></a>
														<?php } else { ?>
														<a style="width:150px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $votes_url_5; ?>" class="btn-u btn-u-dark btn-u-lg" id="vote5" target="_blank" onclick="setTimeout(vote555, 1000); setTimeout(vote5555, 15000); setTimeout(vote5, 15000); setTimeout(vote55, 1000)"><center>Voter sur<br /><?php echo $votes_name_5; ?></center></a>
															<strong id="recompense5att">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" class="btn-u btn-u-yellow btn-u-lg">
																	<center>En attente<br />de validation</center>
																</a>
															</strong>
															<strong id="recompense5">
																<a style="width:120px;height:70px;padding-left: 0px;padding-right: 0px;padding-top: 10px;padding-bottom: 10px;" href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'vote5']); ?>" class="btn-u btn-u-green btn-u-lg">
																	<center>Confirmer<br />le vote</center>
																</a>
															</strong>
														<?php } ?>
												<?php } ?>
									<br />
									<br />
									<a href="<?php echo $this->Html->url(['controller' => 'votes', 'action' => 'reward']); ?>" class="btn-u btn-u-dark btn-u-lg">
										Réclamer une récompense stockée.<br /><?php echo $reward; if($reward < 1){?> disponible !<?php } else { ?> disponibles !<?php } ?>
									</a>
									<br />
									<br />
									<br />
								</center>
							</div>
							<div class="vertical-separator"></div>
							<?php if($use_votes_ladder == 1) { ?>
							<div class="col-md-12">
								<i class="fa fa-trophy"></i> <b>Top <?php echo $votes_ladder_limit ?></b>
								<br><br>
								<table class="table top-5">
									<tbody>
									<?php
									$nb = 0;
									foreach($data as $d){
										$nb++;
										$limit= $votes_ladder_limit + 1;
										?>
										<tr>
											<?php if($nb == 1){ ?>
												<td>
													<?php echo $nb.'<small>er</small>'; ?>
												</td>
											<?php } elseif($nb < $limit) { ?>
												<td>
													<?php echo $nb.'<small>ème</small>'; ?>
												</td>
											<?php }
											if($nb < $limit){ ?>
											<td><?php echo $this->Html->image($d['User']['avatar'], ['class' => 'avatar-rounded', 'height' => 30, 'width' => 30]); ?> </td>
											<?php } else {}
											if($nb < $limit){ ?>
											<td>
												<b><?php echo $d['User']['username']; ?></b><br>
												<span class="text-muted"><small><?php echo $d['User']['votes']; ?> votes</small></span>
											</td>
											<?php } else {} ?>
										</tr>
										<?php
									}
									?>
									</tbody>
								</table>
							</div>
							<?php } ?>
						<?php } else { ?>
							<div class="alert alert-info">
								<i class="fa fa-info-circle"></i> "Cette page est en maintenance pour le momment!"
							</div>
						<?php } ?>
						<?php } else { ?>
							<div class="alert alert-info">
								<i class="fa fa-info-circle"></i> "Vous avez été banni du site. Vous n'avez plus accès à cette page!"
							</div>
						<?php } ?>
					</div>
                </div>
            </div>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->
<script type="text/javascript">
    $("#recompense1").hide();
    $("#recompense1att").hide();
    function vote1111() {
        $('#recompense1att').hide()
    }
    function vote111() {
        $('#recompense1att').show()
    }
    function vote1() {
        $('#recompense1').show()
    }
    function vote11() {
        $('#vote1').hide();
    }
	
	
    $("#recompense2").hide();
    $("#recompense2att").hide();
    function vote2222() {
        $('#recompense2att').hide()
    }
    function vote222() {
        $('#recompense2att').show()
    }
    function vote2() {
        $('#recompense2').show()
    }
    function vote22() {
        $('#vote2').hide();
    }
	
	
    $("#recompense3").hide();
    $("#recompense3att").hide();
    function vote3333() {
        $('#recompense3att').hide()
    }
    function vote333() {
        $('#recompense3att').show()
    }
    function vote3() {
        $('#recompense3').show()
    }
    function vote33() {
        $('#vote3').hide();
    }
	
	
    $("#recompense4").hide();
    $("#recompense4att").hide();
    function vote4444() {
        $('#recompense4att').hide()
    }
    function vote444() {
        $('#recompense4att').show()
    }
    function vote4() {
        $('#recompense4').show()
    }
    function vote44() {
        $('#vote4').hide();
    }
	
	
    $("#recompense5").hide();
    $("#recompense5att").hide();
    function vote5555() {
        $('#recompense5att').hide()
    }
    function vote555() {
        $('#recompense5att').show()
    }
    function vote5() {
        $('#recompense5').show()
    }
    function vote55() {
        $('#vote5').hide();
    }
</script>