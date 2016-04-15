<?php $this->assign('title', 'Editer un article'); ?>
<script type="text/javascript">
function verif(evt) {
    var keyCode = evt.which ? evt.which : evt.keyCode;
    var accept = 'abcdefghijklmnopqrstuvwxyz0123456789-';
    if(accept.indexOf(String.fromCharCode(keyCode)) >= 0){
        return true;
    }
    else{
        return false;
    }
}
$(document).ready(function(){
    $(window).load(function(){
        $('#chargement').empty()
        $('#content').fadeIn()
    });

    $('#auto_save').on('click', function(){
        if($('#auto_save').is(':checked')){
            $.bootstrapGrowl("<i class='fa fa-info-circle'></i> Sauvegarde automatique <u>activée</u>", {
              ele: 'body', 
              type: 'info', 
              offset: {from: 'top', amount: 20}, 
              align: 'center', 
              width: 'integer', 
              delay: 2000, 
              allow_dismiss: false, 
              stackup_spacing: 1
            });
        }
        else{
            $.bootstrapGrowl("<i class='fa fa-info-circle'></i> Sauvegarde automatique <u>desactivée</u>", {
              ele: 'body', 
              type: 'info', 
              offset: {from: 'top', amount: 20}, 
              align: 'center', 
              width: 'integer', 
              delay: 2000, 
              allow_dismiss: false, 
              stackup_spacing: 1
            });
        }
    });

    setInterval(function(){
        if($('#auto_save').is(":checked")){
            var id = '<?php echo $this->params['pass'][0]; ?>';
            var title = $('#PostTitle').val();
            var slug = $('#PostSlug').val();
            var cat = $('#PostCat').val();
            var content = CKEDITOR.instances['PostContent'].getData();
            var url = '<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'edit', $this->params['pass'][0])); ?>';
            $.post(url, {id: id, title: title, slug: slug, cat: cat, content: content}, function(data){
                $.bootstrapGrowl("<i class='fa fa-circle-o-notch fa-spin'></i> Sauvegarde automatique en cours", {
                  ele: 'body', 
                  type: 'info', 
                  offset: {from: 'top', amount: 20}, 
                  align: 'center', 
                  width: 'integer', 
                  delay: 3000, 
                  allow_dismiss: false, 
                  stackup_spacing: 1
                });
            });
        }
    }, 15000);
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modifier un article</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Post', array('class' => 'sky-form', 'type' => 'file', 'inputDefaults' => array('error' => false))); ?>
                            <!-- <div class="reg-header">  
                                <header>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'read', 'slug' => $data['Post']['slug'], 'id' => $data['Post']['id'])); ?>" target="_blank">Editer un article</a>
                                    <label class="toggle pull-right">
                                        <input type="checkbox" id="auto_save" checked="checked"><i></i> <small>Sauvegarde automatique</small>
                                    </label>
                                </header>
                            </div> -->
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('title'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                    <?php echo $this->Form->input('title', array('type' => 'text', 'value' => $data['Post']['title'], 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('cat'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <?php echo $this->Form->input('cat', array('type' => 'text', 'value' => $data['Post']['cat'], 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('slug'); ?></small></font>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <?php echo $this->Form->input('slug', array('type' => 'text', 'value' => $data['Post']['slug'], 'class' => 'form-control', 'onkeypress' => 'return verif(event);', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('img'); ?></small></font>
                                <font color="#A94442"><small><?php echo $this->Form->error('img_file'); ?></small></font>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group margin-bottom-20">
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                            <?php 
                                            if(filter_var($data['Post']['img'], FILTER_VALIDATE_URL)){
                                                echo $this->Form->input('img', array('type' => 'text', 'value' => $data['Post']['img'], 'class' => 'form-control', 'label' => false)).'<a href="'.$data['Post']['img'].'" target="_blank" class="input-group-addon"><i class="fa fa-external-link-square"></i></a>';
                                            }
                                            else{
                                                echo $this->Form->input('img', array('type' => 'text', 'value' => FULL_BASE_URL.'/img/posts/'.$data['Post']['img'], 'class' => 'form-control', 'label' => false)).'<a href="'.FULL_BASE_URL.'/img/posts/'.$data['Post']['img'].'" target="_blank" class="input-group-addon"><i class="fa fa-external-link-square"></i></a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pull-right">
                                            <input type="file" name="data[Post][img_file]" id="PostImgFile" onchange="this.parentNode.nextSibling.value = this.value">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="chargement"><?php echo $this->Html->image('loader.gif', array('alt' => 'chargement')); ?> Chargement de l'éditeur de texte en cours, veuillez patienter</div>
                                <div id="content" style="display:none;">
                                    <font color="#A94442"><small><?php echo $this->Form->error('content'); ?></small></font>
                                    <?php echo $this->Form->textarea('content', array('type' => 'textarea', 'rows' => '5', 'cols' => '5', 'value' => $data['Post']['content'], 'class' => 'ckeditor', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Éditer cet article</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>