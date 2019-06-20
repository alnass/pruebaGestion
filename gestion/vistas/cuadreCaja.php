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
<!-- 
// # encoded by @Francisco Monsalve

-->
<!--Contenido-->
<img src="" alt="" style="height: 50px;">
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" style="background: #229954;">
            <h1 class="" style="color: #fff;">
              Registro de salidas diarias
            </h1>
          </div><!-- /.box-header -->
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <form name="formulario" id="formulario" method="POST">
              <div class="row">  
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12"><!-- DATOS DEL SUSCRIPTOR -->
                  <label for="fecha_inicio">Fecha</label>
                  <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d H:m:s")?>" readonly="" >
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <label for="tipo_salida">Tipo de gasto:</label>
                  <select class="form-control selcetpicker" data-live-search="true" name="tipo_salida" id="tipo_salida" required="" title="Seleccione un tipo de gasto"></select>
                </div>
                <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                  <label for="no_doc">No Doc:</label>
                  <input type="text" class="form-control" name="no_doc" id="no_doc">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label for="descripcion">Concepto:</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" onKeyUp="this.value=this.value.toUpperCase();">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="valor">Valor:</label>
                  <input type="number" class="form-control" name="valor" id="valor" required="">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label for="valor">Evidencia:</label>
                  <input type="file" class="form-control" name="imagen" id="imagen"  data-toggle="tooltip" data-placement="right" title="Adjunte una evidencia del gasto" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 " style="margin-top: 25px;">
                    <label for=""></label>
                    <button class="btn btn-success" type="submit" id="btnGuardar"> <!-- Boton de guardar -->
                      <i class="fa fa-save"></i>Guardar
                    </button>
                    <!-- <button class="btn btn-danger " onclick="cancelarform()" type="button">
                      <i class="fa fa-arrow-circle-left"></i>Cancelar
                    </button> -->
                </div> 
              </div>
              <div class="row">
                <div class="form-group col-lg-10 col-md-10 col-sm-6 col-xs-12 text-right " >
                    <h3>Total de efectivo del dia</h3>                  
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 text-right ">
                  <strong>
                    <h3 id="totalEfectivo">$</h3>
                  </strong>
                </div>
                <div class="form-group col-lg-10 col-md-10 col-sm-6 col-xs-12 text-right ">
                    <h3>Total de salidas del dia</h3>                  
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 text-right">
                  <strong>
                    <h3 id="totalSalida">$</h3>
                  </strong>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12 text-left" style="border-top: solid #229954 2px">
                    <h3 style="color:#229954;">EFECTIVO GENERAL</h3>                  
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12 text-left " style="border-top: solid #229954 2px">
                  <strong>
                    <h3 id="efectivoGeneral" style="color:#229954;">$</h3>
                  </strong>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 text-right" style="border-top: solid #229954 2px">
                    <h3 style="color:#229954;">SALDO EFECTIVO DEL DIA</h3>                  
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 text-right " style="border-top: solid #229954 2px">
                  <strong>
                    <h3 id="saldoEfectivo" style="color:#229954;">$</h3>
                  </strong>
                </div>
                
              </div>

            </form>
            <div class="row">
              <div class="panel-body table-responsive" id="estadocta">
                <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                  <thead style="background-color: #CED8F6;">
                    <th>ID</th>
                    <th>Fecha Transacción</th>
                    <th>Tipo</th>
                    <th>No Doc</th>
                    <th>Concepto</th>
                    <th>Valor</th>
                    <th>Usuario</th>
                    <th>Sede</th>
                  </thead>
                  <tbody>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <th>ID</th>
                    <th>Fecha Transacción</th>
                    <th>Tipo</th>
                    <th>No Doc</th>
                    <th>Concepto</th>
                    <th>Valor</th>
                    <th>Usuario</th>
                    <th>Sede</th>
                  </tfoot>
                </table>
              </div>
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
 <script type="text/javascript" src="scripts/cuadreCaja.js"></script>  
<?php 
}
// liberar el espacio del bufer
ob_end_flush();
?>