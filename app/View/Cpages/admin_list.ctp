<?php $this->assign('title', 'Liste des pages'); ?>
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
        text: "Voulez vous vraiment supprimer cette page ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Liste des pages personnalisés</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'add']); ?>">
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
                            <th><b>Auteur</b></th>
                            <th><b>Type</b></th>
                            <th><b>Titre</b></th>
                            <th><b>Visible</b></th>
                            <th><b>URL</b></th>
                            <th><b>Date de création</b></th>
                            <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d){ ?>
                        <tr>
                            <td>
                                <?php
                                // Avatar
                                if($d['User']['username'] == null){
                                    echo $this->Html->image('https://cravatar.eu/helmavatar/steve/12', ['alt' => 'Player head', 'class' => 'img-rounded', 'style' => 'margin-top:-1px;']);
                                }
                                else{
                                    echo $this->Html->image($d['User']['avatar'], ['alt' => 'Avatar', 'height' => 16, 'width' => 16, 'class' => 'avatar']);
                                }

                                // Pseudo
                                if($d['User']['username'] == null){
                                    echo ' <font color="#555"><u>Compte supprimé</u></font>';
                                }
                                else{
                                    echo ' '.$d['User']['username'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($d['Cpage']['redirect'] == 1){
                                    echo 'Redirection';
                                }
                                else{
                                    echo 'Page';
                                }
                                ?>
                            </td>
                            <td><?php echo $d['Cpage']['name']; ?></td>
                            <td>
                                <?php
                                    if($d['Cpage']['visible']){
                                        echo '<i class="fa fa-check" aria-hidden="true"></i>'
;
                                    }
                                    else{
                                        echo '<i class="fa fa-times" aria-hidden="true"></i>
';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if($d['Cpage']['redirect'] == 1){ ?>
                                <span class="label label-black">
                                    <i class="fa fa-globe"></i>
                                    <?php echo $d['Cpage']['url']; ?>
                                </span>
                                <?php } else { ?>
                                <span class="label label-black">
                                    <i class="fa fa-globe"></i>
                                    <?php echo 'http://'.$_SERVER['SERVER_NAME'].$this->Html->url(['controller' => 'cpages', 'action' => 'read', 'slug' => $d['Cpage']['slug'], 'admin' => false]); ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td><?php echo $this->Time->format('d/m/Y à H:i', $d['Cpage']['created']); ?></td>
                            <td>
                                <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'read', 'slug' => $d['Cpage']['slug'], 'admin' => false]); ?>" class="btn btn-white btn-xs" target="_blank"><i class="fa fa-eye"></i> Voir</a>
                                <?php
                                if($d['Cpage']['redirect'] == 1){
                                    ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'edit_redirection', $d['Cpage']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'edit', $d['Cpage']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                    <?php
                                }
                                ?>
                                <a href="<?php echo $this->Html->url(['controller' => 'cpages', 'action' => 'delete', $d['Cpage']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>