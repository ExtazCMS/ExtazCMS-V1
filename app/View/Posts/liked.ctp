<?php $this->assign('title', 'Articles que j\'ai aimé'); ?>
<!--=== Content Part ===-->
<div class="container content">     
    <div class="row blog-page">    
        <!-- Left Sidebar -->
        <div class="col-md-9 md-margin-bottom-40">
            <?php if($nbPosts > 0): ?>
                <?php foreach($posts as $p): ?>
                    <!--Blog Post-->
                    <div class="row">
                        <div class="hidden-xs hidden-sm hidden-md">
                            <div class="col-md-5">
                                <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])); ?>">
                                    <?php
                                    if(filter_var($p['Post']['img'], FILTER_VALIDATE_URL)){
                                        echo $this->Html->image($p['Post']['img'], array('alt' => '', 'height' => '180', 'style' => 'width:100%;'));
                                    }
                                    else{
                                        echo $this->Html->image('posts/'.$p['Post']['img'], array('alt' => '', 'height' => '180', 'style' => 'width:100%;'));
                                    }
                                    ?>
                                </a>
                            </div>    
                            <div class="col-md-7">
                                <h2>
                                    <?php
                                    if(mb_strlen($p['Post']['title']) > 35):
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])).'">'.mb_substr($p['Post']['title'], 0, 35).' [...]'.'</a>';
                                    else:
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])).'">'.$p['Post']['title'].'</a>';
                                    endif;
                                    ?>
                                </h2>
                                <ul class="list-unstyled list-inline blog-info">
                                    <li><i class="fa fa-calendar"></i> <?php echo $this->Time->format('d/m/Y à H:i', $p['Post']['posted']); ?></li>
                                    <li><i class="fa fa-user"></i> <?php echo $p['Post']['author']; ?></li>
                                    <li><i class="fa fa-tags"></i> <?php echo $p['Post']['cat']; ?></li>
                                    <li>
                                        <?php if($this->Session->read('Auth.User.role') > 0): ?>
                                            <span class="btn-group">
                                                <a href="<?php echo $this->Html->webroot.'posts/edit/'.$p['Post']['id']; ?>" class="btn btn-default btn-xs">
                                                    <font color="#777777"><i class="fa fa-pencil"></i>
                                                    </font>
                                                </a>
                                                <a href="<?php echo $this->Html->webroot.'posts/delete/'.$p['Post']['id']; ?>" class="confirm btn btn-default btn-xs">
                                                    <font color="red"><i class="fa fa-times"></i></font>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])) ?>" class="btn btn-default btn-xs"><i class="fa fa-paper-plane"></i> Lire la suite</a>
                                    </li>
                                </ul>
                                <p class="text-justify">
                                    <?php
                                    $content = ltrim(html_entity_decode(strip_tags($p['Post']['content'])));

                                    if(mb_strlen($content) > 305): echo mb_substr($content, 0, 305).' [...]';
                                    else: echo $content; endif;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="hidden-lg">
                            <div class="col-md-12">
                                <h2>
                                    <?php
                                    if(mb_strlen($p['Post']['title']) > 35):
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])).'">'.mb_substr($p['Post']['title'], 0, 35).' [...]'.'</a>';
                                    else:
                                        echo '<a href="'.$this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])).'">'.$p['Post']['title'].'</a>';
                                    endif;
                                    ?>
                                </h2>
                                <ul class="list-unstyled list-inline blog-info">
                                    <li><i class="fa fa-calendar"></i> <?php echo $this->Time->format('d/m/Y à H:i', $p['Post']['posted']); ?></li>
                                    <li><i class="fa fa-user"></i> <?php echo $p['Post']['author']; ?></li>
                                    <li><i class="fa fa-tags"></i> <?php echo $p['Post']['cat']; ?></li>
                                    <li>
                                        <?php if($this->Session->read('Auth.User.role') > 0): ?>
                                            <span class="btn-group">
                                                <a href="<?php echo $this->Html->webroot.'posts/edit/'.$p['Post']['id']; ?>" class="btn btn-default btn-xs">
                                                    <font color="#777777"><i class="fa fa-pencil"></i>
                                                    </font>
                                                </a>
                                                <a href="<?php echo $this->Html->webroot.'posts/delete/'.$p['Post']['id']; ?>" class="confirm btn btn-default btn-xs">
                                                    <font color="red"><i class="fa fa-times"></i></font>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $p['Post']['slug'], 'id' => $p['Post']['id'])); ?>" class="btn btn-default btn-xs"><i class="fa fa-paper-plane"></i> Lire la suite</a>
                                    </li>
                                </ul>
                                <p class="text-justify">
                                    <?php
                                    $content = ltrim(html_entity_decode(strip_tags($p['Post']['content'])));

                                    if(mb_strlen($content) > 600): echo mb_substr($content, 0, 600).' [...]';
                                    else: echo $content; endif;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="margin-bottom-40">
                    <!--End Blog Post-->
                <?php endforeach; ?>
            <?php else: ?>
                <div class="servive-block servive-block-default">
                    <i class="icon-custom icon-color-dark rounded-x fa fa-meh-o"></i>
                    <h2 class="heading-md">Vous n'avez aimé aucun article</h2>
                    <p>Vous pensez que c'est une erreur ? Vous avez peut-être aimé un article alors vous n'étiez pas connecté...</p>                        
                </div>
            <?php endif; ?>
        </div>
        <!-- End Left Sidebar -->
        <?php echo $this->element('sidebar'); ?>
    </div><!--/row-->        
</div><!--/container-->     
<!--=== End Content Part ===-->