
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?></h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Publicaciones');

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
                    <h3 class="box-title"><strong>Listado de <?php echo $mod_modulo ?></strong></h3>
                    <div class="pull-right box-tools">

                    <?php if($permiso['add']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'Publication','action'=>'add'],['class'=>'btn btn-success', 'data-toggle'=>"tooltip" , 'title'=>"Nueva Publicación", 'escape' => false]) ?>
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
                                    <th style="min-width: 150px">Título</th>
                                    <th style="min-width: 150px">Autor</th>
                                    <th style="min-width: 150px">Editorial</th>
                                    <th style="min-width: 150px">Idioma</th>
                                    <th style="min-width: 150px">Año Ed.</th>
                                    <th style="min-width: 150px">Mes Ed.</th>
                                    <th style="min-width: 150px">N° Edición</th>
                                    <th style="min-width: 150px">País</th>
                                    <th style="min-width: 150px">Lugar Public.</th>
                                    <th style="min-width: 150px">N° Pag.</th>
                                    <th style="min-width: 150px">N° Ejemp.</th>
                                    <th style="min-width: 150px">Tipo Public.</th>
                                    <th style="min-width: 150px">N° Volumen</th>
                                    <th style="min-width: 150px">Institución</th>
                                    <th style="min-width: 150px">Categoría</th>
                                    <th style="min-width: 150px">Disponibilidad</th>
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
                                <?php foreach ($publication as $publication): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td><?= h($publication->title) ?></td>
                                    <td><?= h($publication->author) ?></td>
                                    <td><?= h($publication->editorial) ?></td>
                                    <td><?= h($publication->languages) ?></td>
                                    <td><?= $publication->fec_edit ?></td>
                                    <td><?= $this->Functions->nombreMes($publication->month_edit) ?></td>
                                    <td><?= $this->Number->format($publication->edition) ?></td>
                                    <td><?= $publication->country->name ?></td>
                                    <td><?= h($publication->public_place) ?></td>
                                    <td><?= $this->Number->format($publication->numpag) ?></td>
                                    <td><?= $this->Number->format($publication->copy) ?></td>
                                    <td><?= (!empty($publication->tipoPublicacion))? $publication->tipoPublicacion->name : '' ?></td>
                                    <td><?= $this->Number->format($publication->volume) ?></td>
                                    <td><?= h($publication->institution) ?></td>
                                    <td><?= (!empty($publication->tipoCategoria))? $publication->tipoCategoria->name : '' ?></td>
                                    <td><?= ($publication->availability == 1)? 'ACTIVO' : 'INACTIVO' ?></td>
                                    <td class="text-center">

                                    <?php if($permiso['view']){ ?>

                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'Publication', 'action' => 'view', $publication->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de la Publicación."])
                                        ?>
                                    <?php } ?>

                                    <?php if($permiso['edit']){ ?>
                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'Publication', 'action' => 'edit', 'id' => $publication->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar la Publicación."])
                                        ?>
                                    <?php } ?>

                                    <?php if($permiso['delete']){ ?>
                                        <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar la Publicación.', 'data-id' => $publication->id])
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>

