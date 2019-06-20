/*// # encodé par @Anderson Ferrucho 
*/
var tabla;
var tabla2;

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// // Carga la pagina con el listado de datos de la clase
	listar();


//http://blog.wlacruz.com.ve/2011/11/desplazar-la-pagina-hasta-elemento-html.html

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$("#div-filtro").hide();

	$("#btn-filtro").on('click', function(e){
		window.location.reload();
	});

	// Cargar las opciones de la lista 
	$.post("../ajax/ordenTrabajo.php?op=nuevoestado", function(r){
		$("#ord_trab_operacion_id").html(r);
		$("#ord_trab_operacion_id").selectpicker('refresh');

	})

	$.post("../ajax/ordenTrabajo.php?op=selectTecnico", function(r){
		$("#ord_trab_tecnico_id").html(r);
		$("#ord_trab_tecnico_id").selectpicker('refresh');

	})
}

function listarFiltrado(filtro)
{
	var est_serv = '';

	if(filtro == 1)
	{
		est_serv = 'Por Instalar';		
	}
	else if(filtro == 3)
	{
		est_serv = 'Por Cortar';			
	}
	else if(filtro == 5)
	{
		est_serv = 'Por Reconectar';			
	}
	else if(filtro == 8)
	{
		est_serv = 'Por Suspender';			
	}
	else if(filtro == 9)
	{
		est_serv = 'Mantenimiento';			
	}
	else if(filtro == 11)
	{
		est_serv = 'Corte por retiro';			
	}
	else if(filtro == 12)
	{
		est_serv = 'Por traslado';			
	}
	else if(filtro == 13)
	{
		est_serv = 'Agregar Producto';			
	}
	else if(filtro == 14)
	{
		est_serv = 'Cambiar Producto';			
	}

	alert('Se va a filtrar '+ est_serv);

	$("#div-filtro").show();

	tabla=$('#tbllistado').dataTable({
	// Activar el procesamiento de los datatables
	"aProcessing": true,
	// Paginacion y filtrado realizado por el servidor
	"aServerSide": true,
	select: true,
	// Define los elementos del control de la tabla
	dom: 'Bfrtip',
	// Definicion de los botones para html
	buttons: [
		'copyHtml5',
		'excelHtml5',
		'csvHtml5',
		'pdf'
	],
	"ajax":{
		url:'../ajax/ordenTrabajo.php?op=listar&filtrar=' + filtro,
		type: "get",
		dataType: "json",
		error: function(e){
			console.log(e.responseText);
		}
	},
	"bDestroy": true,
	// Paginacion 
	"iDisplayLength": 5,
	// orden de los datos [[columna, tipo de orden]]
	"order":[[3,"asc"]]
	}).DataTable();	 	
}



// Listar
function listar(){
	
	tabla=$('#listadoOTS').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,

			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// desactiva la busqueda
			searching: false,

			// Definicion de los botones para html
			buttons: [
			],
			"ajax":{
				url:'../ajax/ordenTrabajo.php?op=listarCantidadOts',
				type: "get",
				dataType: "json",
				error: function(e){
					console.log(e.responseText);
				},
			},
			"bDestroy": true,
			// Paginacion 
			"iDisplayLength": 3,
			// orden de los datos [[columna, tipo de orden]]
			"order":[[1,"asc"]]
		}).DataTable();	 	

	if($('#sesion').val() == 30 || $('#sesion').val() == 67)
	{
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,

			// Define los elementos del control de la tabla
			dom: 'Bfrtip',

			// Definicion de los botones para html
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":{
				url:'../ajax/ordenTrabajo.php?op=listar',
				type: "get",
				dataType: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			// Paginacion 
			"iDisplayLength": 5,
			// orden de los datos [[columna, tipo de orden]]
			"order":[[3,"asc"]]
		}).DataTable();	 	
	}
	else
	{
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			select: true,

			// Define los elementos del control de la tabla

			dom: 'Bfrtip',

			// Definicion de los botones para html
			buttons: [
			],
			"ajax":{
				url:'../ajax/ordenTrabajo.php?op=listar',
				type: "get",
				dataType: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			// Paginacion 
			"iDisplayLength": 5,
			// orden de los datos [[columna, tipo de orden]]
			"order":[[3,"asc"]]
		}).DataTable();	 	
	}
}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#ord_trab_id").val("");
	$("#operacion").val("");
	$("#operacion").selectpicker('refresh');
	$("#fecha_program").val("");
	$("#fecha_vence").val("");
	$("#observacion").val("");
	$("#contrato").val("");
}

// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios
	limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#filtros").hide();
		// $("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
		$("#filtros").show();
	}
}

// Calcea el formulario
function cancelarform(){

	limpiar();
	mostrarform(false);
}



// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	// $("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/ordenTrabajo.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			

			bootbox.alert(datos, function(){window.location.replace("seguimientoOT.php");});
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

