

<?php $this->assign('title', $titulo); ?>



<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'OutputMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Salida');
        $this->Html->addCrumb($child, ['controller' => 'OutputMicro', 'action' => 'view','id'=>$id,'child'=>$child]);
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
                          <?php if($permiso['edit'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'OutputMicro', 'action' => 'edit','id'=> $outputMicro->bank_micro_id,'child'=> $outputMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>
                        <?php } ?>

                          <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $outputMicro->bank_micro_id,'child'=> $outputMicro->id])
                        ?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'outputMicro', 'action' => 'index','id'=> $outputMicro->bank_micro_id],
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
                                                <td><?php echo h($outputMicro->reqcode) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del Solicitante') ?></th>
                                                <td><?php echo h($outputMicro->reqname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Fecha Salida') ?></th>
                                                <td><?php echo  $outputMicro->exitdate==NULL?'': date('d-m-Y',strtotime($outputMicro->exitdate)) ?>
                                                 </td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><?= __('Número de Tubos') ?></th>
                                                <td><?php echo h($outputMicro->numtubexit) ?></td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->

                                            <tr>
                                                <th scope="row"><?= __('Motivo de Salida') ?></th>
                                                <td><?php echo h($outputMicro->object) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Descripción') ?></th>
                                                <td><?php echo h($outputMicro->remexit) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Estado de Salida') ?></th>
                                                <td><?php echo $outputMicro->estado==NULL? '' : $outputMicro->estado->name ?></td>
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
                          <?php if($permiso['edit'] && $validar ) { ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$outputMicro->bank_micro_id.'/salida/editar/'.$outputMicro->id, true) ?>"
                           class="btn btn-primary waves-effect m-l-5"> EDITAR
                        </a>
                        <?php } ?>

                          <?php if($permiso['delete'] && $validar) { ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",
                                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$outputMicro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar la Entrada de Material."])
                        ?>
                        <?php } ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$outputMicro->bank_micro_id.'/salida', true) ?>"
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
                                    ['controller' => 'outputMicro', 'action' => 'delete','id'=> $outputMicro->bank_micro_id,'child'=> $outputMicro->id],
                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>


