
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - EDITAR</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'PurityMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Prueba de Pureza');
        $this->Html->addCrumb($child, ['controller' => 'PurityMicro', 'action' => 'edit','id'=>$id,'child'=>$child]);
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
                    <?php echo $this->Form->create($purityMicro, [
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_purezaMicro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">
                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_prueba', [
                                                            'label' => ['text' => 'Fecha Prueba de Pureza' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de prueba de pureza"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value'=>$purityMicro->datepurz,
                                                            'id'=>'fecha_prueba',
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('isolamed_1',
                                                        ['type' => 'select',
                                                        'options' => $lista_aislamiento1,
                                                        'label' => 'Medio de Aislamiento 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio de cultivo no diferencial para el microorganimos"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('reactime_1', [
                                                            'label' => ['text' => 'Duración del Microorganismo Medio 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo de reactivación del microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('reactemp_1', [
                                                            'label' => ['text' => 'Temperatura del Medio 1' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura que requiere el microorganismo su reactivación "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('isolamed_2',
                                                        ['type' => 'select',
                                                        'options' => $lista_aislamiento2,
                                                        'label' => 'Medio de Aislamiento 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio de cultivo  diferencial para el microorganimos"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('reactime_2', [
                                                            'label' => ['text' => 'Duración del Microorganismo Medio 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo de reactivación del microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('reactemp_2', [
                                                            'label' => ['text' => 'Temperatura del Medio 2' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura que requiere el microorganismo su reactivación "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('gramstain',
                                                        ['type' => 'select',
                                                        'options' => $lista_tincion,
                                                        'label' => 'Tinción Gram' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tinción diferencial para ver si es un tipo de microorganismo "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                </div>

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('lactobluestain',
                                                        ['type' => 'select',
                                                        'options' => $lista_lactofenol,
                                                        'label' => 'Tinción con azul de Lactofenol' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tinción para ver si es un tipo de microorganismo "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                </div>

                        </div>
                    </div>


                    <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary" id="btnPurezaMicro">GRABAR</button>

                            <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'PurityMicro', 'action' => 'index','id'=>$id],
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
$this->Html->scriptBlock('$("#fecha_prueba").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

?>