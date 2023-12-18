
<?php $this->assign('title', $mod_padre); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_padre . " - " . $mod_parent ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('Fenotípica');

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
			  		<h3 class="box-title"><strong>Lista de Caracterización</strong></h3>
			  		<div class="box-tools pull-right">

                    <?php if($permiso['import']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-cloud-upload"></i>', ['controller' => 'FenotipicaFito', 'action' => 'importarCaracterizacion'], ['class' => 'btn btn-warning', 'data-toggle' => "tooltip", 'title' => "Importar Caracterización.", 'escape' => false]) ?>

                    <?php } ?>

                     <?php if($permiso['import']) { ?>

			    		<?php echo $this->Html->link('<i class="fa fa-cloud-upload"></i>', ['controller' => 'FenotipicaFito', 'action' => 'importar'], ['class' => 'btn btn-success', 'data-toggle' => "tooltip", 'title' => "Importar Descriptores y Estados.", 'escape' => false] ); ?>


                    <?php } ?>
			  		</div>
				</div>
                <?php echo $this->Form->create(NULL, [
                            'url' => ['controller' => 'FenotipicaFito', 'action' => 'index'],
                            'id'  => 'form_fenotipica',
                ]); ?>
				<div class="box-body">
			  		<div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion_id',[
                                        'type'    => 'select',
                                        'options' => $colecciones,
                                        'default' => $coleccion_idx->id,
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'feno_coleccion',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                        'type'    => 'select',
                                        'options' => (!empty($especies))? $especies : [],
                                        'default' => (!empty($especie_idx))? $especie_idx->cropname : '',
                                        'label'   => 'Nombre Científico <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'feno_especie',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('feno_cropname', [
                                                'label'    => 'Nombre Común',
                                                'class'    => 'form-control text-uppercase',
                                                'disabled' => true,
                                                'id'       => 'feno_cropname',
                                                'value'    => (!empty($especie_idx))? $especie_idx->cropname : '',
                                ]) ?>
                            </div>
                        </div>
                   	</div>
				</div>
				<div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnFenotipica">BUSCAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/caracterizacion/', true) ?>"
                           class="btn btn-default"> CANCELAR
                        </a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
			</div>
		</div>
	</div>

    <!-- TABLA DE RESULTADOS SEGUN LOS FILTROS SELECCIONADOS -->
    <?php if(isset($lista_especie)){ ?>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>RESULTADOS</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div>
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th style="min-width: 40px;">#</th>
                                    <th style="min-width: 20px;">NOMBRE CIENTÍFICO</th>
                                    <th style="min-width: 10px;">NOMBRE COMÚN</th>
                                    <th style="min-width: 100px;">FAMILIA</th>
                                    <th style="min-width: 50px;">COLECCIÓN</th>
                                    <th style="min-width: 100px;">DISPONIBILIDAD</th>
                                    <th style="min-width: 20px;">OPCIONES</th>
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
                                <?php foreach ($lista_especie as $specie): ?>
								<?php
									$conn2 = \Cake\Datasource\ConnectionManager::get('default');
									$sql2="select station_current_id from passport where specie_id=".$specie->id;
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
                                    <td><?php echo h($specie->genus.' '.$specie->species) ?></td>
                                    <td><?php echo h($specie->cropname) ?></td>
                                    <td><?php echo h($specie->family) ?></td>
                                    <td><?php echo $specie->collection->colname ?></td>
                                    <td><?php echo ($this->Number->format($specie->availability) == 1) ? 'SI' : 'NO' ?></td>
                                    <td class="text-center">

                                        <?php echo $this->Html->link('Descriptores',
                                                ['controller' => 'DescriptorFito', 'action' => 'index', 'id' => $specie->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver información de los Descriptores."])
                                        ?>

                                        <?php echo $this->Html->link('Caracterización',
                                                ['controller' => 'DescriptorFito', 'action' => 'caracterizacion', 'idx'=> $specie->id, 'idy' => $specie->collection->id ],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Información de la Caracterización."])
                                        ?>

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

    <script type="text/javascript">
        $(function () {
            tablaListadoDataTable();
        });
    </script>


    <?php } ?>
</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>