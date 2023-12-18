<?php ?>
<!-- Page Content -->
<section class="content-header">
    <h1>Recursos Fitogenéticos- Módulo Datos Pasaporte</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportFito', 'action' => 'index']);
        $this->Html->addCrumb($passportFito->passport->accenumb, ['controller' => 'PassportFito', 'action' => 'view', 'id' => $passportFito->id]);
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
  height: 450px; }
 </style>
<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?= __('DETALLE DEL REGISTRO DATO PASAPORTE') ?>: <strong> <?php echo $passportFito->passport->accenumb ?></strong></h3>
                    <div class="pull-right box-tools">
                     <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'PassportFito', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar ", 'escape'=>false])
                    ?>

                    <?php if ($permiso['edit'] && $validar) { ?>

                    <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                ['controller' => 'PassportFito', 'action' => 'edit', 'id' => $passportFito->id],
                                ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar Registro", 'escape'=>false])
                    ?>

                    <?php } ?>

                    <?php if ($permiso['delete'] && $validar) { ?>

                    <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar Registro", 'escape' => false, "data-id"=>$passportFito->id])
                    ?>
                    <?php } ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
                <!-- Inicio Campos de la tabla Pasaporte -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">:: Código de Asignación Internacional del Instituto por la FAO</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('Código del Instituto (COD. FAO)') ?></strong></td>
                                                    <td scope="row"><?= h($passportFito->passport->instcode) ?></td>
                                                 </tr>                                               
                                             </table>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: Información Principal</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <!-- DATOS PRINCIPALES -->                         
                                               <tr>
                                                 <td scope="row" width=10%"><strong><?= __('Código de Accesión (COD. PER)') ?></strong></td>
                                                 <td><strong><?= h($passportFito->passport->accenumb) ?></strong></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre de la Accesión') ?></strong></td>
                                                 <td><?= h($passportFito->passport->accname) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Otro Código Identificación') ?></strong></td>
                                                 <td><?= h($passportFito->passport->othenumb) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre de la Colección') ?></strong></td>
                                                 <td><?php echo $passportFito->passport->especiefito==NULL? '' : $colecciones; ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre Científico de la Especie') ?></strong></td>
                                                 <td><em><?php echo $passportFito->passport->especiefito==NULL? '' : $passportFito->passport->especiefito->genus.' '.$passportFito->passport->especiefito->species; ?></em></td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre Común de la Especie') ?></strong></td>
                                                 <td><?php echo $passportFito->passport->especiefito==NULL? '' : $passportFito->passport->especiefito->cropname; ?></td>
                                                </tr> 
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Código de Colecta asignado a la Accesión') ?></strong></td>
                                                 <td><?= h($passportFito->collnumb) ?></td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('SubTipo de Recurso') ?></strong></td>
                                                 <td><?php echo $passportFito->subrecurso==NULL?'':$passportFito->subrecurso->name;?>
                                                  </td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Tipo Conservación') ?></strong></td>
                                                 <td><?php echo $passportFito->tipoconservacion==NULL?'':$passportFito->tipoconservacion->name;?>
                                                 </td>
                                                </tr>                                                  
                                                 </table>                                          
                                            </div>
                                        </div>
                                     </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: EEA de Conservación y Procedencia</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('EEA de Conservación') ?></strong></td>
                                                        <td><?php echo $passportFito->passport->estacionprocedencia==NULL?'': $passportFito->passport->estacionprocedencia->eea; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('EEA de Procedencia') ?></trong></th>
                                                        <td><?php echo $passportFito->passport->estacionorigen==NULL?'': $passportFito->passport->estacionorigen->eea; ?></td>
                                                    </tr>
                                             </table>                                          
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: Información Adicional</h4>
                                            </div>
                                            <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Autoría de los Subtaxones') ?></strong></td>
                                                            <td><?= h($passportFito->subtauthor) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Subtaxones') ?></strong></td>
                                                            <td><?= h($passportFito->subtaxa) ?></td>
                                                        </tr>                                                   
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Autoría de la Especie') ?></strong></td>
                                                            <td><?= h($passportFito->spauthor) ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td scope="row" width="70%"><strong><?= __('Fecha de Introduccion al GENBANK') ?></strong></td>
                                                            <td><?php echo ($passportFito->acqdate != NULL) ? date('d-m-Y', strtotime($passportFito->acqdate)):'' ?></td>
                                                        </tr>                                                   
                                                </table>                                           
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="box-header with-border">
                                                  <h4 class="box-title">:: Accesión Promisoria y Disponibilidad</h4>
                                                </div>
                                                <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered table-hover">
                                                         <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Promisoria') ?></strong></td>
                                                            <td><?php echo $passportFito->passport->promissory==NULL?'':$lista_promisoria;?></td>
                                                        </tr>
                                                         <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Disponibilidad de la Accesión') ?></strong></td>
                                                            <td><?php echo $passportFito->disponibleaccesion==NULL?'':$passportFito->disponibleaccesion->name;?></td>
                                                        </tr>                                            
                                                </table>                                           
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">
                                              <i class="fa fa-location-arrow"></i> Datos de Ubicación de la Accesión</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('País de Origen') ?></strong></td>
                                                    <td><?php echo $passportFito->passport->pais==NULL?'':$passportFito->passport->pais->name;?></td>
                                                 </tr>
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('Departamento') ?></strong></td>
                                                   <td><?php echo $passportFito->passport->ubigeo==NULL?'': $passportFito->passport->ubigeo->departamento->nombre ?></td>
                                                 </tr>  
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('Provncia') ?></strong></td>
                                                   <td><?php echo $passportFito->passport->ubigeo==NULL?'': $passportFito->passport->ubigeo->provincia ?></td>
                                                 </tr>  
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('Distrito') ?></strong></td>
                                                   <td><?php echo $passportFito->passport->ubigeo==NULL?'': $passportFito->passport->ubigeo->distrito ?></td>
                                                 </tr> 
                                                 <tr>
                                                    <td scope="row" width="62%"><strong><?= __('Localidad') ?></strong></td>
                                                    <td><?= h($passportFito->passport->localidad) ?></td>
                                                 </tr>
                                                  <tr>
                                                    <th scope="row" width="62%"><?= __('Ubicación del Sitio') ?></th>
                                                    <td><?= h($passportFito->collsite) ?></td>
                                                </tr>                                                 
                                             </table>
                                            </div>
                                        </div>
                                      </div>                                      
                                     </div>
                                     <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title"><i class="fa fa-map-marker"></i> Datos de Georreferenciación de la Accesión</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Latitud del sitio de recolección') ?></strong></td>
                                                         <td><?= h($passportFito->latitude) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Longitud del sitio de recolección') ?></strong></th>
                                                        <td><?= h($passportFito->longitude) ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Elevación del sitio de recolección') ?></strong></td>
                                                        <td><?= h($passportFito->elevation) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Tipo Coordenadas') ?></trong></th>
                                                        <td><?php echo $passportFito->tipocoordenadas==NULL?'': $passportFito->tipocoordenadas->name;?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Método de Georeferenciación') ?></strong></td>
                                                        <td><?php echo $passportFito->metgeore==NULL?'': $passportFito->metgeore->name;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Incertidumbre de Coordenadas') ?></trong></th>
                                                        <td><?= h($passportFito->coorduncert) ?></td>
                                                    </tr>
                                             </table>                                           
                                            </div>
                                          </div>
                                        </div>                                        
                                    </div>
                                </div>                               
                                <div class="row">
                                   <div class="col-xs-12 col-md-12 col-lg-12">
                                       <div class="box-header with-border">
                                             <h3 class="box-title"><i class="fa fa-map-o"></i> Visor de Mapa</h3>
                                       </div>
                                       <div class="table-responsive">  
                                           <table class="table  table-hover">
                                             <tr>                                                    
                                               <td>
                                                 <div id="map"></div>
                                                 <script>
 
                                                    var map = L.map('map').
                                                    setView([<?= h($passportFito->latitude) ?>, <?= h($passportFito->longitude) ?>],150);
                                                     
                                                    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                                                        maxZoom: 10
                                                        
                                                    }).addTo(map);


                                                    L.marker([<?= h($passportFito->latitude) ?>, <?= h($passportFito->longitude) ?>], {draggable: true}).addTo(map).bindPopup("<b>Codigó de Accesión:<?= h($passportFito->passport->accenumb) ?><br>Nombre Cientifíco:<em><?php echo $passportFito->passport->especiefito==NULL? '' : $passportFito->passport->especiefito->genus.' '.$passportFito->passport->especiefito->species; ?></em><br>Latitud:<?= h($passportFito->latitude) ?><br>Longitud:<?= h($passportFito->longitude) ?></b>");
                                                     </script>

                                               </td>
                                             </tr>
                                           </table>
                                        </div>
                                    </div>
                                </div> 
                             </div>                          
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                      
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: Información de la Colecta</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <!-- DATOS PRINCIPALES -->                         
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Código del Instituto de Colecta') ?></strong></td>
                                                 <td><?= h($passportFito->collcode) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre del Colector') ?></strong></td>
                                                  <td><?= h($passportFito->collname) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Dirección del Colector') ?></strong></td>
                                                 <td><?= h($passportFito->collinstaddress) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Misión de Colecta') ?></strong></td>
                                                 <td><?= h($passportFito->collmissind) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Fecha de Recolección de la muestra') ?></strong></td>
                                                 <td><?php echo ($passportFito->colldate != NULL) ? date('d-m-Y',strtotime($passportFito->colldate)):'' ?></td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Nombre Local del Material') ?></strong></td>
                                                  <td><?= h($passportFito->localname) ?></td>
                                                </tr> 
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Fuente de Recoleccion') ?></strong></td>
                                                 <td><?php echo $passportFito->fuente==NULL?'': $passportFito->fuente->name;?></td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Fuente Detalle') ?></strong></td>
                                                 <td><?php echo $passportFito->fuentedet==NULL?'': $passportFito->fuentedet->name;?></td>
                                                </tr>
                                                <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Condición Biológica (Categorías)') ?></strong></td>
                                                <td><?php echo $passportFito->condbiologica==NULL?'': $passportFito->condbiologica->name ?></td>
                                                </tr> 
                                                 <tr>
                                                 <td scope="row" width="70%"><strong><?= __('Grupo Étnico (Nombre del lugar de la colecta)') ?></strong></td>
                                                 <td><?= h($passportFito->groupethnic) ?></td>
                                                </tr>                                                  
                                                 </table>                                          
                                            </div>
                                        </div>
                                     </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title"><i class="fa fa-pagelines"></i> Información de la Planta</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Tipo de Muestra de la Planta') ?></strong></td>
                                                        <td><?php echo ($passportFito->tipomuestra == NULL)? '' : $passportFito->tipomuestra->name ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Cantidad de Plantas Muestreadas') ?></trong></th>
                                                        <td><?= h($passportFito->sampsize) ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Tipo de Muestreo') ?></trong></th>
                                                        <td><?= h($passportFito->sampling) ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Parte Útil de la Planta') ?></trong></th>
                                                         <td><?php echo $passportFito->parteutil==NULL?'': $passportFito->parteutil->name;?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Uso de la Planta') ?></trong></th>
                                                        <td><?php echo $passportFito->usoplanta==NULL?'': $passportFito->usoplanta->name;?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Patógeno (Enfernedad o Plagas)') ?><s/trong></th>
                                                        <td><?= h($passportFito->pathogen) ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Área de Recolección de la Muestra (m2)') ?></strong></th>
                                                        <td><?= h($passportFito->poparea) ?></td>
                                                    </tr>
                                             </table>                                          
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title"><i class="fa fa-user"></i> Información del Donante</h4>
                                            </div>
                                            <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Código de Accesión del Donante') ?></strong></td>
                                                            <td><?= h($passportFito->donornumb) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Código del Instituto Donante') ?></strong></td>
                                                            <td><?= h($passportFito->donorcore) ?></td>
                                                        </tr>                                                   
                                                        <tr>
                                                            <td scope="row" width="70%"><strong><?= __('Nombre del Instituto Donante') ?></strong></td>
                                                             <td><?= h($passportFito->donorname) ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td scope="row" width="70%"><strong><?= __('Dirección del Intituto Donante') ?></strong></td>
                                                            <td><?= h($passportFito->donaddress) ?></td>
                                                        </tr>                                                   
                                                </table>                                           
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                   </div>
                        </div>
                  </div>
             </div>
              
                   
              <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">
                                              <i class="fa fa-cloud"></i> Información de las Condiciones Climáticas</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Humedad Ambiente (%)') ?></strong></td>
                                                    <td><?= h($passportFito->humidity) ?></td>
                                                 </tr>
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Temperatura Ambiente (°C)') ?></strong></td>
                                                   <td><?= h($passportFito->temp) ?></td>
                                                 </tr>  
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Presión Atmosférica (mmHg)') ?></strong></td>
                                                   <td><?= h($passportFito->presure) ?></td>
                                                 </tr>  
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Precipitación (mm)') ?></strong></td>
                                                  <td><?= h($passportFito->precipitation) ?></td>
                                                 </tr>                   
                                             </table>
                                            </div>
                                        </div>
                                      </div>                                      
                                     </div>
                                     <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title"><i class="fa fa-globe"></i> Información del Suelo</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Textura del Suelo') ?></strong></td>
                                                        <td><?php echo $passportFito->textsuelo==NULL?'':$passportFito->textsuelo->name;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Pedregocidad del Suelo') ?></strong></th>
                                                        <td><?php echo $passportFito->pedsuelo==NULL?'': $passportFito->pedsuelo->name; ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Color del Suelo') ?></strong></td>
                                                        <td><?php echo $passportFito->colsuelo==NULL?'': $passportFito->colsuelo->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('pH del Suelo') ?></trong></th>
                                                        <td><?php echo $passportFito->phsuelo==NULL?'':$passportFito->phsuelo->name; ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Relieve del Suelo') ?></strong></td>
                                                        <td><?= h($passportFito->soilrel) ?></td>
                                                    </tr>                                                    
                                             </table>                                           
                                            </div>
                                          </div>
                                        </div>                                        
                                    </div>
                                </div>
                             </div>                             
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">:: Información Ancestral de la Accesión</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('1. Codigo de la Accesión del Ancestro') ?></strong></td>
                                                    <td><?= h($passportFito->mancest) ?></td>
                                                 </tr>
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('2. Codigo de la Accesión del Ancestro') ?></strong></td>
                                                   <td><?= h($passportFito->pancest) ?></td>
                                                 </tr>  
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Datos Ancestrales') ?></strong></td>
                                                   <td><?= h($passportFito->ancest) ?></td>
                                                 </tr>  
                                             </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">:: Información Legal</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Sistema Multilateral') ?></strong></td>
                                                    <td><?php echo $passportFito->sismultilateral==NULL?'':$passportFito->sismultilateral->name ?></td>
                                                 </tr>
                                                 <tr>
                                                    <td scope="row" width="70%"><strong><?= __('Nombre de la Patente') ?></strong></td>
                                                  <td><?= h($passportFito->patent) ?></td>
                                                 </tr>
                                             </table>
                                            </div>
                                        </div>
                                      </div>                                      
                                     </div>
                                     <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: Información Adicional</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Código del Instituto de Mejoramiento') ?></strong></td>
                                                        <td><?= h($passportFito->bredcode) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Nombre del Instituto de Mejoramiento') ?></strong></th>
                                                         <td><?= h($passportFito->bredname) ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Nombre del Lugar de los Duplicados de Seguridad') ?></strong></td>
                                                         <td><?= h($passportFito->duplinstname) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="70%"><strong><?= __('Ubicación de los Duplicados de Seguridad') ?></trong></th>
                                                        <td><?= h($passportFito->duplsite) ?></td>
                                                    </tr>                              
                                             </table>                                           
                                            </div>
                                          </div>
                                        </div>  
                                        <div class="row">
                                         <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h4 class="box-title">:: Lugares de Almacenamiento donde se encuentra la Accesión</h4>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                                    <tr>
                                                        <td scope="row" width="30%"><strong><?= __('Banco In vitro') ?></strong></td>
                                                         <td><?php echo $passportFito->bankinvitro==NULL?'':$passportFito->bankinvitro->name;?>
                                                         </td>
                                                    
                                                        <td scope="row" width="30%"><strong><?= __('Banco de Semillas') ?></strong></th>
                                                        <td><?php echo $passportFito->banksemilla==NULL?'':$passportFito->banksemilla->name;?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row" width="30%"><strong><?= __('Banco de Campo') ?></strong></td>
                                                          <td><?php echo $passportFito->bankcampo==NULL?'':$passportFito->bankcampo->name;?>
                                                        </td>
                                                  
                                                        <td scope="row" width="30%"><strong><?= __('Banco ADN') ?></trong></th>
                                                         <td><?php echo $passportFito->bankadn==NULL?'':$passportFito->bankadn->name;?>
                                                    </td>
                                                    </tr>                              
                                             </table>                                           
                                            </div>
                                          </div>
                                        </div>                                       
                                    </div>
                                </div>
                             </div>                             
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">:: Observaciones o Anotaciones</h3>
                                            </div>
                                            <div class="table-responsive">  
                                             <table class="table  table-hover">
                                                 <tr>                                                    
                                                    <td><?= h($passportFito->remarks) ?></td>
                                                 </tr>
                                                 </tr>
                                             </table>
                                            </div>
                                        </div>
                                      </div>   
                                   </div>
                                </div>
                             </div>                             
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="box-header with-border">
                                              <h3 class="box-title"><i class="fa fa-photo"></i> Fotografía de la Accesión</h3>
                                            </div>                                            
                                        </div>
                                      </div> 
                                      <div class="row">

                                        <div class="col-xs-12 col-md-6 col-lg-3">
                                            <div>
                                                <div class="box-header">
                                                    <h3 class="box-title">Imagen 1</h3>
                                                </div>
                                                <div class="box-body">
                                                    <center>
                                                        <?php if($passportFito->accimag1 == NULL || $passportFito->accimag1 == '' ){ ?>
                                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                        <?php } else {

                                                            echo $this->Html->link(
                                                                 $this->Html->image('/'.$passportFito->accimag1, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                                    '/'.$passportFito->accimag1, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                                         } ?>
                                                    </center>
                                                </div>
                                                <div class="box-footer">
                                                    <p><?= h($passportFito->remarks1) ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-6 col-lg-3">
                                            <div>
                                                <div class="box-header">
                                                    <h3 class="box-title">Imagen 2</h3>
                                                </div>
                                                <div class="box-body">
                                                    <center>
                                                        <?php if($passportFito->accimag2 == NULL || $passportFito->accimag2 == '' ){ ?>
                                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                        <?php } else {

                                                            echo $this->Html->link(
                                                                 $this->Html->image('/'.$passportFito->accimag2, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                                    '/'.$passportFito->accimag2, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                                         } ?>
                                                    </center>
                                                </div>
                                                <div class="box-footer">
                                                    <p><?= h($passportFito->remarks2) ?></p>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="col-xs-12 col-md-6 col-lg-3">
                                            <div>
                                                <div class="box-header">
                                                    <h3 class="box-title">Imagen 3</h3>
                                                </div>
                                                <div class="box-body">
                                                    <center>
                                                        <?php if($passportFito->accimag3 == NULL || $passportFito->accimag3 == '' ){ ?>
                                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                        <?php } else {

                                                            echo $this->Html->link(
                                                                 $this->Html->image('/'.$passportFito->accimag3, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                                    '/'.$passportFito->accimag3, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                                            }
                                                        ?>
                                                    </center>
                                                </div>
                                                <div class="box-footer">
                                                    <p><?= h($passportFito->remarks3) ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-6 col-lg-3">
                                            <div>
                                                <div class="box-header">
                                                    <h3 class="box-title">Imagen 4</h3>
                                                </div>
                                                <div class="box-body">
                                                    <center>
                                                        <?php if($passportFito->accimag4 == NULL || $passportFito->accimag4 == '' ){ ?>
                                                            <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                        <?php } else {

                                                            echo $this->Html->link(
                                                                 $this->Html->image('/'.$passportFito->accimag4, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                                    '/'.$passportFito->accimag4, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                                         } ?>
                                                    </center>
                                                </div>
                                                <div class="box-footer">
                                                    <p><?= h($passportFito->remarks4) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                      </div>     
                                   </div>
                                </div>
                             </div>                             
                        </div>
                    </div>
                  </div>
                </div>
          </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-right">
                       <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i> REGRESAR',
                                ['controller' => 'PassportFito', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip", 'escape'=>false])
                       ?>

                    <?php if ($permiso['edit'] && $validar) { ?>

                    <?php echo $this->Html->link('<i class="fa fa-edit" ></i> EDITAR REGISTRO',
                                ['controller' => 'PassportFito', 'action' => 'edit', 'id' => $passportFito->id],
                                ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",'escape'=>false])
                    ?>

                    <?php } ?>
                     <?php if ($permiso['delete'] && $validar) { ?>

                    <?php echo $this->Html->link('<i class="fa fa-trash" ></i> ELIMINAR REGISTRO', "#",
                                ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip", 'escape' => false, "data-id"=>$passportFito->id])
                    ?>
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

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/fitogenetico/datos-pasaporte/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>


 

<?php

$this->Html->css(['/assets/js/fancybox/dist/jquery.fancybox.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/fancybox/dist/jquery.fancybox.min.js'], ['block' => 'script']);

$this->Html->scriptBlock('$("[data-fancybox]").fancybox();', ['block' => true]);

?>