
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?></h1>

    <?php
        $this->Html->addCrumb('Gestión Pagos');

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
<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>
<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo ?></strong></h3>
                         <div class="pull-right box-tools">

                            <?php if($permiso['export']) { ?>

                                 <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $titulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                         <i class="fa fa-download" ></i>
                                </button>

                            <?php } ?>


                        </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th>#</th>
                                    <th>Nro. Pedido</th>
                                    <th>Cliente</th>
                                    <th>Banco</th>
                                    <th>Fecha de Pago</th>
                                    <th>Moneda</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th class="text-center"><?= __('Opciones') ?></th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                <tr class="text-uppercase">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1 ?>
                                <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td><?= $payment->order->nro_order ?></td>
                                    <td><?= mb_strtoupper($payment->order->client->name_client, 'UTF-8') ?></td>
                                    <td><?= $payment->tipoBancos->name ?></td>
                                    <td><?= $payment->date_payment==null || $payment->date_payment==''?'':date("d-m-Y", strtotime($payment->date_payment)) ?></td>
                                    <td><?= $payment->tipoMonedas->name ?></td>
                                    <td><?= $this->Number->format($payment->amount_paid) ?></td>
                                    <td><?= $payment->estadoPagos->name ?></td>
                                    <td class="text-center">
                                    <?php if($payment->estadoPagos->name == 'CONFIRMADO'){ ?>
                                        <?php  if($permiso['view']) { ?>
                                            <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                    ['controller' => 'Payments', 'action' => 'view', $payment->id],
                                                    ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Pago."])
                                            ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if($permiso['edit']) { ?>
                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                    ['controller' => 'Payments', 'action' => 'edit', 'id' => $payment->id],
                                                    ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Pago."])
                                            ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php $item ++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal de exportar archivo excel  -->
<div class="modal fade" id="exportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla']]); ?>
            <div class="modal-body">
                <p id="mensaje"></p>
                <?php echo $this->Form->control('filename', ['type' => 'hidden', 'id' => 'filename']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnReportesTabla">Aceptar</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        tablaListadoDataTable();
    });
</script>
