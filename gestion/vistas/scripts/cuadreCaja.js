var tabla;
var efect;
var salida;
var saldo;

$("#tipo_salida").change(function(){validarSalida()});

function init () {

	$.post("../ajax/cuadreCaja.php?op=selectTipoSalida",function(r){
		$("#tipo_salida").html(r);
		$("#tipo_salida").selectpicker('refresh');
	});

	listar();

	$("#formulario").on("submit",function(e){
		if(fileValidation())
		{
			guardar(e);
		}

	});
	
	$.post("../ajax/cuadreCaja.php?op=efectivoDia", function(data, status){
		data = JSON.parse(data);
		$("#totalEfectivo").html('$'+number_format(data.efectivo),0);
	});

	$.post("../ajax/cuadreCaja.php?op=totalSalidasDia", function(data, status){
		data = JSON.parse(data);
		$("#totalSalida").html('$'+number_format(data.totalDia),0);
	});

	salida = $.post("../ajax/cuadreCaja.php?op=saldoDia", function(data, status){
		data = JSON.parse(data);
		$("#saldoEfectivo").html('$'+number_format(data),0);
		
	});
	salida = $.post("../ajax/cuadreCaja.php?op=efecGeneral", function(data, status){
		data = JSON.parse(data);
		$("#efectivoGeneral").html('$'+number_format(data),0);
		
	});
}

function validarSalida()
{
	var salida = $("#tipo_salida").val();

	if(salida == 1 || salida == 2 || salida == 6 || salida == 7 || salida == 8 || salida == 10 || salida == 13 || salida == 12 || salida == 14 )
	{
		$("#no_doc").prop('disabled', true);

		$.ajax({
				type: "GET",
		        dataType: 'html',
				url: "../ajax/cuadreCaja.php?op=llamar_ids&idsalida="+salida,
		        success: function(resp){
		        $('#no_doc').val(resp);
				}
			});
	}
	else
	{
		$("#no_doc").prop('disabled', false);		
	}
}

function limpiar(){
	$('#tipo_salida').val("");
	$('#no_doc').val("");
	$('#descripcion').val("");
	$('#valor').val("");
}

function guardar(e){
	// No se activara la accion predeterminada del evento submit

	var salida = $("#tipo_salida").val();

	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	bootbox.confirm("¿Esta seguro de registrar esta salida?", function(r){
		if (r) {
			$.ajax({
				url: "../ajax/cuadreCaja.php?op=guardar&idsalida="+salida,
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				// Si la funcion se ejecuta de forma correcta
				success: function(datos){
					// Muestra los datos de reapuesta provenientes de ajax
					bootbox.alert(datos);
					// mostrarform(false);
					// tabla.ajax.reload();
					location.reload();
				}
			});
		}else {
			location.reload();
		}
	})
	limpiar();
}

function listar (){
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
			url:'../ajax/cuadreCaja.php?op=listar',
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

// debut maintenance
function fileValidation(){
    var fileInput = document.getElementById('imagen');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor ingrese un archivo valido.');
        alert('! NO HA PODIDO REALIZARSE EL REGISTRO ¡');
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
        return true;
    }
}

// fin maintenance
init();