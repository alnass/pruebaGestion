var tabla;

function init(){

	listarsede();
	se_listar();

	$("#formulario").on("submit",function(e){
		facturar(e);
	})
	
}

function listarsede(){
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
			url:'../ajax/operacionesAdmin.php?op=listarsede',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}

function activarrecaudo(cierre_id){
	$.post("../ajax/operacionesAdmin.php?op=activarrecaudo", {cierre_id : cierre_id}, function(e){
		bootbox.alert(e);
		tabla.ajax.reload();
	});
}

function desactivarrecaudo(cierre_id){
	$.post("../ajax/operacionesAdmin.php?op=desactivarrecaudo", {cierre_id : cierre_id}, function(e){
		bootbox.alert(e);
		tabla.ajax.reload();
	});
}


function facturar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/operacionesAdmin.php?op=facturar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		beforeSend:function(objeto){
			$('#carga').css({display:'block'});
			$('#btncargar').css({display:'none'});
		},

		complete:function(){$('#carga').css('display','none');},
		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos);
			// window.location.href ="../respaldosdb/backupdb.php";
			
		}

	});
	
}

function se_listar(){
	tabla=$('#tbllistado_es').dataTable({
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
			url:'../ajax/operacionesAdmin.php?op=se_listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}


init();