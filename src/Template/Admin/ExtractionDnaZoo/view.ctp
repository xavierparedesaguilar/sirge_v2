
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

     <h1>Módulo <?php echo $titulo ?> - Detalle</h1>
       <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/zoogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco ADN', ['controller' => 'BankDnaZoo', 'action' => 'index']);
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
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['edit']) {?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'ExtractionDnaZoo', 'action' => 'edit','id'=> $extractionDna->bank_dna_id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>

                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                    ['controller' => 'BankDnaZoo', 'action' => 'index'],
                                    ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
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
                                                <tr>
                                                    <th scope="row"><?= __('Método de extracción') ?></th>
                                                    <td><?php echo $extractionDna->metodo==NULL?'': $extractionDna->metodo->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Fecha de extracción') ?></th>
                                                    <td><?php echo date('d-m-Y', strtotime($extractionDna->extdate)) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Investigador Responsable') ?></th>
                                                    <td><?php echo h($extractionDna->extres) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Buffer de dilución') ?></th>
                                                    <td><?php echo $extractionDna->dilucion==NULL?'':$extractionDna->dilucion->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Volumen de resuspensión (ul)') ?></th>
                                                    <td><?php echo h($extractionDna->volumen) ?></td>
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
                                <h3 class="box-title">CONSERVACIÓN A CORTO PLAZO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Temperatura (°C)') ?></th>
                                                    <td><?php echo h($extractionDna->shortermtemp) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Fecha de renovación a corto plazo') ?></th>
                                                    <td><?php echo date('d-m-Y', strtotime($extractionDna->longconstime  )) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Tiempo de conservación') ?></th>
                                                    <td><?php echo h($extractionDna->shortermtime) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de material') ?></th>
                                                    <td><?php echo h($extractionDna->shortmatnumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Stock mínimo') ?></th>
                                                    <td><?php echo h($extractionDna->shortminstock) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Código almacenamiento') ?></th>
                                                    <td><?php echo h($extractionDna->shortstornumb) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">


                                                <tr>
                                                    <th scope="row"><?php echo __('Lugar almacenamiento') ?></th>
                                                    <td><?php echo $extractionDna->almacenamientoc==NULL?'':$extractionDna->almacenamientoc->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nivel de estantería') ?></th>
                                                    <td><?php echo h($extractionDna->shortlevsh) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Código gradilla') ?></th>
                                                    <td><?php echo h($extractionDna->shortrack) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Posición  dentro de la gradilla') ?></th>
                                                    <td><?php echo h($extractionDna->shortrackpos) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de criobox') ?></th>
                                                    <td><?php echo h($extractionDna->shortcrionumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Posición dentro del criobox') ?></th>
                                                    <td><?php echo h($extractionDna->shortcriopos) ?></td>
                                                </tr>

                                                 <tr>
                                                    <th scope="row"><?php echo __('Cantidad de ADN') ?></th>
                                                    <td><?php echo h($extractionDna->dnaqty) ?></td>
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
                                <h3 class="box-title">PRUEBA DE PUREZA DE EXTRACCIÓN</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">

                                                <tr>
                                                    <th scope="row"><?php echo __('Lectura a 260/280') ?></th>
                                                    <td><?php echo h($extractionDna->leca260_280) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Lectura a 260/230') ?></th>
                                                    <td><?php echo h($extractionDna->leca260_230) ?></td>
                                                </tr>
                                                 <tr>
                                                    <th scope="row"><?php echo __('Concentración de ADN (ng/ul)') ?></th>
                                                    <td><?php echo h($extractionDna->conadnpur) ?></td>
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
                                <h3 class="box-title">PRUEBA DE INTEGRIDAD</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Concentración de ADN ( ng/ul)') ?></th>
                                                    <td><?php echo h($extractionDna->conadnint) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Din') ?></th>
                                                    <td><?php echo h($extractionDna->din) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Electroforesis de agarosa') ?></th>
                                                    <td><?php echo h($extractionDna->agaelec) ?></td>
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
                                <h3 class="box-title">CONSERVACIÓN A LARGO PLAZO</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th scope="row"><?php echo __('Temperatura (°C)') ?></th>
                                                    <td><?php echo h($extractionDna->longtermtemp) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Fecha de renovación a largo plazo') ?></th>
                                                    <td><?php echo date('d-m-Y', strtotime($extractionDna->longconstime)) ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><?php echo __('Tiempo de conservación') ?></th>
                                                    <td><?php echo h($extractionDna->longtermtime) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Tipo de conservación') ?></th>
                                                    <td><?php echo $extractionDna->conservacion==NULL?'':$extractionDna->conservacion->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de crioviales') ?></th>
                                                    <td><?php echo $this->Number->format($extractionDna->criovinumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Stock mínimo de crioviales') ?></th>
                                                    <td><?php echo $this->Number->format($extractionDna->crioviminstock) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Código almacenamiento') ?></th>
                                                    <td><?php echo $extractionDna->longstornumb ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">


                                                <tr>
                                                    <th scope="row"><?php echo __('Lugar de almacenamiento') ?></th>
                                                    <td><?php echo $extractionDna->almacenamientol==NULL?'':$extractionDna->almacenamientol->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nivel de estantería') ?></th>
                                                    <td><?php echo $this->Number->format($extractionDna->longlevsh) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Código de la gradilla') ?></th>
                                                    <td><?php echo $extractionDna->longrack ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Posición dentro de la gradilla') ?></th>
                                                    <td><?php echo $extractionDna->longrackpos ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Número de criobox') ?></th>
                                                    <td><?php echo $this->Number->format($extractionDna->longcrionumb) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Posición dentro del criobox') ?></th>
                                                    <td><?php echo $this->Number->format($extractionDna->longcriopos) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                    <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'ExtractionDnaZoo', 'action' => 'edit','id'=> $extractionDna->bank_dna_id], ['class' => 'btn btn-primary'] ); ?>
                    <?php } ?>

                        <?php echo $this->Html->link('REGRESAR',
                                ['controller' => 'BankDnaZoo', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'escape'=>false])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


