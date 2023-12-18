
<?php $this->assign('title', $mod_padre); ?>

<section class="content-header">
    <h1><?php echo $mod_padre . " - Estados del Descriptor " ?><strong><?php echo $mod_parent ?></strong></h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Caracterización','/admin/zoogenetico/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaZoo', 'action' => 'index']);
        $this->Html->addCrumb('Descriptor', ['controller' => 'DescriptorZoo', 'action' => 'index', 'id' => $especie->id ]);
        $this->Html->addCrumb($descriptor->name, ['controller' => 'DescriptorStateZoo', 'action' => 'index', 'idx' => $descriptor->id, 'idy' => $especie->id ]);
        $this->Html->addCrumb('Estados');

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
                    <h3 class="box-title"><strong>Lista de Estados</strong></h3>
                    <div class="box-tools pull-right">

                    <?php if ($permiso['add']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-plus"></i>',
                                                    ['controller' => 'DescriptorStateZoo', 'action' => 'add',
                                                       'idy' => $descriptor->specie_id, 'idx' => $descriptor->id],
                                                      ['class' => 'btn btn-success','data-toggle' => "tooltip",
                                                       'title' => "Agregar nuevo estado de descriptor.",
                                                       'escape' => false] );
                        ?>

                    <?php } ?>

                    <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Lista de Estados" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                    <?php } ?>

                    </div>
                </div>
                <div class="box-body">
                    <div>
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th>#</th>
                                    <th>NOMBRE DE ESTADO (DESCRIPCIÓN)</th>
                                    <th>ESTADO</th>
                                    <th><?= __('Acciones') ?></th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                    <tr class="text-uppercase">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <td></td>
                                    </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1; ?>
                                <?php foreach ($descriptorState as $descriptorState): ?>
                                <tr>
                                    <td><?php echo $item ?></td>
                                    <td><?= h($descriptorState->label) ?></td>
                                    <td><?= h($descriptorState->code) ?></td>
                                    <td class="text-center">

                                    <?php if ($permiso['edit']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'DescriptorStateZoo', 'action' => 'edit', 'idy' => $descriptorState->descriptor->specie_id, 'idx' => $descriptorState->descriptor->id, 'id' => $descriptorState->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el estado del descriptor."])
                                        ?>

                                    <?php } ?>

                                    <?php if ($permiso['delete']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar el estado del descriptor.', 'data-id' => $descriptorState->id])
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla', 'idx' => $descriptor->id, 'idy' => $especie->id]]); ?>
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
