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
<!-- # encoded by @Francisco Monsalve-->
<!--Contenido-->  
  <div class="content-wrapper"> <!-- Content Wrapper. Contains page content -->
    <section class="content"> <!-- Main content -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title">Seguimiento de PQR´s</h1><br>
              <div class="box-tools pull-right"></div>
            </div><!--  /. box-header with-border --><!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-border table-condensed table-hover ">
                <thead style="background-color: #CEE3F6;">
                  <th>Radicado</th>
                  <th>Documento</th>
                  <th>Suscriptor</th>
                  <th>Tipo de PQR´s</th>
                  <th>Categoria</th>
                  <th>Area</th>
                  <th>RPTA</th>
                  <th>Inicio</th>
                  <th>Vence</th>
                  <th>Observacion</th>
                  <th>Agregar</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                  <!-- Cuerpo de la tabla   -->
                </tbody>
                <tfoot>
                  <th>Radicado </th>
                  <th>Documento</th>
                  <th>Suscriptor</th>
                  <th>Tipo de PQR´s</th>
                  <th>Categoria</th>
                  <th>Area</th>
                  <th>RPTA</th>
                  <th>Inicio</th>
                  <th>Vence</th>
                  <th>Observacion</th>
                  <th>Agregar</th>
                  <th>Estado</th>
                </tfoot>
              </table>
            </div> <!-- /. panel-body table-responsive" id="listadoregistros -->
            <div class="panel-body " style="height: auto;" id="formularioregistro">
              <div class="container-fluid">
                <form name="formulario" id="formulario" method="POST">
                  <div class="row">
                    <div id="verestado" class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <span id="cerrado" class="label bg-blue">CERRADO</span>
                      <span id="vencido" class="label bg-red">VENCIDO</span>
                      <span id="pvencer" class="label bg-orange">POR VENCER</span>
                      <span id="activa" class="label bg-green">ACTIVA</span>
                    </div>
                    <?php 
                      if ($_SESSION['usu_area_id']==5) {
                        echo '
                          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right" >
                             <button class="btn btn-success" id="cerrarPqr" onclick="cerrarpqr()" type="button">
                              <i class="fa fa-check-square-o"></i>  Cerrar PQR
                            </button>
                          </div><!--/.form-group col-lg-1 col-md-1 col-sm-12 col-xs-12 -->
                        ';
                      }
                     ?>
                  </div>
                  <div class="row" style="background-color: #E0E6F8;"><!-- Fila de datos de suscriptor -->
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="persona">Suscriptor:</label>
                      <input type="text" class="form-control" name="persona" id="persona" readonly="">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <label for="direccion">Dirección:</label>
                      <input type="text" class="form-control" name="direccion" id="direccion" readonly="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="telefono">Teléfono:</label>
                      <input type="text" class="form-control" name="telefono" id="telefono" readonly="">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="correo">Correo:</label>
                      <input type="text" class="form-control" name="correo" id="correo" readonly="">
                    </div>
                  </div><!-- /.row Fila de datos de suscriptor -->
                  <div class="row"> <!-- Fila del formulario de cabecera de la PQR -->
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <input type="hidden" id="reg_pqr_id" name="reg_pqr_id">
                      <label for="canal">Canal:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="canal" id="canal" ></select> -->
                      <input type="text" class="form-control" name="canal" id="canal" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoCanal">Tipo de canal:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="tipoCanal" id="tipoCanal" ></select> -->
                      <input type="text" class="form-control" name="tipoCanal" id="tipoCanal" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="producto">Producto:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="producto" id="producto" ></select> -->
                      <input type="text" class="form-control" name="producto" id="producto" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoPqr">Tipo de PRQ's:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="tipoPqr" id="tipoPqr" required=""></select> -->
                      <input type="text" class="form-control" name="tipoPqr" id="tipoPqr" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="categoriaPqr">Categoria PQR´s:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="categoriaPqr" id="categoriaPqr" required=""></select> -->
                      <input type="text" class="form-control" name="categoriaPqr" id="categoriaPqr" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="remitido">Remitido a:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="remitido" id="remitido" ></select> -->
                      <input type="text" class="form-control" name="remitido" id="remitido" readonly="">
                    </div>

                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="numRadicado">No Radiacado:</label>
                      <input type="text" class="form-control" name="numRadicado" id="numRadicado" maxlength="45" placeholder="Radicado" readonly="">
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="numRadicado" id="numRadicado" ></select> -->
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="fechaInicio">Fecha de inicio:</label>
                      <input type="text" class="form-control" name="fechaInicio" id="fechaInicio" placeholder="Fecha de expedición" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="fechaRemision">Ultima remisión:</label>
                      <input type="text" class="form-control" name="fechaRemision" id="fechaRemision" placeholder="Fecha de expedición" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="fechaFin">Fecha de final:</label>
                      <input type="text" class="form-control" name="fechaFin" id="fechaFin" maxlength="45" placeholder="Fecha de expedición" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="ticket">Ticket interno:</label>
                      <input type="text" class="form-control" name="ticket" id="ticket" maxlength="45" placeholder="Prefijo" readonly="">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="operador">Atendido por:</label>
                      <!-- <select class="form-control selectpicker" data-live-search="true" name="operador" id="operador" ></select> -->
                      <input type="text" class="form-control" name="operador" id="operador" readonly="">
                    </div>

                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="dias">RPTA:</label>
                      <input type="number" class="form-control" name="dias" id="dias" maxlength="45" placeholder="Marca" readonly="">
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12" >
                      <label for="observacion">Observación:</label>
                      <strong><textarea class="form-control" name="observacion" id="observacion" cols="30" rows="1" placeholder="Observaciones" readonly="" style="background-color: pink;"></textarea></strong>
                    </div>
                  </div><!--/.row FIN  Fila del formulario de cabecera de la PQR --> 
                  <div class="row" style="background-color: #E0ECF8;"> <!-- Fila de la tabla de detalles de observacionde la PQR -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tblseguimiento" class="table table-striped table-border table-condensed table-hover">
                        <thead style="background-color: #a9d0f5;">
                          <th>ID</th>
                          <th>Remitido a</th>
                          <th>Responsable</th>
                          <th>Fecha de envio</th>
                          <th>Observación</th>
                        </thead>
                        <tbody>
                          <!-- Cuerpo de la tabla -->
                        </tbody>
                      </table>
                    </div> <!-- /. panel-body table-responsive" id="listadoregistros -->
                  </div><!--/.row FIN  Fila de la tabla de detalles de observacionde la PQR -->

                  <div class="row" id="insertarobservacion" style="background-color: pink;"><!-- formulario de insecion de observaciones -->
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="fechaenvio">Fecha de remisión:</label>
                      <input type="hidden" name="seg_id" id="seg_id">
                      <input type="hidden" name="fechaRev" id="fechaRev">
                      <input type="text" class="form-control" name="fechaenvio" id="fechaenvio" placeholder="Fecha de expedición" readonly="" value="<?php date_default_timezone_set("America/Bogota"); $hoy = date('Y-m-d H:i:s'); echo $hoy;?>">
                    </div>

                    <div class="form-group col-lg-5 col-md-5 col-sm-12">
                      <label for="obseguimiento">Observación:</label>
                      <textarea class="form-control" name="obseguimiento" id="obseguimiento" cols="30" rows="1" placeholder="Observaciones"></textarea>
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="responsable">Responsable:</label><input type="text" class="form-control" name="responsable" id="responsable" readonly="" value="<?php echo($_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'])?>">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="nvoremision">Remitido a:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="nvoremision" id="nvoremision" required=""></select>
                    </div>
                  </div><!-- /.row formulario de insecion de observaciones -->

                  <br>  
                  <div class="row"><!-- Botones de guardar y cancelar -->
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" >

                      <!-- Boton de cancelar -->
                      <button class="btn btn-danger" onclick="cancelarform()" type="button">
                        <i class="fa fa-arrow-circle-left"></i> Cancelar
                      </button>
                      <!-- Boton de guardar -->
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-save"></i> Guardar
                      </button>
                      
                    </div><!--/.form-group col-lg-12 col-md-12 col-sm-12 col-xs-12-->
                    
                                         
                  </div><!--/.row Botones de guardar y cancelar -->
                </form> <!--/.formulario" id="formulario" method="POST" -->
              </div> <!-- /.container fluid -->
            </div> <!-- /.panel-body " style="height: auto;" id="formularioregistro -->
          </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/seguimientoPqr.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>