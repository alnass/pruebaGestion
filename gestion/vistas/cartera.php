<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();

require_once "../config/conexion.php";

  $sede = $_SESSION['usu_sede_id'];

  $sql = "SELECT * FROM cierre_final
          WHERE '$sede' = cie_fin_sede_id
          ORDER BY cie_fin_id DESC 
          LIMIT 1
          ";
  $valida = ejecutarConsultaSimpleFila($sql);
  $result = $valida['cie_fin_estado'];

if (!isset($_SESSION["usu_nombre"]) ) {
  header("Location: login.html");
}else{
  require 'header.php';
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['recaudos']==1 && $result != 0) {
?>
<!-- // # encoded by @Francisco Monsalve-->
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" style="background: #A9D0F5;">
            <h1 class="">
              <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
              Listado de cortes<br><br>
            </h1>
            <div class="box-tools pull-right">
            </div>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Barrio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Servicio</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>T</th>
                <th>Estado</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Barrio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>T</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <div class="row">  
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12"><!-- DATOS DEL SUSCRIPTOR -->
                </div>                
              </form>
            </div>            
          </div><!--Fin centro -->
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
 <script type="text/javascript" src="scripts/cartera.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>