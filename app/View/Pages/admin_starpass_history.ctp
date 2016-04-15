<?php $this->assign('title', 'Historique Starpass'); ?>
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
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Historique d'achats Starpass</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'starpass']); ?>">
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
                                    <th><b><?php echo ucfirst($site_money); ?> achetés</b></th>
                                    <th><b>Code</b></th>
                                    <th><b>Note</b></th>
                                    <th><b>Acheté le</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $d){ ?>
                                <?php if($d['starpassHistory']['note'] == 'Happy hour'){ ?>
                                <tr class="success">
                                <?php } else { ?>
                                <tr>
                                <?php } ?>
                                    <td>
                                        <?php
                                        if($d['User']['username'] == null){
                                            echo '<u>Compte supprimé</u>';
                                        }
                                        else{
                                            echo $d['User']['username'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $d['starpassHistory']['tokens']; ?></td>
                                    <td><?php echo $d['starpassHistory']['code']; ?></td>
                                    <td><?php echo $d['starpassHistory']['note']; ?></td>
                                    <td><?php echo $this->Time->format('d/m/Y à H:i', $d['starpassHistory']['created']); ?></td>
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