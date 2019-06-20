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
  if ($_SESSION['inventario']==1) {
?>
<!--/// # encoded by -->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Referencias de Equipos <br><br><button class="btn btn-success" data-toggle="tooltip" title="Agregar Referencia" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Referencia</th>
                            <th>Tipo Equipo</th>
                            <th>Descripcion</th>
                            <th>Fabricante</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Referencia</th>
                            <th>Tipo Equipo</th>
                            <th>Descripcion</th>
                            <th>Fabricante</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body " style="height: 20%;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          
                          <!-- Captura de Descripción -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="tipoequipo">Tipo Equipo:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="tipoequipo" id="tipoequipo" required=""></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="fabricante">Fabricante:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="fabricante" id="fabricante" required=""></select>
                          </div>

                          <!-- Identificacion de ID y captura de nombre -->

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                            <label for="referencia">Referencia:</label>
                            <input type="hidden"  name="equi_id" id="equi_id">
                            <input type="text" class="form-control" name="referencia" id="referencia" maxlength="45" placeholder="Referencia" required="">
                          </div>

                          <!-- Captura de Tiempo -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="512" placeholder="Descripcion">
                          </div>


                          <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="tipoequipo">Tipo Equipo:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="tipoequipo" id="tipoequipo" required=""></select>
                          </div> -->

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
                          
                        </form>
                    </div>

                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Listado de equipos</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="equipoDetalle" class="table table-striped table-border table-condensed table-hover">
            <thead>
              <th>Referencia</th>
              <th>MAC</th>
              <th>Serial</th>
              <th>Fecha Registro</th>
              <th>Ingresado por</th>
              <th>Tipo</th>
              <th>Estado</th>
            </thead>
            <tbody>
              <!-- Cuerpo de la tabla -->
            </tbody>
            <tfoot>
              <th>Referencia</th>
              <th>MAC</th>
              <th>Serial</th>
              <th>Fecha Registro</th>
              <th>Ingresado por</th>
              <th>Tipo</th>
              <th>Estado</th>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/referencia.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>