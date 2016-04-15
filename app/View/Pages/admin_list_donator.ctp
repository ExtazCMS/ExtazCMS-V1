<?php $this->assign('title', 'Liste des donateurs'); ?>
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
        text: "Voulez vous vraiment supprimer cette ligne ?",
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
                <h5>Liste des donateurs</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'donator']); ?>">
                        <i class="fa fa-bar-chart-o"></i>
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
                            <th><b>eMail</b></th>
                            <th><b><?php echo ucfirst($site_money); ?> (total)</b></th>
                            <th><b><?php echo ucfirst($site_money); ?> (actuel)</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d){ ?>
                        <tr>
                            <td><?php echo $this->Html->image($d['User']['avatar'], ['alt' => 'Avatar', 'height' => 16, 'width' => 16, 'class' => 'avatar']).' '.$d['User']['username']; ?></td>
                            <td><?php echo $d['User']['email']; ?></td>
                            <td><?php echo $d['donationLadder']['tokens']; ?></td>
                            <td><?php echo $d['User']['tokens']; ?></td>
                            <td>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'edit_donator', $d['donationLadder']['id']]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'delete_donator', $d['donationLadder']['id']]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>