<?php ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - ZOOGENÉTICO : <?php echo $passportZoo->passport->accenumb ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Datos Pasaporte', ['controller' => 'PassportZoo', 'action' => 'index']);
        $this->Html->addCrumb($passportZoo->passport->accenumb, ['controller' => 'PassportZoo', 'action' => 'view', 'id' => $passportZoo->id]);
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

                        <?php if($permiso['edit'] && $validar) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                        ['controller' => 'PassportZoo', 'action' => 'edit', $passportZoo->id],
                                        ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] )
                            ?>

                        <?php } ?>

                        <?php if($permiso['delete'] && $validar) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                        ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                        'escape' => false, "data-id"=>$passportZoo->id])
                            ?>
                        <?php } ?>

                            <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'PassportZoo', 'action' => 'index'],
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
                                                <!-- DATOS PRINCIPALES -->
                                                    <tr>
                                                        <th scope="row"><?= __('Código del Instituto (COD. FAO)') ?></th>
                                                        <td><?= h($passportZoo->passport->instcode) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Código de Accesión (COD. PER)') ?></th>
                                                        <td><?= h($passportZoo->passport->accenumb) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Nombre de la Accesión') ?></th>
                                                        <td><?= h($passportZoo->passport->accname) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Otro Código Accesión') ?></th>
                                                        <td><?= h($passportZoo->passport->othenumb) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('SubTipo de Recurso') ?></th>
                                                        <td><?php echo $passportZoo->subrecursozoo==NULL?'':$passportZoo->subrecursozoo->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Código de Colecta') ?></th>
                                                        <td><?= h($passportZoo->collnumb) ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row"><?= __('SubTaxon') ?></th>
                                                        <td><?= h($passportZoo->subtaxa) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('SubTaxon Autor') ?></th>
                                                        <td><?= h($passportZoo->subtauthor) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Colección') ?></th>
                                                        <td><?php echo $passportZoo->coleccion==NULL?'':$passportZoo->coleccion->colname; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Fecha Ingreso') ?></th>
                                                        <td><?php echo ($passportZoo->acqdate != NULL) ? date('d-m-Y',strtotime($passportZoo->acqdate)):'' ?>
                                                        </td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                    <!-- DATOS PRINCIPALES -->
                                                    <tr>
                                                        <th scope="row"><?= __('Especie - Nombre Científico') ?></th>
                                                        <td><?php echo $passportZoo->passport->especiefito==NULL? '' : $passportZoo->passport->especiefito->genus.' '.$passportZoo->passport->especiefito->species; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row"><?= __('Especie - Nombre Común') ?></th>
                                                        <td><?php echo $passportZoo->passport->especiefito==NULL? '' : $passportZoo->passport->especiefito->cropname; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row"><?= __('Autor Especie') ?></th>
                                                        <td><?= h($passportZoo->spauthor) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Tipo de Raza') ?></th>
                                                        <td><?= h($passportZoo->racetype) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Tipo de Conservación') ?></th>
                                                        <td><?php echo $passportZoo->tipconservacionzoo==NULL?'':$passportZoo->tipconservacionzoo->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Estación Experimental') ?></th>
                                                        <td><?php echo $passportZoo->passport->estacionprocedencia==NULL?'': $passportZoo->passport->estacionprocedencia->eea; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Estación Experimental de Procedencia') ?></th>
                                                        <td><?php echo $passportZoo->passport->estacionorigen==NULL?'': $passportZoo->passport->estacionorigen->eea; ?></td>
                                                    </tr>
													<tr>
                                                        <th scope="row"><?= __('Promisoria') ?></th>
                                                        <td><?php echo $passportZoo->passport->promissory==NULL?'':$lista_promisoria;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><?= __('Disponibilidad') ?></th>
                                                        <td><?php echo $passportZoo->disponibleaccesion==NULL?'':$passportZoo->disponibleaccesion->name; ?></td>
                                                    </tr>
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
                                                <!-- DATOS DE UBICACION -->
                                                <tr>
                                                    <th scope="row"><?= __('País') ?></th>
                                                    <td><?php echo $passportZoo->passport->pais==NULL?'':$passportZoo->passport->pais->name;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Departamento') ?></th>
                                                    <td><?php echo $passportZoo->passport->ubigeo==NULL?'': $passportZoo->passport->ubigeo->departamento->nombre ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Provincia') ?></th>
                                                    <td><?php echo $passportZoo->passport->ubigeo==NULL?'': $passportZoo->passport->ubigeo->provincia ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Distrito') ?></th>
                                                    <td><?php echo $passportZoo->passport->ubigeo==NULL?'': $passportZoo->passport->ubigeo->distrito ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Localidad') ?></th>
                                                    <td><?= h($passportZoo->passport->localidad) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Referencia') ?></th>
                                                    <td><?= h($passportZoo->collsite) ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Latitud') ?></th>
                                                    <td><?= h($passportZoo->latitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Longitud') ?></th>
                                                    <td><?= h($passportZoo->longitude) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Altitud') ?></th>
                                                    <td><?= h($passportZoo->elevation) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo Coordenadas') ?></th>
                                                    <td><?php echo $passportZoo->tipcoordenadazoo==NULL?'':$passportZoo->tipcoordenadazoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Método de Georeferenciación') ?></th>
                                                    <td><?php echo $passportZoo->metgeorezoo==NULL?'': $passportZoo->metgeorezoo->name ?></td>
                                                </tr>
                                                <!--FIN -->
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
                                        <!--FOTOGRAFIA Y ANCESTROS -->
                                        <tr>
                                            <th scope="row"><?= __('Ancestro Materno') ?></th>
                                            <td><?= h($passportZoo->mancest) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Ancestro Paterno') ?></th>
                                            <td><?= h($passportZoo->pancest) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('Datos Ancestrales') ?></th>
                                            <td><?= h($passportZoo->ancest) ?></td>
                                        </tr>
                                        <!--FIN -->
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
                                                <!--DATOS DE COLECTA Y DONANTE -->
                                                 <tr>
                                                    <th scope="row"><?= __('Código Colecta') ?></th>
                                                    <td><?= h($passportZoo->collcode) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre Colector') ?></th>
                                                    <td><?= h($passportZoo->collname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Dirección Colector') ?></th>
                                                    <td><?= h($passportZoo->colladdress) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Misión de Colecta') ?></th>
                                                    <td><?= h($passportZoo->collmissind) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Condición Biológica(Categorías)') ?></th>
                                                    <td><?php echo $passportZoo->condbiologicazoo==NULL?'': $passportZoo->condbiologicazoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente') ?></th>
                                                    <td><?php echo $passportZoo->fuentezoo==NULL?'': $passportZoo->fuentezoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fuente Detalle') ?></th>
                                                    <td><?php echo $passportZoo->fuentedetzoo==NULL?'': $passportZoo->fuentedetzoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre Local') ?></th>
                                                    <td><?= h($passportZoo->localname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha Recoleccón') ?></th>
                                                    <td><?php echo ($passportZoo->colldate != NULL) ? date('d-m-Y',strtotime($passportZoo->colldate)):'' ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Grupo Etnico') ?></th>
                                                    <td><?= h($passportZoo->groupethnic) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha de Nacimiento') ?></th>
                                                    <td><?php echo ($passportZoo->datebirth != NULL) ? date('d-m-Y',strtotime($passportZoo->datebirth)):'' ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Fecha Deceso') ?></th>
                                                    <td><?php echo ($passportZoo->dateofdec != NULL) ? date('d-m-Y',strtotime($passportZoo->dateofdec)):'' ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Tipo de Muestra') ?></th>
                                                    <td><?= h($passportZoo->samptype) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Tipo Muestreo') ?></th>
                                                    <td><?= h($passportZoo->sampling) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Partes útiles del Animal') ?></th>
                                                    <td><?= h($passportZoo->anuspart) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Uso') ?></th>
                                                    <td><?= h($passportZoo->uso) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Patógeno') ?></th>
                                                    <td><?= h($passportZoo->pathogen) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Área') ?></th>
                                                    <td><?= h($passportZoo->poparea) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Criador (Propietario)') ?></th>
                                                    <td><?= h($passportZoo->owname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Dirección del Criador') ?></th>
                                                    <td><?= h($passportZoo->owaddress) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código del Donante') ?></th>
                                                    <td><?= h($passportZoo->donorcore) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre del Donante') ?></th>
                                                    <td><?= h($passportZoo->donorname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Dirección del Donante') ?></th>
                                                    <td><?= h($passportZoo->donaddress) ?></td>
                                                </tr>
                                                <!--FIN-->
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
                                                <!--DATOS GEOGRAFICOS-->
                                                <tr>
                                                    <th scope="row"><?= __('Humedad Ambiente (%)') ?></th>
                                                    <td><?= h($passportZoo->humidity) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Temperatura Ambiente (°C)') ?></th>
                                                    <td><?= h($passportZoo->temp) ?></td>
                                                </tr>

                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Presión Atmosférica (mmHg)') ?></th>
                                                    <td><?= h($passportZoo->presure) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Precipitación (mm)') ?></th>
                                                    <td><?= h($passportZoo->precipitation) ?></td>
                                                </tr>
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
                                                <!--INFORME LEGAL Y ADICIONAL-->
                                                <tr>
                                                    <th scope="row"><?= __('Sistema Multilateral') ?></th>
                                                    <td><?php echo $passportZoo->sismultilateralzoo==NULL?'': $passportZoo->sismultilateralzoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Patente') ?></th>
                                                    <td><?= h($passportZoo->patent) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Código Instituto de Mejoramiento') ?></th>
                                                    <td><?= h($passportZoo->bredcode) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre Instituto de Mejoramiento') ?></th>
                                                    <td><?= h($passportZoo->bredname) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Nombre del lugar - duplicados de Seguridad') ?></th>
                                                    <td><?= h($passportZoo->duplinstname) ?></td>
                                                </tr>

                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?= __('Ubicación - duplicados de Seguridad') ?></th>
                                                    <td><?= h($passportZoo->duplsite) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Banco ADN') ?></th>
                                                    <td><?php echo $passportZoo->bankadnzoo==NULL?'':$passportZoo->bankadnzoo->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?= __('Anotaciones') ?></th>
                                                    <td><?= h($passportZoo->remarks) ?></td>
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
                                            <?php if($passportZoo->accimag1 == NULL || $passportZoo->accimag1 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportZoo->accimag1, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportZoo->accimag1, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportZoo->remarks1) ?></p>
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
                                            <?php if($passportZoo->accimag2 == NULL || $passportZoo->accimag2 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportZoo->accimag2, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportZoo->accimag2, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportZoo->remarks2) ?></p>
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
                                            <?php if($passportZoo->accimag3 == NULL || $passportZoo->accimag3 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportZoo->accimag3, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportZoo->accimag3, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportZoo->remarks3) ?></p>
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
                                            <?php if($passportZoo->accimag4 == NULL || $passportZoo->accimag4 == '' ){ ?>
                                                <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                            <?php } else {

                                                echo $this->Html->link(
                                                     $this->Html->image('/'.$passportZoo->accimag4, ['class' => "img-responsive", 'style' => "height: 207px"]),
                                                        '/'.$passportZoo->accimag4, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                            } ?>
                                        </center>
                                    </div>
                                    <div class="box-footer">
                                        <p><?= h($passportZoo->remarks4) ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                        <?php if($permiso['edit'] && $validar) { ?>

                            <?php echo $this->Html->link('EDITAR', ['controller' => 'PassportZoo',
                                                                    'action' => 'edit', $passportZoo->id],
                                                                    ['class' => 'btn btn-primary'] );
                            ?>
                        <?php } ?>

                        <?php if($permiso['delete'] && $validar) { ?>

                            <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn',
                                                        'escape' => false, "data-id"=>$passportZoo->id])
                            ?>
                        <?php } ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/datos-pasaporte', true) ?>"
                           class="btn btn-default"> REGRESAR
                        </a>
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/zoogenetico/datos-pasaporte/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>


<?php

$this->Html->css(['/assets/js/fancybox/dist/jquery.fancybox.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/fancybox/dist/jquery.fancybox.min.js'], ['block' => 'script']);

$this->Html->scriptBlock('$("[data-fancybox]").fancybox();', ['block' => true]);

?>