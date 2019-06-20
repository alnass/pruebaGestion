var tabla;
var efect;
var salida;
var saldo;

function init () {

	$.post("../ajax/reporteCaja.php?op=selectSede",function(r){
		$("#sede").html(r);
		$("#sede").selectpicker('refresh');
	});


	listar();

	$("#formulario").on("submit",function(e){
	guardar(e);
	});


	$("#fecha_inicio").change(listar);

	$("#sede").change(listar);


}



function listar (){
	var fecha_inicio	= $("#fecha_inicio").val();
	var sede	= $("#sede").val();


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
			url:'../ajax/reporteCaja.php?op=listar',
			data:{fecha_inicio:fecha_inicio, sede:sede},
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

	$.post("../ajax/reporteCaja.php?op=efectivoDia", {fecha_inicio:fecha_inicio, sede:sede},function(data, status){
		data = JSON.parse(data);
		$("#totalEfectivo").html('$'+number_format(data.efectivo),0);
	});

	$.post("../ajax/reporteCaja.php?op=totalSalidasDia",{fecha_inicio:fecha_inicio, sede:sede}, function(data, status){
		data = JSON.parse(data);
		$("#totalSalida").html('$'+number_format(data.totalDia),0);
	});

	salida = $.post("../ajax/reporteCaja.php?op=saldoDia",{fecha_inicio:fecha_inicio, sede:sede}, function(data, status){
		data = JSON.parse(data);
		$("#saldoEfectivo").html('$'+number_format(data),0);
		
	});
	salida = $.post("../ajax/reporteCaja.php?op=efecGeneral",{fecha_inicio:fecha_inicio, sede:sede}, function(data, status){
		data = JSON.parse(data);
		$("#efectivoGeneral").html('$'+number_format(data),0);
		
	});
}


function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

init();