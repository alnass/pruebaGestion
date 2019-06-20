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
  if ($_SESSION['equipos']==1) {
?>
<!--/// /// # encoded by Anderson Ferrucho
-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Equipos Instalados<br><br></h1>
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
                            <th>MAC</th>
                            <th>Serial</th>
                            <th>Fecha Asignación</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th>Cliente</th>
                            <th>Contrato</th>
                            <th>Propiedad</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Referencia</th>
                            <th>MAC</th>
                            <th>Serial</th>
                            <th>Fecha Asignación</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th>Cliente</th>
                            <th>Contrato</th>
                            <th>Propiedad</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: 20%;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                            <label for="mac">Mac:</label>
                            <input type="hidden"  name="equi_det_id" id="equi_det_id">
                            <input type="text" class="form-control" name="mac" id="mac" maxlength="45" placeholder="Mac:" required="">
                          </div>

                          <!-- Captura de Tiempo -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="serial">Serial:</label>
                            <input type="text" class="form-control" name="serial" id="serial" maxlength="512" placeholder="Serial:" required="">
                          </div>

                          <!-- Captura de Descripción -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="referencia">Referencia equipo:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="referencia" id="referencia" required=""></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="estado">Estado del Equipo:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="estado" id="estado" required=""></select>
                          </div>
                          
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="consecutivo">Consecutivo de Ingreso:</label>
                            <input type="number" class="form-control" name="consecutivo" id="consecutivo" disabled="true">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="remisionNo">Número de Remision Ingreso:</label>
                            <input type="number" class="form-control" name="remisionNo" id="remisionNo" maxlength="45" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="fecha_ingreso2">Fecha Ingreso:</label>
                            <input type="date" class="form-control" name="fecha_ingreso2" id="fecha_ingreso" maxlength="45" required="">
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
<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/equipoInstalado.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>