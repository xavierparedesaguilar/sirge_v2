
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Gestión Pagos', ['controller' => 'Payments', 'action' => 'index']);
        $this->Html->addCrumb($payment->order->nro_order, ['controller' => 'Payments', 'action' => 'view', 'id' => $payment->id]);
        $this->Html->addCrumb('Ver');

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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">
                    <?php if($payment->estadoPagos->name != 'CONFIRMADO'){ ?>
                        <?php if($permiso['edit']) { ?>
                            <?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Payments', 'action' => 'edit', $payment->id], ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>
                        <?php } ?>
                    <?php } ?>
                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'Payments', 'action'=>'index'],['class'=>'btn btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false]) ?>
                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?php echo ('Nro. Pedido') ?></th>
                                                <td><?php echo $payment->order->nro_order ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Cliente') ?></th>
                                                <td><?php echo mb_strtoupper($payment->order->client->name_client, 'UTF-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('País') ?></th>
                                                <td><?php echo $payment->order->client->country->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Banco') ?></th>
                                                <td><?php echo $payment->tipoBancos->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Moneda') ?></th>
                                                <td><?php echo $payment->tipoMonedas->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Monto Pagado') ?></th>
                                                <td><?php echo $this->Number->format($payment->amount_paid) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Estado') ?></th>
                                                <td><?php echo $payment->estadoPagos->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Fecha de Pago') ?></th>
                                                <td><?php echo (!empty($payment->date_payment))? date('d-m-Y', strtotime($payment->date_payment)) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Comentario') ?></th>
                                                <td><?php echo $payment->commentary ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if($payment->estadoPagos->name != 'CONFIRMADO'){ ?>
                        <?php if($permiso['edit']) { ?>
                            <?php echo $this->Html->link('EDITAR', ['controller' => 'Payments', 'action' => 'edit', $payment->id], ['class' => 'btn btn-primary'] ); ?>
                        <?php } ?>
                    <?php } ?>
                        <?php echo $this->Html->link('REGRESAR', ['controller'=>'Payments', 'action'=>'index'],['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
