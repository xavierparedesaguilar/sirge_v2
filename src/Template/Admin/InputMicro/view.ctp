
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'InputMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Entrada');
        $this->Html->addCrumb($child, ['controller' => 'InputMicro', 'action' => 'view','id'=>$id,'child'=>$child]);
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

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">
                          <?php if($permiso['edit'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'InputMicro', 'action' => 'edit','id'=> $inputMicro->bank_micro_id,'child'=> $inputMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>
                        <?php } ?>

                          <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $inputMicro->bank_micro_id,'child'=> $inputMicro->id])
                        ?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'InputMicro', 'action' => 'index','id'=> $inputMicro->bank_micro_id],
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
                                            <tr>
                                                <th scope="row"><?php echo ('Código del Donante') ?></th>
                                                <td><?php echo h($inputMicro->donorcore) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Nombre del Donante') ?></th>
                                                <td><?php echo h($inputMicro->donorname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Código de Accesión del Donante') ?></th>
                                                <td><?php echo h($inputMicro->donornumb) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Fecha Entrada') ?></th>
                                                <td><?php echo  $inputMicro->enterdate==NULL?'': date('d-m-Y',strtotime($inputMicro->enterdate)) ?>
                                            </td>
                                            <tr>
                                                <th scope="row"><?php echo ('Número de Tubos') ?></th>
                                                <td><?php echo $this->Number->format($inputMicro->numtubent) ?></td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->
                                            <tr>
                                                <th scope="row"><?php echo ('Descripción') ?></th>
                                                <td><?php echo h($inputMicro->rement) ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><?php echo ('Tipo Depósito') ?></th>
                                                <td><?php echo ($inputMicro->deposito==null?'':$inputMicro->deposito->name )  ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Estado de Muestra') ?></th>
                                                <td><?php echo ($inputMicro->estado==null?'':$inputMicro->estado->name )  ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo ('Condición Biológica') ?></th>
                                                <td><?php echo isset($optionList_obj->name)?$optionList_obj->name:''?></td>
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
                           <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$inputMicro->bank_micro_id.'/entrada/editar/'.$inputMicro->id, true) ?>"
                                       class="btn btn-primary waves-effect m-l-5"> EDITAR
                            </a>
                            <?php } ?>

                              <?php if($permiso['delete'] && $validar) { ?>
                                    <?php echo $this->Html->link('ELIMINAR', "#",
                                                ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$inputMicro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar la Entrada de Material."])
                                     ?>
                                     <?php } ?>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$inputMicro->bank_micro_id.'/entrada', true) ?>"
                                       class="btn btn-default waves-effect m-l-5"> REGRESAR
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
                                    ['controller' => 'InputMicro', 'action' => 'delete','id'=> $inputMicro->bank_micro_id,'child'=> $inputMicro->id],
                                    ['class' => 'btn btn-success', 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>