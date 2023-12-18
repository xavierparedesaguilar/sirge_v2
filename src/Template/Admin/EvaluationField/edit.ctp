<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">

    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

    <?php

        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Campo', ['controller' => 'BankField', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'EvaluationField', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Evaluación');
        $this->Html->addCrumb($child, ['controller' => 'EvaluationField', 'action' => 'edit','id'=>$id,'child'=>$child]);
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
                   <?php echo $this->Form->create($evaluationField, [
                         // 'novalidate',
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_evaluationField",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div id="tabla1" class="tab-pane in active">
                                <div class="row">


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_evaluacion', [
                                                            'label' => ['text' => 'Fecha Evaluación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de evaluación del experimento"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'value' => $evaluationField->evaldate,
                                                            'id'    => 'fecha-evaluacion',
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('evalname', [
                                                            'label' => ['text' => 'Nombre del Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del responsable de la evaluación"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('evalrem', [
                                                            'label' => ['text' => 'Descripción de la Evaluación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción de la evaluación"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">

                                                <?php echo $this->Form->control('prodtype',
                                                        ['type' => 'select',
                                                        'options' => $lista_producto,
                                                        'label' => __('Tipo de Producto' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de producción científica - técnica"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>


                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('harvest', [
                                                            'label' => ['text' => 'Época de Cosecha' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Época del año en que se cosecha"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">

                                         <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->input('prodrem', ['type' => 'textarea',
                                                'label' => 'Descripción del producto' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del producto"></i>',
                                                'escape' => false,
                                                 'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>
                                            </div>
                                        </div>

                                </div>

                            </div>
                    </div>


                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnEvaluationField">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-campo/'.$evaluationField->bank_field_id.'/evaluacion', true) ?>"
                           class="btn btn-default waves-effect m-l-5"> CANCELAR
                        </a>
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
    $("#fecha-evaluacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>
