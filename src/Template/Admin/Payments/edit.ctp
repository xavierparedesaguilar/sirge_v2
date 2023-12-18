
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Gestión Pagos', ['controller' => 'Payments', 'action' => 'index']);
        $this->Html->addCrumb($orders->nro_order, ['controller' => 'Payments', 'action' => 'edit', 'id' => $payment->id]);
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
                <?php echo $this->Form->create($payment, [
                    'url'          => ['controller' => 'Payments', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id'           => "form_pagos",
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('order_id', [
                                        'label'    => 'Nro. Orden',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => $orders->nro_order,
                                        'disabled' => true,
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('order_id', [
                                        'label'    => 'Cliente',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => mb_strtoupper($orders->client->name_client, 'UTF-8'),
                                        'disabled' => true,
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('order_id', [
                                        'label'    => 'País',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => $orders->client->country->name,
                                        'disabled' => true,
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('bank_id', [
                                        'label'   => 'Banco <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $bancos,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('state', [
                                        'label'   => 'Estado <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $estados,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('date_payment', [
                                        'label' => 'Fecha de Pago <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                        'type'  => 'text',
                                        'value' => $payment->date_payment,
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coin', [
                                        'label'   => 'Moneda <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $monedas,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('amount_paid', [
                                        'label'    => 'Monto a Pagar <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'    => 'form-control',
                                        'disabled' => true,
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
                        <button type="submit" class="btn btn-primary" id="btnPagos">GRABAR</button>
                        <?php echo $this->Html->link('CANCELAR', ['controller' => 'Payments', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
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
$this->Html->scriptBlock('$("#date-payment").datepicker({autoclose: true, todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

?>
