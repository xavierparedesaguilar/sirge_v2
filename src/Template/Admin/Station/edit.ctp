
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo Estación Experimental Agraria : <?php echo h($station->eea) ?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Estación Experimental', ['controller'=> 'Station', 'action' => 'index']);
        $this->Html->addCrumb('Editar', ['controller' => 'Station', 'action' => 'edit', 'id' => $station->id]);
        $this->Html->addCrumb( $station->eea );

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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-default"">
                <div class="panel-heading">
                    <h4 class="box-title"><i class="fa fa-pencil-square-o"></i> ACTUALIZACIÓN DE LA INFORMACIÓN DE LA EEA. </h4>
                </div>
                <?php echo $this->Form->create($station, [
                    'url' => ['controller' => 'Station', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id' => "form_station"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-6 col-md-6 col-lg-6">
                         <div class="row">
                            <h4 class="box-title"><i class="fa fa-home" aria-hidden="true"></i> Información de la EEA<hr></h4>
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                 <?php echo $this->Form->control('eea', [
                                        'label' => ['text' => 'Nombre de la Estación Experimental Agraria <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                         </div>
                         <div class="row">
                            <h4 class="box-title"><i class="fa fa-address-card-o" aria-hidden="true"></i> Información del Responsable de RRGG.<hr></h4>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('responsible', [
                                        'label' => ['text' => 'Responsable <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                               <?php echo $this->Form->control('celphone', [
                                        'label' => ['text' => 'Celular <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>

                         </div>
                         <div class="row">
                         <div class="col-lg-6 col-sm-12 col-xs-12">
                               <?php echo $this->Form->control('telephone', [
                                        'label' => ['text' => 'Teléfono', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            
                           
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                               <?php echo $this->Form->control('email', [
                                        'label' => ['text' => 'Email <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                           
                         </div>
                         <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                            Los Campos con <b style="color:#dd4b39;" class="text-right">(*)</b> son datos obligatorios
                            </div>                          
                         </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-lg-6">
                         <div class="row">
                         <div class="col-lg-12"><h4><i class="fa fa-location-arrow"></i> Datos de Ubicación de la EEA.<hr></h4></div>
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('country_id', [
                                        'label'  => 'País <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'  => 'form-control select2',
                                        'type'   => 'select',
                                        'options'=> $countrys,
                                        'id'     => 'country_id',
                                        'empty'  => ['0' => '-- SELECCIONE --'],
                                 ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('departamento', [
                                        'label'   => 'Departamento',
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $regiones,
                                        'default' => $station->ubigeo['cod_dep'],
                                        'disabled' => ($station->country_id == 173)? false : true,
                                        'empty'   => ['0' => '-- DEPARTAMENTO --'],
                                ]) ?>
                            </div>                           
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('provincia', [
                                        'label'    => 'Provincia',
                                        'class'    => 'form-control select2',
                                        'type'     => 'select',
                                        'options'  => $provincias,
                                        'default'  => empty($station->ubigeo_id)? '' : $station->ubigeo->cod_pro,
                                        'disabled' => ($station->country_id == 173)? false : true,
                                        'empty'    => ['0' => '-- SELECCIONE --'],
                                ]) ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('distrito', [
                                        'label'    => 'Distrito',
                                        'class'    => 'form-control select2',
                                        'type'     => 'select',
                                        'options'  => $distritos,
                                        'default'  => $station->ubigeo_id,
                                        'disabled' => ($station->country_id == 173)? false : true,
                                        'empty'    => ['0' => '-- SELECCIONE --'],
                                ]) ?>
                                <?php echo $this->Form->control('ubigeo_id', ['id' => 'ubigeo_id', 'type' => 'hidden']) ?>
                            </div>                           
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                  <?php echo $this->Form->control('localidad', [
                                            'label' => ['text' => 'Localidad'],
                                            'class' => 'form-control',
                                    ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                 <?php echo $this->Form->control('collsite', [
                                        'label' => ['text' => 'Ubicación del Sitio <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                        'class' => 'form-control',
                                ]); ?>
                            </div>                           
                         </div>
                         <div class="row">
                           <div class="col-lg-12"><h4>:: Disponibilidad de la EEA.<hr></h4></div>
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('availability', [
                                        'label' => 'Disponibilidad',
                                        'class' => 'form-control',
                                        'type'  => 'select',
                                        'options' => ['1'=>'SI', '2' => 'NO'],
                                ]); ?>
                            </div>
                                                 
                         </div>
                         
                    </div>
               
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-right">
                        
                        <?php echo $this->Html->link('<i class="fa fa-times"></i> CANCELAR', 
                                                  ['controller'=>'Station', 'action' =>'index'],['class'=>'btn btn-default',  'escape' => false, 'data-toggle' => "tooltip",]) ?>                

                        
                        <button type="submit" class="btn btn-success" id="btnEstacion"><i class="fa fa-save"></i> GRABAR</button>
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
$this->Html->scriptBlock('$("#country_id, #departamento, #provincia, #distrito").select2();', ['block' => 'script']);

?>