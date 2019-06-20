<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();


if (!isset($_SESSION["usu_nombre"])) {
  header("Location: login.html");
}else{

  require 'header.php';
    // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['escritorio']==1) {
?>
  <!-- // # encoded by @Francisco Monsalve-->
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">                          
          <img src="../files/Logo_Horizontal_vector.png" alt="" width="50%" height="auto">
          <h3>Bienvenido al sistema de gestión</h3>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 style="color: gray;">Buen día <strong><?php echo $_SESSION["usu_nombre"];?></strong> , recuerda que el nombre de usuario y contraseña de acceso al sistema son personales e intransferibles.  </h3>
      </div>
    </div>
    <div class="row">
      <div class="box">
        <div class="box-header with-border">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-danger">
              <div class="panel-heading">
                <h1>Cuadre de caja</h1>
                <h3>Comunicado No 006</h3>
                <h3>Ref. Registro de salidas </h3>
                <p>Reciban un cordial saludo.</p> 
                <p>Con el fin de optimizar el funcionamiento del sistema de forma administrativa se ha implementado un módulo de “SALIDAS” en cual se deberán registrar los gastos y salidas de dinero como:</p>
                <ul>
                  <li>Arrendamientos </li>
                  <li>Adecuaciones e instalaciones </li>
                  <li>Aseo y papelería </li>
                  <li>Compra de equipos</li>
                  <li>Honorarios </li>
                  <li>Mantenimiento y reparaciones </li>
                  <li>Servicios públicos</li>
                  <li>Viticos y transporte </li>
                  <li>Consignaciones </li>
                  <li>Recogidas de dinero</li>
                </ul>
                <p>Estas salidas deben ser cargadas en el momento de realizarlas ya que una de las funcionalidades del módulo es poder visualizar en tiempo real el efectivo con que cuentan las sedes.</p>
              </div>
            </div>

            <div>
               <h1>Hora de apertura de las sedes </h1>
              <h2>Importante 2 de agosto de 2018</h2>
              <p>Reciban un cordial saludo.</p>
              <p>A partir de la fecha el sistema de gestión de GlobalPlay registra la hora de acceso al sistema, esta hora será tomada como hora de apertura de la sede, por tal razón la primera operación que se debe realizar al abrir la sede, es acceder al sistema de gestión con su nombre de usuario y contraseña personal.</p>
              <p>Recuerde que el nombre de usuario y contraseña de acceso al sistema de gestión son datos privados e intransferibles y por ningún motivo debe <strong>“ACCEDER AL SISTEMA CON LOS DATOS DE OTRO USUARIO”.</strong></p>
              <p>Gracias por su atención. </p>
            </div>

            <h2>Importante 25 de julio de 2018</h2>
                <h3>
                  El siguiente es el cronograma de facturación y cortes para todas las sedes por favor tenerlo en cuenta. 
                </h3>
                <div class="text-center">
                   <img src="../files/escritorio/cronograma_facturacion.PNG" class="img-fluid" width="100%" height="auto">   
                  <br>
                  <h2>
                    Gracias.
                  </h2>
                </div>


            <div class="text-center">
              <h3><strong>MANUAL DE OPERACIONES</strong></h3> 
              <h4><strong>SISTEMA DE GESTION - GLOBAL PLAY</strong></h4><br> 
            </div>
            
            
            <ol> <!-- Inicio de listado principal -->
              <li>
                <h4><strong>CREACIÓN DE CONTRATO – NUEVOS SUSCRIPTORES</strong></h4>
                <p>Todos los suscriptores que cuenten con cualquiera de los servicios prestados por la compañía deben contar con un contrato. <br>Los nuevos suscriptores deben ser creados mediante un contrato en el software de gestión.</p>
                <strong>NOTA: El servicio “NO” puede ser activado si no existe contrato creado en el sistema.</strong>
              </li>
              <li>
                <h4><strong>RECAUDO INICIAL – NUEVO SUSCRIPTOR</strong></h4>
                <p>
                  En la creación del nuevo contrato <strong>“CON PERMANENCIA”</strong>  el suscriptor deberá cancelar el mes completo por anticipado sin importar la fecha en que sea realizado.
                </p>
                <p>
                  En el estado de cuenta del suscriptor aparecerá saldo a favor hasta que el área “TÉCNICA” realice la activación del servicio. El sistema automáticamente generará el cobro de los días que tendrá el servicio correspondiente al mes de la instalación y el saldo a favor pasará a la siguiente facturación siendo descontado de valor su mensualidad.
                </p> 
                <p>
                  Para los contratos <strong>“SIN PERMANENCIA”</strong>  se cobrará el valor de la instalación designado para la sede y el valor de la mensualidad completa, el sistema cargará automáticamente el valor de la conexión y el estado de cuenta del suscriptor quedará con saldo a favor por el valor de la mensualidad hasta que técnica realice la activación del servicio y se genere el cobro.
                </p>
                <p>
                  El <strong>“VALOR DIFERIDO”</strong>  solo puede ser cargado a los contratos que cuenten con cláusula de permanencia, y corresponde al valor que pagara el suscriptos por conexión y que no alcanza el valor total del cargo de conexión establecido. El valor restante conformará la permanencia y será divido en los 12 meses siguientes en caso de retiro anticipado.</p>
                </p> 
                <p>
                  <strong>Nota: Esta información deberá ser suministrada de forma clara al suscriptor en el momento de la contratación haciendo énfasis en que el servicio prestado es “PREPAGO”</strong>.</p>
                <p>
              </li>
              <li>
                <h4><strong>CARGO ADICIONAL – NUEVO SUSCRIPTOR</strong></h4>
                <p>
                  El cargo adicional corresponde a un producto o servicio de cobro único, es decir que se cobrara <strong>una única vez</strong>. Este valor será cargado automáticamente al estado de cuenta del suscriptor y deberá ser cobrado en el momento de la contratación.
                </p>
              </li>
              <li>
                <h4><strong>ACTIVACIÓN DEL SERVICIO – NUEVOS SUSCRIPTORES - ORDEN DE TRABAJO</strong></h4>
                <p>
                  Al crear el nuevo contrato el sistema automáticamente crea un estado de cuenta y estado de <strong>“POR INSTALAR”</strong>. <br> Para activar el servicio se debe crear una nueva orden de trabajo desde el área <strong>“TÉCNICA”</strong>, en la que se programará la fecha de instalación y el técnico que realizará la labor, en caso de no poder realizarse la instalación se debe reasignar la fecha para que la orden no sea mostrada como vencida. <strong>NOTA – No deben existir ordenes de trabajo vencidas en el área de seguimiento, esta sección será auditada constantemente. - </strong>
                </p>
                <p>
                  Posterior a la instalación del servicio se debe cerrar la orden de trabajo con el nuevo estado como <strong>“ACTIVO”</strong>, en el momento que se reasigne el servicio como ACTIVO, el sistema automáticamente calculara el prorrateo y lo cargara al estado de cuenta del suscriptor por esta razón es importante que se realice la actualización del estado de forma inmediata.
                </p>
                <p><strong>Nota. La orden de trabajo debe ser firmada por el nuevo suscriptor y por el técnico asignado a la operación en el caso de los cortes solo se podrá omitir la firma del suscriptor mas no la del técnico.</strong></p>     
                <strong>Proceso</strong>
                <ol>
                  <li>Generar contrato </li>
                  <li>Crear orden de trabajo </li>
                  <li>Realizar la instalación </li>
                  <li>Cerrar orden de trabajo</li>
                </ol>   
                <strong>Es obligatorio realizar el cierre de la orden de trabajo el mismo día que se realizó la instalación.</strong> 
              </li>
              <li>
                <h4><strong> RECEPCION Y ASIGNACION DE EQUIPOS – NUEVOS SUSCRIPTORES - ORDEN DE TRABAJO</strong></h4>
                <p>Al recibir un nuevo equipo receptor del servicio de internet (Antena, Router) o para televisión digital (set box), deberá ser ingresado en la sección:</p>
                  <ul>
                    <li>Inventario</li>
                    <li>Equipos</li>
                    <li>Nuevo - click en el botón agregar</li>
                  </ul><br>
                    <p>Se desplegará un formulario en donde se solicitan los siguientes datos:</p>
                  <ul>
                    <li>Mac</li>
                    <li>Referencia</li>
                    <li>Serial</li>
                    <li>Estado del Equipo</li>
                    <li>Tipo de Entrada</li>
                    <li>Numero de remisión</li>
                    <li>Fecha remisión</li>
                  </ul>
                <p>Este formulario deberá ser diligenciado en su totalidad y con los datos correctos del equipo, si la referencia del equipo no aparece registrada en la lista desplegable, deberá solicitarse al departamento de software la creación del nuevo equipo para que aparezca en la lista desplegable y pueda ser seleccionado, el estado del equipo se seleccionará como disponible y en el tipo de entrada indicar, si es una compra, traslado o recogido, el número de remisión es la que se asigna en la oficina al momento de la entrada, al igual que la fecha de remisión, en caso de ser recogido se ingresará en los datos de la remisión la fecha y orden de trabajo con la que se recogió el equipo.</p>
              </li>
              <li>
                <h4><strong>CESIÓN DE CONTRATO – NUEVOS SUSCRIPTORES</strong></h4>
                <p>
                  Para que un suscriptor pueda ceder el contrato a otra persona debe seguir los siguientes pasos.
                </p>
                <ul>
                  <li>Dirigirse a la sede en la realizo su contrato con el nuevo suscriptor beneficiario del servicio.</li>
                  <li>Llevar la fotocopia de las cedulas de ambas personas.</li>
                  <li>Diligenciar completamente el formato de cesión de contrato.</li>
                </ul><br>
                <p>En caso de no ser posible que el suscriptor activo este presente, el suscriptor beneficiario deberá portar una carta de autorización firmada, en donde quede claro la cesión del servició y copia del documento del suscriptor activo. </p>
                <p>Las condiciones para la sesión de contrato.</p>
                <ul>
                  <li>El suscriptor debe contar con estado de cuenta al día.</li>
                  <li>Se realizará un nuevo contrato con la persona a quien se sede el servicio.</li>
                  <li>El contrato contara con una permanencia mínima de 12 meses soportados sobre el valor de la instalación.</li>
                  <li>No se cobrará valor de conexión.</li>
                </ul>
              </li>
              <li>
                <h4><strong>FACTURACIÓN</strong></h4>
                <p><strong>El periodo de facturación abarca del primero al último día de cada mes.</strong></p>
                <p>
                  Se realizarán dos cortes de facturación, el corte “A” será entre los días 25 y 27 de cada mes para el cobro del mes siguiente, el corte “B” se realizará el primer día del mes cobrado en el primer corte con el fin de generar las facturas de los contratos creados después del corte “A” y cuyos servicios ya se encuentren activos.
                </p>
                <p>
                  El cargue de facturación al sistema será realizado entre los días 25 y 27 de cada mes, para tal efecto los suscriptores deben estar actualizados con los estados de servicio con el fin de que la facturación cargada sea real.
                </p>
              </li>
              <li>
                <h4><strong>ENVIÓ DE FACTURAS</strong></h4>
                <p>Las facturas serán enviadas entre los días 25 y 27 de cada mes y corresponderán al mes inmediatamente siguiente.</p>
              </li>
              <li>
                <h4><strong>RECAUDO Y PAGO OPORTUNO DE FACTURAS </strong></h4>
                <p>El recaudo de efectivo de los clientes inscritos deberá realizarse en la sección: </p>
                <ul>
                  <li>Recudos</li>
                  <li>Registro de Pagos</li>
                </ul>
                <p>En esta sección se mostrará el listado completo de suscriptores registrados en la base de datos correspondientes a la sede del operador.</p>
                <p>En la casilla buscar se puede filtrar los datos del cliente por contrato, documento, nombre o dirección, la columna de saldo actual es la deuda que presenta el cliente a la fecha o el valor que deberá pagar, para registrar el pago se deben seguir los siguientes pasos: </p>
                  <ol>
                    <li>Dar click en el botón verde que muestra el gráfico un billete.</li>
                    <li>Se abrirá una nueva ventana que contiene la sección de recaudo. </li>
                    <li>En la casilla de recaudo ingresar el valor pagado por el cliente. </li>
                    <li>En la casilla observación poner una observación que identifique el pago (opcional)</li>
                    <li>Dar click en guardar.</li>
                  </ol>
                <p>En la ventana de recaudo se podrá ver una tabla con el detalle de registros a la cuenta del cliente indicando el valor registrado y la operación realizada. </p>
                <p>  
                  El pago oportuno de las cuentas vence el día 10 de cada mes, a partir de esta fecha se elimina el beneficio de pronto pago designado a los productos correspondientes de cada sede. 
                </p>
                <p>A partir de esa fecha el suscriptor entra en estado de mora.</p>
              </li>
              <li>
                <h4><strong>APLICACIÓN DEL PRONTO PAGO</strong></h4>
                <p>
                  El beneficio de pronto pago solo aplica para el mes en curso y para algunos productos en sedes seleccionadas. Este beneficio aplica siempre y cuando el suscriptor realice el pago total del saldo con el que cuente en ese momento y se encuentre en la fecha establecida como fecha límite de pago, que es hasta el día 10 de cada mes.
                </p>
                <p>
                  Si se realiza un pago por medio electrónico o consignación antes de la fecha límite pero se valida en caja después del periodo de pronto pago, el descuento deberá ser aplicado desde al área administrativa como nota crédito al estado de cuenta del suscriptor.
                </p>
              </li>
              <li>
                <h4><strong>NOTAS CRÉDITO</strong></h4>
                <p>
                  Las notas crédito son descuentos realizados a los estados de cuenta de los suscriptores. Estos pueden ser por diferentes conceptos como; descuento por pronto pago extemporáneo, fidelización, falla técnica etc. Estos solo pueden ser aplicados por el área administrativa.
                </p>
              </li>
              <li>
                <h4><strong>NOTAS DEBITO</strong></h4>
                <p>
                  Las notas debito son cargos adicionales al estado de cuenta del suscriptor.  Estos pueden ser por diferentes conceptos como; retiro anticipado, prorrateo, multas etc. Estos solo pueden ser aplicados por el área administrativa.
                </p>
              </li>
              <li>
                <h4><strong>CORTES DE SERVICIO  </strong></h4>
                <p>
                  Se debe cambiar el estado del servicio a “POR CORTAR” cuando la cuenta del suscriptor alcance el valor establecido en cada sede como tope de corte, siendo este no mayor a 2 mensualidades. El área técnica deberá generar la orden de trabaja de forma inmediata y programar al técnico y la fecha de corte. Los acuerdos de pago no negociaciones especiales deben estar soportados y autorizados por el área administrativa.
                </p>
              </li>  
              <li>
                <h4><strong>RECEPCIÓN DE PQR’S</strong></h4>
                <p>
                  Se debe cambiar el estado del servicio a “POR CORTAR” desde el área de recaudo, cuando la cuenta del suscriptor alcance el valor establecido en cada sede como tope de corte, siendo este no mayor a 2 mensualidades. El área técnica deberá generar la orden de trabajo de forma inmediata y programar al técnico y la fecha de corte. Los acuerdos de pago o negociaciones especiales deben estar soportados y autorizados por el área administrativa.
                </p>
              </li>
              <li>
                <h4><strong>CIERRE DE OPERACIÓN Y REPORTE DE EFECTIVO</strong></h4>
                <p>Al finalizar la operación diariamente, se deberá diligenciar el libro de excel denominado libro de contabilidad, allí quedará reportado el ingreso de efectivo y los gastos ocasionados en la oficina éste deberá ser enviado junto con el reporte que genera el sistema de gestión en la sección: </p>
                <ul>
                  <li>Recaudos</li>
                  <li>Cierres</li>
                  <li>Cierre - Final</li>
                </ul>
                <p>El cierre final se almacenará como documento pdf y se adjuntará al departamento de contabilidad junto con el libro de contabilidad a los correos electrónicos que se encuentren autorizados. </p>
              </li>  
            </ol> <!-- Fin de de listado principal -->
          </div>
        </div> <!-- Fin de box-header with-border -->
      </div>   <!-- Fin de Box -->         
    </div> <!-- fin de row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
  // Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/area.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>