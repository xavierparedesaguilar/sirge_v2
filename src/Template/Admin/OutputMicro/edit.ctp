<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'OutputMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Salida');
        $this->Html->addCrumb($child, ['controller' => 'OutputMicro', 'action' => 'edit','id'=>$id,'child'=>$child]);
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
                    <?php echo $this->Form->create($outputMicro, [
                         // 'novalidate',
                        'autocomplete' => "off",
                        'id' => "form_outputMicro",
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('fecha_salida', [
                                                            'label' => ['text' => 'Fecha Salida' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de salida del material"></i>'],
                                                            'escape' => false,
                                                            'value'=>$outputMicro->exitdate,
                                                            'class' => 'form-control',
                                                            // 'readonly' => true
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reqcode', [
                                                            'label' => ['text' => 'Código del Solicitante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto solicitante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reqname', [
                                                            'label' => ['text' => 'Nombre del Solicitante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del solicitante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                 </div>

                                 <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('numtubexit', [
                                                            'label' => ['text' => 'Número de Tubos' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de tubo que salen de una accesión in vitro"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('object', [
                                                            'label' => ['text' => 'Motivo de Salida' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Motivo de salida del material "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">

                                                <?php echo $this->Form->control('matersta',
                                                        ['type' => 'select',
                                                        'options' => $lista_estado,
                                                        'label' => __('Estado de Salida del Material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del estado en el que sale el microorganismo"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>


                                            </div>
                                        </div>


                                </div>

                                 <div class="row">

                                           <div class="col-lg-12 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->input('remexit', ['type' => 'textarea',
                                                'label' => 'Descripción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del motivo de la salida del material del banco"></i>' ,
                                                'escape' => false,
                                                'placeholder'=> false,'id'=>'descripcion', 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>

                                        </div>

                                </div>

                            </div>
                    </div>


                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnOutputMicro">GRABAR</button>

                        <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'OutputMicro', 'action' => 'index','id'=>$id],
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
    $("#fecha-salida").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>