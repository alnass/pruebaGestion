var tabla;
var tabla2;

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
	listar();
}

// Listar
function listar()
{
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#tbllistado').dataTable({
		// Activar el procesamiento de los datatables

		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		"lengthMenu": true,
		// Definicion de los botones para descargar
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			
			{
				extend: 'pdfHtml5',
            	orientation: 'landscape'
            }

		],
		"ajax":{
			url:'../ajax/consultaUsuarios.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		columnDefs: 
		[
		    { className: 'text-center'}
		],

		"bDestroy": true,
		// Paginacion 
		
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 

}

// Declaracion para ejecucion al iniciar
init();