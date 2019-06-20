var tabla;
function init(){

	listar();
}
function listar(){
	tabla=$('#tbllistado').dataTable({
	// Activar el procesamiento de los datatables
	"aProcessing": true,
	// Paginacion y filtrado realizado por el servidor
	"aServerSide": true,
	// Define los elementos del control de la tabla
	dom: 'Bfrtip',

	//Definicion de los botones para html
	buttons: [
		'copyHtml5',
		'excelHtml5',
		'csvHtml5',
		'pdf'
	],
		"ajax":{
			url:'../ajax/bdGeneral.php?op=listar',
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
		"order":[[9,"desc"]]
	}).DataTable();	 	
}
init();