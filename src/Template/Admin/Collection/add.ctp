
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo Colección</h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Colección', ['controller'=> 'Collection', 'action' => 'index']);
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
                    <h4><i class="fa fa-file-o"></i> <?= __('NUEVA COLECCIÓN') ?></h4>
                </div>
                <?php echo $this->Form->create($collection, [
                    'url' => ['controller' => 'Collection', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_collection"
                ]); ?>
                <div class="box-body">
                
                    <div class="col-lg-6"> 
                        <h4 class="box-title"><i class="fa fa-server" aria-hidden="true"></i> Información de la Colección<hr></h4>
                        <div class="row"> 
                           <div class="col-lg-6 col-sm-12 col-xs-12">
                               <?php echo $this->Form->control('colname', [
                                        'label' => 'Nombre de la Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                                 <?php echo $this->Form->control('colgroup', [
                                        'label' =>'Grupo que pertenece la Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                              <?php echo $this->Form->control('availability', [
                                        'type'   => 'select',
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'label'  => __('Disponibilidad'),
                                        'class'  => 'form-control',
                                ]); ?>

                            Los Campos con <b style="color:#dd4b39;" class="text-right">(*)</b> son datos obligatorios
                           </div>
                           <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->Control('resource_id', [
                                            'empty'   => '-- SELECCIONE --',
                                            'label'  => 'Tipo de Recurso <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'options'=> $recursos,
                                            'type'   => 'select',
                                            'class'  => 'form-control'
                                    ]); ?>

                                <?php echo $this->Form->control('eea',
                                        ['type'   => 'select',
                                        'options' => $stations,
                                        'label'   => __('Estación Experimental Agraria <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                        'class'   => 'form-control select2',
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                ]); ?>                                 

                           </div>
                        </div>
                      </div>
                    <div class="col-lg-6"> 
                        <h4 class="box-title"><i class="fa fa-university" aria-hidden="true"></i> Lugares de Almacenamiento donde se encuentra la Colección<hr></h4>
                        <div class="row"> 
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                            <?php echo $this->Form->control('bfield', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco de Campo',
                                ]); ?>
                                <?php echo $this->Form->control('bseed', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco de Semillas',
                                ]); ?>
                                 <?php echo $this->Form->control('insitu', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'default'=>'2',
                                        'label'  => 'Conservación In Situ',
                                        'type'   => 'select',
                                ]); ?>

                              
                                
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('invitro', [
                                                'options'=> ['1' => 'SI', '2' => 'NO'],
                                                'empty'   => ['0' => '-- SELECCIONE --'],
                                                'class'  => 'form-control',
                                                'type'   => 'select',
                                                'default'=>'2',
                                                'label'  => 'Banco de In Vitro',
                                        ]); ?>
                                     <?php echo $this->Form->control('bdna', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco de ADN',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                
              
                   
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-right">
                        
                        <?php echo $this->Html->link('<i class="fa fa-times"></i> CANCELAR', 
                                                  ['controller'=>'Collection', 'action' =>'index'],['class'=>'btn btn-default',  'escape' => false, 'data-toggle' => "tooltip",]) ?>
                        <?php echo $this->Form->button('<i class="fa fa-save"></i> GUARDAR REGISTRO',['class'=>'btn btn-success', 'id'=>'btnCollection']) ?>
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
$this->Html->scriptBlock('$("#eea").select2();', ['block' => 'script']);

?>