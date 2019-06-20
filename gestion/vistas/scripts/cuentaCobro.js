var tabla;

function init(){
	listar();

	$.post("../ajax/cuentaCobro.php?op=listar_sede", function(r){
		$("#sede").html(r);
		$("#sede").selectpicker('refresh');
	})


$("#masivo").click(function()
	{
		var sede = $("#sede").val();
		// alert(sede);
		masivo(sede);
	});
}


function listar(){
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
			url:'../ajax/cuentaCobro.php?op=listar',
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

function masivo(valor)
{
	location.href = "../reportes/cobroDuoFinal.php?sede="+valor;
}

init();