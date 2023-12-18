
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Suscripción Clientes', ['controller' => 'Clients', 'action' => 'index']);
        $this->Html->addCrumb($client->name_client, ['controller' => 'Clients', 'action' => 'edit', 'id' => $client->id]);
        $this->Html->addCrumb('Editar');

        echo $this->Html->getCrumbList(
            [
                'firstClass' => false,
                'lastClass'  => 'active',
                'class'      => 'breadcrumb',
                'escape'     => false
            ],
            '<i class="fa fa-home"></i> Inicio'
        );
    ?>
</section>
<!-- /Page Breadcrumb -->

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($client, [
                    'url'          => ['controller' => 'Clients', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id'           => "form_cliente",
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('names', [
                                        'label' => 'Nombres <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('surnames', [
                                        'label' => 'Apellidos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('email', [
                                        'label' => 'E-mail <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                                <?php echo $this->Form->control('email_hidden', ['type' => 'hidden', 'value' => $client->email]) ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('gender', [
                                        'label'   => 'Género <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => ['1' => 'MASCULINO', '2' => 'FEMENINO'],
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('country_id', [
                                        'label'   => 'País <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $country,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('origin', [
                                        'label' => 'Dirección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('date_nac', [
                                        'label' => 'Fecha Nacimiento <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                        'type'  => 'text',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('study_center', [
                                        'label' => 'Centro de Estudios <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('institution', [
                                        'label' => 'Institución <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('code_fao', [
                                        'label' => 'Código FAO',
                                        'class' => 'form-control',
                                ]); ?>
                                <?php echo $this->Form->control('codefao_hidden', ['type' => 'hidden', 'value' => $client->code_fao]) ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('state', [
                                        'label'   => 'Estado <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $estados,
                                        'empty'   => '-- SELECCIONE --',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('commentary', [
                                        'label' => 'Comentario <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnCliente">GRABAR</button>
                        <?php echo $this->Html->link('CANCELAR', ['controller' => 'Clients', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('$("#date-nac").datepicker({autoclose: true, todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);


$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#state, #country-id").select2();', ['block' => 'script']);

?>