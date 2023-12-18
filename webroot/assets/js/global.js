function validarNumero(e) {
    var tecla = (document.all) ? e.keyCode : e.which;
    if (tecla === 8)
        return true;
    if (tecla === 48)
        return true;
    if (tecla === 49)
        return true;
    if (tecla === 50)
        return true;
    if (tecla === 51)
        return true;
    if (tecla === 52)
        return true;
    if (tecla === 53)
        return true;
    if (tecla === 54)
        return true;
    if (tecla === 55)
        return true;
    if (tecla === 56)
        return true;
    if (tecla === 57)
        return true;
    var patron = /1/;
    var te = String.fromCharCode(tecla);
    return patron.test(te);
}

function validarLetras(e) {
    var tecla = (document.all) ? e.keyCode : e.which;
    if (tecla === 8)
        return true; // backspace
    if (tecla === 32)
        return true; // espacio
    if (e.ctrlKey && tecla === 86) {
        return true;
    } //Ctrl v
    if (e.ctrlKey && tecla === 67) {
        return true;
    } //Ctrl c
    if (e.ctrlKey && tecla === 88) {
        return true;
    } //Ctrl x
    var patron = /[a-zA-Z]/; //patron
    var te = String.fromCharCode(tecla);
    return patron.test(te);
}

$(document).on('click', ".btnEliminar", function () {

    // if( $(".btnEliminar").length > 0 ) {
    //     $('.btnEliminar').attr("disabled", true);
    // }
    // $('#ConfirmDelete').hidden();
    $('#ConfirmDelete').modal('hide');
});

$(document).ready(function() {

    var valorNoCopy =null;
    $(".noPaste").bind({
        copy : function(){
            //alert(¡Has copiado!);
        },
        paste : function(e){
            e.preventDefault();
        },
        cut : function(){
            //alert(¡Has cortado!);
        }
    });

});


var table ;
function tablaListadoDataTable_ajax(id_tabla)
{
    var tabla_id = id_tabla || "tablaListado";

	$('#' + tabla_id).dataTable({
        "pageLength": 15,
		"language": {			
			"sSearch": "<b> <i class='fa fa-search'></i> Buscar:</b> ",
			"sLengthMenu": 'Mostrando <select class="form-control input-sm">' +
			'<option value="15">15</option>' +
			'<option value="20">20</option>' +
			'<option value="30">30</option>' +
			'<option value="40">40</option>' +
			'<option value="50">50</option>' +
			// '<option value="-1">Todos</option>' +
			'</select> registros',
			"oPaginate": {
				"sFirst": "<i class='fa fa-angle-double-left'></i>",
				"sLast": "<i class='fa fa-angle-double-right'></i>",
				"sNext": "<i class='fa fa-angle-right'></i>",
				"sPrevious": "<i class='fa fa-angle-left'></i>"
			},
			"processing": "Procesando ...",
			"sInfoEmpty": "0 registros que mostrar",
			"sInfoFiltered": " ",
			"sZeroRecords": "<div class='text-center'><h3>No se encontro información</h3></div>",
			"sLoadingRecords": "Por favor espere - cargando...",
			"sInfo": "Mostrando _START_ a _END_ registros, total _TOTAL_ registros"
		},
		// "stateSave": true,
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
		},
		"processing" : true,
		"serverSide" : true,
		"deferRender": true,
		"searchDelay": 450,
		"headers"    : {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
		"ajax":{
			url  : CK.base_url+'ajax/datatablefito',
			type : "post"
		}
	}).on('processing.dt', function (e, settings, processing) {
		$('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
		$('#overlayTable').css( 'display', processing ? 'block' : 'none' ); 
	});

	table = $("#" + tabla_id).DataTable();

	$('#' + tabla_id + ' tfoot th').each(function () {
		var title = $('#' + tabla_id + ' thead tr.th-head-inputs th').eq($(this).index()).text();
        
       /* var title = $(this).text();*/
		$(this).html('<input type="text" placeholder="' + title + '" />');
       
	});

	if(table.columns().eq(0)!=null){

		table.columns().eq(0).each(function (colIdx) {
			$('input', table.column(colIdx).footer()).on('keyup change', function (event) {			
				if (event.keyCode === 13) { 
					table.column(colIdx).search(this.value).draw();                 
				}	
			});
		});


	}

	$('#tablaListado').on('click', '.delete-btn', function (e) {
		e.preventDefault();
		$("#ajax_button").html("<a  href='"+ CK.base_url + 'admin/fitogenetico/datos-pasaporte/eliminar/' + $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
		$("#trigger").click();
	});   
}

/* COLECCION, ESPECIE, EEA */
function tablaListadoDataTable(id_tabla) {

    var tabla_id = id_tabla || "tablaListado";
    $('#' + tabla_id).dataTable({
        "pageLength": 15,
        "language": {
            "sSearch": "<b> <i class='fa fa-search'></i> Buscar:</b> ",
            "searchPlaceholder": "",
            "sLengthMenu": 'Mostrando <select class="form-control input-sm">' +
            '<option value="15">15</option>' +
            '<option value="20">20</option>' +
            '<option value="30">30</option>' +
            '<option value="40">40</option>' +
            '<option value="50">50</option>' +
            //'<option value="-1">Todos</option>' +
            '</select> registros',
            "oPaginate": {
                "sFirst": "<i class='fa fa-angle-double-left'></i>",
                "sLast": "<i class='fa fa-angle-double-right'></i>",
                "sNext": "<i class='fa fa-angle-right'></i>",
                "sPrevious": "<i class='fa fa-angle-left'></i>"
            },
            
            "sInfoEmpty": "",
            "sInfoFiltered": " ",
            "sZeroRecords": "<div class='text-center'><h4>No se encontro información </h4></div>",
            "sLoadingRecords": "Por favor espere - cargando...",
            "sInfo": "Mostrando _START_ de _END_ registros, total _TOTAL_ registros"
        },
        //"stateSave": true,
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
        },
		//"scrollX": true,
		"scrollCollapse": true,
    });

    table = $("#" + tabla_id).DataTable();
    // table.state.clear();
    // window.location.reload();

    $('#' + tabla_id + ' tfoot th').each(function () {
        var title = $('#' + tabla_id + ' thead tr.th-head-inputs th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
    });

    if(table.columns().eq(0)!=null){

        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).footer()).on('keyup change', function () {
                table.column(colIdx).search(this.value).draw();
            });
        });
    }
}



$(document).on('click', '.change_state', function () {
    var estado_ = $(this).data('estado');
    var id_ = $(this).data('id');
    var modulo_ = $(this).data('modulo');
    var data_ = {
        id: id_,
        estado: estado_
    };
    $.ajax({
        url: CK.base_url + modulo_ + '/estado',
        type: 'POST',
        data: data_,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
            Notify(response.mensaje, 'top-right', response.tipo, response.icono);
            traer_listado_tabla(modulo_ + '/listado');
        },
        error: function (err) {
            console.log(err);
        }
    });
});

function traer_listado_tabla(ruta, tabla_, tabla_id) {
    var tabla_ = tabla_ || "resultado_filtro";
    var tabla_id = tabla_id || "tablaListado";
    var url = CK.base_url + ruta;
    $('#' + tabla_).slideUp('high', function () {
        $(this).load(url, function () {
            // $('#'+tabla_id).dataTable().fnDestroy();
            tablaListadoDataTable(tabla_id);
            $(this).slideDown('slow');
        });
    });
}

$(document).on('click', '[data-target=#openModal]', function (e) {
    e.preventDefault();
    var target = $(this).attr("href");
    console.log("target_: ", target);
    var tamanio = $(this).data('tamanio');
    var categoria = $(this).data('categoria');
    // console.log("tamanio_: ", tamanio);

    if (target.indexOf('#') == 0) {
        $(target).modal('open');
        console.log("open_modal");
    } else {
        $.get(target, function (data) {
            // console.log("data_data_: ", data);
            // $('<div class="modal fade mimodalpe ' + categoria + '" data-backdrop="static" data-keyboard="false"><div class="modal-dialog modal-darkorange modal-' + tamanio + '"><div class="modal-content">' + data + '</div></div></div>').modal();
        }).success(function (response) {
            // console.log("data_data_success: ", response);
            // console.log("get_target_modal");
            $('<div class="modal fade mimodalpe ' + categoria + '" data-backdrop="static" data-keyboard="false"><div class="modal-dialog modal-darkorange modal-' + tamanio + '"><div class="modal-content">' + response + '</div></div></div>').modal();
        }).error(function (err) {
            console.log(err);
        });
    }
});


$(document).on('change', "#role_id", function () {
    if (this.value > 0) {
        var id = this.value;
        load_rol(id);
    }
});

function load_rol(id) {
    $.ajax({
        url: CK.base_url + 'admin/usuarios/getmodulo/' + id,
        type: 'POST',
        headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
        data: {id: id},
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
            console.log("data_: ", response);
            $('input:checkbox').removeAttr('checked');
            $.each(response, function (key, value) {
                var permiso_id = value['permissions'].split(',');
                $.each(permiso_id, function (key, permiso) {
                    $('#' + value['module_id'] + "_" + permiso).prop('checked', true).val(permiso);
                });
            });
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

function message_pass(text_) {
    $("#password").focus();
    $('.message_').text(text_);
    $('.alert-warning').removeClass('d-none');
}

$(document).on('click', '.probandojs', function () {
    console.log("clickeando probandojs");
});

$(document).on('click', '.close-toogle', function () {
    $('.alert-warning').addClass('d-none');
});
$(document).on('click', '.btnDeleteModal', function () {
    setTimeout(function () {
        $('.mimodalpe').remove();
    }, 500);
});

$(document).on('click', '.buttonVerificarLista', function () {
    var nombre_ = $("#nombre").val();
    if (nombre_ === "") {
        console.log("ingrese nombre");
        $("#nombre").focus();
        $('.message_').text("Por favor ingrese un nombre");
        $('.alert-warning').removeClass('d-none');
        return false;
    } else {
        return true;
    }
});

/*************** select option - condicion biologica - pass fitogentico ****************/
$(document).on('change', "#categoria", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_codicionbiologica(dep_id);
    } else {
        $("#passportfito-sampstat").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2'); //
    }
});

function load_codicionbiologica(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/condicionbiologica/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("categoria_detalle_: ", response);
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                console.log("condicionbiologica[" + key + "]: " + value.name);
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#passportfito-sampstat").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

/*************** select option - condicion biologica - pass zoogenetico ****************/
$(document).on('change', "#categoria_zoo", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_codicionbiologica_zoo(dep_id);
    } else {
        $("#passportzoo-sampstat").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2'); //
    }
});

function load_codicionbiologica_zoo(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/condicionbiologicazoo/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#passportzoo-sampstat").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

/************* Select option - coleccion  *************/

$(document).on('change', "#coleccion", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_detalleespecie(dep_id);
    } else {
        $("#especie_idx").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2');
        $("#nombre-comun").val("");
    }
});

function load_detalleespecie(dep_id) {

    $.ajax({
        url: CK.base_url + 'ajax/detalleespecie/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#especie_idx").html(select).trigger('change.select2');
            $("#nombre-comun").val("");
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

/******************************* INICIO DE NOMBRE COMUN ***********************************/
    $(document).on('change', "#especie_idx", function () {
        var dep_id = $(this).val();
        if (dep_id !== "0") {
            load_nombrecomun(dep_id);
        } else {
            $("#nombre-comun").val("");
        }
    });

    function load_nombrecomun(dep_id) {
        $.ajax({
            url     : CK.base_url + 'ajax/getnombrecomun/' + dep_id,
            type    : 'GET',
            data    : {id: dep_id},
            dataType: 'json',
            success : function (response) {
                $("#nombre-comun").val(response.nombre_comun);
            },
            error: function (err) {
                console.log("show_error_: ", err.responseText);
            }
        });
    }

/******************************* FIN DE NOMBRE COMUN ***********************************/

/*********************** COMBO DINAMICO PARA LISTA DETALLE ESPECIES *****************************/
$(document).on('change', "#coleccion_state", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_detalleespeciestate(dep_id);
    } else {
        $("#especie-id").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2');
        $("#cropname").val("");
    }
});

function load_detalleespeciestate(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detalleespeciestate/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        success: function (response) {
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#especie-id").html(select).trigger('change.select2');
            $("#cropname").val("");
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

    $(document).on('change', "#especie-id", function () {
        var dep_id = $(this).val();
        if (dep_id !== "0") {
            load_nombrecomun_state(dep_id);
        } else {
            $("#cropname").val(""); //
        }
    });

    function load_nombrecomun_state(dep_id) {
        $.ajax({
            url     : CK.base_url + 'ajax/getnombrecomun/' + dep_id,
            type    : 'GET',
            data    : {id: dep_id},
            dataType: 'json',
            success : function (response) {
                $("#cropname").val(response.nombre_comun);
            },
            error: function (err) {
                console.log("show_error_: ", err.responseText);
            }
        });
    }


/*********************** COMBO DINAMICO PARA LISTA DETALLE ESPECIES - CARACTERIZACION *****************************/
$(document).on('change', "#coleccion_import", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_importcaracterizacion(dep_id);
    } else {
        $("#especie_import").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2');
        $("#cropname_import").val("");
    }
});

function load_importcaracterizacion(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detalleespeciestate/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#especie_import").html(select).trigger('change.select2');
            $("#cropname_import").val("");
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

    $(document).on('change', "#especie_import", function () {
        var dep_id = $(this).val();
        if (dep_id !== "0") {
            load_nombrecomun_import(dep_id);
        } else {
            $("#cropname_import").val(""); //
        }
    });

    function load_nombrecomun_import(dep_id) {
        $.ajax({
            url     : CK.base_url + 'ajax/getnombrecomun/' + dep_id,
            type    : 'GET',
            data    : {id: dep_id},
            dataType: 'json',
            success : function (response) {
                $("#cropname_import").val(response.nombre_comun);
            },
            error: function (err) {
                console.log("show_error_: ", err.responseText);
            }
        });
    }


/************* Select option - fuente  fitogenetico *************/
$(document).on('change', "#passportfito-collsrc", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detallefuente(dep_id);
    } else {
        $("#passportfito-collsrcdet").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2'); //
    }
});

function load_detallefuente(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detallefuente/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("detalle_: ", response);
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                console.log("detallefuente[" + key + "]: " + value.name);
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#passportfito-collsrcdet").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

/************* Select option - fuente  zoogenetico *************/
$(document).on('change', "#passportzoo-collsrc", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detallefuentezoo(dep_id);
    } else {
        $("#passportzoo-collsrcdet").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2'); //
    }
});

function load_detallefuentezoo(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detallefuentezoo/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("detalle_: ", response);
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                console.log("detallefuentezoo[" + key + "]: " + value.name);
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#passportzoo-collsrcdet").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

/************* Select option - fuente  microorganismo *************/
$(document).on('change', "#passportmicro-collsrc", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detallefuentemicro(dep_id);
    } else {
        $("#passportmicro-collsrcdet").html('<option value="0">-- SELECCIONE --</option>').trigger('change.select2'); //
    }
});

