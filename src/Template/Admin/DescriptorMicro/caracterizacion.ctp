
<?php $this->assign('title', 'CARACTERIZACIÓN'); ?>

<section class="content-header">
    <h1>Módulo <?php echo 'Caracterización' ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaMicro', 'action' => 'index']);
        $this->Html->addCrumb( ucfirst(mb_strtolower($coleccion,'UTF-8')).' - '.ucfirst(mb_strtolower($especie,'UTF-8')));

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

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
	<div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('LISTA DE RESULTADOS : '.$coleccion.' - '.$especie) ?></strong></h3>
                    <div class="pull-right box-tools">


						<?php if(!empty($resultado) && $permiso['edit']){ ?>
	                        <?php echo $this->Html->link('<i class="fa fa-sort-amount-asc" ></i>',
	                                    ['controller' => 'DescriptorMicro', 'action' => 'ordenar','idx'=>$idx,'idy'=>$idy],
	                                    ['class' => 'btn btn-warning', 'data-toggle'=> "tooltip",'id'=>'sortable',  'title'=> "Ordenar Descriptores", 'escape'=>false] )
	                        ?>
                        <?php }  ?>



 						<?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de Descriptores" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                        <?php } ?>


                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                    	<?php if(!empty($resultado)){ ?>
	                        <div class="table-responsive">
	                            <table id="tablaListado" class="table table-striped table-bordered table-hover">
	                                <thead class="headTablaListado">
	                                    <tr>
	                                        <th>#</th>
	                                        <?php

	                                            $header = array_keys($resultado[0]);

	                                            for($i=0; $i<count($header); $i++){
	                                                if($i < 3)
	                                                    echo "<th style='min-width: 200px'>";
	                                                else
	                                                    echo "<th style='min-width: 150px'>";

	                                                echo $header[$i];
	                                                echo "</th>";
	                                            }
	                                        ?>
	                                    </tr>
	                                </thead>
	                                <tbody>
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
							 


	                                        for($i=0; $i < count($resultado); $i++){

	                                            $content = array_values($resultado[$i]);
												$station_current_id = 0;
										 
												$conn = \Cake\Datasource\ConnectionManager::get('default');										  
												
												$sql2="SELECT station_current_id FROM passport WHERE accenumb='".$content[0]."'";
												$obj2 = $conn->prepare($sql2);
												$obj2->execute();
											
												if( $obj2->rowCount() > 0){
													$rowAcceso = $obj2->fetch();
													$station_current_id= $rowAcceso[0];											
												}
																		 
											if(($permiso['station_id']==$station_current_id ||$per == 1) || $permiso['role_id']==1){

	                                            echo "<tr>";
	                                            echo "<td>".($i+1)."</td>";

	                                            for($j = 0; $j<count($content); $j++){

	                                                echo "<td>";

	                                                if($j < 3)
	                                                	echo $content[$j];
	                                                else if($j > (count($content)-2))
	                                                	echo $content[$j];
	                                                else
	                                                	echo ($content[$j] == -1) ? '' : $content[$j];

	                                                echo "</td>";
	                                            }
	                                            echo "</tr>";
	                                        }
										}
	                                    ?>
	                                </tbody>
	                            </table>
	                        </div>
	                   	<?php } else { ?>
	                   		<div class="callout callout-info">
			                	<h4><i class="icon fa fa-info"></i> MENSAJE !!</h4>
			                	<p>No existen resultado para la colección : <strong><?php echo $coleccion ?></strong> y especie : <strong><?php echo mb_strtoupper($especie,'UTF-8') ?></strong></p>
			              	</div>
				      	<?php } ?>
                    </div>
                </div>
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla', 'idx'=>$idx]]); ?>
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

<?php if(!empty($resultado)){ ?>
	<script type="text/javascript">
	    $(function () {
	        tablaListadoDataTable();
	    });
	</script>
<?php } ?>