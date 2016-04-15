<?php $this->assign('title', 'Tous les utilisateurs'); ?>
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
                <h5>Liste de tous les utilisateurs</h5>
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
                <table class="table table-bordered table-hover dataTables-example dataTable dtr-inline" id="data-table">
                    <thead>
                        <tr>
                            <th><b>#</b></th>
                            <th><b>Pseudo</b></th>
                            <th><b>eMail</b></th>
                            <th><b>IP</b></th>
                            <th><b>Tokens</b></th>
                            <th><b>Role</b></th>
                            <th><b>Inscrit le</b></th>
							<th><b>Banni</b></th>
							<th><b>CGV/CGU</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d){ ?>
                            <tr>
                                <td><?php echo $d['User']['id']; ?></td>
                                <td><?php echo $this->Html->image($d['User']['avatar'], ['height' => 16, 'width' => 16, 'class' => 'avatar']).' '.$d['User']['username']; ?></td>
                                <td><?php echo $d['User']['email']; ?></td>
                                <td><?php echo $d['User']['ip']; ?></td>
                                <td><?php echo $d['User']['tokens']; ?></td>
                                <?php if($d['User']['role'] == 2){ ?>
                                    <td><span class="label label-danger">Administrateur</span></td>
                                <?php } elseif($d['User']['role'] == 1) { ?>
                                    <td><span class="label label-success">Modérateur</span></td>
                                <?php } else { ?>
                                    <td><span class="label label-black">Utilisateur</span></td>
                                <?php } ?>
                                <td><?php echo $this->Time->format('d/m/Y à H:i', $d['User']['created']); ?></td>
                                <?php if($d['User']['ban'] == 0){ ?>
                                    <td><span class="label label-black">Non</span></td>
                                <?php } else { ?>
                                    <td><span class="label label-danger">Oui</span></td>
                                <?php } ?>
                                <?php if($d['User']['cgvcgu'] == 1){ ?>
                                    <td><span class="label label-success">Approuvé</span></td>
                                <?php } else { ?>
                                    <td><span class="label label-danger">Non approuvé</span></td>
                                <?php } ?>
                                <td>
                                    <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'edit', $d['User']['id']]); ?>" class="btn btn-w-m btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Editer</a>
                                    <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'delete', $d['User']['id']]); ?>" class="btn btn-w-m btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Supprimer</a>
                                    <?php if($d['User']['ban'] == 0) { ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'ban', $d['User']['id']]); ?>" class="btn btn-w-m btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Bannir</a>
                                    <?php } else { ?>
                                    <a href="<?php echo $this->Html->url(['controller' => 'users', 'action' => 'unban', $d['User']['id']]); ?>" class="btn btn-w-m btn-white btn-xs confirm"><i class="fa fa-trash-o"></i> Pardonner</a>
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