function load_detallefuentemicro(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detallefuentemicro/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("detalle_: ", response);
            var select = "";
            select += '<option value="0">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                console.log("detallefuentemicro[" + key + "]: " + value.name);
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#passportmicro-collsrcdet").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

function load_departamento() {
    $.ajax({
        url: CK.base_url + 'ajax/departamento',
        type: 'GET',
        data: {},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("departamento: ", response);
            var select = "";
            select += '<option value="0">-- DEPARTAMENTO --</option>';
            $.each(response, function (key, value) {
                console.log("departamento[" + key + "]: " + value.nombre);
                select += '<option value="' + value.cod_dep + '">' + value.nombre + '</option>';
            });
            $("#departamento").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

function load_reporte(idreporte,idrecurso) {

    var url;

    url=CK.base_url + 'ajax/cargaItemsReporte/' + idreporte + '/' + idrecurso;

    $.ajax({
        url: url,
        type: 'GET',
        data: { idreporte : idreporte, idrecurso: idrecurso},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {

            var select = "";
            select += '<option>-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                //console.log("reporte[" + key + "]: " + value.name);
                select += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $("#lst_reporte").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}


function generarColumnsTable(listacolums){
    var th='';

    $.each(listacolums, function (key, value) {

      th+='<th>'+ value+ '</th>';
  });

    return th;
}

function generarColumnsTable(listarow){
    var td='';
    var i=1;
    var j=0;
    $.each(listarow, function (key, value) {

                  // if(i!=key){

                  //   td+='<td>'+i+'</td>';
                  //   i=key;
                  // }
                  //td+='<td>'+ value+ '</td>';
                  td+='<td>'+ value+ '</td>';

              });

    return '<tr>'+td+'</tr>';
}

function generarRowsTable(listarows){
    var tr='';

    $.each(listarows, function (key, value) {

     tr+=generarColumnsTable(value);

 });

    return tr;
}


function load_data_reporte(idreporte,idrecurso) {

    var url;
    var titulo=$('#lst_reporte option:selected').text();

    $('#titulo_reporte').text(titulo+' - ACCESIONES');

    var colums=['Estacion Experimental','Cantidad Accesiones'];



    if(idreporte==579)  url=CK.base_url + 'ajax/reporteEstacionExperimental/' + idrecurso;

    $.ajax({
        url: url,
        type: 'GET',
        data: {idrecurso: idrecurso},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {

         $("#datarows").html(generarRowsTable(response));
     },
     error: function (err) {
        console.log("show_error_: ", err.responseText);
    }
});
}

//Ubigeo dinamico.
$(document).on('change', "#departamento", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_provincia(dep_id);
        load_departamento_id(dep_id);
    } else {
        $("#provincia").html('<option value="0">-- PROVINCIA --</option>').trigger('change.select2');
        $("#distrito").html('<option value="0">-- DISTRITO --</option>').trigger('change.select2');
    }
});

$(document).on('click', "#reason", function () {

    if( $('#reason').prop('checked') ) {
       $("#remexit").prop('disabled', false);
       $("#remexit").focus();
       $("#chxreason").val('1');

   }

   else{
       $("#remexit").prop('disabled', true);
       $("#chxreason").val('0');
   }

});

$(document).on('click', "#btnDataFito", function () {

   load_data_reporte($("#lst_reporte").val(),1);

});



$(document).on('change', "#lst_opcion_reporte", function () {



    if($("#lst_opcion_reporte").val().length>0 && $("#lst_opcion_reporte").val()>0)
       load_reporte($("#lst_opcion_reporte").val(),1);

   else {

    $("#lst_reporte").html('');
    var select = '<option>-- SELECCIONE --</option>';
    $("#lst_reporte").html(select).trigger('change.select2');
}

});

$(document).on('click', "#btnPasaporteInvitro", function () {

   load_pasaporte($("#txtCodPasaporte").val(),1,1);

});

$(document).on('click', "#btnPasaporteSemilla", function () {

   load_pasaporte($("#txtCodPasaporte").val(),1,3);

});

$(document).on('click', "#btnPasaporteCampo", function () {

   load_pasaporte($("#txtCodPasaporte").val(),1,2);

});

$(document).on('click', "#btnPasaporteCampoAdn", function () {

   load_pasaporte($("#txtCodPasaporte").val(),1,4);

});

$(document).on('click', "#btnPasaporteAdnZoo", function () {

   load_pasaporte($("#txtCodPasaporte").val(),2,5);

});

$(document).on('click', "#btnPasaporteAdnMicro", function () {

   load_pasaporte($("#txtCodPasaporte").val(),3,6);

});

$(document).on('click', "#btnPasaporteMicro", function () {

   load_pasaporte($("#txtCodPasaporte").val(),3,7);

});


// $(document).on('change', "#fecha-termino", function () {

//  if($("#fecha-inicio").val()!='' && $("#fecha-termino").val()!=''){
//     var inicio = Date.parse($("#fecha-inicio").val());
//     var final =  Date.parse($("#fecha-termino").val());
//     $("#msjfecha").text("");

//     if (inicio > final) {

//         $("#msjfecha").text("La fecha de inicio no puede ser mayor que la fecha de termino");
//     }
// }

// });

// $(document).on('change', "#fecha-inicio", function () {

//  if($("#fecha-inicio").val()!='' && $("#fecha-termino").val()!=''){
//     var inicio = Date.parse($("#fecha-inicio").val());
//     var final =  Date.parse($("#fecha-termino").val());
//     $("#msjfecha").text("");

//     if (inicio > final) {

//         $("#msjfecha").text("La fecha de inicio no puede ser mayor que la fecha de termino");
//     }
// }

// });

$(document).on('change', "#lstcoleccion", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_detalleGenero(dep_id,'',0);
    } else {
        $("#lstSpecie").html('<option value="" >-- SELECCIONE --</option>').trigger('change.select2');
        $("#txtComun").val("");
    }
});

$(document).on('change', "#lstSpecie", function () {

    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_detallecomun(dep_id,0);
    } else {
        $("#txtComun").val('');
    }
});

$(document).on('change', "#lstGenero", function () {

    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detallecomun(dep_id,0);
    } else {
        $("#txtComun").val(''); //
    }
});

$(document).on('click', "#export", function () {

    $("#mensaje_info").hide();

    if($('#tablaListado').length>0) {

        var data = table.rows({ filter : 'applied'} ).data();
        var countLista=table.rows({ filter : 'applied'} ).data().length;

        $("#mensaje_info").hide();

        if(countLista>0){

            var columns = [];
            var datos = [];
            var countColumn=table.columns().data().length;

            var fila=[];
            columns[0]='ITEM';

            for (var i = 1; i < countColumn-1; i++) {

                 columns[i]= $.trim($('#tablaListado').find('tr').eq(0).find('th').eq(i).html());
             }

            var j=1;

            fila=[];

            $.each(data, function( index, value ) {

                $.each(value, function( index1, value1 ) {


                    if(index1<value.length-1)  fila[index1]= $.trim(value1);

                });

                datos.push(fila);

                fila=[];

            });

             var columnsJson=JSON.stringify(columns)
             var datosJson=JSON.stringify(datos);
             var titulo=$('.box-title strong').text();

             var url;

             url=CK.base_url+'ajax/exportarDatos';

             $.ajax({

                url: url,
                type: 'POST',
                data: { columnsJson : columnsJson,datosJson: datosJson,titulo:titulo},
                dataType: 'json',
                success: function (data) {
                    if(data.msj == 'ok'){
                        $("#exportar").modal('show');
                        $("#mensaje").html('¿Desea descargar el reporte?');
                        $("#filename").val(data.titulo);
                        setTimeout(function() { $('#exportar').modal('hide'); }, 5000);
                    }
                },
                complete: function (xhr) {

                },
                error: function (err) {

                    console.log("show_error_: ", err.responseText);
                }

            });
            //  .done(function(data){
            //     var $a = $("<a>");
            //     $a.attr("href",data.file);
            //     $("body").append($a);
            //     $a.attr("download",titulo+".xls");
            //     //console.log($a[0].href);
            //     $a[0].click();
            //     $a.remove();
            // });

        }else {

            $("#mensaje_info").show();
            $('#mensaje_info').html('<div class="alert alert-info alert-dismissible callout callout-info" style="opacity: 1000; overflow: hidden;"><h4><i class="icon fa fa-warning"></i> MENSAJE!</h4>No existen datos a Exportar</div>');
            $("#mensaje_info").slideUp(4400);
        }

    }else {

        $("#mensaje_info").show();
        $('#mensaje_info').html('<div class="alert alert-info alert-dismissible callout callout-info" style="opacity: 1000; overflow: hidden;"><h4><i class="icon fa fa-warning"></i> MENSAJE!</h4>No existen datos a Exportar</div>');
        $("#mensaje_info").slideUp(4400);
    }

});

function load_detalleGenero(dep_id, opcion,idspeciegenero) {
    var des='';
    $.ajax({
        url: CK.base_url + 'ajax/detalleespeciestate/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value="">-- SELECCIONE --</option>';
            $.each(response, function (key, value) {

                if(value.id != des){
                    select += '<option value="'+value.id+'">' + $.trim(value.descripcion) + '</option>';
                    des=value.id;
                }
            });

            $("#lstSpecie").html(select).trigger('change.select2');
            if(opcion!=''){

               $("#lstSpecie").val(opcion);
               $("#lstSpecie").prop('disabled', true);
           }
       },
       // complete: function (xhr) {

       //      if(opcion!=''){
       //          load_detalleGeneroSpecie(opcion,idspeciegenero);
       //      }

       //  },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}


// function load_detalleGeneroSpecie(dep_id, opcion) {
//     $.ajax({
//         url: CK.base_url + 'ajax/detalleGenero/' + dep_id,
//         type: 'GET',
//         data: {id: dep_id},
//         dataType: 'json',
//         beforeSend: function (xhr) {

//         },
//         success: function (response) {

//             console.log("detalle_specie_: ", response);
//             var select = "";
//             select += '<option value="">-- SELECCIONE --</option>';

//             $.each(response, function (key, value) {

//                 console.log("detalle_genero_specie[" + key + "]: " + value.descripcion);
//                 select += '<option value="'+value.id+'">' + (value.descripcion) + '</option>';

//             });

//             $("#lstGenero").html(select).trigger('change.select2');

//             if( opcion>0){

//              $("#lstGenero").val(opcion);
//              $("#lstGenero").prop('disabled', true);
//          }
//      },
//      error: function (err) {

//        console.log("show_error_: ", err.responseText);
//    }
// });
// }


function load_pasaporte(codPasaporte,recurso,banco){
 var idspecie='';
 var idcoleccion;
 var idspeciegenero;
 var url;

 if(banco==1) url=CK.base_url + 'ajax/cargaPasaporteInvitro/' + codPasaporte + '/' + recurso;
 if(banco==2) url=CK.base_url + 'ajax/cargaPasaporteCampo/' + codPasaporte + '/' + recurso;
 if(banco==3) url=CK.base_url + 'ajax/cargaPasaporteSemilla/' + codPasaporte + '/' + recurso;
 if(banco==4) url=CK.base_url + 'ajax/cargaPasaporteADN/' + codPasaporte + '/' + recurso;
 if(banco==5) url=CK.base_url + 'ajax/cargaPasaporteADNZoo/' + codPasaporte + '/' + recurso;
 if(banco==6) url=CK.base_url + 'ajax/cargaPasaporteADNMicro/' + codPasaporte + '/' + recurso;
 if(banco==7) url=CK.base_url + 'ajax/cargaPasaporteMicro/' + codPasaporte + '/' + recurso;

 $.ajax({
    url: url,
    type: 'GET',
    data: { id : codPasaporte,idrecurso: recurso},
    dataType: 'json',
    success: function (response) {

        console.log("pasaporte_: ", response);
        $("#btngrabarBancoInvitro").prop('disabled', true);
        $("#txtCodAccesion").val('');
        $("#txtCod").val('');
        $("#coleccion").val('');
        $("#txtCollecion").val('');
        $("#txtEspecie").val('');
        $("#txtgeneroSpecie").val('');
        $("#hdn_cod").val('');
        $("#lstSpecie").val('');
        $("#txtgenero").val('');
        $("#lstcoleccion").val('');
        $("#txtComun").val('');
        $("#msjBancoInvitro").text("");
        $("#txtAccname").val("");

        if(response!=null){

            $("#txtCod").val(response.passport.othenumb);
            $("#lstcoleccion").val(response.passport.specie.collection.id);
            $("#txtgeneroSpecie").val(response.passport.specie.genus);
            $("#hdn_cod").val(response.passport.id);
            idspecie=response.passport.specie.id;
            idcoleccion=response.passport.specie.collection.id;
            idspeciegenero=response.passport.specie.id;

            $("#txtCod").prop('disabled', true);
            $("#lstcoleccion").prop('disabled', true);
            $("#txtgeneroSpecie").prop('disabled', true);

            $("#txtCod").parent().removeClass( "has-error" );
            $("#txtCod-error").remove();
            $("#txtCod").removeClass( "myErrorClass" );
            $("#txtCod").parent().addClass( "has-success" );

            $("#lstcoleccion").parent().removeClass( "has-error" );
            $("#lstcoleccion-error").remove();
            $("#lstcoleccion").removeClass( "myErrorClass" );
            $("#lstcoleccion").parent().addClass( "has-success" );

            $("#lstSpecie").parent().removeClass( "has-error" );
            $("#lstSpecie-error").remove();
            $("#lstSpecie").removeClass( "myErrorClass" );
            $("#lstSpecie").parent().addClass( "has-success" );

            $("#lstGenero").parent().removeClass( "has-error" );
            $("#lstGenero-error").remove();
            $("#lstGenero").removeClass( "myErrorClass" );
            $("#lstGenero").parent().addClass( "has-success" );

            $("#txtgenero").val(response.passport.specie.genus);
            $("#coleccion").val(response.passport.specie.collection.id);
            $("#txtAccname").val(response.passport.accname);
            $("#txtCodAccesion").val(response.passport.othenumb);
            $("#txtCollecion").val(response.passport.specie.collection.colname);
            $("#txtEspecie").val(response.passport.specie.genus + ' ' + response.passport.specie.species+ ' ' + response.passport.specie.autor);
            $("#txtComun").val(response.passport.specie.cropname);
            $("#hdn_pasaporteid").val(response.passport.id);
            $("#btngrabarBancoInvitro").prop('disabled', false);
            $("#msjBancoInvitro").text("");
        }

        else{

            $("#msjBancoInvitro").text("Código de Accesión invalido");

            $("#txtCod").prop('disabled', false);
            $("#lstcoleccion").prop('disabled', false);
            $("#lstSpecie").prop('disabled', false);
            $("#lstGenero").prop('disabled', false);
            $("#txtCod").html('<option value="">-- SELECCIONE --</option>');
            $("#lstSpecie").html('<option value="">-- SELECCIONE --</option>');
            // $("#lstGenero").html('<option value="">-- SELECCIONE --</option>');
        }
    },

    complete: function (xhr) {

        load_detalleGenero(idcoleccion,idspecie,idspeciegenero);
        $("#lstSpecie").val(idspecie);

    },
    error: function (err) {
        console.log("show_error_: ", err.responseText);
    }
});


}

function ordenarDescriptores(){

    if ($(".simple_with_animation").length) {

     var adjustment;

     $("ol.simple_with_animation").sortable({
      group: 'simple_with_animation',
      pullPlaceholder: false,
              // animation on drop
              onDrop: function  ($item, container, _super) {
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                $item.animate($clonedItem.position(), function  () {
                  $clonedItem.detach();
                  _super($item, container);
              });
            },

              // set $item relative to cursor position
              onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                pointer = container.rootGroup.pointer;

                adjustment = {
                  left: pointer.left - offset.left,
                  top: pointer.top - offset.top
              };

              _super($item, container);
          },
          onDrag: function ($item, position) {
            $item.css({
              left: position.left - adjustment.left,
              top: position.top - adjustment.top
          });
        }
    });
 }


}

$(document).ready(function() {
 ordenarDescriptores();
 $("#chxreason").val('0');

 $("#txtCodAccesion").prop('disabled', true);
 $("#txtCollecion").prop('disabled', true);
 $("#txtEspecie").prop('disabled', true);
 $("#txtAccname").prop('disabled', true);

});


function load_provincia(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/provincia/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("provincia_: ", response);
            var select = "";
            select += '<option value="0">-- PROVINCIA --</option>';
            $.each(response, function (key, value) {
                console.log("provincia[" + key + "]: " + value.nombre);
                select += '<option value="' + value.cod_pro + '">' + value.nombre + '</option>';
            });
            $("#provincia").html(select).trigger('change.select2');
            $("#distrito").html('<option value="0">-- DISTRITO --</option>').trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

$(document).on('change', "#provincia", function () {
    var dep_id = $("#departamento").val();
    var pro_id = $("#provincia").val();
    if (pro_id !== "0") {
        load_distrito(dep_id, pro_id);
        load_provincia_id(dep_id, pro_id);
    } else {
        $("#distrito").html('<option value="0">-- DISTRITO --</option>').trigger('change.select2');
    }
});

/*************** INICIO VALIDA QUE SE SELECCIONE UBIGEO SI EL PAIS ES PERU *****************/
$(document).on('change', "#country_id", function () {

    var _pais = $( "#country_id option:selected" ).val();

    if (_pais == 173){

        $("select#departamento").prop('disabled', false);
        $("select#provincia").prop('disabled', false);
        $("select#distrito").prop('disabled', false);

    } else {

        $("select#departamento").prop('disabled', true);
        $("select#provincia").prop('disabled', true);
        $("select#distrito").prop('disabled', true);
        load_departamento();
        $("#provincia").html('<option value="0">-- PROVINCIA --</option>').trigger('change.select2');
        $("#distrito").html('<option value="0">-- DISTRITO --</option>').trigger('change.select2');
        $("#ubigeo_id").val('');
    }
});


function load_detallecomun(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/nombreComun/' + dep_id,
        type: 'GET',
        data: {depid: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("nombreComun_: ", response.cropname);
            $("#txtComun").val(response.cropname);
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

function load_departamento_id(dep_id, pro_id) {
    $.ajax({
        url: CK.base_url + 'ajax/departamentoid/' + dep_id,
        type: 'GET',
        data: {depid: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("departamentoid_: ", response.id);
            $("#ubigeo_id").val(response.id);
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

function load_provincia_id(dep_id, pro_id) {
    $.ajax({
        url: CK.base_url + 'ajax/provinciaid/' + dep_id + '/' + pro_id,
        type: 'GET',
        data: {depid: dep_id, proid: pro_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("provinciaid_: ", response.id);
            $("#ubigeo_id").val(response.id);
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}
/*************** FIN VALIDA QUE SE SELECCIONE UBIGEO SI EL PAIS ES PERU *****************/

function load_distrito(dep_id, pro_id) {
    $.ajax({
        url: CK.base_url + 'ajax/distrito/' + dep_id + '/' + pro_id,
        type: 'GET',
        data: {depid: dep_id, proid: pro_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("distrito_: ", response);
            var select = "";
            select += '<option value="0">-- DISTRITO --</option>';
            $.each(response, function (key, value) {
                console.log("distrito[" + key + "]: " + value.nombre);
                select += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            $("#distrito").html(select).trigger('change.select2');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

$(document).on('change', "#distrito", function () {
    var dis_id = $("#distrito").val();
    console.log("distrito_seleccionado_: ", dis_id);
    $("#ubigeo_id").val(dis_id);
});

$(document).on('click', "#sortable", function () {
    //ordenarDescriptores();
});

/********************************* VALIDA LA SELECCION PERTENECE A LA ORGANIZACION - INSITU ***********************************/
$(document).on('change', "#peasant-organization", function(){

    var _org = $( "#peasant-organization option:selected" ).val();

    if(_org == 1){

        $("#name-peasant-organization").prop('disabled', false);

    } else {

        $("#name-peasant-organization").prop('disabled', true);
        $("#name-peasant-organization").parent().removeClass( "has-error" );
        $("#name-peasant-organization-error").remove();
    }
});

/*************** INICIO select option - BUSCA EL PASAPORTE - INSITU ACCESIONES ****************/
$(document).on('change', "#passport-id", function () {
    var pass_id = $(this).val();
    if (pass_id !== "0") {
        load_insitupassport(pass_id);
    } else {
        $("#othenumb").val();
        $("#common-name").val();
    }
});

function load_insitupassport(pass_id) {
    $.ajax({
        url: CK.base_url + 'ajax/insitupassport/' + pass_id,
        type: 'GET',
        data: {id: pass_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("passport_: ", response);
            $("#othenumb").val(response.othenumb);
            $("#common-name").val(response.cropname);
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}
/*************** FIN select option - BUSCA EL PASAPORTE - INSITU ACCESIONES ****************/

/******************************************* INICIO DE VALIDACIONES **********************************************/

/****************** INICIO DE VALIDACION LOGIN *************************/
$(document).on('click', "#btnLogin", function () {

    $("#form_login").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            username:{
                required: true,
            },
            password:{
                required: true,
            },
        },
        messages: {
            username: "Usuario es un campo requerido.",
            password: "Contraseña es un campo requerido.",
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();


});
/****************** FIN DE VALIDACION LOGIN *************************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE USUARIOS **********************/
$(document).on('click', "#btnUser", function () {

    jQuery.validator.addMethod("valid_clave", function (value, element) {
       return this.optional(element) || /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{8,}$/.test(value);
   }, "El clave debe tener un número y una mayúscula como mínimo.");

    $.validator.addMethod("alfanumOespacio", function(value, element) {
        return /^[ a-záéíóúüñ]*$/i.test(value);
    }, "Ingrese sólo letras.");

    $("#form_add_user").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            names: {
                required: true,
                alfanumOespacio: true,
                minlength: 2,
                maxlength: 50,
            },
            surnames: {
                required: true,
                alfanumOespacio: true,
                minlength: 2,
                maxlength: 50,
            },
            station_id: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
                remote: {
                    url: CK.base_url + "ajax/verificaremail",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        email: function () {
                            if ($("input[name=email_hidden]").length) {
                                if ($("input[name=email]").val() !== $("input[name=email_hidden]").val()) {
                                    return ($("input[name=email]").val());
                                }
                            } else {
                                return ($("input[name=email]").val());
                            }
                        }
                    }
                }
            },
            role_id: {
                required: true,
                min: 1
            },
            password: {
                required   : true,
                valid_clave: true,
                minlength  : 8,
            },
            country_id: {
                required: true,
                min: 1,
            },
        },
        messages: {
            names: {required:"Nombre es un campo requerido.",
                    maxlength:"Ingrese como máximo 50 caracteres."},
            surnames: {required:"Apellidos es un campo requerido.",
                    maxlength:"Ingrese como máximo 50 caracteres."},
            station_id: "Seleccione Estación Experimental ",
            email: {
                required: "E-mail es un campo requerido.",
                email: "Ingrese e-mail válido.",
                remote: jQuery.validator.format("E-mail ya existe."),
                maxlength:"Ingrese como máximo 50 caracteres.",

            },
            password: {
                required: "Password es un campo requerido.",
                minlength: "El password debe tener como mínimo 8 caracteres.",
            },
            role_id: "Seleccione un rol",
            country_id: "Seleccione un País",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnUser').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE USUARIOS **********************/

/****************** INICIO DE CAMBIO DE CLAVE - USUARIOS **********************/
$(document).on('click', "#btnChangeClave", function () {

    jQuery.validator.addMethod("validar_clave", function (value, element) {
       return this.optional(element) || /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{8,30}$/.test(value);
   }, "El clave debe tener un número y una mayúscula como mínimo.");

    $("#form_change_password").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {

            password: {
                required     : true,
                validar_clave: true,
                minlength    : 8,
            },
            password_again: {
              equalTo: "#password"
          },

      },
      messages: {
        password: {
            required: "Password es un campo requerido.",
            minlength: "El password debe tener como mínimo 8 caracteres.",
        },
        password_again: {
            equalTo: "Las claves no coinciden. Por favor verifique.",
        },
    },
    submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnChangeClave').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE CAMBIO DE CLAVE - USUARIOS **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE ESTACION **********************/
$(document).on('click', "#btnEstacion", function () {

   jQuery.validator.addMethod("validar_nueve", function (value, element) {

       return value.length==0?true:value.charAt(0)=='9';

   }, "El primer número debe ser 9.");

   $("#form_station").validate({
    errorClass: 'myErrorClass',
    errorElement: "span",
    rules: {
                eea: {
                    required: true,
                    maxlength: 100,
                },
                collsite: {
                    required: true,
                    maxlength: 100,
                },
                responsible: {
                    required: true,
                    maxlength: 100,
                },
                telephone: {
                    required: false,
                    minlength: 7,
                    maxlength: 9,
                },
                celphone: {
                    required: true,
                    validar_nueve: true,
                    minlength: 9,
                    maxlength: 9,
                },

                email: {
                    required  : true,
                    email     : true,
                    maxlength : 30,
                    // minlength: 40,
                    // maxlength: ,                   
                },

                country_id: {
                    required: true,
                    min: 1,
                },
                // departamento: {
                //     required: true,
                //     min: 1,
                // },
                // provincia: {
                //     required: true,
                //     min: 1,
                // },
                // distrito: {
                //     required: true,
                //     min: 1,
                // },
                // localidad: {
                //     required: true,
                //     maxlength: 100,
                // },
                // availability: {
                //     required: true,
                //     min: 1,
                // },
            },
    messages: {
        eea     : "Estación Experimental es un campo requerido.",
        collsite: "Ubicación del sitio es un campo requerido.",
        telephone: {
            // required : "Teléfono es un campo requerido.",
            minlength: "Teléfono debe tener como mínimo 7 dígitos.",
        },
        responsible: "Responsable es un campo requerido.",
        celphone: {
            required : "Celular es un campo requerido.",
            minlength: "Celular debe tener 9 dígitos.",
        },
        email: {
            required : "Email es un campo requerido.",
            email    : "Ingrese e-mail válido.",
            remote   : jQuery.validator.format("E-mail ya existe."),
            maxlength:"Ingrese como máximo 30 caracteres.",
        },
        country_id  : "Seleccione un País",
        // departamento: "Seleccione un Departamento",
        // provincia   : "Seleccione una Provincia",
        // distrito    : "Seleccione un Distrito",
        // localidad   : "Localidad es un campo requerido.",
    },
    submitHandler: function (form) {
                // return false;
                console.log("enviando_data_form_:");
                $('#btnEstacion').attr("disabled", true);
                 //$('.overlay').css("display", 'block');
                 form.submit();
             },
             highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();

        // if($("#form_station").valid()){
        //     $('#btnEstacion').attr("disabled", true);
        // }
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE ESTACION **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE COLLECTION **********************/
$(document).on('click', "#btnCollection", function () {
    $("#form_collection").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            colname: {
                required: true,
                maxlength: 100,
            },
            colgroup: {
                required: true,
                maxlength: 100,
            },
            type: {
                required: true,
                min: 1,
            },
            eea: {
                required: true,
                min: 1,
            },
            invitro: {
                required: true,
                min: 1,
            },
            bseed: {
                required: true,
                min: 1,
            },
            bfield: {
                required: true,
                min: 1,
            },
            bdna: {
                required: true,
                min: 1,
            },
            insitu: {
                required: true,
                min: 1,
            },
            resource_id:{
                required: true,
            },
            availability: {
                required: true,
                min: 1,
            },
        },
        messages: {
            colname     : "Nombre es un campo requerido.",
            colgroup    : "Grupo es un campo requerido.",
            type        : "Seleccione un Tipo de Recurso",
            eea         : "Seleccione una Estación Experimental",
            invitro     : "Seleccione un valor para el Banco in vitro",
            resource_id : "Seleccione un Tipo de Recurso",
            bseed       : "Seleccione un valor para el Banco de Semillas",
            bfield      : "Seleccione un valor para el Banco de Campo",
            bdna        : "Seleccione un valor para el Banco de ADN",
            insitu      : "Seleccione un valor para la Conservación In Situ",
            availability: "Seleccione una disponibilidad.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnCollection').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE COLLECTION **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE SPECIE **********************/
$(document).on('click', "#btnSpecie", function () {
    $("#form_specie").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            genus: {
                required: true,
                maxlength: 100,
            },
            species: {
                required: true,
                maxlength: 100,
            },            
            cropname: {
                required: true,
                maxlength: 100,
            },
            family: {
                required: true,
                maxlength: 100,
            },
            resource_id: {
                required: true,
            },
            collection_id: {
                required: true,
            },
            availability: {
                required: false,
            },
            autor: {
                required: false,
            },
        },
        messages: {
            genus        : "Género es un campo requerido.",
            species      : "Nombre es un campo requerido.",
            cropname     : "Nombre Comun es un campo requerido.",
            // family       : "Familia es un campo requerido..",
            collection_id: "Seleccione una Colección.",
            availability : "Seleccione una disponibilidad.",
            resource_id  : "Seleccione un recurso.",
        },
        submitHandler: function (form) {
                        // return false;
                        $('#btnSpecie').attr("disabled", true);
                        console.log("enviando_data_form_:");
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE SPECIE **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE LISTA 1 **********************/
$(document).on('click', "#btnLista", function () {
    $("#form_lista").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            name: {
                required: true,
                maxlength: 150,
            },
            resource_id: {
                required: true,
            },
        },
        messages: {
            name        :{
                            required:"Nombre es un campo requerido.",
                            maxlength:'Ingresar como máximo 50 caracteres'
                         },
            resource_id : "Seleccione un Recurso.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnLista').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE LISTA 1 **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE LISTA 2 **********************/
$(document).on('click', "#btnListaChild", function () {
    $("#form_listachild").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            name: {
                required: true,
                maxlength: 150,
            },
            resource_id: {
                required: true
            },
        },
        messages: {
            name    :{
                        required:"Nombre es un campo requerido.",
                        maxlength:'Ingresar como máximo 50 caracteres'
                    },
            resource_id : "Seleccione un Recurso.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnListaChild').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }

                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE LISTA 2 **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE LISTA 3 **********************/
$(document).on('click', "#btnListaCategoria", function () {
    $("#form_listacategoria").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            name: {
                required: true,
                maxlength: 50,
            },
            resource_id: {
                required: true,
            },
        },
        messages: {
            name    :{
                        required:"Nombre es un campo requerido.",
                        maxlength:'Ingresar como máximo 50 caracteres'
                    },
            resource_id : "Seleccione un Recurso.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnListaCategoria').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE LISTA 3 **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE PASAPORTE FITO **********************/
$(document).on('click', "#btnPassportFito", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("geolocalizacion", function (value, element) {
        return this.optional(element) || /^-?[0-9]\d{0,4}(\.\d{0,5})?$/i.test(value);
    }, "El campo es numérico y solo debe tener max. 5 decimales.");

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango debe estar entre -100 a 100.");

    jQuery.validator.addMethod("validar_passport", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassport",
        //     type: 'POST',
        //     data: { valor: 1 },
        //     dataType: 'json',
        //     success: function (response) {

        //         if(response)
        //             $("#passport-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passport-validation").val();
                var lista  = inputs.split(',');
                mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                        break;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    jQuery.validator.addMethod("validar_passportfito", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassportfito",
        //     type: 'POST',
        //     data: { valor: 1 },
        //     dataType: 'json',
        //     success: function (response) {

        //         if(response)
        //             $("#passfito-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passfito-validation").val();
                var lista  = inputs.split(',');
                mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    $("#form_passportfito").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore : [],

        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            'passport[instcode]': {
                validar_passport : { valor : 'instcode' },
            },
            'passport[accname]': {
                validar_passport : { valor : 'accname' },
            },
            'passport[othenumb]': {
                validar_passport : { valor : 'othenumb' },
            },
            coleccion: {
                validar_passport : { valor : 'specie_id' },
            },
            'passport[specie_id]': {
                validar_passport : { valor : 'specie_id' },
                required: {
                    depends: function(element) {
                        return ($('#coleccion').val() != '');
                    }
                },
            },
            'passport[resource_id]': {
                validar_passport : { valor : 'resource_id' },
            },
            'passport[station_current_id]': {
                validar_passport : { valor : 'station_current_id' },
            },
            'passport[station_origin_id]': {
                validar_passport : { valor : 'station_origin_id' },
            },
            'passport[country_id]': {
                validar_passport : { valor : 'country_id' },
            },
            'passport[promissory]': {
                validar_passport : { valor : 'promissory' },
            },
            departamento: {
                required: true,
                min: 1,
            },
            provincia: {
                required: true,
                min: 1,
            },
            distrito: {
                required: true,
                min: 1,
            },
            'passport[localidad]': {
                validar_passport : { valor : 'localidad' },
            },
            'passportFito[subtype]' : {
                validar_passportfito : { valor : 'subtype' },
            },
            'passportFito[collnumb]' : {
                validar_passportfito : { valor : 'collnumb' },
            },
            'passportFito[spauthor]' : {
                validar_passportfito : { valor : 'spauthor' },
            },
            'passportFito[subtaxa]' : {
                validar_passportfito : { valor : 'subtaxa' },
            },
            'passportFito[subtauthor]' : {
                validar_passportfito : { valor : 'subtauthor' },
            },
            'passportFito[storage]' : {
                validar_passportfito : { valor : 'storage' },
            },
            fecha_aquisicion : {
                validar_passportfito : { valor : 'acqdate' },
            },
            'passportFito[availability]' : {
                validar_passportfito : { valor : 'availability' },
            },
            'passportFito[collsite]' : {
                validar_passportfito : { valor : 'collsite' },
            },
            'passportFito[latitude]' : {
                validar_passportfito : { valor : 'latitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportFito[longitude]' : {
                validar_passportfito : { valor : 'longitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportFito[samptype]' : {
                validar_passportfito : { valor : 'samptype' },
                decimals: true,
            },
            'passportFito[sampsize]' : {
                validar_passportfito : { valor : 'sampsize' },
                naturals: true,
            },
            'passportFito[humidity]' : {
                 validar_passportfito : { valor : 'humidity' },
                 range: [0, 100],
            },
            'passportFito[temp]' : {
                validar_passportfito : { valor : 'temp' },
                range: [0, 100],
            },
            'passportFito[presure]' : {
                validar_passportfito : { valor : 'presure' },
                decimals: true,
            },
            'passportFito[precipitation]' : {
                validar_passportfito : { valor : 'precipitation' },
                decimals: true,
            },
            'passportFito[elevation]' : {
                validar_passportfito : { valor : 'elevation' },
                number: true,
                geolocalizacion : true,
            },
            'passportFito[coorddatum]' : {
                validar_passportfito : { valor : 'coorddatum' },
            },
            'passportFito[georefmeth]' : {
                validar_passportfito : { valor : 'georefmeth' },
            },
            'passportFito[coorduncert]' : {
                validar_passportfito : { valor : 'coorduncert' },
            },
            'passportFito[collcode]' : {
                validar_passportfito : { valor : 'collcode' },
            },
            'passportFito[collname]' : {
                validar_passportfito : { valor : 'collname' },
            },
            'passportFito[collinstaddress]' : {
                validar_passportfito : { valor : 'collinstaddress' },
            },
            'passportFito[collmissind]' : {
                validar_passportfito : { valor : 'collmissind' },
            },
            'passportFito[collsrc]' : {
                validar_passportfito : { valor : 'collsrc' },
            },
            'passportFito[collsrcdet]' : {
                validar_passportfito : { valor : 'collsrcdet' },
            },
            'passportFito[sampstat]' : {
                validar_passportfito : { valor : 'sampstat' },
            },
            fecha_recoleccion : {
                validar_passportfito : { valor : 'colldate' },
            },
            'passportFito[localname]' : {
                validar_passportfito : { valor : 'localname' },
            },
            'passportFito[groupethnic]' : {
                validar_passportfito : { valor : 'groupethnic' },
            },
            'passportFito[sampling]' : {
                validar_passportfito : { valor : 'sampling' },
            },
            'passportFito[plauspart]' : {
                validar_passportfito : { valor : 'plauspart' },
            },
            'passportFito[uso]' : {
                validar_passportfito : { valor : 'uso' },
            },
            'passportFito[poparea]' : {
                validar_passportfito : { valor : 'poparea' },
            },
            'passportFito[pathogen]' : {
                validar_passportfito : { valor : 'pathogen' },
            },
            'passportFito[donorcore]' : {
                validar_passportfito : { valor : 'donorcore' },
            },
            'passportFito[donorname]' : {
                validar_passportfito : { valor : 'donorname' },
            },
            'passportFito[donaddress]' : {
                validar_passportfito : { valor : 'donaddress' },
            },
            'passportFito[donornumb]' : {
                validar_passportfito : { valor : 'donornumb' },
            },
            'passportFito[soiltext]' : {
                validar_passportfito : { valor : 'soiltext' },
            },
            'passportFito[soilped]' : {
                validar_passportfito : { valor : 'soilped' },
            },
            'passportFito[soilcol]' : {
                validar_passportfito : { valor : 'soilcol' },
            },
            'passportFito[soilph]' : {
                validar_passportfito : { valor : 'soilph' },
            },
            'passportFito[soilrel]' : {
                validar_passportfito : { valor : 'soilrel' },
            },
            'passportFito[mancest]' : {
                validar_passportfito : { valor : 'mancest' },
            },
            'passportFito[pancest]' : {
                validar_passportfito : { valor : 'pancest' },
            },
            'passportFito[ancest]' : {
                validar_passportfito : { valor : 'ancest' },
            },
            'passportFito[mlsstat]' : {
                validar_passportfito : { valor : 'mlsstat' },
            },
            'passportFito[patent]' : {
                validar_passportfito : { valor : 'patent' },
            },
            'passportFito[bredcode]' : {
                validar_passportfito : { valor : 'bredcode' },
            },
            'passportFito[bredname]' : {
                validar_passportfito : { valor : 'bredname' },
            },
            'passportFito[duplinstname]' : {
                validar_passportfito : { valor : 'duplinstname' },
            },
            'passportFito[duplsite]' : {
                validar_passportfito : { valor : 'duplsite' },
            },
            'passportFito[invitro]' : {
                validar_passportfito : { valor : 'invitro' },
            },
            'passportFito[bseed]' : {
                validar_passportfito : { valor : 'bseed' },
            },
            'passportFito[bfield]' : {
                validar_passportfito : { valor : 'bfield' },
            },
            'passportFito[insitu]' : {
                validar_passportfito : { valor : 'insitu' },
            },
            'passportFito[bdna]' : {
                validar_passportfito : { valor : 'bdna' },
            },
            'passportFito[remarks]' : {
                validar_passportfito : { valor : 'remarks' },
            },
        },
        messages: {
            'passport[instcode]'           : "Código FAO es un campo requerido.",
            'passport[accname]'            : "Nombre de Accesión es un campo requerido.",
            'passport[othenumb]'           : "Código de Accesión es un campo requerido.",
            'passport[specie_id]'          : "Seleccione un Nombre Científico.",
            'passport[resource_id]'        : "Seleccione un subtipo de recurso.",
            'coleccion'                    : "Seleccione una Colección",
            'passport[station_current_id]' : "Seleccione una Estación Experimental.",
            'passport[station_origin_id]'  : "Seleccione una Est. Exp. Procedencia.",
            'passport[country_id]'         : "Seleccione un País.",
            departamento                   : "Seleccione un Departamento.",
            provincia                      : "Seleccione una Provincia.",
            distrito                       : "Seleccione un Distrito.",
            'passport[localidad]'          : "Localidad es un campo requerido.",
            'passportFito[subtype]'        : "Seleccione un SubTipo de Recurso.",
            'passportFito[collnumb]'       : "Código Colecta es un campo requerido.",
            'passportFito[spauthor]'       : "Autoría de la Especie no puede estar vacío.",
            'passportFito[subtaxa]'        : "Subtaxones no puede estar vacío.",
            'passportFito[subtauthor]'     : "Autoría de los Subtaxones no puede estar vacío.",
            'passportFito[storage]'        : "Seleccione un Tipo Conservación.",
            'fecha_aquisicion'             : "Fecha de introducción es un campo requerido.",
            'passport[promissory]'         : "Seleccione una Promisoria.",
            'passportFito[availability]'   : "Seleccione una Disponibilidad.",
            'passportFito[collsite]'       : "Ubicación del Sitio no puede estar vacío.",
            'passportFito[latitude]'       : {
                number: "Solo se permiten números.",
            },
            'passportFito[longitude]'      : {
                number: "Solo se permiten números.",
            },
            'passportFito[elevation]'      : {
                number: "Solo se permiten números.",
            },
            'passportFito[coorddatum]'     : "Tipo Coordenada es un campo requerido.",
            'passportFito[georefmeth]'     : "Método de Georeferenciación es un campo requerido.",
            'passportFito[coorduncert]'    : "Incertidumbre de Coordenadas es un campo requerido.",
            'passportFito[collcode]'       : "Código del Instituto de Colecta es un campo requerido.",
            'passportFito[collname]'       : "Nombre del Colector es un campo requerido.",
            'passportFito[collinstaddress]': "Dirección del Colector es un campo requerido.",
            'passportFito[collmissind]'    : "Misión de Colecta es un campo requerido.",
            'passportFito[collsrc]'        : "Seleccione una Fuente.",
            'passportFito[collsrcdet]'     : "Seleccione una Fuente Detalle.",
            'passportFito[sampstat]'       : "Seleccione una Condición Biológica.",
            'fecha_recoleccion'            : "Fecha Recolección es un campo requerido.",
            'passportFito[localname]'      : "Nombre local del material es un campo requerido.",
            'passportFito[groupethnic]'    : "Grupo Étnico es un campo requerido.",
            'passportFito[samptype]'       : "Seleccione un Tipo de Muestra.",
            'passportFito[sampsize]'       : "Número de Plantas Muestreadas es un campo requerido.",
            'passportFito[sampling]'       : "Tipo de Muestreo es un campo requerido.",
            'passportFito[plauspart]'      : "Parte Útil de la Planta es un campo requerido.",
            'passportFito[uso]'            : "Seleccione un Uso de la Planta.",
            'passportFito[poparea]'        : "Área de la Colecta es un campo requerido.",
            'passportFito[pathogen]'       : "Patógeno es un campo requerido.",
            'passportFito[donorcore]'      : "Código del Donante es un campo requerido.",
            'passportFito[donorname]'      : "Nombre del Donante es un campo requerido.",
            'passportFito[donaddress]'     : "Dirección del Donante es un campo requerido.",
            'passportFito[donornumb]'      : "Código Accesión del Donante es un campo requerido.",
            'passportFito[humidity]'       : {
                required : "Humedad Ambiente es un campo requerido.",
            },
            'passportFito[temp]'           : {
                required: "Temperatura Ambiente es un campo requerido.",
            },
            'passportFito[presure]'        : {
                required: "Presión Atmosferica es un campo requerido.",
            },
            'passportFito[precipitation]'  : {
                required: "Precipitación es un campo requerido.",
            },
            'passportFito[soiltext]'       : "Textura del Suelo es un campo requerido.",
            'passportFito[soilped]'        : "Pedregocidad del Suelo es un campo requerido.",
            'passportFito[soilcol]'        : "Color del Suelo es un campo requerido.",
            'passportFito[soilph]'         : "PH del Suelo es un campo requerido.",
            'passportFito[soilrel]'        : "Relieve del Suelo es un campo requerido.",
            'passportFito[mancest]'        : "Ancestro Materno es un campo requerido.",
            'passportFito[pancest]'        : "Ancestro Paterno es un campo requerido.",
            'passportFito[ancest]'         : "Datos Ancestrales es un campo requerido.",
            'passportFito[mlsstat]'        : "Seleccione un Sistema Multilateral.",
            'passportFito[patent]'         : "Patente es un campo requerido.",
            'passportFito[bredcode]'       : "Código Instituto de Mejoramiento es un campo requerido.",
            'passportFito[bredname]'       : "Nombre Instituto de Mejoramiento es un campo requerido.",
            'passportFito[duplinstname]'   : "Ubicación de Duplicados de Seguridad es un campo requerido.",
            'passportFito[duplsite]'       : "Ubicación de Duplicados de Seguridad es un campo requerido.",
            'passportFito[invitro]'        : "Seleccione un Banco Invitro.",
            'passportFito[bseed]'          : "Seleccione un Banco Semilla.",
            'passportFito[bfield]'         : "Seleccione un Banco Campo.",
            'passportFito[insitu]'         : "In Situ es un campo requerido.",
            'passportFito[bdna]'           : "Seleccione un Banco ADN",
            'passportFito[remarks]'        : "Anotaciones es un campo requerido.",
        },
        submitHandler: function (form) {

            console.log("enviando_data_form_:");
            $('#btnPassportFito').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE PASAPORTE FITO **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE PASAPORTE ZOO **********************/
$(document).on('click', "#btnPassportZoo", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("geolocalizacion", function (value, element) {
        return this.optional(element) || /^-?[0-9]\d{0,4}(\.\d{0,5})?$/i.test(value);
    }, "El campo es numérico y solo debe tener max. 5 decimales.");

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango del porcentaje debe estar entre -100 a 100.");

    jQuery.validator.addMethod("validFecha", function(value, element, params) {
            date1 = value.split("-").reverse().join("-");
            date2 = ($(params).val()).split("-").reverse().join("-");

            if (!/Invalid|NaN/.test(new Date(date1))) {
                return new Date(date1) > new Date(date2);
            }

        return isNaN(date1) && isNaN(date2) || (Number(date1) > Number(date2));
    },'Fecha Deceso debe ser mayor a la Fecha de Nacimiento.');

    jQuery.validator.addMethod("validar_passport", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassport",
        //     type: 'POST',
        //     data: { valor: 2 },
        //     dataType: 'json',
        //     success: function (response) {
        //         if(response)
        //             $("#passport-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passport-validation").val();
                var lista  = inputs.split(',');
                mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    jQuery.validator.addMethod("validar_passportzoo", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassportzoo",
        //     type: 'POST',
        //     data: { valor: 2 },
        //     dataType: 'json',
        //     success: function (response) {
        //         if(response)
        //             $("#passzoo-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passzoo-validation").val();
                var lista  = inputs.split(',');
                var mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    $("#form_passportzoo").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore : [],

        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            'passportZoo[subtype]':   {
                validar_passportzoo : { valor : 'subtype' },
            },
            'passportZoo[collnumb]':  {
                validar_passportzoo : { valor : 'collnumb' },
            },
            'passportZoo[colname]':  {
                validar_passportzoo : { valor : 'colname' },
            },
            'passportZoo[spauthor]':  {
                validar_passportzoo : { valor : 'spauthor' },
            },
            'passportZoo[subtaxa]':  {
                validar_passportzoo : { valor : 'subtaxa' },
            },
            'passportZoo[subtauthor]':  {
                validar_passportzoo : { valor : 'subtauthor' },
            },
            'passportZoo[racetype]':  {
                validar_passportzoo : { valor : 'racetype' },
            },
            'passportZoo[storage]':  {
                validar_passportzoo : { valor : 'storage' },
            },
            'fecha_ingreso':  {
                validar_passportzoo : { valor : 'acqdate' },
            },
            'passportZoo[eea]':  {
                validar_passport : { valor : 'station_current_id' },
            },
            'passportZoo[eeaproc]':  {
                validar_passport : { valor : 'station_origin_id' },
            },
            'passport[promissory]': {
                validar_passport : { valor : 'promissory' },
            },
            'passportZoo[availability]':  {
                validar_passportzoo : { valor : 'availability' },
            },
            'passportZoo[collsite]':  {
                validar_passportzoo : { valor : 'collsite' },
            },
            'passportZoo[latitude]':  {
                validar_passportzoo : { valor : 'latitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportZoo[longitude]':  {
                validar_passportzoo : { valor : 'longitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportZoo[elevation]':  {
                validar_passportzoo : { valor : 'elevation' },
                number: true,
                geolocalizacion: true,
            },
            'passportZoo[coorddatum]':  {
                validar_passportzoo : { valor : 'coorddatum' },
            },
            'passportZoo[georefmeth]':  {
                validar_passportzoo : { valor : 'georefmeth' },
            },
            'passportZoo[remarks1]': {
                validar_passportzoo : { valor : 'remarks1' },
            },
            'passportZoo[remarks2]': {
                validar_passportzoo : { valor : 'remarks2' },
            },
            'passportZoo[remarks3]': {
                validar_passportzoo : { valor : 'remarks3' },
            },
            'passportZoo[remarks4]': {
                validar_passportzoo : { valor : 'remarks4' },
            },
            'passportZoo[collcode]': {
                validar_passportzoo : { valor : 'collcode' },
            },
            'passportZoo[collname]': {
                validar_passportzoo : { valor : 'collname' },
            },
            'passportZoo[colladdress]': {
                validar_passportzoo : { valor : 'colladdress' },
            },
            'passportZoo[collmissind]': {
                validar_passportzoo : { valor : 'collmissind' },
            },
            'passportZoo[localname]': {
                validar_passportzoo : { valor : 'localname' },
            },
            'fecha_recoleccion': {
                validar_passportzoo : { valor : 'colldate' },
            },
            'passportZoo[sampstat]': {
                validar_passportzoo : { valor : 'sampstat' },
            },
            'passportZoo[collsrc]': {
                validar_passportzoo : { valor : 'collsrc' },
            },
            'passportZoo[collsrcdet]': {
                validar_passportzoo : { valor : 'collsrcdet' },
            },
            'passportZoo[groupethnic]': {
                validar_passportzoo : { valor : 'groupethnic' },
            },
            'fecha_nacimiento': {
                validar_passportzoo : { valor : 'datebirth' },
            },
            'fecha_deceso': {
                validar_passportzoo : { valor : 'dateofdec' },
                validFecha : '#fecha-nacimiento',
            },
            'passportZoo[samptype]': {
                validar_passportzoo : { valor : 'samptype' },
            },
            'passportZoo[sampling]': {
                validar_passportzoo : { valor : 'sampling' },
            },
            'passportZoo[anuspart]': {
                validar_passportzoo : { valor : 'anuspart' },
            },
            'passportZoo[uso]': {
                validar_passportzoo : { valor : 'uso' },
            },
            'passportZoo[pathogen]': {
                validar_passportzoo : { valor : 'pathogen' },
            },
            'passportZoo[poparea]': {
                validar_passportzoo : { valor : 'poparea' },
            },
            'passport[instcode]':{
                validar_passport : { valor : 'instcode' },
            },
            'passport[othenumb]':{
                validar_passport : { valor : 'othenumb' },
            },
            'passport[accname]':{
                validar_passport : { valor : 'accname' },
            },
            'passport[specie_id]': {
                validar_passport : { valor : 'specie_id' },
                required: {
                    depends: function(element) {
                        return ($('#coleccion').val() != '');
                    }
                },
            },
            coleccion: {
                validar_passport : { valor : 'specie_id' },
            },
            'passport[country_id]': {
                validar_passport : { valor : 'country_id' },
            },
            departamento: {
                required: true,
                min: 1,
            },
            provincia: {
                required: true,
                min: 1,
            },
            distrito: {
                required: true,
                min: 1,
            },
            'passportZoo[humidity]':{
                range: [-100, 100],
                validar_passportzoo : { valor : 'humidity' },
            },
            'passportZoo[temp]':{
                range: [-100, 100],
                validar_passportzoo : { valor : 'temp' },
            },
            'passportZoo[presure]':{
                decimals: true,
                validar_passportzoo : { valor : 'presure' },
            },
            'passportZoo[precipitation]':{
                decimals: true,
                validar_passportzoo : { valor : 'precipitation' },
            },
            'passportZoo[mancest]': {
                validar_passportzoo : { valor : 'mancest' },
            },
            'passportZoo[pancest]': {
                validar_passportzoo : { valor : 'pancest' },
            },
            'passportZoo[ancest]': {
                validar_passportzoo : { valor : 'ancest' },
            },
            'passportZoo[owname]': {
                validar_passportzoo : { valor : 'owname' },
            },
            'passportZoo[owaddress]': {
                validar_passportzoo : { valor : 'owaddress' },
            },
            'passportZoo[donorcore]': {
                validar_passportzoo : { valor : 'donorcore' },
            },
            'passportZoo[donorname]': {
                validar_passportzoo : { valor : 'donorname' },
            },
            'passportZoo[donaddress]': {
                validar_passportzoo : { valor : 'donaddress' },
            },
            'passportZoo[mlsstat]': {
                validar_passportzoo : { valor : 'mlsstat' },
            },
            'passportZoo[patent]': {
                validar_passportzoo : { valor : 'patent' },
            },
            'passportZoo[bredcode]': {
                validar_passportzoo : { valor : 'bredcode' },
            },
            'passportZoo[bredname]': {
                validar_passportzoo : { valor : 'bredname' },
            },
            'passportZoo[duplinstname]': {
                validar_passportzoo : { valor : 'duplinstname' },
            },
            'passportZoo[duplsite]': {
                validar_passportzoo : { valor : 'duplsite' },
            },
            'passportZoo[bdna]': {
                validar_passportzoo : { valor : 'bdna' },
            },
            'passportZoo[remarks]': {
                validar_passportzoo : { valor : 'remarks' },
            },
        },
        messages: {
            'passport[instcode]'        : "Código FAO .",
            'passport[accname]'         : "Nombre de Accesión es un campo requerido.",
            'passport[othenumb]'        : "Código de Accesión es un campo requerido.",
            'passport[specie_id]'       : "Seleccione un Nombre Científico.",
            'passport[resource_id]'     : "Seleccione un subtipo de recurso.",
            'coleccion'                 : "Seleccione una Colección",
            'passport[country_id]'      : "Seleccione un País.",
            departamento                : "Seleccione un Departamento.",
            provincia                   : "Seleccione una Provincia.",
            distrito                    : "Seleccione un Distrito.",
            'passport[instcode]'        : "Código FAO es un campo requerido.",
            'passport[othenumb]'        : "Código Accesión es un campo requerido.",
            'passport[accname]'         : "Nombre de la Accesión es un campo requerido.",
            'passportZoo[subtype]'      : "Seleccione un SubTipo de Recurso.",
            'passportZoo[collnumb]'     : "Código de Colecta es un campo requerido.",
            'passportZoo[spauthor]'     : "Autor Especie es un campo requerido.",
            'passportZoo[subtaxa]'      : "SubTaxon es un campo requerido.",
            'passportZoo[subtauthor]'   : "SubTaxon Autor es un campo requerido.",
            'passportZoo[racetype]'     : "Tipo de Raza es un campo requerido.",
            'passportZoo[storage]'      : "Tipo Conservación es un campo requerido.",
            'passportZoo[acqdate]'      : "Fecha Ingreso es un campo requerido.",
            'passportZoo[eea]'          : "Seleccione una Estación Experimental",
            'passportZoo[eeaproc]'      : "Seleccione una Estación Experimental de Procedencia",
            'passportZoo[availability]' : "Seleccione una Disponibilidad.",
            'passportZoo[collsite]'     : "Referencia es un campo requerido.",
            'fecha_deceso': {
                required: "Fecha Deceso es un campo requerido.",
            },
            'passportZoo[latitude]'     : {
                required: "Latitud es un campo requerido.",
                number: "Solo se permiten números.",
            },
            'passportZoo[longitude]'    : {
                required: "Longitud es un campo requerido.",
                number: "Solo se permiten números.",
            },
            'passportZoo[elevation]'    : {
                required: "Altitud es un campo requerido.",
                number: "Solo se permiten números.",
            },
            'passportZoo[coorddatum]'   : "Tipo Coordenada es un campo requerido.",
            'passportZoo[georefmeth]'   : "Método de Georeferenciación es un campo requerido.",
            'passportZoo[remarks1]'     : "Campo es un campo requerido.",
            'passportZoo[remarks2]'     : "Campo es un campo requerido.",
            'passportZoo[remarks3]'     : "Campo es un campo requerido.",
            'passportZoo[remarks4]'     : "Campo es un campo requerido.",
            'passportZoo[collcode]'     : "Código del Instituto de Colecta es un campo requerido.",
            'passportZoo[collname]'     : "Nombre Colector es un campo requerido.",
            'passportZoo[colladdress]'  : "Dirección Colector es un campo requerido.",
            'passportZoo[collmissind]'  : "Misión de Colecta es un campo requerido.",
            'passportZoo[localname]'    : "Nombre Local es un campo requerido.",
            'passportZoo[colldate]'     : "Fecha recolección es un campo requerido.",
            'passportZoo[sampstat]'     : "Condición Biológica es un campo requerido.",
            'passportZoo[collsrc]'      : "Fuente es un campo requerido.",
            'passportZoo[collsrcdet]'   : "Fuente Detalle es un campo requerido.",
            'passportZoo[groupethnic]'  : "Grupo Etnico es un campo requerido.",
            'passportZoo[datebirth]'    : "Fecha nacimiento es un campo requerido.",
            'passportZoo[dateofdec]'    : "Fecha Deceso es un campo requerido.",
            'passportZoo[samptype]'     : "Tipo de Muestra es un campo requerido.",
            'passportZoo[sampling]'     : "Tipo Muestreo es un campo requerido.",
            'passportZoo[anuspart]'     : "Parte útiles del Animal es un campo requerido.",
            'passportZoo[uso]'          : "Uso del Animal es un campo requerido.",
            'passportZoo[pathogen]'     : "Patógeno es un campo requerido.",
            'passportZoo[poparea]'      : "Área es un campo requerido.",
            'passportZoo[humidity]'     : {
                required: "Humedad Ambiente es un campo requerido.",
            },
            'passportZoo[temp]'         : {
                required: "Temperatura Ambiente es un campo requerido.",
            },
            'passportZoo[presure]'      : {
                required: "Presión Atmosférica es un campo requerido.",
            },
            'passportZoo[precipitation]': {
                required: "Precipitación es un campo requerido.",
            },
            'passportZoo[mancest]'      : "Ancestro Materno es un campo requerido.",
            'passportZoo[pancest]'      : "Ancestro Paterno es un campo requerido.",
            'passportZoo[ancest]'       : "Datos Ancestrales es un campo requerido.",
            'passportZoo[owname]'       : "Criador (Propietario) es un campo requerido.",
            'passportZoo[owaddress]'    : "Dirección del Criador es un campo requerido.",
            'passportZoo[donorcore]'    : "Código del Donante es un campo requerido.",
            'passportZoo[donorname]'    : "Nombre del Donante es un campo requerido.",
            'passportZoo[donaddress]'   : "Dirección del Donante es un campo requerido.",
            'passportZoo[mlsstat]'      : "Sistema Multilateral es un campo requerido.",
            'passportZoo[patent]'       : "Patente es un campo requerido.",
            'passportZoo[bredcode]'     : "Código Instituto de Mejoramiento es un campo requerido.",
            'passportZoo[bredname]'     : "Nombre Instituto de Mejoramiento es un campo requerido.",
            'passportZoo[duplinstname]' : "Ubicación de Duplicados de Seguridad es un campo requerido.",
            'passportZoo[duplsite]'     : "Ubicación de Duplicados de Seguridad es un campo requerido.",
            'passportZoo[bdna]'         : "Seleccione un Banco ADN.",
            'passportZoo[remarks]'      : "Anotaciones es un campo requerido.",
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnPassportZoo').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE PASAPORTE ZOO **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE PASAPORTE MICRO **********************/
$(document).on('click', "#btnPassportMicro", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("geolocalizacion", function (value, element) {
        return this.optional(element) || /^-?[0-9]\d{0,4}(\.\d{0,5})?$/i.test(value);
    }, "El campo es numérico y solo debe tener max. 5 decimales.");

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango debe estar entre -100 a 100.");

    jQuery.validator.addMethod("validar_passport", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassport",
        //     type: 'POST',
        //     data: { valor: 3 },
        //     dataType: 'json',
        //     success: function (response) {
        //         if(response)
        //             $("#passport-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passport-validation").val();
                var lista  = inputs.split(',');
                var mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    jQuery.validator.addMethod("validar_passportmicro", function( value, element, options ) {

        // $.ajax({
        //     url: CK.base_url + "ajax/validapassportmicro",
        //     type: 'POST',
        //     data: { valor: 3 },
        //     dataType: 'json',
        //     success: function (response) {
        //         if(response)
        //             $("#passmicro-validation").val(response.validation);
        //     },
        //     error: function (err) {
        //         console.log("show_error_: ", err.responseText);
        //     }
        // });

        var er = new RegExp(/\s/);

        if(er.test(value)){

            if($.trim(value) == '')
                return false;
            else
                return true;

        } else {

            if(value == ''){

                var inputs = $("#passmicro-validation").val();
                var lista  = inputs.split(',');
                var mensaje = true;

                for(var i=0; i < lista.length; i++){
                    if(lista[i] == options.valor){
                        mensaje = false;
                    }
                }

                return mensaje;

            } else {

                return true;
            }
        }

    }, "El campo es requerido.");

    $("#form_passportmicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            'passportMicro[subtype]': {
                validar_passportmicro : { valor : 'subtype' },
            },
            'passportMicro[collnumb]': {
                validar_passportmicro : { valor : 'collnumb' },
            },
            'passportMicro[spauthor]': {
                validar_passportmicro : { valor : 'spauthor' },
            },
            'passportMicro[subtaxa]': {
                validar_passportmicro : { valor : 'subtaxa' },
            },
            'passportMicro[subtauthor]': {
                validar_passportmicro : { valor : 'subtauthor' },
            },
            'passportMicro[strain]': {
                validar_passportmicro : { valor : 'strain' },
            },
            'passportMicro[storage]': {
                validar_passportmicro : { valor : 'storage' },
            },
            'fecha_aquisicion': {
                validar_passportmicro : { valor : 'acqdate' },
            },
            'passportMicro[eea]': {
                validar_passport : { valor : 'station_current_id' },
            },
            'passportMicro[eeaproc]': {
                validar_passport : { valor : 'station_origin_id' },
            },
            'passport[promissory]': {
                validar_passport : { valor : 'promissory' },
            },
            'passportMicro[availability]': {
                validar_passportmicro : { valor : 'availability' },
            },
            'passportMicro[collsite]': {
                validar_passportmicro : { valor : 'collsite' },
            },
            'passportMicro[elevation]': {
                validar_passportmicro : { valor : 'elevation' },
                number: true,
                geolocalizacion: true,
            },
            'passportMicro[coorddatum]': {
                validar_passportmicro : { valor : 'coorddatum' },
            },
            'passportMicro[georefmeth]': {
                validar_passportmicro : { valor : 'georefmeth' },
            },
            'passportMicro[coorduncert]': {
                validar_passportmicro : { valor : 'coorduncert' },
            },
            'passportMicro[remarks1]': {
                validar_passportmicro : { valor : 'remarks1' },
            },
            'passportMicro[remarks2]': {
                validar_passportmicro : { valor : 'remarks2' },
            },
            'passportMicro[remarks3]': {
                validar_passportmicro : { valor : 'remarks3' },
            },
            'passportMicro[remarks4]': {
                validar_passportmicro : { valor : 'remarks4' },
            },
            'passportMicro[collcode]': {
                validar_passportmicro : { valor : 'collcode' },
            },
            'passportMicro[collname]': {
                validar_passportmicro : { valor : 'collname' },
            },
            'passportMicro[collinstaddress]': {
                validar_passportmicro : { valor : 'collinstaddress' },
            },
            'passportMicro[collmissind]': {
                validar_passportmicro : { valor : 'collmissind' },
            },
            'passportMicro[collsrc]': {
                validar_passportmicro : { valor : 'collsrc' },
            },
            'passportMicro[collsrcdet]': {
                validar_passportmicro : { valor : 'collsrcdet' },
            },
            'passportMicro[isosrc]': {
                validar_passportmicro : { valor : 'isosrc' },
            },
            'passportMicro[sampstat]': {
                validar_passportmicro : { valor : 'sampstat' },
            },
            'fecha_recoleccion': {
                validar_passportmicro : { valor : 'colldate' },
            },
            'passportMicro[localname]': {
                validar_passportmicro : { valor : 'localname' },
            },
            'passportMicro[groupethnic]': {
                validar_passportmicro : { valor : 'groupethnic' },
            },
            'passportMicro[samptype]': {
                validar_passportmicro : { valor : 'samptype' },
            },
            'passportMicro[sampsize]': {
                validar_passportmicro : { valor : 'sampsize' },
                naturals: true,
            },
            'passportMicro[sampling]': {
                validar_passportmicro : { valor : 'sampling' },
            },
            'passportMicro[uso]': {
                validar_passportmicro : { valor : 'uso' },
            },
            'passport[instcode]': {
                validar_passport : { valor : 'instcode' },
            },
            'passport[accname]': {
                validar_passport : { valor : 'accname' },
            },
            'passport[othenumb]': {
                validar_passport : { valor : 'othenumb' },
            },
            'passport[specie_id]': {
                validar_passport : { valor : 'specie_id' },
                required: {
                    depends: function(element) {
                        return ($('#coleccion').val() != '');
                    }
                },
            },
            coleccion_micro: {
                validar_passport : { valor : 'specie_id' },
            },
            'passport[localidad]' : {
                validar_passport : { valor : 'localidad' },
            },
            'passport[country_id]': {
                validar_passport : { valor : 'country_id' },
            },
            departamento: {
                required: true,
                min: 1,
            },
            provincia: {
                required: true,
                min: 1,
            },
            distrito: {
                required: true,
                min: 1,
            },
            'passportMicro[latitude]' : {
                validar_passportmicro : { valor : 'latitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportMicro[longitude]' : {
                validar_passportmicro : { valor : 'longitude' },
                number: true,
                geolocalizacion: true,
            },
            'passportMicro[humidity]':{
                range: [-100, 100],
                validar_passportmicro : { valor : 'humidity' },
            },
            'passportMicro[temp]':{
                range: [-100, 100],
                validar_passportmicro : { valor : 'temp' },
            },
            'passportMicro[presure]':{
                decimals: true,
                validar_passportmicro : { valor : 'presure' },
            },
            'passportMicro[precipitation]':{
                decimals: true,
                validar_passportmicro : { valor : 'precipitation' },
            },
            'passportMicro[soiltext]': {
                validar_passportmicro : { valor : 'soiltext' },
            },
            'passportMicro[soilped]': {
                validar_passportmicro : { valor : 'soilped' },
            },
            'passportMicro[soilcol]': {
                validar_passportmicro : { valor : 'soilcol' },
            },
            'passportMicro[soilph]': {
                validar_passportmicro : { valor : 'soilph' },
            },
            'passportMicro[soilfis]': {
                validar_passportmicro : { valor : 'soilfis' },
            },
            'passportMicro[soilrel]': {
                validar_passportmicro : { valor : 'soilrel' },
            },
            'passportMicro[soiltemp]': {
                validar_passportmicro : { valor : 'soiltemp' },
            },
            'passportMicro[soilodor]': {
                validar_passportmicro : { valor : 'soilodor' },
            },
            'passportMicro[watersrc]': {
                validar_passportmicro : { valor : 'watersrc' },
            },
            'passportMicro[watercol]': {
                validar_passportmicro : { valor : 'watercol' },
            },
            'passportMicro[watertemp]': {
                validar_passportmicro : { valor : 'watertemp' },
            },
            'passportMicro[waterodor]': {
                validar_passportmicro : { valor : 'waterodor' },
            },
            'passportMicro[waterph]': {
                validar_passportmicro : { valor : 'waterph' },
            },
            'passportMicro[waterturb]': {
                validar_passportmicro : { valor : 'waterturb' },
            },
            'passportMicro[donorcore]': {
                validar_passportmicro : { valor : 'donorcore' },
            },
            'passportMicro[donorname]': {
                validar_passportmicro : { valor : 'donorname' },
            },
            'passportMicro[donaddress]': {
                validar_passportmicro : { valor : 'donaddress' },
            },
            'passportMicro[donornumb]': {
                validar_passportmicro : { valor : 'donornumb' },
            },
            'passportMicro[asocgenus]': {
                validar_passportmicro : { valor : 'asocgenus' },
            },
            'passportMicro[asocspecies]': {
                validar_passportmicro : { valor : 'asocspecies' },
            },
            'passportMicro[asoclocalname]': {
                validar_passportmicro : { valor : 'asoclocalname' },
            },
            'passportMicro[mancest]': {
                validar_passportmicro : { valor : 'mancest' },
            },
            'passportMicro[pancest]': {
                validar_passportmicro : { valor : 'pancest' },
            },
            'passportMicro[ancest]': {
                validar_passportmicro : { valor : 'ancest' },
            },
            'passportMicro[mlsstat]': {
                validar_passportmicro : { valor : 'mlsstat' },
            },
            'passportMicro[patent]': {
                validar_passportmicro : { valor : 'patent' },
            },
            'passportMicro[straincode]': {
                validar_passportmicro : { valor : 'straincode' },
            },
            'passportMicro[strainname]': {
                validar_passportmicro : { valor : 'strainname' },
            },
            'passportMicro[duplinstname]': {
                validar_passportmicro : { valor : 'duplinstname' },
            },
            'passportMicro[duplsite]': {
                validar_passportmicro : { valor : 'duplsite' },
            },
            'passportMicro[antag]': {
                validar_passportmicro : { valor : 'antag' },
            },
            'passportMicro[biolrisk]': {
                validar_passportmicro : { valor : 'biolrisk' },
            },
            'passportMicro[samphist]': {
                validar_passportmicro : { valor : 'samphist' },
            },
            'passportMicro[asilmed]': {
                validar_passportmicro : { valor : 'asilmed' },
            },
            'passportMicro[micro]': {
                validar_passportmicro : { valor : 'micro' },
            },
            'passportMicro[bdna]': {
                validar_passportmicro : { valor : 'bdna' },
            },
            'passportMicro[remarks]': {
                validar_passportmicro : { valor : 'remarks' },
            },
        },
        messages: {
            'passport[instcode]'         : "COD. FAO es un campo requerido.",
            'passport[accname]'          : "Nombre de la Accesión es un campo requerido.",
            'passport[othenumb]'         : "Código Accesión es un campo requerido.",
            'passport[specie_id]'        : "Seleccione un Nombre Científico.",
            'coleccion_micro'            : "Seleccione un Colección.",
            'passport[country_id]'       : "Seleccione un País.",
            'departamento'               : "Seleccione un Departamento.",
            'provincia'                  : "Seleccione una Provincia.",
            'distrito'                   : "Seleccione un Distrito.",
            'passport[localidad]'        : "Localidad es un campo requerido.",
            'fecha_aquisicion'           : "Fecha Adquisición es un campo requerido.",
            'fecha_recoleccion'          : "Fecha Recolección es un campo requerido.",
            'passportMicro[subtype]'     : "SubTipo de Recurso es un campo requerido.",
            'passportMicro[collnumb]'    : "Código de Colecta es un campo requerido.",
            'passportMicro[spauthor]'    : "Autoría de la Especie es un campo requerido.",
            'passportMicro[subtaxa]'     : "Subtaxones es un campo requerido.",
            'passportMicro[subtauthor]'  : "Autoría de los Subtaxones es un campo requerido.",
            'passportMicro[strain]'      : "Campo es un campo requerido.",
            'passportMicro[storage]'     : "Tipo Conservación es un campo requerido.",
            'passportMicro[eea]'         : "Estación Experimental es un campo requerido.",
            'passportMicro[eeaproc]'     : "Estación Experimental de Procedencia es un campo requerido.",
            'passportMicro[availability]': "Disponibilidad es un campo requerido.",
            'passportMicro[collsite]'    : "Ubicación del Sitio es un campo requerido.",
            'passportMicro[latitude]'    : {
                number: "Solo se permiten números.",
                required: "Latitud es un campo requerido",
            },
            'passportMicro[longitude]' : {
                number: "Solo se permiten números.",
                required: "Longitud es un campo requerido",
            },
            'passportMicro[elevation]' : {
                required: "Elevación es un campo requerido.",
                number: "Solo se permiten números.",
            },
            'passportMicro[coorddatum]' : "Tipo de Coordenadas es un campo requerido.",
            'passportMicro[georefmeth]' : "Método de Georeferenciación es un campo requerido.",
            'passportMicro[coorduncert]' : "Incertidumbre de Coordenadas es un campo requerido.",
            'passportMicro[remarks1]' : "Descripción Imagen 1 es un campo requerido.",
            'passportMicro[remarks2]' : "Descripción Imagen 2 es un campo requerido.",
            'passportMicro[remarks3]' : "Descripción Imagen 3 es un campo requerido.",
            'passportMicro[remarks4]' : "Descripción Imagen 4 es un campo requerido.",
            'passportMicro[collcode]' : "Código del Instituto de Colecta es un campo requerido.",
            'passportMicro[collname]' : "Nombre del Colector es un campo requerido.",
            'passportMicro[collinstaddress]' : "Dirección del Colector es un campo requerido.",
            'passportMicro[collmissind]' : "Misión de Colecta es un campo requerido.",
            'passportMicro[collsrc]' : "Fuente es un campo requerido.",
            'passportMicro[collsrcdet]' : "uente Detalle es un campo requerido.",
            'passportMicro[isosrc]' : "Fuente de Aislamiento es un campo requerido.",
            'passportMicro[sampstat]' : "Condición Biológica es un campo requerido.",
            'passportMicro[localname]' : "ombre Local del Material es un campo requerido.",
            'passportMicro[groupethnic]' : "Grupo Etnico es un campo requerido.",
            'passportMicro[samptype]' : "Tipo de Muestra es un campo requerido.",
            'passportMicro[sampsize]' : {
                required: "Nro. de Individuos Muestreados es un campo requerido.",
            },
            'passportMicro[sampling]' : "Tipo de Muestreo es un campo requerido.",
            'passportMicro[uso]'              : "Uso de microorganismo es un campo requerido.",
            'passportMicro[humidity]' : {
                required: "Humedad Ambiente es un campo requerido.",
                number: "Solo se permiten números.",
            },
            'passportMicro[temp]' : {
                required: "Temperatura Ambiente es un campo requerido.",
            },
            'passportMicro[presure]' : {
                required: "Presión Atmosférica es un campo requerido.",
            },
            'passportMicro[precipitation]' : {
                required: "Precipitación es un campo requerido.",
            },
            'passportMicro[soiltext]' : "Textura del Suelo es un campo requerido.",
            'passportMicro[soilped]' : "Pedregocidad del suelo es un campo requerido.",
            'passportMicro[soilcol]' : "Color del suelo es un campo requerido.",
            'passportMicro[soilph]' : "PH del suelo es un campo requerido.",
            'passportMicro[soilfis]' : "Fisiografía es un campo requerido.",
            'passportMicro[soilrel]' : "Relieve del Suelo es un campo requerido.",
            'passportMicro[soiltemp]' : "Temperatura del Suelo es un campo requerido.",
            'passportMicro[soilodor]' : "Olor del Suelo es un campo requerido.",
            'passportMicro[watersrc]' : "Fuente de Agua es un campo requerido.",
            'passportMicro[watercol]' : "Color del Agua es un campo requerido.",
            'passportMicro[watertemp]' : "Temperatura del Agua es un campo requerido.",
            'passportMicro[waterodor]' : "Olor del Agua es un campo requerido.",
            'passportMicro[waterph]' : "PH del Agua es un campo requerido.",
            'passportMicro[waterturb]' : "Turbidez es un campo requerido.",
            'passportMicro[donorcore]' : "Código del Donante es un campo requerido.",
            'passportMicro[donorname]' : "Nombre del Donante es un campo requerido.",
            'passportMicro[donaddress]' : "Dirección del Donante es un campo requerido.",
            'passportMicro[donornumb]' : "Código de Accesión del Donante es un campo requerido.",
            'passportMicro[asocgenus]' : "Género Especie Asociada es un campo requerido.",
            'passportMicro[asocspecies]' : "Especie Asociada es un campo requerido.",
            'passportMicro[asoclocalname]' : "Nombre Local - Especie Asociada es un campo requerido.",
            'passportMicro[mancest]' : "Ancestro Materno es un campo requerido.",
            'passportMicro[pancest]' : "Ancestro Paterno es un campo requerido.",
            'passportMicro[ancest]' : "Datos Ancestrales es un campo requerido.",
            'passportMicro[mlsstat]' : "Sistema Multilateral es un campo requerido.",
            'passportMicro[patent]' : "Patente es un campo requerido.",
            'passportMicro[straincode]' : "Código del Instituto es un campo requerido.",
            'passportMicro[strainname]' : "Nombre del Instituto es un campo requerido.",
            'passportMicro[duplinstname]' : "Nomb. lugar - Duplicados de Seguridad es un campo requerido.",
            'passportMicro[duplsite]' : "Ubicación - Duplicados de Seguridad es un campo requerido.",
            'passportMicro[antag]' : "Antagonistas es un campo requerido.",
            'passportMicro[biolrisk]' : "Riesgo Biológico es un campo requerido.",
            'passportMicro[samphist]' : "Historia de la Accesión es un campo requerido.",
            'passportMicro[asilmed]' : "Medio de Aislamiento es un campo requerido.",
            'passportMicro[micro]' : "Seleccione un Banco Micro.",
            'passportMicro[bdna]' : "Seleccione un Banco ADN.",
            'passportMicro[remarks]' : "Anotaciones es un campo requerido.",
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnPassportMicro').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE PASAPORTE MICRO **********************/

/****************** INICIO DE VALIDACION DE CARGA DE CARACTERIZACION **********************/
$(document).on('click', "#btnImportPassport", function () {
    $("#form_import_passport").validate({

        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,
                min: 1,
            },
            'passport[specie_id]': {
                required: true,
                min: 1,
            },
            file_carga: {
                required: true,
            },
        },
        messages: {
            coleccion_id: "Colección es un campo requerido.",
            'passport[specie_id]': "Especie es un campo requerido.",
            file_carga: "Debe seleccionar un archivo.",
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnImportPassport').attr("disabled", true);
            $("#carga").css("display","block");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});

    //********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
    $(document).on('click', "#btnCargarPassport", function () {
        $("#form_cargar_passport").validate({
            ignore : [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
            },
            messages: {
            },
            submitHandler: function (form) {
                $('#btnCargarPassport').attr("disabled", true);
                $("#carga").css("display","block");
                $("#carga_passport").css("display","block");
                form.submit();
            },
        });
    });
    /****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

/****************** INICIO DE VALIDACION DE GENOTIPICA **********************/
$(document).on('click', "#btnCaractGenotypic", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_caractGenotypic").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            'CaractGenotypic[expnumb]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[colname]': {
                required: true,
                min: 1,
            },
            'CaractGenotypic[project]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[molmarker]': {
                required: true,
                min: 1,
            },
            'CaractGenotypic[restenzymuse]': {
                required: true,
                min: 1,
            },
            'CaractGenotypic[restenzymname]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[projcode]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[ciclonumb]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[accnumb]': {
                required: true,
                minlength: 1,
                maxlength: 10,
            },
            'CaractGenotypic[othername]': {
                required: true,
                minlength: 1,
                maxlength: 10,
            },
            'CaractGenotypic[seqsize]': {
                naturals: true,
                required: true,
                number  : true,
                min     : 1,
            },
            'CaractGenotypic[seqtech]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[fragsizemeth]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[repnumb]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[location]': {
                required: true,
                min: 1,
            },
            'CaractGenotypic[respname]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[markerdescrip]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[platform]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            'CaractGenotypic[remarks]': {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
        },
        messages: {
            'CaractGenotypic[expnumb]'      : "Nro. de Experimento es un campo requerido.",
            'CaractGenotypic[colname]'      : "Seleccione una colección.",
            'CaractGenotypic[project]'      : "Nombre del Proyecto es un campo requerido..",
            'CaractGenotypic[molmarker]'    : "Seleccione un Marcador Molecular.",
            'CaractGenotypic[restenzymuse]' : "Seleccione un Uso Enzima de Restricción.",
            'CaractGenotypic[restenzymname]': "Nombre Enzima de Restricción es un campo requerido.",
            'CaractGenotypic[projcode]'     : "Código del Proyecto es un campo requerido.",
            'CaractGenotypic[ciclonumb]'    : "Número de Ciclos es un campo requerido.",
            'CaractGenotypic[accnumb]'      : {
                required  : "Número de Accesión es un campo requerido.",
                maxlength : "Ingrese como máximo un numero de 10 dígitos",
            },
            'CaractGenotypic[othername]'    : {
                required  : "Otro número de Accesión es un campo requerido.",
                maxlength : "Ingrese como máximo un numero de 10 dígitos",
            },
            'CaractGenotypic[seqsize]'      : {
                required : "Tamaño de secuencia es un campo requerido.",
                number   : "Ingrese solo números.",
                min      : "Tamaño de secuencia debe ser mayor a cero.",
            },
            'CaractGenotypic[seqtech]'      : "Tecnología de Secuenciamiento es un campo requerido.",
            'CaractGenotypic[fragsizemeth]' : "Método de Determinación es un campo requerido.",
            'CaractGenotypic[repnumb]'      : "Nro. de Repeticiones es un campo requerido.",
            'CaractGenotypic[location]'     : "Seleccione una Localización.",
            'CaractGenotypic[respname]'     : "Nombre de Responsable es un campo requerido.",
            'CaractGenotypic[markerdescrip]': "Descripción de Marcadores es un campo requerido.",
            'CaractGenotypic[platform]'     : "Plataforma de Corrida es un campo requerido.",
            'CaractGenotypic[remarks]'      : "Anotaciones es un campo requerido.",
        // 'CaractGenotypic[accenumb]'     : "Seleccione un archivo.",
        // 'CaractGenotypic[datamatrix]'   : "Seleccione un archivo.",
        },
        submitHandler: function (form) {
            // return false;
            console.log("enviando_data_form_:");
            $('#btnCaractGenotypic').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});
/****************** FIN DE VALIDACION DE GENOTIPICA **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE FENOTIPICA BUSCAR **********************/
$(document).on('click', "#btnFenotipica", function () {
    $("#form_fenotipica").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,

            },
            nombre_comun: {
                required: true,

            },
        },
        messages: {
            coleccion_id: "Colección es un campo requerido.",
            nombre_comun: "Nombre Común es un campo requerido.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnFenotipica').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE FENOTIPICA BUSCAR **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE FENOTIPICA DESCARGA DE FORMATO **********************/
$(document).on('click', "#btnFormatoCaracterizacion", function () {
    $("#form_formato_caracterizacion").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,
                min: 1,
            },
            especie_id: {
                required: true,
                min: 1,
            },
        },
        messages: {
            coleccion_id: "Colección es un campo requerido.",
            especie_id: "Especie es un campo requerido.",
        },
        submitHandler: function (form) {
            // return false;
            console.log("enviando_data_form_:");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE FENOTIPICA DESCARGA DE FORMATO **********************/

/****************** INICIO DE VALIDACION DE CARGA DE CARACTERIZACION **********************/
$(document).on('click', "#btnSubirCaracterizacion", function () {
    $("#form_caracterizacion").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,
                min: 1,
            },
            especie_id: {
                required: true,
                min: 1,
            },
            file_caracterizacion: {
                required: true,
            },
        },
        messages: {
            coleccion_id: "Colección es un campo requerido.",
            especie_id: "Especie es un campo requerido.",
            file_caracterizacion: "Debe seleccionar un archivo.",
        },
        submitHandler: function (form) {
            form.submit();
            $("#carga").css("display","block");
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});

    //********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
    $(document).on('click', "#btnCargarCaracterizacion", function () {
        $("#form_cargar_caract").validate({
            ignore : [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
            },
            messages: {
            },
            submitHandler: function (form) {
                $('#btnCargarCaracterizacion').attr("disabled", true);
                $("#carga").css("display","block");
                $("#carga_caract").css("display","block");
                form.submit();
            },
        });
    });

/****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE DESCRIPTORES **********************/
$(document).on('click', "#btnDescriptor", function () {

    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZñÑ]+$/i.test(value);
    }, "Solo se admiten letras y sin espacios.");

    $("#form_descriptor").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            name: {
                required: true,
                minlength: 1,
                maxlength: 20,
                lettersonly: true,
                remote: {
                    url: CK.base_url + "ajax/verificadescriptor",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        name: function () {
                            if ($("input[name=name_hidden]").length) {
                                if ($("input[name=name]").val() !== $("input[name=name_hidden]").val()) {
                                    return ($("input[name=name]").val());
                                }
                            } else {
                                return ($("input[name=name]").val());
                            }
                        },
                        resource_id: function () {
                            return ($("input[name=resource]").val());
                        },
                        especie_id: function () {
                            return ($("input[name=especie]").val());
                        },
                    },
                }
            },
            title: {
                required: true,
                minlength: 1,
                maxlength: 100,
            },
            value_type: {
                required: true,
                min: 1,
            },
            flg_catalogue: {
                required: true,
                min: 1,
            },
            description: {
                required: false,
                minlength: 1,
                maxlength: 500,
            },
        },
        messages: {
            name: {
                required: "Descriptor es un campo requerido.",
                maxlength: "Sólo se admiten máximo 20 caracteres.",
                remote: jQuery.validator.format("Nombre de descriptor ya existe."),
            },
            title: "Título es un campo requerido.",
            value_type: "Debe seleccionar un Tipo.",
            flg_catalogue: "Debe seleccionar un catálogo",
            description: "Descripción es un campo requerido.",
        },
        submitHandler: function (form) {
            // return false;
            console.log("enviando_data_form_:");
            $('#btnDescriptor').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE DESCRIPTORES **********************/

/****************** INICIO DE VALIDACION DE MANTENIMIENTO DE DESCRIPTOR ESTADOS **********************/
$(document).on('click', "#btnDescriptorState", function () {
    $("#form_descriptorstate").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            label: {
                required: true,
                minlength: 1,
                maxlength: 100,
                remote: {
                    url: CK.base_url + "ajax/verificadescriptorstate",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        label: function () {
                            if ($("input[name=label_hidden]").length) {
                                if ($("input[name=label]").val() !== $("input[name=label_hidden]").val()) {
                                    return ($("input[name=label]").val());
                                }
                            } else {
                                return ($("input[name=label]").val());
                            }
                        },
                        descriptor: function () {
                            return ($("input[name=descriptor]").val());
                        },
                    }
                }
            },
            code: {
                required: true,
                number: true,
                remote: {
                    url: CK.base_url + "ajax/verificadescriptorcode",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        code: function () {
                            if ($("input[name=code_hidden]").length) {
                                if ($("input[name=code]").val() !== $("input[name=code_hidden]").val()) {
                                    return ($("input[name=code]").val());
                                }
                            } else {
                                return ($("input[name=code]").val());
                            }
                        },
                        descriptor: function () {
                            return ($("input[name=descriptor]").val());
                        },
                    }
                }
            },
        },
        messages: {
            label: {
                required: "Nombre de Estado es un campo requerido.",
                remote: jQuery.validator.format("Nombre de Estado ya existe."),
            },
            code: {
                required: "Estado es un campo requerido.",
                remote: jQuery.validator.format("Estado ya existe para el descriptor."),
            },
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        $('#btnDescriptorState').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE MANTENIMIENTO DE DESCRIPTOR ESTADOS **********************/

/****************** INICIO DE VALIDACION DE CARGA DE DESCRIPTORES SUBIR ARCHIVO **********************/
$(document).on('click', "#btnCargaDescriptor", function () {

    $("#form_import_descriptor").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,
                min: 1,
            },
            'passport[specie_id]': {
                required: true,
                min: 1,
            },
                // tipo_agrupacion: {
                //     required: true,
                //     min: 1,
                // },
                file_carga: {
                    required: true,
                },
                form_tipo: {
                    required: true,
                },
            },
            messages: {
                coleccion_id: "Colección es un campo requerido.",
                'passport[specie_id]': "Especie es un campo requerido.",
                // tipo_agrupacion: "Tipo de Agrupación es un campo requerido.",
                file_carga: "Debe seleccionar un archivo.",
            },
            submitHandler: function (form) {
                // return false;
                $("#carga_descriptor").css("display","block");
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();
    file_change();
});
/****************** FIN DE VALIDACION DE CARGA DE DESCRIPTORES SUBIR ARCHIVO **********************/

//********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
$(document).on('click', "#btnCargaDescripFinal", function () {
    $("#form_cargar_fenotipica").validate({
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $('#btnCargaDescripFinal').attr("disabled", true);
            $("#carga_descriptor").css("display","block");
            $("#carga_descrip_final").css("display","block");
            form.submit();
        },
    });
});
/****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

//********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
$(document).on('click', "#btnCargaBioFinal", function () {
    $("#form_cargar_Bioquimica").validate({
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $('#btnCargaBioFinal').attr("disabled", true);
            $("#carga_descriptor").css("display","block");
            $("#carga_descrip_final").css("display","block");
            form.submit();
        },
    });
});
/****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

/****************** INICIO DE VALIDACION DE CARGA DE ESTADOS SUBIR ARCHIVO **********************/
$(document).on('click', "#btnCargaEstados", function () {
    $("#form_import_estados").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion_id: {
                required: true,
                min: 1,
            },
            especie_id: {
                required: true,
                min: 1,
            },
            file_estado: {
                required: true,
            },
            form_tipo: {
                required: true,
            },
        },
        messages: {
            coleccion_id: "Colección es un campo requerido.",
            especie_id: "Especie es un campo requerido.",
            file_estado: "Debe seleccionar un archivo.",
        },
        submitHandler: function (form) {
            // return false;
            $("#carga_state").css("display","block");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});
/****************** FIN DE VALIDACION DE CARGA DE ESTADOS SUBIR ARCHIVO **********************/

//********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
$(document).on('click', "#btnCargaStateFinal", function () {
    $("#form_cargar_fenotipica").validate({
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $('#btnCargaStateFinal').attr("disabled", true);
            $("#carga_state").css("display","block");
            $("#carga_state_final").css("display","block");
            form.submit();
        },
    });
});
/****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

//********************** EFECTO AL CARGAR LOS PASAPORTES **********************//
$(document).on('click', "#btnCargaStateBioFinal", function () {
    $("#form_cargar_Bioquimica").validate({
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
        },
        messages: {
        },
        submitHandler: function (form) {
            $('#btnCargaStateBioFinal').attr("disabled", true);
            $("#carga_state").css("display","block");
            $("#carga_state_final").css("display","block");
            form.submit();
        },
    });
});
/****************** FIN DE VALIDACION DE CARGA DE CARACTERIZACION **********************/

/****************** INICIO DE VALIDACION DE FISICOQUIMICA **********************/
    // AGREGAR
    $(document).on('click', "#btnFisicoQuimica", function () {
        $("#form_fisicoquimica").validate({
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                expnumb: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                colname: {
                    required: true,
                    min: 1,
                },
                respname: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                project: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                projcode: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                remarks: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                file_1: {
                    required: true,
                },
                file_2: {
                    required: true,
                },
                file_3: {
                    required: true,
                },
            },
            messages: {
                expnumb : {
                    required: "Nro. Experimento es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                colname : "Seleccione una colección.",
                respname: {
                    required: "Nombre de Responsable es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                project : {
                    required: "Nombre del Proyecto es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                projcode: {
                    required: "Código del Proyecto es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                remarks : {
                    required: "Anotaciones es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                file_1  : "Variables evaluadas es un campo requerido.",
                file_2  : "Accesiones es un campo requerido.",
                file_3  : "Matriz de Datos es un campo requerido.",
            },
            submitHandler: function (form) {
                // return false;
                console.log("enviando_data_form_:");
                $('#btnFisicoQuimica').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
        file_change();
    });

    // EDITAR
    $(document).on('click', "#btnEditFisicoQuimica", function () {
        $("#form_edit_fisicoquimica").validate({
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                expnumb: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                colname: {
                    required: true,
                    min: 1,
                },
                respname: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                project: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                projcode: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                remarks: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
            },
            messages: {
                expnumb : {
                    required: "Nro. Experimento es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                colname : "Seleccione una colección.",
                respname: {
                    required: "Nombre de Responsable es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                project : {
                    required: "Nombre del Proyecto es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                projcode: {
                    required: "Código del Proyecto es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
                remarks : {
                    required: "Anotaciones es un campo requerido.",
                    maxlength: "Sólo se admiten máximo 100 caracteres.",
                },
            },
            submitHandler: function (form) {
                // return false;
                console.log("enviando_data_form_:");
                $('#btnEditFisicoQuimica').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
        file_change();
    });
/****************** FIN DE VALIDACION DE FISICOQUIMICA **********************/

/****************** INICIO DE VALIDACION DE INSITU **********************/
$(document).on('click', "#btnInsitu", function () {

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "La Edad debe estar entre 0 a 100.");

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("geolocalizacion", function (value, element) {
            return this.optional(element) || /^-?[0-9]\d{0,4}(\.\d{0,5})?$/i.test(value);
        }, "El campo es numérico y solo debe tener max. 5 decimales.");

    $("#form_insitu").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },

        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            degree_instruction: {
                required: false,
            },
            type_soil: {
                required: false,
            },
            reference: {
                required: false,
                minlength: 2,
                maxlength: 100,
            },
            latitude: {
                required: true,
                geolocalizacion: true,
            },
            length: {
                required: true,
                geolocalizacion: true,
            },
            altitude: {
                required: true,
                geolocalizacion: true,
                maxlength: 20,
            },
            name_farmer: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            address_farmer: {
                required: false,
                minlength: 2,
                maxlength: 100,
            },
            age_farmer: {
                required: false,
                number: true,
                maxlength: 2,
                min: 18,
                max: 100,
            },
            // peasant_organization: {
            //     required: true,
            // },
            name_peasant_organization: {
                required: {
                    depends: function (element) {
                        if ($('#peasant-organization').val() == '1') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },
            biophysical_description: {
                required: false,
                minlength: 2,
                maxlength: 200,
            },
            description_chakra: {
                required: false,
                minlength: 2,
                maxlength: 200,
            },
            area: {
                required: false,
                decimals: true,
                number: true,
            },
            living_area: {
                required: false,
                minlength: 2,
                maxlength: 100,
            },
            meteorological_record: {
                required: false,
                minlength: 2,
                maxlength: 100,
            },
            observation: {
                required: false,
                minlength: 2,
                maxlength: 200,
            },
            description_workers: {
                required: false,
                minlength: 2,
                maxlength: 200,
            },
            monitoring: {
                required: false,
            },
            ministerial_resolution: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            variety_number: {
                required: false,
                /*minlength: 2,
                maxlength: 9,
                maxlength: 100,*/
            },
            // other_people: {
            //     required: true,
            //     minlength: 2,
            //     maxlength: 100,
            // },
            departamento: {
                required: true,
                min: 1,
            },
            provincia: {
                required: true,
                min: 1,
            },
            distrito: {
                required: true,
                min: 1,
            },
        },
        messages: {
            degree_instruction: {
                required: "Seleccione un Grado de Instrucción.",
            },
            type_soil: {
                required: "Seleccione un Tipo de Suelo.",
            },
            reference: {
                required: "Referencia es un campo requerido.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            latitude: {
                required: "Latitud es un campo requerido.",
            },
            length: {
                required: "Longitud es un campo requerido.",
            },
            altitude: {
                required: "Elevación es un campo requerido.",
                maxlength: "Ingrese como máximo un numero de 20 dígitos.",
            },
            name_farmer: {
                required: "Nombre de Agricultora es un campo requerido.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            address_farmer: {
                required: "Dirección de Agricultor es un campo requerido.",
            },
            age_farmer: {
                required: "Edad es un campo requerido.",
                maxlength: "La edad como máximo puede tener 2 dígitos.",
                number   : "Ingrese solo números.",
                min: "La edad mínima es de 18 años.",
                max: "La edad máxima es de 100 años.",
            },
            // peasant_organization: {
            //     required: "El campo es un campo requerido.",
            // },
            name_peasant_organization: {
                required: "Nombre de la Organización es un campo requerido.",
            },
            biophysical_description: {
                required: "Descripción Biofísica es un campo requerido.",
                maxlength: "Sólo se admiten máximo 200 caracteres.",
            },
            description_chakra: {
                required: "Descripción de chacra es un campo requerido.",
                maxlength: "Sólo se admiten máximo 200 caracteres.",
            },
            area: {
                required: "Área es un campo requerido.",
                number   : "Ingrese solo números.",
            },
            living_area: {
                required: "Zona de vida es un campo requerido.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            meteorological_record: {
                required: "Registro Meteorológico es un campo requerido.",
                maxlength: "Ingrese como máximo un numero de 100 caracteres.",
            },
            observation: {
                required: "Observación es un campo requerido.",
                maxlength: "Sólo se admiten máximo 200 caracteres.",
            },
            description_workers: {
                required: "Descripción de trabajadores es un campo requerido.",
                maxlength: "Sólo se admiten máximo 200 caracteres.",
            },
            monitoring: {
                required: "Monitoreo es un campo requerido.",
            },
            ministerial_resolution: {
                required: "Resolución Ministerial es un campo requerido.",
            },
            variety_number: {
                required: "Nro. Variedades es un campo requerido.",
                maxlength : "Ingrese como máximo un numero de 9 dígitos",
                number   : "Ingrese solo números.",
            },
            // other_people: {
            //     required: "El campo es un campo requerido.",
            // },
            departamento: {
                required: "Seleccione un departamento.",
                min: "Seleccione un departamento.",
            },
            provincia: {
                required: "Seleccione una provincia.",
                min: "Seleccione una provincia.",
            },
            distrito: {
                required: "Seleccione un distrito.",
                min: "Seleccione un distrito.",
            },
        },
        submitHandler: function (form) {
            // return false;
            console.log("enviando_data_form_:");
            $('#btnInsitu').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE INSITU *************************/

/****************** INICIO DE VALIDACION DE INSITU PRACTICA AGRICOLAS**********************/
$(document).on('click', "#btnInsituFarmerActivity", function () {
    $("#form_insitu_farmer_activity").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            purpose: {
                required: true,
                    // minlength: 2,
                    // maxlength: 100,
                },
                comunities: {
                    required: true,
                    // minlength: 2,
                    // maxlength: 100,
                },
                common_name: {
                    required: true,
                    // minlength: 2,
                    // maxlength: 100,
                },
                description: {
                    required: true,
                    // minlength: 2,
                    // maxlength: 100,
                },
                input_tools: {
                    required: true,
                },
                origin: {
                    required: true,
                },
                practice_know: {
                    required: true,
                },
                technical_category: {
                    required: true,
                },
            },
            messages: {
                purpose : {
                    required: "Finalidad es un campo requerido.",
                },
                comunities : {
                    required: "Comunidades es un campo requerido.",
                },
                common_name : {
                    required: "Nombre Común es un campo requerido.",
                    // minlength: "Ingrese como mínimo 2 caracteres.",
                },
                description : {
                    required: "Descripción es un campo requerido.",
                },
                input_tools : {
                    required: "Seleccione un Insumo / Herramienta.",
                },
                origin : {
                    required: "Seleccione un Origen.",
                },
                practice_know : {
                    required: "Seleccione una Práctica / Saber.",
                },
                technical_category : {
                    required: "Seleccione una Técnica / Categoría.",
                },
            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnInsituFarmerActivity').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();
});
/****************** FIN DE VALIDACION DE INSITU PRACTICA AGRICOLAS*************************/

/****************** INICIO DE VALIDACION DE INSITU AMENAZAS REPORTADAS **********************/
$(document).on('click', "#btnInsituThreat", function () {
    $("#form_insitu_threat").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            severity: {
                required: true,
            },
            culture: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            damage_impact: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            alternative_handle: {
                required: true,
            },
            threat: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            description: {
                required: true,
            },
        },
        messages: {
            severity: {
                required: "Seleccione una Severidad.",
            },
            culture: {
                required: "Cultivo es un campo requerido.",
                minlength: "Se admite como mínimo 2 caracteres.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            damage_impact: {
                required: "Daño / Impacto es un campo requerido.",
                minlength: "Se admite como mínimo 2 caracteres.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            alternative_handle: {
                required: "Alternativa de Manejo es un campo requerido.",
            },
            threat: {
                required: "Amenaza es un campo requerido.",
                minlength: "Se admite como mínimo 2 caracteres.",
                maxlength: "Sólo se admiten máximo 100 caracteres.",
            },
            description: {
                required: "Descripción es un campo requerido.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnInsituThreat').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE INSITU AMENAZAS REPORTADAS *************************/

/****************** INICIO DE VALIDACION DE INSITU PLAGAS / PATÓGENOS **********************/
$(document).on('click', "#btnInsituPlage", function () {
    $("#form_insitu_plage").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            severity: {
                required: true,
            },
            scientific_name: {
                required: true,
            },
            reported_damage: {
                required: true,
            },
            culture: {
                required: true,
            },
            common_name: {
                required: true,
            },
        },
        messages: {
            severity: {
                required: "Seleccione una Severidad.",
            },
            scientific_name: {
                required: "Nombre Científico es un campo requerido.",
            },
            reported_damage: {
                required: "Daño Reportado es un campo requerido.",
            },
            culture: {
                required: "Cultivo es un campo requerido.",
            },
            common_name: {
                required: "Nombre Común es un campo requerido.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnInsituPlage').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE INSITU AMENAZAS REPORTADAS *************************/

/****************** INICIO DE VALIDACION DE INSITU ACCESIONES **********************/
$(document).on('click', "#btnInsituAccesion", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,9}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    $("#form_insitu_accesion").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            accenumb: {
                required: true,
            },
                        // othenumb: {
                        //     required: true,
                        // },
                        // common_name: {
                        //     required: true,
                        // },
                        manifold: {
                            required: true,
                        },
                        reported_usage: {
                            required: true,
                        },
                        extension: {
                            required: true,
                        },
                        area_cultivation: {
                            required: true,
                        },
                        others: {
                            required: true,
                        },
                        scientific_name: {
                            required: true,
                        },
                        uso: {
                            required: true,
                        },
                        local_name: {
                            required: true,
                        },
                        habitat: {
                            required: true,
                        },
                        reference: {
                            required: true,
                        },
                        area_cultivation: {
                            required: true,
                            decimals: true,
                        },
                    },
                    messages: {
                        accenumb: {
                            required: "Código PER es un campo requerido.",
                        },
                        // othenumb: {
                        //     required: "Código Accesión es un campo requerido.",
                        // },
                        // common_name: {
                        //     required: "Nombre Común es un campo requerido.",
                        // },
                        manifold: {
                            required: "Colector es un campo requerido.",
                        },
                        reported_usage: {
                            required: "Uso Reportado es un campo requerido.",
                        },
                        extension: {
                            required: "Extensión es un campo requerido.",
                        },
                        area_cultivation: {
                            required: "Área Cultivo (m2) es un campo requerido.",
                        },
                        others: {
                            required: "Otros es un campo requerido.",
                        },
                        scientific_name: {
                            required: "Nombre Científico es un campo requerido.",
                        },
                        uso: {
                            required: "Usos es un campo requerido.",
                        },
                        local_name: {
                            required: "Nombre Local es un campo requerido.",
                        },
                        habitat: {
                            required: "Habitat es un campo requerido.",
                        },
                        reference: {
                            required: "Referencias es un campo requerido.",
                        },
                        area_cultivation: {
                            required: "Área Cultivo es un campo requerido.",
                        },
                    },
                    submitHandler: function (form) {
                        console.log("enviando_data_form_:");
                        $('#btnInsituAccesion').attr("disabled", true);
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE INSITU AMENAZAS REPORTADAS *************************/

/****************** INICIO DE VALIDACION DE GESTION DE MAPAS **********************/
$(document).on('click', "#btnGestionMapas", function () {
    $("#form_gestion_mapas").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            coleccion: {
                required: true,
                min: 1,
            },
        },
        messages: {
            coleccion: "Colección es un campo requerido.",
        },
        submitHandler: function (form) {
                        // return false;
                        console.log("enviando_data_form_:");
                        form.submit();
                    },
                    highlight: function (element, errorClass, validClass) {
                        highlight(element, errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        unhighlight(element, errorClass);
                    },
                    errorPlacement: function (error, element) {
                        errorPlacement(error, element);
                    }
                });
    select_change();
});
/****************** FIN DE VALIDACION DE GESTION DE MAPAS **********************/

/****************** INICIO DE VALIDACION DE PUBLICACIONES - AGREGAR**********************/
$(document).on('click', "#btnAddPublication", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_publication").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        ignore: [],
        rules: {
            title: {
                required: true,
                maxlength: 100,
            },
            author: {
                required: true,
                maxlength: 100,
            },
            editorial: {
                required: true,
            },
            languages: {
                required: true,
                maxlength: 50,
            },
            fec_edit: {
                required: true,
            },
            month_edit: {
                required: true,
            },
            edition: {
                required : true,
                maxlength: 10,
                number   : true,
                naturals :true,
                min      : 1,
            },
            country_id: {
                required: true,
            },
            public_place: {
                required: true,
            },
            numpag: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      : 1,
            },
            copy: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      :1,
            },
            public_type: {
                required: true,
            },
            note: {
                required: true,
            },
            summary: {
                required: function(){
                    CKEDITOR.instances.summary.updateElement();
                },
                minlength: 10,
            },
            volume: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      : 1,
            },
            institution: {
                required: true,
                maxlength: 50,
            },
            category: {
                required: true,
                maxlength: 50,
            },
            descriptors: {
                required: true,
                maxlength: 50,
            },
            collection_id: {
                required: true,
            },
            file_1: {
                required: true,
            },
            file_2: {
                required: true,
            },
            file_3: {
                required: true,
            },
            availability: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Título es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            author: {
                required: "Autor es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            editorial: {
                required: "Editorial es un campo requerido.",
            },
            languages: {
                required: "Idioma es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 50 dígitos",
            },
            fec_edit: {
                required: "cmapo es un campo requerido.",
            },
            month_edit: {
                required: "cmapo es un campo requerido.",
            },
            edition: {
                required : "Nro. Edición es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Nro. Edición no puede ser cero.",
            },
            country_id: {
                required: "País es un campo requerido.",
            },
            public_place: {
                required: "Lugar Publicación es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            numpag: {
                required : "Número Páginas es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Número Páginas no puede ser cero.",
            },
            copy: {
                required : "Cantidad de Ejemplares es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Cantidad de Ejemplares no puede ser cero.",
            },
            public_type: {
                required: "Tipo Publicación es un campo requerido.",
            },
            note: {
                required: "Nota es un campo requerido.",
            },
            summary: {
                required: "Resumen es un campo requerido.",
                minlength: "Resumen al menos debe tener 10 caracteres.",
            },
            volume: {
                required : "Nro. de Volumen es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Nro. de Volumen no puede ser cero.",
            },
            institution: {
                required: "Institución es un campo requerido.",
                maxlength: "Ingrese un numero de 50 dígitos.",
            },
            category: {
                required: "Categoría es un campo requerido.",
                maxlength: "Ingrese un numero de 50 dígitos.",
            },
            descriptors: {
                required: "Descriptores es un campo requerido.",
                maxlength: "Ingrese un numero de 50 dígitos.",
            },
            collection_id: {
                required: "Colección es un campo requerido.",
            },
            file_1: {
                required: "Imagen Principal es un campo requerido.",
            },
            file_2: {
                required: "Documento es un campo requerido.",
            },
            file_3: {
                required: "Imagen Secundaria es un campo requerido.",
            },
            availability: {
                required: "Disponibilidad es un campo requerido.",
            },
        },
        submitHandler: function (form) {
            $('#btnAddPublication').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
    file_change();
});
/****************** FIN DE VALIDACION DE PUBLICACIONES **********************/

/****************** INICIO DE VALIDACION DE PUBLICACIONES - EDITAR**********************/
$(document).on('click', "#btnEditPublication", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_publication").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        ignore: "input:hidden:not(input:hidden.required)",
        rules: {
            title: {
                required: true,
                maxlength: 100,
            },
            author: {
                required: true,
                maxlength: 100,
            },
            editorial: {
                required: true,
                maxlength: 100,
            },
            languages: {
                required: true,
                maxlength: 50,
            },
            fec_edit: {
                required: true,
            },
            month_edit: {
                required: true,
            },
            edition: {
                required : true,
                maxlength: 10,
                number   : true,
                naturals :true,
                min      : 1,
            },
            country_id: {
                required: true,
            },
            public_place: {
                required: true,
                maxlength: 100,
            },
            numpag: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      : 1,
            },
            copy: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      : 1,
            },
            public_type: {
                required: true,
            },
            note: {
                required: true,
            },
            summary: {
                required : true,
                minlength: 10,
            },
            volume: {
                required : true,
                naturals : true,
                maxlength: 10,
                number   : true,
                min      : 1,
            },
            institution: {
                required: true,
                maxlength: 50,
            },
            category: {
                required: true,
            },
            descriptors: {
                required: true,
                maxlength: 50,
            },
            availability: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Título es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            author: {
                required: "Autor es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            editorial: {
                required: "Editorial es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            languages: {
                required: "Idioma es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 50 dígitos",
            },
            fec_edit: {
                required: "cmapo es un campo requerido.",
            },
            month_edit: {
                required: "cmapo es un campo requerido.",
            },
            edition: {
                required : "Nro. Edición es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Nro. Edición no puede ser cero.",
            },
            country_id: {
                required: "País es un campo requerido.",
            },
            public_place: {
                required: "Lugar Publicación es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 100 dígitos",
            },
            numpag: {
                required : "Número Páginas es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Número Páginas no puede ser cero.",
            },
            copy: {
                required : "Cantidad de Ejemplares es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Cantidad de Ejemplares no puede ser cero.",
            },
            public_type: {
                required: "Tipo Publicación es un campo requerido.",
            },
            note: {
                required: "Nota es un campo requerido.",
            },
            summary: {
                required: "Resumen es un campo requerido.",
                minlength: "Resumen al menos debe tener 10 dígitos.",
            },
            volume: {
                required : "Nro. de Volumen es un campo requerido.",
                maxlength: "Ingrese un numero de 10 dígitos.",
                number   : "Solo se permiten números.",
                min      : "Nro. de Volumen no puede ser cero.",
            },
            institution: {
                required: "Institución es un campo requerido.",
                maxlength: "Ingrese un numero de 50 dígitos.",
            },
            category: {
                required: "Categoría es un campo requerido.",
            },
            descriptors: {
                required: "Descriptores es un campo requerido.",
                maxlength: "Ingrese como máximo un campo de 50 dígitos",
            },
            availability: {
                required: "Disponibilidad es un campo requerido.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnEditPublication').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE PUBLICACIONES **********************/

/****************** INICIO DE VALIDACION DE CATALOGO**********************/

$(document).on('click', "#btnCatalogoCaracterizacion", function () {

    $("#form_catalogo").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            recurso:{
                required: true,
            },
            coleccion: {
                required: true,
                min: 1,
            },
            especie: {
                required: true,
                min: 1,
            }
        },
        messages: {
            recurso:{
                required: "Seleccione un Recurso.",
            },
            coleccion: {
                required: "Seleccione una Colección.",
                min: "Seleccione una Colección.",
            },
            especie: {
                required: "Seleccione un Nombre Científico.",
                min: "Seleccione un Nombre Científico.",
            }
        },
        submitHandler: function (form) {
            $('#btnCatalogoCaracterizacion').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE CATALOGO **********************/

/****************** INICIO DE VALIDACION DE SUSCRIPCIÓN CLIENTE**********************/
$(document).on('click', "#btnCliente", function () {
    $("#form_cliente").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        ignore: "input:hidden:not(input:hidden.required)",

        rules: {
            names:{
                required: true,
            },
            surnames:{
                required: true,
            },
            name_client:{
                required: true,
            },
            gender:{
                required: true,
            },
            country_id:{
                required: true,
            },
            origin:{
                required: true,
            },
            date_nac:{
                required: true,
            },
            study_center:{
                //required: true,
                maxlength: 80,
                minlength: 2,
            },
            institution:{
                //required: true,
                maxlength: 50,
                minlength: 2,
            },
            email: {
                required  : true,
                email     : true,
                maxlength : 30,
                remote    : {
                    url: CK.base_url + "ajax/verificarmailclient",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        email: function () {
                            if ($("input[name=email_hidden]").length) {
                                if ($("input[name=email]").val() !== $("input[name=email_hidden]").val()) {
                                    return ($("input[name=email]").val());
                                }
                            } else {
                                return ($("input[name=email]").val());
                            }
                        }
                    }
                },
            },
            code_fao:{
                maxlength: 10,
                minlength: 4,
                remote: {
                    url: CK.base_url + "ajax/verificarcodfao",
                    type: 'POST',
                    headers: {'X-CSRF-Token': $("input[name=_csrfToken]").val()},
                    data: {
                        codfao: function () {
                            if ($("input[name=codefao_hidden]").length) {
                                if ($("input[name=code_fao]").val() !== $("input[name=codefao_hidden]").val()) {
                                    return ($("input[name=code_fao]").val());
                                }
                            } else {
                                return ($("input[name=code_fao]").val());
                            }
                        }
                    }
                },
            },
            commentary:{
                required: true,
            },
        },
        messages: {
            email: {
                required : "Email es un campo requerido.",
                email    : "Ingrese e-mail válido.",
                remote   : jQuery.validator.format("E-mail ya existe."),
                maxlength:"Ingrese como máximo 30 caracteres.",
            },
            names: {
                required: "Nombres es un campo requerido.",
            },
            surnames: {
                required: "Apellidos es un campo requerido.",
            },
            name_client: {
                required: "Disponibilidad es un campo requerido.",
            },
            gender: {
                required: "Género es un campo requerido.",
            },
            country_id: {
                required: "País es un campo requerido.",
            },
            origin: {
                required: "Procedencia es un campo requerido.",
            },
            date_nac: {
                required: "Fecha Nacimiento es un campo requerido.",
            },
            study_center: {
                minlength: "Centro de Estudios debe tener mínimo 2 caracteres.",
                maxlength: "Centro de Estudios debe tener máximo 80 caracteres.",
            },
            institution: {
                minlength: "Institución debe tener mínimo 2 caracteres.",
                maxlength: "Institución debe tener máximo 50 caracteres.",
            },
            code_fao: {
                minlength: "Código FAO debe tener mínimo 4 caracteres.",
                maxlength: "Código FAO debe tener máximo 10 caracteres.",
                remote: jQuery.validator.format("Código FAO ya existe."),
            },
            state: {
                required: "Estado es un campo requerido.",
            },
            commentary: {
                required: "Comentario es un campo requerido.",
            },

        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnCliente').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE SUSCRIPCIÓN CLIENTE **********************/

/****************** INICIO DE VALIDACION DE ORDENES EN LÍNEA**********************/
$(document).on('click', "#btnOrdenes", function () {
    $("#form_ordenes").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        ignore: "input:hidden:not(input:hidden.required)",
        rules: {
            state:{
                required: true,
            },
            commentary:{
                required: true,
            },
        },
        messages: {

            state:{
                required: "Estado es un campo requerido.",
            },
            commentary: {
                required: "Comentario es un campo requerido.",
            },

        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE ORDENES EN LÍNEA **********************/

/****************** INICIO DE VALIDACION DE GESTIÓN DE PAGOS**********************/
$(document).on('click', "#btnPagos", function () {

    $("#form_pagos").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        ignore: "input:hidden:not(input:hidden.required)",
        rules: {
            bank_id:{
                required: true,
            },
            date_payment:{
                required: true,
            },
            coin:{
                required: true,
            },
            amount_paid:{
                required: true,
            },
            state:{
                required: true,
            },
            commentary:{
                required: true,
            },
        },
        messages: {

            bank_id:{
                required: "Banco es un campo requerido.",
            },
            date_payment:{
                required: "Fecha de Pago es un campo requerido.",
            },
            coin:{
                required: "Moneda es un campo requerido.",
            },
            state:{
                required: "Estado es un campo requerido.",
            },
            commentary:{
                required: "Comentario es un campo requerido.",
            },

        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE GESTIÓN DE PAGOS **********************/

/****************** INICIO DE VALIDACION BANCO SEMILLA **********************/
$(document).on('click', "#btnBankSeed", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("maxlength", function (value, element,param) {
        var length = $.isArray( value ) ? value.length : this.getLength( value, element );
        return this.optional( element ) || length <= param;
    }, "Ingrese solo 9 digitos.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango del porcentaje debe estar entre 0 a 100.");

    jQuery.validator.addMethod("validationDate", function(value, element) {
        if(value.length > 0)
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true;
    }, "Introduzca una fecha en el formato dd-mm-yyyy.");

    $("#form_bankSeed").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },

        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            pasaporte:{
                required: true,
            },
            fecha_aquisicion: {
                validationDate: true,
            },
            availability: {
                min: 1,
            },
            harvestdate: {
                required: true,
                min: 1,
            },
            seedpro: {
                min: 1,
            },
            seedsto: {
                required: true,
                min: 1,
            },
            typeref: {
                required: true,
                min: 1,
            },
            typemat: {
                required: true,
                min: 1,
            },
            ciclo: {
                
                min: 1,
            },
            seednumb:{
                required : true,
                naturals : true,
                maxlength: 9,
                min      : 1,
            },
            seeweight:{
                required: true,
                decimals: true,
                number  : true,
                min     : 0.1,
            },
            storage:{
                required: true,
            },
            temp:{
                required: true,
                range: [-100,100],
                number: true,
            },
            humidity:{
                required: true,
                decimals: true,
                number: true,
            },
            shelving:{
                required: true,
            },
            cod_per:{
                required: true,
            },
            bags:{
                required: true,
                naturals: true,
                maxlength:9,
                number: true,
            },
            size:{
                decimals: true,
                number: true,
            },
            germination:{
                range: [0,100],
                number: true,
            },
            seedhum:{
                range: [0,100],
                number: true,
            },
            discweight:{
                decimals: true,
                number: true,
            },
            discnumb:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            p1:{
                decimals: true,
                number: true,
            },
            n1:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            p2:{
                decimals: true,
                number: true,
            },
            n2:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            p3:{
                decimals: true,
                number: true,
            },
            n3:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            p4:{
                decimals: true,
                number: true,
            },
            n4:{
                naturals: true,
                number: true,
                maxlength: 9,
            },
            p5:{
                decimals: true,
                number: true,
            },
            n5:{
                naturals: true,
                number: true,
                maxlength: 9,
            },
            time:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            performance:{
                naturals: true,
                maxlength: 9,
                number: true,
            },
            origin: {
                required: true, 
            },
            fecha_aquisicion: {
                required: true, 
            },
            responsible: {
                required: true, 
            },
        },
        messages: {
            pasaporte: {
                required: "Código Accesión es un campo requerido."
            },
            origin: {
                required: "Ingresar Lugar de Procedencia."
            },
            fecha_aquisicion: {
                required: "Ingresar Fecha de Ingreso."
            },
            responsible: {
                required: "Ingresar Nombre del Responsable."
            },
            harvestdate: {
                required: "Ingresar Fecha de Cosecha."
            },
            typemat: {
                required: "Seleccionar Tipo de Colección."
            },
            seedsto: {
                required: "Seleccionar Tipo de Semilla."
            },
            typeref: {
                required: "Seleccionar Tipo de Refrescamiento."
            },
            seednumb: {
                 required : "Ingresar Cantidad de Semillas.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                //min      : "Número de Semillas debe ser mayor a cero.",
            },            
            seeweight: {
                required: "Ingresar Peso de la Semilla (g).",
                number  : "Solo se permiten números.",
                //min     : "Peso Total de las Semillas debe ser mayor a 0.1.",
            },
            storage: {
                required: "Tipo de Almacenamiento es un campo requerido.",
            },
            temp: {
                required: "Temperatura es un campo requerido.",
                number: "Solo se permiten números.",
            },
            humidity: {
                required: "Humedad es un campo requerido.",
                number: "Solo se permiten números.",
            },
            shelving: {
                required: "Estanteria es un campo requerido.",
            },
            cod_per: {
                required: "Código PER es un campo requerido.",
            },
            bags:{
                required: "Ingrese cantidad.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            size:{
                number: "Solo se permiten números.",
            },
            germination:{
                number: "Solo se permiten números.",
            },
            seedhum:{
                number: "Solo se permiten números.",
            },
            discweight:{
                number: "Solo se permiten números.",
            },
            discnumb:{
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            p1:{
                //required: "Ingrese peso.",
                number: "Solo se permiten números.",
            },
            n1:{
                //required: "Ingrese cantidad.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            p2:{
                number: "Solo se permiten números.",
            },
            n2:{
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            p3:{
                number: "Solo se permiten números.",
            },
            n3:{
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            p4:{
                number: "Solo se permiten números.",
            },
            n4:{
                number: "Solo se permiten números.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
            },
            p5:{
                number: "Solo se permiten números.",
            },
            n5:{
                number: "Solo se permiten números.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
            },
            time:{
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
            performance:{
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
                number: "Solo se permiten números.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnBankSeed').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE BANCO SEMILLA *************************/

/****************** INICIO DE VALIDACION ENTRADA DE MATERIAL - BANCO SEMILLA **********************/
$(document).on('click', "#btnInputSeed", function () {
    $.validator.addMethod("validFecha", function(value, element) {
            if(value != '')
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true;
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    $("#form_inputSeed").validate({
        ignore : [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {

                donorcore:{
                    required: true,
                },
                donorname:{
                    required: true,
                    maxlength: 20,
                },
                donornumb:{
                    required: true,
                },
                fecha_entrada:{
                    validFecha: true,
                    required: true,
                },
                weightent:{
                    decimals : true,
                    number   : true,
                    maxlength: 9,
                    min      : 0.01,
                },
                numtubent:{
                    number   : true,
                    maxlength: 9,
                    min      : 1,
                },
                // rement:{
                //     required: true,
                // },
            },
            messages: {

                donorcore:{
                    required: "Código del Donante es un campo requerido.",
                },
                donorname:{
                    required: "Nombre del Donante es un campo requerido.",
                },
                donornumb:{
                    required: "Código de Accesión del Donante es un campo requerido.",
                },
                fecha_entrada:{
                    required: "Fecha Entrada es un campo requerido.",
                },
                weightent:{
                    number   : "Solo se permiten números.",
                    maxlength: "Ingrese como máximo un numero de 9 dígitos",
                    min      : "Peso de Semilla debe ser mayor a 0.00",
                },
                numtubent:{
                    number   : "Solo se permiten números.",
                    maxlength: "Ingrese como máximo un numero de 9 dígitos",
                    min      : "Número de Semillas no puede ser cero.",
                },
                // rement:{
                //     required: "Descripción es un campo requerido.",
                // },

            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnInputSeed').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();
});
/****************** FIN DE VALIDACION DE ENTRADA DE MATERIAL - BANCO SEMILLA *************************/

/****************** INICIO DE VALIDACION SALIDA DE MATERIAL - BANCO SEMILLA **********************/
$(document).on('click', "#btnOutputSeed", function () {

        jQuery.validator.addMethod("decimals", function (value, element) {
            return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
        }, "El campo es numérico y solo debe contener 2 decimales.");

        $.validator.addMethod("validFecha", function(value, element) {
                if(value != '')
                    return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
                else
                    return true;
        }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

        $("#form_outputSeed").validate({
            ignore : [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {

                reqcode:{
                    required: true,
                },
                reqname:{
                    required: true,
                },
                fecha_salida:{
                    required: true,
                    validFecha: true,
                },
                numbagexit:{
                    // decimals: true,
                    required: true,
                    number: true,
                    maxlength: 9,
                    min: 1,
                },
                reason:{
                    required: true,
                },

                // remexit:{
                //     required: true,
                // },
                // bank_seed_id:{
                //     required: true,
                // },


            },
            messages: {

                reqcode:{
                    required: "Código del Solicitante es un campo requerido.",
                },
                reqname:{
                    required: "Nombre del Solicitante es un campo requerido.",
                },
                fecha_salida:{
                    required: "Fecha Salida es un campo requerido.",
                },
                numbagexit:{
                    required : "Número de Semillas es un campo requerido.",
                    number   : "Solo se permiten números.",
                    maxlength: "Ingrese como máximo un numero de 9 dígitos",
                    min      : "Número de Semillas debe ser mayor a cero."
                },
                reason:{
                    required: "Motivo de Salida es un campo requerido.",
                },
                // remexit:{
                //     required: "Descripción es un campo requerido.",
                // },
                // bank_seed_id:{
                //     required: "Código del Donante es un campo requerido.",
                // },

            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnOutputSeed').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
});
/****************** FIN DE VALIDACION DE SALIDA DE MATERIAL - BANCO SEMILLA *************************/

/****************** INICIO DE VALIDACION BANCO IN VITRO *************************/
$(document).on('click', "#btnBankInvitro", function () {

        // jQuery.validator.addMethod("decimals", function (value, element) {
        //     return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
        // }, "El campo es numérico y solo debe contener 2 decimales.");

        jQuery.validator.addMethod("naturals", function (value, element) {
            return this.optional(element) || /^[0-9]*$/i.test(value);
        }, "Ingrese solo números enteros positivos.");

        jQuery.validator.addMethod("maxlength", function (value, element,param) {
            var length = $.isArray( value ) ? value.length : this.getLength( value, element );
            return this.optional( element ) || length <= param;
        }, "Ingrese solo 9 digitos.");

        jQuery.validator.addMethod("validationDate", function(value, element) {
            if(value.length > 0)
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true;
        }, "Introduzca una fecha en el formato dd-mm-yyyy.");

        $("#form_bankInvitro").validate({

            highlight : function(label) {
                $(label).closest('.form-group').addClass('has-error');
                var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
                if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                    $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                        var id = $(tab).attr("id");
                        $('a[href="#' + id + '"]').tab('show');
                    });
                }
            },
            ignore: [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                pasaporte:{
                    required: true,
                },
                fecha_aquisicion: {
                    validationDate: true,
                },
                availability:{
                    required: true,
                },
                storoom:{
                    required: true,
                },
                temp:{
                    required: true,
                },
                storage:{
                    required: true,
                },
                tubenumb:{
                    required: true,
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                explnumb:{
                    required: true,
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                tubesize:{
                    required: true,
                },
                levelshelv:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                rack:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                dupnumb:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                protime:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                constime:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                plastate: {
                    min: 1,
                },
                necrosis: {
                    min: 1,
                },
                defoliation: {
                    min: 1,
                },
                rooting: {
                    min: 1,
                },
                chlorosis: {
                    min: 1,
                },
                phenolization: {
                    min: 1,
                },
                propagation: {
                    min: 1,
                },
                conservation: {
                    min: 1,
                },
                fitostate: {
                    min: 1,
                },
            },
            messages: {
                levelshelv: {
                    number: "Solo se permiten números.",
                    maxlength: "Nivel Estantería tiene un máximo de 9 caracteres.",
                },
                rack: {
                    number: "Solo se permiten números.",
                    maxlength: "Gradilla tiene un máximo de 9 caracteres.",
                },
                dupnumb: {
                    number: "Solo se permiten números.",
                    maxlength: "Nro. Duplicados tiene un máximo de 9 caracteres.",
                },
                protime: {
                    number: "Solo se permiten números.",
                    maxlength: "Duración de Propagación tiene un máximo de 9 caracteres.",
                },
                constime: {
                    number: "Solo se permiten números.",
                    maxlength: "Número de Tubos tiene un máximo de 9 caracteres.",
                },
                explnumb: {
                    number: "Solo se permiten números.",
                    maxlength: "Número de Explantes tiene un máximo de 9 caracteres.",
                    required: "Números de Explantes es un campo requerido.",
                },
                tubenumb: {
                    number: "Solo se permiten números.",
                    required: "Números de Tubos es un campo requerido.",
                    maxlength: "Nivel Estantería tiene un máximo de 9 caracteres.",
                },
                pasaporte:{
                    required: "Código PER es un campo requerido.",
                },
                availability:{
                    required: "Seleccione una Disponibilidad del Lote de la Accesión.",
                },
                storoom:{
                    required: "Seleccione un Cuarto de Conservación.",
                },
                temp:{
                    required: "Seleccione una Temperatura.",
                },
                storage:{
                    required: "Seleccione un Tipo de almacenamiento.",
                },
                tubesize:{
                    required: "Seleccione un Tamaño Tubo.",
                },

            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnBankInvitro').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
});
/****************** FIN DE VALIDACION DE BANCO IN VITRO *************************/

/****************** INICIO DE VALIDACION CONSERVACIÓN - BANCO IN VITRO *************************/

    // $(document).on('click', "#btnConservationInvitro", function () {


    //     $("#form_conservationInvitro").validate({

    //         highlight : function(label) {
    //             $(label).closest('.form-group').addClass('has-error');
    //             var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
    //             if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
    //                 $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
    //                     var id = $(tab).attr("id");
    //                     $('a[href="#' + id + '"]').tab('show');
    //                 });
    //             }
    //         },
    //         ignore: [],
    //         errorClass: 'myErrorClass',
    //         errorElement: "span",
    //         rules: {

    //             constime:{
    //                 required: true,
    //             },
    //             consresponsible:{
    //                 required: true,
    //             },
    //             consrem:{
    //                 required: true,
    //             },
    //             stoper:{
    //                 required: true,
    //             },

    //         },
    //         messages: {

    //            constime:{
    //             required: "Código del Donante es un campo requerido.",
    //         },
    //         consresponsible:{
    //             required: "Personal Responsable es un campo requerido.",
    //         },
    //         consrem:{
    //             required: "Motivo de Conservación es un campo requerido.",
    //         },
    //         stoper:{
    //             required: "Periodo de Conservación es un campo requerido.",
    //         },

    //     },
    //     submitHandler: function (form) {
    //         console.log("enviando_data_form_:");
    //         form.submit();
    //     },
    //     highlight: function (element, errorClass, validClass) {
    //         highlight(element, errorClass);
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //         unhighlight(element, errorClass);
    //     },
    //     errorPlacement: function (error, element) {
    //         errorPlacement(error, element);
    //     }
    // });
    //     select_change();
    // });
    /****************** FIN DE VALIDACION DE CONSERVACIÓN - BANCO IN VITRO *************************/

    /****************** INICIO DE VALIDACION ENTRADA - BANCO IN VITRO *************************/
    $(document).on('click', "#btnInputInvitro", function () {

        jQuery.validator.addMethod("naturals", function (value, element) {
            return this.optional(element) || /^[0-9]*$/i.test(value);
        }, "Ingrese solo números enteros positivos.");

        $.validator.addMethod("validFecha", function(value, element) {
                if(value != '')
                    return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
                else
                    return true;
        }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

        $("#form_inputInvitro").validate({

                errorClass: 'myErrorClass',
                errorElement: "span",
                rules: {
                    fecha_entrada:{
                        validFecha: true,
                    },
                    tubentnumb:{
                        number: true,
                        naturals: true,
                    },
                    explentnumb:{
                        number: true,
                        naturals: true,
                    }

                },
                messages: {
                    tubentnumb:{
                        number: "Solo se permiten números.",

                    },
                    explentnumb:{
                        number: "Solo se permiten números.",
                    }
                },
                submitHandler: function (form) {
                    console.log("enviando_data_form_:");
                    form.submit();
                },
                highlight: function (element, errorClass, validClass) {
                    highlight(element, errorClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    unhighlight(element, errorClass);
                },
                errorPlacement: function (error, element) {
                    errorPlacement(error, element);
                }
        });
        select_change();
    });
/****************** FIN DE VALIDACION DE ENTRADA - BANCO IN VITRO *************************/

/****************** INICIO DE REPORTE *************************/
$(document).on('click', "#btnReporte", function () {

    $("#idForm_Reporte").validate({
        
        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {

            opc_repor:{
                required: true,
            },
            tip_repor:{
                required: true,
            }

        },
        messages: {

            opc_repor:{
                required: "Se debe seleccionar una Opción de Reporte.",
            },

            tip_repor:{
                required: "Se debe seleccionar un Filtro de Reporte.",

            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnReporte').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE REPORTE *************************/

/****************** INICIO DE VALIDACION SALIDA - BANCO IN VITRO *************************/
$(document).on('click', "#btnOutputInvitro", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    $.validator.addMethod("validFecha", function(value, element) {
            if(value != '')
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true;
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    $("#form_outputInvitro").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            // reqcode:{
            //     required: true,
            // },
            // reqname:{
            //     required: true,
            // },
            fecha_salida:{
                validFecha: true,
            },
            tubexitnumb:{
                decimals: true,
                number: true,
                maxlength: 9,
            },
            explexitnumb:{
                decimals: true,
                number: true,
                maxlength: 9,
            },

            // remexit:{
            //     required: true,
            // },

        },
        messages: {

            // reqcode:{
            //     required: "Código del Solicitante es un campo requerido.",
            // },
            // reqname:{
            //     required: "Nombre del Solicitante es un campo requerido.",
            // },
            // fecha_salida:{
            //     required: "Fecha Salida es un campo requerido.",
            // },
            tubexitnumb:{
                number: "Solo se permiten números.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
            },
            explexitnumb:{
                number: "Solo se permiten números.",
                maxlength: "Ingrese como máximo un numero de 9 dígitos",
            },

            // remexit:{
            //     required: "Descripción es un campo requerido.",
            // },

        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnOutputInvitro').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE SALIDA - BANCO IN VITRO *************************/

/****************** INICIO DE VALIDACION PROPAGACIÓN - BANCO IN VITRO *************************/

    $(document).on('click', "#btnPropagationInvitro", function () {

        $.validator.addMethod("validFecha", function(value, element) {
            if(value != '')
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true;
        }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

        $("#form_propagationInvitro").validate({
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                fecha_propagacion:{
                    validFecha: true,
                },
                propagator:{
                    maxlength: 80,
                },
                proper: {
                    maxlength: 80,
                },
                prorem:{
                    maxlength: 280,
                }

            },
            messages: {

                proper:{
                    maxlength: "Ingrese como máximo un numero de 80 dígitos",
                },
                propagator:{
                    maxlength: "Ingrese como máximo un numero de 80 dígitos",
                },
                prorem:{
                    maxlength: "Ingrese como máximo un numero de 280 dígitos",
                }

            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
    });
/****************** FIN DE VALIDACION DE PROPAGACIÓN - BANCO IN VITRO *************************/

/****************** INICIO DE VALIDACION BANCO CAMPO *************************/
$(document).on('click', "#btnBankField", function () {

        jQuery.validator.addMethod("decimals", function (value, element) {
            return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
        }, "El campo es numérico y solo debe contener 2 decimales.");

        jQuery.validator.addMethod("naturals", function (value, element) {
            return this.optional(element) || /^[0-9]*$/i.test(value);
        }, "Ingrese solo números enteros positivos.");

        jQuery.validator.addMethod("maxlength", function (value, element,param) {
            var length = $.isArray( value ) ? value.length : this.getLength( value, element );
            return this.optional( element ) || length <= param;
        }, "Ingrese solo 9 digitos.");

        jQuery.validator.addMethod("geolocalizacion", function (value, element) {
            return this.optional(element) || /^-?[0-9]\d{0,4}(\.\d{0,5})?$/i.test(value);
        }, "El campo es numérico y solo debe tener max. 5 decimales.");

        jQuery.validator.addMethod("validFecha", function(value, element, params) {
            date1 = value.split("-").reverse().join("-");
            date2 = ($(params).val()).split("-").reverse().join("-");

            if (!/Invalid|NaN/.test(new Date(date1))) {
                return new Date(date1) > new Date(date2);
            }

            return isNaN(date1) && isNaN(date2) || (Number(date1) > Number(date2));
        },'Fecha Termino no puede ser menor o igual a la Fecha Inicio.');

        $("#form_bankField").validate({

            highlight : function(label) {
                $(label).closest('.form-group').addClass('has-error');
                var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
                if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                    $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                        var id = $(tab).attr("id");
                        $('a[href="#' + id + '"]').tab('show');
                    });
                }
            },
            ignore: [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                sowsamptype:{
                    required: true,
                },
                objective:{
                    required: true,
                },
                fecha_inicio:{
                    required: true,
                },
                fecha_termino:{
                    required: true,
                    validFecha: "#fecha-inicio",
                },
                researcher:{
                    required: true,
                },
                design:{
                    required: true,
                },
                departamento:{
                    required: true,
                    min : 1,
                },
                provincia:{
                    required: true,
                    min : 1,
                },
                distrito:{
                    required: true,
                    min : 1,
                },
                locality:{
                    required: true,
                },
                eea:{
                    required: true,
                },
                colname:{
                    required: true,
                },
                accenumb:{
                    required: true,
                },
                genus:{
                    required: true,
                },
                species:{
                    required: true,
                },
                fieldsize:{
                    decimals: true,
                    number: true,
                },
                reps:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                plotsize:{
                    naturals: true,
                    maxlength: 9,
                    number: true,
                },
                latitude:{
                    geolocalizacion: true,
                    number: true,
                },
                longitude:{
                    geolocalizacion: true,
                    number: true,
                },
                elevation:{
                    decimals: true,
                    number: true,
                },


            },
            messages: {
                sowsamptype:{
                    required: "Seleccione un Tipo de Material Sembrado.",
                },
                objective:{
                    required: "Objetivo del Proyecto es un campo requerido.",
                },
                fecha_inicio:{
                    required: "Fecha de Inicio es un campo requerido.",
                },
                fecha_termino:{
                    required: "Fecha de Término es un campo requerido.",
                },
                researcher:{
                    required: "Investigador Responsable del Experimento es un campo requerido.",
                },
                design:{
                    required: "Diseño del Experimento es un campo requerido.",
                },
                departamento:{
                    required: "Seleccione un Departamento.",
                },
                provincia:{
                    required: "Seleccione una Provincia.",
                    min     : "Seleccione una Provincia.",
                },
                distrito:{
                    required: "Seleccione un Distrito.",
                    min     : "Seleccione un Distrito.",
                },
                locality:{
                    required: "Localidad es un campo requerido.",
                },
                eea:{
                    required: "Estación Experimental es un campo requerido.",
                },
                colname:{
                    required: "Colección es un campo requerido.",
                },
                accenumb:{
                    required: "Código Accesión es un campo requerido.",
                },
                genus:{
                    required: "Género es un campo requerido.",
                },
                species:{
                    required: "Especie es un campo requerido.",
                },
                latitude: {
                    number: "Solo se permiten números.",
                },
                longitude: {
                    number: "Solo se permiten números.",
                },
                elevation: {
                    number: "Solo se permiten números.",
                },
                fieldsize: {
                    number: "Solo se permiten números.",
                },
                reps: {
                    number: "Solo se permiten números.",
                },
                plotsize: {
                    number: "Solo se permiten números.",
                }
            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnBankField').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
});
/****************** FIN DE VALIDACION DE BANCO CAMPO *************************/

/****************** INICIO DE VALIDACION ENTRADA - BANCO CAMPO *************************/
    $(document).on('click', "#btnInputField", function () {

        jQuery.validator.addMethod("naturals", function (value, element) {
            return this.optional(element) || /^[0-9]*$/i.test(value);
        }, "Ingrese solo números enteros positivos.");

        $.validator.addMethod("validFecha", function(value, element) {
            if(value != '')
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true;
        }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

        $("#form_inputField").validate({

            ignore: [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                fecha_entrada: {
                    validFecha: true,
                },
        //             donorcore:{
        //                 required: true,
        //             },
        //             donorname:{
        //                 required: true,
        //             },
        //             donornumb:{
        //                 required: true,
        //             },
        //             fecha_entrada:{
        //                 required: true,
        //             },
                numtubent:{
                    naturals: true,
                    number: true,
                },
        //             rement:{
        //                 required: true,
        //             },
                muestratype:{
                    number: true,
                },
        //             estmuestra:{
        //                 required: true,
        //             },

            },
            messages: {

        //             donorcore:{
        //                 required: "Código del Donante es un campo requerido.",
        //             },
        //             donorname:{
        //                 required: "Nombre del Donante es un campo requerido.",
        //             },
        //             donornumb:{
        //                 required: "Código de Accesión del Donante es un campo requerido.",
        //             },
        //             fecha_entrada:{
        //                 required: "Fecha Entrada es un campo requerido.",
        //             },
                    numtubent:{
                        number: "Solo se permiten números.",
                    },
        //             rement:{
        //                 required: "Descripción es un campo requerido.",
        //             },
                    muestratype:{
                        number: "Solo se permiten números.",
                    },
        //             estmuestra:{
        //                 required: "Fecha de Propagación3 es un campo requerido.",
        //             },
            },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnInputField').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE ENTRADA - CAMPO *************************/

/****************** INICIO DE VALIDACION SALIDA - BANCO CAMPO *************************/
$(document).on('click', "#btnOutputField", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $.validator.addMethod("validFecha", function(value, element) {
        if(value != '')
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true;
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    $("#form_outputField").validate({

        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            fecha_salida: {
                validFecha : true,
            },
            //             reqcode:{
            //                 required: true,
            //             },
            //             reqname:{
            //                 required: true,
            //             },
            //             fecha_salida:{
            //                 required: true,
            //             },
            //             samptype:{
            //                 required: true,
            //             },
            samplamount:{
                naturals: true,
                number  : true,
                min     : 1,
            },
            //             destiny:{
            //                 required: true,
            //             },
            //             object:{
            //                 required: true,
            //             },
            //             remexit:{
            //                 required: true,
            //             },
            //             sampres:{
            //                 required: true,
            //             },

        },
        messages: {

            //     reqcode:{
            //         required: "Código del Solicitante es un campo requerido.",
            //     },
            //     reqname:{
            //         required: "Nombre del Solicitante es un campo requerido.",
            //     },
            //     fecha_salida:{
            //         required: "Fecha Salida es un campo requerido.",
            //     },
            //     samptype:{
            //         required: "Cantidad de Muestra es un campo requerido.",
            //     },
                samplamount :{
                    number: "Solo se permiten números.",
                    min   : "Cantidad de Muestra debe ser mayor a cero.",
                },
            //     destiny:{
            //         required: "Destino de la Muestra es un campo requerido.",
            //     },
            //     object:{
            //         required: "Motivo de Salida de Material es un campo requerido.",
            //     },
            //     remexit:{
            //         required: "Descripción es un campo requerido.",
            //     },
            //     sampres:{
            //         required: "Investigador que Recibe la Muestra es un campo requerido.",
            //     },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnOutputField').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE SALIDA - CAMPO *************************/

/****************** INICIO DE VALIDACION EVALUACION - BANCO CAMPO *************************/

    $(document).on('click', "#btnEvaluationField", function () {

        $.validator.addMethod("validFecha", function(value, element) {
            if(value != '')
                return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
            else
                return true
        }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

        $("#form_evaluationField").validate({

            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
                fecha_evaluacion:{
                    validFecha: true,
                },
                evalname:{
                    maxlength: 50,
                },
                evalrem:{
                    maxlength: 50,
                },
                prodtype:{
                    maxlength: 50,
                },
                prodrem:{
                    minlength: 2,
                },
                harvest:{
                    maxlength: 50,
                },

            },
            messages: {

                evaldate:{
                    maxlength: "Nombre del Responsable tiene un máximo de 50 caracteres.",
                },
                evalname:{
                    maxlength: "Nombre del Responsable tiene un máximo de 50 caracteres.",
                },
                evalrem:{
                    maxlength: "Descripción de la Evaluación tiene un máximo de 50 caracteres.",
                },
                prodtype:{
                    maxlength: "Tipo de Producto tiene un máximo de 50 caracteres.",
                },
                prodrem:{
                    minlength: "Descripción del producto debe tener mínimo 2 caracteres.",
                },
                harvest:{
                    maxlength: "Época de Cosecha tiene un máximo de 50 caracteres.",
                },
            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
        select_change();
    });

/****************** FIN DE VALIDACION DE EVALUACION - CAMPO *************************/

/****************** INICIO DE VALIDACION BANCO ADN *************************/

$(document).on('click', "#btnBankAdn", function () {

    $.validator.addMethod("validFecha", function(value, element) {
        if(value != '')
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    $("#form_bankAdn").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            availability:{
                required: true,
            },
            pasaporte:{
                required: true,
            },
            fecha_aquisicion: {
                validFecha: true,
            },
        },
        messages: {

            availability:{
                required: "Seleccione una Disponibilidad del Lote de la Accesión.",
            },
            pasaporte:{
                required: "Código PER es un campo requerido.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnBankAdn').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE BANCO ADN *************************/

/****************** INICIO DE VALIDACION ENTRADA - BANCO ADN *************************/
$(document).on('click', "#btnInputDnaZoo", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $.validator.addMethod("validFecha", function(value, element) {
        if(value != '')
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    $("#form_add_inputDnaZoo").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            numtubent:{
                naturals : true,
                number: true,
                maxlength: 9,
                min      : 1,
            },
            fecha_entrada: {
                validFecha: true,
            },
            tipdep:{
                min : 1,
            },
            tipmuestra: {
                min : 1,
            },
            estmuestra: {
                min : 1,
            },
        },
        messages: {
            numtubent: {
                maxlength: "Ingresar como máximo 9 digitos.",
                number   : "Ingrese solo números.",
                min      : "Cantidad de Muestra debe ser mayor a cero.",
            }
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnInputDnaZoo').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE ENTRADA - ADN *************************/

/****************** INICIO DE VALIDACION SALIDA - BANCO CAMPO *************************/
$(document).on('click', "#btnOutputDna", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_add_outputDna").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            numtubexit:{
                naturals: true,
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnOutputDna').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE SALIDA - CAMPO *************************/

/****************** INICIO DE VALIDACION ENTRADA - BANCO CAMPO *************************/
$(document).on('click', "#btnInputDna", function () {

jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $.validator.addMethod("validFecha", function(value, element) {
        if(value != '')
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    $("#form_add_inputDna").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            numtubent:{
                naturals : true,
                number: true,
                maxlength: 9,
                min      : 1,
            },
            fecha_entrada: {
                validFecha: true,
            },
            tipdep:{
                min : 1,
            },
            tipmuestra: {
                min : 1,
            },
            estmuestra: {
                min : 1,
            },
        },
        messages: {
            numtubent: {
                maxlength: "Ingresar como máximo 9 digitos.",
                number   : "Ingrese solo números.",
                min      : "Cantidad de Muestra debe ser mayor a cero.",
            }
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnInputDna').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE ENTRADA - CAMPO *************************/

/****************** INICIO DE VALIDACION EXTRACCIÓN - BANCO ADN *************************/
$(document).on('click', "#btnExtractionAdn", function () {

    jQuery.validator.addMethod("decimals", function (value, element) {
        return this.optional(element) || /^[0-9]\d{0,20}(\.\d{0,2})?$/i.test(value);
    }, "El campo es numérico y solo debe contener 2 decimales.");

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("maxlength", function (value, element,param) {
        var length = $.isArray( value ) ? value.length : this.getLength( value, element );
        return this.optional( element ) || length <= param;
    }, "Ingrese solo 9 digitos.");

        // jQuery.validator.addMethod("compareTo", function (value, element,param) {
        //     return $(param).val().length>0;
        // }, "compare.");

        $("#form_extractionAdn").validate({

            highlight : function(label) {
                $(label).closest('.form-group').addClass('has-error');
                var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();

                if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                    $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                        var id = $(tab).attr("id");
                        $('a[href="#' + id + '"]').tab('show');
                    });
                }
            },
            ignore: [],
            errorClass: 'myErrorClass',
            errorElement: "span",
            rules: {
            // extmethod:{
            //     required: true,
            // },
            // extres:{
            //     required: true,
            // },
            // fecha_extraccion:{
            //     required: true,

            // },
            // shortstorage:{
            //     required: true,
            // },
            // shortermtemp:{

            //     required:{

            //         depends: function() {

            //             var condicion=$('#shortermtemp').val().length>0 || $('#longtermtemp').val().length>0;

            //             if($('#shortermtemp').val().length>0){

            //                        //$('#longtermtemp').valid();
            //                    }

            //                    return !condicion;

            //                }

            //            },
            //     //compareTo:'#longtermtemp',

            // },
            // shortlevsh:{
            //     required: true,
            // },
            // shortrack:{
            //     required: true,
            // },
            // shortrackpos:{
            //     required: true,
            // },
            shortcrionumb:{
                //required: true,
                number  : true,
                decimals: true,
            },
            // shortcriopos:{
            //     required: true,
            // },
            // shortstornumb:{
            //     required: true,
            // },
            // longstorage:{
            //     required: true,
            // },
            // longtermtemp:{
            //     required:{

            //         depends: function() {

            //             var condicion=$('#shortermtemp').val().length>0 || $('#longtermtemp').val().length>0;

            //             if(condicion){

            //                         //$('#shortermtemp').valid();

            //                     }

            //                     return !condicion;

            //                 }

            //             },

            //         },
            //         longstornumb:{
            //             required: true,
            //         },
            //         longlevsh:{
            //             required: true,
            //         },
            //         longrack:{
            //             required: true,
            //         },
                // longrackpos:{
                //     required: true,
                // },
                longcrionumb:{
                    // required: true,
                    number  : true,
                    decimals: true,
                },
                // longcriopos:{
                //     required: true,
                // },
                volumen:{
                    decimals: true,
                },
                dnaqty:{
                    number  : true,
                    min     : 1,
                },
                conadnint:{
                    decimals: true,
                },
                agaelec:{
                    decimals: true,
                },
                shortmatnumb:{
                    naturals: true,
                    maxlength: 9,
                },
                shortminstock:{
                    naturals: true,
                    maxlength: 9,
                },
                shortcrionumb:{
                    naturals: true,
                    maxlength: 9,
                },
                longcrionumb:{
                    naturals: true,
                    maxlength: 9,
                },
            },
            messages: {

            //     extmethod:{
            //         required: "Seleccione un Método de extracción.",
            //     },
            //     extres:{
            //         required: "Investigador responsable es un campo requerido.",
            //     },
            //     fecha_extraccion:{
            //         required: "Fecha de Extracción es un campo requerido.",

            //     },
            //     shorconstime:{
            //         required: "Código PER2 es un campo requerido.",
            //     },
            //     shortstorage:{
            //         required: "Seleccione un Lugar de almacenamiento.",
            //     },
            //     shortermtemp:{
            //         required: "Temperatura es un campo requerido.",
            //         equalTo:'s',
            //     },
            //     shortlevsh:{
            //         required: "Nivel de Estantería es un campo requerido.",
            //     },
            //     shortrack:{
            //         required: "Código Gradilla es un campo requerido.",
            //     },
            //     shortrackpos:{
            //         required: "Posición  Dentro de la Gradilla es un campo requerido.",
            //     },
                dnaqty: {
                    number  : "Ingrese solo números.",
                    min: "Cantidad de ADN debe ser mayor a 0",
                },
                shortcrionumb:{
                    // required: "Número de Criobox de la Gradilla es un campo requerido.",
                    number  : "Ingrese solo números.",
                },
                // shortcriopos:{
                //     required: "Posición Dentro del Criobox de la Gradilla es un campo requerido.",
                // },
                // shortstornumb:{
                //     required: "Código almacenamiento es un campo requerido.",
                // },
                // longtermtemp:{
                //     required: "Temperatura es un campo requerido.",
                // },
                // longstornumb:{
                //     required: "Código almacenamiento es un campo requerido.",
                // },
                // longstorage:{
                //     required: "Seleccione un Lugar de almacenamiento.",
                // },
                // longlevsh:{
                //     required: "Nivel de estanteria es un campo requerido.",
                // },
                // longrack:{
                //     required: "Código de la gradilla es un campo requerido.",
                // },
                // longrackpos:{
                //     required: "Posición dentro de la gradilla es un campo requerido.",
                // },
                longcrionumb:{
                    required: "Número de criobox es un campo requerido.",
                    number  : "Ingrese solo números.",
                },
                // longcriopos:{
                //     required: "Posición dentro del criobox es un campo requerido.",
                // },
            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnExtractionAdn').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
        // console.log(JSON.stringify(element));
    }

});
    select_change();
});
/****************** FIN DE VALIDACION DE EXTRACCIÓN - BANCO ADN *************************/

/****************** INICIO DE VALIDACION SALIDA - BANCO CAMPO *************************/
$(document).on('click', "#btnOutputDna", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_add_outputDna").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            numtubexit:{
                naturals: true,
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnOutputDna').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE SALIDA - CAMPO *************************/

/****************** INICIO DE VALIDACION BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnBankMicro", function () {

    $("#form_bankMicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            pasaporte: {
                required: true,
            },
            fecha_aquisicion:{
                required: true,
            },
            availability:{
                required: true,
            },
            risk:{
                required: true,
            },
            lablevel: {
                min: 1,
            },
            reactivation: {
                min: 1,
            },
        },
        messages: {
            pasaporte: {
                required: "Código PER es un campo requerido.",
            },
            fecha_aquisicion:{
                required: "Fecha de introdución es un campo requerido.",
            },
            availability:{
                required: "Seleccione una Disponibilidad del Lote de la Accesión.",
            },
            risk:{
                required: "Riesgo Biológico es un campo requerido.",
            },
            lablevel: {
                min: "Seleccione un Nivel de Laboratorio.",
            },
            reactivation: {
                min: "Seleccione un Medio de Cultino de Reactivación.",
            },
        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnBankMicro').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE BANCO MICROORGANISMO *************************/

/****************** INICIO DE VALIDACION PUREZA - BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnPurezaMicro", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango del porcentaje debe estar entre 0 a 100.");

    $("#form_purezaMicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            reactime_1:{
                naturals: true,
            },
            reactime_2:{
                naturals: true,
            },
            reactemp_1:{
                naturals: true,
            },
            reactemp_2:{
                naturals: true,
            },
        },
        messages: {


        },
        submitHandler: function (form) {
            console.log("enviando_data_form_:");
            $('#btnPurezaMicro').attr("disabled", true);
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();
});
/****************** FIN DE VALIDACION DE PUREZA BANCO MICROORGANISMO *************************/

/****************** INICIO DE VALIDACION CONSERVACIÓN - BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnConservationMicro", function () {
    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $.validator.addMethod("validFecha", function(value, element) {
        if(value != '')
            return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
        else
            return true
    }, "El campo fecha debe tener el sig. formato dd/mm/yyyy.");

    jQuery.validator.addMethod("range", function( value, element, param ) {
        return this.optional( element ) || ( value >= param[0] && value <= param[1] );
    }, "El rango del porcentaje debe estar entre 0 a 100.");

    $("#form_conservationMicro").validate({
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
                // longtermcon:{
                //     required: true,
                // },
                // longtermtemp:{
                //     required: true,
                // },
                // longstorage:{
                //     required: true,
                // },
                // criolevel:{
                //     required: true,
                // },
                // criorack:{
                //     required: true,
                // },
                // longrackpos:{
                //     required: true,
                // },
                fecha_conservacion:{
                    validFecha: true,
                },
                // consresponsible:{
                //     required: true,
                // },
                // consrem:{
                //     required: true,
                // },
                criovinumb:{
                    naturals: true,
                },
                crioviminstock:{
                    naturals: true,
                },
                longtermtime:{
                    naturals: true,
                },
                longcrionumb:{
                    naturals: true,
                },
                longtermtemp:{
                    naturals: true,
                },
            },
            messages: {

                // longtermcon:{
                //     required: "Seleccione un Medio de Conservación.",
                // },
                // longtermtemp:{
                //     required: "Temperatura es un campo requerido.",
                // },
                // longstorage:{
                //     required: "Seleccione un Lugar Almacenamiento.",
                // },
                // criolevel:{
                //     required: "Nivel de Estantería es un campo requerido.",
                // },
                // criorack:{
                //     required: "Código de gradilla es un campo requerido.",
                // },
                // longrackpos:{
                //     required: "Posición dentro de la Gradilla es un campo requerido.",
                // },
                // fecha_conservacion:{
                //     required: "Fecha de Conservación es un campo requerido.",
                // },
                // consresponsible:{
                //     required: "Personal Responsable es un campo requerido.",
                // },
                // consrem:{
                //     required: "Motivo de la Conservación es un campo requerido.",
                // },


            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnConservationMicro').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();

});
/****************** FIN DE VALIDACION DE BANCO MICROORGANISMO *************************/

/****************** INICIO DE VALIDACION CONSERVACIÓN CORTO- BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnConservationShortMicro", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_conservationShortMicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
                // shortermcon:{
                //     required: true,
                // },
                // shortermtemp:{
                //     required: true,
                // },
                // shortstorage:{
                //     required: true,
                // },
                // shortlevsh:{
                //     required: true,
                // },
                // criorack:{
                //     required: true,
                // },
                // shortrackpos:{
                //     required: true,
                // },
                // fecha_conservacion:{
                //     required: true,
                // },
                // consresponsible:{
                //     required: true,
                // },
                // consrem:{
                //     required: true,
                // },
                // shortmatstor:{
                //     required: true,
                // },
                shortminstock:{
                    naturals: true,
                },
            },
            messages: {

                // shortermcon:{
                //     required: "Seleccione un Medio de Conservación.",
                // },
                // shortermtemp:{
                //     required: "Temperatura es un campo requerido.",
                // },
                // shortstorage:{
                //     required: "Seleccione un Lugar Almacenamiento.",
                // },
                // shortlevsh:{
                //     required: "Nivel de Estantería es un campo requerido.",
                // },
                // criorack:{
                //     required: "Código de gradilla es un campo requerido.",
                // },
                // shortrackpos:{
                //     required: "Posición dentro de la Gradilla es un campo requerido.",
                // },
                // fecha_conservacion:{
                //     required: "Fecha de Conservación es un campo requerido.",
                // },
                // consresponsible:{
                //     required: "Nombre del Responsable es un campo requerido.",
                // },
                // consrem:{
                //     required: "Motivo de la Conservación es un campo requerido.",
                // },
                // shortmatstor:{
                //     required: "Seleccione Material de Almacenamiento.",
                // },


            },
            submitHandler: function (form) {
                console.log("enviando_data_form_:");
                $('#btnConservationShortMicro').attr("disabled", true);
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();

});
/****************** FIN DE VALIDACION DE CONSERVACIÓN CORTO - BANCO MICROORGANISMO *************************/

/****************** INICIO DE VALIDACION ENTRADA- BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnInputMicro", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_inputMicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
                // fecha_entrada:{
                //     required: true,
                // },
                numtubent:{
                    naturals: true,
                    maxlength:9,
                },
                numtubexit:{
                    naturals: true,
                    maxlength:9,
                },
            },
            messages: {

                numtubent:{
                    maxlength: "Ingresar como máximo 9 digitos.",
                },
                numtubexit:{
                    maxlength: "Ingresar como máximo 9 digitos.",
                },

            },
            submitHandler: function (form) {
                $('#btnInputMicro').attr("disabled", true);
                console.log("enviando_data_form_:");
                form.submit();
            },
            highlight: function (element, errorClass, validClass) {
                highlight(element, errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                unhighlight(element, errorClass);
            },
            errorPlacement: function (error, element) {
                errorPlacement(error, element);
            }
        });
    select_change();

});
/****************** FIN DE VALIDACION DE CONSERVACIÓN CORTO - BANCO MICROORGANISMO *************************/

/****************** INICIO DE VALIDACION SALIDA- BANCO MICROORGANISMO *************************/
$(document).on('click', "#btnOutputMicro", function () {

    jQuery.validator.addMethod("naturals", function (value, element) {
        return this.optional(element) || /^[0-9]*$/i.test(value);
    }, "Ingrese solo números enteros positivos.");

    $("#form_outputMicro").validate({

        highlight : function(label) {
            $(label).closest('.form-group').addClass('has-error');
            var tab_content= $(label).parent().parent().parent().parent().parent().parent().parent();
            if ($(tab_content).find("fieldset.tab-pane.active:has(div.has-error)").length == 0) {
                $(tab_content).find("fieldset.tab-pane:has(div.has-error)").each(function (index, tab) {
                    var id = $(tab).attr("id");
                    $('a[href="#' + id + '"]').tab('show');
                });
            }
        },
        ignore: [],
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {

            numtubexit:{
                naturals: true,
            },
        },
        messages: {



        },
        submitHandler: function (form) {
            $('#btnOutputMicro').attr("disabled", true);
            console.log("enviando_data_form_:");
            form.submit();
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();

});
/****************** FIN DE VALIDACION DE SALIDA - BANCO MICROORGANISMO *************************/


function errorPlacement(error, element) {
    if (element.hasClass('select2')) {
        error.insertAfter(element.next());
    } else if (element.hasClass('ckeditor')) {
        error.insertAfter("#cke_summary");
    } else if (element.hasClass('file-input')) {
        error.insertAfter(element.parent().parent().parent().parent());
    } else {
        error.insertAfter(element);
    }
}

function unhighlight(element, errorClass) {
    $(element).removeClass(errorClass);
    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
}

function highlight(element, errorClass) {
    var elem = $(element);

    if (elem.hasClass('s-select2')) {
        var isMulti = (!!elem.attr('multiple')) ? 's' : '';
        elem.siblings('.select2').find('.select2-choice' + isMulti + '').addClass(errorClass);
    } else {
        elem.addClass(errorClass);
    }
    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
}

function select_change() {
    $('select').on('change', function () {
        $(this).valid();
    });
}

function file_change() {
    $('input[type=file]').on('change', function(event) {
        $(this).valid();
    });
}
/******************************************* FINALIZACION DE VALIDACIONES **********************************************/

//click get pasaporte
$('#buscar-pasaporte').on('click', function(){
    var instcode  = $('#instcode').val();
    var accename= $('#accename').val();
    $('.search-pasaporte').append(create_overlay());
    $.ajax({
        url     :  CK.base_url + 'ajax/get-pasaporte/' + instcode + '/'+ accename,
        type    : 'GET',
        //data    : {instcode: instcode, accename:accename},
        dataType: 'json',
        beforeSend: function(xhr){
            // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        },
        success: function(response){
            console.log("data_: ", response);
            if (response.success) {
                $('#collecname').val(response.data['collcode']);
                $('#spcode').val(response.data['spcode']);
                $('#pasaporte_id').val(response.data['id']);
                $('.result-inputs .form-group').addClass('has-success has-feedback');
            }else{
                $('#collecname').val('');
                $('#spcode').val('');
                $('#pasaporte_id').val('');
                $('.result-inputs .form-group').removeClass('has-success has-feedback');
            }
            $( ".overlay" ).fadeOut(2000);
            $( ".overlay" ).remove();
        },
        error: function(err){console.log("show_error_: ",err.responseText);}
    });
});

function create_overlay() {
    var content = '';
    content +=  '<div class="overlay">';
    content +=  '<div id="floatingBarsG">';
    content +=  '<div class="blockG" id="rotateG_01"></div>';
    content +=  '<div class="blockG" id="rotateG_02"></div>';
    content +=  '<div class="blockG" id="rotateG_03"></div>';
    content +=  '<div class="blockG" id="rotateG_04"></div>';
    content +=  '<div class="blockG" id="rotateG_05"></div>';
    content +=  '<div class="blockG" id="rotateG_06"></div>';
    content +=  '<div class="blockG" id="rotateG_07"></div>';
    content +=  '<div class="blockG" id="rotateG_08"></div>';
    content +=  '</div>';
    content +=  '</div>';
    return content;
}

$(document).on('click', "#CreateBancoInvitro", function (event) {
    //event.preventDefault();
    var temp = false;

    $("#form_banco_invitro").validate({
        errorClass: 'myErrorClass',
        errorElement: "span",
        rules: {
            contaminacion: {
                required: true,
                min: 1
            },
            nro_explantes: {
                required: true
            },
            stock_min: {
                required: true,
            }
        },
        messages: {
            contaminacion: "Ingrese Nombre",
        },
        submitHandler: function (form) {
            if (verify_pasaporte_id()) {
                console.log("enviando_data_form_:");
                form.submit();
            } else {
                $('.alert span').html("Busque un Pasaporte");
                $('.alert').removeClass('d-none');
            }
        },
        highlight: function (element, errorClass, validClass) {
            highlight(element, errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            unhighlight(element, errorClass);
        },
        errorPlacement: function (error, element) {
            errorPlacement(error, element);
        }
    });
    select_change();

});

function verify_pasaporte_id() {
    var pasaporte_id  = $('#pasaporte_id').val();
    var check;
    if ($('#pasaporte_id').val().length === 0) {
        check = false;
    }else{
        check = true;
    }
    return check;
}

/****************************** EFECTO PARA LOS MENSAJES DE SUCCESS Y ERROR ************************************/
$(".alert").fadeTo(4000, 1000).slideUp(1000, function(){
    $(".alert").alert('close');
});

/******************************* INICIO BUSCA especie EN EL BUSQUEDA MAPAS ********************************/
$(document).on('change', "#mapa_coleccion", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detalleidespecie(dep_id);
    } else {
        $("#mapa_especie").html('<option value>[ SELECCIONE ]</option>').trigger('change'); //
    }
});

function load_detalleidespecie(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detalleespeciemapas/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("detalle_especie_: ", response);
            var select = "";
            select += '<option value>[ SELECCIONE ]</option>';
            $.each(response, function (key, value) {
                console.log("detalleespeciemapas[" + key + "]: " + value.descripcion);
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#mapa_especie").html(select).trigger('change');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}
/******************************* FIN BUSCA especie EN EL BUSQUEDA MAPAS  ********************************/

/******************************* INICIO BUSCA NOMBRE COMUN DE ESPECIE - FENOTIPICA********************************/
$(document).on('change', "#feno_coleccion", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        load_detallenombrecomun(dep_id);
    } else {
        $("#feno_especie").html('<option value>-- SELECCIONE --</option>').trigger('change'); //
    }
});

$(document).on('change', "#feno_especie", function () {
    var dep_id = $(this).val();
    if (dep_id !== "") {
        $("#feno_cropname").val(dep_id);
    } else {
        $("#feno_cropname").val("");
    }
});

function load_detallenombrecomun(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detallenombrecomun/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value>-- SELECCIONE --</option>';
            $.each(response, function (key, value) {
                select += '<option value="' + value.idx + '">' + value.descripcion + '</option>';
            });
            $("#feno_especie").html(select).trigger('change');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}
/******************************* FIN BUSCA NOMBRE COMUN DE ESPECIE - FENOTIPICA ********************************/

/******************************* INICIO BUSCA COLECCIONES SEGUN EL RECURSO ********************************/
$(document).on('change', "#resource-id", function () {
    var dep_id = $(this).val();
    if (dep_id !== "0") {
        load_detallerecursos(dep_id);
    } else {
            $("#collection-id").html('<option value="0">[ SELECCIONE ]</option>').trigger('change'); //
        }
    });

function load_detallerecursos(dep_id) {
    $.ajax({
        url: CK.base_url + 'ajax/detallerecursos/' + dep_id,
        type: 'GET',
        data: {id: dep_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            console.log("detalle_recursos_: ", response);
            var select = "";
            select += '<option value="0">[ SELECCIONE ]</option>';
            $.each(response, function (key, value) {
                // console.log("detallerecursos[" + key + "]: " + value.descripcion);
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#collection-id").html(select).trigger('change');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}
/******************************* FIN BUSCA COLECCIONES SEGUN EL RECURSO  ********************************/

//*********************************** INICIO DE MANTENIMIENTO DE CATALOGOS - CARACTERIZACION **************************************/
$(document).on('change', "#catalogo_recurso", function () {
    var recurso_id = $(this).val();
    if (recurso_id !== "0") {
        load_listacolecciones(recurso_id);
    } else {
            $("#catalogo_coleccion").html('<option value="0">[ SELECCIONE ]</option>').trigger('change'); //
            $("#cropname_catalogue").val("");
        }
    });

function load_listacolecciones(recurso_id) {
    $.ajax({
        url: CK.base_url + 'ajax/listacolecciones/' + recurso_id,
        type: 'GET',
        data: {id: recurso_id},
        dataType: 'json',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            var select = "";
            select += '<option value="0">[ SELECCIONE ]</option>';
            $.each(response, function (key, value) {
                // console.log("listacolecciones[" + key + "]: " + value.descripcion);
                select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
            });
            $("#catalogo_coleccion").html(select).trigger('change');
        },
        error: function (err) {
            console.log("show_error_: ", err.responseText);
        }
    });
}

    $(document).on('change', "#catalogo_coleccion", function () {
        var coleccion_id = $(this).val();
        if (coleccion_id !== "0") {
            load_listaespecies(coleccion_id);
        } else {
            $("#catalogo_especie").html('<option value="0">[ SELECCIONE ]</option>').trigger('change'); //
            $("#cropname_catalogue").val("");
        }
    });

    function load_listaespecies(coleccion_id) {
        $.ajax({
            url: CK.base_url + 'ajax/listaespecies/' + coleccion_id,
            type: 'GET',
            data: {id: coleccion_id},
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (response) {
                var select = "";
                select += '<option value="0">[ SELECCIONE ]</option>';
                $.each(response, function (key, value) {
                    // console.log("listaespecies[" + key + "]: " + value.descripcion);
                    select += '<option value="' + value.id + '">' + value.descripcion + '</option>';
                });
                $("#catalogo_especie").html(select).trigger('change');
            },
            error: function (err) {
                console.log("show_error_: ", err.responseText);
            }
        });
    }

    $(document).on('change', "#catalogo_especie", function () {
        var dep_id = $(this).val();
        if (dep_id !== "0") {
            load_nombrecomun_catalogue(dep_id);
        } else {
            $("#cropname_catalogue").val(""); //
        }
    });

    function load_nombrecomun_catalogue(dep_id) {
        $.ajax({
            url     : CK.base_url + 'ajax/getnombrecomun/' + dep_id,
            type    : 'GET',
            data    : {id: dep_id},
            dataType: 'json',
            success : function (response) {
                if(response)
                    $("#cropname_catalogue").val(response.nombre_comun);
            },
            error: function (err) {
                console.log("show_error_: ", err.responseText);
            }
        });
    }

    function sumarpe() {
        var totalpeso = 0;
        $(".mtpeso").each(function() {      
          if (isNaN(parseFloat($(this).val()))) {      
            totalpeso += 0;      
          }else {      
            totalpeso += parseFloat($(this).val());      
          }      
        });      
        //alert(total);
        document.getElementById('spTotal').innerHTML = totalpeso.toFixed(2) +' (g)';
      }

    function sumarca() {
        var totalcant = 0;
        $(".mtcant").each(function() {      
          if (isNaN(parseFloat($(this).val()))) {      
            totalcant += 0;      
          }else {      
            totalcant += parseFloat($(this).val());      
          }      
        });      
        //alert(total);
        document.getElementById('scaTotal').innerHTML = totalcant;
      
      }
//*********************************** FIN DE MANTENIMIENTO DE CATALOGOS - CARACTERIZACION **************************************/

