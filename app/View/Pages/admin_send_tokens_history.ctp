<?php $this->assign('title', 'Historique des transactions'); ?>
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
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Liste des transactions</h5>
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
                                    <th><b>Expéditeur</b></th>
                                    <th><b>Destinataire</b></th>
                                    <th><b><?php echo ucfirst($site_money); ?> envoyés</b></th>
                                    <th><b>Taux de perte</b></th>
                                    <th><b><?php echo ucfirst($site_money); ?> reçus</b></th>
                                    <th><b>Date</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d){ ?>
                                <tr>
                                    <td><?php echo $d['sendTokensHistory']['shipper'] ?></td>
                                    <td><?php echo $d['sendTokensHistory']['recipient'] ?></td>
                                    <td><?php echo $d['sendTokensHistory']['nb_tokens'] ?></td>
                                    <td><?php echo $d['sendTokensHistory']['loss_rate'] ?></td>
                                    <td><?php echo $d['sendTokensHistory']['nb_tokens_with_loss_rate'] ?></td>
                                    <td><?php echo $this->Time->format('d/m/Y à H:i', $d['sendTokensHistory']['created']); ?></td>
                                    <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'send_tokens_delete', $d['sendTokensHistory']['id']]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
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