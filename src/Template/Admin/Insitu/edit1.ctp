
<?php $this->assign('title', $mod_modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?> - Editar</h1>

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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($insitu, [
                    'url' => ['controller' => 'Insitu', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id' => "form_insitu"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab"><strong>Datos Geográficos - Agricultor</strong></a></li>
                                <li><a href="#tab_2" data-toggle="tab"><strong>Datos Chacra</strong></a></li>
                                <li><a href="#tab_3" data-toggle="tab"><strong>Datos Generales</strong></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-6">
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Datos Geográficos</h3>
                                                </div>
                                                <div class="box-body">
                                                    <?php echo $this->Form->control('departamento', [
                                                            'label'   => 'Departamento <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
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

                                                    <?php echo $this->Form->control('ubigeo_id', ['type' => 'hidden', 'id'=> 'ubigeo_id']) ?>

                                                    <?php echo $this->Form->control('reference', [
                                                                'label' => 'Referencia <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                    <?php echo $this->Form->control('latitude', [
                                                                'label' => 'Latitud <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                    <?php echo $this->Form->control('length', [
                                                                'label' => 'Longitud <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                    <?php echo $this->Form->control('altitude', [
                                                                'label' => 'Altitud <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-12 col-lg-6">
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Agricultor</h3>
                                                </div>
                                                <div class="box-body">
                                                    <?php echo $this->Form->control('name_farmer', [
                                                                'label' => 'Nombre <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                    <?php echo $this->Form->control('address_farmer', [
                                                                'label' => 'Dirección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                    <?php echo $this->Form->control('degree_instruction', [
                                                                'label'   => 'Grado de Instrucción <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class'   => 'form-control select2',
                                                                'type'    => 'select',
                                                                'options' => $grado_instruccion,
                                                                'empty'   => '[ SELECCIONE ]',
                                                    ]); ?>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('age_farmer', [
                                                                        'label' => 'Edad <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                        'class' => 'form-control onlynumbers noPaste',
                                                            ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('peasant_organization', [
                                                                        'label'   => 'Pertenece Org. Campesina',
                                                                        'class'   => 'form-control',
                                                                        'type'    => 'select',
                                                                        'options' => ['1' => 'SI', '2' => 'NO'],
                                                                        'default' => '2',
                                                            ]); ?>
                                                        </div>
                                                    </div>

                                                    <?php echo $this->Form->control('name_peasant_organization', [
                                                                'label' => 'Nombre - Org. Campesina',
                                                                'class' => 'form-control',
                                                                'disabled' => ($insitu->peasant_organization == 1)? false : true,
                                                    ]); ?>
                                                       <?php echo $this->Form->control('other_people', [
                                                                'label' => 'Otras Personas',
                                                                'type'  => 'textarea',
                                                                'rows'  => "5",
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('biophysical_description', [
                                                        'label' => 'Descripción Biofísica <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class' => 'form-control',
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('description_chakra', [
                                                        'label' => 'Descripción de la Chacra <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class' => 'form-control',
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('type_soil', [
                                                        'label'   => 'Tipo de Suelo <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class'   => 'form-control select2',
                                                        'type'    => 'select',
                                                        'options' => $tipo_suelo,
                                                        'empty'   => '[ SELECCIONE ]',
                                            ]); ?>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('area', [
                                                        'label' => 'Área <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class' => 'form-control',
                                            ]); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('living_area', [
                                                        'label' => 'Zona de Vida / Agroecológica <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class' => 'form-control',
                                            ]); ?>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php echo $this->Form->control('meteorological_record', [
                                                        'label' => 'Registros Meteorológicos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class' => 'form-control',
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    <?php echo $this->Form->control('observation', [
                                                'label' => 'Observaciones <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                'class' => 'form-control',
                                    ]); ?>
                                    <?php echo $this->Form->control('description_workers', [
                                                'label' => 'Descripción Trabajadores <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                'class' => 'form-control',
                                    ]); ?>
                                    <?php echo $this->Form->control('monitoring', [
                                                'label'   => 'Monitoreo <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                'class'   => 'form-control',
                                                'type'    => 'select',
                                                'options' => ['1' => 'SI', '2' => 'NO'],
                                                'empty'   => '[ SELECCIONE ]',
                                    ]); ?>
                                    <?php echo $this->Form->control('ministerial_resolution', [
                                                'label' => 'Resolución Ministerial <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                'class' => 'form-control',
                                    ]); ?>
                                    <?php echo $this->Form->control('variety_number', [
                                                'label' => 'N° Variedades <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                'class' => 'form-control',
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-primary', 'id'=>'btnInsitu']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'Insitu', 'action' =>'index'],['class'=>'btn btn-default', ]) ?>
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
$this->Html->scriptBlock('$("#departamento, #provincia, #distrito, #degree-instruction, #type-soil").select2();', ['block' => 'script']);

?>
