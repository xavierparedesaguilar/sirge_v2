<?php ?>
<!-- Page Content -->
<section class="content-header">
<h1>Módulo <?php echo $mod_modulo ?></h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'Insitu', 'action' => 'view', 'id' => $insitu->id]);
        $this->Html->addCrumb('Ver');

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
<!-- /Page Breadcrumb visor de mapa-->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">
<style>
  #map { 
  width: 100%;
  height: 320px; }
 </style>
<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?= __('DETALLE DEL REGISTRO ZONA DE ABGROBIODIVERSIAD:') ?><strong> <?php echo $insitu->code_insitu ?></strong></h3>
                    <div class="pull-right box-tools">
                            <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'Insitu', 'action' => 'index'],
                                    ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                            ?>
                             <?php if($permiso['edit']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                        ['controller' => 'Insitu', 'action' => 'edit', $insitu->id],
                                        ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar Registro", 'escape'=>false] );?>
                            <?php } ?>

                            <?php if($permiso['delete']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar Registro",'escape' => false, "data-id"=>$insitu->id])?>

                            <?php } ?>
                    </div>
                    <br>
                </div>
                <!-- End Header -->
                <div class="box-body">
                   <div class="box box-success box-solid">                            
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-pagelines"></i> Datos de la Zona de Abrobiodiversidad</h3>
                                    </div>                                   
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong> CÓDIGO DE ZONA</strong> </td>
                                                <td>: <strong><?php echo $insitu->code_insitu ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Nombre de la Zona</strong> </td>
                                                <td>: <strong><?= h($insitu->name_farmer) ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Resolución Ministerial</strong> </td>
                                                <td>: <strong><?= ($insitu->ministerial_resolution) ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Dirección de la Zona</strong> </td>
                                                <td>: <?= h($insitu->address_farmer) ?></td>
                                            </tr>
                                        </table>    
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">:: Observaciones o Anotaciones</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                           <tr>
                                             <td>
                                             <?php echo $this->Form->control('observation', [
                                                        'label' => 'Información o alguna observación relacionada a los datos de la Zona de Agrobiodiversidad', 'escape'=> false ,
                                                        'class' => 'form-control',
                                                        'type'  => 'textarea',
                                                        'rows'  => "2",
                                                        'disabled' => true,
                                                        'value' => $insitu->observation,
                                                     ]); ?>
                                              </td>
                                            </tr>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-location-arrow"></i> Datos de Ubicación de la Zona</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong>  Departamento</strong> </td>
                                                <td>: <?= $insitu->ubigeo->departamento->nombre ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Provincia</strong> </td>
                                                <td>: <?= $insitu->ubigeo->provincia ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Distrito</strong> </td>
                                                <td>: <?= $insitu->ubigeo->distrito ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Referencia del sitio</strong> </td>
                                                <td>: <?= h($insitu->reference) ?></td>
                                            </tr>
                                        </table>   
                                    </div>
                                    <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-map-marker"></i> Datos de Georreferenciación</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong>  Latitud</strong> </td>
                                                <td>: <?= h($insitu->latitude) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Longitud</strong> </td>
                                                <td>: <?= h($insitu->length) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Altitud</strong> </td>
                                                <td>: <?= h($insitu->altitude) ?></td>
                                            </tr>
                                        </table>    
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-map-o"></i> Mapa de Ubicación de la Zona de Agrobiodiversidad</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                           <table class="table  table-hover">
                                             <tr>                                                    
                                               <td>
                                                 <div id="map"></div>
                                                 <script> 
                                                    var map = L.map('map').
                                                    setView([<?= h($insitu->latitude) ?>, <?= h($insitu->length) ?>],150);
                                                     
                                                    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                                                        maxZoom: 10
                                                        
                                                    }).addTo(map);

                                                    L.marker([<?= h($insitu->latitude) ?>, <?= h($insitu->length) ?>], {draggable: true}).addTo(map).bindPopup("<b>Codigó de Zona: <?php echo $insitu->code_insitu ?><br>Nombre de la Zona: <?= h($insitu->name_farmer) ?><br>Latitud:<?= h($insitu->latitude) ?><br>Longitud:<?= h($insitu->length) ?></b>");
                                                 </script>

                                               </td>
                                             </tr>
                                           </table>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-leaf"></i> Datos de Chacra</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong> Descripción Biofísica</strong> </td>
                                                <td>: <?= ($insitu->biophysical_description); ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Descripción de la Chacra</strong> </td>
                                                <td>: <?= ($insitu->description_chakra); ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Tipo de Suelo</strong> </td>
                                                <td>: <?= $insitu->tipoSuelo->name ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Zona de Vida / Agroecológica</strong> </td>
                                                <td>: <?= h($insitu->living_area) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Área</strong> </td>
                                                <td>: 
                                                      <?= ( $this->Number->format($insitu->area)  == 0)?'': $this->Number->format($insitu->area) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Registros Meteorológicos</strong> </td>
                                                <td>: <?= h($insitu->meteorological_record) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong> Monitoreo de la Zona</strong> </td>
                                                <td>: <?= ($insitu->monitoring == 1)? 'SI' : 'NO' ?></td>
                                            </tr>
                                        </table>   
                                    </div>
                                    
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="box-header with-border">
                                      <h3 class="box-title"><i class="fa fa-clipboard"></i> Información Adicional</h3>                                      
                                    </div>
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong>Grado de Instrucción del Agricultor</strong> </td>
                                                <td>: 
                                                    <?= $insitu->grado_instruccion->name ?>
                                               </td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>Edad del Agricultor</strong> </td>
                                                <td>: 
                                                      <?= ( $this->Number->format($insitu->age_farmer)  == 0)?'': $this->Number->format($insitu->age_farmer) ?>
                                               </td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>Pertenece Org. Campesina</strong> </td>
                                                <td>: <?= ($insitu->peasant_organization == 1)? 'SI' : 'NO' ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>Nombre - Org. Campesina</strong> </td>
                                                <td>: <?= h($insitu->name_peasant_organization) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>Otras Personas</strong> </td>
                                                <td>: <?= $this->Text->autoParagraph(h($insitu->other_people)); ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>Descripción Trabajadores</strong> </td>
                                                <td>: <?= ($insitu->description_workers); ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width=50%"><strong>N° Variedades</strong> </td>
                                                <td>: 
                                                    <?= ( $this->Number->format($insitu->variety_number)  == 0)?'': $this->Number->format($insitu->variety_number) ?>    

                                                </td>
                                            </tr>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <!-- End box-body -->
                <div class="box-footer">
                    <div class="col-sm-12 text-right">
                    <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> REGRESAR',
                                                 ['controller' => 'Insitu', 'action' => 'index'],
                                                 ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip", 'escape'=>false])
                       ?>
                    
                    <?php if($permiso['edit']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i> EDITAR REGISTRO', 
                                                    ['controller' => 'Insitu', 'action' => 'edit', $insitu->id],
                                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip", 'escape'=>false] ); ?>
                    <?php } ?>
                    
                    <?php if($permiso['delete']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i> ELIMINAR REGISTRO', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$insitu->id])?>
                    <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

              

<!--Modal  -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro actual?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
            </div>
        </div>
    </div>
</div>

<?php $url = $this->Html->link('Confirmar', ['controller' => 'Insitu', 'action' => 'delete', 'id' => $insitu->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>

