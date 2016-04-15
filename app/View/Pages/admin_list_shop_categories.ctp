<?php $this->assign('title', 'Liste des catégories'); ?>
<script type="text/javascript">
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
        text: "Voulez vous vraiment supprimer cette catégorie ?",
        title: "Confirmation",
        confirmButton: "Oui",
        cancelButton: "Non"
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Liste des catégories</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'add_shop_categories']); ?>">
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
                                    <th><b>ID</b></th>
                                    <th><b>Nom</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $category){ ?>
                                <tr>
                                    <td><?php echo $category['shopCategories']['id']; ?></td>
                                    <td><?php echo $category['shopCategories']['name']; ?></td>
                                    <?php 
                                    if($category['shopCategories']['id'] != 0){
                                        ?>
                                        <td>
                                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'edit_shop_categories', 'id' => $category['shopCategories']['id']]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                            <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_shop_categories', 'id' => $category['shopCategories']['id']]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                        </td>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <td>
                                            <a href="#" class="btn btn-white btn-xs" disabled="disabled"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                            <a href="#" class="btn btn-white btn-xs" disabled="disabled"><i class="fa fa-trash-o"></i> Supprimer</a>
                                        </td>
                                        <?php
                                    }
                                    ?>
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