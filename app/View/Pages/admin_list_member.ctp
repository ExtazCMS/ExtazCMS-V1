<?php $this->assign('title', 'Liste des membres de l\'équipe'); ?>
<script>
$(document).ready(function(){
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
    $(".confirm").confirm({
        text: "Voulez vous vraiment supprimer ce membre ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Liste des membres</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'add_member']); ?>">
                                <i class="fa fa-plus"></i>
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
                                    <th><b>Pseudo</b></th>
                                    <th><b>Rang</b></th>
                                    <th><b>Ordre</b></th>
                                    <th><b>Facebook</b></th>
                                    <th><b>Twitter</b></th>
                                    <th><b>YouTube</b></th>
                                    <th><b>Actions</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d){ ?>
                                <tr>
                                    <td>
                                        <?php echo $this->Html->image('https://cravatar.eu/helmavatar/'.$d['Team']['username'].'/12', ['alt' => 'Player head', 'class' => 'avatar', 'style' => 'margin-top:2px;']).' '.$d['Team']['username']; ?>
                                    </td>
                                    <td>
                                        <span class="member-label member-label-<?php echo $d['Team']['color']; ?>"><?php echo $d['Team']['rank']; ?></span>
                                    </td>
                                    <td><?php echo $d['Team']['order']; ?></td>
                                    <td>
                                        <?php
                                        if(empty($d['Team']['facebook_url'])){
                                            echo 'Non renseignée';
                                        }
                                        else{
                                            echo $d['Team']['facebook_url'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(empty($d['Team']['twitter_url'])){
                                            echo 'Non renseignée';
                                        }
                                        else{
                                            echo $d['Team']['twitter_url'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(empty($d['Team']['youtube_url'])){
                                            echo 'Non renseignée';
                                        }
                                        else{
                                            echo $d['Team']['youtube_url'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'edit_member', 'id' => $d['Team']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_member', 'id' => $d['Team']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>