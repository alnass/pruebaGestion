// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho
// funcion que se ejecuta siempre al iniciar
/*-----------------------------------------
 |			VARIABLES GLOBALES 				|
 ------------------------------------------*/

var img = 0;
var tabla;

	/*	---------------------------------------------------------------------------------------------------------------- 
	  |	Declaracion de variables para cargar los productos y sus detalles son globales y se utilizan en otras funciones	|
	  	----------------------------------------------------------------------------------------------------------------*/
	var impuesto 	=	 19;
	var contador 	=	 0;
	var detalles 	=	 0;
	var desc_total 	=	 0;
	// arreglo para almacenar los prefijos de producto que tiene el contrato
	var prefijos 	=	 new Array();
	var TVA = '';
	var INT = '';	

	/*-------------------------------------------------------------------------------------------
	|  variables para ser usadas en las funciones para mostrar y modificar los datos de producto |
	 --------------------------------------------------------------------------------------------*/

	// variables para procesar cambios de producto
	var prefijos_datatable = new Array();
	var conteo 	= 0;
	var id_row 	= 0;
	var fila 	= 0;

	/*---------------------------------------------------------------------- 
	|	variables que almacenan los cambios en el pago total del contrato 	|
  	 -----------------------------------------------------------------------*/
	var total_mensual	= 		0;
	var id = '';
	var id_tr = Array();

/*-----------------------------------------
 |			FIN	VARIABLES GLOBALES 			|
 ------------------------------------------*/

/*-----------------------------------------
 |		FUNCIONES AL CARGAR VENTANA 		|
 ------------------------------------------*/
function init(){
	
// hace referncia a otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
	$("#form-agregar-producto").hide();
	$("#nuevos_product").hide();
	$("#update_cont").hide();
	$("#produc_elimin").hide();
// Carga la pagina con el listado de datos de la clase
	listar();


	$("#btnAgregarProductoCont").on('click', function(e){halarDataTable();});

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$("#canelForm2").on("click",function(e){
		cancelarform2(e);
	})

	// identifica la cantidad imagenes cargadas en el input y crea una variable de control
	$("#file-1").change(function(){
			img = this.files.length;
		});

	$("#update_cont").on("click",function(e){

			if(img > 0)
			{
				if(fileValidation())
				{
					actualizarContrato(e);
				}
			}
			else
			{
				bootbox.alert('Falta insertar la imagen de evidencia');
				$("#file-1").focus();
			}
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoPersona", function(r){
		$("#tipoPersona").html(r);
		$("#tipoPersona").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoCiente", function(r){
		$("#tipoCliente").html(r);
		$("#tipoCliente").selectpicker('refresh');
	})
// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoDocumento", function(r){
		$("#tipoDoc").html(r);
		$("#tipoDoc").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoVivienda", function(r){
		$("#tipoVivien").html(r);
		$("#tipoVivien").selectpicker('refresh');
	})
// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoVivienda", function(r){
		$("#conttipvivi").html(r);
		$("#conttipvivi").selectpicker('refresh');
	})
}
 		 
