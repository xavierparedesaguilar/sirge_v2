
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

   <h1>Módulo <?php echo $titulo ?> - Detalle</h1>
       <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);
        $this->Html->addCrumb($bankInvitro->id, ['controller' => 'BankInvitro', 'action' => 'view','id'=>$bankInvitro->id]);
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
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['edit'] && $validar) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                ['controller' => 'BankInvitro', 'action' => 'edit', $bankInvitro->id],
                                ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                            ?>

                        <?php  } ?>

                        <?php if($permiso['delete'] && $validar) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$bankInvitro->id])
                            ?>

                        <?php  } ?>

                            <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                        ['controller' => 'BankInvitro', 'action' => 'index'],
                                        ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                            ?>

                    </div>
                 <br>
                </div>
                <div class="box-body">
                <!-- Inicio Campos de la tabla Pasaporte -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS PRINCIPALES</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--DATOS PRINCIPALES-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Código PER') ?></th>
                                                    <td><?php echo h($bankInvitro->passport->accenumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Código Accesión') ?></th>
                                                    <td><?php echo $bankInvitro->codaccesionin==NULL ?'': $bankInvitro->codaccesionin->othenumb; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Colección') ?></th>
                                                    <td><?php echo h($bankInvitro->passport->specie->collection->colname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre Científico') ?></th>
                                                    <td><?php echo h($bankInvitro->passport->specie->genus.' '.$bankInvitro->passport->specie->species) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre común') ?></th>
                                                    <td><?php echo $bankInvitro->codaccesionin->especiesemilla==NULL ?'': $bankInvitro->codaccesionin->especiesemilla->cropname; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de Lote') ?></th>
                                                    <td><?php echo h($bankInvitro->lotnumb) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Fecha Adquisición') ?></th>
                                                    <td><?php echo  $bankInvitro->acqdate==NULL?'': date('d-m-Y',strtotime($bankInvitro->acqdate)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Disponibilidad del lote de le Accesión') ?></th>
                                                    <td><?php echo $bankInvitro->disponibilidad==NULL?'':$bankInvitro->disponibilidad->name?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Anotaciones') ?></th>
                                                    <td><?php echo h($bankInvitro->remarks) ?></td>
                                                </tr>
                                                <!--FIN MODULO 1-->
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
                                <h3 class="box-title">CUARTO DE CONSERVACIÓN</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--CUARTO DE CONSERVACIÓN-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Cuarto de Conservación') ?></th>
                                                    <td><?php echo $bankInvitro->conservacion==NULL?'':$bankInvitro->conservacion->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Temperatura') ?></th>
                                                    <td><?php echo $bankInvitro->temperatura==NULL?'':$bankInvitro->temperatura->name ?></td>
                                                </tr>
                                                <!--FIN MODULO 2-->

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
                                <h3 class="box-title">UBICACIÓN DE MATERIAL</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--UBICACIÓN DEL MATERIAL-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Estantería') ?></th>
                                                    <td><?php echo h($bankInvitro->shelving) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nivel de estantería') ?></th>
                                                    <td><?php echo h($bankInvitro->levelshelv) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Gradilla') ?></th>
                                                    <td><?php echo h($bankInvitro->rack) ?></td>
                                                </tr>
                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Duplicado de Seguridad') ?></th>
                                                    <td><?php echo h($bankInvitro->duplinstname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de Duplicados') ?></th>
                                                    <td><?php echo h($bankInvitro->dupnumb) ?></td>
                                                </tr>
                                                <!--FIN MODULO 3-->
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
                                <h3 class="box-title">ESTADO DE LA PLANTA</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--ESTADO DE LA PLANTA-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Estado de la Planta') ?></th>
                                                    <td><?php echo $bankInvitro->estadoPlanta==NULL ?'':$bankInvitro->estadoPlanta->name?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Necrosis de Yema y Talla') ?></th>
                                                    <td><?php echo $bankInvitro->necrosisinput==NULL?'':$bankInvitro->necrosisinput->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Defoliación (%)') ?></th>
                                                    <td><?php echo $bankInvitro->defolacion==NULL?'':$bankInvitro->defolacion->name ?></td>
                                                </tr>

                                                <!--FIN MODULO 4-->

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Enraizamiento') ?></th>
                                                    <td><?php echo $bankInvitro->enraizamiento==NULL?'':$bankInvitro->enraizamiento->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Clorosis') ?></th>
                                                    <td><?php echo $bankInvitro->Clorosis==NULL?'':$bankInvitro->Clorosis->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Fenolización') ?></th>
                                                    <td><?php echo $bankInvitro->fenolizacion==NULL ?'':$bankInvitro->fenolizacion->name ?></td>
                                                </tr>

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
                                <h3 class="box-title">MEDIO CULTIVO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--MEDIO CULTIVO-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Tipo de almacenamiento') ?></th>
                                                    <td><?php echo $bankInvitro->almacenamiento ==NULL?'':$bankInvitro->almacenamiento->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Propagación') ?></th>
                                                    <td><?php echo $bankInvitro->propagacion==NULL?'':$bankInvitro->propagacion->name ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Conservación') ?></th>
                                                    <td><?php echo $bankInvitro->Conservacion==NULL?'':$bankInvitro->Conservacion->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Tiempo Máximo en el Medio') ?></th>
                                                    <td><?php echo h($bankInvitro->protime) ?></td>
                                                </tr>
                                                <!--tr-->
                                                    <!--th scope="row"--><!--?php echo __('Duración de la Conservación') ?></th-->
                                                    <!--td--><!--?php echo h($bankInvitro->constime) ?></td>
                                                </tr>

                                                <!--FIN MODULO 5-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">

                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">STOCK DE TUBOS</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--STOCK DE TUBOS-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Números de Tubos') ?></th>
                                                    <td><?php echo h($bankInvitro->tubenumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Números de Explantes') ?></th>
                                                    <td><?php echo h($bankInvitro->explnumb) ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Tamaño Tubo') ?></th>
                                                    <td><?php echo $bankInvitro->tubo==NULL?'':$bankInvitro->tubo->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Stock de Explantes') ?></th>
                                                    <td><?php echo h($bankInvitro->stock) ?></td>
                                                </tr>
                                                <!--FIN MODULO 6-->
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
                                <h3 class="box-title">ESTADO FITOSANITARIO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--ESTADO FITOSANITARIO-->
                                                <tr>
                                                    <th scope="row"><?php echo  __('Estado Fitosanitario de la Planta') ?></th>
                                                    <td><?php echo $bankInvitro->EstadoFito==NULL?'':$bankInvitro->EstadoFito->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Fitopatógenos') ?></th>
                                                    <td><?php echo h($bankInvitro->pathogen) ?></td>
                                                </tr>
                                                <!--FIN -->

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="box-footer">
                        <div class="col-sm-12 text-center">
                            <!-- imagen flecha volver: zmdi zmdi-long-arrow-return -->

                            <?php if($permiso['edit'] && $validar) { ?>

                                <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/editar/'.$bankInvitro->id, true) ?>"
                                 class="btn btn-primary"> EDITAR
                                </a>

                            <?php } ?>

                            <?php if($permiso['delete'] && $validar) { ?>

                                <?php echo $this->Html->link('ELIMINAR', "#",
                                ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$bankInvitro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Invitro."])
                                ?>

                            <?php } ?>

                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/'.$bankInvitro->bank_invitro_id, true) ?>"
                             class="btn btn-default"> REGRESAR
                            </a>
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
            ['controller' => 'BankInvitro', 'action' => 'delete', $bankInvitro->id],
            ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
            ?>');
        $("#trigger").click();
    });
</script>

