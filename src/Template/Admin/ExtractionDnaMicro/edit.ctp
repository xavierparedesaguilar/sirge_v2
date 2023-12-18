
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Editar</h1>

       <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión Inventario', '/admin/microorganismo/gestion-inventario');
        $this->Html->addCrumb('Banco ADN', ['controller' => 'BankDnaMicro', 'action' => 'index']);
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

                <?php echo $this->Form->create($extractionDna, [
                             // 'novalidate',
                            'autocomplete' => "off",
                            'id' => "form_extractionAdn",
                             // 'novalidate'
                ]); ?>

                <div class="box-body">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="tabbable">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a data-toggle="tab" href="#tabla1">Datos Principales</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla2">Prueba de Pureza</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla3">Prueba de Integridad </a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla4">Conservación a corto Plazo</a></li>
                                <li class="tab-red"><a data-toggle="tab" href="#tabla5">Conservación a largo Plazo</a></li>
                            </ul>
                            <div class="tab-content">
                                    <div id="tabla1" class="tab-pane in active">

                                        <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('extmethod',
                                                                ['type' => 'select',
                                                                'options' => $lista_extraccion,
                                                                'label' => __('Método de extracción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el metodo de extración de adn"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --' ]);
                                                        ?>
                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('fecha_extraccion', [
                                                                    'label' => ['text' => 'Fecha de Extracción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la fecha de extracción de adn"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value'=>$extractionDna->extdate,
                                                                     'id'=>'fecha_extraccion',
                                                                    // 'readonly' => true
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('extres', [
                                                                    'label' => ['text' => 'Investigador Responsable' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el nombre del personal encargado de realizar la extracción"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('buffer',
                                                                ['type' => 'select',
                                                                'options' => $lista_dilucion,
                                                                'label' => __('Buffer de dilución' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el buffer de  dilución para el adn "></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --' ]);
                                                        ?>
                                                </div>

                                        </div>
                                        <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('volumen', [
                                                                    'label' => ['text' => 'Volumen de resuspensión (ul)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica el volumen  para resuspender el adn "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('dnaqty', [
                                                                    'label' => ['text' => 'Cantidad de ADN' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la cantidad  total del adn extraido"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>

                                    </div>

                                    <div id="tabla2" class="tab-pane">
                                        <div class="row">

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('conadnpur', [
                                                                        'label' => ['text' => 'Concentración de ADN (ng/ul)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la concentración de adn en una muestra"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>

                                                </div>

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('leca260_280', [
                                                                    'label' => ['text' => 'lectura a 260/280' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Primer rango espectrofotométrico para  la concentración y pureza de adn  "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('leca260_230', [
                                                                    'label' => ['text' => 'Lectura a 260/230' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Segundo rango espectrofotométrico para  la concentración y pureza de adn  "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>



                                        </div>
                                    </div>

                                    <div id="tabla3" class="tab-pane">
                                        <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('conadnint', [
                                                                    'label' => ['text' => 'Concentración de ADN ( ng/ul)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indica la concentración del adn para medir integridad "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('din', [
                                                                    'label' => ['text' => 'Din' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Indice de integridad de adn "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('agaelec', [
                                                                    'label' => ['text' => 'Electroforesis de Agarosa' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Calidad del adn comparado con una banda padron o con un marcador conocido "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>


                                    </div>

                                    <div id="tabla4" class="tab-pane">
                                        <div class="row">


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortermtemp', [
                                                                    'label' => ['text' => 'Temperatura (°C)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define la temperatura se debe conservar la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>


                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('fecha_renovacion', [
                                                                    'label' => ['text' => 'Fecha de Renovación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la conservación del material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value'=>$extractionDna->shorconstime,
                                                                     'id'=>'fecha_renovacion',
                                                                    // 'readonly' => true
                                                        ]); ?>

                                                </div>



                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortermtime', [
                                                                    'label' => ['text' => 'Tiempo de conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define el tiempo que se debe conservarla muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>


                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortmatnumb', [
                                                                    'label' => ['text' => 'Número de material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de material que se mantienen por cada muestra "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>

                                        <div class="row">


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortminstock', [
                                                                    'label' => ['text' => 'Stock Mínimo' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Stock mínimo que se debe mantener del material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortstornumb', [
                                                                    'label' => ['text' => 'Código almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del equipo de almacenamiento"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>
                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortstorage',
                                                                ['type' => 'select',
                                                                'options' => $lista_almacenamiento,
                                                                'label' => __('Lugar de almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lugares de almacenamiento donde se mantiene el material"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --' ]);
                                                        ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortlevsh', [
                                                                    'label' => ['text' => 'Nivel de estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nivel de estantería donde se encuentra la gradilla con el tubo o placa con la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>

                                        <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortrack', [
                                                                    'label' => ['text' => 'Código gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de gradilla donde se encuentra el tubo o placa"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortrackpos', [
                                                                    'label' => ['text' => 'Posición  dentro de la gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criobox dentro de la gradilla"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortcrionumb', [
                                                                    'label' => ['text' => 'Número de criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de criobox donde  se encuentra el material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('shortcriopos', [
                                                                    'label' => ['text' => 'Posición dentro del criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criovial dentro del criobox"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>




                                        </div>

                                    </div>

                                    <div id="tabla5" class="tab-pane">
                                        <div class="row">


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longtermtemp', [
                                                                    'label' => ['text' => 'Temperatura (°C)' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define la temperatura se debe conservar la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>


                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('fecha_renovacion_largo', [
                                                                    'label' => ['text' => 'Fecha de Renovación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Fecha que se realiza la conservación del material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                    'value'=>$extractionDna->longconstime,
                                                                     'id'=>'fecha_renovacion_largo',
                                                                    // 'readonly' => true
                                                        ]); ?>

                                                </div>



                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longtermtime', [
                                                                    'label' => ['text' => 'Tiempo de conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Define el tiempo l se debe conservar la muestra"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longtermtype',
                                                                ['type' => 'select',
                                                                'options' => $lista_conservacion,
                                                                'label' => __('Tipo de conservación' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tipo de conservación a largo plazo "></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --' ]);
                                                        ?>
                                                </div>

                                        </div>

                                        <div class="row">


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('criovinumb', [
                                                                    'label' => ['text' => 'Número de crioviales' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de crioviales que se mantienen por cada material "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('crioviminstock', [
                                                                    'label' => ['text' => 'Stock Mínimo de crioviales' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Stock mínimo de crioviales que se debe mantener del material de liofilizados y crioperservados"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longstornumb', [
                                                                    'label' => ['text' => 'Código almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código del equipo de almacenamiento"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longstorage',
                                                                ['type' => 'select',
                                                                'options' => $lista_almacenamiento_largo,
                                                                'label' => __('Lugar de almacenamiento' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Lugares de almacenamiento donde se mantiene el material"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '-- SELECCIONE --' ]);
                                                        ?>

                                                </div>



                                        </div>

                                        <div class="row">

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longlevsh', [
                                                                    'label' => ['text' => 'Nivel de estantería' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nivel de estantería donde se encuentra la gradilla con el criobox"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>


                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longrack', [
                                                                    'label' => ['text' => 'Código de la gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de almacenamiento del criobox"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longrackpos', [
                                                                    'label' => ['text' => 'Posición dentro de la gradilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criobox dentro de la gradilla"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                                 <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longcrionumb', [
                                                                    'label' => ['text' => 'Número de criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Número de criobox donde  se encuentra el material"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>

                                        <div class="row">

                                             <div class="col-lg-3 col-sm-12 col-xs-12">

                                                        <?php echo $this->Form->control('longcriopos', [
                                                                    'label' => ['text' => 'Posición dentro del criobox' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Posición del criovial dentro del criobox"></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                        ]); ?>

                                                </div>

                                        </div>

                                    </div>

                            </div>
                        </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnExtractionAdn">GRABAR</button>
                        <?php echo $this->Html->link('VOLVER',
                                                      ['controller' => 'BankDnaMicro', 'action' => 'edit', $extractionDna->bank_dna_id],
                                                      ['class' => 'btn btn-default', 'escape' => false, 'data-toggle' => "tooltip", 'title' => ""])
                        ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/gestion-inventario/banco-adn', true) ?>"
                           class="btn btn-danger"> CANCELAR
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
    $("#fecha_extraccion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha_renovacion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha_renovacion_largo").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>
