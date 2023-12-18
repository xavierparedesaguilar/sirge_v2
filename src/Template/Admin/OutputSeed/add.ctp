
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Semilla', ['controller' => 'BankSeed', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'OutputSeed', 'action' => 'index','id'=>$id]);
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
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>

                    <?php echo $this->Form->create($outputSeed, [
                        //'novalidate',
                        'url' => ['controller' => 'OutputSeed', 'action' => 'add' ,'id'=>$id],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_outputSeed",
                         //'novalidate'
                        ]); ?>
                        <div class="box-body">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div id="tabla1" class="tab-pane in active">
                                <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('fecha_salida', [
                                                            'label' => ['text' => 'Fecha Salida' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de salida del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            // 'readonly' => true
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reqcode', [
                                                            'label' => ['text' => 'Documento de Solicitante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto solicitante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reqname', [
                                                            'label' => ['text' => 'Nombre del Solicitante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del solicitante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                 </div>

                                 <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('numbagexit', [
                                                            'label' => ['text' => 'Número de Semillas' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de bolsas que salen de una accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control onlynumbers',
                                                ]); ?>

                                        </div>

                                         <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reason', [
                                                            'label' => ['text' => 'Motivo de Salida' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Motivo de salida del material "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>


                                </div>

                                 <div class="row">

                                         <div class="col-lg-12 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->input('remexit', ['type' => 'textarea',
                                                'label' => 'Descripción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del motivo de la salida del material del banco"></i>',
                                                'escape' => false,
                                                 'placeholder'=> false, 'escape' => false,'id'=>'remexi','class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>

                                        </div>

                                </div>

                            </div>

                        </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-success" id="btnOutputSeed">GRABAR</button>
                                <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-semilla/'.$outputSeed->bank_seed_id.'/salida', true) ?>"
                                   class="btn btn-default waves-effect m-l-5"> CANCELAR
                                </a>

                            </div>
                        </div>

                    </div>
                <?= $this->Form->end() ?>
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
