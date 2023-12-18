
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$mod_title ?></h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituAccesion', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Especies');

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
                    <h3 class="box-title"><strong>Lista <?php echo $mod_modulo ?></strong></h3>
                    <div class="pull-right box-tools">
                    <?php if ($permiso['add']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'InsituAccesion', 'action' => 'add', 'idx' => $insitu->id], ['class' => 'btn btn-success','data-toggle' => "tooltip", 'title' => "Agregar nueva Accesión.", 'escape' => false] ); ?>
                    <?php } ?>

                     <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $mod_modulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                    <th style="min-width: 120px">Código PER</th>
                                    <th style="min-width: 140px">Cod. Accesión</th>
                                    <th style="min-width: 140px">Nomb. Común</th>
                                    <th style="min-width: 140px">Parientes Silvestres</th>
                                    <th style="min-width: 120px">Colector</th>
                                    <th style="min-width: 180px">Uso Reportado</th>
                                    <th style="min-width: 120px">Extensión</th>
                                    <th style="min-width: 180px">Área Cultivo (m2)</th>
                                    <th style="min-width: 180px">Nomb. Científico</th>
                                    <th style="min-width: 120px">Usos</th>
                                    <th style="min-width: 120px">Nomb. Local</th>
                                    <th style="min-width: 120px">Habitat</th>
                                    <th style="min-width: 120px"><?= __('Opciones') ?></th>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1;


                                ?>
                                <?php foreach ($insituAccesion as $insituAccesion): ?>
                                <?php
                                      $result='';
                                      if($insituAccesion->wild_relatives==1) $result='SI';
                                      if($insituAccesion->wild_relatives==2) $result='NO';
                                ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td><?= h($insituAccesion->accenumb) ?></td>
                                    <td><?= h($insituAccesion->othenumb) ?></td>
                                    <td><?= h($insituAccesion->common_name) ?></td>
                                    <td><?= h($result) ?></td>
                                    <td><?= h($insituAccesion->manifold) ?></td>
                                    <td><?= h($insituAccesion->reported_usage) ?></td>
                                    <td><?= h($insituAccesion->extension) ?></td>
                                    <td><?= h($insituAccesion->area_cultivation) ?></td>
                                    <td><?= h($insituAccesion->scientific_name) ?></td>
                                    <td><?= h($insituAccesion->uso) ?></td>
                                    <td><?= h($insituAccesion->local_name) ?></td>
                                    <td><?= h($insituAccesion->habitat) ?></td>
                                    <td class="text-center">
                                    <?php if ($permiso['view']) { ?>
                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'InsituAccesion', 'action' => 'view', 'id' => $insituAccesion->id, 'idx' => $insituAccesion->insitu_id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de Accesión."])
                                        ?>
                                    <?php } ?>
                                    <?php if ($permiso['edit']) { ?>
                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'InsituAccesion', 'action' => 'edit', 'id' => $insituAccesion->id, 'idx' => $insituAccesion->insitu_id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Accesión."])
                                        ?>
                                    <?php } ?>
                                    <?php if ($permiso['delete']) { ?>
                                        <?php
                                            echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$insituAccesion->id, 'data-toggle' => "tooltip", 'title' => "Eliminar Accesión."])
                                        ?>
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla', 'idx' => $insitu->id]]); ?>
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
