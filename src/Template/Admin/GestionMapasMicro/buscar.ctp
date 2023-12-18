
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Gestión de Mapas');

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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <?php echo $this->Form->create(NULL, [
                            'url' => ['controller' => 'GestionMapasMicro', 'action' => 'index'],
                            'id'  => 'form_gestion_mapas',
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion',[
                                        'type'    => 'select',
                                        'options' => $collection,
                                        'default' => (!empty($coleccion_idx))? $coleccion_idx : '',
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>',
                                        'escape'  => false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '[ SELECCIONE ]',
                                        // 'id'      => 'mapa_coleccion',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('especie', [
                                        'type'    => 'select',
                                        'options' => (!empty($especies))? $especies : [],
                                        'default' => (!empty($especie_idx))? $especie_idx->id : '',
                                        'label'   => 'Nombre Científico',
                                        'class'   => 'form-control select2',
                                        'empty'   => '[ SELECCIONE ]',
                                        'id'      => 'especie_idx',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                            'label'    => ['text' => 'Nombre Común '],
                                            'class'    => 'form-control',
                                            'value'    => empty($especie_idx->cropname)? '' : mb_strtoupper($especie_idx->cropname,'UTF-8'),
                                            'disabled' => true,
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnGestionMapas">BUSCAR</button>
                        <?php echo $this->Html->link('CANCELAR','/admin/microorganismo', ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

<?php

if(isset($passport)){
?>
<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Resultados de búsqueda</strong></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <?php if(count($passport) > 0){ ?>
                <?php echo $this->Form->create(null, [
                      'url' => ['controller' => 'GestionMapasMicro', 'action' => 'ver'],
                      'id' => "form_ver_gestion_mapas",
                ]); ?>
                <div class="box-body">

                    <div class="checkbox">

                        <?php if($contador==0){ ?>

                        <label>
                            <input type="checkbox" id="checkAll" disabled="false">
                            <span class="text">Seleccionar todos</span>
                        </label>

                        <?php } else { ?>

                        <label>
                            <input type="checkbox" id="checkAll">
                            <span class="text">Seleccionar todos</span>
                        </label>

                        <?php } ?>

                    </div>
					
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bordered-blueberry">
                                <tr>
                                    <th>#</th>
                                    <th>COD. ACCESIÓN</th>
                                    <th>NOMBRE DE ACCESIÓN</th>
									<th>NOMBRE CIENTÍFICO</th>
                                    <th>NOMBRE COMÚN</th>
                                    <th>LATITUD</th>
                                    <th>LONGITUD</th>
                                    <th class="text-center">SELECCIONAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $item = 1;
                                    foreach ($passport as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $item ?></td>
                                        <td><?php echo $value->accenumb ?></td>
                                        <td><?php echo $value->accname ?></td>
										<td><i><?php echo $value->genus." ".$value->species?></i></td>
                                        <td><?php echo $value->cropname ?></td>
                                        <td><?php echo $value->latitude ?></td>
                                        <td><?php echo $value->longitude ?></td>
                                        <td class="text-center">
                                            <?php
                                                if($value->latitude != '' && $value->longitude != '')
                                                    echo $this->Form->checkbox('passport.'.$value->id.'.passport_id', ['value' => $value->id, 'class' => 'valid', 'hiddenField' => false]);
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                        $item++;
                                    }
									echo $this->Form->control('ids', ['label' => false]);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnMapas" disabled="true">MOSTRAR EN MAPA</button>
                        <?php echo $this->Html->link('CANCELAR','/admin/microorganismo', ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            <?php } else { ?>

                <div class="box-body">
                    <div class="callout callout-info">
                        <p>No se encontraron resultados para la búsqueda realizada.</p>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<script type="text/javascript">
var ids = Array();
    $(document).on('click', '.valid', function () {
        if ($('input[type=checkbox]:checked').length === 0) {

            $("#btnMapas").prop( "disabled", true );

        } else {

            $("#btnMapas").prop( "disabled", false );
        }
    });

	$('input[type="checkbox"]').on('change', function(e){
    if (this.checked) {
		if($(e.currentTarget).val()=="on"){
			ids = [];
			<?php foreach ($passport as $key=>$value) {?>
			ids.push("<?php echo $value->id; ?>");
			<?php } ?>
			} 
		else{
			ids.push($(e.currentTarget).val());
			} 
		}
	else{
		if($(e.currentTarget).val()=="on"){
			ids = [];
		}
		for(var i=0; i<=ids.length; i++){
			if(ids[i]==$(e.currentTarget).val()){
				ids.splice(i,1);
			}
		}
    }
	console.log(ids);
	document.getElementById("ids").value = ids;
	});

    $(function(){
        $("#checkAll").click(function () {

            if($("#checkAll").is(':checked'))  $("#btnMapas").prop( "disabled", false );
            if(!$("#checkAll").is(':checked')) $("#btnMapas").prop( "disabled", true );
            //$('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

</script>

<!--script type="text/javascript" src="/sirge/assets/js/global.js"></script-->
<?php
$this->Html->script(['/assets/js/datatables/media/js/jquery.dataTables.min.js'], ['block' => 'script']);
?>
<!--script type="text/javascript" src="/sirge/assets/js/datatables/media/js/jquery.dataTables.min.js"></script-->
<script>
$(document).ready(function(){
    var oTable = $('#myTable').DataTable(
	{
        "language": {
            "sSearch": "",
            "searchPlaceholder": "Buscar...",
            "sLengthMenu": 'Mostrando <select class="form-control input-sm">' +
            '<option value="10">10</option>' +
            '<option value="20">20</option>' +
            '<option value="30">30</option>' +
            '<option value="40">40</option>' +
            '<option value="50">50</option>' +
            '<option value="-1">Todos</option>' +
            '</select> registros',
            "oPaginate": {
                "sFirst": "<button type='button' class='fa fa-angle-double-left'></button>",
                "sLast": "<button type='button' class='fa fa-angle-double-right'></button>",
                "sNext": "<button type='button' class='fa fa-angle-right'></button>",
                "sPrevious": "<button type='button' class='fa fa-angle-left'></button>"
            },
            "sInfoEmpty": "0 registros que mostrar",
            "sInfoFiltered": " ",
            "sZeroRecords": "<div class='text-center'><h3>No se encontro información</h3></div>",
            "sLoadingRecords": "Por favor espere - cargando...",
            "sInfo": "Mostrando _START_ de _END_ registros, total _TOTAL_ registros"
        },
        "stateSave": true,
        "aoColumnDefs": [
          {
             bSortable: false,
             aTargets: [ -1 ],
          }
        ],
        "pagingType": "full_numbers",
        "select"    : {
            style: 'single',
            info : false,
        }
    });
	
	$("#checkAll").on("change",function(){
		if($("#checkAll").is(':checked'))
			{
				oTable.$("input:checkbox").prop("checked",true);
			}
		if(!$("#checkAll").is(':checked')) 
			{
				oTable.$("input:checkbox").prop("checked",false);
			}
	});
});
</script>

<?php } ?>

</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>

