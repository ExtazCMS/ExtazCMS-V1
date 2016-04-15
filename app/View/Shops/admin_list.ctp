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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Liste des articles disponibles dans la boutique</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'add']); ?>">
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
                            <th><b>Nom</b></th>
                            <?php
                            if($use_store == 1){
                                echo '<th><b>Prix en '.$site_money.'</b></th>';
                            }
                            if($use_economy == 1){
                                echo '<th><b>Prix en '.$money_server.'</b></th>';
                            }
                            ?>
                            <th><b>Mode de connexion</b></th>
                            <th><b>Promo</b></th>
                            <th><b>Etat</b></th>
                            <th><b>Date de création</b></th>
                            <th><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d){ ?>
                        <tr>
                            <td><?php echo $d['Shop']['name']; ?></td>
                            <?php
                            if($use_store == 1 && $d['Shop']['price_money_site'] != -1){
                                if($d['Shop']['promo'] == -1){
                                    echo '<td>'.number_format($d['Shop']['price_money_site'], 0, ',', ' ').'</td>';
                                }
                                else{
                                    $promo = round($d['Shop']['price_money_site'] / 100 * $d['Shop']['promo']);
                                    $price = $d['Shop']['price_money_site'] - $promo;
                                    $price = number_format($price, 0, ',', ' ');
                                    echo '<td><span class="text-danger"><u>'.number_format($d['Shop']['price_money_site'], 0, ',', ' ').'</u></span> <i class="fa fa-angle-double-right"></i> '.$price.'</td>';
                                }
                            }
                            else{
                                echo '<td><span class="text-danger">Désactivé</span></td>';
                            }

                            if($use_economy == 1 && $d['Shop']['price_money_server'] != -1){
                                if($d['Shop']['promo'] == -1){
                                    echo '<td>'.number_format($d['Shop']['price_money_server'], 0, ',', ' ').'</td>';
                                }
                                else{
                                    $promo = round($d['Shop']['price_money_server'] / 100 * $d['Shop']['promo']);
                                    $price = $d['Shop']['price_money_server'] - $promo;
                                    $price = number_format($price, 0, ',', ' ');
                                    echo '<td><span class="text-danger"><u>'.number_format($d['Shop']['price_money_server'], 0, ',', ' ').'</u></span> <i class="fa fa-angle-double-right"></i> '.$price.'</td>';
                                }
                            }
                            elseif($use_economy == 1 && $d['Shop']['price_money_server'] == -1){
                                echo '<td><span class="text-danger">Désactivé</span></td>';
                            }

                            if($d['Shop']['needonline'] == 1){
                                echo '<td><span class="label label-success">Doit être en jeu</span></td>';
                            }
                            else{
                                echo '<td><span class="label label-dark">Pas besoin d\'être en jeu</span></td>';
                            }

                            if($d['Shop']['promo'] == -1){
                                echo '<td><span class="label">Aucune</span></td>';
                            }
                            else{
                                echo '<td><span class="label label-success">-'.$d['Shop']['promo'].'%</span></td>';
                            }

                            if($d['Shop']['visible'] == 1){
                                echo '<td><span class="label label-success">Affiché</span></td>';
                            }
                            else{
                                echo '<td><span class="label label-black">Caché</span></td>';
                            }
                            ?>
                            <td><?php echo $this->Time->format('d/m/Y à H:i', $d['Shop']['created']); ?></td>
                            <td>
                                <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'edit', $d['Shop']['id'], 'admin' => true]); ?>" class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'delete', $d['Shop']['id'], 'admin' => false]); ?>" class="btn btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>