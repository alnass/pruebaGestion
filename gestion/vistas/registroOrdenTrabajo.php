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
<!-- 
// # encoded by @ Anderson Ferrucho-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
 
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Orden de Trabajos</h1> 
                          <br>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                         <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Contrato No.</th>
                            <th>Nombres</th>
                            <th>Documento</th>
                            <th>Telefono1</th>
                            <th>Contrato Inicio</th>
                            <th>Direccion</th>
                            <th>Generar OT</th>
                            <th>Estado Servicio</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Contrato No.</th>
                            <th>Nombres</th>
                            <th>Documento</th>
                            <th>Telefono1</th>
                            <th>Contrato Inicio</th>
                            <th>Direccion</th>
                            <th>Generar OT</th>
                            <th>Estado Servicio</th>
                          </tfoot>
                        </table>
                    </div>
                    
                    <div class="panel-body " style="height: auto;" id="formularioregistro">

                    
                    <ul class="nav nav-tabs navbar-light">
                      <li><a href="#info1" class="inf">Datos principales</a></li>
                      <li><a href="#info2" class="inf">Datos complementarios</a></li>
                      <li><a href="#info3" class="inf">Registro de PQR´s</a></li>
                    </ul>


                   <div class="container-fluid">

                      <form name="formulario" id="formulario" method="POST">
                      
                      <!-- Contenido de los div que se ocultan -->
                      <div class="row">
                        <!-- Datos principales -->
                        <div id="info1" class="col-xs-12 well visible" style="background-color: #E0ECF8;">
                          <h2>Datos del Cliente</h2>

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


                        <!-- Datos complemetarios  -->
                        <div id="info2" class="col-xs-12 well oculto" style="background-color: #E3F6CE;">
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


                        <!-- Registro de PQR´s -->
                        <div id="info3" class="col-xs-12 well visible" style="background-color: #FDEBD0;">
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


   <!-- 
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label for="fechaRemision">Fecha de remisión:</label>
                          </div>
 
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label for="fechaFin">Fecha de final:</label>
                          </div>
-->
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label for="ticket">Ticket interno:</label>
                            <input type="text" class="form-control" name="ticket" id="ticket" maxlength="45" placeholder="Prefijo" >
                          </div>

                          <!-- <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label for="operador">Atendido por:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="operador" id="operador" ></select>
                          </div> -->

                          <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="observacion">Observación:</label>
                            <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="1" placeholder="Observaciones"></textarea>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >

                            <!-- Boton de guardar -->
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i>Guardar
                            </button>
                            
                            <!-- Boton de cancelar -->
                            <button class="btn btn-danger" onclick="cancelarform()" type="button">
                              <i class="fa fa-arrow-circle-left"></i>Cancelar
                            </button>
                          </div>
                        </div> <!-- Fin de registro de PQR´s -->
                      </div> <!-- Fin de la clase row -->
                    </div> <!-- Fin de la clase container fluid -->

                          <!-- <div class="row" >    -->

                          
                        </form> 
                      

                      </div>
                    </div>

                    <!--Fin centro -->
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
                    <!-- <th>Opciones</th> -->
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
                      
                    </tr>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <!-- <th>Opciones</th> -->
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/ordenTrabajo.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>