function limpiar()
{
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#per_id").val("");
	$("#tipoPersona").val("");
	$("#tipoCliente").val("");
	$("#alianza").val("");
	$("#tipoDoc").val("");
	$("#numDoc").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#tel1").val("");
	$("#tel2").val("");
	$("#ciudad").val("");
	$("#barrio").val("");
	$("#tipoVivien").val("");
	$("#direccion").val("");
	$("#correoPer").val("");
	$("#cont_id").val("");  				
	$("#no_contrato").val(""); 			
	$("#persona_id").val(""); 			
	$("#direccion_serv").val(""); 		
	$("#estrato").val(""); 				
	$("#minimo_mensual").val(""); 		
	$("#renovacion_auto").val(""); 		
	$("#tv_analogica").val(""); 			
	$("#tv_digital").val(""); 			
	$("#internet").val(""); 				
	$("#adicional").val(""); 			
	$("#valor_basico_mes").val(""); 		
	$("#valor_total_mes").val(""); 		
	$("#permanencia").val(""); 			
	$("#cargo_conexion").val("550000"); 		
	$("#valor_diferido").val("0"); 		
	$("#costo_reconexion").val("15000"); 		
	$("#fecha_transaccion").val(""); 	
	$("#usuario_id").val(""); 	
	$("#cargo_adicional").val("");		
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
		$("#btnAgregar").hide();
		listarActivos();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

function verform2(cont_id, nombre, apellido, direccion, mensual, tva, tvd, int)
{
	$("#listadoregistros").hide();
	$("#form-agregar-producto").show();
	$("#btnAgregar").hide();
	$("#contrat_id").val(cont_id);
	$("#tva").val(tva);
	$("#tvd").val(tvd);
	$("#int").val(int);
	$("#mens_ant").val(mensual);
	$("#datos_contrato").text('Contrato No. ' + cont_id);
	$("#nombres").text('CLIENTE: ' + nombre + ' ' + apellido);
	$("#direc").text('DIRECCION: ' + direccion);
	listarActivos();
	var contarTV = 1;

	tabla2=$('#tblproduc').dataTable({
		// actua antes de crear una fila
		"createdRow": function(row, data, td, dataIndex) 
	    {
	    	// alert(data[5]);

		    if(data[3] == 'TVA')
		    {
		    	if(contarTV > 1)
		    	{
			    	// row es el tr
			    	$(row).removeAttr("id");
			    	$(row).attr("id","TVA"+contarTV);
		    	}
			    contarTV++;
		    }
		},
		// Activar el procesamiento de los datatables
		select: true,
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
	    // ASIGNA UN ID A LA FILA SEGUN EL VALOR OBTENIDO DEL JSON 
	    rowId: 3,
		// Definicion de los botones para html
		buttons: [
		],
		"ajax":{
			url:'../ajax/contrato.php?op=listarProductos', 
			data: {cont_id}, // son los datos que se envian a la funcion
			type: "POST", // el metodo por el cual los recibe
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			},
		},
		"columnDefs": [
	          	{
	          	  	"targets": [3],
			        'createdCell': function(data, td, cellData) 
	              	{ // Asigna el contenido del data
	              		prefijos_datatable.push(td);
	              		
	              		if(prefijos_datatable.includes('INT'))
	              		{
	              			if(prefijos_datatable.includes('TVA'))
	              			{
	              				$("#btnAgregarProductoCont").hide();
	              			}
	              		}
	              	},
	          	},
	          	{
	          		"targets": [5],
	                "searchable": false
	            }
	    ],
					
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[4,"desc"]]
	}).DataTable();	
}

// Calcea el formulario
function cancelarform()
{
	limpiar();
	mostrarform(false);
	location.reload(true);
}

// Listar el total de contratos
function listar(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
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
			url:'../ajax/contrato.php?op=listar',
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

// Listar los productos activos 
function listarActivos()
{
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblproductos').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'frtip',

		"ajax":{
			url:'../ajax/contrato.php?op=listarPorSede',
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
		"order":[[1,"desc"]]
	}).DataTable();	 
}

// guardar y editar un nuevo contrato 
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/contrato.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos, function(){location.reload(true)});
			mostrarform(false);
			//tabla.ajax.reload();
		}
	});
	limpiar();
}

