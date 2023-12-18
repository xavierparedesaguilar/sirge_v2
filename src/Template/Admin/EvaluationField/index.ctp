
<?php $this->assign('title', $titulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $titulo?></h1>



    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'EvaluationField', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Evaluación');
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
                                    ['controller' => 'EvaluationField', 'action' => 'add','id'=>$id],
                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nueva Evaluación del Experimento", 'escape'=>false] )
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
                 <th style="min-width: 165px;">NOMBRE DEL RESPONSABLE</th>
                 <th style="min-width: 180px;">TIPO PRODUCTO</th>
                 <th style="min-width: 160px;">ÉPOCA DE COSECHA</th>
                 <th style="min-width: 160px;">FECHA EVALUACIÓN</th>
                 <th style="min-width: 150px;">OPCIONES</th>
            </tr>
        </thead>
        <tfoot class="footTablaListado">
                            <tr class="text-uppercase">
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
            <?php foreach ($evaluationField as $evaluationField): ?>
             <tr>
                <td><?php echo $this->Number->format($item) ?></td>
                <td><?php echo ($evaluationField->evalname) ?></td>

                <td><?php echo $evaluationField->producto==NULL?'':$evaluationField->producto->name;?></td>
                <td><?php echo ($evaluationField->harvest) ?></td>
                <td><?php echo empty($evaluationField->evaldate)? '' : date("d-m-Y", strtotime($evaluationField->evaldate))  ?></td>

                <td>

                    <?php if($permiso['view']) { ?>

                       <a href="<?php echo $this->Url->build('/'.$this->request->url.'/ver/'.$evaluationField->id, true) ?>" class="btn btn-info btn-xs" data-toggle = "tooltip" title = "Ver información de la Evaluación del Experimento."><i class="fa  fa-search-plus"></i></a>

                    <?php } ?>

                    <?php if($permiso['edit']) { ?>

                      <a href="<?php echo $this->Url->build('/'.$this->request->url.'/editar/'.$evaluationField->id, true) ?>" class="btn btn-primary btn-xs" data-toggle = "tooltip" title = "Editar información de la Evaluación del Experimento."><i class="fa fa-pencil-square-o"></i></a>

                    <?php } ?>


                    <?php if($permiso['delete']) { ?>

                      <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$evaluationField->id, 'data-toggle' => "tooltip", 'title' => "Eliminar la Evaluación del Experimento."])
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




<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">MENSAJE</h4>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar el registro actual?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla','id'=>$id]]); ?>
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