

<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'OutputField', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Salida');
        $this->Html->addCrumb($child, ['controller' => 'OutputField', 'action' => 'view','id'=>$id,'child'=>$child]);
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



<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'OutputField', 'action' => 'edit','id'=> $outputField->bank_field_id,'child'=> $outputField->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>

                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $outputField->bank_field_id,'child'=> $outputField->id])
                        ?>

                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'OutputField', 'action' => 'index','id'=> $outputField->bank_field_id],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

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
                                            <tr>
                                                <th scope="row"><?= __('Código del Solicitante') ?></th>
                                                <td><?php echo h($outputField->reqcode) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del solicitante') ?></th>
                                                <td><?php echo h($outputField->reqname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Fecha Salida') ?></th>
                                                <td><?php echo  $outputField->exitdate==NULL?'': date('d-m-Y',strtotime($outputField->exitdate)) ?>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Cantidad de muestra') ?></th>
                                                <td><?php echo h($outputField->samplamount) ?></td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->

                                            <tr>
                                                <th scope="row"><?= __('Destino de la muestra') ?></th>
                                                <td><?php echo h($outputField->destiny) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Motivo de salida de material') ?></th>
                                                <td><?php echo h($outputField->object) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Descripción') ?></th>
                                                <td><?php echo h($outputField->remexit) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Investigador que recibe la Muestra') ?></th>
                                                <td><?php echo h($outputField->sampres) ?></td>
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
                    <!-- imagen flecha volver: zmdi zmdi-long-arrow-return -->

                    <?php if($permiso['edit']) { ?>

                    <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-campo/'.$outputField->bank_field_id.'/salida/editar/'.$outputField->id, true) ?>"
                       class="btn btn-primary waves-effect m-l-5"> EDITAR
                    </a>

                    <?php } ?>

                    <?php if($permiso['delete']) { ?>

                    <?php echo $this->Html->link('ELIMINAR', "#",
                                    ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$outputField->id, 'data-toggle' => "tooltip", 'title' => "Eliminar la Salida de Material."])
                    ?>

                    <?php } ?>
                    <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-campo/'.$outputField->bank_field_id.'/salida', true) ?>"
                               class="btn btn-default waves-effect m-l-5"> REGRESAR
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">MENSAJE</h4>
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
                                    ['controller' => 'OutputField', 'action' => 'delete','id'=> $outputField->bank_field_id,'child'=> $outputField->id],
                                    ['class' => 'btn btn-success', 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>


