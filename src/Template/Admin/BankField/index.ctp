<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_padre . " - " . $titulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
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
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['add']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                        ['controller' => 'BankField', 'action' => 'add'],
                                        ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Banco Campo", 'escape'=>false] )
                            ?>

                        <?php  } ?>

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
                                  <th style="min-width: 40px;">#</th>
                                  <th style="min-width: 150px;">CÓDIGO DE EXPERIMENTO</th>
                                  <th style="min-width: 150px;">TIPO DE MATERIAL SEMBRADO</th>
                                  <th style="min-width: 170px;">OBJETIVO DEL PROYECTO</th>
                                  <th style="min-width: 165px;">FECHA DE INICIO</th>
                                  <th style="min-width: 165px;">FECHA DE TERMINO</th>
                                  <th style="min-width: 165px;">INVESTIGADOR RESPONSABLE DEL EXPERIMENTO</th>
                                  <th style="min-width: 165px;">PROYECTO RESPONSABLE</th>
                                  <th style="min-width: 180px;">OPCIONES</th>
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
                                <?php $item = 1; ?>
                                <?php foreach ($bankField as $bankField): ?>
                                <tr>

                                    <td><?php echo $this->Number->format($item) ?></td>
                                    <td><?php echo $bankField->expcode ?></td>
                                    <td><?php echo ($bankField->material== NULL || $bankField->material->name=='')? '' :$bankField->material->name ?></td>
                                    <td><?php echo ($bankField->proyecto == NULL || $bankField->proyecto->name=='')? '' :$bankField->proyecto->name ?></td>
                                    <td><?php echo ($bankField->startdate == NULL || $bankField->startdate=='')? '' : date("d-m-Y", strtotime($bankField->startdate))  ?></td>
                                    <td><?php echo ($bankField->enddate == NULL || $bankField->enddate =='')? '' : date("d-m-Y", strtotime($bankField->enddate  ))  ?></td>
                                    <td><?php echo $bankField->researcher?></td>
                                    <td><?php echo $bankField->proyect?></td>

                                     <td>
                                            <?php echo $this->Html->link('<i class="fa  fa-file-text-o"></i>',
                                                                                ['controller' => 'evaluationField', 'action' => 'index', $bankField->id],
                                                                                ['class' => 'btn btn-default btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Evaluación Campo."])
                                            ?>


                                            <?php echo $this->Html->link('<i class="fa  fa-sign-in"></i>',
                                                                                ['controller' => 'inputField', 'action' => 'index', $bankField->id],
                                                                                ['class' => 'btn btn-success btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Entrada al Banco Campo."])
                                            ?>


                                            <?php echo $this->Html->link('<i class="fa  fa-sign-out"></i>',
                                                                                ['controller' => 'outputField', 'action' => 'index', $bankField->id],
                                                                                ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Salida del Banco Semilla."])
                                            ?>




                                            <?php if($permiso['view']) { ?>



                                                <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                                                    ['controller' => 'BankField', 'action' => 'view', $bankField->id],
                                                                                    ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Banco Campo."])
                                                ?>

                                            <?php } ?>

                                            <?php if($permiso['edit']) { ?>

                                                <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                                                    ['controller' => 'BankField', 'action' => 'edit', $bankField->id],
                                                                                    ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Banco Campo."])
                                                ?>

                                            <?php } ?>

                                            <?php if($permiso['delete']) { ?>

                                                <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                                                    ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$bankField->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Campo."])
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat '>Confirmar</a>");
        $("#trigger").click();
    });
</script>