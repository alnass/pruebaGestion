var tabla;
// # encoded by @Francisco Monsalve

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

//Cargar las opciones del la lista 
	$.post("../ajax/recaudo.php?op=selectNotaDebito", function(r){
		$("#concepto").html(r);
		$("#concepto").selectpicker('refresh');
	})


}
 		 
function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion

	$("#cont_id").val("");
	$("#no_contrato").val("");
	$("#suscriptor").val("");
	$("#no_documento").val("");
	$("#telefono").val("");
	$("#estado_servicio").val("");
	$("#mensualidad").val("");
	$("#saldoanterior").val("");
	$("#cargoactual").val("");
	$("#valorapagarsindct").val("");
	$("#v_prontopago").val("");
	$("#prontopago").val("");
	$("#valorapagar").val("");
	$("#recaudo").val("");
	$("#no_comprobante").val("");
	$("#fecha_comprobante").val("");


}

// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
		$("#recaudo").focus();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

// Calcea el formulario
function cancelarform(){

	limpiar();
	mostrarform(false);
	location.reload(true);
}

// Listar
function listar(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tbllistado').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'frtip',

		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/recaudo.php?op=listar',
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
		"order":[[7,"desc"]]
	}).DataTable();	 
}

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/recaudo.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos, function(){location.reload(true)});
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}


// Mostrar los datos en los inpts del form
function mostrar(cont_id){

	// Se declara la variable para vlidacion de aplicacion del pronto pago
	var dias_pp 	= '';// Captura la cantidad de dias de pronto pago de la tabla contrato
	var pron_pp 	= '';// Valor CON formato mostrado en el input del pronto pago 
	var ptopago 	= '';// valor SIN formato de pronto pago para operar
	var saldactual 	= '';// Saldo obtenido de la tabla est_cta_saldo_actual
	var v_pagar 	= '';// Valor operado entre saldoactual y ptopago
	var sede_pp 	= '';
	var sald_pp 	= '';
	var hoy = new Date();// Se obtiene la fecha actual del sistema
	var dd = hoy.getDate();// Dia actual obtenido para validar la vigencia del pto pago

	$.post("../ajax/recaudo.php?op=mostrar",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form

		// Validacion de los productos obtenidos del contrato
		if (data.cont_tv_analogica == 1) {
			var analogica = "TV Analogica";
		}else{ analogica = "";}
		if (data.cont_tv_digital == 1) {
			var digital = "TV Digital";
		}else{digital = "";}
		if (data.cont_internet == 1) {
			var internet = "Internet";
		}else{internet = "";}

		var servicio = analogica+"  "+digital+"  "+internet;
		dias_pp = data.cont_max_dias_pago;
		
// Impementacion de metodo para listar registros

		$("#cont_id").val(data.cont_id);
		$("#persona_id").val(data.per_id);
		$("#no_contrato").val(data.cont_no_contrato+'-'+data.cont_id);
		$("#suscriptor").val(data.per_nombre+' '+data.per_apellido);
		$("#no_documento").val(data.per_num_documento);
		$("#telefono").val(data.per_telefono_1);
		$("#estado_servicio").val(data.cont_estado_servicio_id);
		$("#mensualidad").val(data.cont_minimo_mensual);
		$("#f_mensualidad").val('$ '+number_format(data.cont_minimo_mensual, 0));
		$("#servicio").val(servicio);
		// $("#dias").val(data.cont_max_dias_pago);

	});
	$.post("../ajax/recaudo.php?op=saldos",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
// Impementacion de metodo para listar registros
		saldactual = data.est_cta_saldo_actual;
		f_saldoactual = '';

		var saldo_anterior 	= data.est_cta_saldo_anterior;

		if(saldactual < 0){
			f_saldoactual = "SALDO A FAVOR";
		}else{
			f_saldoactual = '$ ' + number_format(saldactual);
		}


		if (saldo_anterior < 0) {
			saldo_anterior = "SALDO A FAVOR";
		}else{
			saldo_anterior = '$ ' + number_format(saldo_anterior);
		}

		$("#saldoanterior").val(data.est_cta_saldo_anterior);
		$("#f_saldoanterior").val(saldo_anterior);

		$("#cargoactual").val(data.est_cta_haber);
		$("#f_cargoactual").val('$'+number_format(data.est_cta_haber, 0));


		$('#valorapagarsindct').val(data.est_cta_saldo_actual);
		$('#f_valorapagarsindct').val(f_saldoactual);
	});


	$.post("../ajax/recaudo.php?op=prontopago",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
// Impementacion de metodo para listar registros


		if (dd > dias_pp) {
			pron_pp = "FUERA DE FECHA";
			ptopago = 0;
		}
		else if(saldactual == "SALDO A FAVOR" || saldactual == 0){
			pron_pp = "SIN SALDO A PAGAR";
			ptopago = 0;
		}
		else{
			pron_pp = '$ '+number_format(data.prod_valor_pronto_pago, 0);
			ptopago = data.prod_valor_pronto_pago;
		}

		v_pagar = saldactual - ptopago;
		
		if(v_pagar < 0){
			var	val_pagar = "SALDO A FAVOR";
		}else{
			val_pagar = '$ ' + number_format(v_pagar);
		}

		$("#f_prontopago").val(pron_pp);
		$("#prontopago").val(ptopago);
		// $("#dias").val(dd);
		// $("#valorapagar").val(data.);
		$('#valorapagar').val(v_pagar);
		$('#f_valorapagar').val(val_pagar);
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

function listarestadocuenta(cont_id){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblestadocta').dataTable({
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

// Funcion para desactivar un registro
function desactivar(per_id){
	bootbox.confirm("¿Esta seguro de desactivar la persona?",function(result){
		if (result) {
			$.post("../ajax/recaudo.php?op=desactivar", {per_id : per_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(per_id){
	bootbox.confirm("¿Esta seguro de activar la persona?",function(result){
		if (result) {
			$.post("../ajax/recaudo.php?op=activar", {per_id : per_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


// Declaracion para ejecucion al iniciar
init();