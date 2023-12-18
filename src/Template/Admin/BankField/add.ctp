
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
        $this->Html->addCrumb('Crear');

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
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($bankField, [
                    'url'          => ['controller' => 'BankField', 'action' => 'add'],
                    'autocomplete' => "off",
                    'enctype'      => 'multipart/form-data',
                    'id'           => "form_bankField",
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#tabla1">Datos del Experimento</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla2">Diseño del Experimento</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla3">Ubicación del Experimento</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla4">Datos del Germoplasma</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tabla1" class="tab-pane in active">

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('sowsamptype',
                                                    ['type' => 'select',
                                                    'options' => $lista_material,
                                                    'label' => __('Tipo de Material Sembrado <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de muestra que se utilizará para la siembra"></i>'),
                                                    'escape' => false,
                                                    'class' => 'form-control select2',
                                                    'empty' => '-- SELECCIONE --' ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('objective',
                                                    ['type' => 'select',
                                                    'options' => $lista_objetivo,
                                                    'label' => __('Objetivo del Proyecto <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Finalidad del experimento"></i>'),
                                                    'escape' => false,
                                                    'class' => 'form-control select2',
                                                    'empty' => '-- SELECCIONE --' ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('fecha_inicio', [
                                                        'label'  => ['text' => 'Fecha de Inicio <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se inicia el experimento"></i>'],
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                         'value' => $bankField->startdate,
                                                        'id'     => 'fecha-inicio',
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('fecha_termino', [
                                                    'label' => ['text' => 'Fecha de Término <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se termina el experimento"></i>'],
                                                    'escape' => false,
                                                    'class' => 'form-control',
                                                     'value'=>$bankField->enddate ,
                                                     'id'   => 'fecha-termino',
                                                                // 'readonly' => true
                                            ]); ?>
                                            <label id="msjfecha"></label>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php  echo $this->Form->control('researcher',[
                                                        'label'=> 'Investigador Responsable del Experimento <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del investigador responsable del proyecto"></i>',
                                                        'escape' => false,
                                                        'class'=> 'form-control',
                                                ]); ?>

                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php  echo $this->Form->control('proyect',[
                                                        'label'=> 'Proyecto Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Según fuente de financiamiento  del proyecto"></i>',
                                                        'escape' => false,
                                                        'class'=> 'form-control',

                                                ]); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->input('remarks', ['type' => 'textarea',
                                                'label' => 'Anotaciones' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Para añadir notas o para completar datos faltantes"></i>' ,
                                                'escape' => false,
                                                'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabla2" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-12 col-xs-12">
                                                <?php  echo $this->Form->control('design',[
                                                        'label'=> 'Diseño del Experimento <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Diseño del experimento"></i>',
                                                        'escape' => false,
                                                        'class'=> 'form-control',
                                                ]); ?>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php  echo $this->Form->control('fieldsize',[
                                                        'label'=> 'Tamaño de Parcela' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Área en m2 de cada parcela"></i>',
                                                        'escape' => false,
                                                        'class'=> 'form-control',
                                                ]); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('treatment',[
                                                            'label'=> 'Tratamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Detalle de los tratamiento  aplicados en el experimento"></i>',
                                                            'escape' => false,
                                                            'class'=> 'form-control',
                                                    ]); ?>

                                        </div>
                                         <div class="col-lg-4 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('reps',[
                                                            'label'=> 'Número de Repeticiones' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de repeticiones por tratamiento"></i>',
                                                            'escape' => false,
                                                            'class'=> 'form-control',
                                                    ]); ?>

                                         </div>
                                         <div class="col-lg-4 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('plotsize',[
                                                            'label'=> 'Número de plantas por parcela' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de plantas por parcela"></i>',
                                                            'escape' => false,
                                                            'class'=> 'form-control',
                                                    ]); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                     <!-- fieldmap -->
                                        <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                     <img src="<?php echo $this->Url->build('/', true).$bankField->fieldmap?>">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new">Seleccionar imagen del croquis del campo</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="imagen_croquis" accept="image/jpg,image/jpeg,image/png">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>


                                     <!-- image1 -->
                                        <div class="col-sm-3 text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                     <img src="<?php echo $this->Url->build('/', true).$bankField->image1?>">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new">Seleccionar imagen  del campo</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="imagen_campo" accept="image/jpg,image/jpeg,image/png">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-6 col-sm-12 col-xs-12">

                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('remarks1', [
                                                                'label' => ['text' => 'Descripción Imagen 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 1"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>

                                    </div>
                                </div>

                                <div id="tabla3" class="tab-pane">
                                    <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('departamento', [
                                                            'label'   => 'Departamento <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del departamento donde se realiza el experimento"></i>',
                                                            'escape' => false,
                                                            'id'=>'departamento',
                                                            'class'   => 'form-control select2',
                                                            'type'    => 'select',
                                                            'options' => $lista_departamento,
                                                            'empty'   => '-- SELECCIONE --',
                                                     ]); ?>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="provincia">Provincia (*)</label>
                                                        <select class="form-control select2" name="provincia" id="provincia" >
                                                            <option value="">--PROVINCIA--</option>
                                                            <?php if (isset($estacion)): ?>
                                                                <?php foreach ($provincias as $provincia): ?>
                                                                    <option
                                                                        value="<?php echo $provincia->cod_pro ?>" <?php echo (isset($estacion) and ($estacion->ubigeo->cod_pro == $provincia->cod_pro)) ? "selected" : null ?>><?php echo $provincia->nombre ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="distrito">Distrito (*)</label>
                                                        <select class="form-control select2" name="distrito" id="distrito" >
                                                            <option value="">--DISTRITO--</option>
                                                            <?php if (isset($estacion)): ?>
                                                                <?php foreach ($distritos as $distrito): ?>
                                                                    <option
                                                                        value="<?php echo $distrito->id ?>" <?php echo (isset($estacion) and ($estacion->ubigeo->id == $distrito->id)) ? "selected" : null ?>><?php echo $distrito->nombre ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                        <input type="hidden" name="ubigeo_id" id="ubigeo_id" value="<?php echo(isset($estacion) ? $estacion->ubigeo_id : null) ?>">
                                                    </div>
                                                </div>


                                             <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('eea',
                                                            ['type' => 'select',
                                                            'options' => $lista_experimiental,
                                                            'label' => __('Estación Experimental <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental donde se conserva la accesión"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control select2',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>


                                    </div>

                                    <div class="row">

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('locality',[
                                                            'label'=> 'Localidad <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la localidad donde se realiza el experimento"></i>',
                                                            'escape' => false,
                                                            'class'=> 'form-control',
                                                    ]); ?>

                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('field', [
                                                                'label' => ['text' => 'Código o Descripción del Campo' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código o descripción del campo"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>

                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('latitude', [
                                                                'label' => ['text' => 'Latitud' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Latitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>

                                            </div>


                                            <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('longitude', [
                                                                'label' => ['text' => 'Longitud' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Longitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>

                                            </div>

                                    </div>

                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('elevation', [
                                                                'label' => ['text' => 'Elevación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Elevación del sitio de recolección"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>

                                            </div>

                                    </div>
                                </div>

                                <div id="tabla4" class="tab-pane">

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label for="pasaporte">Código PER</label>
                                                <div class="input-group">
                                                    <input type="text" name="pasaporte" id="txtCodPasaporte" class="form-control">
                                                    <span class="input-group-btn">
                                                        <button type="button" data-toggle="tooltip"  title="Validar Cod. PER" id="btnPasaporteCampo" class="btn btn-warning btn-flat" ><i class="fa fa-search " ></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label id="msjBancoInvitro" style="display: block; color: red; padding-top: 30px"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                            <?php  echo $this->Form->control('accenumb',[
                                                    'label'=> 'Código Accesión <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código accesión: código de identificación  local de la accesión"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'id'   => 'txtCod',
                                                    // 'disabled'=>$idPasaporte==null?false:true,
                                            ]); ?>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('colname',
                                                            ['type' => 'select',
                                                            'options' => $lista_coleccion,
                                                            'id'=>'lstcoleccion',
                                                            'label' => __('Colección <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control select2',
                                                            // 'disabled'=>$idPasaporte==null?false:true,
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('genus', [
                                                        'type'        => 'select',
                                                        'options'     => $lista_genero,
                                                        'id'          => 'lstSpecie',
                                                        'label'       => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>' ),
                                                        'escape'      => false,
                                                        'class'       => 'form-control select2',
                                                        // 'disabled' =>$idPasaporte==null?false:true,
                                                        'empty'       => '-- SELECCIONE --',
                                                ]); ?>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('comun',[
                                                    'label'=> 'Nombre Común' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control text-uppercase',
                                                    'id'   => 'txtComun',
                                                    'disabled'=>true,
                                            ]); ?>
                                        </div>

                                        <!-- <div class="col-lg-3 col-sm-12 col-xs-12"> -->
                                                <?php /*echo $this->Form->control('species', [
                                                        'type'   => 'select',
                                                        'options'=> $lista_specie,
                                                        'id'=>'lstGenero',
                                                        'label'  => __('Especies <b style="color:#dd4b39;">(*)</b>' ),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        // 'disabled'=>$idPasaporte==null?false:true,
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); */?>
                                        <!-- </div> -->
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('othenumb', [
                                                        'label' => ['text' => 'Código del Material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código asignado para el material"></i>'],
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                            ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                            <?php echo $this->Form->control('othername', [
                                                        'label' => ['text' => 'Otro Nombre de la Muestra' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificación de la muestra"></i>'],
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                            ]); ?>

                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">

                                            <?php echo $this->Form->control('detecnumb', [
                                                        'label' => ['text' => 'Código de Identificación Interno' ],
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                            ]); ?>

                                        </div>
                                    </div>
                                    <?php echo $this->Form->hidden('passport_id',['id'=>'hdn_pasaporteid']);?>
                                </div>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnBankField">GUARDAR</button>

                        <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'BankField', 'action' => 'index'],
                                        ['class' => 'btn btn-default', 'escape'=>false] )
                        ?>

                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

    $this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
    $this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
    $this->Html->scriptBlock('$("#fecha-inicio,#fecha-termino").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

    //***************************** select 2 *****************************//
    $this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
    $this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>

