<?php $this->assign('title', 'Modifier un bouton'); ?>
<script type="text/javascript">
$(function() {
    $('#ButtonsContent').keyup(function(){
        var content = $('#ButtonsContent').val();
        var icon = $('#ButtonsIcon').val();
        if(content == ''){
            content = 'Votre texte ici';
        }
        if(icon == -1){
            $('#apercu').html('<i class="fa fa-question-circle"></i> ' + ' ' + content);
        }
        else{
            $('#apercu').html('<i class="fa fa-' + icon + '"></i> ' + ' ' + content);
        }
    });
    $('#ButtonsIcon').change(function(){
        var content = $('#ButtonsContent').val();
        var icon = $('#ButtonsIcon').val();
        if(content == ''){
            $('#apercu').html('<i class="fa fa-' + icon + '"></i> ' + 'Texte à afficher');
        }
        else{
            $('#apercu').html('<i class="fa fa-' + icon + '"></i> ' + ' ' + content);
        }
    });
    $('#ButtonsColor').change(function(){
        var color = $('#ButtonsColor').val();
        $('#apercu').attr('class', '');
        $('#apercu').addClass('btn-u btn-u-' + color + ' btn-u-lg');
    });
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer ce bouton ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
    $(".select").selectBoxIt({
        showFirstOption: false
    });
});
</script>

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modifier un bouton dans la sidebar</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'index']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Buttons', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('content', array('type' => 'text', 'value' => $data['Button']['content'], 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('url', array('type' => 'url', 'value' => $data['Button']['url'], 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('order', array('type' => 'number', 'value' => $data['Button']['order'], 'class' => 'form-control', 'label' => false, 'required' => 'required')); ?>
                            </div>
                            <div class="form-group">
                                <select name="data[Buttons][icon]" class="select" id="ButtonsIcon">
                                    <option value="<?php echo $data['Button']['icon']; ?>">Icône du bouton</option>
                                    <option value="bars"> Liste</option>
                                    <option value="check">Check</option>
                                    <option value="comment-o">Commentaire</option>
                                    <option value="flag">Drapeau</option>
                                    <option value="file">Fichier</option>
                                    <option value="facebook-square">Facebook 1</option>
                                    <option value="facebook">Facebook 2</option>
                                    <option value="twitter-square">Twitter 1</option>
                                    <option value="twitter">Twitter 2</option>
                                    <option value="github">GitHub</option>
                                    <option value="youtube-play">YouTube</option>
                                    <option value="twitch">Twitch</option>
                                    <option value="google-plus">Google+</option>
                                    <option value="skype">Skype</option>
                                    <option value="reddit">Reddit</option>
                                    <option value="pinterest-square">Pinterest</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="flickr">Flickr</option>
                                    <option value="foursquare">Foursquare</option>
                                    <option value="dribbble">Dribbble</option>
                                    <option value="soundcloud">Soundcloud</option>
                                    <option value="spotify">Spotify</option>
                                    <option value="vine">Vine</option>
                                    <option value="trello">Trello</option>
                                    <option value="tumblr">Tumblr</option>
                                    <option value="steam">Steam</option>
                                    <option value="vimeo-square">Vimeo</option>
                                </select>
                                <select name="data[Buttons][color]" class="select" id="ButtonsColor">
                                    <option value="-1">Couleur du bouton</option>
                                    <option value="" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #5fb611;"></div> Vert'></option>
                                    <option value="red" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #e74c3c;"></div> Rouge'></option>
                                    <option value="dark-blue" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #4765a0;"></div> Bleu foncé'></option>
                                    <option value="blue" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #3498db;"></div> Bleu'></option>
                                    <option value="aqua" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #27d7e7;"></div> Bleu clair'></option>
                                    <option value="orange" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #e67e22;"></div> Orange'></option>
                                    <option value="yellow" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #f1c40f;"></div> Jaune'></option>
                                    <option value="white" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #fff;"></div> Blanc'></option>
                                    <option value="default" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #95a5a6;"></div> Gris'></option>
                                    <option value="dark" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #555;"></div> Noir'></option>
                                    <option value="purple" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #9b6bcc;"></div> Violet'></option>
                                    <option value="brown" data-text='<div style="border: 1px solid rgb(0, 0, 0); width: 20px; height: 10px; top: 1px; left: 1px; display: inline-block; background-color: #9c8061;"></div> Marron'></option>
                                </select>
                            </div>
                            <hr>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Confirmer</button>
                            <a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'delete', $data['Button']['id'], 'admin' => true]); ?>" class="btn btn-danger confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Aperçu <small>Zoom x2</small></h5>
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
                        <center>
                            <button id="apercu" class="btn-u btn-u-<?php echo $data['Button']['color']; ?> btn-u-lg" type="button"><i class="fa fa-<?php echo $data['Button']['icon']; ?>"></i> <?php echo $data['Button']['content']; ?></button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>