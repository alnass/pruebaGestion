var tabla;

function init(){

$("#fecha_inicio").change(listarpostcierre);
$("#fecha_fin").change(listarpostcierre);
mostrarform(false);
listarpostcierre()

}
// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios


	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#btnGuardar").prop("disabled",false);
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
	}
}

// Calcea el formulario
function cancelarform(){

	mostrarform(false);
	// location.reload(true);
}

function listarestadocuenta(cont_id){
	mostrarform(true);
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	var nombre = $("#suscriptor").val();


	tabla=$('#tblestadocta').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Definicion de los botones para html
		buttons: [
			// 'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			// {
   //              extend: 'pdf',
   //              text: 'PDF',
   //              title: 'Estado de cuenta',
   //              message: 'Nombre : $'+nombre+'\nDocumento: ',
   //          },
		],
		"ajax":{
			url:'../ajax/recaudo.php?op=listarestadocuenta',
			type: "post",
			dataType: "json",
			data:{cont_id:cont_id},
			error: function(e){
				console.log(e.responseText);
			}
		},
		"columnDefs": [
            // cambiar el color del contenido de una columa 
            {
              	"targets": [5], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:orange;'>" + data + "</span>";
              	}
          	},
          	{
              	"targets": [6], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:red;'>" + data + "</span>";
              	}
          	},
          	{
              	"targets": [7], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:green;'>" + data + "</span>";
              	}
          	}
          	
        ],
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"desc"]]
	}).DataTable();	 
}

function listarpostcierre(){

	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_inicio").val();

	

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
			url:'../ajax/operacionesAdmin.php?op=listarpostcierre',
			data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin},
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
		"order":[[0,"asc"]]
	}).DataTable();
}



init();