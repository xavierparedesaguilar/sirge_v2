
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Caracterización','/admin/zoogenetico/caracterizacion');
        $this->Html->addCrumb('Genotípica', [ 'controller' => 'CaractGenotypicZoo', 'action' => 'index']);
        $this->Html->addCrumb($caractGenotypic->expnumb, [ 'controller' => 'CaractGenotypicZoo', 'action' => 'view', 'id' => $caractGenotypic->id ]);
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

                        <?php if($permiso['edit']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-edit" ></i>', ['controller' => 'CaractGenotypicZoo',
                                                                                         'action' => 'edit', $caractGenotypic->id],
                                                                                        ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",
                                                                                          'title'=> "Editar", 'escape' => false] );
                            ?>
                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn',
                                                                                          'data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                                                                          'escape' => false, "data-id"=>$caractGenotypic->id])
                        ?>
                        <?php } ?>



                            <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'CaractGenotypicZoo',
                                                                                               'action'=>'index'],['class'=>'btn btn-default',
                                                                                               'data-toggle'=> "tooltip",  'title'=> "Regresar",
                                                                                               'escape'=>false])
                            ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th scope="row"><?= __('N° Experimento') ?></th>
                                        <td><?= h($caractGenotypic->expnumb) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Lista Accesiones') ?></th>
                                        <td><?php echo (!empty($caractGenotypic->accenumb))? $this->Html->link('Descargar archivo',['controller' => 'CaractGenotypicZoo', 'action' => 'exportaraccenumb', 'id' => $caractGenotypic->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Nombre Enzima de Restricción') ?></th>
                                        <td><?= h($caractGenotypic->restenzymname) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Nombre del Proyecto') ?></th>
                                        <td><?= h($caractGenotypic->project) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Código del Proyecto') ?></th>
                                        <td><?= h($caractGenotypic->projcode) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Número de Ciclos') ?></th>
                                        <td><?= h($caractGenotypic->ciclonumb) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Tecnología de Secuenciamiento') ?></th>
                                        <td><?= h($caractGenotypic->seqtech) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('N° Accessión GENEBANK') ?></th>
                                        <td><?= h($caractGenotypic->accnumb) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Otro Nro. Accesión') ?></th>
                                        <td><?= h($caractGenotypic->othername) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Tamaño de Secuencia') ?></th>
                                        <td><?= h($caractGenotypic->seqsize) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Matriz de Datos') ?></th>
                                        <td><?php echo (!empty($caractGenotypic->datamatrix))? $this->Html->link('Descargar archivo',['controller' => 'CaractGenotypicZoo', 'action' => 'exportardatamatrix', 'id' => $caractGenotypic->id]) : '' ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Método de Determinación') ?></th>
                                        <td><?= h($caractGenotypic->fragsizemeth) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th scope="row"><?= __('N° de Repeticiones') ?></th>
                                        <td><?= h($caractGenotypic->repnumb) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Nombre de Responsable') ?></th>
                                        <td><?= h($caractGenotypic->respname) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Descripción de Marcadores') ?></th>
                                        <td><?= h($caractGenotypic->markerdescrip) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Plataforma de Corrida') ?></th>
                                        <td><?= h($caractGenotypic->platform) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Anotaciones') ?></th>
                                        <td><?= h($caractGenotypic->remarks) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Colección') ?></th>
                                        <td><?php echo $caractGenotypic->colecciongeno==NULL?'':$caractGenotypic->colecciongeno->colname; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Marcador Molecular') ?></th>
                                        <td><?php echo $caractGenotypic->marcadormol==NULL?'': $caractGenotypic->marcadormol->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Uso Enzima de Restricción') ?></th>
                                        <td><?php echo $caractGenotypic->usoenzima->name ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Nro. de Adaptadores') ?></th>
                                        <td><?= $this->Number->format($caractGenotypic->adaptrnum) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Nro. de Iniciadores') ?></th>
                                        <td><?= $this->Number->format($caractGenotypic->primernum) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Localización') ?></th>
                                        <td><?php echo $caractGenotypic->localizacion==NULL?'': $caractGenotypic->localizacion->name;?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php if($permiso['edit']) { ?>

                            <?php echo $this->Html->link('EDITAR', ['controller' => 'CaractGenotypicZoo',
                                                                    'action' => 'edit', $caractGenotypic->id],
                                                                   ['class' => 'btn btn-primary'] );
                            ?>
                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                            <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false,
                                                                          "data-id"=>$caractGenotypic->id])
                            ?>
                        <?php } ?>



                            <?php echo $this->Html->link('REGRESAR', ['controller'=>'CaractGenotypicZoo', 'action'=>'index'],
                                                                     ['class'=>'btn btn-default'])
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'CaractGenotypicZoo', 'action' => 'delete', 'id' => $caractGenotypic->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>