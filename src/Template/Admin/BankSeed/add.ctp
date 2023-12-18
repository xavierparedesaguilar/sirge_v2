
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
<h1>Recursos Fitogenéticos - Inventarios - Banco de Semillas</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Semilla', ['controller' => 'BankSeed', 'action' => 'index']);
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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-default"> 
                <div class="panel-heading ">
                    <h4><i class="fa fa-file-o"></i> NUEVO REGISTRO</h4>
                 </div>
                 <?php echo $this->Form->create($bankSeed, [
                    'url' => ['controller' => 'BankSeed', 'action' => 'add'],
                    'autocomplete' => "off",
                    'enctype'      => 'multipart/form-data',
                    'id'           => "form_bankSeed",
                ]); ?>
                <div class="box-body">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="tabbable">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a data-toggle="tab" aria-expanded="true" href="#tabla1">  <i class="fa fa-file-o"></i> DATOS GENERALES</a></li>
                                    <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla2"> <i class="fa fa-pagelines"></i> DATOS DE LA SEMILLA</a></li>
                                    <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla3"> <i class="fa fa-viadeo" aria-hidden="true"></i> CARATERIZACIÓN DE LA SEMILLA</a></li>
                                    <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla4"> <i class="fa fa-photo"></i> FOTOGRAFÍA </a></li>                                
                                    <li class="tab-red"><a data-toggle="tab" aria-expanded="true" href="#tabla5"> <i class="fa fa-ge"></i> DATOS ADICIONALES</a></li>    

                                </ul>
                                <div class="tab-content">
                                <div id="tabla1" class="tab-pane active">
                                        <div class="row">  
                                            <div class="col-lg-6">
                                                <div class="row">  
                                                <div class="col-lg-12"><h4>:: Información Datos Pasaporte<hr></h4></div>
                                                </div>
                                                <div class="row">  
                                                        <div class="col-lg-8 col-sm-12 col-xs-12">
                                                            <div class="form-group text">
                                                            <label for="pasaporte">Ingresar el Código de Accesión (CODPER) para su validación</label><b style="color:#dd4b39;"> (*)</b>
                                                            <div class="input-group">
                                                                 <input type="text" name="pasaporte" id="txtCodPasaporte" class="form-control">
                                                                 <span class="input-group-btn" style="padding-bottom: 18px;">
                                                                 <button type="button" data-toggle="tooltip"  title="Validar Cod. PER" id="btnPasaporteSemilla" class="btn btn-warning btn-flat" ><i class="fa fa-search " ></i></button>
                                                                </span>
                                                                </div>
                                                            </div>                                         
                                                        </div>
                                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                                                <div class="form-group text">
                                                                    <br>
                                                                    <span id="msjBancoInvitro" class='badge badge-danger' style=" padding-top:200;padding-right:30 ;padding-bottom:80 ;padding-left:300"></span>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="row">  
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                               <?php  echo $this->Form->control('codigoAccesion',[
                                                                        'label'=> 'Nombre de la Accesión' . '',
                                                                        'escape' => false,
                                                                        'escape' => false,
                                                                        'class'=> 'form-control',
                                                                        'id'   => 'txtAccname',
                                                                ]); ?>
                                                                
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php  echo $this->Form->control('codigoAccesion',[
                                                                        'label'=> 'Otro Código de Accesión' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Código de identificación exclusivo de las accesiones : Código PER"></i>',
                                                                        'escape' => false,
                                                                        'class'=> 'form-control',
                                                                        'id'   => 'txtCodAccesion',
                                                                ]); ?>
                                                        </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php  echo $this->Form->control('collection',[
                                                                    'label'=> 'Colección' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre de la colección"></i>',
                                                                    'escape' => false,
                                                                    'class'=> 'form-control',
                                                                    'id'   => 'txtCollecion',
                                                            ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php  echo $this->Form->control('especie',[
                                                                    'label'=> 'Nombre Científico' ,
                                                                    'escape' => false,
                                                                    'class'=> 'form-control text-uppercase',
                                                                    'id'   => 'txtEspecie',                                                                       
                                                                ]); ?>
                                                            </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php  echo $this->Form->control('cropname',[
                                                                            'label'    => 'Nombre Común' .' <i class="fa fa-info-circle" data-toggle="tooltip" title="Nombre común de la especie cultivada"></i>',
                                                                            'class'    => 'form-control text-uppercase',
                                                                            'id'       => 'txtComun',
                                                                            'escape' => false,
                                                                            'disabled' => true,
                                                                 ]); ?>
                                                        </div>
                                                        <?php echo $this->Form->hidden('passport_id',['id'=>'hdn_pasaporteid']);?>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row"> 
                                                    <div class="col-lg-12">
                                                        <h4>:: Procedencia y Fecha de Cosecha de la Semilla<hr></h4>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('origin',[
                                                                'label'=> 'Lugar de Procedencia del material <b style="color:#dd4b39;">(*)</b>' . ' ',
                                                                'escape' => false,
                                                                'class'=> 'form-control',
                                                        ]); ?>

                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('harvestdate', [
                                                                        'label' => ['text' => 'Fecha de Cosecha de la Semilla <b style="color:#dd4b39;">(*)</b>' . ''],
                                                                        'escape' => false,
                                                                        'class' => 'form-control select2',
                                                                        'type' => 'select',
                                                                        'options' => $lista_anio,
                                                                        'empty' => '-- SELECCIONE --',
                                                            ]); ?>
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row"> 
                                                    <div class="col-lg-12">
                                                        <h4><i class="fa fa-pagelines"></i> Informacion de la Semilla - Banco<hr></h4>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('fecha_aquisicion', [
                                                                    'label' => ['text' => 'Fecha de Introducción al Banco <b style="color:#dd4b39;">(*)</b>' . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control date-picker ',
                                                                    'value'=>$bankSeed->acqdate,
                                                                    // 'readonly' => true
                                                        ]); ?>
                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('responsible', [
                                                                        'label' => ['text' => 'Nombre del Responsable del material <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Responsable del Banco quien recepciona el material"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('detecnumb', [
                                                                        'label' => ['text' => 'Código Interno asignado por el Responsable' . ' '],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                                        <?php echo $this->Form->control('availability',
                                                                ['type' => 'select',
                                                                'options' => $lista_disponibilidad,
                                                                'label' => __('Disponibilidad del Lote de la Accesión <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="(si/no)"></i>'),
                                                                'escape' => false,
                                                                'class' => 'form-control select2',
                                                                // 'empty' => '-- SELECCIONE --'
                                                        ]); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div id="tabla2" class="tab-pane">
                                    <div class="row">  
                                            <div class="col-lg-5">
                                                <div class="row">  
                                                    <div class="col-lg-12"><h4>:: Información General<hr></h4></div>
                                                </div>                                            
                                                <div class="row">  
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('typemat',
                                                                    ['type' => 'select',
                                                                    'options' => $lista_material,
                                                                    'label' => __('Tipo de Colección que se Conserva la Semilla <b style="color:#dd4b39;">(*)</b>' . ' '),
                                                                    'escape' => false,
                                                                    'class' => 'form-control select2',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('seedsto',
                                                                        ['type' => 'select',
                                                                        'options' => $lista_conservacion,
                                                                        'label' => __('Tipo de Semilla <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio conservación que se mantiene la semilla"></i>'),
                                                                        'escape' => false,
                                                                        'class' => 'form-control select2',
                                                                        'empty' => '-- SELECCIONE --' ]);
                                                                ?>
                                                        </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('seedpro',
                                                                        ['type' => 'select',
                                                                        'options' => $lista_propagacion,
                                                                        'label' => __('Tipo de Reproducción' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Medio propagación que se mantiene la semilla"></i>'),
                                                                        'escape' => false,
                                                                        'class' => 'form-control select2',
                                                                        'empty' => '-- SELECCIONE --' ]);
                                                                ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('typeref',
                                                                        ['type' => 'select',
                                                                        'options' => $lista_refresacamiento,
                                                                        'label' => __('Tipo de Refrescamiento <b style="color:#dd4b39;">(*)</b>' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Renovación de la semilla"></i>'),
                                                                        'escape' => false,
                                                                        'class' => 'form-control select2',
                                                                        'empty' => '-- SELECCIONE --' ]);
                                                                ?>
                                                        </div>
                                                </div>
                                                <div class="row">  
                                                <div class="col-lg-12"><h4><i class="fa fa-pagelines"></i> Evaluación de la Semilla <hr></h4></div>
                                                </div>
                                                <div class="row">  
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">                                                        
                                                                <?php echo $this->Form->control('germination', [
                                                                            'label' => ['text' => 'Porcentaje de Germinación (%)' . ' '],
                                                                            'escape' => false,
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                                <?php echo $this->Form->control('viability', [
                                                                    'label' => ['text' => 'Porcentaje de Viabilidad (%)'. ' '],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('seedhum', [
                                                                        'label' => ['text' => 'Porcentaje de Humedad (%)' . ' '],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div>
                                                <div class="row">  
                                                <div class="col-lg-12"><h4><i class="fa fa-thermometer-quarter" aria-hidden="true"></i> Medio de Conservación y Ubicación <hr></h4></div>
                                                </div>
                                                <div class="row">  
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">                                                        
                                                                <?php echo $this->Form->control('storage',
                                                                        ['type' => 'select',
                                                                        'options' => $lista_almacenamiento,
                                                                        'label' => __('Lugar de Almacenamiento <b style="color:#dd4b39;">(*)</b>' . ' '),
                                                                        'escape' => false,
                                                                        'class' => 'form-control select2',
                                                                        'empty' => '-- SELECCIONE --' ]);
                                                                ?>
                                                                <?php echo $this->Form->control('temp', [
                                                                    'label' => ['text' => 'Temperatura (°C) <b style="color:#dd4b39;">(*)</b>' . ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('shelving', [
                                                                        'label' => ['text' => 'Ubicación del material (estantería) <b style="color:#dd4b39;">(*)</b>' . ' '],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                            <?php echo $this->Form->control('humidity', [
                                                                    'label' => ['text' => 'Humedad del medio de conservación (%) <b style="color:#dd4b39;">(*)</b>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="row"> 
                                                    <div class="col-lg-12">
                                                        <h4><i class="fa fa-balance-scale" aria-hidden="true"></i> Peso y Cantidad por Semilla</h4>
                                                        <hr>
                                                        <em>Debe de ingresar los datos del peso y la cantidad de semilla de un contenedor como mínimo</em>
                                                        <?php 
                                                            /**** TOTALES DE SEMILLAS */
                                                            $totalpeso=$bankSeed->p1+$bankSeed->p2+$bankSeed->p3+$bankSeed->p4+$bankSeed->p5+$bankSeed->seeweight;
                                                            $totalcant=$bankSeed->n1+$bankSeed->n2+$bankSeed->n3+$bankSeed->n4+$bankSeed->n5+$bankSeed->seednumb;
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">                                                            
                                                        <h4><strong><em>Contenedor Primario </em></strong><b style="color:#dd4b39;">(*)</b></h4>
                                                    </div>                                                        
                                                </div> 
                                                <div class="row">
                                                    
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <h4> Contenedor 1:</h4>
                                                    </div>                                                    
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <?php echo $this->Form->control('seeweight', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                        ]); ?>
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                                        <?php echo $this->Form->control('seednumb', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtcant',
                                                                            'onkeyup' => 'sumarca()',
                                                        ]); ?>
                                                    </div>
                                                </div>   
                                                <div class="row">
                                                    <div class="col-lg-12">  
                                                    <br>                                                          
                                                        <em><h4><strong>Contenedor Secundario</strong></h4></em>
                                                    </div>                                                        
                                                </div>         
                                                <div class="row justify-content-center">  
                                                <div class="col-lg-2"><strong>Contenedores</strong><hr> </div>
                                                <div class="col-lg-5 text-primary text-left"><strong>Peso (g) </strong><hr></div>   
                                                <div class="col-lg-5 text-primary text-left"><strong>Cantidad de Semilla</strong><hr> </div>
                                                </div>
                                                <div class="row">  
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="row ">      
                                                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                            <h4> Contenedor 2:</h4>
                                                        </div>                                                   
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('p1', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                                    ]); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('n1', [
                                                                            'label' => ['text' =>''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtcant',
                                                                            'onkeyup' => 'sumarca()',
                                                                ]); ?>
                                                        </div>
                                                        </div>
                                                        <div class="row ">   
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <h4> Contenedor 3:</h4>
                                                        </div>                                                    
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('p2', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                                    ]); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('n2', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtcant',
                                                                            'onkeyup' => 'sumarca()',
                                                                ]); ?>
                                                        </div>
                                                        </div>
                                                        <div class="row ">   
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <h4> Contenedor 4:</h4>
                                                        </div>                                                    
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('p3', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                                    ]); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('n3', [
                                                                    'label' => ['text' => ''],
                                                                    'escape' => false,
                                                                    'class' => 'form-control col-xs-3 mtcant',
                                                                    'onkeyup' => 'sumarca()',
                                                                ]); ?>
                                                        </div>
                                                        </div>
                                                        <div class="row ">   
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <h4> Contenedor 5:</h4>
                                                        </div>                                                    
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('p4', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                                    ]); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('n4', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtcant',
                                                                            'onkeyup' => 'sumarca()',
                                                                ]); ?>
                                                        </div>
                                                        </div>
                                                        <div class="row ">   
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <h4> Contenedor 6:</h4>
                                                        </div>                                                    
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('p5', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtpeso',
                                                                            'onkeyup' => 'sumarpe()',
                                                                    ]); ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                                                <?php echo $this->Form->control('n5', [
                                                                            'label' => ['text' => ''],
                                                                            'escape' => false,
                                                                            'class' => 'form-control col-xs-3 mtcant',
                                                                            'onkeyup' => 'sumarca()',
                                                                ]); ?>
                                                        </div>
                                                        </div>
                                                                                                                                                
                                                </div>  
                                                </div>
                                                <div class="row"><br></div>  
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4>:: Descarte de Semilla<hr></h4>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('discweight', [
                                                                            'label' => ['text' => 'Peso descarte (g)'],
                                                                            'escape' => false,
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('discnumb', [
                                                                            'label' => ['text' => 'Cantidad de Semilla'],
                                                                            'escape' => false,
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                            </div>
                                                        </div>                                                     
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4>:: Contenedor y Totales<hr></h4>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('bags', [
                                                                    'label' => ['text' => 'Total de Contenedores' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Cantidad de bolsas "></i>'],
                                                                    'escape' => false,
                                                                    'class' => 'form-control',
                                                                ]); ?>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                                <strong> Peso Total:
                                                                <h4><p id="spTotal"class="text-primary badge badge-warning"> <?php echo$totalpeso;?> (g)</p></h4>
                                                                </strong>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                                            <strong> Total de Semillas:
                                                            <h4><p id="scaTotal" class="text-primary badge badge-warning"> <?php echo$totalcant;?></p><h4>
                                                            </strong>                                                            
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                                                                                    
                                            </div>                                        
                                        </div>
                                    </div>
                                <div id="tabla3" class="tab-pane">
                                    <div class="row">  
                                            <div class="col-lg-6">
                                                <div class="row">  
                                                <div class="col-lg-12"><h4><i class="fa fa-viadeo" aria-hidden="true"></i> Caracterización de la Semilla<hr></h4></div>
                                                </div>                                           
                                                <div class="row">  
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('shape', [
                                                                        'label' => ['text' => 'Forma de la Semilla' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Identificación externa de la semilla"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <?php echo $this->Form->control('size', [
                                                                            'label' => ['text' => 'Longitud de la Semilla (cm)'],
                                                                            'escape' => false,
                                                                            'class' => 'form-control',
                                                                ]); ?>
                                                        </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('color', [
                                                                        'label' => ['text' => 'Color Primario de la Semilla'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('performance', [
                                                                        'label' => ['text' => 'Rendimiento en Toneladas'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('ciclo',
                                                                    ['type' => 'select',
                                                                    'options' => $lista_vegetativo,
                                                                    'label' => __('Ciclo Vegetativo' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Es el desarrollo del cultivo"></i>'),
                                                                    'escape' => false,
                                                                    'class' => 'form-control select2',
                                                                    'empty' => '-- SELECCIONE --' ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('time', [
                                                                        'label' => ['text' => 'Tiempo Vegetativo' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tiempo (cantidad de días) del ciclo vegetativo"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div>                                    
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row"> 
                                                    <div class="col-lg-12">
                                                        <h4>:: Patogenos<hr></h4>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('resistance', [
                                                                        'label' => ['text' => 'Resistencia del material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Resistencia a patogenos o enfermedades"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('tolerancia', [
                                                                        'label' => ['text' => 'Tolerancia' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Tolerante a patogenos o enfermedades"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div> 
                                                <div class="row"> 
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <?php echo $this->Form->control('susceptibility', [
                                                                        'label' => ['text' => 'Susceptibilidad del material' . ' <i class="fa fa-info-circle" data-toggle="tooltip" title="Susceptible a patogenos o enfermedades"></i>'],
                                                                        'escape' => false,
                                                                        'class' => 'form-control',
                                                            ]); ?>
                                                        </div>
                                                </div>                                        
                                            </div>                                     
                                    </div>
                                    </div>
                                <div id="tabla4" class="tab-pane">
                                    <div class="row">
                                                <div class="col-lg-12"><h4><i class="fa fa-photo"></i> Fotografía de la Semilla<hr></h4></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-xs-12 text-center">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                            <?php
                                                                    if($bankSeed->accimag1 != NULL || $bankSeed->accimag1 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$bankSeed->accimag1.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                            ?>
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="btn btn-warning btn-file">
                                                                <span class="fileinput-new">Seleccionar Imagen </span>
                                                                <span class="fileinput-exists">Cambiar</span>
                                                                <input type="file" name="imagen_1" accept="image/jpg,image/jpeg,image/png">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-xs-12 text-center">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">

                                                            <?php
                                                                    if($bankSeed->accimag2 != NULL || $bankSeed->accimag2 != ''){
                                                                        echo "<img src=".$this->Url->build('/', true).$bankSeed->accimag2.">";
                                                                    } else {
                                                                ?>
                                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                                <?php
                                                                    }
                                                            ?>
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="btn btn-warning btn-file">
                                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                                <span class="fileinput-exists">Cambiar</span>
                                                                <input type="file" name="imagen_2" accept="image/jpg,image/jpeg,image/png">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('remarks1',[
                                                                    'label'=> 'Descripción Imagen 1',
                                                                    'escape' => false,
                                                                    'class'=> 'form-control',
                                                    ]); ?>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                                    <?php  echo $this->Form->control('remarks2',[
                                                                    'label'=> 'Descripción Imagen 2',
                                                                    'escape' => false,
                                                                    'class'=> 'form-control',
                                                    ]); ?>
                                                </div>
                                            
                                            </div>
                                    </div>
                                <div id="tabla5" class="tab-pane">
                                    <div class="row">  
                                        <div class="col-lg-12"><h4>:: Observaciones o Anotaciones<hr></h4></div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-lg-12 col-sm-12 col-xs-12">                                       
                                             <?php echo $this->Form->input('remarks', ['type' => 'textarea',
                                            'label' => ' <em>Para añadir información faltante o alguna observación relacionada a los datos del Lote</em>',
                                            'escape' => false,
                                            'placeholder'=> false, 'escape' => false,'class' =>'comment', 'rows' => '5', 'cols' => '5']); ?>
                                        </div>
                                    </div>         
                                </div>                                
                            </div> 
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                    </div>
                </div>
                <div class="box-footer">
                      <div class="col-sm-4 text-left">
                      Los Campos con <b style="color:#dd4b39;" class="text-right">(*)</b> son datos obligatorios
                      </div>
                      <div class="col-sm-8 text-right">
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-semilla', true) ?>"
                           class="btn btn-default"> <i class="fa fa-times"></i> CANCELAR
                        </a>
                       
                        <button type="submit" class="btn btn-primary" id="btnBankSeed"> <i class="fa fa-save"></i> GUARDAR REGISTRO</button>
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
$this->Html->scriptBlock('$("#fecha-aquisicion").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});', ['block' => true]);

//***************************** select 2 *****************************//
$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>