// Mostrar los datos en los inpts del form de nuevo contrato
function mostrar(cont_id){
	$.post("../ajax/contrato.php?op=mostrar",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		// Impementacion de metodo para listar registros
		$("#per_id").val(data.per_id);
		$("#prefijo").val(data.per_prefijo);
		$("#marca").val(data.per_marca);
		$("#precinto").val(data.per_precinto);
		$("#tipoPersona").val(data.per_tipo_persona_id);
		$("#tipoPersona").selectpicker('refresh');
		$("#tipoCliente").val(data.per_tipo_cliente_id);
		$("#tipoCliente").selectpicker('refresh');
		$("#alianza").val(data.per_alianza_id);
		$("#alianza").selectpicker('refresh');
		$("#tipoDoc").val(data.per_tipo_documento_id);
		$("#tipoDoc").selectpicker('refresh');
		$("#numDoc").val(data.per_num_documento);
		$("#expedDoc").val(data.per_fecha_exped_doc);
		$("#nombre").val(data.per_nombre);
		$("#apellido").val(data.per_apellido);
		$("#nacimiento").val(data.per_fecha_nacimiento);
		$("#tel1").val(data.per_telefono_1);
		$("#tel2").val(data.per_telefono_2);
		$("#ciudad").val(data.per_ciudad_id);
		$("#ciudad").selectpicker('refresh');
		$("#barrio").val(data.per_barrio);
		$("#tipoVivien").val(data.per_tipo_vivienda_id);
		$("#tipoVivien").selectpicker('refresh');
		$("#direccion").val(data.per_direccion);
		$("#correoPer").val(data.per_correo_personal);
		$("#correoCorp").val(data.per_correo_corp);
		$("#usuario").val(data.per_usuario);
		$("#pass").val(data.per_contrasenia);

	})
}