// Mostrar los datos en los inpts del form
function mostrar(cont_id){
	$.post("../ajax/ordenTrabajo.php?op=mostrar",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);

		if(data == null)
		{
			bootbox.alert('El usuario no tiene productos asociados', function(){location.reload(true)});
		}
		else
		{
			mostrarform(true);	
		}

 		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#numDoc").val(data.per_num_documento);
		$("#nombre").val(data.per_nombre);
		$("#apellido").val(data.per_apellido);
		$("#ciudad").val(data.ciu_nombre);
		$("#direccion").val(data.per_direccion);
		$("#tel1").val(data.per_telefono_1);
		$("#cont_id").val(data.cont_id + '-' + data.cont_no_contrato);
		$("#ord_trab_contrato_id").val(data.cont_id);
		$("#marca").val(data.per_marca);
		$("#alianza").val(data.ali_nombre);
		$("#expedCont").val(data.cont_vigencia_a_partir);
		$("#direcInst").val(data.cont_direccion_serv);
		$("#correoPer").val(data.per_correo_personal);
		$("#tel2").val(data.per_telefono_2);
		$("#tipoVivien").val(data.tip_viv_nombre);
		$("#estado").val(data.est_serv_nombre);
		$("#usuRegCont").val(data.usu_nombre);
		$("#sede").val(data.sed_nombre);
		$("#barrInst").val(data.cont_barrio);
		$("#info_adicional").val(data.cont_adicional);
		$("#ord_trab_tecnico_id").val('');
		$("#ord_trab_operacion_id").val('');

		/// VALIDA EL ESTADO DEL SERVICIO SI ES POR INSTALAR OCULTA LA CASILLA Y ELIMINA EL VALOR
		if(data.est_serv_id == 1)
		{
			$("#operacion").hide("fast");
			$("#ord_trab_operacion_id").val(1);
			$("#ord_trab_operacion_id").removeAttr("required");
		}

		tabla2=$('#tblproducto').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		paging:false,
		// desactiva la busqueda
		searching: false,
		// Modifica el mensaje del contador de registros 
		"language":
		{
			"info": ""
		},
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',
		// Definicion de los botones para html
		buttons: [
		],
		"ajax":{
			url:'../ajax/ordenTrabajo.php?op=listarProductos', 
			data: {cont_id}, // son los datos que se envian a la funcion
			type: "POST", // el metodo por el cual los recibe
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
		// listarProductos(cont_id);

	})

	$.post("../ajax/ordenTrabajo.php?op=llamarObservacion",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);

 		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#observacion_caja").val(data.cc_est_ser_fecha + ' ' + data.usu_nombre + ' ' + data.usu_apellido +  '\n' + data.cc_est_ser_observacion);

	})

	listarEquipoInstalado(cont_id);

}

function listarEquipoDetalle(){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla3=$('#tblequipos').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Definicion de los botones para html
		buttons: [
			],
		"ajax":{
			url:'../ajax/ordenTrabajo.php?op=listarEquipoDetalle',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}

function listarEquipoInstalado(cont_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla4=$('#tblinstalado').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Definicion de los botones para html
		buttons: [
			],
		"ajax":{
			url:'../ajax/ordenTrabajo.php?op=listarEquipoInstalado',
			data: {cont_id},
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}

function asignarEquipo(equi_det_id, equi_tip_nombre, equi_referencia, equi_det_mac, equi_det_sn){

	desplazar();

	var contador = 0;
	var detalles = 0;
	var cantidad = 1;

	if (equi_det_id != "") {

		var fila = '<tr class="filas" id="fila'+contador+'">'+
		'<td><button type="button" data-toggle="tooltip" title="Eliminar Equipo" class="btn btn-danger" onclick="eliminarAsignacion('+contador+')">X</button></td>'+
		'<td><input type="hidden" name="id_detalle_equipo[]" value="'+equi_det_id+'">'+equi_tip_nombre+'</td>'+
		'<td><input type="hidden" name="equipo_referencia[]" value="'+equi_referencia+'">'+equi_referencia+'</td>'+
		'<td><input type="hidden" name="equipo_mac[]" value="'+equi_det_mac+'">'+equi_det_mac+'</td>'+
		'<td><input type="hidden" name="equipo_sn[]" value="'+equi_det_sn+'">'+equi_det_sn+'</td>'+
		'<td><select name="cliente[]" required=""><option value=""></option><option value="1">Si</option><option value="0">No</option></td>'+
		'</tr>';
		contador++;
		detalles++;
		
		$('#tblasignacion').append(fila);
	}else{
		bootbox.alert("Error al asignar el equipo");
	}
}


function desplazar() {
    $('html,body').animate({
        scrollTop: $("#listadoasignados").offset().top
    }, 2000);
};

function eliminarAsignacion(indice){
	$("#fila"+indice).remove();
	detalles = detalles - 1;
}

function fileValidation(){
    var fileInput = document.getElementById('file-1');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

// Declaracion para ejecucion al iniciar
init();