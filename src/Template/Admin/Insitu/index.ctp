
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?></h1>

    <?php

        $this->Html->addCrumb('Conservación In Situ');

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

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Lista <?php echo $mod_modulo ?></strong></h3>
                    <div class="pull-right box-tools">
                    <?php if ($permiso['add']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'Insitu','action'=>'add'],['class'=>'btn btn-success', 'data-toggle'=>"tooltip" , 'title'=>"Nuevo In Situ", 'escape' => false]) ?>

                    <?php } ?>

                    <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $mod_modulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                    <?php } ?>


                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover row-border order-column">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th style="min-width: 40px;">#</th>
                                    <th style="min-width: 80px">Cod. In Situ</th>
                                    <!--th style="min-width: 190px">Nomb. Agricultor</th -->
                                    <th style="min-width: 210px">Zona de Agrobiodiversidad</th>
                                    <th style="min-width: 210px">Resolución Ministerial</th>
                                    <th style="min-width: 140px">Departamento</th>
                                    <th style="min-width: 120px">Provincia</th>
                                    <th style="min-width: 120px">Distrito</th>                                    
                                    <th style="min-width: 120px">Latitud</th>
                                    <th style="min-width: 120px">Longitud</th>
                                    <th style="min-width: 120px">Altitud</th>
                                 <!--
                                    <th style="min-width: 120px">Referencia</th>
                                    <th style="min-width: 190px">Dir. Agricultor</th>
                                    <th style="min-width: 190px">Edad Agricultor</th>
                                    <th style="min-width: 190px">Grado Instrucción</th>
                                    <th style="min-width: 220px">Pertenece Org. Campesina</th>
                                    <th style="min-width: 190px">Nomb. Org. Campesina</th>
                                    <th style="min-width: 150px">Tipo de Suelo</th>
                                    <th style="min-width: 120px">Área</th>
                                    <th style="min-width: 150px">Agroecológica</th>
                                    <th style="min-width: 200px">Reg. Meteorológicos</th>
                                    <th style="min-width: 120px">Monitoreo</th>
                                    <th style="min-width: 150px">N° Variedades</th>
                                -->
                                    
                                    
                                <th style="min-width: 120px;"><?= __('Opciones') ?></th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                <tr class="text-uppercase">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                 <!--   
                                    
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                -->
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                $item = 1;  
                                foreach ($insitu as $insitu): ?>
                                <tr>
                                    <td><?= $this->Number->format($item) ?></td>
                                    <td><?= h($insitu->code_insitu) ?></td>
                                    <td><?= h($insitu->name_farmer) ?></td>
                                    <td><?= h($insitu->ministerial_resolution) ?></td>
                                    <td><?php echo $insitu->ubigeo->departamento->nombre ?></td>
                                    <td><?php echo $insitu->ubigeo->provincia ?></td>
                                    <td><?php echo $insitu->ubigeo->distrito ?></td>
                                    <td><?= h($insitu->latitude) ?></td>
                                    <td><?= h($insitu->length) ?></td>
                                    <td><?= h($insitu->altitude) ?></td>
                                <!--
                                    <td><?= h($insitu->reference) ?></td>
                                    <td><?= h($insitu->address_farmer) ?></td>
                                    <td><?= $this->Number->format($insitu->age_farmer) ?></td>
                                    <td><?= $insitu->gradoInstruccion->name ?></td>
                                    <td><?= ($insitu->peasant_organization == 1)? 'SI' : 'NO' ?></td>
                                    <td><?= h($insitu->name_peasant_organization) ?></td>
                                    <td><?= $insitu->tipoSuelo->name ?></td>
                                    <td><?= $this->Number->format($insitu->area) ?></td>
                                    <td><?= h($insitu->living_area) ?></td>
                                    <td><?= h($insitu->meteorological_record) ?></td>
                                    <td><?= ($insitu->monitoring == 1)? 'SI' : 'NO' ?></td>
                                    <td><?= $this->Number->format($insitu->variety_number) ?></td>
                                -->
                                    <td class="text-center">
                                        <?php /*echo $this->Html->link('<i class="fa fa-leaf"></i>',
                                                ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Lista de Prácticas Agrícolas."])
                                        ?>
                                        <?php echo $this->Html->link('<i class="fa fa-bug"></i>',
                                                ['controller' => 'InsituThreat', 'action' => 'index', 'idx' => $insitu->id],
                                                ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Lista de Amenazas reportadas."])
                                        ?>
                                        <?php echo $this->Html->link('<i class="fa fa-bomb"></i>',
                                                ['controller' => 'InsituPlage', 'action' => 'index', 'idx' => $insitu->id],
                                                ['class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Lista de Plagas - Patógenos."])
                                        ?>
                                        <?php echo $this->Html->link('<i class="fa fa-rub"></i>',
                                                ['controller' => 'InsituAccesion', 'action' => 'index', 'idx' => $insitu->id],
                                                ['class' => 'btn btn-success btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Lista de Especies."])
                                       */?>

                                        <?php if ($permiso['view']) { ?>

                                            <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                    ['controller' => 'Insitu', 'action' => 'view', $insitu->id],
                                                    ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Detalle."])
                                            ?>
                                        <?php } ?>

                                        <?php if($permiso['edit']) { ?>

                                            <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                    ['controller' => 'Insitu', 'action' => 'edit', $insitu->id],
                                                    ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Registro."])
                                            ?>
                                        <?php } ?>

                                        <?php if($permiso['delete']) { ?>

                                            <?php
                                                echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                    ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$insitu->id, 'data-toggle' => "tooltip", 'title' => "Eliminar Registro."])
                                            ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                 <?php $item++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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

<!-- Modal de exportar archivo excel  -->
<div class="modal fade" id="exportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla']]); ?>
            <div class="modal-body">
                <p id="mensaje"></p>
                <?php echo $this->Form->control('filename', ['type' => 'hidden', 'id' => 'filename']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnReportesTabla">Aceptar</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        tablaListadoDataTable();
        document.getElementById("tablaListado").parentElement.classList.add("table-responsive");
        
    });

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>