function agregarDetalle(prod_id, prod_nombre, prod_descripcion,prod_valor, prod_prefijo, prod_descuento)
{
	// VARIABLES PARA CONTROLAR DATOS DE NUEVO CONTRATO
	TVA = $("#TVA").val();
	INT = $("#INT").val();

	// VALIDACION DE PRODUCTOS REGISTRADOS PARA UN CONTRATO NUEVO. 
	if(prefijos.length > 1)
	{
		var countPrfjo 	= 	0;
		var prefjTVA 	= 	0;
		var prefjINT 	= 	0;
		var prefjTVD 	= 	0;
		
		while(countPrfjo < prefijos.length)
		{
			if(prefijos[countPrfjo] == 'TVA')
			{
				prefjTVA++;
			}
			if(prefijos[countPrfjo] == 'INT')
			{
				prefjINT++;
			}
			if(prefijos[countPrfjo] == 'TVD')
			{
				prefjTVD++;
			}

			countPrfjo++;
		}	
	}
	
	// VALIDACION DE PRODUCTOS REGISTRADOS PARA UN CONTRATO ACTIVO. 
	var countPrfjoDT 	= 	0;
	var prefjTVADT 		= 	0;
	var prefjINTDT 		= 	0;
	var prefjTVDDT 		= 	0;
	
	while(countPrfjoDT < prefijos_datatable.length)
	{
		if(prefijos_datatable[countPrfjo] == 'TVA')
		{
			prefjTVADT++;
		}
		if(prefijos_datatable[countPrfjo] == 'INT')
		{
			prefjINTDT++;
		}
		if(prefijos_datatable[countPrfjo] == 'TVD')
		{
			prefjTVDDT++;
		}

		countPrfjoDT++;
	}
	
	// MENSAJES EN CASO DE QUE ALGUNA DE LAS ANTERIORES VALIDACIONES SEA CORRECTA
	if(prefjTVADT > 1 && prod_prefijo == 'INT' || prefjTVA > 1 && prod_prefijo == 'INT')
	{
		bootbox.alert('<h1><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></h1><h4>No se puede asignar un combo a un contrato con mas de 1 producto de TV activo, para asignar combo debe crear un nuevo contrato o retirar un producto</h4>');
	}
	else if(prefjINTDT > 1 && prod_prefijo == 'TVA' || prefjINT > 1 && prod_prefijo == 'TVA')
	{
		bootbox.alert('<h1><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></h1><h4>No se puede asignar un combo a un contrato con mas de 1 producto de INTERNET activo, para asignar combo debe crear un nuevo contrato o retirar un producto</h4>');
	}
	else if(prefjTVDDT > 1 && prod_prefijo == 'INT' || prefjTVD > 1 && prod_prefijo == 'INT')
	{
		bootbox.alert('<h1><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></h1><h4>No se puede asignar un combo a un contrato con mas de 1 producto de TV Digital activo, para asignar combo debe crear un nuevo contrato o retirar un producto</h4>');
	}
	else
	{// EN CASO DE QUE LAS ANTERIORES VALIDACIONES NO SEAN CORRECTAS 
		if(TVA != undefined)
		{
			var btnAddProdct = '#btnAgregarProductoCont'
			var tablaDetalle = '#tbldetalle2';
			var total_prod 	 = '#total2';
			var mensualidad	 = '#minimo_mensual_adc';
		}
		else if(INT != undefined)
		{
			var btnAddProdct = '#btnAgregarProductoCont'
			var tablaDetalle = '#tbldetalle2';
			var total_prod 	 = '#total2';
			var mensualidad	 = '#minimo_mensual_adc';
		}
		else
		{
			var btnAddProdct = '#btnAgregarProducto'
			var tablaDetalle = '#tbldetalle';
			var total_prod 	 = '#total'
			var mensualidad	 = '#minimo_mensual';
		}

		var cantidad = 1;
		// almacenamiento de registros de descuento
		desc_total = desc_total+prod_descuento;
		// alert(desc_total);

		if (prod_id != "") 
		{	
			/*	-------------------------------------------------------------------- 
			  | Condicional para limitar un número máximo de productos por contrato	|
			  	--------------------------------------------------------------------*/
			/*MAINTENANCE */
			if(detalles >= 2)
			{
				$(btnAddProdct).hide();
				bootbox.alert('Ha asignado el número máximo de productos por contrato');
				$("#myModal").modal('hide');
			}
			$("#nuevos_product").show();

			// asigna el valor del nuevo prefijo al array de prefijos
			prefijos.push(prod_prefijo);
			/*FIN MAINTENANCE */
			var subtotal = cantidad * prod_valor;

			var fila = '<tr class="filas" id="fila'+contador+'">'+
			'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+contador+')">X</button></td>'+
			'<td><input type="hidden" name="cont_prod_producto_id[]" value="'+prod_id+'">'+prod_id+'</td>'+
			'<td><input type="hidden" name="prod_nombre[]" value="'+prod_nombre+'">'+prod_nombre+'</td>'+
			'<td><input type="hidden" name="prod_descripcion[]" value="'+prod_descripcion+'">'+prod_descripcion+'</td>'+
			'<td><input type="hidden" name="cont_prod_cantidad[]" id="cantidad" value="'+cantidad+'">'+cantidad+'</td>'+
			'<td><input type="hidden" name="cont_prod_precio[]" id="prod_valor" value="'+prod_valor+'">'+prod_valor+'</td>'+
			'<td><span name="subtotal" id="subtotal'+contador+'">'+subtotal+'</td>'+
			'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
			'<input type="hidden" name="prefijo[]" value="'+prod_prefijo+'">'+
			'</tr>';

			contador++;
			detalles++;

			$(tablaDetalle).append(fila);
			modificarSubtotales();

			// analisis de datos para validar productos y asignar descuentos
			/*MAINTENANCE */
			if(prefijos.length > 1)
			{	// verifica los prefijos insertados
				if(prefijos.includes('TVA'))
				{	// verifica si dentro del array existe uno con internet
					if(prefijos.includes('INT'))
					{
						// alert(prefijos.join());
						var subtotal = cantidad * prod_descuento;
						// crea la fila con el descuento correspondiente
						var fila = '<tr class="filas" id="fila'+contador+'">'+
						'<td></td>'+
						'<td></td>'+
						'<td><input type="hidden" name="prod_nombre[]" value="Descuento">Descuento</td>'+
						'<td><input type="hidden">Descuento por combo '+prefijos.join()+'</td>'+
						'<td><input type="hidden" name="cont_prod_cantidad[]" id="cantidad" value="'+cantidad+'">'+cantidad+'</td>'+
						'<td><input type="hidden" name="cont_prod_precio[]" id="prod_dsc_valor" value="'+desc_total * -1+'">'+desc_total * 1+'</td>'+
						'<td><span name="subtotal" id="subtotal'+contador+'">'+subtotal+'</td>'+
						'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
						'</tr>';
						contador++;
						detalles++;

						$(tablaDetalle).append(fila);
						modificarSubtotales();
						// limita el máximo combos por contrato
						if(detalles >= 3)
						{
							$(btnAddProdct).hide();
							bootbox.alert('Ha asignado el número máximo de combos por contrato');
							$("#myModal").modal('hide');
						}
					}
				}
				else 
				{
					if(prefijos.includes('TVA'))
					{
						var subtotal = cantidad * prod_descuento;
						// crea la fila con el descuento correspondiente
						var fila = '<tr class="filas" id="fila'+contador+'">'+
						'<td></td>'+
						'<td></td>'+
						'<td><input type="hidden" name="prod_nombre[]" value="Descuento">Descuento</td>'+
						'<td><input type="hidden">Descuento por combo '+prefijos.join()+'</td>'+
						'<td><input type="hidden" name="cont_prod_cantidad[]" id="cantidad" value="'+cantidad+'">'+cantidad+'</td>'+
						'<td><input type="hidden" name="cont_prod_precio[]" id="prod_dsc_valor" value="'+desc_total * -1+'">'+desc_total * 1+'</td>'+
						'<td><span name="subtotal" id="subtotal'+contador+'">'+subtotal+'</td>'+
						'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
						'</tr>';
						contador++;
						detalles++;

						$(tablaDetalle).append(fila);
						modificarSubtotales();
						// limita el máximo combos por contrato
						if(detalles >= 3)
						{
							$(btnAddProdct).hide();
							bootbox.alert('Ha asignado el número máximo de combos por contrato');
							$("#myModal").modal('hide');
						}
					}	
				}
			}
			/*FIN MAINTENANCE */
			$("#update_cont").show();
		}
		else
		{
			bootbox.alert("Error al ingresar el producto");
		}
	}
}

