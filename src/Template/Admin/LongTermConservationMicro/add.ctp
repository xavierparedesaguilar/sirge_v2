
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($id ,['controller' => 'LongTermConservationMicro', 'action' => 'index','id'=>$id]);
        $this->Html->addCrumb('Largo Plazo');
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
                    <?php echo $this->Form->create($longTermConservationMicro, [
                         // 'novalidate',
                        'url' => ['controller' => 'longTermConservationMicro', 'action' => 'add' ,'id'=>$id],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_conservationMicro",
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
                                                            'value'=>$longTermConservationMicro->constime,
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

                                                <?php echo $this->Form->control('longtermcon',
                                                        ['type' => 'select',
                                                        'options' => $lista_medio_conservacion,
                                                        'label' => 'Medio de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio necesario para la conservación a largo plazo "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                </div>
                                <div class="row">


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('longtermtemp', [
                                                            'label' => ['text' => 'Temperatura' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define la temperatura se debe conservar el microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('longtermtime', [
                                                            'label' => ['text' => 'Tiempo de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define el tiempo que se debe conservar el microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('criopro',
                                                        ['type' => 'select',
                                                        'options' => $lista_crioprotector,
                                                        'label' => 'Crioprotector' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de soluciones usadas para crioperservación "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('longtermtype',
                                                        ['type' => 'select',
                                                        'options' => $lista_conservacion,
                                                        'label' => 'Tipo de Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de conservación a largo plazo "></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>


                                </div>

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('criovinumb', [
                                                            'label' => ['text' => 'Número de Crioviales' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de crioviales que se mantienen por cada material "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('crioviminstock', [
                                                            'label' => ['text' => 'Stock Mínimo de Crioviales' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Stock mínimo de crioviales que se debe mantener del material de liofilizados y crioperservados"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('longstornumb', [
                                                            'label' => ['text' => 'Código Almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del equipo de almacenamiento"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('longstorage',
                                                        ['type' => 'select',
                                                        'options' => $lista_lugar_almacenamiento,
                                                        'label' => 'Lugar Almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lugares de almacenamiento donde se mantiene el material"></i>',
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                </div>

                                <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('criolevel', [
                                                            'label' => ['text' => 'Nivel de Estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nivel de estantería donde se encuentra la gradilla con el criobox"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <?php echo $this->Form->control('criorack', [
                                                                'label' => ['text' => 'Código de la Gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de almacenamiento del criobox"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('longrackpos', [
                                                            'label' => ['text' => 'Posición dentro de la Gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criobox dentro de la gradilla"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('longcrionumb', [
                                                            'label' => ['text' => 'Número de Criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de criobox donde  se encuentra el material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                </div>

                                <div class="row">


                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <?php echo $this->Form->control('longcriopos', [
                                                                'label' => ['text' => 'Posición Dentro del Criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criovial dentro del criobox"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                    ]); ?>
                                                </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('amprack', [
                                                            'label' => ['text' => 'Código de Almacenamiento N2 Líquido' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de almacenamiento de la ampolla"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <?php echo $this->Form->control('amppos', [
                                                            'label' => ['text' => 'Posición del Criovial en la Ampolla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criovial en la ampolla"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-xs-12">

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
                            <button type="submit" class="btn btn-success" id="btnConservationMicro">GRABAR</button>

                            <?php echo $this->Html->link('CANCELAR',
                                        ['controller' => 'longTermConservationMicro', 'action' => 'index','id'=>$id],
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