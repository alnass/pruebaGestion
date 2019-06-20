<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();
if (!isset($_SESSION["usu_nombre"])) {
  header("Location: login.html");
}else{
  require 'header.php';
?>
<!-- 
// # encoded by @Francisco Monsalve-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
 
<div class="content-wrapper"><!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
                <h1 class="box-title">Alianza <br><br><button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
          </div> <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <!-- <th>Opciones</th> -->
                <th>Opcion</th>
                <th>No PQR´s</th>
                <th>Fecha inicio</th>
                <th>Suscriptor</th>
                <th>Tipo PQR´s</th>
                <th>Categoria</th>
                <th>Area</th>
                <th>Observacion</th>
                <th>Estado</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <!-- <th>Opciones</th> -->
                <th>Opcion</th>
                <th>No PQR´s</th>
                <th>Fecha inicio</th>
                <th>Suscriptor</th>
                <th>Tipo PQR´s</th>
                <th>Categoria</th>
                <th>Area</th>
                <th>Observacion</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div><!--Fin centro -->
          <!-- panel-body -->
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <form name="formulario" id="formulario" method="POST">
              <h2>Registro de PQR´s</h2>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <input type="hidden" class="form-control" name="reg_pqr_id" id="reg_pqr_id" >
                <label for="canal">Canal:</label>
                <select class="form-control selectpicker" data-live-search="true" name="canal" id="canal" ></select>
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="tipoCanal">Tipo de canal:</label>
                <select class="form-control selectpicker" data-live-search="true" name="tipoCanal" id="tipoCanal" ></select>
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="producto">Producto:</label>
                <select class="form-control selectpicker" data-live-search="true" name="producto" id="producto" ></select>
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="tipoPqr">Tipo de PRQ's:</label>
                <select class="form-control selectpicker" data-live-search="true" name="tipoPqr" id="tipoPqr" required=""></select>
              </div>

              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="categoriaPqr">Categoria PQR´s:</label>
                <select class="form-control selectpicker" data-live-search="true" name="categoriaPqr" id="categoriaPqr" required=""></select>
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="remitido">Remitido a:</label>
                <select class="form-control selectpicker" data-live-search="true" name="remitido" id="remitido" ></select>
              </div>
              <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                <label for="numRadicado">No Radiacado:</label>
                <input type="text" class="form-control" name="numRadicado" id="numRadicado" maxlength="45" placeholder="Radicado" readonly="">
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="fechaInicio">Fecha de inicial:</label>
                <input type="text" class="form-control" name="fechaInicio" id="fechaInicio" maxlength="45" placeholder="Fecha de expedición" readonly="">
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="fechaRemision">Fecha de remisión:</label>
                <input type="date" class="form-control" name="fechaRemision" id="fechaRemision" maxlength="45" placeholder="Fecha de expedición">
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="fechaFin">Fecha de final:</label>
                <input type="date" class="form-control" name="fechaFin" id="fechaFin" maxlength="45" placeholder="Fecha de expedición">
              </div>
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label for="ticket">Ticket interno:</label>
                <input type="text" class="form-control" name="ticket" id="ticket" maxlength="45" placeholder="Prefijo" >
              </div>
              <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                <label for="dias">RPTA:</label>
                <input type="number" class="form-control" name="dias" id="dias" maxlength="45" placeholder="Marca" >
              </div>
              <div class="form-group col-lg-12 col-md-12 col-sm-12">
                <label for="observacion">Observación:</label>
                <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="1" placeholder="Observaciones"></textarea>
              </div>
              <div id="observacion"></div>
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <table id="tblseguimiento" class="table table-striped table-border table-condensed table-hover">
                <thead>
                  <!-- <th>Opciones</th> -->
                  <th>Area</th>
                  <th>Responsable</th>
                  <th>Fecha de registro</th>
                  <th>Observacion</th>                            
                </thead>
                <tbody>
                  <!-- Cuerpo de la tabla -->
                </tbody>
                <tfoot>
                  <!-- <th>Opciones</th> -->
                  <th>Area</th>
                  <th>Responsable</th>
                  <th>Fecha de registro</th>
                  <th>Observacion</th>      
                </tfoot>
              </table>
                <button class="btn btn-primary" type="submit" id="btnGuardar"><!-- Boton de guardar -->
                  <i class="fa fa-save"></i>Guardar
                </button>
                <button class="btn btn-danger" onclick="cancelarform()" type="button"><!-- Boton de cancelar -->
                  <i class="fa fa-arrow-circle-left"></i>Cancelar
                </button>
              </div>
            </form> 
          </div><!-- fin panel-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/listadoPqr.js"></script>  
<?php 
}
// liberar el espacio del bufer
ob_end_flush();
?>