function modificarSubtotales(){

	var cant 	= 	document.getElementsByName("cont_prod_cantidad[]");
	var prec 	= 	document.getElementsByName("cont_prod_precio[]");
	var sub  	= 	document.getElementsByName("subtotal");
	var ant_prc	= 	document.getElementsByName("antg_cont_prod_precio[]");
	var ant_can	= 	document.getElementsByName("antg_cont_prod_cantidad[]");
	var ant_sub	= 	document.getElementsByName("antg_subtotal");

	// ADICION A CONTRATO
	for (var i = 0; i < ant_can.length; i++) 
	{
		var ant_inpC = ant_can[i];
		var ant_inpP = ant_prc[i];
		var ant_inpS = ant_sub[i];
		ant_inpS.value = ant_inpC.value * ant_inpP.value;
		document.getElementsByName('antg_subtotal')[i].innerHTML = ant_inpS.value;

	}
	// NUEVO CONTRATO
	for (var i = 0; i < cant.length; i++) 
	{
		var inpC = cant[i];
		var inpP = prec[i];
		var inpS = sub[i];
		inpS.value = inpC.value * inpP.value;
		document.getElementsByName('subtotal')[i].innerHTML = inpS.value;

	}

	calcularTotales();
}

function calcularTotales()
{
	if(TVA != undefined)
	{
		var total_prod 	 = '#total2';
		var mensualidad	 = '#minimo_mensual_adc';
	}
	else if(INT != undefined)
	{
		var total_prod 	 = '#total2';
		var mensualidad	 = '#minimo_mensual_adc';	
	}
	else
	{
		var total_prod 	 = '#total'
		var mensualidad	 = '#minimo_mensual';
	}

	var sub 	= 	document.getElementsByName("subtotal");
	var total 	= 	0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}

	var ant_sub 	= 	document.getElementsByName("antg_subtotal");

	for (var b = 0; b < ant_sub.length; b++) {
		total += document.getElementsByName("antg_subtotal")[b].value;
	}
		// $("#total").html("$ "+ total);
		// $("#minimo_mensual").val(total);
		
		$(total_prod).html("$ "+ total);
		$(mensualidad).val(total);

	evaluar();
}

function evaluar(){

	if (detalles > 0) {
		$("#btnGuardar").show();
	}else{
		$("#btnGuardar").hide();
		contador = 0;
	}
}

