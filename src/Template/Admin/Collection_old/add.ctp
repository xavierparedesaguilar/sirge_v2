
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - Nuevo</h1>

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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($collection, [
                    'url' => ['controller' => 'Collection', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id' => "form_collection"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('colname', [
                                        'label' => 'Nombre de la Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('colgroup', [
                                        'label' =>'Grupo de Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->Control('resource_id', [
                                        'empty'   => '-- SELECCIONE --',
                                        'label'  => 'Tipo de Recurso <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'options'=> $recursos,
                                        'type'   => 'select',
                                        'class'  => 'form-control'
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('eea',
                                        ['type'   => 'select',
                                        'options' => $stations,
                                        'label'   => __('Estación Experimental <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                        'class'   => 'form-control select2',
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('invitro', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco In Vitro',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('bseed', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco Semillas',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('bfield', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco Campo',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('bdna', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'type'   => 'select',
                                        'default'=>'2',
                                        'label'  => 'Banco ADN',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('insitu', [
                                        'options'=> ['1' => 'SI', '2' => 'NO'],
                                        'empty'   => ['0' => '-- SELECCIONE --'],
                                        'class'  => 'form-control',
                                        'default'=>'2',
                                        'label'  => 'Conservación In Situ',
                                        'type'   => 'select',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('availability', [
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
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-success', 'id'=>'btnCollection']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'Collection', 'action' =>'index'],['class'=>'btn btn-default', ]) ?>
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