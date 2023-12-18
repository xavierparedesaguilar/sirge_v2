<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Recursos Fitogenéticos - Inventarios - Banco de Semillas</h1>
    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Semilla', ['controller' => 'BankSeed', 'action' => 'index']);
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

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info"></div>
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pagelines" aria-hidden="true"></i> <strong>Listado de Inventario de Semillas</strong></h3>
                    <div class="pull-right box-tools">
                        <?php if($permiso['add']){ ?>
                            <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                        ['controller' => 'BankSeed', 'action' => 'add'],
                                        ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Registro", 'escape'=>false] )
                            ?>
                        <?php } ?>
                        <?php if($permiso['export']) { ?>
                             <button type="button" data-toggle="tooltip"  title="Exportar Listado " id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-body">
                    
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                      <th style="min-width: 12px;">#</th>
                                      <th style="min-width: 60px;">#<BR> DE LOTE</th>
                                      <th style="min-width: 70px;">CÓDIGO DE <br>ACCESIÓN</th>
									  <th style="min-width: 80px;">NOMBRE DE <br>LA ACCESIÓN</th>
                                      <th style="min-width: 70px;">OTRO CÓDIGO </th>        
                                      <th style="min-width: 130px;">COLECCIÓN</th>
                                      <th style="min-width: 100px;">NOMBRE COMÚN</th>
                                      <th style="min-width: 80px;">FECHA DE<br>INTRODUCCIÓN</th>
                                      <th style="min-width: 80px;">FECHA DE<br>COSECHA</th>
                                      <th style="min-width: 70px;">PROCEDENCIA</th>
                                      <th style="min-width: 70px;">PESO TOTAL <BR>SEMILLA</th>
                                      <th style="min-width: 70px;">NUM. TOTAL <BR>SEMILLA</th>
                                      <th style="min-width: 70px;">NUM. DE <br>CONTENEDORES</th>
                                      <th style="min-width: 70px;">DISPONIBILIDAD</th>
                                      <th style="min-width: 150px;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                <tr class="text-uppercase">
                                    <td></td>                                                   
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
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1; ?>
                                <?php foreach ($bankSeed as $bankSeed): ?>
                                <tr>                                    
                                    <td><?php echo $this->Number->format($item) ?></td>
                                    <td>
                                        <center>
                                            <span>
                                                <strong>
                                                    <?php echo $this->Html->link(h($bankSeed->lotnumb),
                                                        ['controller' => 'bankSeed', 'action' => 'view', $bankSeed->id],
                                                        ['class' => 'badge badge-success','escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Detalle."])
                                                    ?>  
                                                    
                                                </strong>
                                            </span>
                                        </center>
                                    </td>
                                    <td>
                                        <strong>
                                            <?php 
                                               echo h($bankSeed->passport->accenumb)
                                            ?>                                      
                                        </strong>
                                    </td>
									<td><?php echo h($bankSeed->passport->accname) ?></td>    
                                    <td><?php echo h($bankSeed->passport->othenumb) ?></td> 
                                    <td><?php echo $bankSeed->passport->specie->collection->colname?></td>
                                    <td><?php echo $bankSeed->passport->specie->cropname?></td>
                                    <td><center><?php echo ($bankSeed->acqdate == NULL || $bankSeed->acqdate=='')? '' : date("d-m-Y", strtotime($bankSeed->acqdate))?></td>
                                    <td><center><?php echo $bankSeed->harvestdate?></center></td>
                                    <td><?php echo $bankSeed->origin?></td>                                    
                                    <td class="success text-primary">
                                        <center>
                                            <strong>     
                                                <?php $totalpeseed= $bankSeed->seeweight + $bankSeed->p1 + $bankSeed->p2 + $bankSeed->p3 + $bankSeed->p4 + $bankSeed->p5 + 0.0;                                                
                                                    if($totalpeseed!==0){
                                                        echo"<strong'>".$totalpeseed." g.</strong>";
                                                    }else{
                                                    echo"<p class='text-danger'><strong>0.0 g.</strong></p>";
                                                    } 
                                                ?>
                                            </strong>
                                        </center>
                                    </td>
                                    <td class="warning text-primary">
                                        <center>
                                           <strong>
                                              <?php 
                                                 $totalnumseed=$bankSeed->seednumb + $bankSeed->n1 + $bankSeed->n2 + $bankSeed->n3 + $bankSeed->n4 + $bankSeed->n5;
                                                 if($totalnumseed!==0){
                                                     echo"<strong>".$totalnumseed."</strong>";
                                                 }else{
                                                    echo"<p class='text-danger'><strong>0</strong></p>";
                                                 } 
                                                 ?>
                                            </strong>
                                        </center>
                                    </td>
                                    <td>
                                    <center>
                                              <?php 
                                                  $contenedor=$bankSeed->bags;
                                                 if($contenedor!=''){
                                                     echo"<span class='badge badge-success'><strong>".$contenedor."</strong></span>";
                                                 }else{
                                                    echo"<span class='badge badge-danger'><strong>0</strong></span>";
                                                 } 
                                                 ?>
                                        </center>

                                    </td>
                                    <td><center><?php echo ($this->Number->format($bankSeed->availability) == 331) ? 'SI' : 'NO' ?></center></td>
                                    
                                    <!-- OPCIONES  -->
                                    <td>
                                        <center>
                                        <?php echo $this->Html->link('<i class="fa  fa-sign-in"></i>',
                                                        ['controller' => 'inputSeed', 'action' => 'index', $bankSeed->id],
                                                        ['class' => 'btn btn-success btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Entrada de Semillas."])
                                                ?>
                                        <?php echo $this->Html->link('<i class="fa  fa-sign-out"></i>',
                                                        ['controller' => 'outputSeed', 'action' => 'index', $bankSeed->id],
                                                        ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Salida de Semilla."])
                                                ?>
                                        <?php if($permiso['view']){ ?>
                                         <?php echo $this->Html->link('<i class="fa  fa-search-plus"></i>',
                                                        ['controller' => 'bankSeed', 'action' => 'view', $bankSeed->id],
                                                        ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Detalle."])
                                                ?>
                                        <?php } ?>
                                        <?php
                                            /*$validar=$permiso['role_id']==1?true:$permiso['station_id']==$bankSeed->passport->station_current_id;*/
                                        ?>
                                        <?php if($permiso['edit'] /*&& $validar*/){ ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                        ['controller' => 'bankSeed', 'action' => 'edit', $bankSeed->id],
                                                        ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Registro."])
                                                ?>
                                        <?php } ?>

                                        <?php if($permiso['delete'] /*&& $validar*/){ ?>

                                        <?php
                                                    echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                        ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$bankSeed->id, 'data-toggle' => "tooltip", 'title' => "Eliminar Registro."])
                                                ?>
                                        <?php } ?>
                                        </center>
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
                <h4 class="modal-title" id="myModalLabel">MENSAJE</h4>
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
    // $(function () {
    //     tablaListadoDataTable();
    // });

    $(function () {
        tablaListadoDataTable($('#tablaListado').attr('id'));
		document.getElementById("tablaListado").parentElement.classList.add("table-responsive");
    });


    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>