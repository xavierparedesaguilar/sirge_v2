<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
 <h1>Recursos Fitogenéticos- Módulo Dato Pasaporte</h1>
 

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportFito', 'action' => 'index']);
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
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <h4><i class="fa fa-file-o"></i> <?= __('NUEVO REGISTRO DATO PASAPORTE') ?></h4>
                </div>

                <?php echo $this->Form->create($passportFito, [
                    'url' => ['controller' => 'PassportFito', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_passportfito",
                    'enctype' => 'multipart/form-data'
                ]); ?>

        <div class="box-body">
            <div class="col-xs-12 col-md-12 col-lg-12">

                 <div class="nav-tabs-custom tab-success">
                     <ul class="nav nav-tabs " id="myTab">
                       <li class="active"><a data-toggle="tab" aria-expanded="true" href="#tabla1">  <i class="fa fa-file-o"></i> DATOS GENERALES</a></li>
                        <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla2"> <i class="fa fa-map-marker"></i> DATOS DE UBICACIÓN</a></li>
                        <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla3"> <i class="fa fa-file-text-o"></i> DATOS DE COLECTA</a></li>
                        <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla4"> <i class="fa fa-cloud"></i> DATOS ECOGEOGRÁFICOS</a></li>
                        <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla5"> <i class="fa fa-photo"></i> FOTOGRAFÍA </a></li>
                        <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla6"> <i class="fa fa-ge"></i> DATOS ADICIONALES</a></li>
                    </ul>
					<div class="tab-content">
            <div id="tabla1" class="tab-pane active">
                          <div class="row">  
                            <div class="col-lg-6">
                             <?php echo $this->Form->control('passport_validation', ['type' => 'hidden', 'value' => $passpor_validation['validation'] ]) ?>
                                        <?php echo $this->Form->control('passfito_validation', ['type' => 'hidden', 'value' => $passfito_validation['validation'] ]) ?>
                                <div class="row">  
                                    <div class="col-lg-12">                                     
                                         <h4 class="box-title">:: Código de Asignación Internacional del Instituto<hr></h4>
                                  </div>
                                  <div class="col-lg-12 col-sm-12 col-xs-12">  
                                      <?php echo $this->Form->control('passport.instcode', [
                                                            'label' => ['text' => 'Código del Instituto (COD. FAO) '. $this->Functions->validarObligatorio('instcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del Instituto donde se Conserva la Accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                      ]); ?>
                                    </div>
                            </div>
                             </div>
                             <div class="col-lg-6">
                               <div class="row">
                                 <div class="col-lg-12">                                   
                                         <h4 class="box-title">:: Estación Experimental de Conservación y Procedencia<hr></h4>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passport.station_current_id', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'label'  => __('EEA de Conservación '. $this->Functions->validarObligatorio('station_current_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="EEA donde se Conserva el Material Genético"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => 'SELECCIONE ESTACIÓN',
                                                ]); ?>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passport.station_origin_id', [
                                                        'type'   => 'select',
                                                        'options'=> $station,
                                                        'label'  => __('EEA de Procedencia '. $this->Functions->validarObligatorio('station_origin_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="EEA de donde procede el Material Genético"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => 'SELECCIONE EST. DE PROCEDENCIA',
                                   ]); ?>
                                </div>
                               </div>
                             </div>
                          </div>
                          <div class="row">  
                            <div class="col-lg-6">
                            <div class="row">  
                              <div class="col-lg-12"><h4>:: Información Principal<hr></h4></div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passport.accname', [
                                                                'label' => ['text' => 'Nombre de la Accesión '.$this->Functions->validarObligatorio('accname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre que se le asigna a la Accesión"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                         ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passport.othenumb', [
                                                            'label' => ['text' => 'Otra Idientificación '.$this->Functions->validarObligatorio('othenumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Otra Identificación que se le asigna a la Accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                     ]); ?>
                                    </div>
                              </div>
                              <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('coleccion', [
                                                        'label'   => 'Colección '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la Colección"></i>',
                                                        'escape'  => false,
                                                        'type'    => 'select',
                                                        'class'   => 'form-control select2',
                                                        'options' => $colecciones,
                                                        'empty'   => 'SELECCIONE COLECCIÓN',
                                                ]) ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passport.specie_id', [
                                                        'type'    => 'select',
                                                        'options' => [],
                                                        'id'      => 'especie_idx',
                                                        'label'   => __('Nombre Científico'. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre Cientifíco de la Especie"></i>'),
                                                        'escape' => false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => 'SELECCIONE NOMBRE CIENTÍFICO',
                                     ]); ?>
                                    </div>
                              </div>
                              <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('nombre_comun', [
                                                            'label'    => ['text' => 'Nombre Común de la Especie '. $this->Functions->validarObligatorio('specie_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común que se le asigna Especie"></i>'],
                                                            'escape' => false,
                                                            'class'    => 'form-control',
                                                            'disabled' => true,
                                    ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.collnumb', [
                                                            'label' => ['text' => 'Código de Colecta <b style="color:#dd4b39;">(*)</b>'. ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código asignado por el Recolector"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                    </div>
                              </div>
                              <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passportFito.subtype', [
                                                        'type'   => 'select',
                                                        'options'=> $tipo_recursos,
                                                        'label'  => __('SubTipo de Recurso '.$this->Functions->validarObligatorio('subtype',$lista) . '<i class="fa fa-info-circle" data-toggle="tooltip" title="Subtipo de Recurso de la Accesión"></i>'),
                                                        'escape' => false,
                                                        'class'  => 'form-control select2',
                                                        'empty'  => 'SELECCIONE SUBTIPO',
                                     ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.storage', [
                                                        'type'    => 'select',
                                                        'options' => $tipo_conservacion,
                                                        'label'   => __('Tipo de Almacenamiento'. $this->Functions->validarObligatorio('storage',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El Tipo de Conservación del Material"></i>'),
                                                        'escape' => false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => 'SELECCIONE TIPO',
                                     ]); ?>
                                    </div>
                              </div>
                             </div>
                             <div class="col-lg-6">
                               <div class="row"> 
                                   <div class="col-lg-12">
                                     <h4>:: Información Adicional<hr></h4>
                                   </div>
                               </div>
                               <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.subtauthor', [
                                                            'label'=> ['text' => 'Autoría de los Subtaxones '. $this->Functions->validarObligatorio('subtauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre(s) del Autor(es) del Subtaxones"></i>'],
                                                            'escape' => false,
                                                            'class'=> 'form-control',
                                                ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.subtaxa', [
                                                            'label' => ['text' => 'Subtaxones '. $this->Functions->validarObligatorio('subtaxa',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Proveer algún Identificador Taxonomico adicional"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.spauthor', [
                                                                'label' => ['text' => 'Autoría de la Especie '. $this->Functions->validarObligatorio('spauthor',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del Autor de la Especie"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                  </div>
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('fecha_aquisicion', [
                                                                'label'  => ['text' => 'Fecha Introducción al GENBANK '. $this->Functions->validarObligatorio('acqdate',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de Introducción al Banco"></i>'],
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                //'readonly' => true
                                     ]); ?>
                                  </div>
                              </div> 
                             </div>
                             <div class="col-lg-6">
                               <div class="row"> 
                                   <div class="col-lg-12">
                                     <h4>:: Accesión Promisoria y Disponibilidad<hr></h4>
                                   </div>
                               </div>
                                <div class="row"> 
                                   <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passport.promissory', [
                                                                'type'   => 'select',
                                                                'options'=> $lista_promisoria,
                                                                'label'  => __('Promisoria '. $this->Functions->validarObligatorio('promissory',$lista) ),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => 'SELECCIONAR',
                                         ]); ?>
                                      </div>
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.availability', [
                                                                'type'   => 'select',
                                                                'options'=> $disp_accesion,
                                                                'label'  => __('Accesión Disponibile'. $this->Functions->validarObligatorio('availability',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad de la accesión (si/no)"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => 'SELECCIONAR',
                                          ]); ?>
                                  </div>
                               </div>
                             </div>
                          </div>
						</div>
						<div id="tabla2" class="tab-pane">
            
                          <div class="row">  
                            <div class="col-lg-6">
                                <div class="row">  
                                  <div class="col-lg-12"><h4><i class="fa fa-location-arrow"></i> Datos de Ubicación de la Accesión<hr></h4></div>
                                </div>
                                <div class="row">  
                                   <!-- INICIO DATOS DEL UBIGEO -->
                                     <!-- Inicio de los id de pais y ubbigeo -->
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passport.country_id', [
                                                                'type'   => 'select',
                                                                'options'=> $paises,
                                                                'label'  => __('País Origen '. $this->Functions->validarObligatorio('country_id',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="País donde se recolectó la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control select2',
                                                                'empty'  => '-- SELECCIONE --',
                                                                'id'     => 'country_id',
                                      ]); ?>
                                    </div>    
                                </div>
                                <div class="row"> 
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('departamento', [
                                                                'class'    => 'form-control',
                                                                'type'     => 'select',
                                                                'label'    => 'Departamento ' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Departamento donde se recolectó la accesión"></i>',
                                                                'escape' => false,
                                                                'options'  => $departamento,
                                                                'empty'    => '-- SELECCIONE --',
                                                                'disabled' => true,
                                                        ]) ?>
                                      </div>
                                </div>
                                <div class="row">
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('provincia', [
                                                                'type'    => 'select',
                                                                'options' => [],
                                                                'label'   => __('Provincia ' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Provincia donde se recolectó la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'   => '-- SELECCIONE --',
                                                                'disabled'=> true,
                                                        ]); ?>
                                      </div>                                                                             
                                </div>
                                <div class="row"> 
                                      <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('distrito', [
                                                                'type'    => 'select',
                                                                'options' => [],
                                                                'label'   => __('Distrito ' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Distrito donde se recolectó la accesión"></i>'),
                                                                'escape' => false,
                                                                'class'   => 'form-control',
                                                                'empty'   => '-- SELECCIONE --',
                                                                'disabled'=> true,
                                                        ]); ?>
                                                        <input type="hidden" name="passport[ubigeo_id]" id="ubigeo_id" value="<?php echo(isset($passport) ? $passport->ubigeo_id : null) ?>">
                                       </div>  
                                </div>
                                <div class="row"> 
                                      <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passport.localidad', [
                                                                    'label'=> ['text' => 'Localidad '. $this->Functions->validarObligatorio('localidad',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Localidad donde se recolectó la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class'=> 'form-control',
                                                        ]); ?>
                                       </div>
                                </div>
                                 <div class="row"> 
                                      <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.collsite', [
                                                                    'label' => ['text' => 'Ubicación del sitio de recolección '. $this->Functions->validarObligatorio('collsite',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'rows'   => 5,
                                                        ]); ?>
                                                        <h5><i class="fa fa-genderless"></i> <em>Información sobre la ubicación del lugar donde se recolectó la Accesión</em></h5>
                                       </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="row"> 
                                   <div class="col-lg-12">
                                     <h4><i class="fa fa-map-marker"></i> Datos de Georreferenciación de la Accesión<hr></h4>
                                   </div>
                               </div>
                               <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                       <?php echo $this->Form->control('passportFito.latitude', [
                                                                    'label' => ['text' => 'Latitud del sitio de recolección '. $this->Functions->validarObligatorio('latitude',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                        ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.coorddatum', [
                                                                'type'   => 'select',
                                                                'options'=> $coordenadas,
                                                                'label'  => __('Tipo de Coordenadas '. $this->Functions->validarObligatorio('coorddatum',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de datos de sistema de referencia espacial"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                          ]); ?>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.longitude', [
                                                                    'label' => ['text' => 'Longitud del sitio de recolección '. $this->Functions->validarObligatorio('longitude',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                  </div>
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.georefmeth', [
                                                                    'type'   => 'select',
                                                                    'options'=> $georref,
                                                                    'label'  => __('Método de Georeferenciación '. $this->Functions->validarObligatorio('georefmeth',$lista) . ' '),
                                                                    'escape' => false,
                                                                    'class'  => 'form-control',
                                                                    'empty'  => '-- SELECCIONE --',
                                     ]); ?>
                                  </div>
                              </div> 
                               <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.elevation', [
                                                                    'label' => ['text' => 'Elevación del sitio de recolección '. $this->Functions->validarObligatorio('elevation',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                  </div>
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.coorduncert', [
                                                                    'label' => ['text' => 'Incertidumbre de Coordenadas '. $this->Functions->validarObligatorio('coorduncert',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Incertidumbre asociada a las coordenadas en metros."></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                  </div>
                              </div> 
                              <div class="row"> 
                                  <div class="col-lg-12 col-sm-12 col-xs-12">                                
                                      <h5><em>Nota: Los valores de coordenadas de <strong>LATITUD</strong> y <b>LONGITUD</b> deben ser de grados decimales. Para aplicar la conversión de <b>GRADOS, MINUTOS y SEGUNDOS</b> a <b>GRADOS DECIMALES</b> se debe utilizar la siguiente fórmula:</em> </h5>
                                      <h4>Grados decimales =(grados + (minutos/60) + (segundos/3600)) * -1</h4>
                                  </div>
                              </div> 
                             </div>
                           </div>
						</div>
						<div id="tabla3" class="tab-pane">
                 <div class="row">  
                    <div class="col-lg-12">
                            <div class="row">  
                              <div class="col-lg-12"><h4>:: Información de la Colecta<hr></h4></div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                       <?php echo $this->Form->control('passportFito.collcode', [
                                                                    'label' => ['text' => 'Código del Instituto de Colecta '. $this->Functions->validarObligatorio('collcode',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del Instituto que recolecta la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.collname', [
                                                                    'label' => ['text' => 'Nombre del Colector '. $this->Functions->validarObligatorio('collname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del Instituto (o persona) que recolecta la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                                     <div class="col-lg-4 col-sm-12 col-xs-12">
                                       <?php echo $this->Form->control('passportFito.collinstaddress', [
                                                                    'label' => ['text' => 'Dirección del Colector '. $this->Functions->validarObligatorio('collinstaddress',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                            </div>
                            <div class="row">                                     
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                   <?php echo $this->Form->control('passportFito.collmissind', [
                                                                    'label' => ['text' => 'Misión de Colecta '. $this->Functions->validarObligatorio('collmissind',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de Proyecto que se realizo la colecta"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('fecha_recoleccion', [
                                                                    'label'   => ['text' => 'Fecha de Recolección de la muestra  '.$this->Functions->validarObligatorio('colldate',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class'   => 'form-control date-picker',
                                                                    // 'readonly'=> true,
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.localname', [
                                                                    'label' => ['text' => 'Nombre Local del Material '.$this->Functions->validarObligatorio('localname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común con la que se conoce al material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>

                            </div>
                            <div class="row">  
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                     <div class="form-group">
                                         <label for="fuente">Fuente de Recoleccion <?php  echo $this->Functions->validarObligatorio('collsrc',$lista) ;?></label>
                                          <select class="form-control b-radio text-uppercase" name="passportFito[collsrc]"
                                                                       id="passportfito-collsrc">
                                          <option value="">-- SELECCIONE --</option>
                                           <?php foreach ($fuentes as $fuente): ?>
                                                         <option value="<?php echo $fuente->id ?>"><?php echo $fuente->name ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.collsrcdet', [
                                                                'type'    => 'select',
                                                                'options' => [],
                                                                'label'   => __('Fuente Detalle '.$this->Functions->validarObligatorio('collsrcdet',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Detalle  de la Fuente de Recolección"></i>'),
                                                                'escape'  => false,
                                                                'class'   => 'form-control',
                                                                'empty'   => '-- SELECCIONE --',
                                     ]); ?>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.sampstat', [
                                                                'type'   => 'select',
                                                                'options'=> $cond_biologicas,
                                                                'label'  => __('Condición Biológica (Categorías) '.$this->Functions->validarObligatorio('sampstat',$lista) . ''),
                                                                'escape' => false,
                                                                'class'  => 'form-control select2',
                                                                'empty'  => '-- SELECCIONE --',
                                     ]); ?>
                                    </div>
                            </div>
                            <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.groupethnic', [
                                                                    'label' => ['text' => 'Grupo Étnico (Nombre del lugar de la colecta) '.$this->Functions->validarObligatorio('groupethnic',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>                                    
                            </div>
                    </div> 
                    <div class="col-lg-6">
                            <div class="row">  
                              <div class="col-lg-12"><h4><i class="fa fa-pagelines"></i> Información de la Planta<hr></h4></div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.samptype', [
                                                                    'label'   => ['text' => 'Tipo de Muestra '.$this->Functions->validarObligatorio('samptype',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de Muestra de la planta colectada"></i>'],
                                                                    'escape' => false,
                                                                    'class'   => 'form-control',
                                                                    'type'    => 'select',
                                                                    'options' => $tipo_muestra,
                                                                    'empty'   => '-- SELECCIONE --',
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.sampsize', [
                                                                    'label' => ['text' => 'Cantidad de Plantas Muestreadas '.$this->Functions->validarObligatorio('sampsize',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control onlynumbers',
                                     ]); ?>
                                    </div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.sampling', [
                                                                    'label' => ['text' => 'Tipo de Muestreo '.$this->Functions->validarObligatorio('sampling',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Si el muestreo fue realizado al azar o usando otro método"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.plauspart',
                                                                ['type' => 'select',
                                                                'options' => $planta_util,
                                                                'label' => __('Parte Útil de la Planta '.$this->Functions->validarObligatorio('plauspart',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Partes útiles de la planta que son utilizadas por los pobladores"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --',
                                     ]); ?>
                                    </div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.uso',
                                                                ['type' => 'select',
                                                                'options' => $planta_uso,
                                                                'label' => __('Uso de la Planta '.$this->Functions->validarObligatorio('uso',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Usos que se realiza con la planta"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --',
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.pathogen', [
                                                                    'label' => ['text' => 'Patógeno (Enfernedad o Plagas) '.$this->Functions->validarObligatorio('pathogen',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.poparea', [
                                                                    'label' => ['text' => 'Área de Recolección de la Muestra (m2) '. $this->Functions->validarObligatorio('poparea',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                            </div>
                      </div>
                      <div class="col-lg-6">
                            <div class="row">  
                              <div class="col-lg-12"><h4><i class="fa fa-user"></i> Información del Donante<hr></h4></div>
                            </div>
                            <div class="row">  
                                <!-- INICIO DATOS DEL DONANTE -->                                   
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.donornumb', [
                                                                    'label' => ['text' => 'Código de Accesión del Donante '.$this->Functions->validarObligatorio('donornumb',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código  asignado a una accesión por el Insituto Donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                             </div>
                             <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.donorcore', [
                                                                    'label' => ['text' => 'Código del Instituto Donante '.$this->Functions->validarObligatorio('donorcore',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al Instituto Donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                              </div>
                               <div class="row">                                                                 
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passportFito.donorname', [
                                                                    'label' => ['text' => 'Nombre del Instituto Donante '.$this->Functions->validarObligatorio('donorname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del Instituto (o persona) Donante"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                                </div>     
                                <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.donaddress', [
                                                                    'label' => ['text' => 'Dirección del Intituto Donante '.$this->Functions->validarObligatorio('donaddress',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                              </div>
                      </div>                              
                  </div>
						</div>
						<div id="tabla4" class="tab-pane">
              <div class="row">                      
                      <div class="col-lg-6">
                            <div class="row">  
                              <!-- INICIO DATOS CONDICIONES CLIMATICAS -->
                              <div class="col-lg-12"><h4><i class="fa fa-cloud"></i> Información de las Condiciones Climáticas<hr></h4></div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.humidity', [
                                                                    'label' => ['text' => 'Humedad Ambiente (%) '.$this->Functions->validarObligatorio('humidity',$lista).' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>                                
                            </div>
                            <div class="row">  
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.temp', [
                                                                    'label' => ['text' => 'Temperatura Ambiente (°C) '.$this->Functions->validarObligatorio('temp',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>                                   
                            </div>
                            <div class="row">  
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.presure', [
                                                                    'label' => ['text' => 'Presión Atmosférica (mmHg) '.$this->Functions->validarObligatorio('presure',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                            </div>
                            <div class="row">  
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.precipitation', [
                                                                    'label' => ['text' => 'Precipitación (mm) '.$this->Functions->validarObligatorio('precipitation',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                            </div>
                            <!-- FIN DATOS CONDICIONES CLIMATICAS -->
                      </div>
                      <div class="col-lg-6">
                            <div class="row">  
                              <div class="col-lg-12"><h4><i class="fa fa-globe"></i> Información del Suelo<hr></h4></div>
                            </div>
                            <div class="row">  
                                <!-- INICIO DATOS DEL SUELO -->                                   
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.soiltext', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_textura,
                                                                'label'  => __('Textura del Suelo '.$this->Functions->validarObligatorio('soiltext',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Forma que se encuentra distribuido el suelo"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                     ]); ?>
                                    </div>
                             </div>
                             <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.soilped', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_pedrego,
                                                                'label'  => __('Pedregocidad del Suelo '.$this->Functions->validarObligatorio('soilped',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de pedregosidad que se encuentra el suelo"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                      ]); ?>
                                    </div>
                              </div>
                               <div class="row">                                                                 
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.soilcol', [
                                                                'type'   => 'select',
                                                                'options'=> $suelo_color,
                                                                'label'  => __('Color del Suelo '.$this->Functions->validarObligatorio('soilcol',$lista) . ' '),
                                                                'escape' => false,
                                                                'class'  => 'form-control select2',
                                                                'empty'  => '-- SELECCIONE --',
                                     ]); ?>
                                    </div>
                                </div>     
                                <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.soilph', [
                                                                'type'  => 'select',
                                                                'options'=> $suelo_ph,
                                                                'label'  => __('pH del Suelo '.$this->Functions->validarObligatorio('soilph',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Acidez o la alcalinidad del suelo"></i>'),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                      ]); ?>
                                    </div>
                              </div>
                               <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                         <?php echo $this->Form->control('passportFito.soilrel', [
                                                                    'label' => ['text' => 'Relieve del Suelo '.$this->Functions->validarObligatorio('soilrel',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indicar el tipo de relieve del suelo"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                              </div>
                      </div>                              
                  </div>
						</div>
						<div id="tabla5" class="tab-pane">
              <div class="row">                      
                      <div class="col-lg-12">
                            <div class="row">  
                              <!-- INICIO DATOS FOTOGRAFIA -->
                              <div class="col-lg-12"><h4><i class="fa fa-photo"></i> Fotografía de la Accesión<hr></h4></div>
                            </div>
                            <div class="row">  
                                   <div class="col-lg-3 col-sm-12 col-xs-12 text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                            </div>
                                                            <div class="text-center">
                                                                <span class="btn btn-warning btn-file">
                                                                    <span class="fileinput-new">Seleccionar Imagen 1</span>
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
                                                                <span class="btn btn-warning btn-file">
                                                                    <span class="fileinput-new">Seleccionar Imagen 2</span>
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
                                                                <span class="btn btn-warning btn-file">
                                                                    <span class="fileinput-new">Seleccionar Imagen 3</span>
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
                                                                <span class="btn btn-warning btn-file">
                                                                    <span class="fileinput-new">Seleccionar Imagen 4</span>
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
                                                                    'label' => ['text' => 'Descripción de la Fotografia' . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                      </div>
                                      <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks2', [
                                                                    'label'=> ['text' => 'Descripción de la Fotografia' . ''],
                                                                    'escape' => false,
                                                                    'class'=> 'form-control',
                                                        ]); ?>
                                      </div>
                                      <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks3', [
                                                                    'label' => ['text' => 'Descripción de la Fotografia' . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                      </div>

                                      <div class="col-lg-3 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('passportFito.remarks4', [
                                                                    'label' => ['text' => 'Descripción de la Fotografia' . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                       </div>
                                                <!-- FIN DATOS FOTOGRAFIA DE LA ACCESIÓN -->
                             </div>
                             <div class="row">
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                      <h5><i class="fa fa-genderless"></i> <em>Solo se permite subir como maximo 4 fotografías relacionada a la accesión</em></h5>               
                                    </div>
                              </div>
                       </div>
                </div>                     
						</div>
						<div id="tabla6" class="tab-pane">
                 <div class="row">  
                            <div class="col-lg-6">                            
                                <div class="row">  
                                    <div class="col-lg-12">                                     
                                         <h4 class="box-title">:: Información Ancestral de la Accesión<hr></h4>
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.mancest', [
                                       'label' => ['text' => '1. Codigo de la Accesión del Ancestro'. $this->Functions->validarObligatorio('mancest',$lista) . ' '],
                                         'escape' => false,
                                         'class' => 'form-control',
                                         ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                   <?php echo $this->Form->control('passportFito.pancest', [
                                       'label' => ['text' => '2. Codigo de la Accesión del Ancestro'. $this->Functions->validarObligatorio('pancest',$lista) . ''],
                                        'escape' => false,
                                        'class' => 'form-control',
                                     ]); ?>
                                    </div>
                              </div>
                              <div class="row"> 
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.ancest', [
                                        'label' => ['text' => 'Datos Ancestrales '. $this->Functions->validarObligatorio('ancest',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción que contenga información de los ancestros"></i>'],
                                          'escape' => false,
                                          'class' => 'form-control',
                                      ]); ?>
                                        <h5><em>Información sobre el pedigrí (genealogía) o sobre otra descripción que contenga información de los ancestros (por ej., variedad del progenitor cuando se trata de un mutante o de una selección).</em></h5>
                                    </div>
                                   
                              </div>
                                    
                             </div>
                             <div class="col-lg-6">
                               <div class="row">
                                 <div class="col-lg-12">                                   
                                         <h4 class="box-title">:: Información Adicional<hr></h4>
                                 </div>
                               </div>
                               <div class="row">  
                                <!-- INICIO INFORMACION ADICIONAÑ -->                                   
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.bredcode', [
                                                                    'label' => ['text' => 'Código del Instituto de Mejoramiento '.$this->Functions->validarObligatorio('bredcode',$lista) . ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                      ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passportFito.bredname', [
                                                                    'label' => ['text' => 'Nombre del Instituto de Mejoramiento '.$this->Functions->validarObligatorio('bredname',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>
                                    </div>
                              </div>
                              <div class="row">  
                                     <div class="col-lg-12 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passportFito.duplinstname', [
                                                                    'label' => ['text' => 'Nombre del Lugar de los Duplicados de Seguridad '.$this->Functions->validarObligatorio('duplinstname',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del instituto donde se conserva un duplicado de seguridad de la accesión"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                       ]); ?>                                         
                                    </div>
                              </div>
                              <div class="row">                                                                 
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                      <?php echo $this->Form->control('passportFito.duplsite', [
                                                                    'label' => ['text' => 'Ubicación de los Duplicados de Seguridad '.$this->Functions->validarObligatorio('duplsite',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Dirección del instituto donde se mantiene un duplicado de seguridad de la accesión "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                             </div>
                          </div>                           
                          <div class="col-lg-6">                            
                              <div class="row">  
                                <div class="col-lg-12"><h4>:: Información Legal<hr></h4></div>
                              </div>
                            <div class="row">  
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.mlsstat', [
                                             'type'   => 'select',
                                             'options'=> $sis_multilateral,
                                             'label'  => __('Sistema Multilateral '.$this->Functions->validarObligatorio('mlsstat',$lista) . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="El estatus de una  accesión con respecto al sistema multilateral (mls)  (si/no)"></i>'),
                                             'escape' => false,
                                             'class'  => 'form-control',
                                             'empty'  => '-- SELECCIONE --',
                                         ]); ?>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.patent', [
                                                                    'label' => ['text' => 'Nombre de la Patente '.$this->Functions->validarObligatorio('patent',$lista) . '<i class="fa fa-info-circle" data-toggle="tooltip" title="Informacion de la planta que cuenta con una patente de registro"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                     ]); ?>
                                    </div>
                              </div>  
                              <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <em>Informacion de la planta que cuenta con una patente de registro</em> 
                                  </div>                                  
                              </div>   
                          </div>
                          <div class="col-lg-6">                            
                                <div class="row"> 
                                   <div class="col-lg-12">
                                     <h4>:: Lugares de Almacenamiento donde se encuentra la Accesión<hr></h4>
                                   </div>
                               </div>
                               <div class="row"> 
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.invitro', [
                                                                'type'   => 'select',
                                                                'options'=> $invitro,
                                                                'label'  => __('Banco In vitro '.$this->Functions->validarObligatorio('invitro',$lista) . ' '),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?php echo $this->Form->control('passportFito.bseed', [
                                                                'type'  => 'select',
                                                                'options'=> $semillas,
                                                                'label'  => __('Banco Semillas '.$this->Functions->validarObligatorio('bseed',$lista) . ' '),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                ]); ?>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.bfield', [
                                                                'type'   => 'select',
                                                                'options'=> $campo,
                                                                'label'  => __('Banco Campo '.$this->Functions->validarObligatorio('bfield',$lista) . ''),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                    ]); ?>
                                  </div>
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('passportFito.bdna', [
                                                                'type'   => 'select',
                                                                'options'=> $adn,
                                                                'label'  => __('Banco ADN '.$this->Functions->validarObligatorio('bdna',$lista) . ''),
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'empty'  => '-- SELECCIONE --',
                                                                //'readonly' => true
                                     ]); ?>
                                  </div>
                              </div> 
                              <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                     <?php echo $this->Form->control('passportFito.insitu', [
                                                                    'label' => ['text' => 'Conservación In situ '.$this->Functions->validarObligatorio('insitu',$lista) . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                    ]); ?>
                                  </div>                                  
                              </div>
                            </div>
                            <div class="col-lg-12">
                               <div class="row"> 
                                   <div class="col-lg-12">
                                     <h4>:: Observaciones o Anotaciones<hr></h4>
                                   </div>
                               </div>
                               <div class="row"> 
                                   <div class="col-lg-12col-sm-12 col-xs-12">
                                    <em>Para añadir información faltante o alguna observación relacionada a los datos de la accesión</em>
                                       <?php echo $this->Form->control('passportFito.remarks', [
                                                                'label'  => ['text' => ''],
                                                                'escape' => false,
                                                                'class'  => 'form-control',
                                                                'rows'   => 5,
                                                    ]); ?>
                                   </div>
                              </div>
                            </div>
                  </div> 
            </div>                  
					</div>
				</div>
			</div>
		</div>
        <div class="box-footer">
                    <div class="col-sm-12">
					 <div class="row  pull-right" >
					 <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/datos-pasaporte', true) ?>"
                           class="btn btn-default"><i class="fa fa-times"></i>  CANCELAR
                        </a>
                        <button type="submit" class="btn btn-success" id="btnPassportFito"><i class="fa fa-save"></i> GUARDAR DATOS PASAPORTE</button>
                        
					</div>
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