<?php $this->assign('title', 'Gérer les boutons'); ?>
<script type="text/javascript">
$(function() {
    $('#data-table').dataTable({
        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Tout"]],
        "order": [],
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
    $('#ButtonsContent').keyup(function(){
        var content = $('#ButtonsContent').val();
        var icon = $('#ButtonsIcon').val();
        if(content == ''){
            content = 'Votre texte ici';
        }
        if(icon == null){
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
            $('#apercu').html('<i class="fa fa-' + icon + '"></i> ' + 'Votre texte ici').hide().fadeIn(500);
        }
        else{
            $('#apercu').html('<i class="fa fa-' + icon + '"></i> ' + ' ' + content).hide().fadeIn(500);
        }
    });
    $('#ButtonsColor').change(function(){
        var color = $('#ButtonsColor').val();
        $('#apercu').attr('class', '');
        $('#apercu').addClass('btn-u btn-u-' + color + ' btn-u-lg').hide().fadeIn(500);
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
		<!-- Affichage des boutons déjà créé -->
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Liste des boutons déjà créés</h5>
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
                        <table class="table table-bordered table-hover dataTables-example dataTable dtr-inline" id="data-table">
                            <thead>
                                <tr>
                                    <th><b>Créateur</b></th>
                                    <th><b>Texte</b></th>
                                    <th><b>URL</b></th>
                                    <th><b>Icône</b></th>
                                    <th><b>Couleur</b></th>
                                    <th><b>Aperçu</b></th>
                                    <th><b>Ordre</b></th>
                                    <th><b>Date de création</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $colors = ['', 'red', 'dark-blue', 'blue', 'aqua', 'orange', 'yellow', 'white', 'default', 'dark', 'purple', 'brown'];
                                $hexas = ['#5fb611', '#e74c3c', '#4765a0', '#3498db', '#27d7e7', '#e67e22', '#f1c40f', '#fff', '#95a5a6', '#555', '#9b6bcc', '#9c8061'];
                                foreach($data as $d){ 
                                $color = str_replace($colors, $hexas, $d['Button']['color']);
                                ?>
                                <tr>
                                    <td><?php echo $d['User']['username']; ?></td>
                                    <td><?php echo $d['Button']['content']; ?></td>
                                    <td>
                                        <a href="<?php echo $d['Button']['url']; ?>" target="_blank"><?php echo $d['Button']['url']; ?></a>
                                    </td>
                                    <td><i class="fa fa-<?php echo $d['Button']['icon']; ?>"></i></td>
                                    <td>
                                        <?php 
                                        if(empty($color)){
                                            echo '<div style="border: 1px solid rgb(0, 0, 0); width: 15px; height: 15px; top: 1px; left: 1px; display: inline-block; background-color: #5fb611;margin-top: 3px;"></div>';
                                        }
                                        else{
                                            echo '<div style="border: 1px solid rgb(0, 0, 0); width: 15px; height: 15px; top: 1px; left: 1px; display: inline-block; background-color: '.$color.';margin-top: 3px;"></div>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn-u btn-u-<?php echo $d['Button']['color']; ?> btn-u-xs" type="button"><i class="fa fa-<?php echo $d['Button']['icon']; ?>"></i> <?php echo $d['Button']['content']; ?></button>
                                    </td>
                                    <td><?php echo $d['Button']['order']; ?></td>
                                    <td><?php echo $this->Time->format('d/m/Y à H:i', $d['Button']['created']); ?></td>
                                    <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'edit', $d['Button']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'delete', $d['Button']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
						<a href="<?php echo $this->Html->url(['controller' => 'buttons', 'action' => 'add']); ?>" class="btn btn-success"><i class="fa fa-check"></i> Créer un bouton</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>