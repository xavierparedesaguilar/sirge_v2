<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

       <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/zoogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco ADN', ['controller' => 'BankDnaZoo', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'OutputDnaZoo', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Salida');
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
                    <?php echo $this->Form->create($outputDna, [
                         'novalidate',
                        'url' => ['controller' => 'OutputDnaZoo', 'action' => 'add' ,'id'=>$id],
                        'autocomplete' => "off",
                        'id' => "form_add_outputDna",
                         'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('fecha_salida', [
                                                            'label' => ['text' => 'Fecha Salida' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de salida del material"></i>'],
                                                            'escape' => false,
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
                                                            'label' => ['text' => 'Número de Crioviales' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de crioviales que salen de una cepa"></i>'],
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

                                        <br>


                                </div>

                                 <div class="row">

                                           <div class="col-lg-12 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->input('remexit', ['type' => 'textarea',
                                                 'label' => 'Descripción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del motivo de la salida del material del banco"></i>',
                                                 'escape' => false,
                                                  'placeholder'=> false,'id'=>'descripcion', 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>

                                        </div>

                                </div>

                            </div>
                    </div>


                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnOutputDna">GRABAR</button>

                        <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'OutputDnaZoo', 'action' => 'index','id'=>$id],
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