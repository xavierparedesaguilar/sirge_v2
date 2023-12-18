
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Nuevo</h1>

      <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco In Vitro', ['controller' => 'BankInvitro', 'action' => 'index']);
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

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($bankInvitro, [
                         // 'novalidate',
                        'url' => ['controller' => 'BankInvitro', 'action' => 'add'],
                        'autocomplete' => "off",
                        'id' => "form_bankInvitro",
                         // 'novalidate'
                    ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#tabla1"> Datos Principales</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla2">Cuarto de Conservación</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla3">Ubicación de Material</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla4">Estado de Planta</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla5"> Medio Cultivo</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla6"> Stock de Tubos</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla7">Estado Fitosanitario</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="tabla1" class="tab-pane in active">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group text">
                                                <label for="pasaporte">Código PER </label><b style="color:#dd4b39;"> (*)</b>
                                                <div class="input-group">
                                                    <input type="text" name="pasaporte" id="txtCodPasaporte" class="form-control">
                                                    <span class="input-group-btn" style="padding-bottom: 18px;">
                                                        <button type="button" data-toggle="tooltip"  title="Validar Cod. PER" id="btnPasaporteInvitro" class="btn btn-warning btn-flat" ><i class="fa fa-search " ></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
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
                                                    'id'   => 'txtCodAccesion',
                                            ]); ?>
                                        </div>

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('collection',[
                                                    'label'=> 'Colección' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control',
                                                    'id'   => 'txtCollecion',
                                            ]); ?>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('especie',[
                                                    'label'=> 'Nombre Científico' ,
                                                    'escape' => false,
                                                    'class'=> 'form-control text-uppercase',
                                                    'id'   => 'txtEspecie',
                                            ]); ?>
                                        </div>

                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <?php  echo $this->Form->control('comun',[
                                                    'label'=> 'Nombre Común' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>',
                                                    'escape' => false,
                                                    'class'=> 'form-control text-uppercase',
                                                    'id'   => 'txtComun',
                                                    'disabled'=>true,
                                            ]); ?>
                                        </div>
                                    </div>

                                    <div class="row">

                                            <?php echo $this->Form->hidden('passport_id',['id'=>'hdn_pasaporteid']);?>

                                             <div class="col-lg-6 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('fecha_aquisicion', [
                                                                'label' => ['text' => 'Fecha Adquisición' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha en la que se incorporo el material a la colección in vitro"></i>'],
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'value'=>$bankInvitro->acqdate,
                                                                 'id'=>'fecha_aquisicion',
                                                                // 'readonly' => true
                                                    ]); ?>

                                            </div>

                                            <div class="col-lg-6 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('availability',
                                                            ['type' => 'select',
                                                            'options' => $tipo_disponibilidad,
                                                            'label' => 'Disponibilidad del lote de le Accesión <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Disponibilidad del lote de le Accesión "></i>',
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

                                                <?php echo $this->Form->control('storoom',
                                                        ['type' => 'select',
                                                        'options' => $tipo_conservacion,
                                                        'label' => __('Cuarto de Conservación <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lugar donde se conserva el material de acuerdo a la temperatura"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>
                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('temp',
                                                        ['type' => 'select',
                                                        'options' => $temperatura,
                                                        'label' => __('Temperatura <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Temperatura del lugar de conservación"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                    </div>

                                </div>

                                <div id="tabla3" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('shelving', [
                                                            'label' => ['text' => 'Estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Ubicación del material dentro del cuarto de conservación"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('levelshelv', [
                                                            'label' => ['text' => 'Nivel de estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nivel de estantería donde  se encuentra la gradilla con el tubo con accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('rack', [
                                                            'label' => ['text' => 'Gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de gradilla donde  se encuentra el tubo de la accesión"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('duplinstname', [
                                                            'label' => ['text' => 'Duplicado de Seguridad' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title=" Lugar donde se guarda una replica del material de in vitro"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('dupnumb', [
                                                            'label' => ['text' => 'Número de Duplicados' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de duplicados de una replica del material de in vitro"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>
                                    </div>
                                </div>

                                <div id="tabla4" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('plastate',
                                                            ['type' => 'select',
                                                            'options' => $lista_estado_planta,
                                                            'label' => __('Estado de la Planta' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Viabilidad del material mantenidas en condición in vitro"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('necrosis',
                                                            ['type' => 'select',
                                                            'options' => $lista_necrosis,
                                                            'label' => __('Necrosis de Yema y Talla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lesiones oscuras en la yaema y tallo debido a la presencia de células muertas"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                         </div>

                                         <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('defoliation',
                                                            ['type' => 'select',
                                                            'options' => $lista_defolacion,
                                                            'label' => __('Defoliación (%)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title=" Caída de hojas del material vegetal "></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('rooting',
                                                        ['type' => 'select',
                                                        'options' => $lista_enraizamiento,
                                                        'label' => __('Enraizamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Cpacidad del material vegetal de formar raiz en el medio de cultivo in vitro"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('chlorosis',
                                                            ['type' => 'select',
                                                            'options' => $lista_clorosis,
                                                            'label' => __('Clorosis' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Amarillamiento del tejido foliar "></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                    <?php echo $this->Form->control('phenolization',
                                                            ['type' => 'select',
                                                            'options' => $lista_fenolizacion,
                                                            'label' => __('Fenolización' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Oxidación u oscurecimiento del medio de cultivo in vitro"></i>'),
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                            'empty' => '-- SELECCIONE --' ]);
                                                    ?>

                                        </div>

                                    </div>
                                </div>

                                <div id="tabla5" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('storage',
                                                        ['type' => 'select',
                                                        'options' => $lista_almacenamiento,
                                                        'label' => __('Tipo de almacenamiento <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de medio donde se almacena el material"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('propagation',
                                                        ['type' => 'select',
                                                        'options' => $lista_propagacion,
                                                        'label' => __('Propagación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio propagación del material"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>


                                        </div>

                                         <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('protime', [
                                                            'label' => ['text' => 'Tiempo Máximo en el Medio' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo máximo en el medio"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('conservation',
                                                        ['type' => 'select',
                                                        'options' => $lista_conservacion,
                                                        'label' => __('Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio de conservación del material"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                         <!--div class="col-lg-4 col-sm-12 col-xs-12"-->

                                                <!--?php echo $this->Form->control('constime', [
                                                            'label' => ['text' => 'Duración de la Conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo de conservación del material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?-->

                                        <!--/div-->

                                    </div>
                                </div>

                                <div id="tabla6" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('tubenumb', [
                                                            'label' => ['text' => 'Números de Tubos <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de tubos que se mantienen por cada material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>


                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('explnumb', [
                                                            'label' => ['text' => 'Números de Explantes <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de explantes mantenidos por cada colección o especie por tubo"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>


                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('tubesize',
                                                        ['type' => 'select',
                                                        'options' => $lista_tamanio_tubo,
                                                        'label' => __('Tamaño Tubo <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tamaño y diametro del tubo para conservar el material"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>
                                        </div>

                                    </div>
                                </div>

                                <div id="tabla7" class="tab-pane">
                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('fitostate',
                                                        ['type' => 'select',
                                                        'options' => $lista_estado_fitosanitario,
                                                        'label' => __('Estado Fitosanitario de la Planta' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Condición de salud que guarda el material"></i>'),
                                                        'escape' => false,
                                                        'class' => 'form-control',
                                                        'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('pathogen', [
                                                            'label' => ['text' => 'Fitopatógenos' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Presencia de plagas o enfermedades que presenta en el material"></i>'],
                                                            'escape' => false,
                                                            'class' => 'form-control',
                                                ]); ?>

                                        </div>
                                        <!-- FIN DATOS ANOTACIONES -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnBankInvitro" >GRABAR</button>
                            <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-in-vitro', true) ?>" class="btn btn-default"> CANCELAR

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

?>