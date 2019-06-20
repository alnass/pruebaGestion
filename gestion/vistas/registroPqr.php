<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();
if (!isset($_SESSION["usu_nombre"])) {
  header("Location: login.html");
}else{
  require 'header.php';
  if ($_SESSION['registroPqr']==1) {
?>
<!-- # encoded by @Francisco Monsalve -->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
 
<div class="content-wrapper">
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Registro de PQR's</h1> 
              <br>
              <button class="btn btn-warning" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> 
                Registro de PQR´s para NO Usuarios
              </button>
              <div class="box-tools pull-right">
              </div>
          </div> <!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Num Documento</th>
                <th>Nombre</th>
                <th>Teléfono 1</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Ver PQR</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Num Documento</th>
                <th>Nombre</th>
                <th>Teléfono 1</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Ver PQR</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <ul class="nav nav-tabs navbar-light">
              <li><a href="#info1" class="inf">Datos principales</a></li>
              <li><a href="#info2" class="inf">Datos complementarios</a></li>
              <!-- <li><a href="#info3" class="inf">Estado de cuenta</a></li> -->
              <li><a href="#info4" class="inf">Registro de PQR´s</a></li>
            </ul>
            <div class="container-fluid">
              <form name="formulario" id="formulario" method="POST">
                <div class="row">
                  <div id="info1" class="col-xs-12 well visible" style="background-color: #E0ECF8;"><!-- Datos principales -->
                    <h2>Datos principales</h2>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="tipoDoc">Tipo de documento:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoDoc" id="tipoDoc" ></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="numDoc">Número de documento:</label>
                      <input type="number" class="form-control" name="numDoc" id="numDoc" maxlength="45" placeholder="Número de documento" >
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="nombre">Nombres:</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" placeholder="Nombres">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="apellido">Apellidos:</label>
                      <input type="text" class="form-control" name="apellido" id="apellido" maxlength="45" placeholder="Apellidos">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ciudad">Ciudad:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="ciudad" id="ciudad" ></select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <input type="hidden" name="persona" id="persona">
                      <input type="hidden" name="cont_id" id="cont_id">
                      <label for="direccion">Dirección:</label>
                      <input type="text" class="form-control" name="direccion" id="direccion" maxlength="45" placeholder="Dirección">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel1">Teléfono 1:</label>
                      <input type="text" class="form-control" name="tel1" id="tel1" maxlength="45" placeholder="Teléfono 1">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="correoPer">Correo personal:</label>
                      <input type="email" class="form-control" name="correoPer" id="correoPer" maxlength="45" placeholder="Correo personal">
                    </div>
                  </div> <!-- Fin de datos principales -->
                  <div id="info2" class="col-xs-12 well oculto" style="background-color: #E3F6CE;"><!-- Datos complemetarios  -->
                    <h2>Datos complemetarios</h2>
                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="per_id">Código:</label>
                      <input type="text" class="form-control" name="per_id" id="per_id" maxlength="45" placeholder="Código" readonly="">
                    </div>
                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="prefijo">Prefijo:</label>
                      <input type="text" class="form-control" name="prefijo" id="prefijo" maxlength="45" placeholder="Prefijo" readonly="">
                    </div>
                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="marca">Marca:</label>
                      <input type="text" class="form-control" name="marca" id="marca" maxlength="45" placeholder="Marca" readonly="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoPersona">Tipo de persona:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoPersona" id="tipoPersona" ></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoCliente">Tipo de Cliente:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoCliente" id="tipoCliente" ></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="alianza">Alianza:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="alianza" id="alianza" ></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="expedDoc">Fecha de expedición:</label>
                      <input type="date" class="form-control" name="expedDoc" id="expedDoc" maxlength="45" placeholder="Fecha de expedición">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="nacimiento">Fecha de Nacimiento:</label>
                      <input type="date" class="form-control" name="nacimiento" id="nacimiento" maxlength="45" placeholder="Fecha de Nacimiento">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel2">Teléfono 2:</label>
                      <input type="text" class="form-control" name="tel2" id="tel2" maxlength="45" placeholder="Teléfono 2">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="barrio">Barrio:</label>
                      <input type="text" class="form-control" name="barrio" id="barrio" maxlength="45" placeholder="Barrio">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoVivien">Tipo de vivienda:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoVivien" id="tipoVivien" ></select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="correoCorp">Correo corporativo:</label>
                      <input type="email" class="form-control" name="correoCorp" id="correoCorp" maxlength="45" placeholder="Correo corporativo">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="usuario">Nombre de usuario:</label>
                      <input type="text" class="form-control" name="usuario" id="usuario" maxlength="45" placeholder="Nombre de usuario">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="pass">Contraseña:</label>
                      <input type="password" class="form-control" name="pass" id="pass" maxlength="45" placeholder="Nombre de usuario">
                    </div>
                  </div> <!-- Fin de datos complementarios --> 
                  <!--<div id="info5" class=" well oculto " > Contratos -->
                    <!-- <div class="row"> -->
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <h2>Contratos</h2>
                      </div> 
                    <!-- </div> -->

                    <div class="panel-body table-responsive" id="usucontratos"> <!-- Inicio del panel de la tabla -->
                      <table id="tblcontrato" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                          <th>No Contrato</th>
                          <th>Mensualidad</th>
                          <th>Dirección</th>
                          <th>Vigencia</th>
                          <th>Perm</th>
                          <th>Estado del servicio</th>
                          <th>Opciones</th>
                        </thead>
                        <tbody>
                          <!-- Cuerpo de la tabla -->
                        </tbody>
                        <tfoot>
                          <th>No Contrato</th>
                          <th>Mensualidad</th>
                          <th>Dirección</th>
                          <th>Vigencia</th>
                          <th>Perma</th>
                          <th>Estado del servicio</th>
                          <th>Opciones</th>
                        </tfoot>
                      </table> <!-- Fin de la tabla -->
                    </div> <!-- Fin del panel de la tabla -->
                 <!-- </div>  Fin Contratos -->
                  
                  <div id="info4" class="col-xs-12 well visible" style="background-color: #FDEBD0;"><!-- Registro de PQR´s -->
                    <div class="row">
                      <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-12">
                         <h2>Registro de PQR´s</h2>
                      </div> 
                      <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                        <label for="numRadicado">No Radiacado:</label>
                        <input type="text" class="form-control" name="numRadicado" id="numRadicado" maxlength="45" placeholder="Radicado" readonly="" style="background-color: #CEF6CE;">
                      </div>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="fechaIni">Fecha de inicial:</label>
                      <input type="text" class="form-control" name="fechaIni" id="fechaIni"  placeholder="Fecha de expedición"  value="<?php date_default_timezone_set("America/Bogota"); $hoy = date('Y-m-d H:i:s'); echo $hoy;?>" readonly="">
                      <input type="hidden" class="form-control" name="fechaRemision" id="fechaRemision">
                      <input type="hidden" class="form-control" name="fechaFin" id="fechaFin">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="canal">Canal:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="canal" id="canal" required=""></select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="tipoCanal">Tipo de canal:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoCanal" id="tipoCanal" required=""></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="producto">Producto:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="producto" id="producto" required=""></select>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="tipoPqr">Tipo de PRQ's:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tipoPqr" id="tipoPqr" required=""></select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <label for="categoriaPqr">Categoria PQR´s:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="categoriaPqr" id="categoriaPqr" required=""></select>
                    </div>
                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="dias">RPTA:</label>
                      <input type="number" class="form-control" name="dias" id="dias" maxlength="45" placeholder="Marca" required="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="remitido">Remitido a:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="remitido" id="remitido" required=""></select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="ticket">Ticket interno:</label>
                      <input type="text" class="form-control" name="ticket" id="ticket" maxlength="45" placeholder="Prefijo" >
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <label for="observacion">Observación:</label>
                      <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="1" placeholder="Observaciones"></textarea>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                      <button class="btn btn-primary" type="submit" id="btnGuardar"><!-- Boton de guardar -->
                        <i class="fa fa-save"></i>Guardar
                      </button>
                      <button class="btn btn-danger" onclick="cancelarform()" type="button"><!-- Boton de cancelar -->
                        <i class="fa fa-arrow-circle-left"></i>Cancelar
                      </button>
                    </div>
                  </div> <!-- Fin de registro de PQR´s -->
                </div> <!-- Fin de la clase row -->
              </form> 
            </div> <!-- Fin de la clase container fluid -->
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<!-- Ventana Modal  -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <table id="tblpqrusuario" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #CEE3F6;">
            <th>Radicado</th>
            <th>Tipo de PQR´s</th>
            <th>Categoria</th>
            <th>Area</th>
            <th>Inicio</th>
            <th>Observacion</th>
            <th>Estado</th>
          </thead>
          <tbody>
            <tr>
            <!-- Cuerpo de la tabla -->
            </tr>
          </tbody>
          <tfoot>
            <th>Radicado</th>
            <th>Tipo de PQR´s</th>
            <th>Categoria</th>
            <th>Area</th>
            <th>Inicio</th>
            <th>Observacion</th>
            <th>Estado</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de productos del contrato seleccionado -->
<div class="modal fade " id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Productos del contrato</h3>
      </div>
      <div class="modal-body">
        <table id="tblproductos" class="table table-striped table-border table-condensed table-hover">
          <thead style="background-color: #CED8F6;">
            <th>Producto ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Pronto pago</th>            
          </thead>
          <tbody>
            <!-- Cuerpo de la tabla -->
          </tbody>
          <tfoot>
            <th>Producto ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Pronto pago</th>            
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de estado de cuenta del contrato -->
<div class="modal fade " id="modalEstadoCta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Estado de cuenta del contrato</h3>
      </div>
      <div class="modal-body">
        <table id="tblestadocta" class="table table-striped table-border table-condensed table-hover">
          <thead style="background-color: #CED8F6;">
            <th>ID</th>
            <th>Fecha Transacción</th>
            <th>Comp</th>
            <th>Concepto</th>
            <th>Obervación</th>
            <th>Saldo Anterior</th>
            <th>Cargos</th>
            <th>Pagos</th>
            <th>Saldo Final</th>
          </thead>
          <tbody>
            <!-- Cuerpo de la tabla -->
          </tbody>
          <tfoot>
            <th>ID</th>
            <th>Fecha Transacción</th>
            <th>Comp</th>
            <th>Concepto</th>
            <th>Obervación</th>
            <th>Saldo Anterior</th>
            <th>Cargos</th>
            <th>Pagos</th>
            <th>Saldo Final</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>


<!-- ventana modal de estado del servicio  -->
<div class="modal fade " id="modalEstadoServ" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Estados del servicio</h3>
      </div>
      <div class="modal-body">
        <table id="tblestadoservicios" class="table table-striped table-border table-condensed table-hover">
          <thead style="background-color: #CED8F6;">
            <th>ID</th>
            <th>Estado del servicio</th>
            <th>Fecha del estado</th>
          </thead>
          <tbody>
            <!-- Cuerpo de la tabla -->
          </tbody>
          <tfoot>
            <th>ID</th> 
            <th>Estado del servicio</th> 
            <th>Fecha del estado</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de cambio de estado del servicio  -->
<div class="modal fade " id="modalCambioEstado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>
          Seleccione el nuevo estado del servicio
        </h3>
      </div>
      <form name="formnuevoestado" id="formnuevoestado" method="POST">
        <div class="modal-body">
          <p>Este nuevo estado indicara la ordern de corte o reconexión </p>
          <div class="row">
            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
              <input type="hidden" id="v_contratoid" name="v_contratoid">
              <label for="m_contratoid">No Contrato</label>
              <input type="text" id="m_contratoid" name="m_contratoid" readonly="">
            </div>
          </div>
          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <label for="nuevoestado">Nuevo estado:</label>
              <select class="form-control selectpicker" data-live-search="true" name="nuevoestado" id="nuevoestado" ></select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="btnGuardarEstado" id="btnGuardarEstado">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/registroPqr.js"></script>  
 <?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>