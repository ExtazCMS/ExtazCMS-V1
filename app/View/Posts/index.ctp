<?php $this->assign('title', 'Accueil'); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer cet article ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <div class="col-md-9">
            <!-- Begin Content -->
            <?php if(($use_slider == 1 && $nb_posts >= 3) || $nb_posts == 1){ ?>
            <div class="carousel slide carousel-v1 margin-bottom-40 hidden-sm hidden-xs" id="myCarousel-1">
                <div class="carousel-inner">
					 <?php if($nb_posts > 1){ ?>
					 <?php for ($i=0; $i < 3; $i++){ ?>
                        <?php if($i == 0){ ?>
                        <div class="item active">
                        <?php } else { ?>
                        <div class="item">
                        <?php } ?>
                            <?php
                            if(filter_var($slider[$i]['Post']['img'], FILTER_VALIDATE_URL)){
                                echo '<img class="img-slider" src="'.$slider[$i]['Post']['img'].'">';
                            }
                            else{
                                echo '<img class="img-slider" src="'.$this->webroot.'img/posts/'.$slider[$i]['Post']['img'].'">';
                            }
                            ?>
                            <div class="carousel-caption">
                                <p>
                                    <?php
                                    $content = '<h3><font color="white">'.$slider[$i]['Post']['title'].'</font></h3>'.html_entity_decode(strip_tags($slider[$i]['Post']['content']));
                                    if(mb_strlen($content) > 400){
                                        echo mb_substr($content, 0, 400).'... <a href="'.$this->Html->url(['controller' => 'posts', 'action' => 'read', 'slug' => $slider[$i]['Post']['slug'], 'id' => $slider[$i]['Post']['id']]).'">Lire</a>';
                                    }
                                    else{
                                        echo $content.' <a href="'.$this->Html->url(['controller' => 'posts', 'action' => 'read', 'slug' => $slider[$i]['Post']['slug'], 'id' => $slider[$i]['Post']['id']]).'">Lire</a>';;
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
				 <?php } else { ?>	
					<?php for ($i=0; $i < 1; $i++){ ?>
                        <?php if($i == 0){ ?>
                        <div class="item active">
                        <?php } else { ?>
                        <div class="item">
                        <?php } ?>
                            <?php
                            if(filter_var($slider[$i]['Post']['img'], FILTER_VALIDATE_URL)){
                                echo '<img class="img-slider" src="'.$slider[$i]['Post']['img'].'">';
                            }
                            else{
                                echo '<img class="img-slider" src="'.$this->webroot.'img/posts/'.$slider[$i]['Post']['img'].'">';
                            }
                            ?>
                            <div class="carousel-caption">
                                <p>
                                    <?php
                                    $content = '<h3><font color="white">'.$slider[$i]['Post']['title'].'</font></h3>'.html_entity_decode(strip_tags($slider[$i]['Post']['content']));
                                    if(mb_strlen($content) > 400){
                                        echo mb_substr($content, 0, 400).'... <a href="'.$this->Html->url(['controller' => 'posts', 'action' => 'read', 'slug' => $slider[$i]['Post']['slug'], 'id' => $slider[$i]['Post']['id']]).'">Lire</a>';
                                    }
                                    else{
                                        echo $content.' <a href="'.$this->Html->url(['controller' => 'posts', 'action' => 'read', 'slug' => $slider[$i]['Post']['slug'], 'id' => $slider[$i]['Post']['id']]).'">Lire</a>';;
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
				<?php } ?>	
					
                </div>
                <?php if($nb_posts > 1){ ?>
                <div class="carousel-arrow">
                    <a data-slide="prev" href="#myCarousel-1" class="left carousel-control">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a data-slide="next" href="#myCarousel-1" class="right carousel-control">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
				<?php } ?>
            </div>
            <?php } ?>
			<?php if($nb_posts > 1){ ?>
            <?php $a = -1; ?>
            <?php $b = 5; ?>
            <?php while($a < $b){ ?>
            <!-- Post -->
            <div class="magazine-news">
                <div class="row">
                    <?php $a++; ?>
                    <?php if(!empty($articles[$a]['Post']['id'])){ ?>
                        <div class="col-md-6">
                            <div class="magazine-news-img">
                                <div class="hidden-xs hidden-sm">
                                    <?php
                                    if(filter_var($articles[$a]['Post']['img'], FILTER_VALIDATE_URL)){
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'"><img class="img-responsive" src="'.$articles[$a]['Post']['img'].'" alt=""></a>';
                                    }
                                    else{
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'"><img class="img-responsive" src="'.$this->webroot.'img/posts/'.$articles[$a]['Post']['img'].'" alt=""></a>';
                                    }
                                    ?>
                                    <span class="magazine-badge label-green"><?php echo $articles[$a]['Post']['cat']; ?></span>
                                </div>                               
                            </div>
                            <h3>
                                <?php
                                if(mb_strlen($articles[$a]['Post']['title']) > 35){
                                    echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'">'.mb_substr($articles[$a]['Post']['title'], 0, 35).' [...]'.'</a>';
                                }
                                else{
                                    echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'">'.$articles[$a]['Post']['title'].'</a>';
                                }
                                ?>
                            </h3>
                            <div class="by-author">
                                <strong><?php echo $articles[$a]['Post']['author']; ?></strong>
                                <span>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])); ?>" class="btn btn-default btn-xs">
                                        <i class="fa fa-heart"></i> <?php echo count($articles[$a]['Like']); ?>
                                    </a>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])); ?>" class="btn btn-default btn-xs">
                                        <i class="fa fa-comments"></i> <?php echo count($articles[$a]['Comment']); ?>
                                    </a>
                                </span>
                            </div>
                            <p class="text-justify">
                                <?php
                                $content = html_entity_decode(strip_tags($articles[$a]['Post']['content']));
                                if(mb_strlen($content) > 315){
                                    echo mb_substr($content, 0, 315).' [...]';
                                }
                                else{
                                    echo $content;
                                }
                                ?>
                            </p>
                        </div>
                    <?php } ?>
                    <?php $a++; ?>
                    <?php if(!empty($articles[$a]['Post']['id'])){ ?>
                        <div class="col-md-6">
                            <div class="magazine-news-img">
                                <div class="hidden-xs hidden-sm">
                                    <?php
                                    if(filter_var($articles[$a]['Post']['img'], FILTER_VALIDATE_URL)){
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'"><img class="img-responsive" src="'.$articles[$a]['Post']['img'].'" alt=""></a>';
                                    }
                                    else{
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'"><img class="img-responsive" src="'.$this->webroot.'img/posts/'.$articles[$a]['Post']['img'].'" alt=""></a>';
                                    }
                                    ?>
                                    <span class="magazine-badge label-green"><?php echo $articles[$a]['Post']['cat']; ?></span>
                                </div>                               
                            </div>
                            <h3>
                                <?php
                                if(mb_strlen($articles[$a]['Post']['title']) > 35){
                                    echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'">'.mb_substr($articles[$a]['Post']['title'], 0, 35).' [...]'.'</a>';
                                }
                                else{
                                    echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])).'">'.$articles[$a]['Post']['title'].'</a>';
                                }
                                ?>
                            </h3>
                            <div class="by-author">
                                <strong><?php echo $articles[$a]['Post']['author']; ?></strong>
                                <span>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])); ?>" class="btn btn-default btn-xs">
                                        <i class="fa fa-heart"></i> <?php echo count($articles[$a]['Like']); ?>
                                    </a>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $articles[$a]['Post']['slug'], 'id' => $articles[$a]['Post']['id'])); ?>" class="btn btn-default btn-xs">
                                        <i class="fa fa-comments"></i> <?php echo count($articles[$a]['Comment']); ?>
                                    </a>
                                </span>
                            </div>
                            <p class="text-justify">
                                <?php
                                $content = html_entity_decode(strip_tags($articles[$a]['Post']['content']));
                                if(mb_strlen($content) > 315){
                                    echo mb_substr($content, 0, 315).' [...]';
                                }
                                else{
                                    echo $content;
                                }
                                ?>
                            </p>
                        </div>
                    <div class="margin-bottom-35"><hr class="hr-md"></div>
                    <?php } ?>
                </div>
            </div>
            <!-- End Post -->
            <?php } ?>
			 <?php } ?>
            <!--Pagination-->
            <div class="text-center">
                <ul class="pagination">
                    <?php
                    if($nb_posts > 6){
                        echo '<li>'.$this->Paginator->prev(__('«'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a')).'</li>';
                        echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 'Première', 'last' => 'Dernière', 'ellipsis' => ''));
                        echo '<li>'.$this->Paginator->next(__('»'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a')).'</li>';
                        echo '<br><br>';
                    }
                    ?>
                </ul>                                                            
            </div>
            <!--End Pagination-->
        </div>
        <!-- End Content -->
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->