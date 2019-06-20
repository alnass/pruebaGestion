<?php
ob_start();
// inicio de sesion
session_start();
if(!isset($_SESSION["usu_nombre"]))
{
  header("Location: login.html");
}else
{
  require 'header.php';
  // validacion de permisos mediante variable de session
  if($_SESSION['ordenTrabajo']==1)
  {

?>
<!-- // # encoded by @Francisco Monsalve-->

<div class="content-wrapper">
    <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Orden de Trabajo - Cerradas</h1><br><br>
              <!-- <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1> -->
            <div class="box-tools pull-right">
            </div>
          </div>
                  <!-- /.box-header -->

                  <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover ">
              <thead style="background-color: #CEE3F6;">
                <th>Imprimir OT</th>
                <th>No OT</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Fecha Programación</th>
                <th>Fecha de Cierre</th>
                <th>Concepto de Cierre</th>
                <th>Estado Cierre OT</th>
                <th>Estado Actual Servicio</th>
                <th>Usuario de Cierre</th>
                <th>Ver</th>
              </thead>
              <tbody>
                <tr>
                  
                </tr>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Imprimir OT</th>
                <th>No OT</th>
                <th>Contrato</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Fecha Programación</th>
                <th>Fecha de Cierre</th>
                <th>Concepto de Cierre</th>
                <th>Estado Cierre OT</th>
                <th>Estado Actual Servicio</th>
                <th>Usuario de Cierre</th>
                <th>Ver</th>
              </tfoot>
            </table>
          </div> <!-- /. panel-body table-responsive" id="listadoregistros -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

 <!-- Ventana modal equipo-->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2>Orden de Trabajo No.</h2><h2 id="s_ot_id"></h2> 
        <div id="info2" class="col-xs-12 well visible" style="background-color: #F9FDAC;">
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
          </div>
          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <label for="ord_trab_fecha_programacion">Fecha Apertura:</label>
            <input type="text" class="form-control" name="ord_trab_fecha_programacion" id="ord_trab_fecha_programacion" placeholder="Fecha de programación" disabled="true">
          </div>
          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <label for="ord_trab_fecha_cierre">Fecha Cierre:</label>
            <input type="text" class="form-control" name="ord_trab_fecha_cierre" id="ord_trab_fecha_cierre" placeholder="Fecha de cierre" disabled="true">
          </div>
          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <label for="tec_asignado">Técnico Asignado:</label>
            <input type="text" class="form-control" name="tec_asignado" id="tec_asignado" placeholder="Técnico asignado" disabled ="true">
            <input type="hidden" name="tec_cierre" id="tec_cierre">
          </div>
          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <label for="operacion">Operación de apertura:</label>
            <input type="text" class="form-control" name="operacion" id="operacion" placeholder="Operación" disabled ="true">
            <input type="hidden" name="ant_operacion" id="ant_operacion">
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <label for="ord_trab_observacion">Observacion:</label>
            <textarea class="form-control" name="ant_obsrvacion" id="ant_obsrvacion" placeholder="Observaciones" disabled="true"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <table id="tblOTS" class="table table-striped table-border table-condensed table-hover ">
          <thead>
            <th>Reg.</th>
            <th>Fecha Modificación</th>
            <th>Observación</th>
            <th>Resp. Observación</th>
            <th>Operacíón</th>
            <th>Técnico</th>
          </thead>
          <tbody>
            <tr>
              
            </tr>
            <!-- Cuerpo de la tabla -->
          </tbody>
          <tfoot>
            <th>Reg.</th>
            <th>Fecha Modificación</th>
            <th>Observación</th>
            <th>Resp. Observación</th>
            <th>Operacíón</th>
            <th>Técnico</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana modal equipos -->
  

<?php
// Redireccionamiento por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php';
?>
 <script type="text/javascript" src="scripts/cerradasOT.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>
