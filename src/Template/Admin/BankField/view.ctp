
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

     <h1>Módulo <?php echo $titulo ?> - Detalle</h1>
    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
        $this->Html->addCrumb($bankField->id, ['controller' => 'BankField', 'action' => 'view','id'=>$bankField->id]);
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

<!-- /Page Header -->
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
                                    ['controller' => 'BankField', 'action' => 'edit', $bankField->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>

                    <?php } ?>

                    <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$bankField->id])
                        ?>

                    <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'BankField', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>


                    </div>
                </div>
                <div class="box-body">
                <!-- Inicio Campos de la tabla Pasaporte -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS DEL EXPERIMENTO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--DATOS DEL EXPERIMENTO-->
                                                <tr>
                                                    <th scope="row"><?= __('Tipo de Material Sembrado') ?></th>
                                                    <td><?php echo $bankField->material== null ?'': $bankField->material->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Objetivo del Proyecto') ?></th>
                                                    <td><?php echo $bankField->proyecto== null ? '': $bankField->proyecto->name ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?= __('Fecha de Inicio') ?></th>
                                                    <td><?php echo $bankField->startdate==NULL?'': date('d-m-Y', strtotime($bankField->startdate)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha de Término') ?></th>
                                                    <td><?php echo $bankField->enddate==NULL?'': date('d-m-Y', strtotime($bankField->enddate)) ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Investigador responsable del Experimento') ?></th>
                                                    <td><?php echo h($bankField->researcher) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Proyecto Responsable') ?></th>
                                                    <td><?php echo h($bankField->proyect) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Anotaciones') ?></th>
                                                    <td><?php echo h($bankField->remarks) ?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 1-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DISEÑO DEL EXPERIMENTO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--DISEÑO DEL EXPERIMENTO-->
                                                <tr>
                                                    <th scope="row"><?= __('Diseño del Experimento') ?></th>
                                                    <td><?php echo h($bankField->design) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tamaño de Parcela') ?></th>
                                                    <td><?php echo h($bankField->fieldsize) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tratamiento') ?></th>
                                                    <td><?php echo h($bankField->treatment) ?></td>
                                                </tr>

                                                <!--FIN DEL MODULO 2-->

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Número de repeticiones') ?></th>
                                                    <td><?php echo h($bankField->reps) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Número de plantas por parcela') ?></th>
                                                    <td><?php echo h($bankField->plotsize) ?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 2-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">UBICACIÓN DEL EXPERIMENTO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--UBICACIÓN DEL EXPERIMENTO-->
                                                <tr>
                                                    <th scope="row"><?= __('Departamento') ?></th>
                                                    <td><?php echo $bankField->departamentoubi== null ? 'Ninguno': $bankField->departamentoubi->nombre ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Provincia') ?></th>
                                                    <td><?php echo $bankField->provincias== null ? 'Ninguno': $bankField->provincias->nombre ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Distrito') ?></th>
                                                    <td><?php echo $bankField->distritos== null ? 'Ninguno': $bankField->distritos->nombre ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Estación Experimental') ?></th>
                                                    <td><?php echo  $bankField->estacionexp==null ? '': $bankField->estacionexp->eea?></td>

                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Localidad') ?></th>
                                                    <td><?php echo h($bankField->locality) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">

                                                <tr>
                                                    <th scope="row"><?= __('Código o Descripción del Campo') ?></th>
                                                    <td><?php echo h($bankField->field) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Latitud') ?></th>
                                                    <td><?php echo h($bankField->latitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Longitud') ?></th>
                                                    <td><?php echo h($bankField->longitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Elevación') ?></th>
                                                    <td><?php echo h($bankField->elevation) ?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 3-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS GERMOPLASMA</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--DATOS GERMOPLASMA-->
                                                <tr>
                                                    <th scope="row"><?= __('Código PER') ?></th>
                                                    <td><?php echo $bankField->passportcampo==null ? '': $bankField->passportcampo->accenumb; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código Accesión') ?></th>
                                                    <td><?php echo $bankField->accenumb; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Colección') ?></th>
                                                    <td><?php echo $bankField->coleccion==null ? '': $bankField->coleccion->colname?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código del material') ?></th>
                                                    <td><?php echo h($bankField->othenumb) ?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 4-->

                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre Científico') ?></th>
                                                    <td><?php echo $bankField->especies== NULL ?'':$bankField->especies->genus.' '.$bankField->especies->species; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código del material') ?></th>
                                                    <td><?php echo h($bankField->othenumb) ?></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><?php echo __('Especie - Nombre Común') ?></th>
                                                    <td><?php echo $bankField->especies== NULL ?'': $bankField->especies->cropname; ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?= __('Otro nombre de la muestra') ?></th>
                                                    <td><?php echo h($bankField->othername) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código de Identificación Interno') ?></th>
                                                    <td><?php echo h($bankField->detecnumb) ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-offset-3 col-xs-12 col-md-6 col-lg-3">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Imagen Croquis</h3>
                                </div>
                                <div class="box-body">
                                    <center>
                                        <?php if($bankField->fieldmap == NULL || $bankField->fieldmap == '' ){ ?>
                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                        <?php } else { ?>
                                            <img src="<?php echo $this->Url->build('/', true).$bankField->fieldmap ?>" class="img-responsive"  style="height: 207px">
                                        <?php } ?>
                                    </center>
                                </div>
                             </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-3">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Imagen 2</h3>
                                </div>
                                <div class="box-body">
                                    <center>
                                        <?php if($bankField->image1 == NULL || $bankField->image1 == '' ){ ?>
                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                        <?php } else { ?>
                                            <img src="<?php echo $this->Url->build('/', true).$bankField->image1 ?>" class="img-responsive" style="height: 207px">
                                        <?php } ?>
                                    </center>
                                </div>
                                <div class="box-footer">
                                    <p><?= h($bankField->remarks1) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                      <?php if($permiso['edit']) { ?>

                         <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-campo/editar/'.$bankField->id, true) ?>"
                           class="btn btn-primary"> EDITAR
                        </a>

                      <?php  } ?>

                      <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('ELIMINAR', "#",
                                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$bankField->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Campo."])
                        ?>

                       <?php  } ?>

                        <?php echo $this->Html->link('REGRESAR',
                                        ['controller' => 'BankField', 'action' => 'index'],
                                        ['class' => 'btn btn-default', 'escape'=>false] )
                        ?>

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

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $this->Html->link('Confirmar',
                                    ['controller' => 'BankField', 'action' => 'delete', $bankField->id],
                                    ['class' => 'btn btn-success', 'escape'=>false] );
                        ?>');
        $("#trigger").click();
    });
</script>