function eliminarDetalle(indice)
{
	/* MAINTENANCE */
	if(prefijos.length > 1)
	{
		/*FIN MAINTENANCE */
		var cant 	= 	document.getElementsByName("cont_prod_cantidad[]");
		var prec 	= 	document.getElementsByName("cont_prod_precio[]");
		var sub  	= 	document.getElementsByName("subtotal");
		/* MAINTENANCE */
		if(prefijos.includes('INT'))
		{
			if(prefijos.includes('TVA'))
			{
				var desc_elm = prec[indice].value / 10;
				/*FIN MAINTENANCE */
				$("#fila"+prefijos.length).remove();
				/* MAINTENANCE */
				$("#fila"+indice).remove();
				desc_total	= desc_total - desc_elm;
				/*FIN MAINTENANCE */
				calcularTotales();
				/* MAINTENANCE */
				detalles = detalles - 2;
				contador = contador - 2;			
				// elimina la posicion del array en el indice indicado
				prefijos.splice(indice, 1);
				/*FIN MAINTENANCE */
			}
			else
			{
				$("#fila"+indice).remove();
				calcularTotales();
				prefijos.splice(indice, 1);
				detalles = detalles - 1;			
				contador = contador - 1;			
			}
		}
		else
		{
			$("#fila"+indice).remove();
			calcularTotales();
			prefijos.splice(indice, 1);
			detalles = detalles - 1;
			contador = contador - 1;			
		}
	}
	else
	{
		$("#fila"+indice).remove();
		calcularTotales();
		prefijos.splice(indice, 1);
		detalles = detalles - 1;
		contador = contador - 1;			
	}
	/*MAINTENANCE */
	if(detalles < 3)
	{
		$("#btnAgregarProducto").show();
	}
}



function halarDataTable()
{	// llama el valor de la columna especificada
	// var tdsDataTable = $("#tblproduc").find("td:nth-last-child(2)").text();
	if($("#nuevos_product").is(':hidden'))
	{
		var nColumnas = $("#tblproduc td").length;
		// Verifica cantidad de filas
		var nFilas = $("#tblproduc tr").length;
		var tdsDataTable = $("#tblproduc").find("td:eq("+nColumnas+")").text();

		// recorre el número de filas que existen
		contar = 1; 
		// Recibe la asignación de la fila 
		fila = 1;

		$("#nuevos_product").show();
		// Verifica cantidad de filas visibles
		var numOfRows 	= $('#tblproduc tr:visible').length;
		var cod_id_col 	= 1;
		var desc_id_col	= 2;
		var nom_id_col 	= 3;
		var val_id_col 	= 4;
		var val_dscu 	= 5;
		var cantidad 	= 1;

		while (contar <= parseInt(nFilas)-2)
		{	
			if(!$("#tblproduc tr:eq("+contar+")").is(':hidden'))
			{
				fila = contar;
				// llama el valor de la celda especificada en el datatable
				// $("#tblproduc tr:eq("+fila+")").find("td:eq("+cod_id_col+")").text();
				var Codigo =  $("#tblproduc tr:eq("+fila+")").find("td:eq("+cod_id_col+")").text();
				var Descripcion = $("#tblproduc tr:eq("+fila+")").find("td:eq("+desc_id_col+")").text();
				var Nombre =  $("#tblproduc tr:eq("+fila+")").find("td:eq("+nom_id_col+")").text();
				var Valor =  $("#tblproduc tr:eq("+fila+")").find("td:eq("+val_id_col+")").text();
				var Desc = $("#tblproduc tr:eq("+fila+")").find("td:eq("+val_dscu+")").text();	
				var subtotal = cantidad * Valor;

				desc_total = desc_total+parseInt(Desc); 
				prefijos.push(Nombre);
				detalles++;
				// crea una variable que almacenará la fila la cual se insertará en la tbldetalle2
				var fila2 = '<tr class="filas" id="fila'+Codigo+'">'+
							'<td></td>'+
							'<td>'+Codigo+'</td>'+
							'<td><input type="hidden" name="antg_prod_nombre[]" value="'+Nombre+'">'+Nombre+'</td>'+
							'<td><input type="hidden">'+Descripcion+'</td>'+
							'<td><input type="hidden" name="antg_cont_prod_cantidad[]" id="cantidad" value="'+cantidad+'">'+cantidad+'</td>'+
							'<td><input type="hidden" name="antg_cont_prod_precio[]" id="prod_dsc_valor" value="'+Valor+'">'+Valor * 1+'</td>'+
							'<input type="hidden" name="prefijo[]" id="prefijo" value="'+Nombre+'">'+
							'<td><span name="antg_subtotal" id="subtotal'+fila+'">'+subtotal+'</td>'+
							'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
							'</tr>';
				
				$('#tbldetalle2').append(fila2);

			}
			contar++;
		}
		modificarSubtotales();
	}
}

