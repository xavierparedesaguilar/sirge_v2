
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

       <?php

        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'InputMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Entrada');
        $this->Html->addCrumb($child, ['controller' => 'InputMicro', 'action' => 'edit','id'=>$id,'child'=>$child]);
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


<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                    <?php echo $this->Form->create($inputMicro, [
                         // 'novalidate',
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_inputMicro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">
                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_entrada', [
                                                            'label' => ['text' => 'Fecha Entrada' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de entrada del material del donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value'=>$inputMicro->enterdate,
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donorcore', [
                                                            'label' => ['text' => 'Código del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donorname', [
                                                            'label' => ['text' => 'Nombre del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donornumb', [
                                                            'label' => ['text' => 'Código de Accesión del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código  asignado a una accesión por el donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>


                                            </div>
                                        </div>

                                </div>
                                <div class="row">


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('numtubent', [
                                                            'label' => ['text' => 'Número de Tubos' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de tubos/viales que entran de una muestra de microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control onlynumbers noPaste',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('tipdep',
                                                        ['type' => 'select',
                                                        'options' => $lista_deposito,
                                                        'label' => 'Tipo Depósito' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la categoría de depósito del microorganismo"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('estmuestra',
                                                        ['type' => 'select',
                                                        'options' => $lista_estado,
                                                        'label' => 'Estado de la Muestra' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la condición de recepción de la muestra "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('sampstat', [
                                                            'label' => ['text' => 'Condición Biológica' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Condición biológica"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'readonly' => true,
                                                            'value'=>isset($optionList_obj->name)?$optionList_obj->name:''
                                                ]); ?>
                                            </div>
                                        </div>

                                </div>

                                <div class="row">

                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->input('rement', ['type' => 'textarea',
                                                'label' => 'Descripción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del motivo de la entrada del material al banco"></i>' ,
                                                'escape' => false,
                                                'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>
                                            </div>
                                        </div>

                                </div>

                        </div>
                    </div>


                    <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary" id="btnInputMicro">GRABAR</button>

                            <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'InputMicro', 'action' => 'index','id'=>$id],
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
    $("#fecha-entrada").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>