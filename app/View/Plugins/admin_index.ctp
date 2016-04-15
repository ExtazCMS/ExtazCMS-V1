<?php $this->assign('title', 'Liste des plugins'); ?>
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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Liste des plugins installés sur le serveur</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="<?php echo $this->Html->url(['controller' => 'charts', 'action' => 'user']); ?>">
                        <i class="fa fa-bar-chart-o"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
                <div class="ibox-content">
                    <?php if($api->call('server.bukkit.version')[0]['result'] == 'success'){ ?>
                        <table class="table table-bordered table-hover dataTables-example dataTable dtr-inline" id="data-table">
                            <thead>
                                <tr>
                                    <th><b>Status</b></th>
                                    <th><b>Nom</b></th>
                                    <th><b>Version</b></th>
                                    <th><b>Description</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $plugins = $api->call('plugins');
                                foreach($plugins as $p){
                                    $p = $p['success'];
                                    $nb_plugins = count($p) - 1;
                                    for($i=0; $i <= $nb_plugins; $i++){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if($p[$i]['enabled'] == 1){
                                                    echo '<status class="enabled"></status> Activé';
                                                }
                                                else{
                                                    echo '<status class="disabled"></status> Désactivé';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $p[$i]['name']; ?></td>
                                            <td><?php echo $p[$i]['version']; ?></td>
                                            <td><?php echo $p[$i]['description']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-info">Une liaison avec JSONAPI est nécessaire pour afficher les plugins</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>