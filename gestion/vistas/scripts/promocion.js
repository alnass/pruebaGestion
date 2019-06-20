var tabla;

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// Carga la pagina con el listado de datos de la clase
	listar();

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$("#filtro").change(function(){
		listar();
	})	
}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#prom_id").val("");
	$("#nom_corto").val("");
	$("#desc").val("");
	
}

// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios
	limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#btnGuardar").prop("disabled",false);
		$("#funcion").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#funcion").show();
	}
}

// Calcea el formulario
function cancelarform(){

	limpiar();
	mostrarform(false);
}

// Listar
function listar()
{
	filtro = $("#filtro").val();
	// alert(filtro);
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
			url:'../ajax/promocion.php?op=listar&filtro='+filtro,
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

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/promocion.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

// Mostrar los datos en los inpts del form
function mostrar(prom_id){
	$.post("../ajax/promocion.php?op=mostrar",{prom_id : prom_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#prom_id").val(data.prom_id);
		$("#codigo").val(data.prod_codigo);
		$("#prefijo").val(data.prod_prefijo);
		$("#nombre").val(data.prod_nombre);
		$("#desc").val(data.prod_descripcion);
		$("#valor").val("$ "+number_format(data.prod_valor));
		$("#valorptopago").val("$ "+number_format(data.prod_valor_pronto_pago));
		$("#stock").val(data.prod_stock);

	})
		$.post("../ajax/promocion.php?op=permisos&id="+prom_id, function(r){
		$("#permisos").html(r);
	});
}
// Dar formato numerica
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

// Funcion para desactivar un registro
function desactivar(prom_id){
	bootbox.confirm("¿Esta seguro de desactivar el promocion?",function(result){
		if (result) {
			$.post("../ajax/promocion.php?op=desactivar", {prom_id : prom_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(prom_id){
	bootbox.confirm("¿Esta seguro de activar el promocion?",function(result){
		if (result) {
			$.post("../ajax/promocion.php?op=activar", {prom_id : prom_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


// Declaracion para ejecucion al iniciar
init();