
<?php $this->assign('title', $modulo); ?>

<!-- Page Content  -->
<section class="content-header">
    <h1>Módulo <?php echo 'Fitogenético'. " - " . $modulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Datos Pasaporte');

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

<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de Pasaporte </strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['import']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-cloud-upload" ></i>',
                                    ['controller' => 'PassportFito', 'action' => 'import'],
                                    ['class' => 'btn btn-warning', 'data-toggle'=> "tooltip",  'title'=> "Importar Datos Pasaporte", 'escape'=>false] )
                        ?>

                        <?php } ?>

                        <?php if($permiso['add']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',
                                    ['controller' => 'PassportFito', 'action' => 'add'],
                                    ['class' => 'btn btn-success', 'data-toggle'=> "tooltip",  'title'=> "Nuevo Registro Datos Pasaporte", 'escape'=>false] )
                        ?>
                        <?php } ?>

                        <?php if($permiso['export']) { ?>

                             <button type="submit" data-toggle="tooltip"  title="Exportar Datos Pasaporte" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                        <?php } ?>

                    </div>
                </div>
				<div class="box-body"> 
					<div id= "overlayTable">
					</div>
                     <div class="col-sm-12">
                        <table id="tablaListado" class="table table-striped table-bordered  table-hover row-border order-column" cellspacing="0" width="100%">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                     <th>#</th>
                                     <th>COD. ACCESIÓN</th>
                                     <th>NOMBRE ACCESIÓN</th>
                                     <th style="min-width: 120px;">CÓDIGO DE COLECTA</th>
                                     <th>OTRO COD. ACCESIÓN</th>
                                     <th style="min-width: 120px;">COLECCIÓN</th>
                                     <th>NOMBRE CIENTÍFICO</th>
                                     <th>NOMBRE COMÚN</th>
                                     <th>FECHA INTR GENBANK</th>
                                     <th>SUBTIPO RECURSO</th>
                                     <th>TIPO CONSERVACIÓN</th>
                                     <th>EST. EXPERIMENTAL.</th>
                                     <th>COD. FAO</th>
                                     <th>DISPONIBILIDAD</th>
                                     <th>OPCIONES</th>
                                    <!--th>AUTORÍA ESPECIE</th>
                                    <th>NOMBRE COLECTOR</th>
                                    <th>SUBTAXONES</th>
                                    <th>AUTORÍA SUBTAXONES</th-->
                                    <!--th>EEA. PROCEDENCIA</th-->
                                   
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
                                    <!--th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td></td-->
                                </tr>
                            </tfoot>
                            <!--  MUESTRA DINAMICAMENTE LOS RESULTADOS DATATABLES - SERVER  -->
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
				<?php echo $this->Form->control('filtros', ['type' => 'hidden', 'id' => 'filtros']) ?>
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
        tablaListadoDataTable_ajax($('#tablaListado').attr('id'));
		document.getElementById("tablaListado").parentElement.classList.add("table-responsive");
    });
	$(".delete-bt").on('click', function(event){
		console.log("delete");
        $("#ajax_button").html("<a  href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
	});
	$(".delete-btn").click(function(){
		console.log("delete");
        $("#ajax_button").html("<a  href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
	var filtros = Array();
	$( "#export" ).click(function() {
		var cantidad = document.getElementsByTagName('tr')[1].getElementsByTagName('input');
		for(var i=0; i<=cantidad.length-1; i++)
			{
				filtros.push(cantidad[i].value);
			}
	document.getElementById("filtros").value = filtros;			
	});
</script>

