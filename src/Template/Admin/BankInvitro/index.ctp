<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?></h1>

  <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);

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
<!-- Page Header -->

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo_lista ?></strong></h3>
                    <div class="pull-right box-tools">
                        <?php if($permiso['add']){ ?>

                            <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                        ['controller' => 'BankInvitro', 'action' => 'add'],
                                        ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Banco Invitro", 'escape'=>false] )
                            ?>

                        <?php } ?>


                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $titulo_lista ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                        <?php } ?>

                    </div>
                </div>
                 <div class="box-body">
                    <div class="col-sm-12">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                      <th style="min-width: 40px;">#</th>
                                      <th style="min-width: 150px;">CÓDIGO PER</th>
									  <th style="min-width: 150px;">NOMBRE DE LA ACCESIÓN</th>
                                      <th style="min-width: 160px;">OTRO CÓDIGO DE ACCESIÓN</th>
                                      <th style="min-width: 150px;">NUM. DE LOTE</th>
                                      <th style="min-width: 170px;">COLECCIÓN</th>
                                      <th style="min-width: 165px;">NOMBRE CIENTÍFICO</th>
                                      <th style="min-width: 165px;">NOMBRE COMÚN</th>
                                      <th style="min-width: 185px;">FECHA DE INTRODUCCIÓN</th>
                                      <th style="min-width: 140px;">DISPONIBILIDAD</th>
                                      <th style="min-width: 200px;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                                <tr class="text-uppercase">
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
													<th></th>
													<th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <td></td>

                                                </tr>
                            </tfoot>
                            <tbody>
							 <?php 
							 $item = 1;  
								$per = 0;
								$conn = \Cake\Datasource\ConnectionManager::get('default');
								  
								if( $current_user['role_id'] == 1 ){
									$per = 1;
								}else {
									$sqlAcceso ="SELECT estado FROM permiso_estacion AS p WHERE p.idusuario =".$current_user['id'];
									$stmtAcceso = $conn->prepare($sqlAcceso);
									$stmtAcceso->execute();
								
									if( $stmtAcceso->rowCount() > 0){
										$rowAcceso = $stmtAcceso->fetch();
										 
										if($rowAcceso[0] == 1){
											$per = 1;
										}
									}
								}	
							?>
					  
                                <?php foreach ($bankInvitro as $bankInvitro):?>
								<?php if(($permiso['station_id']==$bankInvitro->passport->station_current_id || $per == 1) || $permiso['role_id']==1){ ?>	 
                                <tr>

                                    <td><?php echo $this->Number->format($item) ?></td>
                                    <td><?php echo h($bankInvitro->passport->accenumb) ?></td>
									<td><?php echo h($bankInvitro->passport->accname) ?></td>
                                    <td><?php echo h($bankInvitro->passport->othenumb) ?></td>
                                    <td><?php echo h($bankInvitro->lotnumb) ?></td>
                                    <td><?php echo $bankInvitro->passport->specie->collection->colname?></td>
                                    <td><?php echo $bankInvitro->passport->specie->genus.' '.$bankInvitro->passport->specie->species  ?></td>
                                    <td><?php echo $bankInvitro->passport->specie->cropname?></td>
                                    <td><?php echo ($bankInvitro->acqdate == NULL || $bankInvitro->acqdate=='')? '' : date("d-m-Y", strtotime($bankInvitro->acqdate))  ?></td>
                                    <td><?php echo ($bankInvitro->disponibilidad == NULL || $bankInvitro->disponibilidad->name=='')? '' :$bankInvitro->disponibilidad->name ?></td>

                                    <td>
                                    <?php

                                    /*$validar=$permiso['role_id']==1?true:$permiso['station_id']==$bankInvitro->passport->station_current_id;*/


                                     ?>

                                        <?php echo $this->Html->link('<i class="fa  fa-share-alt"></i>',
                                                                                ['controller' => 'propagationInvitro', 'action' => 'index', $bankInvitro->id],
                                                                                ['class' => 'btn btn-default btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Propagación."])
                                             ?>

                                        <?php echo $this->Html->link('<i class="fa  fa-university"></i>',
                                                                            ['controller' => 'conservationInvitro', 'action' => 'index','id'=> $bankInvitro->id],
                                                                            ['class' => 'btn btn-default btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Conservación."])
                                                                    ?>

                                        <?php echo $this->Html->link('<i class="fa  fa-sign-in"></i>',
                                                                            ['controller' => 'inputInvitro', 'action' => 'index', $bankInvitro->id],
                                                                            ['class' => 'btn btn-success btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Entrada al Banco Invitro."])
                                                                    ?>


                                         <?php echo $this->Html->link('<i class="fa  fa-sign-out"></i>',
                                                                            ['controller' => 'outputInvitro', 'action' => 'index', $bankInvitro->id],
                                                                            ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Salida del Banco Invitro."])
                                                                    ?>


                                        <?php  if($permiso['view']) {?>

                                                <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                                                    ['controller' => 'BankInvitro', 'action' => 'view', $bankInvitro->id],
                                                                                    ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Banco Invitro."])
                                                ?>

                                        <?php  } ?>

                                        <?php  if($permiso['edit'] /*&& $validar*/) {?>


                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                                                ['controller' => 'BankInvitro', 'action' => 'edit', $bankInvitro->id],
                                                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Banco Invitro."])
                                            ?>

                                        <?php  } ?>

                                        <?php  if($permiso['delete'] /*&& $validar*/) {?>

                                            <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$bankInvitro->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Invitro."])
                                            ?>

                                        <?php } ?>

                                    </td>
                                </tr>
								<?php } ?>
                                     <?php $item++; ?>
                                     <?php endforeach; ?>
                            </tbody>
                        </table>
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
                <button type="button" class="btn btn-default btn-flat pull-left " data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de exportar archivo excel  -->
<div class="modal fade" id="exportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla']]); ?>
            <div class="modal-body">
                <p id="mensaje"></p>
                <?php echo $this->Form->control('filename', ['type' => 'hidden', 'id' => 'filename']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnReportesTabla">Aceptar</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        tablaListadoDataTable();
		document.getElementById("tablaListado").parentElement.classList.add("table-responsive");
    });

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat'>Confirmar</a>");
        $("#trigger").click();
    });
</script>