
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo Especie</h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Especie', ['controller'=> 'Specie', 'action' => 'index']);
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
                <div class="panel-heading">
                <h4><i class="fa fa-file-o"></i> <?= __('NUEVO REGISTRO - ESPECIE') ?></h4>
                </div>
               
                <?php echo $this->Form->create($specie, [
                    'url' => ['controller' => 'Specie', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_specie"
                ]); ?>
                <div class="box-body">
                   <div class="col-xs-6 col-md-6 col-lg-6">
                        <div class="row">
                             <div class="col-xs-12 col-md-12 col-lg-12">
                                    <h4 class="box-title"><i class="fa fa-server" aria-hidden="true"></i> Información de la Especie<hr></h4>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('genus', [
                                            'label' => ['text' => 'Género de la Especie <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('species', [
                                            'label' => ['text' => 'Nombre Científico <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape'=> false ],
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('autor', [
                                             'label' => ['text' => 'Autor de la Especie ', 'escape'=> false , 'escape' => false],
                                             'class' => 'form-control',
                                    ]); ?>
                             </div>
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('cropname', [
                                                    'label' => ['text' => 'Nombre Común <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape'=> false ],
                                                    'class' => 'form-control',
                                        ]); ?>
                             </div>                            
                         </div>
                         <div class="row">          
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('family', [
                                                    'label' => ['text' => 'Familia <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape'=> false ],
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
                             <div class="col-xs-12 col-md-12 col-lg-12">
                                    <h4 class="box-title">::  Tipo de Recurso y Colección<hr></h4>
                             </div>
                        </div>
                        <div class="row">
                            
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('resource_id', [
                                                'type'   => 'select',
                                                'options'=> $recursos,
                                                'label'  => __('Tipo Recurso <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false ,
                                                'class'  => 'form-control select2',
                                                'empty'  => '-- SELECCIONE --',
                                        ]); ?>
                             </div> 
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('collection_id', [
                                                'type'   => 'select',
                                                'options'=> [],
                                                'label'  => __('Colección <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false ,
                                                'class'  => 'form-control select2',
                                                'empty'  => '-- SELECCIONE --',
                                        ]); ?>
                             </div>                           
                         </div>
                         <div class="row">
                             <div class="col-xs-12 col-md-12 col-lg-12">
                                    <h4 class="box-title">:: Disponibilidad <hr></h4>
                             </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->input('availability', [
                                        'type'   => 'select',
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'label'  => __('Disponibilidad'),
                                        'class'  => 'form-control',
                                ]); ?>
                            </div>
                         </div>
                   </div>
                    
                </div>
    
                <div class="box-footer">
                    <div class="col-sm-12">
                         <div class="row  pull-right">          
                            <?php echo $this->Html->link('<i class="fa fa-times"></i> CANCELAR', 
                                                  ['controller'=>'Specie', 'action' =>'index'],['class'=>'btn btn-default',  'escape' => false, 'data-toggle' => "tooltip",]) ?>
                            
                            <?php 
                            // echo $this->Form->button('GRABAR',['class'=>'btn btn-success', 'id'=>'btnSpecie'])
                            ?>    
                            <button type="submit" class="btn btn-success" id="btnSpecie"><i class="fa fa-save"></i> GUARDAR REGISTRO</button>                       
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
$this->Html->scriptBlock('$("#collection-id").select2();', ['block' => 'script']);

?>
