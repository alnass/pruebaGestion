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
  if ($_SESSION['gestionSuscript']==1) {
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
          <div class="box-header with-border"> <!-- box-header -->
            <h1 class="box-title">
              Gestión de suscriptores
            </h1> 
            <br>
   
            <a href="contrato.php">
              <button class="btn btn-warning" id="btnNvoContrato">
                <i class="fa fa-search"></i> 
                Gestion de contratos
              </button>
            </a>
            <!-- <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                <i class="fa fa-book"></i> 
                Contrato Nuevo suscriptor
            </button> -->
            <div class="box-tools pull-right">
            </div>
          </div> <!-- Fin box-header -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Num Documento</th>
                <th>Nombre</th>
                <th>Teléfono 1</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Estado</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Opciones</th>
                <th>Num Documento</th>
                <th>Nombre</th>
                <th>Teléfono 1</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <form name="formulario" id="formulario" method="POST">
              <div class="row">
                <h3>Datos del suscriptor</h3>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tipoPersona">Tipo de persona:</label>
                  <select class="form-control selectpicker" data-live-search="true" name="tipoPersona" id="tipoPersona" required=""></select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tipoCliente">Tipo de Cliente:</label>
                  <select class="form-control selectpicker" data-live-search="true" name="tipoCliente" id="tipoCliente" required=""></select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tipoDoc">Tipo de documento:</label>
                  <select class="form-control selectpicker" data-live-search="true" name="tipoDoc" id="tipoDoc" required=""></select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="numDoc">Número de documento:</label>
                  <input type="number" class="form-control" name="numDoc" id="numDoc" maxlength="45" placeholder="Número de documento" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="nombre">Nombres:</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" placeholder="Nombres" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="apellido">Apellidos:</label>
                  <input type="text" class="form-control" name="apellido" id="apellido" maxlength="45" placeholder="Apellidos" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tel1">Teléfono 1:</label>
                  <input type="text" class="form-control" name="tel1" id="tel1" maxlength="45" placeholder="Teléfono 1" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tel2">Teléfono 2:</label>
                  <input type="text" class="form-control" name="tel2" id="tel2" maxlength="45" placeholder="Teléfono 2">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="ciudad">Ciudad:</label>
                  <select class="form-control selectpicker" data-live-search="true" name="ciudad" id="ciudad" required=""></select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label for="barrio">Barrio:</label>
                  <input type="text" class="form-control" name="barrio" id="barrio" maxlength="45" placeholder="Barrio" required="">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="tipoVivien">Tipo de vivienda:</label>
                  <select class="form-control selectpicker" data-live-search="true" name="tipoVivien" id="tipoVivien" required=""></select>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label for="direccion">Dirección:</label>
                  <input type="text" class="form-control" name="direccion" id="direccion" maxlength="45" placeholder="Dirección" required="">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <label for="correoPer">Correo personal:</label>
                  <input type="email" class="form-control" name="correoPer" id="correoPer" maxlength="45" placeholder="Correo personal" required="">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <label for="correoCorp">Correo corporativo:</label>
                  <input type="email" class="form-control" name="correoCorp" id="correoCorp" maxlength="45" placeholder="Correo corporativo">
                </div>
                <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                  <label for="per_id">Código:</label>
                  <input type="text" class="form-control" name="per_id" id="per_id" maxlength="45" placeholder="Código" readonly="">
                </div>
              </div>
              
              <div class="row" style="background-color: #E3F6CE;"> <!-- Inicio primera fila de datos de contrato -->
                  <h3>Datos del contrato</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="hidden"  name="cont_id" id="cont_id">
                    <input type="hidden"  name="no_contrato" id="no_contrato">
                    <label for="">Dirección del servicio:</label>
                    <input type="text" class="form-control" name="direccion_serv" id="direccion_serv" maxlength="128" placeholder="Dirección del servicio" required="">
                  </div>

                  <div class="form-group col-lg-2 col-md-2   col-sm-6 col-xs-12">
                    <label for="contbarrio">Barrio:</label>
                    <input type="text" class="form-control" name="contbarrio" id="contbarrio" maxlength="128" placeholder="Barrio del servicio" required="">
                  </div>

                  <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <label for="conttipvivi">Tipo de vivienda:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="conttipvivi" id="conttipvivi" required=""></select>
                  </div>
                  
                  <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <label for="estrato">Estrato</label>
                    <select class="form-control selectpicker" data-live-search="true" name="estrato" id="estrato" required="">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="vigencia_a_partir">Vigencia a partir de:</label>                          
                    <input type="date" class="form-control" name="vigencia_a_partir" id="vigencia_a_partir" value="<?php echo date("Y-m-d")?>">
                  </div>

                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="fecha_activacion">Fecha de activación:</label> 
                    <input type="date" class="form-control" name="fecha_activacion" id="fecha_activacion" value="<?php
                      $hoy = date("Y-m-d");
                      $activacion = strtotime('+15 day', strtotime($hoy));
                      $activacion = date('Y-m-d', $activacion);
                      echo $activacion;
                      ?>">
                  </div>
                </div><!-- Fin primera fila de datos de contrato -->
                <div class="row" style="background-color: #E3F6CE;"> <!-- Inicio segunda fila de datos de contrato -->
                  <div class="form-group col-lg-3 col-md-3   col-sm-6 col-xs-12">
                    <label for="adicional">Producto adicional:</label>
                    <input type="text" data-toggle="tooltip" title="El producto adicional se registra una única vez y es cargado en cuenta por cobrar en el estado de cuenta del suscriptor." class="form-control" name="adicional" id="adicional" maxlength="128" placeholder="Producto adicional">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="cargo_adicional">Cargo adicional:</label>
                    <input type="number" data-toggle="tooltip" title="El cargo adicional corresponde al valor a cobrar por el ‘Producto Adicional’." class="form-control" name="cargo_adicional" id="cargo_adicional" >
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="cargo_conexion">Cargo de la conexión:</label>
                    <input type="number" class="form-control"  name="cargo_conexion" id="cargo_conexion" >
                  </div>
                  <!-- <div class="form-group col-lg-3 col-md-3   col-sm-6 col-xs-12">
                    <p>
                      En al caso de tener permanencia el <strong>"Cargo de conexión"</strong> será financiado a <strong>12 cuotas</strong>, de <strong>"NO"</strong> tener cláusula de permanencia, se cargara el <strong>VALOR TOTAL</strong> de cargo de conexión a la cuenta del suscriptor. 
                    </p>
                  </div> -->
                  <div class="form-check col-lg-1 col-md-1 col-sm-12 col-xs-12">
                    <label  for="permanencia">Permanencia:</label>
                    <br>
                    <select name="permanencia" id="permanencia" required="" onchange="
                        if(this.value==0){
                          document.getElementById('valor_diferido').disabled = true;
                        } else {
                          document.getElementById('valor_diferido').disabled = false;
                        }" data-toggle="tooltip" title="En al caso de tener permanencia el 'Cargo de conexión' será financiado a 12 cuotas, de 'NO' tener cláusula de permanencia, se cargara el VALOR TOTAL de conexión a la cuenta del suscriptor.">
                      <option value="1" selected="selected">SI</option>
                      <option value="0">NO</option>
                    </select>
                    <br>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="valor_diferido">Valor del diferido:</label>
                    <input type="number" data-toggle="tooltip" title="El “Valor del diferido” representa el valor que se cobra por conexión cuando no se realiza el “Cargo de conexión” en su totalidad, este descuenta del cargo de conexión y el restante es diferido a 12 meses." class="form-control" name="valor_diferido" id="valor_diferido" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="costo_reconexion">Valor de re-conexión:</label>
                    <input type="number" class="form-control" name="costo_reconexion" id="costo_reconexion" >
                  </div>
                </div><!-- Fin segunda fila de datos de contrato -->
                <div class="row" style="background-color: #E3F6CE;"> <!-- Inicio tercer fila de datos de contrato -->
                  <!-- <div class="form-group col-lg-3 col-md-3   col-sm-6 col-xs-12">
                    <p>
                      El <strong>“Valor del diferido”</strong> representa el valor que se <strong>cobra por conexión</strong> cuando no se realiza el <strong>“Cargo de conexión”</strong> en su totalidad, este descuenta del cargo de conexión y el restante es diferido a <strong>12 meses</strong>. 
                    </p>
                  </div> -->
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="fecha_ini_perm">Inicio de permanencia:</label>                          
                    <input type="date" class="form-control" name="fecha_ini_perm" id="fecha_ini_perm" value="<?php echo date("Y-m-d")?>" >
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="fecha_fin_perm">Fin de permanencia:</label> 
                    <input type="date" class="form-control" name="fecha_fin_perm" id="fecha_fin_perm" value="<?php
                      $hoy = date("Y-m-d");
                      $activacion = strtotime('+1 year', strtotime($hoy));
                      $activacion = date('Y-m-d', $activacion);
                      echo $activacion;
                      ?>" >
                  </div>
                </div> <!-- Fin tercer fila de datos de contrato -->
                <div class="row" style="background-color: #E3F6CE;"> <!-- Inicio cuarta fila de datos de contrato -->
                  <div class="form-check col-lg-2 col-md-2 col-sm-12 col-xs-12 align-self-end">
                    <select name="renovacion_auto" id="renovacion_auto" required="">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                    <label class="form-check-label" for="renovacion_auto">Renovacion automatica:</label>
                  </div>
                  <div class="form-check col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <select name="tv_analogica" id="tv_analogica" required="">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                    <label class="form-check-label" for="tv_analogica">Televisión análoga:</label>
                  </div>
                  <div class="form-check col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <select name="tv_digital" id="tv_digital" required="">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                    <label class="form-check-label" for="tv_digital">Televisión digital:</label>
                  </div>
                  <div class="form-check col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <select name="internet" id="internet" required="">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                    <label class="form-check-label" for="internet">Internet:</label>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right">
                    <a data-toggle="modal" href="#myModal">
                      <button id="btnAgregarProducto" type="button" class="btn btn-primary">
                        <span class="fa fa-plus"></span>
                        Agregar productos
                      </button>
                    </a>
                  </div>
                </div> <!-- Fin cuarta fila de datos de contrato -->
              <div class="row"> <!-- Inicio de la tabla de productos --> 
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbldetalle" class="table table-striped table-border table-condensed table-hover">
                    <thead style="background-color: #CEE3F6;">
                      <th>Opciones</th>     
                      <th>Còdigo</th>     
                      <th>Nombre</th>     
                      <th>Descripciòn</th>     
                      <th>Cantidad</th>     
                      <th>Valor</th>   
                      <th>Subtotal</th>  
                      <th>Actualizar</th>  
                    </thead>
                    <tbody>
                      <!-- Cuerpo de la tabla -->
                    </tbody>
                    <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><input type="hidden" name="minimo_mensual" id="minimo_mensual"></th>
                      <th>TOTAL</th>
                      <th><h4 id="total">$/.  00</h4></th>
                      <th></th>
                    </tfoot>
                  </table>
                </div>
              </div> <!-- Fin Inicio de la tabla de productos -->

              <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <button class="btn btn-primary" type="submit" id="btnGuardar"> <!-- Boton de guardar -->
                    <i class="fa fa-save"></i>Guardar
                  </button>
                  <button class="btn btn-danger" onclick="cancelarform()" type="button"><!-- Boton de cancelar -->
                    <i class="fa fa-arrow-circle-left"></i>Cancelar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><!-- Ventana modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Seleccione un producto</h4>
      </div>
      <div class="modal-body">
        <table id="tblproductos" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #CEE3F6;">
            <th>Op</th>     
            <th>Nombre</th>     
            <th>Descripciòn</th>     
            <th>Valor</th>     
          </thead>
          <tbody>
            <!-- Contenido de la tabla -->
          </tbody>
          <tfoot>
            <th>Op</th>     
            <th>Nombre</th>     
            <th>Descripciòn</th>     
            <th>Valor</th>    
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div><!-- Fin ventana modal -->
<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/persona.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>