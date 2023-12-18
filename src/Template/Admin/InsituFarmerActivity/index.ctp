
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$mod_title ?></h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Prácticas Agrícolas');

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
                        <?php echo $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'InsituFarmerActivity', 'action' => 'add', 'idx' => $insitu->id], ['class' => 'btn btn-success','data-toggle' => "tooltip", 'title' => "Agregar nuevo Práctica Agrícola.", 'escape' => false] ); ?>
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
                                    <th>#</th>
                                    <th>Finalidad</th>
                                    <th>Comunidades</th>
                                    <th>Nombre Común</th>
                                    <th>Insumo / Herramienta</th>
                                    <th>origen</th>
                                    <th>Práctica / Saber</th>
                                    <th>Técnica / Categoría</th>
                                    <th><?= __('Opciones') ?></th>
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
                                <?php foreach ($insituFarmerActivity as $insituFarmerActivity): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td><?= h($insituFarmerActivity->purpose) ?></td>
                                    <td><?= h($insituFarmerActivity->comunities) ?></td>
                                    <td><?= h($insituFarmerActivity->common_name) ?></td>
                                    <td><?= $insituFarmerActivity->insumoHerramienta->name ?></td>
                                    <td><?= $insituFarmerActivity->origen->name ?></td>
                                    <td><?= $insituFarmerActivity->practicaSaber->name ?></td>
                                    <td><?= $insituFarmerActivity->tecnicaCategoria->name ?></td>
                                    <td class="text-center">

                                    <?php if ($permiso['view']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'InsituFarmerActivity', 'action' => 'view', 'id' => $insituFarmerActivity->id, 'idx' => $insituFarmerActivity->insitu_id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de Práctica Agrícola."])
                                        ?>
                                    <?php } ?>

                                    <?php if ($permiso['edit']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'InsituFarmerActivity', 'action' => 'edit', 'id' => $insituFarmerActivity->id, 'idx' => $insituFarmerActivity->insitu_id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Práctica Agrícola."])
                                        ?>
                                    <?php } ?>

                                    <?php if ($permiso['delete']) { ?>
                                        <?php
                                            echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$insituFarmerActivity->id, 'data-toggle' => "tooltip", 'title' => "Eliminar Práctica Agrícola."])
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