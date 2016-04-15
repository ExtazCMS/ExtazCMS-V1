<?php $this->assign('title', 'Modifier un article'); ?>
<script type="text/javascript">
$(document).ready(function(){
    $("select").selectBoxIt({
        showFirstOption: false
    });
});

//var cmd = $("#ShopCommand");
//cmd.on("keyup", function (event) {
//    var val = $.trim(cmd.val());
//    if(val.match(/&&&/g)) {
//        event.val.replace("/&&&/g", "");
//            $("#commands").append('<br><div class="input-group margin-bottom-20"><span class="input-group-addon"><i class="fa fa-code"></i></span><input name="data[Shop][command]" placeholder="Votre commande" class="form-control" type="text" id="ShopCommand" required="required"/></div>');
//    }
//});
</script>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="row">
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editer un produit</h5>
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
                        <?php echo $this->Form->create('Shop', ['inputDefaults' => ['error' => false]]); ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('name'); ?></small></font>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'value' => $data['Shop']['name'], 'class' => 'form-control', 'label' => 'Nom de l\'article')); ?>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('description'); ?></small></font>
                                <?php echo $this->Form->input('description', array('type' => 'text', 'value' => $data['Shop']['description'], 'class' => 'form-control', 'label' => 'Description')); ?>
                            </div>
                            <label>Catégorie</label>
                            <div class="form-group">
                                <select name="data[Shop][cat]" id="ShopCat" class="form-control">
                                    <option value="<?php echo $data['shopCategories']['id']; ?>">Catégorie actuel: <?php echo $data['shopCategories']['name']; ?></option>
                                    <?php foreach($categories as $category){ ?>
                                        <option value="<?php echo $category['shopCategories']['id']; ?>"><?php echo $category['shopCategories']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label>Le joueur doit-il être connecté au jeu ?</label>
                            <div class="form-group">
                                <select name="data[Shop][needonline]" id="Shopneedonline" class="form-control">
                                    <?php
                                    if($data['Shop']['needonline'] == 1){
                                        echo '<option value="">Oui</option>';
                                    }
                                    else{
                                        echo '<option value="">Non</option>';
                                    }
                                    ?>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <label>Afficher dans la boutique ?</label>
                            <div class="form-group">
                                <select name="data[Shop][visible]" id="ShopVisible" class="form-control">
                                    <?php
                                    if($data['Shop']['visible'] == 1){
                                        echo '<option value="">Oui</option>';
                                    }
                                    else{
                                        echo '<option value="">Non</option>';
                                    }
                                    ?>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <label>Promotion</label>
                            <div class="form-group">
                                <select name="data[Shop][promo]" id="ShopPromo" class="form-control">
                                    <?php
                                    if($data['Shop']['promo'] == -1){
                                        echo '<option value="">Pas de promotion</option>';
                                    }
                                    else{
                                        echo '<option value="">Promotion actuelle: -'.$data['Shop']['promo'].'%</option>';
                                    }
                                    ?>
                                    <option value="-1">Pas de promotion</option>
                                    <option value="5">-5%</option>
                                    <option value="10">-10%</option>
                                    <option value="15">-15%</option>
                                    <option value="25">-25%</option>
                                    <option value="50">-50%</option>
                                    <option value="70">-70%</option>
                                    <option value="80">-80%</option>
                                    <option value="90">-90%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('img'); ?></small></font>
                                <?php echo $this->Form->input('img', array('type' => 'url', 'value' => $data['Shop']['img'], 'class' => 'form-control', 'label' => 'Url vers l\'image')); ?>
                            </div>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('price_money_site'); ?></small></font>
                                <?php echo $this->Form->input('price_money_site', array('type' => 'number', 'value' => $data['Shop']['price_money_site'], 'class' => 'form-control', 'label' => 'Prix avec la monnaie du site')); ?>
                            </div>
                            <?php if($use_server_money == 1){ ?>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('price_money_server'); ?></small></font>
                                <?php echo $this->Form->input('price_money_server', array('type' => 'number', 'value' => $data['Shop']['price_money_server'], 'class' => 'form-control', 'label' => 'Prix avec la monnaie du serveur')); ?>
                            </div>
                            <?php } ?>
                            <label>Prérequis</label>
                            <div class="form-group">
                                <select name="data[Shop][required]" id="ShopRequired" class="form-control">
                                    <option value="<?php echo $data['Shop']['required'].'--'.$data['Shop']['required_name']; ?>">Prérequis actuel: <?php echo $data['Shop']['required_name']; ?></option>
                                    <option value="-1--Aucun">Pas de prérequis</option>
                                    <?php foreach($list_item as $item){ ?>
                                        <option value="<?php echo $item['Shop']['id'].'--'.$item['Shop']['name']; ?>"><?php echo $item['Shop']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label>Commande(s)</label>
                            <div class="form-group">
                                <font color="#A94442"><small><?php echo $this->Form->error('command'); ?></small></font>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                    <?php echo $this->Form->input('command', array('type' => 'text', 'value' => $data['Shop']['command'], 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
                                </div>
                                <div id="commands"></div>
                                <small>Commande(s) sans le slash (/) initial. Utilisez %player% pour désigner un joueur et &&& pour ajouter une nouvelle commande</small>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <hr>
                                    <button class="btn btn-w-m btn-primary pull-right" type="submit"><i class="fa fa-pencil-square-o"></i> Modifier cet article</button>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>