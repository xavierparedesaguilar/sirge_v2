
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>
       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($bankMicro->id, ['controller' => 'BankMicro', 'action' => 'view','id'=>$bankMicro->id]);
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
                                    ['controller' => 'BankMicro', 'action' => 'edit', $bankMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>

                        <?php } ?>

                         <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$bankMicro->id])
                        ?>

                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'BankMicro', 'action' => 'index'],
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
                                                    <td><?php echo h($bankMicro->passport->accenumb) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Colección') ?></th>
                                                    <td><?php echo h($bankMicro->passport->specie->collection->colname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre Científico') ?></th>
                                                    <td><?php echo h($bankMicro->passport->specie->genus.' '.$bankMicro->passport->specie->species) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Especie -Nombre común') ?></th>
                                                    <td><?php echo h($bankMicro->passport->specie->cropname) ?></td>
                                                </tr>

                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                            <!-- DATOS PRINCIPALES -->
                                                <tr>
                                                    <th scope="row"><?php echo __('Código Accesión') ?></th>
                                                    <td><?php echo $bankMicro->codaccesionmicro==NULL ?'': $bankMicro->codaccesionmicro->othenumb; ?></td>
                                                </tr>

                                                 <tr>
                                                    <th scope="row"><?php echo __('Fecha Adquisición') ?></th>
                                                    <td><?php echo  $bankMicro->acqdate==NULL?'': date('d-m-Y',strtotime($bankMicro->acqdate)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Disponibilidad del lote de le Accesión') ?></th>
                                                    <td><?php echo $bankMicro->disponibilidad==NULL?'':$bankMicro->disponibilidad->name;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Anotaciones') ?></th>
                                                    <td><?php echo $bankMicro->remarks?></td>
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
                                <h3 class="box-title">CUARENTENA</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--CUARENTENA-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Riesgo Biológico') ?></th>
                                                    <td><?php  echo $bankMicro->riesgo==NULL?'':$bankMicro->riesgo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nivel de Laboratorio') ?></th>
                                                    <td><?php echo $bankMicro->nivel==NULL?'':$bankMicro->nivel->name?></td>
                                                </tr>


                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Lugar de cuarentena') ?></th>
                                                    <td><?php echo $bankMicro->quarplace?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Tiempo de cuarentena') ?></th>
                                                    <td><?php echo $bankMicro->quartime?></td>
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
                                <h3 class="box-title">MEDIO DE REACTIVACIÓN</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--MEDIO DE REACTIVACIÓN-->

                                                <tr>
                                                    <th scope="row"><?php echo __('Medio de cultivo de  reactivación') ?></th>
                                                    <td><?php echo $bankMicro->reactivacion==NULL?'':$bankMicro->reactivacion->name?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Duración de reactivación') ?></th>
                                                    <td><?php echo $bankMicro->reactime?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Temperatura de reactivación') ?></th>
                                                    <td><?php echo $bankMicro->reactemp?></td>
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
                                <h3 class="box-title">DATOS DEL REACTIVADOR</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--DATOS DEL REACTIVADOR-->
                                                <tr>
                                                    <th scope="row"><?php echo __('Duración de la reactivación') ?></th>
                                                    <td><?php echo  $bankMicro->reacdate==NULL?'': date('d-m-Y',strtotime($bankMicro->reacdate)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nombre del Responsable') ?></th>
                                                    <td><?php echo h($bankMicro->reacresponsible) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Motivo de la Reactivación') ?></th>
                                                    <td><?php echo h($bankMicro->reacrem) ?></td>
                                                </tr>
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

                     <?php if($permiso['edit'] && $validar) { ?>

                        <?php echo $this->Html->link('EDITAR', ['controller' => 'BankMicro', 'action' => 'edit', $bankMicro->id], ['class' => 'btn btn-primary'] ); ?>

                     <?php } ?>

                    <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('ELIMINAR', "#",
                                                ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$bankMicro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco ADN."])
                        ?>

                    <?php } ?>

                        <?php echo $this->Html->link('REGRESAR',
                                ['controller' => 'BankMicro', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'escape'=>false])
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
        $("#ajax_button").html(' <?php echo $this->Html->link('Confirmar',
                            ['controller' => 'BankMicro', 'action' => 'delete', $bankMicro->id],
                            ['class' => 'btn btn-success', 'escape'=>false] );
                ?>');
        $("#trigger").click();
    });
</script>

