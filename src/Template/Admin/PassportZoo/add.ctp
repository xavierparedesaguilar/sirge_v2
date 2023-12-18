
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportZoo', 'action' => 'index']);
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

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($passportZoo, [
                    'url' => ['controller' => 'PassportZoo', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_passportzoo",
                    'enctype' => 'multipart/form-data'
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" aria-expanded="true" href="#tabla1"> Datos Principales</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla2"> Datos de Ubicación</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla3"> Fotografía y Ancestros - Accesión</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla4"> Datos de Colecta y Donante</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla5">Ecogeográficas</a></li>
                                <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla6"> Información Legal y Adicional</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="tabla1" class="tab-pane active">
                                    <div class="row">

                                        <?php echo $this->Form->control('passport_validation', ['type' => 'hidden', 'value' => $passpor_validation['validation'] ]) ?>
                                        <?php echo $this->Form->control('passzoo_validation', ['type' => 'hidden', 'value' => $passzoo_validation['validation'] ]) ?>

                                        <!-- INICIO DATOS PRINCIPALES -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.instcode', [
                                                            'label' => ['text' => 'Código del Instituto (COD. FAO) '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código nacional: código de identificación nacional"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.othenumb', [
                                                            'label' => ['text' => 'Otro Código Accesión '. $this->Functions->validarObligatorio('othenumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificación de esta accesión que se haya encontrado en otras colecciones"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.accname', [
                                                            'label' => ['text' => 'Nombre de la Accesión '. $this->Functions->validarObligatorio('accname',$lista)  . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Designación registrada o formal que se da a la accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>


                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.subtype', [
                                                        'type'   => 'select',
                                                        'options'=> $tipo_recursos,
                                                        'label'  => __('SubTipo de Recurso '. $this->Functions->validarObligatorio('subtype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Subtipo de recurso"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.collnumb', [
                                                            'label' => ['text' => 'Código de Colecta' . $this->Functions->validarObligatorio('collnumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código asignado por el recolector de la muestra"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <!-- INICIO CAMPOS DE LA ESPECIE -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="coleccion">Colección <?php echo $this->Functions->validarObligatorio('specie_id',$lista) ?></label>
                                                    <select class="form-control select2 b-radio  text-uppercase" name="coleccion"
                                                               id="coleccion">
                                                        <option value="">-- SELECCIONE --</option>
                                                        <?php foreach ($colecciones as $coleccion): ?>
                                                            <option value="<?php echo $coleccion->id ?>"><?php echo $coleccion->colname ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.specie_id', [
                                                        'type'    => 'select',
                                                        'options' => [],
                                                        'id'      => 'especie_idx',
                                                        'label'   => __('Nombre Científico '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre conformado por el género y la especie"></i>'),
                                                        'escape' => false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('nombre_comun', [
                                                            'label'    => ['text' => 'Nombre Común '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie"></i>'],
                                                            'escape' => false,
                                                            'class'    => 'form-control',
                                                            'disabled' => true,
                                                ]); ?>
                                            </div>
                                            <!-- FIN CAMPOS DE LA ESPECIE -->
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.spauthor', [
                                                            'label' => ['text' => 'Autor Especie '. $this->Functions->validarObligatorio('spauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del autor(es) de la especie "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.subtaxa', [
                                                            'label' => ['text' => 'SubTaxon '. $this->Functions->validarObligatorio('subtaxa',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Proveer algún identificador taxonomico adicional"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.subtauthor', [
                                                            'label' => ['text' => 'SubTaxon Autor '. $this->Functions->validarObligatorio('subtauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del autor(es) del subtaxon "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.racetype', [
                                                            'label' => ['text' => 'Tipo de Raza '. $this->Functions->validarObligatorio('racetype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de raza del animal"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.storage', [
                                                        'type'   => 'select',
                                                        'options'=> $tipo_conservacion,
                                                        'label'  => __('Tipo Conservación '. $this->Functions->validarObligatorio('storage',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de preservación del material"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('fecha_ingreso', [
                                                            'label' => ['text' => 'Fecha Ingreso '. $this->Functions->validarObligatorio('acqdate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de ingreso al banco"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.eea', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'label'  => __('Estación Experimental '. $this->Functions->validarObligatorio('station_current_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental donde se conserva la accesión"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.eeaproc', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'label'  => __('Estación Experimental de Procedencia '. $this->Functions->validarObligatorio('station_origin_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental de procedencia"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.promissory', [
                                                        'type'   => 'select',
                                                        'options'=> $lista_promisoria,
                                                        'label'  => __('Promisoria '. $this->Functions->validarObligatorio('promissory',$lista) ),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.availability', [
                                                        'type'   => 'select',
                                                        'options'=> $disp_accesion,
                                                        'label'  => __('Disponibilidad '. $this->Functions->validarObligatorio('availability',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad del Lote de la accesión"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --'
                                                ]); ?>
                                            </div>
                                        <!-- INICIO DATOS PRINCIPALES -->
                                    </div>
                                </div>
                                <div id="tabla2" class="tab-pane">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Ubicación</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS UBIGEO -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passport.country_id', [
                                                                'type'   => 'select',
                                                                'options'=> $paises,
                                                                'label'  => __('País Origen '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del país de origen del material genetico"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control select2',
                                                                'empty'  => '-- SELECCIONE --',
                                                                'id'     => 'country_id',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="departamento">Departamento</label>
                                                            <select class="form-control b-radio  text-uppercase" name="departamento" id="departamento" disabled="true">
                                                                <option value="">-- SELECCIONE --</option>
                                                                <?php foreach ($departamento as $region): ?>
                                                                    <option value="<?php echo $region->cod_dep ?>"><?php echo $region->nombre ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('provincia', [
                                                                'type'    => 'select',
                                                                'options' => [],
                                                                'label'   => __('Provincia' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la provincia donde está ubicada la localidad de procedencia de la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'   => '-- SELECCIONE --',
                                                                'disabled'=> true,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('distrito', [
                                                                'type'    => 'select',
                                                                'options' => [],
                                                                'label'   => __('Distrito' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del distrito donde está ubicada la localidad de procedencia de la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'   => '-- SELECCIONE --',
                                                                'disabled'=> true,
                                                        ]); ?>

                                                        <input type="hidden" name="passport[ubigeo_id]" id="ubigeo_id" value="<?php echo(isset($passport) ? $passport->ubigeo_id : null) ?>">
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passport.localidad', [
                                                                        'label' => ['text' => 'Localidad '. $this->Functions->validarObligatorio('localidad',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la localidad donde se recolectó la accesión"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.collsite', [
                                                                    'label' => ['text' => 'Referencia '. $this->Functions->validarObligatorio('collsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Información sobre la ubicación  donde se recoleccto la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS UBIGEO -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos Georeferenciales</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS GEOREFERENCIALES -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.latitude', [
                                                                    'label' => ['text' => 'Latitud '. $this->Functions->validarObligatorio('latitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Latitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.longitude', [
                                                                    'label' => ['text' => 'Longitud '. $this->Functions->validarObligatorio('longitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Longitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.elevation', [
                                                                    'label' => ['text' => 'Altitud '. $this->Functions->validarObligatorio('elevation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Elevación del sitio de recolección"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportZoo.coorddatum', [
                                                                    'type'   => 'select',
                                                                    'options'=> $coordenadas,
                                                                    'label'  => __('Tipo Coordenada '. $this->Functions->validarObligatorio('coorddatum',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de datos de sistema de referencia espacial "></i>'),
                                                                    'escape' => false,
                                                                    'class'  => 'form-control',
                                                                    'empty'  => '-- SELECCIONE --'
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.georefmeth', [
                                                                'type'   => 'select',
                                                                'options'=> $georref,
                                                                'label'  => __('Método de Georeferenciación '. $this->Functions->validarObligatorio('georefmeth',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El método de georreferenciación utilizado"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --'
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS GEOREFERENCIALES -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div id="tabla3" class="tab-pane">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Fotografía de la Accesión</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO FOTOGRAFIA DE LA ACCESION -->

                                                    <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new">Seleccionar</span>
                                                                    <span class="fileinput-exists">Cambiar</span>
                                                                    <input type="file" name="imagen_1" accept="image/jpg,image/jpeg,image/png">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new">Seleccionar</span>
                                                                    <span class="fileinput-exists">Cambiar</span>
                                                                    <input type="file" name="imagen_2" accept="image/jpg,image/jpeg,image/png">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new">Seleccionar</span>
                                                                    <span class="fileinput-exists">Cambiar</span>
                                                                    <input type="file" name="imagen_3" accept="image/jpg,image/jpeg,image/png">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new">Seleccionar</span>
                                                                    <span class="fileinput-exists">Cambiar</span>
                                                                    <input type="file" name="imagen_4" accept="image/jpg,image/jpeg,image/png">
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.remarks1', [
                                                                    'label' => ['text' => 'Descripción Imagen 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 1"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.remarks2', [
                                                                    'label' => ['text' => 'Descripción Imagen 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 2"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.remarks3', [
                                                                    'label' => ['text' => 'Descripción Imagen 3' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 3"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.remarks4', [
                                                                    'label' => ['text' => 'Descripción Imagen 4' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 4"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN FOTOGRAFIA DE LA ACCESION -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Ancestros</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO ANCESTROS -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.mancest', [
                                                                    'label' => ['text' => 'Ancestro Materno '. $this->Functions->validarObligatorio('mancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro materno"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.pancest', [
                                                                    'label' => ['text' => 'Ancestro Paterno '. $this->Functions->validarObligatorio('pancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro paterno"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.ancest', [
                                                                    'label' => ['text' => 'Datos Ancestrales '. $this->Functions->validarObligatorio('ancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción que contenga información de los ancestros"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN ANCESTROS -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabla4" class="tab-pane">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos de la Colecta</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DE LA COLECTA -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.collcode', [
                                                                    'label' => ['text' => 'Código del Instituto de Colecta '. $this->Functions->validarObligatorio('collcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación que se le asigna a la institución que hace la colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.collname', [
                                                                    'label' => ['text' => 'Nombre Colector '. $this->Functions->validarObligatorio('collname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la institución que colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.colladdress', [
                                                                    'label' => ['text' => 'Dirección Colector '. $this->Functions->validarObligatorio('colladdress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección de la institución que colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.collmissind', [
                                                                    'label' => ['text' => 'Misión de Colecta '. $this->Functions->validarObligatorio('collmissind',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Se indicara si la colecta ha sido realizada a travéz de un proyecto o convenio"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.sampstat', [
                                                                'type'    => 'select',
                                                                'options' => $cond_biologicas,
                                                                'label'   => __('Condición Biológica(Categorías) '. $this->Functions->validarObligatorio('sampstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Condición biológica"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control select2',
                                                                'empty'   => '-- SELECCIONE --'
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fuente">Fuente <?php echo $this->Functions->validarObligatorio('collsrc',$lista)?></label>
                                                            <select class="form-control b-radio  text-uppercase" name="passportZoo[collsrc]"
                                                                       id="passportzoo-collsrc">
                                                                <option value="">-- SELECCIONE --</option>
                                                                <?php foreach ($fuentes as $fuente): ?>
                                                                    <option value="<?php echo $fuente->id ?>"><?php echo $fuente->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportZoo.collsrcdet', [
                                                                    'type'   => 'select',
                                                                    'options'=> [],
                                                                    'label'  => __('Fuente Detalle '. $this->Functions->validarObligatorio('collsrcdet',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Detalle  de la fuente de recolección"></i>'),
                                                                    'escape' => false,
                                                                    'class'  => 'form-control',
                                                                    'empty'  => '-- SELECCIONE --'
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.localname', [
                                                                    'label' => ['text' => 'Nombre Local '. $this->Functions->validarObligatorio('localname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común con la que se conoce al material recolectado en su zona de colección"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('fecha_recoleccion', [
                                                                    'label' => ['text' => 'Fecha Recolección '. $this->Functions->validarObligatorio('colldate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que fue colectada el material genético"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    // 'readonly' => true,
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.groupethnic', [
                                                                    'label' => ['text' => 'Grupo Etnico '. $this->Functions->validarObligatorio('groupethnic',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del pueblo indigena del lugar de la colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('fecha_nacimiento', [
                                                                    'label' => ['text' => 'Fecha de Nacimiento '. $this->Functions->validarObligatorio('datebirth',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que nació el animal"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    // 'readonly' => true,
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('fecha_deceso', [
                                                                    'label' => ['text' => 'Fecha Deceso '. $this->Functions->validarObligatorio('dateofdec',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que murió el animal"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    // 'readonly' => true,
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.samptype', [
                                                                    'label' => ['text' => 'Tipo de Muestra '. $this->Functions->validarObligatorio('samptype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Parte del animal colectada"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.sampling', [
                                                                    'label' => ['text' => 'Tipo Muestreo '. $this->Functions->validarObligatorio('sampling',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Metodología de muestreo que fue realizado al azar o usando otro método"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.anuspart', [
                                                                    'label' => ['text' => 'Partes útiles del Animal '. $this->Functions->validarObligatorio('anuspart',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Corresponde a las partes útiles del animal que son utilizadas por los pobladores con algún fin especifico"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.uso', [
                                                                    'label' => ['text' => 'Uso del Animal '. $this->Functions->validarObligatorio('uso',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Diferentes usos que se realiza con el animal"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.pathogen', [
                                                                    'label' => ['text' => 'Patógeno '. $this->Functions->validarObligatorio('pathogen',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Presencia de plagas o enfermedades que se presenta en el animal colectado"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.poparea', [
                                                                    'label' => ['text' => 'Área '. $this->Functions->validarObligatorio('poparea',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el metraje donde se encuetra la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DE LA COLECTA -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos del Donante</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DEL DONANTE -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <?php echo $this->Form->control('passportZoo.owname', [
                                                                        'label' => ['text' => 'Criador (Propietario) '. $this->Functions->validarObligatorio('owname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del criador del cual se obtuvo la accesión colectada"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.owaddress', [
                                                                    'label' => ['text' => 'Dirección del Criador '. $this->Functions->validarObligatorio('owaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección delcriador del cual se obtuvo la accesión colectada"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.donorcore', [
                                                                    'label' => ['text' => 'Código del Donante '. $this->Functions->validarObligatorio('donorcore',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.donorname', [
                                                                    'label' => ['text' => 'Nombre del Donante '. $this->Functions->validarObligatorio('donorname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.donaddress', [
                                                                    'label' => ['text' => 'Dirección del Donante '. $this->Functions->validarObligatorio('donaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DEL DONANTE -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabla5" class="tab-pane">
                                    <div class="row">
                                        <!-- INICIO CONDICIONES CLIMATICAS -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.humidity', [
                                                            'label' => ['text' => 'Humedad Ambiente (%) '. $this->Functions->validarObligatorio('humidity',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura de la condición climática"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.temp', [
                                                            'label' => ['text' => 'Temperatura Ambiente (°C) '. $this->Functions->validarObligatorio('temp',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Humedad de la condición climática"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.presure', [
                                                            'label' => ['text' => 'Presión Atmosférica (mmHg) '. $this->Functions->validarObligatorio('presure',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="La presión atmosférica es la fuerza por unidad de área que ejerce el aire sobre la superficie terrestre. "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportZoo.precipitation', [
                                                            'label' => ['text' => 'Precipitación (mm) '. $this->Functions->validarObligatorio('precipitation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Caída de agua sólida o líquida debido a la condensación del vapor sobre la superficie terrestre"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        <!-- FIN CONDICIONES CLIMATICAS -->
                                    </div>
                                </div>

                                <div id="tabla6" class="tab-pane">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Información Legal</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO STATUS LEGAL -->
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.mlsstat', [
                                                                'type'   => 'select',
                                                                'options'=> $sis_multilateral,
                                                                'label'  => __('Sistema Multilateral '. $this->Functions->validarObligatorio('mlsstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El estatus de una  accesión con respecto al sistema multilateral (mls)  (si/no)"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --'
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.patent', [
                                                                    'label' => ['text' => 'Patente '. $this->Functions->validarObligatorio('patent',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El animal está registrado en una patente"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN STATUS LEGAL -->

                                                <!-- INICIO INFORMACIÓN ADICIONAL -->
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.bredcode', [
                                                                    'label' => ['text' => 'Código Instituto de Mejoramiento '. $this->Functions->validarObligatorio('bredcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto en que el material ha sido cruzado"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.bredname', [
                                                                    'label' => ['text' => 'Nombre Instituto de Mejoramiento '. $this->Functions->validarObligatorio('bredname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto (o persona) que crió el material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.duplsite', [
                                                                    'label' => ['text' => 'Ubicación de los Duplicados de Seguridad '. $this->Functions->validarObligatorio('duplsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del centro donde se mantienen duplicados de seguridad de cada accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>


                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.bdna', [
                                                                'type'   => 'select',
                                                                'options'=> $adn,
                                                                'label'  => __('Banco ADN '. $this->Functions->validarObligatorio('bdna',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en el banco de adn"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --'
                                                        ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">

                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportZoo.duplinstname', [
                                                                    'label' => ['text' => 'Nombre del lugar de los Duplicados de Seguridad '. $this->Functions->validarObligatorio('duplinstname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre  del centro donde se mantienen duplicados de seguridad de cada accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                                    </div>

                                                    <!-- INICIO ANOTACIONES -->

                                                    <!-- FIN DATOS ANOTACIONES -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><strong>Anotaciones <?php echo $this->Functions->validarObligatorio('passportZoo.remarks',$lista). '  <i class="fa fa-info-circle" data-toggle="tooltip" title="Para añadir notas o para completar datos faltantes de la accesión"></i> ' ?></strong></h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportZoo.remarks', [
                                                                    'label'  => ['text' => ''],
                                                                    'escape' => false,
                                                                    'class'  => 'form-control',
                                                                    'rows'    => 5,
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="horizontal-space"></div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnPassportZoo">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/datos-pasaporte', true) ?>"
                           class="btn btn-default"> CANCELAR
                        </a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#passportzoo-eea, #passportzoo-sampstat, #passportzoo-eeaproc, #coleccion, #especie_idx, #country_id").select2();', ['block' => 'script']);

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('$("#fecha-ingreso, #fecha-nacimiento, #fecha-deceso, #fecha-recoleccion").datepicker({autoclose: true, todayBtn: true, todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

?>
