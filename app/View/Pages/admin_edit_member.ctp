<?php $this->assign('title', 'Modifier un membre'); ?>
<script>
$(document).ready(function(){
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer le compte de cet utilisateur ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });

});
$(function() {
    $("select").selectBoxIt({
        showFirstOption: false
    });
    $('#PagesDname').keyup(function(){
        var dname = $('#PagesDname').val();
        if(dname != ''){
            $('#dname').html(dname);
        }
    });
    $('#PagesUsername').keyup(function(){
        var username = $('#PagesUsername').val();
        if(username != ''){
            $('#avatar').attr('src', 'https://cravatar.eu/helmhead/' + username + '/110.png');
        }
    });
    $('#PagesRank').keyup(function(){
        var rank = $('#PagesRank').val();
        if(rank == ''){
            rank = 'Rang';
        }
        $('#rank').html(rank);
    });
    $('#PagesFacebookUrl').change(function(){
        var facebook = $('#PagesFacebookUrl').val();
        if(facebook == ''){
            $('#facebook').attr('color', '#969696').hide().fadeIn(500);
            $('#facebook_link').attr('disabled', 'disabled').hide().fadeIn(500);
        }
        else{
            $('#facebook').attr('color', '#3498DB').hide().fadeIn(500);
            $('#facebook_link').removeAttr('disabled').hide().fadeIn(500);
        }
    });
    $('#PagesTwitterUrl').change(function(){
        var twitter = $('#PagesTwitterUrl').val();
        if(twitter == ''){
            $('#twitter').attr('color', '#969696').hide().fadeIn(500);
            $('#twitter_link').attr('disabled', 'disabled').hide().fadeIn(500);
        }
        else{
            $('#twitter').attr('color', '#27D7E7').hide().fadeIn(500);
            $('#twitter_link').removeAttr('disabled').hide().fadeIn(500);
        }
    });
    $('#PagesYoutubeUrl').change(function(){
        var youtube = $('#PagesYoutubeUrl').val();
        if(youtube == ''){
            $('#youtube').attr('color', '#969696').hide().fadeIn(500);
            $('#youtube_link').attr('disabled', 'disabled').hide().fadeIn(500);
        }
        else{
            $('#youtube').attr('color', '#CC0000').hide().fadeIn(500);
            $('#youtube_link').removeAttr('disabled').hide().fadeIn(500);
        }
    });
    $('#PagesColor').change(function(){
        var color = $('#PagesColor').val();
        $('#rank').attr('class', '');
        $('#rank').addClass('member-label member-label-' + color).hide().fadeIn(500);
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modifier un membre</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'list_member']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Pages', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('dname', array('type' => 'text', 'placeholder' => "Nom d'affichage", 'value' => $data['Team']['dname'], 'label' => "Nom d'affichage", 'class' => 'form-control', 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('username', array('type' => 'text', 'value' => $data['Team']['username'], 'class' => 'form-control', 'label' => 'Pseudo', 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('rank', array('type' => 'text', 'value' => $data['Team']['rank'], 'class' => 'form-control', 'label' => 'Fonction', 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('order', array('type' => 'number', 'value' => $data['Team']['order'], 'class' => 'form-control', 'label' => 'Ordre d\'affichage', 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('facebook_url', array('type' => 'url', 'value' => $data['Team']['facebook_url'], 'class' => 'form-control', 'label' => 'URL Facebook')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('twitter_url', array('type' => 'url', 'value' => $data['Team']['twitter_url'], 'class' => 'form-control', 'label' => 'URL Twitter')); ?>
                            </div>
                             <div class="form-group">
                                <?php echo $this->Form->input('youtube_url', array('type' => 'url', 'value' => $data['Team']['youtube_url'], 'class' => 'form-control', 'label' => 'URL YouTube')); ?>
                            </div>
                            <div class="form-group">
                                <select name="data[Pages][color]" class="form-control input-sm" id="PagesColor">
                                    <option value="">Couleur du badge</option>
                                    <option value="danger" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #D9534F;"></div> Rouge'>Rouge</option>
                                    <option value="orange" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #E67E22;"></div> Orange'>Orange</option>
                                    <option value="warning" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #F0AD4E;"></div> Jaune'>Jaune</option>
                                    <option value="primary" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #337AB7;"></div> Bleu foncé'>Bleu fonc&eacute;</option>
                                    <option value="info" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #5BC0DE;"></div> Bleu clair'>Bleu clair</option>
                                    <option value="success" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #5CB85C;"></div> Vert'>Vert</option>
                                    <option value="purple" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #9B6BCC;"></div> Violet'>Violet</option>
                                    <option value="grey" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #777777;"></div> Gris foncé'>Gris fonc&eacute;</option>
                                    <option value="light" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #ECF0F1;"></div> Gris clair'>Gris clair</option>
                                    <option value="brown" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #9C8061;"></div> Marron'>Marron</option>
                                    <option value="dark" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #555555;"></div> Noir'>Noir</option>
                                </select>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer la modification</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_member', $data['Team']['id']]); ?>" class="btn btn-danger confirm"><i class="fa fa-trash-o"></i> Supprimer ce membre</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Prévisualisation</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <br>
                        <a href="#">
                            <span>  
                                <center>
                                    <img src="https://cravatar.eu/helmhead/<?php echo $data['Team']['username']; ?>/110.png" alt="Player head" style="margin-top:5px;" id="avatar">
                                </center>
                            </span>                                              
                        </a>            
                        <div class="caption">
                            <center>
                                <?php
                                if(!empty($data['Team']['facebook_url'])){
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="facebook_link">
                                        <font color="#3498DB" id="facebook">
                                            <i class="fa fa-facebook-square"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="facebook_link" disabled="disabled">
                                        <font color="#969696" id="facebook">
                                            <i class="fa fa-facebook-square"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                if(!empty($data['Team']['twitter_url'])){
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="twitter_link">
                                        <font color="#27D7E7" id="twitter">
                                            <i class="fa fa-twitter"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="twitter_link" disabled="disabled">
                                        <font color="#969696" id="twitter">
                                            <i class="fa fa-twitter"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                if(!empty($data['Team']['youtube_url'])){
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="youtube_link">
                                        <font color="#CC0000" id="youtube">
                                            <i class="fa fa-youtube-square"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="#" target="_blank" class="btn btn-white btn-u-xs" id="youtube_link" disabled="disabled">
                                        <font color="#969696" id="youtube">
                                            <i class="fa fa-youtube-square"></i>
                                        </font>
                                    </a>
                                    <?php
                                }
                                ?>

                                <h3>
                                    <span id="dname">
                                        <?php echo $data['Team']['dname']; ?>
                                    </span>
                                </h3>
                                <span class="member-label member-label-<?php echo $data['Team']['color']; ?>" id="rank"><?php echo $data['Team']['rank']; ?></span>
                            </center>
                            <br></br>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>