function cancelarform2()
{
	location.reload(true);
}

function eliminarProducto(cod_prod, nom_prod, val_prod, no_btn, prefijo)
{
	$("#tblinterno tr").remove();
	$("#nuevos_product").hide();

	var contando 	= 	0;
	var banderatva 	=	0;
	var banderatvd 	=	0;
	var banderaint 	=	0;

	// CONTROLA LA CANTIDAD DE PRODUCTOS DEL MISMO PREFIJO PERTENECIENTES AL CONTRATO
	while(parseInt(prefijos_datatable.length)>=contando)
	{
		if(prefijos_datatable[contando] == 'TVA')
		{
			banderatva++;
		}
		if(prefijos_datatable[contando] == 'INT')
		{
			banderaint++;
		}
		if(prefijos_datatable[contando] == 'TVD')
		{
			banderatvd++;
		}
		contando++;
	}

	if(banderatva > 1)
	{
		// SE CREA  CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
		if(!$("#nvtva").length)
		{
			$('#modific_products').append('<input type="hidden" id="nvtva" name="nvtva" value="uno"/>');
			$("#tva").val('0');
		}
	}
	else
	{
		$("#nvtva").remove();
	}

	if(banderatvd > 1)
	{
		if(!$("#nvtvd").length)
		{
			// SE CREA  CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
			$('#modific_products').append('<input type="hidden" id="nvtvd" name="nvtvd" value="uno"/>');
			$("#tvd").val('0');
		}
	}
	else
	{
		$("#nvtvd").remove();
	}

	if(banderaint > 1)
	{
		if(!$("#nvint").length)
		{
			// SE CREA  CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
			$('#modific_products').append('<input type="hidden" id="nvint" name="nvint" value="uno"/>');
			$("#int").val('0');
		}
	}
	else
	{
		$("#nvint").remove();
	}
	
	if(!prefijos_datatable.includes('DSCTO'))
	{
		if(no_btn != '')
		{
			$("tr").click(function(e){
				  // if($(this).attr("id") != '')
				  // {
				  	id = $(this).attr("id");
				  	$(this).hide();
				  // }
				});
		}
	}

	if(prefijos_datatable.includes('DSCTO'))
	{
		if(total_mensual == 0)
		{
			for (var i = tabla2.data().length - 2; i >= 0; i--) 
			{
				total_mensual = parseInt(total_mensual) + parseInt(tabla2.data()[i][4]);
			}
		}
		bootbox.alert('Eliminar un producto desactiva el descuento por combo en el contrato');
		$("#DSCTO").hide();
	}
	else
	{
		if(total_mensual == 0)
		{
			for (var i = tabla2.data().length - 1; i >= 0; i--) 
			{
				total_mensual = total_mensual + parseInt(tabla2.data()[i][4]);
			}
		}
	}
	// VERIFICA SI EL CONTRATO TIENE VISIBLE EL DESCUENTO
	if(!$("#DSCTO").hasClass("hide"))
	{
		$("#btnAgregarProductoCont").show();
	}
	// busca el indice correspondiente al valor que se va a eliminar dentro del array
	var indice_array 	= 	prefijos_datatable.indexOf(prefijo);
	// elimina por indice el valor 
	prefijos_datatable.splice(indice_array, 1);
	// OCULTA EL BOTON EN EL DATA TABLE
	$("#btn"+no_btn).hide();
	// OCULTA LA FILA CORRESPONDIENTE AL PREFIJO
	if(prefijos_datatable.includes('DSCTO'))
	{
		$("#"+prefijo).hide();
	}	
	// MUESTRA EL ID DONDE ESTA LA TABLA DE ELIMINAR
	$("#produc_elimin").show();
	// FILA PARA AGREGAR A LA TABLA CON LOS PRODUCTOS ELIMINADOS
	var fila = '<tr class="filas" id="fila'+cod_prod+'">'+
		'<td><input type="hidden" name="prefijo_elm[]" value="'+prefijo+'"><button type="button" class="btn btn-danger" onclick="cancelarEliminarProducto('+cod_prod+','+no_btn+','+val_prod+',\''+prefijo+'\')">X</button></td>'+
		'<td><input type="hidden" name="cont_prod_producto_id_elm[]" value="'+cod_prod+'">'+cod_prod+'</td>'+
		'<td><input type="hidden" name="prod_nombre_elm[]" value="'+nom_prod+'">'+nom_prod+'</td>'+
		'<td><input type="hidden" name="prod_valor_elm[]" value="'+val_prod+'">$ '+val_prod+'</td>'+
		'</tr>';
	// INSERTA LA FILA EN LA TABLA
	$('#produc_elm').append(fila);
	// MUESTRA EL BOTON DE GUARDAR 
	$("#update_cont").show();

	total_mensual 	= 	total_mensual - val_prod;
	$("#minimo_mensual_adc").val(total_mensual);
}

