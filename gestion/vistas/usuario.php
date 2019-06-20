<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();
if (!isset($_SESSION["usu_nombre"])) {
  header("Location: login.html");
}else{
  require 'header.php';

  if ($_SESSION['acceso']==1) {
?>
<!-- # encoded by @Francisco Monsalve-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title">Usuario <br><br><button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
              <div class="box-tools pull-right">
              </div>
            </div><!-- fin box-header -->
            <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
                <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                  <thead>
                    <th>Opciones</th>
                    <th>Alianza</th>
                    <th>Ciudad</th>
                    <th>Sede</th>
                    <th>Nombre</th>
                    <th>Num Documento</th>
                    <th>Dirección</th>
                    <th>Teléfono 1</th>
                    <th>Correo per</th>
                    <th>Foto</th>
                    <th>Estado</th>                            
                  </thead>
                  <tbody>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Alianza</th>
                    <th>Ciudad</th>
                    <th>Sede</th>
                    <th>Nombre</th>
                    <th>Num Documento</th>
                    <th>Dirección</th>
                    <th>Teléfono 1</th>
                    <th>Correo per</th>
                    <th>Foto</th>
                    <th>Estado</th>
                  </tfoot>
                </table>
            </div>

            <div class="panel-body " style="height: auto;" id="formularioregistro">

                <form name="formulario" id="formulario" method="POST">
                  <!-- Identificacion de ID y captura de nombre -->


                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="hidden" name="usu_id" id="usu_id">
                    <label for="tipoDoc">Tipo Documento:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="tipoDoc" id="tipoDoc" required=""></select>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="numDoc">Número de documento:</label>
                    <input type="text" class="form-control" name="numDoc" id="numDoc" maxlength="45" placeholder="Número de documento">
                  </div>


                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="nombre">Nombres:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" placeholder="Nombres">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="apellido">Apellidos:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" maxlength="45" placeholder="Apellidos">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="45" placeholder="Dirección">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="tel1">Teléfono 1:</label>
                    <input type="text" class="form-control" name="tel1" id="tel1" maxlength="45" placeholder="Teléfono 1">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="tel2">Teléfono 2:</label>
                    <input type="text" class="form-control" name="tel2" id="tel2" maxlength="45" placeholder="Teléfono">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="correoPer">Correo personal:</label>
                    <input type="email" class="form-control" name="correoPer" id="correoPer" maxlength="45" placeholder="sucorreo@serv.com">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="correoCorp">Correo corporativo:</label>
                    <input type="email" class="form-control" name="correoCorp" id="correoCorp" maxlength="45" placeholder="sucorreo@serv.com">
                  </div>
                  

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="nacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento" maxlength="45" placeholder="Fecha de nacimiento">
                  </div>


                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="login">Nombre de usuario:</label>
                    <input type="text" class="form-control" name="login" id="login" maxlength="45" placeholder="Nombre de usuario">
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="pass">Contraseña de usuario:</label>
                    <input type="password" class="form-control" name="pass" id="pass" maxlength="45" placeholder="Contraseña de usuario">
                  </div>



                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="ciudad">Ciudad de labor:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="ciudad" id="ciudad" required=""></select>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="sede">Sede:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="sede" id="sede" required=""></select>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="area">Area:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="area" id="area" required=""></select>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="cargo">Cargo:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="cargo" id="cargo" required=""></select>
                  </div>
                  
                   <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="alianza">Alianza:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="alianza" id="alianza" required=""></select>
                  </div>

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Imagen</label>
                    <input type="file" class="form-control" name="imagen" id="imagen" >
                    <input type="hidden" name="imagenactual" id="imagenactual">
                    <img src="" width="50px" height="50px" id="imagenmuestra">
                  </div>
                  

                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="">Permisos</label>
                    <ul style="list-style: none;" id="permisos">
                      
                    </ul>
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
}else{
  require 'noacceso.php';
}
 require 'footer.php';
?>
 <script type="text/javascript" src="scripts/usuario.js"></script> 
<?php 
}
// Liberar el espacio del bufer
ob_end_flush();
?>