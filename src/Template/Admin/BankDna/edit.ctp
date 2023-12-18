
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

       <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco ADN', ['controller' => 'BankDna', 'action' => 'index']);
        $this->Html->addCrumb($bankDna->id, ['controller' => 'BankDna', 'action' => 'edit','id'=>$bankDna->id]);
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
<!-- /Page Breadcrumb -->
<!-- Page Header -->

<!-- /Page Header -->
<!-- Page Body -->


<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                    <?php echo $this->Form->create($bankDna, [
                         // 'novalidate',
                        'url' => ['controller' => 'BankDna', 'action' => 'edit'],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id' => "form_bankAdn",
                         // 'novalidate'
                    ]); ?>
                 <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="tab-content">
                                <div id="tabla1" class="tab-pane in active">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label for="pasaporte">Código PER <b style="color:#dd4b39;">(*)</b></label>
                                                <div class="input-group">
                                                    <input type="text" name="pasaporte" id="txtCodPasaporte" class="form-control" value="<?php echo isset($passport)? $passport->accenumb :''?>">
                                                    <span class="input-group-btn" style="padding-bottom: 18px;">
                                                        <button type="button" data-toggle="tooltip"  title="Validar Cod. PER" id="btnPasaporteCampoAdn" class="btn btn-warning btn-flat" ><i class="fa fa-search " ></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label id="msjBancoInvitro" style="display: block; color: red; padding-top: 30px"></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                            <?php  echo $this->Form->control('codigoAccesion',[
                                                    'label'=> 'Código Accesión' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación exclusivo de las accesiones : código PER"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'id'   => 'txtCodAccesion',
                                                    'value'=>$passport->othenumb
                                            ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('collection',[
                                                    'label'=> 'Colección' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'id'   => 'txtCollecion',
                                                    'value'=>$passport->specie->collection->colname
                                            ]); ?>

                                        </div>


                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('especie',[
                                                    'label'  => 'Nombre Científico' ,
                                                    'escape' => false,
                                                    'class'  => 'form-control text-uppercase',
                                                    'id'     => 'txtEspecie',
                                                    'value'  => $passport->specie->genus.' '.$passport->specie->species
                                            ]); ?>

                                        </div>

                                    </div>

                                    <div class="row">

                                            <?php echo $this->Form->hidden('passport_id',['id'=>'hdn_pasaporteid']);?>


                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('comun',[
                                                    'label'    => 'Nombre Común' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>',
                                                    'escape'   => false,
                                                    'class'    => 'form-control text-uppercase',
                                                    'id'       => 'txtComun',
                                                    'value'    => $passport->specie->cropname,
                                                    'disabled' => true,
                                            ]); ?>

                                        </div>

                                             <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('fecha_aquisicion', [
                                                                'label' => ['text' => 'Fecha Adquisición' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que se incorporo la accesión a la colección"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'value'=>$bankDna->acqdate,
                                                                'id'=>'fecha_aquisicion',
                                                                // 'readonly' => true
                                                    ]); ?>

                                            </div>

                                            <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('availability',
                                                            ['type' => 'select',
                                                            'options' => $tipo_disponibilidad,
                                                            'label' => __('Disponibilidad del lote de le Accesión <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad del lote de le Accesión (si/no)"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->input('remarks', ['type' => 'textarea',
                                                    'label' => 'Anotaciones' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Para añadir notas o para completar datos faltantes "></i>',
                                                    'escape' => false,
                                                     'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>

                                            </div>
                                    </div>

                                </div>

                        </div>

                        <div class="footer">
                            <div class="col-sm-12 text-center">

                                <button type="submit" class="btn btn-primary" id="btnBankAdn">GRABAR</button>

                                 <?php echo $this->Html->link('CANCELAR',
                                                ['controller' => 'BankDna', 'action' => 'index'],
                                                ['class' => 'btn btn-default', 'escape'=>false] )
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="horizontal-space"></div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<?php

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha_aquisicion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>