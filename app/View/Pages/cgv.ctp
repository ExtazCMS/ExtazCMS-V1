<?php $this->assign('title', 'Conditions Générales de Vente'); ?>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
        	<div class="panel panel-default">
                <div class="panel-body">
                    <div class="row"><p><!--StartFragment--></p>

						<h2><strong>PR&Eacute;AMBULE</strong></h2>

						<p>Le site Craftdays.eu ainsi que l&#39;acc&egrave;s aux serveurs de jeu sont gratuit, sans obligation d&#39;achat, except&eacute; la license Premium d&#39;un jeu Minecraft. Craftdays.eu se r&eacute;serve le droit de modifier sans pr&eacute;avis ou annonce les pr&eacute;sentes conditions g&eacute;n&eacute;rales de vente qui devront &ecirc;tre consult&eacute;es avant tout achat sur le site. L&#39;utilisateur doit &ecirc;tre majeur ou disposer d&#39;une autorisation de son responsable l&eacute;gal avant d&#39;effectuer un achat sur le site <!--StartFragment-->Craftdays.eu<!--EndFragment-->.</p>

						<p>Craftdays.eu ne pourra &ecirc;tre tenu responsable de toute utilisation malveillante des services propos&eacute;s.</p>

						<h2><strong>CONDITIONS D&#39;UTILISATION</strong></h2>

						<p>Tous les articles propos&eacute;s dans la boutique <!--StartFragment-->Craftdays.eu<!--EndFragment--> restent la propri&eacute;t&eacute; exclusive de <!--StartFragment-->Craftdays.eu<!--EndFragment-->. A ce titre personne n&#39;a le droit de vendre ou revendre le contenu appartenant &agrave; <!--StartFragment-->Craftdays.eu<!--EndFragment-->. Un non respect des conditions d&#39;utilisation ou de vente pourra conduire &agrave; des poursuites et une interdiction d&#39;utilisation de tous les serveur <!--StartFragment-->Craftdays.eu<!--EndFragment--></p>

						<h2><strong>PROCESSUS DE COMMANDE</strong></h2>

						<p>Toute commande valid&eacute;e constitue une acception irr&eacute;vocable des conditions g&eacute;n&eacute;rales de vente et du paiement et validera votre transaction. Les donn&eacute;es enregistr&eacute;e par <!--StartFragment-->Craftdays.eu<!--EndFragment--> constituent la preuve de l&#39;ensemble des transactions pass&eacute;es par <!--StartFragment-->Craftdays.eu<!--EndFragment--> et ses clients. Les donn&eacute;es enregistr&eacute;es par le syst&egrave;me de paiement constituent la preuve des transaction financi&egrave;res.</p>

						<h2><strong>PAIEMENT</strong></h2>

						<p>Le paiement s&#39;effectue en ligne par le biais des services Paypal et StarPass. Les informations personnelles ainsi que les num&eacute;ros de carte bancaire ne circulent jamais en clair entre le navigateur et le serveur, les donn&eacute;es sont sign&eacute;es et crypt&eacute;es et transmises par le protocole SSL.</p>

						<h2><strong>PRODUITS</strong></h2>

						<p>Les caract&eacute;ristiques des produits et services propos&eacute;s &agrave; la vente sont pr&eacute;sent&eacute;es sur notre boutique. Certains produits peuvent &ecirc;tre vendus &agrave; vie, c&#39;est &agrave; dire pendant la dur&eacute;e de vie de nos services</p>

						<h2><strong>TARIFS</strong></h2>

						<p>Les tarifs de nos articles sont affich&eacute;s sur la boutique au moment du paiement. Ils sont indiqu&eacute;s toutes taxes comprises. <!--StartFragment-->Craftdays.eu<!--EndFragment--> se r&eacute;serve le droit de modifier ses prix &agrave; tout moment.</p>

						<h2><strong>RANGS et LVL UP</strong></h2>

						<p>Le serveur &eacute;tant en beta test les privil&egrave;ges de rang (accessible via le LvlUP) peuvent &ecirc;tre adapt&eacute;s sans donner droit &agrave; aucun remboursement.</p>

						<h2><strong>MODALIT&Eacute;S DE REMBOURSEMENT</strong></h2>

						<p><!--StartFragment-->Craftdays.eu<!--EndFragment--><!--EndFragment--> livre des produits immat&eacute;riels, aucun remboursement ou &eacute;change n&#39;est possible apr&egrave;s utilisation des Tokens sur la boutique.</p>

						<h2><strong>DROIT DE R&Eacute;TRACTATION</strong></h2>

						<p>Par d&eacute;rogation &agrave; l&#39;article L. 121-20-2 du Code Fran&ccedil;ais de la Consommation, le Client n&#39;a plus le droit de r&eacute;tractation &agrave; compter de la date et heure de l&#39;utilisation des Tokens sur la boutique. Il est important de noter que le service est mis en place instantan&eacute;ment en cas de paiement par l&#39;un des services de paiement propos&eacute;s. Par d&eacute;rogation &agrave; l&#39;article L. 121-20-1 du Code Fran&ccedil;ais de la Consommation, le Client a un droit de r&eacute;tractation de 7 (sept) jours si le service n&#39;a pas encore &eacute;t&eacute; livr&eacute;. Ce droit de r&eacute;tractation s&#39;effectue via un ticket par le support, et donne droit pour le client au remboursement des sommes d&eacute;j&agrave; vers&eacute;es par lui dans un d&eacute;lai de 30 (trente) jours &agrave; compter de la r&eacute;ception de l&#39;avis. Toute demande de r&eacute;traction qui ne respecterait pas le d&eacute;lai l&eacute;gal ou ne fournirait pas assez d&#39;informations ne sera pas prise en consid&eacute;ration. <!--EndFragment--></p>
                    </div>
					<?php if($cgvcgu == 0) { ?>
                    <a href="<?php echo $this->Html->url(['controller' => 'cgv', 'action' => 'cgvok', $d['User']['id']]); ?>" class="btn btn-w-m btn-white btn-xs confirm"></i> J'accepte les CGV/CGU</a>
                    <?php } else { ?>
					<button>
                    <a href="" class="btn btn-w-m btn-white btn-xs confirm"> CGV/CGU déjà accepté</a>
					</button>
				    <?php } ?>
                </div>
            </div>
        </div>
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->