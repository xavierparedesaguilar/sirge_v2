
<?php $this->assign('title', $modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $modulo ?></h1>

    <?php
        $this->Html->addCrumb('Gestión Ordenes en Línea');

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

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Lista <?php echo $modulo ?></strong></h3>

                        <div class="pull-right box-tools">

                            <?php if($permiso['export']) { ?>

                                 <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $modulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                    <th style="min-width: 40px;">#</th>
                                    <th style="min-width: 80px">Nro. Pedido</th>
                                    <th style="min-width: 80px">Fecha</th>
                                    <th style="min-width: 150px">CLiente</th>
                                    <th style="min-width: 150px">Correo</th>
                                    <th style="min-width: 150px">Institución</th>
                                    <th style="min-width: 80px">País</th>
                                    <th style="min-width: 80px">Estado Pedido</th>
                                    <th style="min-width: 150px"><?= __('Opciones') ?></th>
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
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td><?= h($order->nro_order) ?></td>
                                    <td><?= date('d-m-Y', strtotime($order->date_order)) ?></td>
                                    <td><?= mb_strtoupper($order->client->name_client, 'UTF-8') ?></td>
                                    <td><?= $order->client->email ?></td>
                                    <td><?= $order->client->institution ?></td>
                                    <td><?= $order->client->country->name ?></td>
                                    <td><?= $order->estadoPedido->name ?></td>
                                    <td class="text-center">

                                    <?php if($permiso['view']){ ?>
                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'Orders', 'action' => 'view', $order->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de la Orden."])
                                        ?>
                                    <?php } ?>
                                    <?php if($order->estadoPedido->name == 'CREADO' ){ ?>
                                        <?php if($permiso['edit']){ ?>
                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                    ['controller' => 'Orders', 'action' => 'edit', 'id' => $order->id],
                                                    ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Order."])
                                            ?>
                                        <?php } ?>

                                        <?php if($permiso['delete']){ ?>
                                            <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                    ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar la Orden.', 'data-id' => $order->id])
                                            ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php $item++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal  -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro actual?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
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

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat'>Confirmar</a>");
        $("#trigger").click();
    });
</script>