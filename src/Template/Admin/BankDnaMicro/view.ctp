
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

     <h1>Módulo <?php echo $titulo ?> - Detalle</h1>
          <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco ADN', ['controller' => 'BankDnaMicro', 'action' => 'index']);
        $this->Html->addCrumb($bankDna->id, ['controller' => 'BankDnaMicro', 'action' => 'edit','id'=>$bankDna->id]);
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

                        <?php if($permiso['edit'] && $validar) {?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'BankDnaMicro', 'action' => 'edit', $bankDna->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>
                        <?php } ?>

                        <?php if($permiso['delete'] && $validar){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$bankDna->id])
                        ?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'BankDnaMicro', 'action' => 'index'],
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
                                                    <td><?php echo h($bankDna->passport->accenumb) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Colección') ?></th>
                                                    <td><?php echo h($bankDna->passport->specie->collection->colname) ?></td>
                                                </tr>
                                                 <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre Científico') ?></th>
                                                    <td><?php echo h($bankDna->passport->specie->genus.' '.$bankDna->passport->specie->species) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Especie - Nombre Común') ?></th>
                                                    <td><?php echo h($bankDna->passport->specie->cropname) ?></td>
                                                </tr>

                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                            <!-- DATOS PRINCIPALES -->
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de Lote') ?></th>
                                                    <td><?php echo h($bankDna->lotnumb) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Fecha Adquisición') ?></th>
                                                    <td><?php echo  $bankDna->acqdate==NULL?'': date('d-m-Y',strtotime($bankDna->acqdate)) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Disponibilidad del lote de le Accesión') ?></th>
                                                    <td><?php echo $bankDna->disponibilidad==NULL?'':$bankDna->disponibilidad->name?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 1-->
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

                            <?php echo $this->Html->link('EDITAR', ['controller' => 'BankDnaMicro', 'action' => 'edit', $bankDna->id], ['class' => 'btn btn-primary'] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete'] && $validar) { ?>

                            <?php echo $this->Html->link('ELIMINAR', "#",
                                                    ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$bankDna->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco ADN."])
                            ?>

                        <?php } ?>

                        <?php echo $this->Html->link('REGRESAR',
                                ['controller' => 'BankDnaMicro', 'action' => 'index'],
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
                            ['controller' => 'BankDnaMicro', 'action' => 'delete', $bankDna->id],
                            ['class' => 'btn btn-success', 'escape'=>false] );
                ?>');
        $("#trigger").click();
    });
</script>

