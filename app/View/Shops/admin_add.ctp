<?php $this->assign('title', 'Ajouter un article'); ?>
<script type="text/javascript">
$(function() {
    $("select").selectBoxIt({
        showFirstOption: false
    });
});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ajouter un produit à la boutique</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a href="<?php echo $this->Html->url(['controller' => 'shops', 'action' => 'list']); ?>">
                                <i class="fa fa-bars"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <?php echo $this->Form->create('Shop', ['class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('name'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                    <?php echo $this->Form->input('name', array('type' => 'text', 'placeholder' => 'Nom', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('description'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <?php echo $this->Form->input('description', array('type' => 'text', 'placeholder' => 'Description', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="data[Shop][cat]" id="ShopCat" class="form-control">
                                    <option value="">Choisissez une catégorie</option>
                                    <?php foreach($categories as $category){ ?>
                                        <option value="<?php echo $category['shopCategories']['id']; ?>"><?php echo $category['shopCategories']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="data[Shop][needonline]" id="ShopVisible" class="form-control">
                                    <option value="">Voulez vous que le joueur soit connecté en jeu pour acheter cet objet ?</option>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="data[Shop][visible]" id="ShopVisible" class="form-control">
                                    <option value="">Voulez vous que ce produit soit visible immédiatement dans la boutique ?</option>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="data[Shop][promo]" id="ShopPromo" class="form-control">
                                    <option value="">Ce produit sera-t-il en promotion ?</option>
                                    <option value="-1">Non</option>
                                    <option value="5">Oui, -5%</option>
                                    <option value="10">Oui, -10%</option>
                                    <option value="15">Oui, -15%</option>
                                    <option value="25">Oui, -25%</option>
                                    <option value="50">Oui, -50%</option>
                                    <option value="70">Oui, -70%</option>
                                    <option value="80">Oui, -80%</option>
                                    <option value="90">Oui, -90%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('img'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <?php echo $this->Form->input('img', array('type' => 'url', 'placeholder' => 'Url vers une image', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('price_money_site'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                                    <?php echo $this->Form->input('price_money_site', array('type' => 'number', 'placeholder' => 'Prix en '.$site_money.'', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <?php if($use_server_money == 1){ ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('price_money_server'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-gamepad"></i></span>
                                    <?php echo $this->Form->input('price_money_server', array('type' => 'number', 'placeholder' => 'Prix en '.$money_server.'', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <select name="data[Shop][required]" id="ShopRequired" class="form-control">
                                    <option value="-1--Aucun">Le joueur doit-il acheter un objet dans la boutique avant d'acheter celui-ci ? Si oui lequel ?</option>
                                    <option value="-1--Aucun">PAS DE PRÉREQUIS</option>
                                    <?php foreach($list_item as $item){ ?>
                                        <option value="<?php echo $item['Shop']['id'].'--'.$item['Shop']['name']; ?>"><?php echo $item['Shop']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('command'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                    <?php echo $this->Form->input('command', array('type' => 'text', 'placeholder' => 'Commande(s) sans le slash (/) initial. Utilisez %player% pour désigner un joueur et &&& pour ajouter une nouvelle commande', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                </div>
                            </div>
                            <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-plus"></i> Ajouter cet article</button>
                            <br>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>