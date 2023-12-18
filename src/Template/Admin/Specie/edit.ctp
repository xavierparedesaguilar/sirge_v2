
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - <em><?php echo $specie->genus.' '.$specie->species ?></em>  <?php echo $specie->autor;?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Especie', ['controller'=> 'Specie', 'action' => 'index']);
        $this->Html->addCrumb($specie->species, ['controller'=> 'Specie', 'action' => 'edit', 'id' => $specie->id]);
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
                <div class="panel-heading">
                    <h4 class="box-title"><i class="fa fa-pencil-square-o"></i> ACTUALIZACIÓN DE REGISTO DE LA ESPECIE</h4>
                </div>
                <?php echo $this->Form->create($specie, [
                    'url' => ['controller' => 'Specie', 'action' => 'edit'],
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
                                            'label' => ['text' => 'Nombre de la Especie <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                            'class' => 'form-control',
                                ]); ?>
                            </div>                           
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('autor', [
                                               'label' => ['text' => 'Autoría de la Especie ', 'escape'=> false , 'escape' => false],
                                               'class' => 'form-control',
                                    ]); ?>
                             </div>
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('cropname', [
                                                'label' => ['text' => 'Nombre Común <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                                'class' => 'form-control',
                                    ]); ?>
                             </div>                            
                         </div>
                         <div class="row">          
                             <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('family', [
                                             'label' => ['text' => 'Nombre de la Familia de la Especie ', 'escape'=> false , 'escape' => false],
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
                                    <h4 class="box-title">:: Tipo de Recurso y Colección<hr></h4>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('resource_id', [
                                    'type'    => 'select',
                                    'options' => $recursos,
                                    'default' => $id_coleccion->resource_id,
                                    'label'   => __('Tipo Recurso <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                    'class'   => 'form-control select2',
                                    'empty'   => '  SELECCIONAR RECURSO',
                                 ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('collection_id', [
                                        'type'   => 'select',
                                        'options'=> $collection,
                                        'label'  => __('Colección <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                        'class'  => 'form-control select2',
                                        'empty'  => ['0' => 'SELECCIONE COLECCIÓN'],
                                ]); ?>
                            </div>
                          
                       
                        </diV>
                        <div class="row">
                             <div class="col-xs-12 col-md-12 col-lg-12">
                                    <h4 class="box-title">:: Disponibilidad <hr></h4>
                             </div>
                        </div>
      
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('availability', [
                                        'type'   => 'select',
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'label'  => __('Disponibilidad de la Especie'),
                                        'class'  => 'form-control',
                                ]); ?>
                            </div>
                        </div>

                        
                        </diV>
                   </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12">
                         <div class="row  pull-right" >       
                            <?php echo $this->Html->link('<i class="fa fa-times"></i> CANCELAR', 
                                                  ['controller'=>'Specie', 'action' =>'index'],['class'=>'btn btn-default',  'escape' => false, 'data-toggle' => "tooltip",]) ?>                
                            <?php 
                            // echo $this->Form->button('GRABAR',['class'=>'btn btn-primary', 'id'=>'btnSpecie']) 
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