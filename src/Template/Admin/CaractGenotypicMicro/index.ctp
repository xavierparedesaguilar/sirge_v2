
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Genotípica');

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

                        <?php if($permiso['add']){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'CaractGenotypicMicro','action'=>'add'],['class'=>'btn btn-success', 'data-toggle'=>"tooltip" , 'title'=>"Nueva Caracterización Genotípica", 'escape' => false]) ?>

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
                                    <th style="min-width: 200px">Marcador Molecular</th>
                                    <th style="min-width: 150px">Uso Enzima</th>
                                    <th style="min-width: 150px">Nombre Enzima</th>
                                    <th style="min-width: 170px">N° de Adaptadores</th>
                                    <th style="min-width: 150px">Nombre del Proyecto</th>
                                    <th style="min-width: 150px">Código del Proyecto</th>
                                    <th style="min-width: 130px">N° de Iniciadores</th>
                                    <th style="min-width: 150px">Nro de Ciclos</th>
                                    <th style="min-width: 150px">Tecnología de Secuenciamiento</th>
                                    <th style="min-width: 150px">N° Accessión GENEBANK</th>
                                    <th style="min-width: 150px">Otro nro. Accesión</th>
                                    <th style="min-width: 150px">Tamaño de Secuencia</th>
                                    <th style="min-width: 150px">Método de Determinación</th>
                                    <th style="min-width: 170px">N° de Repeticiones</th>
                                    <th style="min-width: 150px">Localización</th>
                                    <th style="min-width: 150px">Nombre de Responsable</th>
                                    <th style="min-width: 150px">Descripción Marcadores</th>
                                    <th style="min-width: 150px">Plataforma de Corrida</th>
                                    <th style="min-width: 100px">Opciones</th>
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
                                    <th></th>
                                    <th></th>
                                    <td></td>
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

                                <?php foreach ($caractGenotypic as $caractGenotypic): ?>
								<?php
									$conn2 = \Cake\Datasource\ConnectionManager::get('default');
									$sql2="SELECT p.station_current_id FROM passport p INNER JOIN caract_genotypic c ON c.accenumb=p.accenumb WHERE c.accenumb=".$caractGenotypic['accenumb'];
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
                                    <td><?= h($caractGenotypic->expnumb) ?></td>
                                    <td><?php echo $caractGenotypic->colecciongeno==NULL?'':$caractGenotypic->colecciongeno->colname; ?></td>
                                    <td><?php echo $caractGenotypic->marcadormol==NULL?'': $caractGenotypic->marcadormol->name; ?></td>
                                    <td><?php echo $caractGenotypic->usoenzima->name ?></td>
                                    <td><?= h($caractGenotypic->restenzymname) ?></td>
                                    <td><?= $this->Number->format($caractGenotypic->adaptrnum) ?></td>
                                    <td><?= h($caractGenotypic->project) ?></td>
                                    <td><?= h($caractGenotypic->projcode) ?></td>
                                    <td><?= $this->Number->format($caractGenotypic->primernum) ?></td>
                                    <td><?= h($caractGenotypic->ciclonumb) ?></td>
                                    <td><?= h($caractGenotypic->seqtech) ?></td>
                                    <td><?= h($caractGenotypic->accnumb) ?></td>
                                    <td><?= h($caractGenotypic->othername) ?></td>
                                    <td><?= h($caractGenotypic->seqsize) ?></td>
                                    <td><?= h($caractGenotypic->fragsizemeth) ?></td>
                                    <td><?= h($caractGenotypic->repnumb) ?></td>
                                    <td><?php echo $caractGenotypic->localizacion==NULL?'': $caractGenotypic->localizacion->name; ?></td>
                                    <td><?= h($caractGenotypic->respname) ?></td>
                                    <td><?= h($caractGenotypic->markerdescrip) ?></td>
                                    <td><?= h($caractGenotypic->platform) ?></td>
                                    <td>

                                        <?php if($permiso['view']){ ?>
                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'CaractGenotypicMicro', 'action' => 'view', $caractGenotypic->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de la Caracterización Genotípica."])
                                        ?>
                                        <?php } ?>

                                        <?php if($permiso['edit']) { ?>
                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'CaractGenotypicMicro', 'action' => 'edit', 'id' => $caractGenotypic->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar la Caracterización Genotípica."])
                                        ?>
                                        <?php } ?>

                                        <?php if($permiso['delete']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => 'Eliminar la Caracterización Genotípica.', 'data-id' => $caractGenotypic->id])
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
        $(".modal-body").html('¿Desea eliminar el registro actual?');

    });
</script>
