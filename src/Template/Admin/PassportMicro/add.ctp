
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportMicro', 'action' => 'index']);
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
                <?php echo $this->Form->create($passportMicro, [
                    'url' => ['controller' => 'PassportMicro', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_passportmicro",
                    'enctype' => 'multipart/form-data',
                    // 'novalidate',
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
                                <div id="tabla1" class="tab-pane in active">
                                    <div class="row">

                                        <?php echo $this->Form->control('passport_validation', ['type' => 'hidden', 'value' => $passpor_validation['validation'] ]) ?>
                                        <?php echo $this->Form->control('passmicro_validation', ['type' => 'hidden', 'value' => $passmicro_validation['validation'] ]) ?>

                                        <!-- INICIO DATOS PRINCIPALES -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passport.instcode', [
                                                                'label' => ['text' => 'Código del Instituto (COD. FAO) '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto donde se conserva la accesión - Código FAO"></i>'],
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
                                                                'label' => ['text' => 'Nombre de la Accesión '. $this->Functions->validarObligatorio('accname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Designación regitrada o formal, que se da a la accesión"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>



                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.subtype',
                                                            ['type' => 'select',
                                                            'options' => $tipo_recursos,
                                                            'label' => __('SubTipo de Recurso ' . $this->Functions->validarObligatorio('subtype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Subtipo de recurso"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>
                                    </div>
                                    <div class="row">

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.eea',
                                                            ['type' => 'select',
                                                            'options' => $station,
                                                            'label' => __('Estación Experimental '. $this->Functions->validarObligatorio('station_current_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental donde se conserva la accesión"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control select2',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.eeaproc',
                                                            ['type' => 'select',
                                                            'options' => $station,
                                                            'label' => __('Estación Experimental de Procedencia '. $this->Functions->validarObligatorio('station_origin_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental de procedencia"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control select2',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.subtaxa', [
                                                                'label' => ['text' => 'SubTaxones '. $this->Functions->validarObligatorio('subtaxa',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Proveer algún identificador taxonomico adicional"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.subtauthor', [
                                                                'label' => ['text' => 'Autoría de los SubTaxones '. $this->Functions->validarObligatorio('subtauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre(s) del autor(es) del subtaxon"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>

                                    </div>
                                    <div class="row">
                                            <!-- INICIO CAMPOS DE LA ESPECIE -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('coleccion_micro', [
                                                        'label'   => 'Colección '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                        'escape'  => false,
                                                        'type'    => 'select',
                                                        'id'      => 'coleccion',
                                                        'class'   => 'form-control select2',
                                                        'options' => $colecciones,
                                                        'empty'   => '-- SELECCIONE --',
                                                ]) ?>
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
                                                            'label'    => ['text' => 'Nombre Común '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>'],
                                                            'escape' => false,
                                                            'class'    => 'form-control',
                                                            'disabled' => true,
                                                ]); ?>
                                            </div>
                                            <!-- FIN CAMPOS DE LA ESPECIE -->

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.collnumb', [
                                                                'label' => ['text' => 'Código de Colecta'. $this->Functions->validarObligatorio('collnumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto que recolecta la muestra"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.spauthor', [
                                                                'label' => ['text' => 'Autoría de la Especie '. $this->Functions->validarObligatorio('spauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el nombre(s) del autor(es) del nombre especifico"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.strain', [
                                                                'label' => ['text' => 'Nombre de la Cepa '. $this->Functions->validarObligatorio('strain',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el nombre de la cepa"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.storage',
                                                            ['type' => 'select',
                                                            'options' => $tipo_conservacion,
                                                            'label' => __('Tipo Conservación '. $this->Functions->validarObligatorio('storage',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de preservación del material "></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('fecha_aquisicion', [
                                                                'label' => ['text' => 'Fecha Adquisición '. $this->Functions->validarObligatorio('acqdate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que se incorporo la accesión a la colección"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                // 'readonly' => true
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
                                                    <?php echo $this->Form->control('passportMicro.availability',
                                                            ['type' => 'select',
                                                            'options' => $disp_accesion,
                                                            'label' => __('Disponibilidad de la Accesión '. $this->Functions->validarObligatorio('availability',$lista)  . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad del Lote de la accesión "></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>
                                            </div>
                                        <!-- FIN DATOS PRINCIPALES -->
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
                                                                    'label'  => __('País Origen '. $this->Functions->validarObligatorio('country_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Información sobre la ubicación del país donde se recolectó la accesión"></i>'),
                                                                    'escape' => false,
                                                                    'class'  => 'form-control select2',
                                                                    'empty'  => '-- SELECCIONE --',
                                                                    'id'     => 'country_id',
                                                            ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="departamento">Departamento</label>
                                                            <select class="form-control b-radio text-uppercase" name="departamento" id="departamento" disabled="true">
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
                                                                    'label'   => __('Provincia' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del provincia donde se recolectó la accesión"></i>'),
                                                                    'escape' => false,
                                                                    'class'   => 'form-control',
                                                                    'empty'  => '-- SELECCIONE --',
                                                                    'disabled'=> true,
                                                            ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('distrito', [
                                                                    'type'    => 'select',
                                                                    'options' => [],
                                                                    'label'   => __('Distrito' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del distrito donde se recolectó la accesión"></i>'),
                                                                    'escape' => false,
                                                                    'class'   => 'form-control',
                                                                    'empty'  => '-- SELECCIONE --',
                                                                    'disabled'=> true,
                                                            ]); ?>
                                                        <input type="hidden" name="passport[ubigeo_id]" id="ubigeo_id" value="<?php echo(isset($passport) ? $passport->ubigeo_id : null) ?>">
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passport.localidad', [
                                                                        'label' => ['text' => 'Localidad '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la localidad donde se recolectó la accesión"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collsite', [
                                                                        'label' => ['text' => 'Ubicación del Sitio '. $this->Functions->validarObligatorio('collsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Información sobre la ubicación del pais  donde se recoleccto la accesión"></i>'],
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
                                                            <?php echo $this->Form->control('passportMicro.latitude', [
                                                                        'label' => ['text' => 'Latitud '. $this->Functions->validarObligatorio('latitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Latitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.longitude', [
                                                                        'label' => ['text' => 'Longitud '. $this->Functions->validarObligatorio('longitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Longitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.elevation', [
                                                                        'label' => ['text' => 'Elevación '. $this->Functions->validarObligatorio('elevation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Elevación del sitio de recolección"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.coorddatum',
                                                                    ['type' => 'select',
                                                                    'options' => $coordenadas,
                                                                    'label' => __('Tipo Coordenada '. $this->Functions->validarObligatorio('coorddatum',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de datos de sistema de referencia espacial "></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --'
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.georefmeth',
                                                                    ['type' => 'select',
                                                                    'options' => $georref,
                                                                    'label' => __('Método de Georeferenciación '. $this->Functions->validarObligatorio('georefmeth',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El método de georreferenciación utilizado"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.coorduncert', [
                                                                        'label' => ['text' => 'Incertidumbre de Coordenadas '. $this->Functions->validarObligatorio('coorduncert',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Incertidumbre asociada a las coordenadas en metros."></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
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
                                                            <?php echo $this->Form->control('passportMicro.remarks1', [
                                                                        'label' => ['text' => 'Descripción Imagen 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 1"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.remarks2', [
                                                                        'label' => ['text' => 'Descripción Imagen 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 2"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.remarks3', [
                                                                        'label' => ['text' => 'Descripción Imagen 3' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 3"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.remarks4', [
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
                                                <!-- INICIO ANCESTROS DE LA ACCESION -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.mancest', [
                                                                        'label' => ['text' => 'Ancestro Materno '. $this->Functions->validarObligatorio('mancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro materno"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.pancest', [
                                                                        'label' => ['text' => 'Ancestro Paterno '. $this->Functions->validarObligatorio('pancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro paterno"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.ancest', [
                                                                        'label' => ['text' => 'Datos Ancestrales '. $this->Functions->validarObligatorio('ancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción que contenga información de los ancestros"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                <!-- FIN ANCESTROS DE LA ACCESION -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabla4" class="tab-pane">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos de Colecta</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DE COLECTA -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collcode', [
                                                                        'label' => ['text' => 'Código del Instituto de Colecta '. $this->Functions->validarObligatorio('collcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación que se le asigna a la institución que hace la colecta"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collname', [
                                                                        'label' => ['text' => 'Nombre de Colector '. $this->Functions->validarObligatorio('collname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto que recolecta la muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collinstaddress', [
                                                                        'label' => ['text' => 'Dirección de Colector '. $this->Functions->validarObligatorio('collinstaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del instituto que recoge la muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collmissind', [
                                                                        'label' => ['text' => 'Misión de Colecta '. $this->Functions->validarObligatorio('collmissind',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificador de la misión de recolección utilizada por el instituto de recolección"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fuente">Fuente <?php  echo  $this->Functions->validarObligatorio('collsrc',$lista); ?></label>
                                                            <select class="form-control b-radio text-uppercase" name="passportMicro[collsrc]"
                                                                       id="passportmicro-collsrc">
                                                                <option value="">-- SELECCIONE --</option>
                                                                <?php foreach ($fuentes as $fuente): ?>
                                                                    <option value="<?php echo $fuente->id ?>"><?php echo $fuente->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.collsrcdet',
                                                                    ['type' => 'select',
                                                                    'options' => [],
                                                                    'label' => __('Fuente Detalle '. $this->Functions->validarObligatorio('collsrcdet',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Detalle  de la fuente de recolección"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --'
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.isosrc',
                                                                    ['type' => 'select',
                                                                    'options' => $fuente_aislam,
                                                                    'label' => __('Fuente de Aislamiento '. $this->Functions->validarObligatorio('isosrc',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el tipo de recurso del que se aislo el microorganismo o especie asociada"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.sampstat', [
                                                                    'type'    => 'select',
                                                                    'options' => $cond_biologicas,
                                                                    'label'   => __('Condición Biológica (Categorías) '. $this->Functions->validarObligatorio('sampstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Condición biológica"></i>'),
                                                                    'escape'  => false,
                                                                    'class'   => 'form-control',
                                                                    'empty'   => '-- SELECCIONE --'
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('fecha_recoleccion', [
                                                                        'label' => ['text' => 'Fecha de Recolección '. $this->Functions->validarObligatorio('colldate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de recolección de la muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                                        // 'readonly' => true,
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.localname', [
                                                                        'label' => ['text' => 'Nombre Local del Material '. $this->Functions->validarObligatorio('localname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común con la que se conoce al material recolectado en su zona de colección"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.groupethnic', [
                                                                        'label' => ['text' => 'Grupo Etnico '. $this->Functions->validarObligatorio('groupethnic',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del pueblo indigena del lugar de la colecta"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.samptype', [
                                                                        'label' => ['text' => 'Tipo de Muestra '. $this->Functions->validarObligatorio('samptype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de propalugo  colectado"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.sampsize', [
                                                                        'label' => ['text' => 'Nro. de Individuos Muestreados '. $this->Functions->validarObligatorio('sampsize',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de individuos muestreados durante la colecta"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control onlynumbers',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.sampling', [
                                                                        'label' => ['text' => 'Tipo de Muestreo '. $this->Functions->validarObligatorio('sampling',$lista)  . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Metodología de muestreo"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.uso', [
                                                                        'label' => ['text' => 'Uso de microorganismo '. $this->Functions->validarObligatorio('uso',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Diferentes usos  que se realiza con el microorganismo o especie asociada"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DE COLECTA -->
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
                                                            <?php echo $this->Form->control('passportMicro.donorcore', [
                                                                        'label' => ['text' => 'Código del Donante '. $this->Functions->validarObligatorio('donorcore',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto donante"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.donorname', [
                                                                        'label' => ['text' => 'Nombre del Donante '. $this->Functions->validarObligatorio('donorname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del donante"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.donaddress', [
                                                                        'label' => ['text' => 'Dirección del Donante '. $this->Functions->validarObligatorio('donaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del donante"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.donornumb', [
                                                                        'label' => ['text' => 'Código de Accesión del Donante '. $this->Functions->validarObligatorio('donornumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código asignado a una accesión por el donante"></i>'],
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

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Condiciones Climáticas</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO CONDICIONES CLIMATICAS -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.humidity', [
                                                                        'label' => ['text' => 'Humedad Ambiente (%) '. $this->Functions->validarObligatorio('humidity',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura de la condición climática"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.temp', [
                                                                        'label' => ['text' => 'Temperatura Ambiente (°C) '. $this->Functions->validarObligatorio('temp',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Humedad de la condición climática"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.presure', [
                                                                        'label' => ['text' => 'Presión Atmosférica (mmHg) '. $this->Functions->validarObligatorio('presure',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="La presión atmosférica es la fuerza por unidad de área que ejerce el aire sobre la superficie terrestre. "></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.precipitation', [
                                                                        'label' => ['text' => 'Precipitación (mm) '. $this->Functions->validarObligatorio('precipitation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Caída de agua sólida o líquida debido a la condensación del vapor sobre la superficie terrestre"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                <!-- FIN CONDICIONES CLIMATICAS -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos del Suelo</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DEL SUELO -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soiltext', [
                                                                        'label'   => ['text' => 'Textura del Suelo '. $this->Functions->validarObligatorio('soiltext',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Forma que se encuentra distribuido el suelos"></i>'],
                                                                        'escape' => false,
                                                                        'class'   => 'form-control select2',
                                                                        'type'    => 'select',
                                                                        'options' => $textura_suelo,
                                                                        'empty'  => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilped',
                                                                    ['type' => 'select',
                                                                    'options' => $suelo_pedrego,
                                                                    'label' => __('Pedregocidad del suelo '. $this->Functions->validarObligatorio('soilped',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de pedregosidad"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilcol',
                                                                    ['type' => 'select',
                                                                    'options' => $suelo_color,
                                                                    'label' => __('Color del suelo '. $this->Functions->validarObligatorio('soilcol',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Color del suelo"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control select2',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilph',
                                                                    ['type' => 'select',
                                                                    'options' => $suelo_ph,
                                                                    'label' => __('pH del suelo '. $this->Functions->validarObligatorio('soilph',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Acides o la alcalinidad del suelo"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilfis',
                                                                    ['type' => 'select',
                                                                    'options' => $fisiografia,
                                                                    'label' => __('Fisiografía '. $this->Functions->validarObligatorio('soilfis',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de aspecto fisográfico del suelo"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilrel', [
                                                                        'label' => ['text' => 'Relieve del Suelo '. $this->Functions->validarObligatorio('soilrel',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el tipo de relieve del suelo"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soiltemp', [
                                                                        'label' => ['text' => 'Temperatura del Suelo '. $this->Functions->validarObligatorio('soiltemp',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Grados centigrado dentro del suelo"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.soilodor', [
                                                                        'label' => ['text' => 'Olor del Suelo '. $this->Functions->validarObligatorio('soilodor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Sensación olfativa detectada en la muestra del suelo"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DEL SUELO -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos del Agua</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DEL AGUA -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.watersrc',
                                                                    ['type' => 'select',
                                                                    'options' => $fuente_agua,
                                                                    'label' => __('Fuente de Agua '. $this->Functions->validarObligatorio('watersrc',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fuente de recolección  del material"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.watercol',
                                                                    ['type' => 'select',
                                                                    'options' => $color_agua,
                                                                    'label' => __('Color del Agua '. $this->Functions->validarObligatorio('watercol',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El color en el agua resulta de la presencia en solución de diferentes sustancias como iones metálicos naturales, humus y materia orgánica disuelta."></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.watertemp', [
                                                                        'label' => ['text' => 'Temperatura del Agua '. $this->Functions->validarObligatorio('watertemp',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Grados centigrado dentro del agua"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.waterodor',
                                                                    ['type' => 'select',
                                                                    'options' => $olor_agua,
                                                                    'label' => __('Olor del Agua '. $this->Functions->validarObligatorio('waterodor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El olor es la sensación resultante de la recepción de un estímulo por el sistema sensorial "></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.waterph',
                                                                    ['type' => 'select',
                                                                    'options' => $agua_ph,
                                                                    'label' => __('pH del Agua '. $this->Functions->validarObligatorio('waterph',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Acides o la alcalinidad del agua"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.waterturb', [
                                                                        'label' => ['text' => 'Turbidez '. $this->Functions->validarObligatorio('waterturb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dispersión de luz por particula en suspención de agua (ntu: unidades turbidez nefelometricas)"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DEL AGUA -->
                                            </div>
                                        </div>
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
                                                <!-- INICIO DATOS DEL ORGANISMO ASOCIADO -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.asocgenus', [
                                                                        'label' => ['text' => 'Género Especie Asociada '. $this->Functions->validarObligatorio('asocgenus',$lista)  . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Género de la especie asociada"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.asocspecies', [
                                                                        'label' => ['text' => 'Especie Asociada '. $this->Functions->validarObligatorio('asocspecies',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Especie asociada"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.asoclocalname', [
                                                                        'label' => ['text' => 'Nombre Local - Especie Asociada '. $this->Functions->validarObligatorio('asoclocalname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre local de la especie asociada"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                <!-- FIN DATOS DEL ORGANISMO ASOCIADO -->

                                                <!-- INICIO STATUS LEGAL -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.mlsstat',
                                                                    ['type' => 'select',
                                                                    'options' => $sis_multilateral,
                                                                    'label' => __('Sistema Multilateral '. $this->Functions->validarObligatorio('mlsstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El estatus de una  accesión con respecto al sistema multilateral (mls) "></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.patent', [
                                                                        'label' => ['text' => 'Patente '. $this->Functions->validarObligatorio('patent',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El microorganismo está registrado en una patente"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.straincode', [
                                                                        'label' => ['text' => 'Código del Instituto '. $this->Functions->validarObligatorio('straincode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto si  produce la muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.strainname', [
                                                                        'label' => ['text' => 'Nombre del Instituto '. $this->Functions->validarObligatorio('strainname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto (o persona) si  produce la muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.duplinstname', [
                                                                        'label' => ['text' => 'Nombre lugar - Duplicados de Seguridad '. $this->Functions->validarObligatorio('duplinstname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del centro donde se mantienen duplicados de seguridad de cada accesión"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.duplsite', [
                                                                        'label' => ['text' => 'Ubicación - Duplicados de Seguridad '. $this->Functions->validarObligatorio('duplsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del centro donde se mantienen duplicados de seguridad de cada accesión"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.antag', [
                                                                        'label' => ['text' => 'Antagonistas '. $this->Functions->validarObligatorio('antag',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del microorganismo que no permite el crecimiento de la accesión aislada "></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.biolrisk',
                                                                    ['type' => 'select',
                                                                    'options' => $riesgo_bio,
                                                                    'label' => __('Riesgo Biológico '. $this->Functions->validarObligatorio('biolrisk',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar al grupo de riesgo que pertenece"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.samphist', [
                                                                        'label' => ['text' => 'Historia de la Accesión '. $this->Functions->validarObligatorio('samphist',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del movimiento de la accesión entre instituciones"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.asilmed', [
                                                                        'label' => ['text' => 'Medio de Aislamiento '. $this->Functions->validarObligatorio('asilmed',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio de cultivo que se va aislar la accesión"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.micro',
                                                                    ['type' => 'select',
                                                                    'options' => $micro,
                                                                    'label' => __('Banco Micro '. $this->Functions->validarObligatorio('micro',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se cuentra almacenada en el banco de microorganismos"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportMicro.bdna',
                                                                    ['type' => 'select',
                                                                    'options' => $adn,
                                                                    'label' => __('Banco ADN '. $this->Functions->validarObligatorio('bdna',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en el banco de adn"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                    </div>
                                                    <!-- INICIO ANOTACIONES -->

                                                    <!-- FIN DATOS ANOTACIONES -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><strong>Anotaciones <?php echo $this->Functions->validarObligatorio('passportMicro.remarks',$lista). '  <i class="fa fa-info-circle" data-toggle="tooltip" title="Para añadir notas o para completar datos faltantes de la accesión"></i> ' ?></strong></h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                    <?php echo $this->Form->control('passportMicro.remarks', [
                                                            'label'  => ['text' => ''],
                                                            'escape' => false,
                                                            'class'  => 'form-control',
                                                            'rows'   => 5
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnPassportMicro">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/datos-pasaporte', true) ?>"
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
$this->Html->scriptBlock('$("#passportmicro-eea, #passportmicro-eeaproc, #coleccion, #especie_idx, #country_id, #passportmicro-soilcol, #passportmicro-soiltext").select2();', ['block' => 'script']);


$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('$("#fecha-aquisicion, #fecha-recoleccion").datepicker({autoclose: true, todayBtn: true, todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

?>