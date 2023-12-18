<?php ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - <?php echo $passportMicro->passport->accenumb ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportMicro', 'action' => 'index']);
        $this->Html->addCrumb($passportMicro->passport->accenumb, ['controller' => 'PassportMicro', 'action' => 'view', 'id' => $passportMicro->id]);
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
<!-- /Page Breadcrumb -->

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                    <?php if ($permiso['edit'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'PassportMicro', 'action' => 'edit', $passportMicro->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>
                    <?php } ?>

                    <?php if ($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$passportMicro->id])
                        ?>
                    <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'PassportMicro', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>


                    </div>
                    <br>
                </div>
                <div class="box-body">
                <!-- Inicio Campos de la tabla Pasaporte -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS PRINCIPALES</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!-- Inicio Campos de la tabla Pasaporte -->
                                                <tr>
                                                    <th scope="row"><?= __('Código del Instituto (COD. FAO)') ?></th>
                                                    <td><?= h($passportMicro->passport->instcode) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código de Accesión (COD. PER)') ?></th>
                                                    <td><?= h($passportMicro->passport->accenumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre de la Accesión') ?></th>
                                                    <td><?= h($passportMicro->passport->accname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Otro Código Accesión') ?></th>
                                                    <td><?= h($passportMicro->passport->othenumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Estación Experimental') ?></th>
                                                    <td><?php echo $passportMicro->passport->estacionprocedencia==NULL?'': $passportMicro->passport->estacionprocedencia->eea; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Estación Experimental de Procedencia') ?></th>
                                                    <td><?php echo $passportMicro->passport->estacionorigen==NULL?'': $passportMicro->passport->estacionorigen->eea; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Colección') ?></th>
                                                    <td><?php  echo $passportMicro->colname == NULL? '' : $passportMicro->passport->specie->collection->colname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('SubTipo de Recurso') ?></th>
                                                    <td><?php echo $passportMicro->subtiporecurso==NULL?'':$passportMicro->subtiporecurso->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha Adquisición') ?></th>
                                                    <td><?php echo ($passportMicro->acqdate != NULL) ? date('d-m-Y',strtotime($passportMicro->acqdate)):'' ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Especie - Nombre Científico') ?></th>
                                                    <td><?php echo $passportMicro->passport->especiefito==NULL? '' : $passportMicro->passport->especiefito->genus.' '.$passportMicro->passport->especiefito->species; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Especie - Nombre Común') ?></th>
                                                    <td><?php echo $passportMicro->passport->especiefito==NULL? '' : $passportMicro->passport->especiefito->cropname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Número de Colección') ?></th>
                                                    <td><?= h($passportMicro->collnumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Autoría de la Especie') ?></th>
                                                    <td><?= h($passportMicro->spauthor) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('SubTaxones') ?></th>
                                                    <td><?= h($passportMicro->subtaxa) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Autoría de los SubTaxones') ?></th>
                                                    <td><?= h($passportMicro->subtauthor) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre de la Cepa') ?></th>
                                                    <td><?= h($passportMicro->strain) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo Conservación') ?></th>
                                                    <td><?php echo $passportMicro->tipconservacionmicro==NULL?'':$passportMicro->tipconservacionmicro->name; ?></td>
                                                </tr>
												<tr>
                                                    <th scope="row"><?= __('Promisoria') ?></th>
                                                    <td><?php echo $passportMicro->passport->promissory==NULL?'':$lista_promisoria;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Disponibilidad del Lote de la Accesión') ?></th>
                                                    <td><?php echo $passportMicro->disponibleaccesionmicro==NULL?'':$passportMicro->disponibleaccesionmicro->name; ?></td>
                                                </tr>
                                                <!--      FIN MODULO 1 -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS DE UBICACIÓN</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!--      MODULO 2 -->

                                                <tr>
                                                    <th scope="row"><?= __('País') ?></th>
                                                    <td><?php echo $passportMicro->passport->pais==NULL?'':$passportMicro->passport->pais->name;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Departamento') ?></th>
                                                    <td><?php echo $passportMicro->passport->ubigeo==NULL?'': $passportMicro->passport->ubigeo->departamento->nombre ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Provincia') ?></th>
                                                    <td><?php echo $passportMicro->passport->ubigeo==NULL?'': $passportMicro->passport->ubigeo->provincia ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Distrito') ?></th>
                                                    <td><?php echo $passportMicro->passport->ubigeo==NULL?'': $passportMicro->passport->ubigeo->distrito; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Localidad') ?></th>
                                                    <td><?= h($passportMicro->passport->localidad) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Ubicación del Sitio') ?></th>
                                                    <td><?= h($passportMicro->collsite) ?></td>
                                                </tr>


                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Latitud') ?></th>
                                                    <td><?= h($passportMicro->latitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Longitud') ?></th>
                                                    <td><?= h($passportMicro->longitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Elevación') ?></th>
                                                    <td><?= h($passportMicro->elevation) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo Coordenadas') ?></th>
                                                    <td><?php echo $passportMicro->tipcoordenadamicro==NULL?'':$passportMicro->tipcoordenadamicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Método de Georeferenciación') ?></th>
                                                    <td><?php echo $passportMicro->metgeoremicro==NULL?'': $passportMicro->metgeoremicro->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Incertidumbre de Coordenadas') ?></th>
                                                    <td><?= h($passportMicro->coorduncert) ?></td>
                                                </tr>
                                                <!-- Fin modulo 2 -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">ANCESTROS-ACCESIÓN</h3>
                            </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <!-- MODULO 3 -->
                                        <tr>
                                            <th scope="row"><?= __('Ancestro Materno') ?></th>
                                            <td><?= h($passportMicro->mancest) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Ancestro Paterno') ?></th>
                                            <td><?= h($passportMicro->pancest) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Datos Ancestrales') ?></th>
                                            <td><?= h($passportMicro->ancest) ?></td>
                                        </tr>
                                        <!-- FIN MODULO 3 -->
                                    </table>
                                </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">DATOS DE COLECTA Y DONANTE</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!-- MODULO 4 -->
                                                <tr>
                                                    <th scope="row"><?= __('Código de Colecta') ?></th>
                                                    <td><?= h($passportMicro->collcode) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre de Colector') ?></th>
                                                    <td><?= h($passportMicro->collname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Dirección de Colector') ?></th>
                                                    <td><?= h($passportMicro->collinstaddress) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Misión de Colecta') ?></th>
                                                    <td><?= h($passportMicro->collmissind) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente') ?></th>
                                                    <td><?php echo $passportMicro->detallemicro==NULL?'': $passportMicro->detallemicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente Detalle') ?></th>
                                                    <td><?php echo $passportMicro->fuentemicro==NULL?'': $passportMicro->fuentemicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente de Aislamiento') ?></th>
                                                    <td><?php echo $passportMicro->aislamientomicro==NULL?'': $passportMicro->aislamientomicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Condición Biológica(Categorías)') ?></th>
                                                    <td><?php echo $passportMicro->biologicomicro==NULL?'': $passportMicro->biologicomicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha de Recolección') ?></th>
                                                    <td><?php echo ($passportMicro->colldate != NULL) ? date('d-m-Y',strtotime($passportMicro->colldate)):'' ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre Local del Material') ?></th>
                                                    <td><?= h($passportMicro->localname) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">

                                                <tr>
                                                    <th scope="row"><?= __('Grupo Étnico') ?></th>
                                                    <td><?= h($passportMicro->groupethnic) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo de Muestra') ?></th>
                                                    <td><?= h($passportMicro->samptype) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nro. de Individuos Muestreados') ?></th>
                                                    <td><?= h($passportMicro->sampsize) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo de Muestreo') ?></th>
                                                    <td><?= h($passportMicro->sampling) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Uso de microorganismo') ?></th>
                                                    <td><?= h($passportMicro->uso) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código del Donante') ?></th>
                                                    <td><?= h($passportMicro->donorcore) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre del Donante') ?></th>
                                                    <td><?= h($passportMicro->donorname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Dirección del Donante') ?></th>
                                                    <td><?= h($passportMicro->donaddress) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código de Accesión del Donante') ?></th>
                                                    <td><?= h($passportMicro->donornumb) ?></td>
                                                </tr>
                                                <!-- FIN MODULO 4 -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">ECOGEOGRÁFICAS</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!-- MODULO 5 -->
                                                <tr>
                                                    <th scope="row"><?= __('Humedad Ambiente ( % )') ?></th>
                                                    <td><?= h($passportMicro->humidity) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Temperatura Ambiente ( °C ) ') ?></th>
                                                    <td><?= h($passportMicro->temp) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Presión Atmosférica ( mmHg )') ?></th>
                                                    <td><?= h($passportMicro->presure) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Precipitación ( mm )') ?></th>
                                                    <td><?= h($passportMicro->precipitation) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Textura del Suelo') ?></th>
                                                    <td><?php echo $passportMicro->textsuelo==NULL?'': $passportMicro->textsuelo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Pedregocidad del suelo') ?></th>
                                                    <td><?php echo $passportMicro->pedregocidadsue==NULL?'': $passportMicro->pedregocidadsue->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Color del suelo') ?></th>
                                                    <td><?php echo $passportMicro->colorsue==NULL?'': $passportMicro->colorsue->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('pH del suelo') ?></th>
                                                    <td><?php echo $passportMicro->phsuelo==NULL?'': $passportMicro->phsuelo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fisiografía') ?></th>
                                                    <td><?php echo $passportMicro->fisiomicro==NULL?'': $passportMicro->fisiomicro->name; ?></td>
                                                </tr>
                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Relieve del Suelo') ?></th>
                                                    <td><?= h($passportMicro->soilrel) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Temperatura del Suelo') ?></th>
                                                    <td><?= h($passportMicro->soiltemp) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Olor del Suelo') ?></th>
                                                    <td><?= h($passportMicro->soilodor) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente de Agua') ?></th>
                                                    <td><?php echo $passportMicro->fuenteagua==NULL?'': $passportMicro->fuenteagua->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Color del Agua') ?></th>
                                                    <td><?php echo $passportMicro->coloragua==NULL?'': $passportMicro->coloragua->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Temperatura del Agua') ?></th>
                                                    <td><?= h($passportMicro->watertemp) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Olor del Agua') ?></th>
                                                    <td><?php echo $passportMicro->oloragua==NULL?'': $passportMicro->oloragua->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('pH del Agua') ?></th>
                                                    <td><?php echo $passportMicro->phagua==NULL?'': $passportMicro->phagua->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Turbidez') ?></th>
                                                    <td><?= h($passportMicro->waterturb) ?></td>
                                                </tr>
                                                <!-- FIN MODULO 5 -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">INFORMACIÓN LEGAL Y ADICIONAL</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <!-- MODULO 6 -->
                                            <tr>
                                                <th scope="row"><?= __('Género Especie Asociada') ?></th>
                                                <td><?= h($passportMicro->asocgenus) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Especie Asociada') ?></th>
                                                <td><?= h($passportMicro->asocspecies) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre Local - Especie Asociada') ?></th>
                                                <td><?= h($passportMicro->asoclocalname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Sistema Multilateral') ?></th>
                                                <td><?php echo $passportMicro->sistemamicro==NULL?'': $passportMicro->sistemamicro->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Patente') ?></th>
                                                <td><?= h($passportMicro->patent) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Código del Instituto') ?></th>
                                                <td><?= h($passportMicro->straincode) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del Instituto') ?></th>
                                                <td><?= h($passportMicro->strainname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombre del lugar - Duplicados de Seguridad') ?></th>
                                                <td><?= h($passportMicro->duplinstname) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Ubicación - Duplicados de Seguridad') ?></th>
                                                <td><?= h($passportMicro->duplsite) ?></td>
                                            </tr>


                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">

                                                <tr>
                                                    <th scope="row"><?= __('Antagonistas') ?></th>
                                                    <td><?= h($passportMicro->antag) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Riesgo Biológico') ?></th>
                                                    <td><?php echo $passportMicro->riesgomicro==NULL?'': $passportMicro->riesgomicro->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Historia de la Accesión') ?></th>
                                                    <td><?= h($passportMicro->samphist) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Medio de Aislamiento') ?></th>
                                                    <td><?= h($passportMicro->asilmed) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Banco Micro') ?></th>
                                                    <td><?php echo $passportMicro->adnmicro==NULL?'': $passportMicro->adnmicro->name; ?></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><?= __('Banco Campo') ?></th>
                                                    <td><?php echo $passportMicro->campomicro==NULL?'': $passportMicro->campomicro->name; ?></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><?= __('Anotaciones') ?></th>
                                                    <td><?= h($passportMicro->remarks) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Imagen 1</h3>
                                    </div>
                                    <div class="box-body">
                                        <center>
                                            <?php if($passportMicro->accimag1 == NULL || $passportMicro->accimag1 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportMicro->accimag1, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportMicro->accimag1, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                             } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportMicro->remarks1) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Imagen 2</h3>
                                    </div>
                                    <div class="box-body">
                                        <center>
                                            <?php if($passportMicro->accimag2 == NULL || $passportMicro->accimag2 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportMicro->accimag2, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportMicro->accimag2, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportMicro->remarks2) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Imagen 3</h3>
                                    </div>
                                    <div class="box-body">
                                        <center>
                                            <?php if($passportMicro->accimag3 == NULL || $passportMicro->accimag3 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportMicro->accimag3, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportMicro->accimag3, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportMicro->remarks3) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Imagen 4</h3>
                                    </div>
                                    <div class="box-body">
                                        <center>
                                            <?php if($passportMicro->accimag4 == NULL || $passportMicro->accimag4 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportMicro->accimag4, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportMicro->accimag4, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportMicro->remarks4) ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                        <?php if ($permiso['edit'] && $validar) { ?>

                            <?php echo $this->Html->link('EDITAR', ['controller' => 'PassportMicro', 'action' => 'edit', $passportMicro->id], ['class' => 'btn btn-primary'] ); ?>

                        <?php } ?>

                        <?php if ($permiso['delete'] && $validar) { ?>

                            <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$passportMicro->id])?>

                        <?php } ?>

                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/datos-pasaporte', true) ?>"
                           class="btn btn-default"> REGRESAR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/microorganismo/datos-pasaporte/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>


<?php

$this->Html->css(['/assets/js/fancybox/dist/jquery.fancybox.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/fancybox/dist/jquery.fancybox.min.js'], ['block' => 'script']);

$this->Html->scriptBlock('$("[data-fancybox]").fancybox();', ['block' => true]);

?>