function cancelarEliminarProducto(indice, btn_no, val_prod, prefijo)
{
	if(prefijos_datatable.includes('DSCTO'))
	{
		var new_id = new Array();
		var valores = new Array();

		var fila 	= $('#produc_elm tr').length; 
		var fila_DT = $('#tblproduc tr').length; 
		$("#btn"+btn_no).show();
		// $("#"+id_tr[]).show();
		$("#"+prefijo).show();
		$("#fila"+indice).remove();
		prefijos_datatable.push(prefijo);
		// alert(prefijos_datatable);
		
		if(fila < 4)
		{
			// REMUEVE LOS REGISTROS INTERNOS DE LA TABLA NUEVOS PRODUCTOS 
			total_tr = $("#tblinterno tr").remove();
			//OCULTA TABLA DE ELIMINACIÓN 
			$("#produc_elimin").hide();
			$("#update_cont").hide();		
			
			if(prefijos_datatable.includes('DSCTO'))
			{
				$("#DSCTO").show();
			}
			total_mensual 	= 0;		

			// VERIFICA SI EL CONTRATO TIENE VISIBLE EL DESCUENTO
			if(!$("#DSCTO").hasClass("hide"))
			{
				$("#btnAgregarProductoCont").hide();
			}
			$("#nuevos_product").hide();
		}else
		{
			valores = [indice,val_prod];
			total_mensual = total_mensual + valores[1];
		}
		$("#minimo_mensual_adc").val(total_mensual);
		
	}
	else
	{
		bootbox.confirm("Para cancelar la eliminación de estos productos deberá recargar la página",function(result){
			if (result) 
			{
				alert("No se han podido eliminar los productos seleccionados")
				location.reload(true);
			}
		})
	}
}

function actualizarContrato(e){
	
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	
	// cuenta los nuevos productos agregados 
	var formData = new FormData($("#modific_products")[0]);

	if(formData.get('minimo_mensual_adc') == 0)
	{
		bootbox.confirm("El contrato no puede registrarse sin productos",function(result){
			if (result) 
			{
				alert('Los productos no han podido ser eliminados');
				location.reload(true);
			}
		})
	}
	else
	{
		$.ajax({

			url: "../ajax/contrato.php?op=actualizarContrato",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			// Si la funcion se ejecuta de forma correcta
			success: function(datos){
				// Muestra los datos de reapuesta provenientes de ajax
				bootbox.alert(datos, function(){location.reload(true)});
			}
		});
		limpiar();
		$("#update_cont").prop("disabled",true);
	}
}

function fileValidation(){
    var fileInput = document.getElementById('file-1');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        bootbox.alert('Por favor ingrese un archivo valido.');
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

/*FIN MAINTENANCE */

// Declaracion para ejecucion al iniciar
init();