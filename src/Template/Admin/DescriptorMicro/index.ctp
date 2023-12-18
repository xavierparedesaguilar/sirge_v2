
<?php $this->assign('title', $mod_padre); ?>

<section class="content-header">
    <h1><?php echo $mod_padre . " - " . $mod_parent ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaMicro', 'action' => 'index']);
        $this->Html->addCrumb('Descriptor');

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
                    <h3 class="box-title"><strong>Lista de Descriptores</strong></h3>
                    <div class="box-tools pull-right">
                    <?php if($permiso['add']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus"></i>', $this->Url->build('/' . $this->request->url . '/crear', true), ['class' => 'btn btn-success','data-toggle' => "tooltip", 'title' => "Agregar nuevo descriptor.", 'escape' => false] ); ?>
                    <?php } ?>

                    <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Lista de Descriptores" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                    <th>DESCRIPTOR</th>
                                    <th>TÍTULO</th>
                                    <th>TIPO</th>
                                    <th>CATÁLOGO</th>
                                    <th>ESPECIE</th>
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
                                        <td></td>
                                    </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1; ?>
                                <?php foreach ($descriptor as $descriptor): ?>
                                <tr>
                                    <td><?php echo $item ?></td>
                                    <td><?= h($descriptor->name) ?></td>
                                    <td><?= h($descriptor->title) ?></td>
                                    <td><?= ($descriptor->value_type == 1)? 'CUANTITATIVO' : 'CUALITATIVO' ?></td>
                                    <td><?= ($descriptor->flg_catalogue == 1)? 'SI' : 'NO' ?></td>
                                    <td><?= h($descriptor->specie->species) ?></td>
                                    <td class="text-center">
                                        <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i>',
                                                ['controller' => 'DescriptorStateMicro', 'action' => 'index', 'idy' => $descriptor->specie->id, 'idx' => $descriptor->id],
                                                ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Agregar estados al Descriptor."])
                                        ?>
                                        <?php if($permiso['view']){ ?>
                                            <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                    ['controller' => 'DescriptorMicro', 'action' => 'view', 'idx' => $descriptor->specie->id, 'id' => $descriptor->id],
                                                    ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Desccriptor."])
                                            ?>
                                        <?php } ?>
                                        <?php if($permiso['edit']){ ?>
                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                    ['controller' => 'DescriptorMicro', 'action' => 'edit', 'idx' => $descriptor->specie->id, 'id' => $descriptor->id],
                                                    ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Descriptor."])
                                            ?>
                                        <?php } ?>
                                        <?php if($permiso['delete']){ ?>
                                            <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                    ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar el Descriptor.', 'data-id' => $descriptor->id])
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla', 'idx' => $especie->id]]); ?>
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