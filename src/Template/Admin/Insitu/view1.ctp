
<?php $this->assign('title', $mod_modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?> - <?php echo $insitu->code_insitu ?></h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'Insitu', 'action' => 'view', 'id' => $insitu->id]);
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


<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                    <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'Insitu', 'action' => 'edit', $insitu->id],
                                    ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );?>
                    <?php } ?>

                    <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$insitu->id])?>

                    <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'Insitu', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Geográficos</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Código') ?></th>
                                            <td><?= h($insitu->code_insitu) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Departamento') ?></th>
                                            <td><?= $insitu->ubigeo->departamento->nombre ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Provincia') ?></th>
                                            <td><?= $insitu->ubigeo->provincia ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Distrito') ?></th>
                                            <td><?= $insitu->ubigeo->distrito ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Referencia') ?></th>
                                            <td><?= h($insitu->reference) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Latitud') ?></th>
                                            <td><?= h($insitu->latitude) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Longitud') ?></th>
                                            <td><?= h($insitu->length) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Altitud') ?></th>
                                            <td><?= h($insitu->altitude) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos del Agricultor</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Nombre de Agricultor') ?></th>
                                            <td><?= h($insitu->name_farmer) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Dirección de Agricultor') ?></th>
                                            <td><?= h($insitu->address_farmer) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Grado de Instrucción') ?></th>
                                            <td><?= $this->Number->format($insitu->degree_instruction) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Edad de Agricultor') ?></th>
                                            <td><?= $this->Number->format($insitu->age_farmer) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Pertenece Org. Campesina') ?></th>
                                            <td><?= ($insitu->peasant_organization == 1)? 'SI' : 'NO' ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Nombre Organización Campesina') ?></th>
                                            <td><?= h($insitu->name_peasant_organization) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Otras Personas') ?></th>
                                            <td><?= $this->Text->autoParagraph(h($insitu->other_people)); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos de Chacra</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Tipo de Suelo') ?></th>
                                            <td><?= $insitu->tipoSuelo->name ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Área') ?></th>
                                            <td><?= $this->Number->format($insitu->area) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Zona de Vida / Agroecológica') ?></th>
                                            <td><?= h($insitu->living_area) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Registros Meteorológicos') ?></th>
                                            <td><?= h($insitu->meteorological_record) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Descripción Biofísica') ?></th>
                                            <td><?= $this->Text->autoParagraph(h($insitu->biophysical_description)); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Descripción de Chacra') ?></th>
                                            <td><?= $this->Text->autoParagraph(h($insitu->description_chakra)); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Generales</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-4">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Monitoreo') ?></th>
                                            <td><?= ($insitu->monitoring == 1)? 'SI' : 'NO' ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-4">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Resolución Ministerial') ?></th>
                                            <td><?= ($insitu->ministerial_resolution) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-4">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th scope="row"><?= __('Nro. Variedades') ?></th>
                                            <td><?= $this->Number->format($insitu->variety_number) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?= __('Observación') ?></th>
                                                <td><?= $this->Text->autoParagraph(h($insitu->observation)); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Descripción de Trabajadores') ?></th>
                                                <td><?= ($insitu->description_workers); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if($permiso['edit']) { ?>
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'Insitu', 'action' => 'edit', $insitu->id], ['class' => 'btn btn-primary'] ); ?>
                    <?php } ?>
                    <?php if($permiso['delete']) { ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$insitu->id])?>
                    <?php } ?>
                        <?php echo $this->Html->link('REGRESAR',['controller' => 'Insitu', 'action' => 'index'], ['class' => 'btn  btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'Insitu', 'action' => 'delete', 'id' => $insitu->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>

