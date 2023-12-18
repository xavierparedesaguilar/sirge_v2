<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);
        $this->Html->addCrumb($id, ['controller' => 'ConservationInvitro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Conservación');
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
                    <?php echo $this->Form->create($conservationInvitro, [
                        // 'novalidate',
                        'url' => ['controller' => 'ConservationInvitro', 'action' => 'add' ,'id'=>$id],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_conservationMicro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div id="tabla1" class="tab-pane in active">
                                <div class="row">


                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('fecha_conservacion', [
                                                            'label' => ['text' => 'Fecha Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la conservación del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            // 'readonly' => true
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('consresponsible', [
                                                            'label' => ['text' => 'Personal Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del personal responsable del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('stoper', [
                                                            'label' => ['text' => 'Periodo de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title=" Periodo de conservación del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->input('consrem', ['type' => 'textarea',
                                                                                        'label' => 'Motivo de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Motivo que esta realizando la conservación"></i>',
                                                                                        'escape' => false,
                                                                                        'placeholder'=> false, 'escape' => false,
                                                                                        'class' =>'comment', 'rows' => '5',
                                                                                        'cols' => '5']); ?>
                                            </div>
                                        </div>



                                </div>

                            </div>
                    </div>

                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnConservationMicro">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro/'.$conservationInvitro->bank_invitro_id.'/conservacion', true) ?>"
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
    $("#fecha-conservacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>