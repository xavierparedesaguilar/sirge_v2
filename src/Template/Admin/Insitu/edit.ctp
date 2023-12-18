
<?php $this->assign('title', $mod_modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?> </h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'Insitu', 'action' => 'edit', 'id' => $insitu->id]);
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
            <div class="panel panel-default">
                <div class="panel-heading ">
                   <h4> <i class="fa fa-pencil-square-o"></i> <?= __('ACTUALIZACIÓN DE REGISTRO DE ZONA DE AGROBIODIVERDSIDAD: ') ?><strong> <?= $insitu->code_insitu?></strong></h4>
                </div>
                <?php echo $this->Form->create($insitu, [
                    'url' => ['controller' => 'Insitu', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id' => "form_insitu"
                ]); ?>
                 <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom tab-success">
                                <ul class="nav nav-tabs " id="myTab">
                                   <li class="active">
                                     <a data-toggle="tab" aria-expanded="true" href="#tabla1">  
                                      <i class="fa fa-address-card-o"></i> ZONA DE AGROBIODIVERSDAD
                                     </a>
                                   </li>
                                    <li >
                                     <a data-toggle="tab" aria-expanded="true" href="#tabla2">  
                                       <i class="fa fa-clipboard"></i> DATOS GENERALES
                                     </a>
                                   </li>                                   
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabla1">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4 class="box-title"><i class="fa fa-pagelines"></i> Datos de la Zona de Abrobiodiversidad<hr></h4>
                                                         <?php echo $this->Form->control('name_farmer', [
                                                                                'label' => 'Nombre de la Zona <b style="color:#dd4b39;"> (*)</b>', 'escape'=> false ,
                                                                                'class' => 'form-control',
                                                        ]); ?>
                                                        <?php echo $this->Form->control('ministerial_resolution', [
                                                                          'label' => 'Resolución Ministerial <b style="color:#dd4b39;">(*)</b>', 
                                                                          'escape'=> false ,
                                                                           'maxlength'=> 100,
                                                                'class' => 'form-control',
                                                                      ]); ?>
                                                       <?php echo $this->Form->control('address_farmer', [
                                                                                'label' => 'Dirección de la Zona', 'escape'=> false ,
                                                                                'class' => 'form-control',
                                                       ]); ?>
                                                    </div>
                                                  </div>
                                            </div>
                                            <!-- End Col -->
                                            <div class="col-lg-6">
                                                <div class="row">
                                                     <div class="col-lg-12">
                                                        <h4 class="box-title">
                                                            <i class="fa fa-location-arrow"></i> Datos de Ubicación de la Zona <hr>
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                            <?php echo $this->Form->control('departamento', [
                                                                            'label'   => 'Departamento <b style="color:#dd4b39;">(*)</b>', 
                                                                            'escape'=> false ,
                                                                            'class'   => 'form-control select2',
                                                                            'type'    => 'select',
                                                                            'options' => $departamento,
                                                                            'default' => $insitu->ubigeo['cod_dep'],
                                                                            'empty'   => '-- DEPARTAMENTO --',
                                                              ]); ?>

                                                            <?php echo $this->Form->control('provincia', [
                                                                        'label'   => 'Provincia <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                        'class'   => 'form-control select2',
                                                                        'type'    => 'select',
                                                                        'options' => $provincias,
                                                                        'default' => empty($insitu->ubigeo_id)? '' : $insitu->ubigeo->cod_pro,
                                                                        'empty'   => ['0' => '-- PROVINCIA --']
                                                            ]) ?>

                                                            <?php echo $this->Form->control('distrito', [
                                                                        'label'    => 'Distrito <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                        'class'    => 'form-control select2',
                                                                        'type'     => 'select',
                                                                        'options'  => $distritos,
                                                                        'default'  => $insitu->ubigeo_id,
                                                                        'empty'    => ['0' => '-- DISTRITO --'],
                                                            ]) ?>       
                                                            </div>
                                                            <div class="col-lg-6">
                                                               <?php echo $this->Form->control('ubigeo_id', ['type' => 'hidden', 'id'=> 'ubigeo_id']) ?>

                                                                <?php echo $this->Form->control('reference', [
                                                                            'label' => 'Referencia de la Ubicación de la Zona ', 'escape'=> false ,
                                                                            'class' => 'form-control',
                                                                            'rows'   => 8,

                                                                ]); ?>                     
                                                            </div>
                                                            <!-- End Col -->
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <!-- End Row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                               <h4>:: Observaciones o Anotaciones<hr></h4>
                                                <div class="row">
                                                   <div class="col-lg-12"> 
                                                    
                                                      <?php echo $this->Form->control('observation', [
                                                        'label' => 'Para añadir información faltante o alguna observación relacionada a los datos de la Zona de Agrobiodiversidad', 'escape'=> false ,
                                                        'class' => 'form-control',
                                                        'type'  => 'textarea',
                                                        'rows'  => "5",
                                                     ]); ?>
                                                     <?php echo $this->Form->control('monitoring', [
                                                             'label'   => 'Monitoreo de la Zona', 'escape'=> false ,
                                                             'class'   => 'form-control',
                                                             'type'    => 'select',
                                                             'options' => ['1' => 'SI', '2' => 'NO'],
                                                             'empty'   => '[ SELECCIONE ]',
                                                      ]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                            <div class="col-lg-6">
                                                <h4><i class="fa fa-map-marker"></i> Datos de Georreferenciación<hr></h4>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                         <?php echo $this->Form->control('latitude', [
                                                                'label' => 'Latitud del sitio de la Zona <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                          ]); ?>
                                                         <?php echo $this->Form->control('length', [
                                                                'label' => 'Longitud del sitio de la Zona<b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                         ]); ?>
                                                        <?php echo $this->Form->control('altitude', [
                                                                'label' => 'Altitud del sitio de la Zona <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                       ]); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                         <h5><em>Nota: Los valores de coordenadas de <strong>LATITUD</strong> y <b>LONGITUD</b> deben ser de grados decimales. Para aplicar la conversión de <b>GRADOS, MINUTOS y SEGUNDOS</b> a <b>GRADOS DECIMALES</b> se debe utilizar la siguiente fórmula:</em> </h5>
                                                           <h5>Grados decimales:<br>(grados + (minutos/60) + (segundos/3600)) * -1</h5>
                                                    </div>
                                                </div>
                                                <!-- End Row -->  
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <!-- End Row -->
                                    </div>
                                    <!-- End Tab1 -->
                                    <div class="tab-pane" id="tabla2">
                                      <div class="row">
                                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                                <h4><i class="fa fa-leaf"></i> Datos de Chacra<hr></h4>
                                                 <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-xs-12"> 
                                                         <?php echo $this->Form->control('biophysical_description', [
                                                                          'label' => 'Descripción Biofísica', 
                                                                          'escape'=> false ,
                                                                          'type'  => 'textarea',
                                                                          'rows'  => "4",
                                                                          'class' => 'form-control',
                                                         ]); ?>
                                                    </div>
                                                 </div>
                                                 <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-xs-12"> 
                                                        <?php echo $this->Form->control('description_chakra', [
                                                                         'label' => 'Descripción de la Chacra', 
                                                                         'escape'=> false ,
                                                                         'type'  => 'textarea',
                                                                          'rows'  => "4",
                                                                         'class' => 'form-control',
                                                         ]); ?>
                                                    </div>
                                                 </div>
                                                 <div class="row">
                                                    <div class="col-lg-6"> 
                                                       
                                                        <?php echo $this->Form->control('type_soil', [
                                                                          'label'   => 'Tipo de Suelo',
                                                                          'escape'=> false ,
                                                                          'class'   => 'form-control select2',
                                                                          'type'    => 'select',
                                                                          'options' => $tipo_suelo,
                                                                          'empty'   => '[ SELECCIONE ]',
                                                         ]); ?>
                                                         <?php echo $this->Form->control('area', [
                                                                          'label' => 'Área', 
                                                                          'escape'=> false ,
                                                                          'class' => 'form-control',
                                                         ]); ?>
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        
                                                          <?php echo $this->Form->control('living_area', [
                                                                           'label' => 'Zona de Vida / Agroecológica', 
                                                                           'escape'=> false ,
                                                                           'class' => 'form-control',
                                                          ]); ?>
                                                          <?php echo $this->Form->control('meteorological_record', [
                                                                            'label' => 'Registros Meteorológicos', 
                                                                            'escape'=> false ,
                                                                            'class' => 'form-control',
                                                          ]); ?>

                                                    </div>
                                                 </div>
                                             </div> 
                                             <!-- End Col -->
                                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                                <h4><i class="fa fa-clipboard"></i> Información Adicional<hr></h4>
                                                <div class="row">
                                                   <div class="col-lg-6"> 
                                                      <?php echo $this->Form->control('degree_instruction', [
                                                                    'label'    => 'Grado de Instrucción del Agricultor', 'escape'=> false ,
                                                                    'class'    => 'form-control select2',
                                                                    'type'     => 'select',
                                                                    'options'  => $grado_instruccion,
                                                                    'empty'    => '[ SELECCIONE ]',
                                                        ]); ?>
                                                     <?php echo $this->Form->control('peasant_organization', [
                                                                            'label'   => 'Pertenece Org. Campesina',
                                                                            'class'   => 'form-control',
                                                                            'type'    => 'select',
                                                                            'options' => ['1' => 'SI', '2' => 'NO'],
                                                                            'default' => '2',
                                                      ]); ?>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <?php echo $this->Form->control('age_farmer', [
                                                                            'label' => 'Edad del Agricultor', 'escape'=> false ,
                                                                            'class' => 'form-control onlynumbers noPaste',
                                                      ]); ?>
                                                      <?php echo $this->Form->control('name_peasant_organization', [
                                                                    'label' => 'Nombre - Org. Campesina',
                                                                    'class' => 'form-control',
                                                                    'disabled' => true,
                                                      ]); ?>
                                                    </div>
                                                </div>
                                                <!-- End Row -->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                             <?php echo $this->Form->control('other_people', [
                                                                            'label' => 'Otras Personas',
                                                                            'type'  => 'textarea',
                                                                            'rows'  => "2",
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                                 <?php echo $this->Form->control('description_workers', [
                                                                             'label' => 'Descripción Trabajadores', 
                                                                             'escape'=> false ,
                                                                             'type'  => 'textarea',
                                                                             'rows'  => "2",
                                                                             'class' => 'form-control',
                                                                ]); ?>
                                                                <?php echo $this->Form->control('variety_number', [
                                                                            'label' => 'N° Variedades', 
                                                                            'escape'=> false ,
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                    </div>
                                                </div>
                                             </div>   

                                      </div>
                                      <!-- End Row-->
                                    </div>
                                    <!-- End Tab2 -->

                                </div>
                        </div>
                    </div>
                </div>
                 <div class="box-footer">
                    <div class="col-sm-12">
                         <div class="row  pull-right" >
                           
                            <?php /*echo $this->Html->link('CANCELAR', ['controller'=>'Insitu', 'action' =>'index'],['class'=>'btn btn-default', ]) */ ?>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/conservacion-in-situ', true) ?>"
                                     class="btn btn-default"><i class="fa fa-times"></i>  CANCELAR
                            </a>
                            <?php echo $this->Form->button('<i class="fa fa-save"></i> GUARDAR DATOS DE ZONA DE AGROBIODIVERSDAD',['class'=>'btn btn-success', 'id'=>'btnInsitu']) ?>
                          </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <!-- End panel-->
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#departamento, #provincia, #distrito, #degree-instruction, #type-soil").select2();', ['block' => 'script']);

?>
