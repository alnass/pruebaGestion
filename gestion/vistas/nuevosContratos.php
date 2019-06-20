<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();
if (!isset($_SESSION["usu_nombre"]) ) {
  header("Location: login.html");
}else{
  require 'header.php';
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['informes']==1) {
?>
<!-- # encoded by @Francisco Monsalve-->
<!-- maintenance effectuee par Anderson Ferrucho -->
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" >
            <h3 class="text-center">
              <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
              <!-- DÉBUT MAINTENANCE -->
              Nuevos contratos de internet realizados por sede<br><br>
              <!-- FIN MAINTENANCE -->
            </h3>
            <div class="box-tools pull-right">
            </div>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Mes</th>
                <th>Bogotá</th>
                <th>Paipa</th>
                <th>Firavitoba</th>
                <th>Tibasosa</th>
                <th>Iza</th>
                <th>Fomeque</th>
                <th>San Antonio</th>
                <th>Corporativos</th>               
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Mes</th>
                <th>Bogotá</th>
                <th>Paipa</th>
                <th>Firavitoba</th>
                <th>Tibasosa</th>
                <th>Iza</th>
                <th>Fomeque</th>
                <th>San Antonio</th>
                <th>Corporativos</th>  
              </tfoot>
            </table>
          </div>
          <div class="box-header with-border" >
            <h3 class="text-center">
              <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
              <!-- DÉBUT MAINTENANCE -->
              Nuevos contratos de tv realizados por sede<br><br>
              <!-- FIN MAINTENANCE -->
            </h3>
            <div class="box-tools pull-right">
            </div>
          </div><!-- /.box-header -->
          <!--DEBUT MAINTENANCE -->
          <div class="panel-body table-responsive" id="listadoregistros2"><!-- centro -->
            <table id="tbllistado2" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Mes</th>
                <th>Bogotá</th>
                <th>Paipa</th>
                <th>Firavitoba</th>
                <th>Tibasosa</th>
                <th>Iza</th>
                <th>Fomeque</th>
                <th>San Antonio</th>
                <th>Corporativos</th>               
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Mes</th>
                <th>Bogotá</th>
                <th>Paipa</th>
                <th>Firavitoba</th>
                <th>Tibasosa</th>
                <th>Iza</th>
                <th>Fomeque</th>
                <th>San Antonio</th>
                <th>Corporativos</th>  
              </tfoot>
            </table>
          </div>
          <!--FIN MAINTENANCE -->
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
 <script type="text/javascript" src="scripts/nuevosContratos.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>