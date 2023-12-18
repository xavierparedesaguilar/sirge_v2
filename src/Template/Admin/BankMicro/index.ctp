<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?></h1>

        <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
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
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo_lista ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['add']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                    ['controller' => 'BankMicro', 'action' => 'add'],
                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Banco Microorganismo", 'escape'=>false] )
                        ?>
                        <?php } ?>


                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $titulo_lista ?>" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                      <th style="min-width: 150px;">CÓDIGO PER</th>
									  <th style="min-width: 150px;">NOMBRE DE LA ACCESIÓN</th>
                                      <th style="min-width: 160px;">OTRO CÓDIGO DE ACCESIÓN</th>
                                      <th style="min-width: 160px;">NÚMERO DE LOTE</th>
                                      <th style="min-width: 200px;">COLECCIÓN</th>
                                      <th style="min-width: 165px;">NOMBRE CIENTÍFICO</th>
                                      <th style="min-width: 165px;">NOMBRE COMÚN</th>
                                      <th style="min-width: 175px;">FECHA DE INTRODUCCIÓN</th>
                                      <th style="min-width: 140px;">DISPONIBILIDAD</th>
                                      <th style="min-width: 120px;">OPCIONES</th>

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
                                                    <th></th>
                                                    <th></th>
                                                    <td></td>

                                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1; ?>
                                <?php foreach ($bankMicro as $bankMicro): ?>
                                <tr>

                                    <td><?php echo $this->Number->format($item) ?></td>
                                    <td><?php echo h($bankMicro->passport->accenumb) ?></td>
									<td><?php echo h($bankMicro->passport->accname) ?></td>
                                    <td><?php echo h($bankMicro->passport->othenumb) ?></td>
                                    <td><?php echo h($bankMicro->lotnumb) ?></td>
                                    <td><?php echo $bankMicro->passport->specie->collection->colname?></td>
                                    <td><?php echo $bankMicro->passport->specie->genus.' '.$bankMicro->passport->specie->species  ?></td>
                                    <td><?php echo $bankMicro->passport->specie->cropname?></td>
                                    <td><?php echo ($bankMicro->acqdate == NULL || $bankMicro->acqdate=='')? '' : date("d-m-Y", strtotime($bankMicro->acqdate))  ?></td>
                                    <td><?php echo ($bankMicro->disponibilidad == NULL || $bankMicro->disponibilidad->name=='')? '' :$bankMicro->disponibilidad->name ?></td>

                                     <td>

                                    <?php

                                         /*$validar=$permiso['role_id']==1?true:$permiso['station_id']==$bankMicro->passport->station_current_id;*/


                                    ?>

                                    <?php echo $this->Html->link('<i class="fa  fa-bank"></i>',
                                                                        ['controller' => 'ShortTermConservationMicro', 'action' => 'index', $bankMicro->id],
                                                                        ['class' => 'btn btn-default btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Conservación a Corto Plazo."])
                                                                ?>

                                     <?php echo $this->Html->link('<i class="fa  fa-bank"></i>',
                                                                        ['controller' => 'LongTermConservationMicro', 'action' => 'index', $bankMicro->id],
                                                                        ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Conservación a Largo Plazo."])
                                                                ?>

                                    <?php echo $this->Html->link('<i class="fa  fa-tint"></i>',
                                                                        ['controller' => 'PurityMicro', 'action' => 'index', $bankMicro->id],
                                                                        ['class' => 'btn btn-default btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Prueba de Pureza."])
                                                                ?>
                                    <?php echo $this->Html->link('<i class="fa  fa-sign-in"></i>',
                                                                        ['controller' => 'InputMicro', 'action' => 'index', $bankMicro->id],
                                                                        ['class' => 'btn btn-success btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Entrada al Banco Microorganismo."])
                                                                ?>
                                    <?php echo $this->Html->link('<i class="fa  fa-sign-out"></i>',
                                                                        ['controller' => 'OutputMicro', 'action' => 'index', $bankMicro->id],
                                                                        ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Salida del Banco Microorganismo."])
                                                                ?>
                                    <?php if($permiso['view']) { ?>

                                    <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                                        ['controller' => 'BankMicro', 'action' => 'view', $bankMicro->id],
                                                                        ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Banco Microorganismo."])
                                                                ?>
                                    <?php } ?>

                                    <?php if($permiso['edit'] /*&& $validar*/ ) { ?>

                                    <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                                        ['controller' => 'BankMicro', 'action' => 'edit', $bankMicro->id],
                                                                        ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Banco Microorganismo."])
                                                                ?>

                                    <?php } ?>

                                    <?php if($permiso['delete'] /*&& $validar*/) { ?>


                                    <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                                        ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$bankMicro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Microorganismo."])
                                                                ?>

                                    <?php } ?>

                                    </td>
                                </tr>
                                 <?php $item++; ?>
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
                <h4 class="modal-title" id="myModalLabel">MENSAJE</h4>
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