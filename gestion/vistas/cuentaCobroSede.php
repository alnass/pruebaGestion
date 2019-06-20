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
  if ($_SESSION['cuentasCobro']==1) {
?>
<!-- 
// # encoded by @Francisco Monsalve

-->
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" style="background: #A9D0F5;">
            <h1 class="">
              <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
              Listado para impresión de cuentas de cobro individuales<br><br>
            </h1>
            <div class="box-tools pull-right">
            </div>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Tipo</th>
                <th>No Documento</th>
                <th>Nombre suscriptor</th>
                <th>Dirección del servicio</th>
                <th>Teléfono</th>
                <th>Contrato</th>
                <th>Barrio</th>
                <th>Est Serv</th>
                <th>Mensualidad</th>
                <th>Saldo anterior</th>
                <th>Total a pagar</th>
                <th>Sede</th>
                <th>Servicio</th>
                <th>Pto pago</th>
                <th>Fecha Contrato</th>
                <th>Dirección sede</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Tipo</th>
                <th>No Documento</th>
                <th>Nombre suscriptor</th>
                <th>Dirección del servicio</th>
                <th>Teléfono</th>
                <th>Contrato</th>
                <th>Barrio</th>
                <th>Est Serv</th>
                <th>Mensualidad</th>
                <th>Saldo anterior</th>
                <th>Total a pagar</th>
                <th>Sede</th>
                <th>Servicio</th>
                <th>Pto pago</th>
                <th>Fecha Contrato</th>
                <th>Dirección sede</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <div class="row">  
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12"><!-- DATOS DEL SUSCRIPTOR -->
                
                  <div class="form-group">
                  </div>  
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
 <script type="text/javascript" src="scripts/cuentaCobro.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>