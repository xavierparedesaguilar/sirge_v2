
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Gestión Ordenes en Línea', ['controller' => 'Orders', 'action' => 'index']);
        $this->Html->addCrumb($order->nro_order, ['controller' => 'Orders', 'action' => 'view', 'id' => $order->id]);
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
                    <h3 class="box-title"><strong><?= __('PEDIDO') ?></strong></h3>
                    <div class="pull-right box-tools">
                    <?php if($order->estadoPedido->name == 'CREADO' ){ ?>
                        <?php if($permiso['edit']){ ?>
                            <?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Orders', 'action' => 'edit', $order->id], ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>
                        <?php } ?>
                        <?php if($permiso['delete']){ ?>
                            <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$order->id])?>
                        <?php } ?>
                    <?php } ?>
                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'Orders', 'action'=>'index'],['class'=>'btn btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false]) ?>
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
                                                <th scope="row"><?= __('Nro. Orden') ?></th>
                                                <td><?= h($order->nro_order) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Cliente') ?></th>
                                                <td><?= mb_strtoupper($order->client->name_client, 'UTF-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Institución') ?></th>
                                                <td><?= mb_strtoupper($order->client->institution, 'UTF-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('País') ?></th>
                                                <td><?= $order->client->country->name ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><?= __('Estado Pedido') ?></th>
                                                <td><?= $order->estadoPedido->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Fecha') ?></th>
                                                <td><?= date('d-m-Y' , strtotime($order->date_order)) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Commentario') ?></th>
                                                <td><?= h($order->commentary) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><strong>LISTA <?php echo mb_strtoupper($detalle,'UTF-8') ?></strong></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="tablaListado" class="table table-striped table-bordered table-hover">
                                                    <thead class="headTablaListado">
                                                        <tr class="text-uppercase text-center th-head-inputs">
                                                            <th>#</th>
                                                            <th><?= __('Cod. Nacional') ?></th>
                                                            <th><?= __('Colección') ?></th>
                                                            <th><?= __('Especie') ?></th>
                                                            <th><?= __('Banco') ?></th>
                                                            <th><?= __('Cantidad') ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $item = 1; ?>
                                                        <?php foreach ($lista_detalle as $detalle): ?>
                                                        <tr>
                                                            <td><?= $item ?></td>
                                                            <td><?= h($detalle->passport->accenumb) ?></td>
                                                            <td><?= h($detalle->specie->collection->colname) ?></td>
                                                            <td><?= h($detalle->specie->species) ?></td>
                                                            <td><?= h($detalle->nombreBanco) ?></td>
                                                            <td class="text-center"><?= h($detalle->quantity) ?></td>
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
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if($order->estadoPedido->name == 'CREADO' ){ ?>
                        <?php if($permiso['edit']){ ?>
                            <?php echo $this->Html->link('EDITAR', ['controller' => 'Orders', 'action' => 'edit', $order->id], ['class' => 'btn btn-primary'] ); ?>
                        <?php } ?>
                        <?php if($permiso['delete']){ ?>
                            <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$order->id])?>
                        <?php } ?>
                    <?php } ?>
                        <?php echo $this->Html->link('REGRESAR', ['controller'=>'Orders', 'action'=>'index'],['class'=>'btn btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'Orders', 'action' => 'delete', 'id' => $order->id], ['class' => 'btn btn-success btn-flat' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>
