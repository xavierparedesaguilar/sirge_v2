
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Editar Usuario <?php echo $user->username ?></h1>

    <?php
        $this->Html->addCrumb('Usuarios', ['controller'=> 'User', 'action' => 'index']);
        $this->Html->addCrumb($user->username, ['controller' => 'User', 'action' => 'edit', 'id' => $user->id]);
        $this->Html->addCrumb( 'Editar' );

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
                </div>
                <?php echo $this->Form->create($user, [
                    'url' => ['controller' => 'User', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id' => "form_add_user",
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('names', [
                                        'label' => ['text' => 'Nombres <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control text-uppercase',
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('surnames', [
                                        'label' => ['text' => 'Apellidos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control text-uppercase',
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('email', [
                                        'label' => ['text' => 'Email <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                                <?php echo $this->Form->control('email_hidden', ['type' => 'hidden', 'id'=>'email_hidden', 'value' => $user->email]) ?>
                                <?php echo $this->Form->control('username_hidden', ['type' => 'hidden', 'value' => $user->username]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('role_id', [
                                        'label'  => ['text' => 'Rol <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'options'=> $roles,
                                        'empty'  => '-- SELECCIONE --',
                                        'id'     => 'role_id',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('status', [
                                        'label'  => ['text' => 'Estado'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'options'=> ['1' => 'ACTIVO', '2' => 'INACTIVO'],
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('station_id', [
                                        'type'   => 'select',
                                        'options'=> $station,
                                        'label'  => __('Estación Experimental <b style="color:#dd4b39;">(*)</b>'),
                                        'escape' => false,
                                        'class'  => 'form-control select2',
                                        'empty'  => '-- SELECCIONE --',
                                ]); ?>
                            </div>
							</div>
							<div class="row">
							<div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php 
									$accesoTodo = 0;
									$conn = \Cake\Datasource\ConnectionManager::get('default');
									  
									if( $user['role_id'] == 1 ){
										$accesoTodo = 1;
									}else {
										$sqlAcceso ="SELECT estado FROM permiso_estacion AS p WHERE p.idusuario =".$user['id'];
										$stmtAcceso = $conn->prepare($sqlAcceso);
										$stmtAcceso->execute();
									
										if( $stmtAcceso->rowCount() > 0){
											$rowAcceso = $stmtAcceso->fetch();
											 
											if($rowAcceso[0] == 1){
												$accesoTodo = 1;
											}
										}
									}	
								?>
								<label>
								<input
								<?php
									if ( $accesoTodo == 1){
										echo 'checked="checked"';	
									}								
								?>
									value="1"
									type="checkbox"
                                    name="Permiso"
                                    class="colored-success"
									>
								Ver todas las estaciones experimentales
								</label>
                            </div>
                        </div>
                    </div>

                        <!-- INICIO DE LA VISTA DE TABS -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                    <br>
                    <!-- INICIO DE LOS TABS DE GENERAL Y DE CADA RECURSO -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" aria-expanded="true" href="#tabla1"> Módulos Generales</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla2"> Recursos Fitogenéticos</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla3"> Recursos Zoogenéticos</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla4"> Recursos Microorganismos</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tabla1" class="tab-pane active">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="create-user-table">
                                            <thead class="bordered-darkorange">
                                                <tr class="">
                                                    <th class="text-left">Módulo</th>
                                                    <th>Consultar</th>
                                                    <th>Ingresar</th>
                                                    <th>Editar</th>
                                                    <th>Importar</th>
                                                    <th>Exportar</th>
                                                    <th>Deshabilitar</th>
                                                    <th>Detalle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modulos as $key => $modulo): ?>
                                                    <tr>
                                                        <td class="text-left">
                                                            <i class="<?php echo $modulo->icon ?>"></i>
                                                                <?php echo $modulo->title ?>
                                                        </td>
                                                        <?php if (true) { ?>
                                                            <?php for ($i = 1; $i < 8; $i++) : ?>
                                                                <td>
                                                                    <div class="checkbox ">
                                                                        <label>
                                                                            <input <?php 
																				echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'checked="checked"' : '';
																				echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'value="'.$i.'"' : '';
																				?>
                                                                                id="<?php echo $modulo->id . "_" . $i; ?>"
                                                                                type="checkbox"
                                                                                name="permissions[<?php echo $modulo->id ?>][]"
                                                                                class="colored-success"
																				>
                                                                            <span class="text"></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            <?php endfor; ?>
                                                        <?php } else { ?>
                                                            <td colspan="7"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php if (count($modulo->modulerole) > 0): ?>
                                                        <?php foreach ($modulo->modulerole as $keyval => $relacion): ?>
                                                            <tr>
                                                                <td class="text-left p-l-30">
                                                                    <i class="<?php echo $relacion->icon ?>"></i>
                                                                        <?php echo $relacion->title ?>
                                                                </td>
                                                                <?php for ($j = 1; $j < 8; $j++) { ?>
                                                                    <td>
                                                                        <div class="checkbox ">
                                                                            <label>
                                                                                <input <?php echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'value="'.$j.'"' : ''; ?>
                                                                                    id="<?php echo $relacion->id . "_" . $j; ?>"
                                                                                    type="checkbox"
                                                                                    name="permissions[<?php echo $relacion->id ?>][]"
                                                                                    class="colored-success"
                                                                                >
                                                                                <span class="text"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tabla2" class="tab-pane">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="create-user-table">
                                            <thead class="bordered-darkorange">
                                                <tr class="">
                                                    <th class="text-left">Módulo</th>
                                                    <th>Consultar</th>
                                                    <th>Ingresar</th>
                                                    <th>Editar</th>
                                                    <th>Importar</th>
                                                    <th>Exportar</th>
                                                    <th>Deshabilitar</th>
                                                    <th>Detalle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modulos_1 as $key => $modulo): ?>
                                                    <tr>
                                                        <td class="text-left">
                                                            <i class="<?php echo $modulo->icon ?>"></i>
                                                                <?php echo $modulo->title ?>
                                                        </td>
                                                        <?php if (true) { ?>
                                                            <?php for ($i = 1; $i < 8; $i++) : ?>
                                                                <td>
                                                                    <div class="checkbox ">
                                                                        <label>
                                                                            <input <?php echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'value="'.$i.'"' : '';?>
                                                                                id="<?php echo $modulo->id . "_" . $i; ?>"
                                                                                type="checkbox"
                                                                                name="permissions[<?php echo $modulo->id ?>][]"
                                                                                class="colored-success"
                                                                            >
                                                                            <span class="text"></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            <?php endfor; ?>
                                                        <?php } else { ?>
                                                            <td colspan="7"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php if (count($modulo->modulerole) > 0): ?>
                                                        <?php foreach ($modulo->modulerole as $keyval => $relacion): ?>
                                                            <tr>
                                                                <td class="text-left p-l-30">
                                                                    <i class="<?php echo $relacion->icon ?>"></i>
                                                                        <?php echo $relacion->title ?>
                                                                </td>
                                                                <?php for ($j = 1; $j < 8; $j++) { ?>
                                                                    <td>
                                                                        <div class="checkbox ">
                                                                            <label>
                                                                                <input <?php echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'value="'.$j.'"' : ''; ?>
                                                                                    id="<?php echo $relacion->id . "_" . $j; ?>"
                                                                                    type="checkbox"
                                                                                    name="permissions[<?php echo $relacion->id ?>][]"
                                                                                    class="colored-success"
                                                                                >
                                                                                <span class="text"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tabla3" class="tab-pane">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="create-user-table">
                                            <thead class="bordered-darkorange">
                                                <tr class="">
                                                    <th class="text-left">Módulo</th>
                                                    <th>Consultar</th>
                                                    <th>Ingresar</th>
                                                    <th>Editar</th>
                                                    <th>Importar</th>
                                                    <th>Exportar</th>
                                                    <th>Deshabilitar</th>
                                                    <th>Detalle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modulos_2 as $key => $modulo): ?>
                                                    <tr>
                                                        <td class="text-left">
                                                            <i class="<?php echo $modulo->icon ?>"></i>
                                                                <?php echo $modulo->title ?>
                                                        </td>
                                                        <?php if (true) { ?>
                                                            <?php for ($i = 1; $i < 8; $i++) : ?>
                                                                <td>
                                                                    <div class="checkbox ">
                                                                        <label>
                                                                            <input <?php echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'value="'.$i.'"' : ''; ?>
                                                                                id="<?php echo $modulo->id . "_" . $i; ?>"
                                                                                type="checkbox"
                                                                                name="permissions[<?php echo $modulo->id ?>][]"
                                                                                class="colored-success"
                                                                            >
                                                                            <span class="text"></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            <?php endfor; ?>
                                                        <?php } else { ?>
                                                            <td colspan="7"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php if (count($modulo->modulerole) > 0): ?>
                                                        <?php foreach ($modulo->modulerole as $keyval => $relacion): ?>
                                                            <tr>
                                                                <td class="text-left p-l-30">
                                                                    <i class="<?php echo $relacion->icon ?>"></i>
                                                                        <?php echo $relacion->title ?>
                                                                </td>
                                                                <?php for ($j = 1; $j < 8; $j++) { ?>
                                                                    <td>
                                                                        <div class="checkbox ">
                                                                            <label>
                                                                                <input <?php echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'value="'.$j.'"' : '';?>
                                                                                    id="<?php echo $relacion->id . "_" . $j; ?>"
                                                                                    type="checkbox"
                                                                                    name="permissions[<?php echo $relacion->id ?>][]"
                                                                                    class="colored-success"
                                                                                >
                                                                                <span class="text"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tabla4" class="tab-pane">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="create-user-table">
                                            <thead class="bordered-darkorange">
                                                <tr class="">
                                                    <th class="text-left">Módulo</th>
                                                    <th>Consultar</th>
                                                    <th>Ingresar</th>
                                                    <th>Editar</th>
                                                    <th>Importar</th>
                                                    <th>Exportar</th>
                                                    <th>Deshabilitar</th>
                                                    <th>Detalle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modulos_3 as $key => $modulo): ?>
                                                    <tr>
                                                        <td class="text-left">
                                                            <i class="<?php echo $modulo->icon ?>"></i>
                                                                <?php echo $modulo->title ?>
                                                        </td>
                                                        <?php if (true) { ?>
                                                            <?php for ($i = 1; $i < 8; $i++) : ?>
                                                                <td>
                                                                    <div class="checkbox ">
                                                                        <label>
                                                                            <input <?php echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($i, explode(",", $modulo->modulopermiso))) ? 'value="'.$i.'"' : '';?>
                                                                                id="<?php echo $modulo->id . "_" . $i; ?>"
                                                                                type="checkbox"
                                                                                name="permissions[<?php echo $modulo->id ?>][]"
                                                                                class="colored-success"
                                                                            >
                                                                            <span class="text"></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            <?php endfor; ?>
                                                        <?php } else { ?>
                                                            <td colspan="7"></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php if (count($modulo->modulerole) > 0): ?>
                                                        <?php foreach ($modulo->modulerole as $keyval => $relacion): ?>
                                                            <tr>
                                                                <td class="text-left p-l-30">
                                                                    <i class="<?php echo $relacion->icon ?>"></i>
                                                                        <?php echo $relacion->title ?>
                                                                </td>
                                                                <?php for ($j = 1; $j < 8; $j++) { ?>
                                                                    <td>
                                                                        <div class="checkbox ">
                                                                            <label>
                                                                                <input <?php echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'checked="checked"' : ''; echo (in_array($j, explode(",", $relacion->modulopermiso))) ? 'value="'.$j.'"' : '';?>
                                                                                    id="<?php echo $relacion->id . "_" . $j; ?>"
                                                                                    type="checkbox"
                                                                                    name="permissions[<?php echo $relacion->id ?>][]"
                                                                                    class="colored-success"
                                                                                >
                                                                                <span class="text"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  FIN  DE LA VISTA DE TABS -->
                </div>

                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR', ['class' => 'btn btn-primary', 'id' => 'btnUser']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller' => 'User', 'action' => 'index'], ['class' => 'btn btn-default']); ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(function() {

    $("input:checkbox").change(function(e) {

      if ($(this).prop('checked')){
        var id=$(this).attr('id'); // it will get value from checked checkbox;
        id = id.split("_");
        $(this).val(id[1]);
        console.log('checked');
      }else{
        $(this).val('');
        console.log('not checked');
      }
    });
});

</script>