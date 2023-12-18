
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco Microorganismo', ['controller' => 'BankMicro', 'action' => 'index']);
        $this->Html->addCrumb($bankMicro->id, ['controller' => 'BankMicro', 'action' => 'edit','id'=>$bankMicro->id]);
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

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($bankMicro, [
                         // 'novalidate',
                        'autocomplete' => "off",
                        'id' => "form_bankMicro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#tabla1">Datos Principales</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla2">Cuarentena</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla3">Medio de Reactivación</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla4">Datos del Reactivador</a></li>

                            </ul>

                            <div class="tab-content">
                                <div id="tabla1" class="tab-pane in active">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label for="pasaporte">Código PER</label><b style="color:#dd4b39;"> (*)</b>
                                                <div class="input-group">
                                                    <input type="text" name="pasaporte" id="txtCodPasaporte" class="form-control" value="<?php echo empty($passport)? '' : $passport->accenumb ?>">
                                                    <span class="input-group-btn" style="padding-bottom: 18px;">
                                                        <button type="button" data-toggle="tooltip"  title="Validar Cod. PER" id="btnPasaporteMicro" class="btn btn-warning btn-flat" ><i class="fa fa-search " ></i></button>
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
                                        <div class="col-lg-6 col-sm-12 col-xs-12">

                                            <?php  echo $this->Form->control('codigoAccesion',[
                                                    'label'=> 'Código Accesión' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación exclusivo de las accesiones : código PER"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'value'=> $passport->othenumb,
                                                    'id'   => 'txtCodAccesion',
                                            ]); ?>

                                        </div>

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('collection',[
                                                    'label'=> 'Colección' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'value'=> $passport->specie->collection->colname,
                                                    'id'   => 'txtCollecion',
                                            ]); ?>

                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('especie',[
                                                    'label'  => 'Nombre Científico' ,
                                                    'escape' => false,
                                                    'class'  => 'form-control text-uppercase',
                                                    'value'  => $passport->specie->genus.' '.$passport->specie->species,
                                                    'id'     => 'txtEspecie',
                                            ]); ?>

                                        </div>

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('comun',[
                                                    'label'    => 'Nombre Común' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>',
                                                    'escape'   => false,
                                                    'class'    => 'form-control text-uppercase',
                                                    'id'       => 'txtComun',
                                                    'value'    => $passport->specie->cropname,
                                                    'disabled' => true,
                                            ]); ?>

                                        </div>



                                    </div>

                                    <div class="row">

                                            <?php echo $this->Form->hidden('passport_id',['id'=>'hdn_pasaporteid']);?>

                                             <div class="col-lg-6 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('fecha_aquisicion', [
                                                                'label' => ['text' => 'Fecha Adquisición <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que se incorporo el material "></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'value'=>$bankMicro->acqdate,
                                                                 'id'=>'fecha_aquisicion',
                                                                'readonly' => true
                                                    ]); ?>

                                            </div>

                                            <div class="col-lg-6 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('availability',
                                                            ['type' => 'select',
                                                            'options' => $lista_disponibilidad,
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

                                <div id="tabla2" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('risk',
                                                        ['type' => 'select',
                                                        'options' => $lista_riesgo,
                                                        'label' => __('Riesgo Biológico <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Grupos de riesgo de la colección de  microorganismos"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('lablevel',
                                                        ['type' => 'select',
                                                        'options' => $lista_nivel,
                                                        'label' => __('Nivel de Laboratorio' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el nivel de laboratorio para un determinado grupo de riesgo"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('quarplace', [
                                                            'label' => ['text' => 'Lugar de Cuarentena' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el lugar de deposito transitorio de la nuestra "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('quartime', [
                                                            'label' => ['text' => 'Tiempo de Cuarentena ' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo en el cual la muestra estará en cuarentena "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                    </div>
                                </div>

                                <div id="tabla3" class="tab-pane">


                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reactivation',
                                                        ['type' => 'select',
                                                        'options' => $lista_reactivacion,
                                                        'label' => __('Medio de Cultivo de Reactivación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio de reactivación del microorganismo"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control select2',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reactime', [
                                                            'label' => ['text' => 'Duración de Reactivación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo de reactivación del microorganismo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                          <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reactemp', [
                                                            'label' => ['text' => 'Temperatura de Reactivación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura que requiere el microorganismo su reactivación "></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                    </div>
                                </div>

                                <div id="tabla4" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('fecha_reactivacion', [
                                                                'label' => ['text' => 'Duración de la Reactivación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la reactivación del material"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'value'=>$bankMicro->reacdate,
                                                                 'id'=>'fecha_reactivacion',
                                                                // 'readonly' => true
                                                    ]); ?>

                                        </div>


                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reacresponsible', [
                                                            'label' => ['text' => 'Nombre del Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre del personal responsable del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('reacrem', [
                                                            'label' => ['text' => 'Motivo de la Reactivación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Motivo que esta realizando la reactivación"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>



                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnBankMicro">GRABAR</button>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-microorganismo', true) ?>" class="btn btn-default"> CANCELAR

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
    $("#fecha_aquisicion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

$this->Html->scriptBlock('
    $("#fecha_reactivacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);


?>