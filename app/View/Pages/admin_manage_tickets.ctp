<?php $this->assign('title', 'Tous les tickets'); ?>
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
        text: "Voulez vous vraiment clôturer ce ticket ?",
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
                <h5>Liste des tickets envoyés par les joueurs</h5>
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
                            <th><b>Pseudo</b></th>
                            <th><b>Type</b></th>
                            <th><b>Priorité</b></th>
                            <th><b>Message envoyé</b></th>
                            <th><b>Dernière réponse</b></th>
                            <th><b>Envoyé le</b></th>
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
                                    echo $this->Html->image('https://cravatar.eu/helmavatar/steve/12', ['alt' => 'Player head', 'class' => 'avatar', 'style' => 'margin-top:-1px;']);
                                }
                                else{
                                    echo $this->Html->image($d['User']['avatar'], ['alt' => 'Avatar', 'height' => 16, 'width' => 16, 'class' => 'avatar']);
                                }

                                // Lien
                                if($d['User']['username'] == null){
                                    echo '<a href="#">';
                                }
                                else{
                                    echo '<a href="'.$this->Html->url(['controller' => 'users', 'action' => 'edit', $d['User']['id']]).'" target="blank">';
                                }
                                ?>
                                    <?php
                                    // Pseudo
                                    if($d['User']['username'] == null){
                                        echo '<font color="#555"><u>Compte supprimé</u></font>';
                                    }
                                    else{
                                        if(strlen($d['User']['username']) > 12){
                                            echo '<font color="#555">'.substr($d['User']['username'], 0, 9).'...</font>';
                                        }
                                        else{
                                            echo '<font color="#555">'.$d['User']['username'].'</font>';
                                        }
                                    }
                                    ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                switch($d['Support']['type']){
                                    case 'question':
                                        echo '<span class="label btn-xs btn-block">Question</span>';
                                        break;
                                    case 'report':
                                        echo '<span class="label label-danger btn-xs btn-block">Signalement</span>';
                                        break;
                                    case 'other':
                                        echo '<span class="label btn-xs btn-block">Autre</span>';
                                        break;
                                    case 'none':
                                        echo '<span class="label btn-xs btn-block">Autre</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                switch($d['Support']['priority']){
                                    case '1':
                                        echo '<span class="label label-success btn-xs btn-block">Basse</span>';
                                        break;
                                    case '2':
                                        echo '<span class="label btn-xs btn-block">Moyenne</span>';
                                        break;
                                    case '3':
                                        echo '<span class="label label-warning btn-xs btn-block">Haute</span>';
                                        break;
                                    case '4':
                                    echo '<span class="label label-danger btn-xs btn-block">Très haute</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php echo substr(strip_tags($d['Support']['message']), 0, 100).'...'; ?></td>
                            <td>
                                <?php
                                if(!empty($d['supportComments'][0]['username'])){ 
                                    echo substr($d['supportComments'][0]['message'], 0, 100).'...';
                                }
                                else{
                                    echo '<i>Aucune réponse</i>';
                                }
                                ?>
                            </td>
                            <td><small><?php echo $this->Time->format('d/m', $d['Support']['created']); ?></small></td>
                            <td>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'view_ticket', 'id' => $d['Support']['id'], 'admin' => false]); ?>" target="_blank" class="btn btn-w-m btn-white btn-xs" type="submit"><i class="fa fa-list"></i></a>
                                <a href="<?php echo $this->Html->url(['controller' => 'pages', 'action' => 'close_ticket', 'id' => $d['Support']['id'], 'admin' => false]); ?>" class="btn btn-w-m btn-white btn-xs confirm ui-tooltip" data-original-title="Clôturer" data-toggle="tooltip" data-placement="right" type="submit"><i class="fa fa-lock"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>