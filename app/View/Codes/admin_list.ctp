<?php $this->assign('title', 'Codes cadeaux'); ?>
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
        text: "Voulez vous vraiment supprimer ce code ?",
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
                <h5>Liste des codes cadeaux générés</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="<?php echo $this->Html->url(['controller' => 'codes', 'action' => 'generate']); ?>">
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
                            <th><b>Créateur</b></th>
                            <th><b>Adresse IP</b></th>
                            <th><b>Code</b></th>
                            <th><b>Valeur</b></th>
                            <th><b>Utilisé ?</b></th>
                            <th><b>Date de création</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d){ ?>
                        <?php
                        if($d['Code']['used'] == 1){
                            echo '<tr class="danger">';
                        }
                        else{
                            echo '<tr>';
                        }
                        ?>
                            <td><?php echo $d['Code']['creator']; ?></td>
                            <td><?php echo $d['Code']['ip']; ?></td>
                            <td>
                                <?php
                                if($d['Code']['used'] == 1){
                                    echo '<input onclick="select()" value="'.$d['Code']['code'].'" readonly="readonly" class="used-code-input"></input>';
                                }
                                else{
                                    echo '<input onclick="select()" value="'.$d['Code']['code'].'" readonly="readonly" class="code-input"></input>';
                                }
                                ?>
                            </td>
                            <td><?php echo $d['Code']['value'].' '.$site_money; ?></td>
                            <td>
                                <?php
                                if($d['Code']['used'] == 0){
                                    echo 'Non';
                                }
                                else{
                                    echo 'Oui par '.$d['User']['username'];
                                }
                                ?>
                            </td>
                            <td><?php echo $this->Time->format('d/m/Y à H:i', $d['Code']['created']); ?></td>
                            <?php
                            if($d['Code']['used'] == 0){
                                echo '<td><a href="'.$this->Html->url(['controller' => 'codes', 'action' => 'delete', $d['Code']['id']]).'" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a></td>';
                            }
                            else{
                                echo '<td><span class="btn btn-white btn-xs" disabled="disabled"><i class="fa fa-trash-o"></i> Supprimer</span></td>';
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