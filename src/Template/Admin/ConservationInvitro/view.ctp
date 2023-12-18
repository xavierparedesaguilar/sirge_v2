
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

       <?php
         $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'ConservationInvitro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Conservación');
        $this->Html->addCrumb($child, ['controller' => 'ConservationInvitro', 'action' => 'view','id'=>$id,'child'=>$child]);
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
                                    ['controller' => 'ConservationInvitro', 'action' => 'edit','id'=> $conservationInvitro->bank_invitro_id,'child'=> $conservationInvitro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>

                    <?php  } ?>

                    <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $conservationInvitro->bank_invitro_id,'child'=> $conservationInvitro->id])
                        ?>

                    <?php  } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'ConservationInvitro', 'action' => 'index','id'=> $conservationInvitro->bank_invitro_id],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
                <!-- Inicio Campos de la tabla Pasaporte -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!--DATOS PRINCIPALES-->
                                            <tr>
                                                <th scope="row"><?php echo __('Nombre del Responsable') ?></th>
                                                <td><?php echo h($conservationInvitro->consresponsible) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo __('Motivo de Conservación') ?></th>
                                                <td><?php echo h($conservationInvitro->consrem) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->
                                             <tr>
                                                <th scope="row"><?php echo __('Fecha Conservación') ?></th>
                                                <td><?php echo  $conservationInvitro->constime==NULL ?'': date('d-m-Y', strtotime($conservationInvitro->constime)) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo __('Periodo de Conservación') ?></th>
                                                <td><?php echo h($conservationInvitro->stoper) ?></td>
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

                    <?php if($permiso['edit'] && $validar) { ?>

                         <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/'.$conservationInvitro->bank_invitro_id.'/conservacion/editar/'.$conservationInvitro->id, true) ?>"
                           class="btn btn-primary waves-effect m-l-5"> EDITAR
                        </a>

                    <?php  } ?>

                    <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('ELIMINAR', "#",
                                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$conservationInvitro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar la Conservación del Material."])
                        ?>

                    <?php  } ?>

                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/'.$conservationInvitro->bank_invitro_id.'/conservacion', true) ?>"
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
                                    ['controller' => 'ConservationInvitro', 'action' => 'delete','id'=> $conservationInvitro->bank_invitro_id,'child'=> $conservationInvitro->id],
                                    ['class' => 'btn btn-success btnEliminar', 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>
