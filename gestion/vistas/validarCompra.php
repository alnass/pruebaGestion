<?php
// Activacion de almacenamiento en buffer
ob_start();
// Inicio de sesion
session_start();

if (!isset($_SESSION["usu_nombre"])) {
    header("Location: login.html");
} else {

    require 'header.php';
    // Validacion de permisos mediante variable de sesion
    if ($_SESSION['compra']==2) 
    {
    ?>
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"  >
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
          <center><img src="../files/Logo_Horizontal_vector.png" alt="" width="60%" height="auto" "screen"></center>
          <center><h3>Bienvenido al sistema de gestión <strong>Seccion Compras</strong></h3></center>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <h3 style="color: gray;">En esta sección, se podran aprobar o rechazar solicitudes de compra generadas por los diferentes departamentos.</h3>
      </div>
    </div>
    <div class="row"  >
      <div class="box" >
        <br>
        <div class="box-header with-border" id="encabezado_filtro">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
            <label>Filtrar solicitudes de compra por: </label>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
            <select class="form-control" id="filtrar">
              <option value="1">
                Nuevas
              </option>
              <option value="2">
                Aprobadas
              </option>
              <option value="3">
                Rechazadas
              </option>
            </select>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
          </div>
        </div>
        <div class="panel-body table-responsive" id="listadoregistros"> <!-- Inicio del panel de la tabla -->
          <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
            <thead>
              <th>Opcion</th>
              <th>Compra No.</th>
              <th id="fecha">Fecha</th>
              <th id="proveedor">Proveedor</th>
              <th id="solicitante">Teléfono</th>
              <th id="doc_princ">Documento</th>
              <th>Valor Compra</th>
              <th>Iva</th>
              <th>No. Cuenta</th>
              <th>Banco</th>
              <th id="responsable">Realizada por</th>
              <th id="motivo">Ver Detalle</th>
            </thead>
            <tbody>
              <!-- Cuerpo de la tabla -->
            </tbody>
            <tfoot>
              <th>Opcion</th>
              <th>Compra No.</th>
              <th id="fecha2">Fecha</th>
              <th id="proveedor2">Proveedor</th>
              <th id="solicitante2">Teléfono</th>
              <th id="doc_princ2">Documento</th>
              <th>Valor Compra</th>
              <th>Iva</th>
              <th>No. Cuenta</th>
              <th>Banco</th>
              <th id="responsable2">Realizada por</th>
              <th id="motivo2">Ver Detalle</th>
            </tfoot>
          </table> <!-- Fin de la tabla -->
        </div> <!-- Fin del panel de la tabla -->
      </div> <!-- fin del box-->
    </div> <!-- fin de row -->
    <div class="row"><!-- row formulario-->
        <div class="col-md-12">
          <div class="box">
            <div class="panel-body " style="height: auto;" id="formularioregistro">
              <form name="formulario" id="formulario" method="POST">
                <div class="row"> <!-- Inicio fila de datos del suscriptor -->
                  <h3>Datos del Proveedor</h3>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <input type="hidden"  name="per_id" id="per_id">
                    <label for="tipoProveedor">Personería:</label>
                    <input type="text" class="form-control" value="NATURAL" disabled=""> 
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="tipoCliente">Razon Social:</label>
                    <input type="text" class="form-control" id="razonSocial" value="MICROTIK" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="nombres">Documento:</label>
                    <input type="number" class="form-control" id="documento" value="800900300" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" disabled="" value="LUIS PACO">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="numDoc" value="PELAYO MANJARES" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="telefono">Telefono:</label>
                    <input type="number" class="form-control" id="tel1" value="2334455" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="tel1">Teléfono 2:</label>
                    <input type="number" class="form-control" id="tel2" value="3112334455" disabled="">
                  </div>
                  <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="nombre" value="CLL. 123 No. 45-67" disabled="">
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="email">Correo electronico:</label>
                    <input type="email" class="form-control" id="email" value="pacopm@microtik.com" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="ciudad">Ciudad:</label>
                    <input class="form-control" id="ciudad" value="CALI" disabled="">
                  </div>
                </div> <!-- Fin de la fila datos del suscriptor -->
                <div class="row"> <!-- Inicio primera fila de datos de contrato -->
                  <h3>Datos de la compra</h3>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="pagar_a">Realizar pago a nombre de:</label>
                    <input type="text" class="form-control" id="pagar_a" value="LUIS PELAYO" disabled="">
                  </div>
                  <div class="form-group col-lg-3 col-md-3   col-sm-6 col-xs-12">
                    <label for="cuenta">Numero de Cuenta:</label>
                    <input type="number" min="0" class="form-control" id="cuenta" value="8765782441" disabled="">
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="cuenta">Tipo de Cuenta:</label>
                    <div class="col-md-12">
                      <label class="checkbox-inline">
                        <input type="radio" name="tip_cuenta" value="1" checked="">Ahorros
                      </label>
                      <label class="checkbox-inline"><input type="radio" name="tip_cuenta" value="2"> Corriente</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <label for="banco">Banco</label>
                    <input type="text" class="form-control" id="banco" value="DAVIVIENDA" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="valor_comp">Valor total de la compra:</label>                          
                    <input type="" class="form-control" id="valor_comp" value="$ 2.000.000" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="iva">Iva:</label>                          
                    <input type="" class="form-control" min="0" id="iva" value="$ 313.328" disabled="">
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label for="valor_cnsgn">Valor a consignar:</label>                          
                    <input type="number" class="form-control" min="0" name="valor_cnsgn" id="valor_cnsgn" placeholder="Valor a consignar">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="destino">Destino de la compra:</label>
                    <input type="text" class="form-control" id="destino" value="RED EXTERNA" disabled="">
                  </div>
                </div><!-- Fin primera fila de datos de contrato -->
                <div class="row text-center"> <!-- Inicio cuarta fila de datos de contrato -->
                  <h3>Descripción de productos
                  <!-- <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right"> -->
                  </h3>
                  <!-- </div> -->
                </div> <!-- Fin cuarta fila de datos de contrato -->
                <div class="row">
                  <div class="panel-body table-responsive" id="listadoregistros">
                    <table id="tbldetalle" class="table table-striped table-border table-condensed table-hover">
                      <thead style="background-color: #CEE3F6;">
                        <th>Cant</th>     
                        <th>Descripciòn</th>     
                        <th>Valor Unitario</th>   
                        <th>Subtotal</th>  
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>     
                          <td>Router Microtick 100 Mbits</td>     
                          <td>100.000</td>   
                          <td>100.000</td>
                        </tr>
                        <tr>
                          <td>1</td>     
                          <td>Router Microtick 500 Mbits</td>     
                          <td>500.000</td>   
                          <td>500.000</td>  
                        </tr>
                        <tr>
                          <td>1</td>     
                          <td>Router Microtick 800 Mbits</td>     
                          <td>800.000</td>   
                          <td>800.000</td>  
                        </tr>
                        <tr>
                          <td>3</td>     
                          <td>Antena</td>     
                          <td>200.000</td>   
                          <td>600.000</td>  
                        </tr>
                      </tbody>
                      <tfoot>
                        <th>Cant. Items Comprados</th>
                        <th>6</th>
                        <th>TOTAL</th>
                        <th><h4 id="total">$2.000.000</h4></th>
                        <th></th>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12" id="guardar">

                    <!-- Boton de guardar -->
                    <button class="btn btn-primary" type="submit" id="btnGuardar">
                      <i class="fa fa-save"></i>Guardar
                    </button>
                    
                    <!-- Boton de cancelar -->
                    <button class="btn btn-danger" onclick="cancelarform()" type="button">
                      <i class="fa fa-arrow-circle-left"></i>Cancelar
                    </button>
                  </div>
                </div>
              </form> <!-- Fin de formulario -->
            </div>
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- fin row formulario-->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><!-- Ventana modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Por favor indique el motivo de rechazó de la compra</h4>
      </div>
      <div class="modal-body">
        <textarea type="text" class="form-control" name="obs_canc_comp" placeholder="Ingrese aquí la observación"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div><!-- Fin ventana modal -->
<?php
    }
    else
    {
      require 'sinacceso.php';
    }
require 'footer.php';
?>
<script type="text/javascript" src="scripts/validarCompra.js"></script>  
<?php
}
ob_end_flush();
?>