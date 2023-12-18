
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

         <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'shortTermConservationMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Corto Plazo');
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


<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                    <?php echo $this->Form->create($shortTermConservationMicro, [
                         // 'novalidate',
                        'url' => ['controller' => 'shortTermConservationMicro', 'action' => 'add' ,'id'=>$id],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_conservationShortMicro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">
                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_conservacion', [
                                                            'label' => ['text' => 'Fecha de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la conservación del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value'=>$shortTermConservationMicro->constime,
                                                            'id'=>'fecha_conservacion',
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('consresponsible', [
                                                            'label' => ['text' => 'Nombre del Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del personal responsable del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('consrem', [
                                                            'label' => ['text' => 'Motivo de la Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Motivo que esta realizando la conservación"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('shortermcon',
                                                        ['type' => 'select',
                                                        'options' => $lista_conservacion,
                                                        'label' => 'Medio de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define el medio en cual se debe conservar el microorganismo"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                </div>
                                <div class="row">


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortermtemp', [
                                                            'label' => ['text' => 'Temperatura' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define la temperatura se debe conservar el microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortermtime', [
                                                            'label' => ['text' => 'Tiempo de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define el tiempo que se debe conservar el microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('shortmatstor',
                                                        ['type' => 'select',
                                                        'options' => $lista_material,
                                                        'label' => 'Material de Almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de material donde se almacena la muestra"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortmatnumb', [
                                                            'label' => ['text' => 'Número de Material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de material que se mantienen por cada muestra "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                </div>

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortminstock', [
                                                            'label' => ['text' => 'Stock Mínimo' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Stock mínimo que se debe mantener del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortstornumb', [
                                                            'label' => ['text' => 'Código Almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del equipo de almacenamiento"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('shortstorage',
                                                        ['type' => 'select',
                                                        'options' => $lista_lugar_almacenamiento,
                                                        'label' => 'Lugar de Almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lugares de almacenamiento donde se mantiene el material"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortlevsh', [
                                                            'label' => ['text' => 'Nivel de Estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nivel de estantería donde se encuentra la gradilla con el tubo o placa con la muestra"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                </div>

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('criorack', [
                                                            'label' => ['text' => 'Código de la Gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de la gradilla"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('shortrackpos', [
                                                            'label' => ['text' => 'Posición Dentro de la Gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del tubo o placa dentro de la gradilla"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('fecha_renovacion', [
                                                                'label' => ['text' => 'Fecha Renovación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la conservación del material"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control date-picker',
                                                                 'id'=>'fecha_renovacion'
                                                    ]); ?>

                                        </div>


                                </div>

                        </div>
                    </div>


                    <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-success" id="btnConservationShortMicro">GRABAR</button>

                            <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'shortTermConservationMicro', 'action' => 'index','id'=>$id],
                                        ['class' => 'btn btn-default', 'escape'=>false] )
                            ?>

                    </div>

                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?php

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha_conservacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha_renovacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);



?>