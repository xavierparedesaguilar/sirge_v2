
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('FisicoQuímica', ['controller' => 'CaractPhysicalChemistry', 'action' => 'index']);
        $this->Html->addCrumb($caractPhysicalChemistry->expnumb, ['controller' => 'CaractPhysicalChemistry', 'action' => 'view', 'id' => $caractPhysicalChemistry->id]);
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

                        <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>', ['controller' => 'CaractPhysicalChemistry', 'action' => 'edit', $caractPhysicalChemistry->id], ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>
                        <?php } ?>

                        <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar", 'escape' => false, "data-id"=>$caractPhysicalChemistry->id])?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'CaractPhysicalChemistry', 'action'=>'index'],['class'=>'btn btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false]) ?>
                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">

                                            <!--DATOS PRINCIPALES-->
                                           <tr>
                                                <th scope="row"><?= __('Nro. Experimento') ?></th>
                                                <td><?= h($caractPhysicalChemistry->expnumb) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Accesiones') ?></th>
                                                <td><?php echo (!empty($caractPhysicalChemistry->samplelist))? $this->Html->link('Descargar archivo',['controller' => 'CaractPhysicalChemistry', 'action' => 'exportarsamplelist', 'id' => $caractPhysicalChemistry->id]) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del Proyecto') ?></th>
                                                <td><?= h($caractPhysicalChemistry->project) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Código del Proyecto') ?></th>
                                                <td><?= h($caractPhysicalChemistry->projcode) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Matriz de Datos') ?></th>
                                                <td><?php echo (!empty($caractPhysicalChemistry->datamatrix))? $this->Html->link('Descargar archivo',['controller' => 'CaractPhysicalChemistry', 'action' => 'exportardatamatrix', 'id' => $caractPhysicalChemistry->id]) : '' ?></td>
                                            </tr>

                                         </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->
                                            <tr>
                                                <th scope="row"><?= __('Variables Evaluadas') ?></th>
                                                <td><?php echo (!empty($caractPhysicalChemistry->traitlist))? $this->Html->link('Descargar archivo',['controller' => 'CaractPhysicalChemistry', 'action' => 'exportartraitlist', 'id' => $caractPhysicalChemistry->id]) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del Responsable') ?></th>
                                                <td><?= h($caractPhysicalChemistry->respname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Anotaciones') ?></th>
                                                <td><?= h($caractPhysicalChemistry->remarks) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Colección') ?></th>
                                                <td><?php echo $caractPhysicalChemistry->coleccioncara==NULL?'': $caractPhysicalChemistry->coleccioncara->colname; ?></td>
                                            </tr>
                                            <!--FIN DEL MODULO 1-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                        <?php if($permiso['edit']){ ?>

                        <?php echo $this->Html->link('EDITAR', ['controller' => 'CaractPhysicalChemistry', 'action' => 'edit', $caractPhysicalChemistry->id], ['class' => 'btn btn-primary'] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete']){ ?>

                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$caractPhysicalChemistry->id])?>

                        <?php } ?>

                        <?php echo $this->Html->link('REGRESAR', ['controller'=>'CaractPhysicalChemistry', 'action'=>'index'],['class'=>'btn btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'CaractPhysicalChemistry', 'action' => 'delete', 'id' => $caractPhysicalChemistry->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>