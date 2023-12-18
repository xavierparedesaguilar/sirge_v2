
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('FisicoQuímica');

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
<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['add']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'caractPhysicalChemistry','action'=>'add'],['class'=>'btn btn-success', 'data-toggle'=>"tooltip" , 'title'=>"Nueva Caracterización FisicoQuimica", 'escape' => false]) ?>
                        <?php } ?>

                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $titulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                        <?php } ?>

                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th style="min-width: 40px;">#</th>
                                    <th style="min-width: 150px">N° Experimento</th>
                                    <th style="min-width: 150px">Colección</th>
                                    <th style="min-width: 190px">Nombre del Proyecto</th>
                                    <th style="min-width: 180px">Código del Proyecto</th>
                                    <th style="min-width: 210px">Nombre del Responsable</th>
                                  <!--   <th style="min-width: 150px">Anotaciones</th> -->
                                    <th style="min-width: 150px">Opciones</th>
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
                                    <!-- <th></th> -->
                                    <td></td>
                                    <!-- <th></th>
                                    <th></th>
                                    <th></th> -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1;
																		 
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

                                <?php foreach ($caractPhysicalChemistry as $caractPhysicalChemistry): ?>
								<?php 
									$conn2 = \Cake\Datasource\ConnectionManager::get('default');
									$sql2="select p.station_current_id from passport p inner join collection c on p.resource_id=c.resource_id inner join caract_physical_chemistry ca on c.id=ca.colname where ca.colname=".$caractPhysicalChemistry->coleccioncara->colname;
									$stmtConsulta = $conn->prepare($sql2);
									$stmtConsulta->execute();	
									
									$station_current_id=0;	
									if( $stmtConsulta->rowCount() > 0){
										$rowAcceso = $stmtConsulta->fetch(); 
										$station_current_id = $rowAcceso[0];	
									}
								?>
								<?php if(($permiso['station_id']==$station_current_id ||$per == 1) || $permiso['role_id']==1){ ?>
                                <tr>
                                    <td><?php echo $item ?></td>
                                    <td><?php echo $caractPhysicalChemistry->expnumb ?></td>
                                    <td><?php echo $caractPhysicalChemistry->coleccioncara==NULL?'': $caractPhysicalChemistry->coleccioncara->colname; ?></td>
                                    <!-- <td><?php #echo $caractPhysicalChemistry->samplelist ?></td> -->
                                    <td><?php echo $caractPhysicalChemistry->project ?></td>
                                    <td><?php echo $caractPhysicalChemistry->projcode ?></td>
                                    <!-- <td><?php #echo $caractPhysicalChemistry->datamatrix ?></td> -->
                                    <!-- <td><?php #echo $caractPhysicalChemistry->traitlist ?></td> -->
                                    <!-- <td><?php //echo $caractPhysicalChemistry->respname ?></td> -->
                                    <td><?php echo $caractPhysicalChemistry->remarks ?></td>
                                    <td class="text-center">

                                    <?php if($permiso['view']){ ?>
                                       <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'caractPhysicalChemistry', 'action' => 'view', $caractPhysicalChemistry->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de la Caracterización FisicoQuimica."])
                                        ?>

                                    <?php } ?>

                                    <?php if($permiso['edit']){ ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'caractPhysicalChemistry', 'action' => 'edit', 'id' => $caractPhysicalChemistry->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Caracterización FisicoQuimica."])
                                        ?>

                                    <?php } ?>

                                    <?php if($permiso['delete']){ ?>
                                        <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar el Caracterización FisicoQuimica.', 'data-id' => $caractPhysicalChemistry->id])
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
    });

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
