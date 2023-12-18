
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'inputInvitro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Entrada');
        $this->Html->addCrumb($child, ['controller' => 'inputInvitro', 'action' => 'edit','id'=>$id,'child'=>$child]);
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
                    <?php echo $this->Form->create($inputInvitro, [
                         // 'novalidate',
                         'autocomplete' => "off",
                         'id' => "form_inputInvitro",
                    ]); ?>

                        <div class="box-body">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div id="tabla1" class="tab-pane in active">
                                    <div class="row">


                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_entrada', [
                                                            'label' => ['text' => 'Fecha Entrada' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha de entrada del material del donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                             'id'=>'fecha_entrada',
                                                             'value'=>$inputInvitro->enterdate
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donorcore', [
                                                            'label' => ['text' => 'Código del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código dado al instituto donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donorname', [
                                                            'label' => ['text' => 'Nombre del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('donornumb', [
                                                            'label' => ['text' => 'Código de Accesión del Donante' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código  asignado a una accesión por el donante"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>


                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('tubentnumb', [
                                                            'label' => ['text' => 'Número de Tubos de Entrada' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de tubo que entran de una accesión in vitro"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('explentnumb', [
                                                            'label' => ['text' => 'Número de Explantes de Entrada' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de explantes que entran in vitro de una accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>


                                            </div>
                                        </div>

                                </div>
                                <div class="row">

                                         <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->input('rement', ['type' => 'textarea',
                                                'label' => 'Descripción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Descripción del motivo de la entrada del material al banco"></i>',
                                                'escape' => false,
                                                 'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>
                                            </div>
                                        </div>

                                </div>

                            </div>
                    </div>


                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnInputInvitro">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/'.$bankInvitro->id.'/entrada', true) ?>"
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
    $("#fecha_entrada").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>