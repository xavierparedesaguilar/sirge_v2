
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Gestión Ordenes en Línea', ['controller' => 'Orders', 'action' => 'index']);
        $this->Html->addCrumb($order->nro_order, ['controller' => 'Orders', 'action' => 'edit', 'id' => $order->id]);
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
                <?php echo $this->Form->create($order, [
                    'url'          => ['controller' => 'Orders', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id'           => "form_ordenes",
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nro_order', [
                                        'label'    => 'Nro. Pedido',
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('date_order', [
                                        'label'    => 'Fecha',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => date('d-m-Y', strtotime($order->date_order)),
                                        'disabled' => true,
                                ]); ?>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('client_id', [
                                        'label'    => 'Cliente',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => mb_strtoupper($client->name_client, 'UTF-8'),
                                        'disabled' => true,
                                ]); ?>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('institution', [
                                        'label'    => 'Institución',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => mb_strtoupper($client->institution, 'UTF-8'),
                                        'disabled' => true,
                                ]); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('country_id', [
                                        'label'    => 'País',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => $client->country->name,
                                        'disabled' => true
                                ]); ?>
                            </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('state', [
                                        'label'   => 'Estado <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $estados,
                                        'empty'   => '[ SELECCIONE ]'
                                ]); ?>
                            </div>
                        </div>


                        <div class="row">


                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('client_id', [
                                        'label'    => 'Correo',
                                        'class'    => 'form-control',
                                        'type'     => 'text',
                                        'value'    => $client->email,
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

                        <!--  DETALLE DEL PEDIDO EN LINEA   -->
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
                                                        <th><?= __('Acciones') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $item = 1; ?>
                                                    <?php foreach ($detalle_orden as $detalle): ?>
                                                    <tr>
                                                        <td><?= $item ?></td>
                                                        <td><?= h($detalle->passport->accenumb) ?></td>
                                                        <td><?= h($detalle->specie->collection->colname) ?></td>
                                                        <td><?= h($detalle->specie->species) ?></td>
                                                        <td><?= h($detalle->nombreBanco) ?></td>
                                                        <td class="text-center"><?= h($detalle->quantity) ?></td>
                                                        <td class="text-center">
                                                            <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                                    ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar Detalle de la Orden.', 'data-id' => $detalle->id])
                                                            ?>
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
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnOrdenes">GRABAR</button>
                        <?php echo $this->Html->link('CANCELAR', ['controller' => 'Orders', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
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
<?php $url = $this->Url->build(['controller' => 'Orders', 'action' => 'deleteDetalle', 'id' => '']) ?>
<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $url.'/'; ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat'>Confirmar</a>");
        $("#trigger").click();
    });
</script>