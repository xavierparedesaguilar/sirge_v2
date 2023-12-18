
<?php $this->assign('title', $mod_padre); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Colección', ['controller'=> 'Collection', 'action' => 'index']);

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
<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>
<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cube"></i> <strong>LISTADO DE COLECCIONES </strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['add']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'Collection','action'=>'add'], ['class' => 'btn btn-success', 'data-toggle'=>"tooltip" , 'title'=>"Nuevo Registro",'escape'=>false] ); ?>
                        <?php } ?>

                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado" id="export" class="btn btn-info waves-effect m-r-5" >
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
                                    <th style="min-width: 20px;">#</th>
                                    <th style="min-width: 120px;">TIPO RECURSO</th>
                                    <th style="min-width: 220px;">COLECCIÓN</th>
                                    <th style="min-width: 160px;">GRUPO</th>
                                    
                                    <th style="min-width: 120px;">ESTACIÓN EXP.</th>
                                    <th style="min-width: 90px;">B. CAMPO</th>
                                    <th style="min-width: 90px;">B. INVITRO</th>
                                    <th style="min-width: 90px;">B. SEMILLAS</th>                                    
                                    <th style="min-width: 90px;">B. ADN</th>
                                    <th style="min-width: 90px;">CONS. INSITU</th>
                                    <th style="min-width: 90px;">DISPONIBILIDAD</th>
                                    
                                    <th style="min-width: 50px;">OPCIONES</th>
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
                                    
                                    <td></td> 
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $item = 1; ?>
                                <?php foreach ($collection as $collection): ?>
                                <tr>
                                    <td><?php echo $item ?></td>
                                    <td><?php echo ($collection->resource_id == NULl || $collection->resource_id == '')? '' : substr($collection->resource->name, 8, 20) ?></td>
                                    <td><strong>                                        
                                        <?php echo $this->Html->link(h($collection->colname),
                                                ['controller' => 'Collection', 'action' => 'view', $collection->id],
                                                [ 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Detalle."])
                                        ?>
                                    </strong></td>
                                    <td><?php echo h($collection->colgroup) ?></td>                                    
                                    <td><?php echo ($collection->eea == NULL || $collection->eea == '')? '' : $collection->station->eea ?></td>
                                    <td><?php echo ($this->Number->format($collection->bfield) == 1)? '<center><span class="badge badge-success">SI</span></center>' : '<center><span class="badge badge-danger">NO</span></center>' ?></td>
                                    <td><?php echo ($this->Number->format($collection->invitro) == 1)? '<center><span class="badge badge-primary">SI</span></center>' : '<center><span class="badge badge-danger">NO</span></center>' ?></td>
                                    <td><?php echo ($this->Number->format($collection->bseed) == 1)? '<center><span class="badge badge-warning">SI</span></center>' : '<center><span class="badge badge-danger">NO</span></center>' ?></td>                                    
                                    <td><?php echo ($this->Number->format($collection->bdna) == 1)? '<center><span class="badge badge-info">SI</span></center>' : '<center><span class="badge badge-danger">NO</span></center>' ?></td>
                                    <td><?php echo ($this->Number->format($collection->insitu) == 1)? '<center><span class="badge badge-light">SI</span></center>' : '<center><span class="badge badge-danger">NO</span></center>' ?></td>
                                    <td><?php echo ($this->Number->format($collection->availability) == 1)? '<center>SI</center>' : '<center>NO</center>' ?></td>


                                    <!-- <td>php 
                                    // echo ($this->Number->format($collection->status) == 1) ? 'ACTIVO' : 'INACTIVO' ?></td>-->
                                    <td width="120"> 

                                        <?php if($permiso['view']){ ?>

                                        <?php echo $this->Html->link('<i class="fa fa-search-plus"></i>',
                                                ['controller' => 'Collection', 'action' => 'view', $collection->id],
                                                ['class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Ver Detalle."])
                                        ?>

                                        <?php } ?>

                                        <?php if($permiso['edit']) { ?>

                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                                ['controller' => 'Collection', 'action' => 'edit', $collection->id],
                                                ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar Registro."])
                                        ?>

                                        <?php } ?>

                                        <?php if($permiso['delete']){ ?>

                                        <?php
                                            echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#",
                                                ['class' => 'btn btn-danger btn-xs delete-btn', 'escape' => false, "data-id"=>$collection->id,'data-name'=>$collection->colname, 'data-toggle' => "tooltip", 'title' => "Eliminar Registro."])
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
        $(".modal-body").html('¿Desea eliminar el registro actual?');
    });
</script>
