<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo 'Zoogenético'. " - " . $modulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Datos Pasaporte');

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
<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $modulo ?></strong></h3>
                    <div class="pull-right box-tools">
					 <?php 
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
					 

                        <?php if($permiso['import']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-cloud-upload" ></i>',
                                        ['controller' => 'PassportZoo', 'action' => 'import'],
                                        ['class' => 'btn btn-warning', 'data-toggle'=> "tooltip",  'title'=> "Importar archivo", 'escape'=>false] )
                            ?>
                        <?php } ?>

                        <?php if($permiso['add']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                        ['controller' => 'PassportZoo', 'action' => 'add'],
                                        ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Pasaporte", 'escape'=>false] )
                            ?>
                        <?php } ?>

                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $modulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                     <th style="min-width: 150px;">COD. ACCESIÓN</th>
                                     <th style="min-width: 100px;">COD. FAO</th>
                                     <th style="min-width: 160px;">OTRO COD. ACCESIÓN</th>
                                     <th style="min-width: 190px;">NOMBRE ACCESIÓN</th>
                                     <th style="min-width: 160px;">SUBTIPO RECURSO</th>
                                     <th style="min-width: 150px;">CÓDIGO COLECTA</th>
                                     <th style="min-width: 150px;">COLECCIÓN</th>
                                     <th style="min-width: 160px;">NOMBRE CIENTÍFICO</th>
                                     <th style="min-width: 190px;">NOMB. COMUN ESPECIE</th>
                                     <th style="min-width: 160px;">AUTORÍA ESPECIE</th>
                                     <th style="min-width: 160px;">SUBTAXONES</th>
                                     <th style="min-width: 180px;">AUTORÍA SUBTAXONES</th>
                                     <th style="min-width: 150px;">TIPO DE RAZA</th>
                                     <th style="min-width: 170px;">TIPO CONSERVACIÓN</th>
                                     <th style="min-width: 160px;">FECHA INGRESO</th>
                                     <th style="min-width: 160px;">EST. EXPERIMENTAL</th>
                                     <th style="min-width: 140px;">EST. EXP. PROC.</th>
                                     <th style="min-width: 140px;">DISPONIBILIDAD</th>
                                     <th style="min-width: 100px;">OPCIONES</th>
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
                                <?php $item = 1;
								?>
                                <?php foreach ($passportZoo as $passportZoo): ?>
								<?php
								if(($permiso['station_id']==$passportZoo->passport->station_current_id || $per == 1) || $permiso['role_id']==1){ ?>	 
                                <tr>
                                    <td><?php echo $item; ?></td>
                                    <td><?php echo h($passportZoo->passport->accenumb) ?></td>
                                    <td><?php echo h($passportZoo->passport->instcode) ?></td>
                                    <td><?php echo h($passportZoo->passport->othenumb) ?></td>
                                    <td><?php echo h($passportZoo->passport->accname) ?></td>
                                    <td><?php echo ($passportZoo->subtiporecurso == NULL) ? '' : $passportZoo->subtiporecurso->name; ?></td>
                                    <td><?php echo ($passportZoo->collnumb) ?></td>
                                    <td><?php echo ($passportZoo->coleccion == NULL ) ? '' : $passportZoo->coleccion->colname ?></td>
                                    <td><?php echo $passportZoo->genus.' '.$passportZoo->species; ?></td>
                                    <td><?php echo $passportZoo->husbname; ?></td>
                                    <td><?php echo h($passportZoo->spauthor) ?></td>
                                    <td><?php echo h($passportZoo->subtaxa) ?></td>
                                    <td><?php echo h($passportZoo->subtauthor) ?></td>
                                    <td><?php echo h($passportZoo->racetype) ?></td>
                                    <td><?php echo ($passportZoo->tipoconservacion == NULL)? '' : $passportZoo->tipoconservacion->name; ?></td>
                                    <td><?php echo ($passportZoo->acqdate == NULL) ? '' : date('d-m-Y', strtotime($passportZoo->acqdate)); ?></td>
                                    <td><?php echo ($passportZoo->passport->estacionprocedencia == NULL)? '' : $passportZoo->passport->estacionprocedencia->eea; ?></td>
                                    <td><?php echo ($passportZoo->passport->estacionorigen == NULL)? '' : $passportZoo->passport->estacionorigen->eea; ?></td>
                                    <td><?php echo ($passportZoo->disponibleaccesion == NULL) ? '' : $passportZoo->disponibleaccesion->name; ?></td>
                                    <td style="min-width: 120px;" class="text-center">


                                    <?php


                                     /*$validar=$permiso['role_id']==1?true:$permiso['station_id']==$passportZoo->passport->station_current_id;*/

                                     ?>

                                    <?php if($permiso['view']) { ?>

                                        <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                ['controller' => 'PassportZoo', 'action' => 'view', $passportZoo->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información del Pasaporte."])
                                        ?>
                                    <?php } ?>

                                    <?php if($permiso['edit'] /*&& $validar*/) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'PassportZoo', 'action' => 'edit', $passportZoo->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Pasaporte."])
                                        ?>
                                    <?php } ?>

                                    <?php if($permiso['delete'] /*&& $validar*/) { ?>

                                        <?php
                                            echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$passportZoo->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Pasaporte."])
                                        ?>
                                    <?php } ?>

                                    </td>
                                </tr>
								<?php } ?>
                                <?php $item ++; ?>
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
