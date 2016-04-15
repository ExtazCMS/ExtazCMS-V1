<?php $this->assign('title', 'Mes tickets'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
            <?php if($nbTickets > 0){ ?>
            <ul class="timeline-v2">
                <?php foreach($data as $d){ ?>
                    <li>
                        <time class="cbp_tmtime" datetime=""><span><?php echo $this->Time->format('d/m/Y', $d['Support']['created']); ?></span> <span><?php echo $this->Time->format('H\hi', $d['Support']['created']); ?></span></time>
                        <i class="cbp_tmicon rounded-x hidden-xs"></i>
                        <div class="cbp_tmlabel">
                            <h2>
                                <?php
                                switch($d['Support']['priority']){
                                    case '1':
                                        echo '<small><span class="text-highlights text-highlights-green">Priorité basse</span></small>';
                                        break;
                                    case '2':
                                        echo '<small><span class="text-highlights text-highlights-blue">Priorité moyenne</span></small>';
                                        break;
                                    case '3':
                                        echo '<small><span class="text-highlights text-highlights-orange">Priorité haute</span></small>';
                                        break;
                                    case '4':
                                        echo '<small><span class="text-highlights text-highlights-red">Priorité très haute</span></small>';
                                        break;
                                }
                                ?>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'view_ticket', 'id' => $d['Support']['id']]); ?>" class="btn btn-default btn-sm pull-right">
                                    <i class="fa fa-list"></i>Consulter les réponses
                                </a>
                                <?php if($d['Support']['resolved'] == 0){ ?>
                                <small>
                                    <span class="text-highlights text-highlights-green">
                                        <i class="fa fa-clock-o"></i>Ticket ouvert
                                    </span>
                                </small>
                                <?php } else { ?>
                                <small>
                                    <span class="text-highlights text-highlights-red">
                                        <i class="fa fa-lock"></i>Ticket fermé
                                    </span>
                                </small>
                                <?php } ?>
                            </h2>
                            <p>
                                <?php
                                $content = strip_tags($d['Support']['message']);
                                if(strlen($content) < 380){
                                    echo $content;
                                }
                                else{
                                    echo substr($content, 0, 380).'...';
                                }
                                ?>
                            </p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <div class="servive-block servive-block-default">
                <i class="icon-custom icon-color-dark rounded-x fa fa-info-circle"></i>
                <h2 class="heading-md">Aucun résultat</h2>
                <p>Vous n'avez envoyé aucun ticket au support</p>                        
            </div>
            <?php } ?>
        </div>
        <!-- End Content -->
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->