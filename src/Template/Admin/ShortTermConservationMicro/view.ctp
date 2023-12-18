
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

   <h1>Módulo <?php echo $titulo ?> - Detalle</h1>

           <?php

                $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
                $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
                $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
                $this->Html->addCrumb($id, ['controller' => 'shortTermConservationMicro', 'action' => 'index','id'=>$id]);
                $this->Html->addCrumb('Corto Plazo');
                $this->Html->addCrumb($child, ['controller' => 'shortTermConservationMicro', 'action' => 'view','id'=>$id,'child'=>$child]);
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

                          <?php if($permiso['edit'] && $validar ) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'ShortTermConservationMicro', 'action' => 'edit','id'=>
                                    $shortTermConservationMicro->bank_micro_id,'child'=> $shortTermConservationMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                        ?>
                        <?php } ?>

                          <?php if($permiso['delete'] && $validar) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, 'id'=> $shortTermConservationMicro->bank_micro_id,'child'=> $shortTermConservationMicro->id])
                        ?>
                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'ShortTermConservationMicro', 'action' => 'index','id'=> $shortTermConservationMicro->bank_micro_id],
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
                                            <!--DATOS PRINCIPALES-->
                                            <tr>
                                                <th scope="row"><?= __('Fecha de Conservación') ?></th>
                                                <td><?php echo  $shortTermConservationMicro->constime==NULL?'': date('d-m-Y',strtotime($shortTermConservationMicro->constime)) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del Responsable') ?></th>
                                                <td><?= h($shortTermConservationMicro->consresponsible) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Motivo de la Conservación') ?></th>
                                                <td><?= h($shortTermConservationMicro->consrem) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Medio de Conservación') ?></th>
                                                <td><?php echo $shortTermConservationMicro->medioconser==NULL?'' : $shortTermConservationMicro->medioconser->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Temperatura') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortermtemp) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Tiempo de Conservación') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortermtime) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Material de Almacenamiento') ?></th>
                                                <td><?php echo $shortTermConservationMicro->materialAlm==NULL?'': $shortTermConservationMicro->materialAlm->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Fecha Renovación') ?></th>
                                                <td><?php echo  $shortTermConservationMicro->renewal_date==NULL?'': date('d-m-Y',strtotime($shortTermConservationMicro->renewal_date)) ?>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?= __('Número de Material') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortmatnumb) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Stock Mínimo') ?></th>
                                                <td><?= $this->Number->format($shortTermConservationMicro->shortminstock) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Código de Almacenamiento') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortstornumb) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Lugar de Almacenamiento') ?></th>
                                                <td><?php echo $shortTermConservationMicro->lugaral==NULL?'': $shortTermConservationMicro->lugaral->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nivel de Estantería') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortlevsh) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Código de la Gradilla') ?></th>
                                                <td><?= h($shortTermConservationMicro->criorack) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Posición dentro de la Gradilla') ?></th>
                                                <td><?= h($shortTermConservationMicro->shortrackpos) ?></td>
                                            </tr>
                                            <!--FIN MODULO 1-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="box-footer">
                        <div class="col-sm-12 text-center">

                          <?php if($permiso['edit'] && $validar) { ?>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$shortTermConservationMicro->bank_micro_id.'/cortoPlazo/editar/'.$shortTermConservationMicro->id, true) ?>"
                                       class="btn btn-primary waves-effect m-l-5"> EDITAR
                            </a>
                         <?php } ?>

                           <?php if($permiso['delete'] && $validar) { ?>
                                    <?php echo $this->Html->link('ELIMINAR', "#",
                                                ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$shortTermConservationMicro->id])
                                     ?>
                            <?php } ?>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo/'.$shortTermConservationMicro->bank_micro_id.'/cortoPlazo', true) ?>"
                                       class="btn btn-default waves-effect m-l-5"> REGRESAR
                            </a>
                        </div>
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
                                    ['controller' => 'ShortTermConservationMicro', 'action' => 'delete','id'=> $shortTermConservationMicro->bank_micro_id,'child'=> $shortTermConservationMicro->id],
                                    ['class' => 'btn btn-success', 'escape'=>false] )
                        ?>');
        $("#trigger").click();
    });
</script>