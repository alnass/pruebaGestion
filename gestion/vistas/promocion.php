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
  if ($_SESSION['promociones']==1) {
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <div>
                          <h1 class="box-title">Promociones<br><br></h1>
                        </div>
                        <div id="funcion">
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                              <i class="fa fa-plus-circle"></i> Agregar Nueva
                            </button>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <select class="form-control" name="filtro" id="filtro" required="">
                              <option>
                                Seleccione un valor para filtrar
                              </option>
                              <option value="1">
                                ACTIVAS
                              </option>
                              <option value="2">
                                TODAS
                              </option>
                            </select>
                          </div> 
                          <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                          </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Id.</th>
                            <th>Nombre Corto</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Id.</th>
                            <th>Nombre Corto</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body " style="height: 400px;" id="formularioregistro">
                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                            <label for="codigo">Nombre:</label>
                            <input type="hidden"  name="prom_id" id="prom_id">
                            <input type="text" class="form-control" name="nom_corto" id="nom_corto" maxlength="45" placeholder="Nombre Corto" required="">
                          </div>

                          <!-- Captura de Descripción -->
                          <div class="form-group col-lg-9 col-md-9 col-sm-6 col-xs-12">
                            <label for="desc">Descripción:</label>
                            <input type="text" class="form-control" name="desc" id="desc" maxlength="256" placeholder="Ingrese una descripción de la promoción" required="">
                          </div>
                          <!-- Captura de Tiempo -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row text-center">
                              <label for="desc">Asigne la promoción a una sede:</label> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="sede_left">
                              
                            </div> 
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="sede_right">
                              
                            </div> 
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
 <script type="text/javascript" src="scripts/promocion.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>