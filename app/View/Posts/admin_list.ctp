<?php $this->assign('title', 'Tous les articles'); ?>
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
        text: "Voulez vous vraiment supprimer cet article ?",
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
                        <h5>Liste des articles publiés</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'add']); ?>">
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
                                    <th><b>Titre</b></th>
                                    <th><b>Catégorie</b></th>
                                    <th><b>J'aimes</b></th>
                                    <th><b>Date de création</b></th>
                                    <th><b>Actions</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d){ ?>
                                <tr>
                                    <td><?php echo $d['Post']['author']; ?></td>
                                    <td><?php echo $d['Post']['title']; ?></td>
                                    <td><?php echo $d['Post']['cat']; ?></td>
                                    <td><?php echo count($d['Like']); ?></td>
                                    <td><?php echo $this->Time->format('d/m/Y à H:i', $d['Post']['created']); ?></td>
                                    <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'edit', $d['Post']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'delete', $d['Post']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'publish', $d['Post']['id'], 0, 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-file"></i> Brouillon</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'read', 'slug' => $d['Post']['slug'], 'id' => $d['Post']['id'], 'admin' => false]); ?>" class="btn btn-white btn-xs" target="_blank"><i class="fa fa-eye"></i> Voir</a>
										<?php if($d['Post']['locked'] != 1){ ?>
                                        <a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'lock', $d['Post']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-lock"></i> Verrouiller</a>
                                        <?php } else { ?>
										<a href="<?php echo $this->Html->url(['controller' => 'posts', 'action' => 'unlock', $d['Post']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-unlock"></i> Déverrouiller</a>
										<?php } ?>
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