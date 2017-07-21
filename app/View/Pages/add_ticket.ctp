<?php $this->assign('title', 'Envoyer un message au support'); ?>
<script type="text/javascript">
$(function() {
    $('#PagesType').change(function(){
        var type = $('#PagesType').val();
        if(type == 'report'){
            $('#priority').hide();
            $('#report_input').show();
            $('#PagesMessage').attr('placeholder', 'Raison du signalement');
        }
        else{
            $('#priority').show();
            $('#report_input').hide();
            $('#PagesMessage').attr('placeholder', 'Votre question/message');
        }
    });
});
</script>
<!--=== Content Part ===-->
<div class="container content">
    <div class="row magazine-page">
        <!-- Begin Content -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Pages', ['class' => 'sky-form', 'inputDefaults' => ['error' => false]]); ?>
                <div class="reg-header">  
                    <header>Envoyer un message au support</header>
                </div>
                <fieldset>
                    <section>
                        <?php echo "Votre ticket sera indiquée à votre nom : <u>$username</u>."; ?>
                    </section>
                </fieldset>
                <fieldset>
                    <section>
                        <select name="data[Pages][type]" id="PagesType" class="form-control input-sm">
                            <option value="none">De quel type est votre requête ?</option>
                            <option value="question">Question</option>
                            <option value="report">Signalement d'un joueur</option>
                            <option value="other">Autre</option>
                        </select>
                    </section>
                </fieldset>
                <fieldset id="priority">
                    <section>
                        <select name="data[Pages][priority]" id="PagesPriority" class="form-control input-sm">
                            <option value="1">Priorité de votre requête</option>
                            <option value="1">Basse</option>
                            <option value="2">Moyenne</option>
                            <option value="3">Haute</option>
                            <option value="4">Très haute</option>
                        </select>
                    </section>
                </fieldset>
                <fieldset id="report_input" style="display:none;">
                    <section>
                        <?php echo $this->Form->input('report_input', ['type' => 'text', 'placeholder' => 'Pseudo du joueur', 'class' => 'form-control', 'label' => false]); ?>
                    </section>
                </fieldset>
                <fieldset id="message">
                    <section>
                        <?php echo $this->Form->textarea('message', ['placeholder' => 'Votre question/message', 'class' => 'form-control', 'rows' => 5, 'cols' => 5]); ?>
                    </section>
                </fieldset>
                <footer>
                    <button class="btn btn-u pull-right" type="submit">Envoyer</button>
                </footer>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- End Content -->
        <?php echo $this->element('sidebar'); ?>
    </div>
</div><!--/container-->     
<!-- End Content Part -->