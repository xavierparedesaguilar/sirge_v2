
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> Fitogenético - Editar</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportFito', 'action' => 'index']);
        $this->Html->addCrumb($passport->accenumb, ['controller' => 'PassportFito', 'action' => 'edit', 'id' => $passportFito->id]);
        $this->Html->addCrumb('Editar');

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
                <?php echo $this->Form->create($passportFito, [
                    'url' => ['controller' => 'PassportFito', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id' => "form_passportfito",
                    'enctype' => 'multipart/form-data',
                    'novalidate',
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
                                        <?php echo $this->Form->control('passfito_validation', ['type' => 'hidden', 'value' => $passfito_validation['validation'] ]) ?>

                                        <!-- INICIO DATOS PRINCIPALES -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.accenumb', [
                                                            'label' => ['text' => 'Código de Accesión (COD. PER) '. $this->Functions->validarObligatorio('accenumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación exclusivo de las accesiones : Código PER"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passport->accenumb,
                                                            'disabled' => true,
															
                                                ]);	?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.instcode', [
                                                            'label' => ['text' => 'Código del Instituto (COD. FAO) '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto donde se conserva la accesión - Código FAO"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passport->instcode,
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.accname', [
                                                            'label' => ['text' => 'Nombre de la Accesión '. $this->Functions->validarObligatorio('accname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Designación registrada o formal que se da a la accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passport->accname,
                                                ]); ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.othenumb', [
                                                            'label' => ['text' => 'Otro Código Accesión '. $this->Functions->validarObligatorio('othenumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificación de esta accesión que se haya encontrado en otras colecciones -  (cod interno)"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passport->othenumb,
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <!-- Inicio de station de origen -->

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.collnumb', [
                                                            'label' => ['text' => 'Código de Colecta '. $this->Functions->validarObligatorio('collnumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código asignado por el recolector de la muestra"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passportFito->collnumb,
                                                ]); ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('coleccion', [
                                                        'class'   => 'form-control select2',
                                                        'label'   => 'Colección '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                        'escape'  => false,
                                                        'type'    => 'select',
                                                        'options' => $colecciones,
                                                        'default' => empty($especies->collection_id)? '' : $especies->collection_id,
                                                        'empty'   => '-- SELECCIONE --',
                                                ]) ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.specie_id', [
                                                        'type'    => 'select',
                                                        'options' => $especie_lista,
                                                        'default' => $passport->specie_id,
                                                        'id'      => 'especie_idx',
                                                        'label'   => __('Nombre Científico  '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre conformado por el género y la especie"></i>'),
                                                        'escape' => false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('nombre_comun', [
                                                            'label'    => ['text' => 'Nombre Común '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>'],
                                                            'escape' => false,
                                                            'class'    => 'form-control',
                                                            'value'    => empty($especies->cropname)? '' : mb_strtoupper($especies->cropname,'UTF-8'),
                                                            'disabled' => true,
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.subtype', [
                                                        'type'   => 'select',
                                                        'options'=> $tipo_recursos,
                                                        'default'=> $passportFito->subtype,
                                                        'label'  => __('SubTipo de Recurso '. $this->Functions->validarObligatorio('subtype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Subtipo de recurso"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.spauthor', [
                                                            'label' => ['text' => 'Autoría de la Especie '. $this->Functions->validarObligatorio('spauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el nombre del autor de la especie"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passportFito->spauthor,
                                                ]); ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.subtaxa', [
                                                            'label' => ['text' => 'Subtaxones '. $this->Functions->validarObligatorio('subtaxa',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Proveer algún identificador taxonomico adicional"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passportFito->subtaxa,
                                                ]); ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.subtauthor', [
                                                            'label' => ['text' => 'Autoría de los Subtaxones '. $this->Functions->validarObligatorio('subtauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre(s) del autor(es) del subtaxon"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $passportFito->subtauthor,
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.storage', [
                                                        'type'   => 'select',
                                                        'options'=> $tipo_conservacion,
                                                        'default'=> $passportFito->storage,
                                                        'label'  => __('Tipo Conservación '. $this->Functions->validarObligatorio('storage',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de almacenamientos del material"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('fecha_aquisicion', [
                                                            'label'   => ['text' => 'Fecha Adquisición '. $this->Functions->validarObligatorio('acqdate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que se incorporo la accesión a la colección"></i>'],
                                                            'escape' => false,
                                                            'class'   => 'form-control',
                                                            'value'   => $passportFito->acqdate,
                                                            'readonly'=> true
                                                ]); ?>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.station_current_id', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'default'=> $passport->station_current_id,
                                                        'label'  => __('Estación Experimental '. $this->Functions->validarObligatorio('station_current_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental donde se conserva la accesión"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.station_origin_id', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'default'=> $passport->station_origin_id,
                                                        'label'  => __('Estación Experimental de Procedencia '. $this->Functions->validarObligatorio('station_origin_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la estación experimental de procedencia"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.promissory', [
                                                        'type'    => 'select',
                                                        'options' => $lista_promisoria,
                                                        'default' => $passport->promissory,
                                                        'label'   => __('Promisoria '. $this->Functions->validarObligatorio('promissory',$lista) ),
                                                        'escape' => false,
                                                        'class'   => 'form-control',
                                                ]); ?>
                                            </div>
                                            <!-- Fin de station de origen -->
                                            <!-- Inicio de los campos de especie -->
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passportFito.availability', [
                                                        'type'   => 'select',
                                                        'options'=> $disp_accesion,
                                                        'default'=> $passportFito->availability,
                                                        'label'  => __('Disponibilidad de la Accesión '. $this->Functions->validarObligatorio('availability',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad de la accesión (si/no)"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control',
                                                        'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <!--
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <?php /*echo $this->Form->control('genus', [
                                                                'label' => ['text' => 'Género Especie' ],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <?php echo $this->Form->control('cropname', [
                                                                'label' => ['text' => 'Nombre Comun Especie' ],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]);*/ ?>
                                                </div>
                                            </div>
                                            -->
                                            <!-- Fin de los campos de especie -->
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
                                                <!-- INICIO DATOS DEL UBIGEO -->
                                                    <!-- Inicio de los id de pais y ubbigeo -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passport.country_id', [
                                                                'type'   => 'select',
                                                                'options'=> $paises,
                                                                'default'=> $passport->country_id,
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
                                                            <select class="form-control b-radio text-uppercase" name="departamento" id="departamento" <?php echo ($passport->country_id == 173)? "" : "disabled"; ?> >
                                                                <option value="">-- SELECCIONE --</option>
                                                                <?php foreach ($departamento as $region): ?>
                                                                    <option value="<?php echo $region->cod_dep ?>" <?php echo (!empty($ubigeo_descrip) && $ubigeo_descrip->cod_dep == $region->cod_dep) ? 'selected' : ''; ?> >
                                                                        <?php echo $region->nombre ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('provincia', [
                                                                'type'    => 'select',
                                                                'options' => $provincias,
                                                                'default' => (empty($provincia_id))? '' : $provincia_id->id,
                                                                'label'   => __('Provincia ' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del provincia donde se recolectó la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                                'disabled'=> ($passport->country_id == 173)? false : true,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('distrito ', [
                                                                'type'    => 'select',
                                                                'options' => $distritos,
                                                                'default' => $passport->ubigeo_id,
                                                                'label'   => __('Distrito' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del distrito donde se recolectó la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                                'disabled'=> ($passport->country_id == 173)? false : true,
                                                        ]); ?>
                                                        <input type="hidden" name="passport[ubigeo_id]" id="ubigeo_id" value="<?php echo(isset($passport) ? $passport->ubigeo_id : null) ?>">
                                                    </div>
                                                    <!-- Fin de los id de pais y ubbigeo -->
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passport.localidad', [
                                                                    'label' => ['text' => 'Localidad '. $this->Functions->validarObligatorio('localidad',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la localidad donde se recolectó la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passport->localidad,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collsite', [
                                                                    'label' => ['text' => 'Ubicación del Sitio '. $this->Functions->validarObligatorio('collsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Información sobre la ubicación del lugar donde se recolectó la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->collsite,
                                                        ]); ?>
                                                    </div>
                                                <!-- INICIO DATOS DEL UBIGEO -->
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
                                                        <?php echo $this->Form->control('passportFito.latitude', [
                                                                    'label' => ['text' => 'Latitud '. $this->Functions->validarObligatorio('latitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Latitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->latitude,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.longitude', [
                                                                    'label' => ['text' => 'Longitud '. $this->Functions->validarObligatorio('longitude',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Longitud del sitio de recolección en coordenadas decimales"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->longitude,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.elevation', [
                                                                    'label' => ['text' => 'Elevación '.$this->Functions->validarObligatorio('elevation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Elevación del sitio de recolección"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->elevation,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.coorddatum', [
                                                                'type'   => 'select',
                                                                'options'=> $coordenadas,
                                                                'default'=> $passportFito->coorddatum,
                                                                'label'  => __('Tipo de Coordenadas '. $this->Functions->validarObligatorio('coorddatum',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de datos de sistema de referencia espacial"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.georefmeth', [
                                                                'type'   => 'select',
                                                                'options'=> $georref,
                                                                'default'=> $passportFito->georefmeth,
                                                                'label'  => __('Método de Georeferenciación '. $this->Functions->validarObligatorio('georefmeth',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El método de georreferenciación utilizado"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.coorduncert', [
                                                                    'label' => ['text' => 'Incertidumbre de Coordenadas '. $this->Functions->validarObligatorio('coorduncert',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Incertidumbre asociada a las coordenadas en metros."></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->coorduncert,
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
                                                <!-- INICIO DATOS FOTOGRAFIA DE LA ACCESIÓN -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <?php
                                                                    if($passportFito->accimag1 != NULL || $passportFito->accimag1 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$passportFito->accimag1.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                                ?>
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
                                                                <?php
                                                                    if($passportFito->accimag2 != NULL || $passportFito->accimag2 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$passportFito->accimag2.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                                ?>
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
                                                                <?php
                                                                    if($passportFito->accimag3 != NULL || $passportFito->accimag3 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$passportFito->accimag3.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                                ?>
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
                                                                <?php
                                                                    if($passportFito->accimag4 != NULL || $passportFito->accimag4 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$passportFito->accimag4.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                                ?>
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
                                                        <?php echo $this->Form->control('passportFito.remarks1', [
                                                                    'label' => ['text' => 'Descripción Imagen 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 1"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->remarks1,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks2', [
                                                                    'label' => ['text' => 'Descripción Imagen 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 2"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->remarks2,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks3', [
                                                                    'label' => ['text' => 'Descripción Imagen 3' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 3"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->remarks3,
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks4', [
                                                                    'label' => ['text' => 'Descripción Imagen 4' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción imagen 4"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->remarks4,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS FOTOGRAFIA DE LA ACCESIÓN -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Ancestros de la Accesión</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS ANCESTROS DE LA ACCESIÓN -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('passportFito.mancest', [
                                                                        'label' => ['text' => 'Ancestro Materno '. $this->Functions->validarObligatorio('mancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro materno"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                                        'value' => $passportFito->mancest,
                                                            ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.pancest', [
                                                                    'label' => ['text' => 'Ancestro Paterno '. $this->Functions->validarObligatorio('pancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de la accesión del ancestro paterno"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->pancest,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.ancest', [
                                                                    'label' => ['text' => 'Datos Ancestrales '. $this->Functions->validarObligatorio('ancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción que contenga información de los ancestros"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->ancest,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS ANCESTROS DE LA ACCESIÓN -->
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
                                                <!-- INICIO DATOS FOTOGRAFIA DE COLECTA -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collcode', [
                                                                    'label' => ['text' => 'Código del Instituto de Colecta '. $this->Functions->validarObligatorio('collcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto que recolecta la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->collcode,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collname', [
                                                                    'label' => ['text' => 'Nombre del Colector '. $this->Functions->validarObligatorio('collname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto que recolecta la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->collname,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collinstaddress', [
                                                                    'label' => ['text' => 'Dirección del Colector '. $this->Functions->validarObligatorio('collinstaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del instituto que recoge la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->collinstaddress,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collmissind', [
                                                                    'label' => ['text' => 'Misión de Colecta '. $this->Functions->validarObligatorio('collmissind',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificador de la misión de recolección utilizada por el instituto de recolección"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->collmissind,
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.poparea', [
                                                                    'label' => ['text' => 'Área de la Colecta '. $this->Functions->validarObligatorio('poparea',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el area donde se encuetra la muestra (m2)"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->poparea,
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fuente">Fuente <?php echo  $this->Functions->validarObligatorio('collsrc',$lista) ?></label>
                                                            <select class="form-control b-radio text-uppercase" name="passportFito[collsrc]"
                                                                       id="passportfito-collsrc">
                                                                <option value="">-- SELECCIONE --</option>
                                                                <?php foreach ($fuentes as $fuente): ?>
                                                                    <option value="<?php echo $fuente->id ?>" <?php echo ($passportFito->collsrc == $fuente->id) ? 'selected' : ''; ?> >
                                                                        <?php echo $fuente->name ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collsrcdet', [
                                                                'type'  => 'select',
                                                                'options'=> $fuente_detalle,
                                                                'default'=> $passportFito->collsrcdet,
                                                                'label'  => __('Fuente Detalle ' .$this->Functions->validarObligatorio('collsrcdet',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Detalle  de la fuente de recolección"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.sampstat', [
                                                                'type'   => 'select',
                                                                'options'=> $cond_biologicas,
                                                                'default'=> $passportFito->sampstat,
                                                                'label'  => __('Condición Biológica(Categorías) ' .$this->Functions->validarObligatorio('sampstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Condición biológica"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control select2',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('fecha_recoleccion', [
                                                                    'label' => ['text' => 'Fecha de Recolección ' .$this->Functions->validarObligatorio('colldate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de recolección de la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->colldate,
                                                                    'readonly'=> true
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.localname', [
                                                                    'label' => ['text' => 'Nombre Local del Material ' .$this->Functions->validarObligatorio('localname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común con la que se conoce al material recolectado en su zona de colección"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->localname,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.groupethnic', [
                                                                    'label' => ['text' => 'Grupo Étnico ' .$this->Functions->validarObligatorio('groupethnic',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del pueblo indigena del lugar de la colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->groupethnic,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.samptype', [
                                                                    'label'   => ['text' => 'Tipo de Muestra ' .$this->Functions->validarObligatorio('samptype',$lista)  . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Parte de la planta colectada"></i>'],
                                                                    'escape' => false,
                                                                    'class'   => 'form-control',
                                                                    'default' => $passportFito->samptype,
                                                                    'type'    => 'select',
                                                                    'options' => $tipo_muestra,
                                                                    'empty'   => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.sampsize', [
                                                                    'label' => ['text' => 'Número de Plantas Muestreadas ' .$this->Functions->validarObligatorio('sampsize',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de plantas muestreadas"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control onlynumbers',
                                                                    'value' => $passportFito->sampsize,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.sampling', [
                                                                    'label' => ['text' => 'Tipo de Muestreo ' .$this->Functions->validarObligatorio('sampling',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si el muestreo fue realizado al azar o usando otro método"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->sampling,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.plauspart', [
                                                                'type'   => 'select',
                                                                'options'=> $planta_util,
                                                                'default'=> $passportFito->plauspart,
                                                                'label'  => __('Parte Útil de la Planta ' .$this->Functions->validarObligatorio('plauspart',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Partes útiles de la planta que son utilizadas por los pobladores"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.uso', [
                                                                'type'   => 'select',
                                                                'options'=> $planta_uso,
                                                                'default'=> $passportFito->uso,
                                                                'label'  => __('Uso de la Planta ' .$this->Functions->validarObligatorio('uso',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Usos  que se realiza con la planta"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.pathogen', [
                                                                    'label' => ['text' => 'Patógeno ' .$this->Functions->validarObligatorio('pathogen',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Presencia de plagas o enfermedades que presente en la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->pathogen,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS FOTOGRAFIA DE COLECTA -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Datos de Donante</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <!-- INICIO DATOS DEL DONANTE -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.donorcore', [
                                                                    'label' => ['text' => 'Código del Donante ' .$this->Functions->validarObligatorio('donorcore',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->donorcore,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.donorname', [
                                                                    'label' => ['text' => 'Nombre del Donante ' .$this->Functions->validarObligatorio('donorname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->donorname,
                                                        ]); ?>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.donaddress', [
                                                                    'label' => ['text' => 'Dirección del Donante ' .$this->Functions->validarObligatorio('donaddress',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->donaddress,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.donornumb', [
                                                                    'label' => ['text' => 'Código de Accesión del Donante ' .$this->Functions->validarObligatorio('donornumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código  asignado a una accesión por el donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->donornumb,
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
                                                <!-- INICIO DATOS CONDICIONES CLIMATICAS -->
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.humidity', [
                                                                    'label' => ['text' => 'Humedad Ambiente (%) ' .$this->Functions->validarObligatorio('humidity',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura de la condición climática"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->humidity,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.temp', [
                                                                    'label' => ['text' => 'Temperatura Ambiente (°C) ' .$this->Functions->validarObligatorio('temp',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Humedad de la condición climática"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->temp,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.presure', [
                                                                    'label' => ['text' => 'Presión Atmosférica (mmHg) '.$this->Functions->validarObligatorio('presure',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="La presión atmosférica es la fuerza por unidad de área que ejerce el aire sobre la superficie terrestre. "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->presure,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.precipitation', [
                                                                    'label' => ['text' => 'Precipitación (mm) '.$this->Functions->validarObligatorio('precipitation',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Caída de agua sólida o líquida debido a la condensación del vapor sobre la superficie terrestre"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->precipitation,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS CONDICIONES CLIMATICAS -->
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
                                                        <?php echo $this->Form->control('passportFito.soiltext', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_textura,
                                                                'default'=> $passportFito->soiltext,
                                                                'label'  => __('Textura del Suelo '.$this->Functions->validarObligatorio('soiltext',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Forma que se encuentra distribuido el suelos"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.soilped', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_pedrego,
                                                                'default'=> $passportFito->soilped,
                                                                'label'  => __('Pedregocidad del Suelo '.$this->Functions->validarObligatorio('soilped',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de pedregosidad"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.soilcol', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_color,
                                                                'default'=> $passportFito->soilcol,
                                                                'label'  => __('Color del Suelo '.$this->Functions->validarObligatorio('soilcol',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Color del suelo"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.soilph', [
                                                                'type'  => 'select',
                                                                'options'=> $suelo_ph,
                                                                'default'=> $passportFito->soilph,
                                                                'label'  => __('pH del Suelo '.$this->Functions->validarObligatorio('soilph',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Acidez o la alcalinidad del suelo"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.soilrel', [
                                                                    'label' => ['text' => 'Relieve del Suelo '.$this->Functions->validarObligatorio('soilrel',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el tipo de relieve del suelo"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->soilrel,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS DEL SUELO -->
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
                                                <!-- INICIO DATOS STATUS LEGAL -->
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.mlsstat',
                                                                ['type' => 'select',
                                                                'options' => $sis_multilateral,
                                                                'default' => $passportFito->mlsstat,
                                                                'label' => __('Sistema Multilateral '.$this->Functions->validarObligatorio('mlsstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El estatus de una  accesión con respecto al sistema multilateral (mls)  (si/no)"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.patent', [
                                                                    'label' => ['text' => 'Patente '.$this->Functions->validarObligatorio('patent',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="La planta está registrado en una patente"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->patent,
                                                        ]); ?>
                                                    </div>
                                                <!-- FIN DATOS STATUS LEGAL -->

                                                <!-- INICIO DATOS INFORMACION ADICIONAL -->
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.bredcode', [
                                                                    'label' => ['text' => 'Código del Instituto de Mejoramiento '.$this->Functions->validarObligatorio('bredcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del instituto en que el material ha sido cruzado"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->bredcode,
                                                        ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.bredname', [
                                                                    'label' => ['text' => 'Nombre del Instituto de Mejoramiento '.$this->Functions->validarObligatorio('bredname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto (o persona) que crió el material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->bredname,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.duplinstname', [
                                                                    'label' => ['text' => 'Nombre del Lugar de los Duplicados de Seguridad '.$this->Functions->validarObligatorio('duplinstname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto donde se conserva un duplicado de seguridad de la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->duplinstname,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.duplsite', [
                                                                    'label' => ['text' => 'Ubicación de los Duplicados de Seguridad '.$this->Functions->validarObligatorio('duplsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del instituto donde se mantiene un duplicado de seguridad de la accesión "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->duplsite,
                                                        ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.invitro', [
                                                                'type'     => 'select',
                                                                'options'  => $invitro,
                                                                'default'  => $passportFito->invitro,
                                                                'label'    => __('Banco In vitro '.$this->Functions->validarObligatorio('invitro',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se cuentra almacenada en el banco de in vitro"></i>'),
                                                                'escape' => false,
                                                                'class'    => 'form-control',
                                                                'disabled' => ($passportFito->bancoInvitro > 0) ? true : false,
                                                                'empty'    => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.bseed', [
                                                                'type'     => 'select',
                                                                'options'  => $semillas,
                                                                'default'  => $passportFito->bseed,
                                                                'label'    => __('Banco Semillas '.$this->Functions->validarObligatorio('bseed',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en el banco de semillas"></i>'),
                                                                'escape' => false,
                                                                'disabled' => ($passportFito->bancoSemilla > 0) ? true : false,
                                                                'class'    => 'form-control',
                                                                'empty'    => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.bfield', [
                                                                'type'     => 'select',
                                                                'options'  => $campo,
                                                                'default'  => $passportFito->bfield,
                                                                'label'    => __('Banco Campo '.$this->Functions->validarObligatorio('bfield',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en el banco de campo"></i>'),
                                                                'escape' => false,
                                                                'disabled' => ($passportFito->bancoCampo > 0) ? true : false,
                                                                'class'    => 'form-control',
                                                                'empty'    => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.insitu', [
                                                                    'label' => ['text' => 'Conservación In situ '.$this->Functions->validarObligatorio('insitu',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en conservación in situ"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value' => $passportFito->insitu,
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.bdna', [
                                                                'type'     => 'select',
                                                                'options'  => $adn,
                                                                'default'  => $passportFito->bdna,
                                                                'label'    => __('Banco ADN '.$this->Functions->validarObligatorio('bdna',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si la accesión se encuentra almacenada en el banco de adn"></i>'),
                                                                'escape' => false,
                                                                'class'    => 'form-control',
                                                                'disabled' => ($passportFito->bancoAdn > 0) ? true : false,
                                                                'empty'    => '-- SELECCIONE --',
                                                        ]); ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Anotaciones <?php echo $this->Functions->validarObligatorio('passportFito.remarks',$lista). '  <i class="fa fa-info-circle" data-toggle="tooltip" title="Para añadir notas o para completar datos faltantes de la accesión"></i> ' ?></h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                     <?php echo $this->Form->control('passportFito.remarks', [
                                                                    'label'  => ['text' => ''],
                                                                    'escape' => false,
                                                                    'class'  => 'form-control',
                                                                    'value'  => $passportFito->remarks,
                                                                    'rows'   => 5,
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
                        <button type="submit" class="btn btn-primary" id="btnPassportFito">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/datos-pasaporte', true) ?>"
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
$this->Html->scriptBlock('$("#passport-station-current-id, #passportfito-sampstat, #passport-station-origin-id, #coleccion, #especie_idx, #country_id, #passportfito-soilcol").select2();', ['block' => 'script']);

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('$("#fecha-aquisicion, #fecha-recoleccion").datepicker({autoclose: true, todayBtn: true, todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

?>