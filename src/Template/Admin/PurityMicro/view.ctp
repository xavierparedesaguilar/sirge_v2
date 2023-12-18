

<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

          <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'PurityMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Prueba de Pureza');
        $this->Html->addCrumb($child, ['controller' => 'PurityMicro', 'action' => 'view','id'=>$id,'child'=>$child]);
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
                                    ['controller' => 'PurityMicro', 'action' => 'edit','id'=> $purityMicro->bank_micro_id,'child'=> $purityMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>
                        <?php } ?>
                          <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $purityMicro->bank_micro_id,'child'=> $purityMicro->id])
                        ?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'PurityMicro', 'action' => 'index','id'=> $purityMicro->bank_micro_id],
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
                                                <th scope="row"><?= __('Fecha Prueba de Pureza') ?></th>
                                                <td><?php echo  $purityMicro->datepurz==NULL?'': date('d-m-Y',strtotime($purityMicro->datepurz)) ?>
                                                 </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Medio de Aislamiento 1') ?></th>
                                                <td><?php  echo $purityMicro->medio==NULL?'': $purityMicro->medio->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Duración del Microorganismo Medio 1') ?></th>
                                                <td><?php echo h($purityMicro->reactime_1) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Temperatura del Medio 1') ?></th>
                                                <td><?php echo h($purityMicro->reactemp_1) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Medio de Aislamiento 2') ?></th>
                                                <td><?php  echo $purityMicro->medio2==NULL?'': $purityMicro->medio2->name; ?></td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->
                                            <tr>
                                                <th scope="row"><?= __('Duración del Microorganismo Medio 2') ?></th>
                                                <td><?php echo $purityMicro->reactime_2?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Temperatura del Medio 2') ?></th>
                                                <td><?php echo $purityMicro->reactemp_2?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Tinción Gram') ?></th>
                                                <td><?php echo $purityMicro->tincion==NULL?'': $purityMicro->tincion->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Tinción con azul de Lactofenol') ?></th>
                                                <td><?php echo $purityMicro->tincionazul==NULL?'': $purityMicro->tincionazul->name; ?></td>
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
                          <?php if($permiso['edit'] && $validar) { ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$purityMicro->bank_micro_id.'/pureza/editar/'.$purityMicro->id, true) ?>"
                           class="btn btn-primary waves-effect m-l-5"> EDITAR
                        </a>
                        <?php } ?>

                          <?php if($permiso['delete'] && $validar) { ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",
                                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$purityMicro->id])
                        ?>
                        <?php } ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$purityMicro->bank_micro_id.'/pureza', true) ?>"
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
                                    ['controller' => 'PurityMicro', 'action' => 'delete','id'=> $purityMicro->bank_micro_id,'child'=> $purityMicro->id],
                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>


