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
    if ($_SESSION['compras']==1) 
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
        <h3 style="color: gray;">En esta sección, se podran generar o consultar las compras realizadas por el usuario <strong><?php echo $_SESSION["usu_nombre"]; ?></strong>.</h3>
      </div>
    </div>
    <div class="row"  >
      <div class="box" >
        <div class="box-header with-border" id="filtros">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
            <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
              <i class="fa fa-plus-circle"></i> 
                Nueva compra
            </button>
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
        </div><!-- /.box-header -->
        <div class="panel-body table-responsive" id="listadoregistros"> <!-- Inicio del panel de la tabla -->
          <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
            <thead>
              <th>IMP</th>
              <th>Compra No.</th>
              <th>Fecha</th>
              <th>Proveedor</th>
              <th>Teléfono</th>
              <th>Documento</th>
              <th>Valor Compra</th>
              <th>Iva</th>
              <th>Cant. Items</th>
              <th>Aprobacion</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </thead>
            <tbody>
              <!-- Cuerpo de la tabla -->
            </tbody>
            <tfoot>
              <th>IMP</th>
              <th>Compra No.</th>
              <th>Fecha</th>
              <th>Proveedor</th>
              <th>Teléfono</th>
              <th>Documento</th>
              <th>Valor Compra</th>
              <th>Iva</th>
              <th>Cant. Items</th>
              <th>Aprobacion</th>
              <th>Editar</th>
              <th>Eliminar</th>
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
                <div class="row">
                  <div class="col-lg-4 col-md-2 col-sm-2 col-xs-12">
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 text-center">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Seleccione un proveedor
                      </div>
                      <div class="panel-body">
                        <a data-toggle="modal" href="#myModal2">
                          <button id="btnProveedor" type="button" class="btn btn-warning" >
                            <span class="fa fa-plus"></span>
                          </button>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                  </div>
                </div>
                 <!-- Inicio fila de datos del proveedor -->
                <div class="row" id="proveedor">
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      <label>Ingresar nuevo Proveedor</label>
                    </div>
                    <div class="panel-body">
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <input type="hidden"  name="per_id" id="per_id">
                        <label for="tipoProveedor">Personería:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="tipoProveedor" id="tipoProveedor" required="">
                          <option value="1">
                            NATURAL
                          </option>
                          <option value="1">
                            JURIDICA
                          </option>
                        </select>
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="tipoCliente">Razon Social:</label>
                        <input type="text" class="form-control" name="razonSocial" id="razonSocial" placeholder="Razón Social" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="nombres">Documento:</label>
                        <input type="number" class="form-control" name="documento" id="documento" placeholder="Numero de Documento" required="">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" name="numDoc" id="numDoc" placeholder="Apellidos" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="telefono">Telefono:</label>
                        <input type="number" class="form-control" name="tel1" id="tel1" maxlength="45" placeholder="Telefono" required="">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="tel1">Teléfono 2:</label>
                        <input type="number" class="form-control" name="tel2" id="tel2" maxlength="45" placeholder="Teléfono 2">
                      </div>
                      <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="nombre" placeholder="Direccion" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="email">Correo electronico:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" required="" >
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="ciudad">Ciudad:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="ciudad" id="ciudad" required=""></select>
                      </div>
                    </div>
                  </div>
                </div> <!-- Fin de la fila datos del suscriptor -->
                <div class="row"> <!-- Inicio primera fila de datos de contrato -->
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      <label>Datos de la compra</label>
                    </div>
                    <div class="panel-body">
                      <div class="panel panel-success text-center" id="datos_prov">
                        <input type="hidden" class="form-control" name="id_prove" id="id_prove" disabled="true">
                        <div class="panel-heading text-center" id="datos_prov">
                          <label for="pagar_a">Proveedor Seleccionado:</label>
                        </div>
                        <div class="panel-body">
                          <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center" id="datos_prov">
                            <input type="text" class="form-control" name="datos_proveedor" id="datos_proveedor" disabled="true">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center" id="datos_prov">
                            <input type="text" class="form-control" name="direc_proveedor" id="direc_proveedor" disabled="true">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center" id="datos_prov">
                            <input type="text" class="form-control" name="tel_proveedor" id="tel_proveedor" disabled="true">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label for="pagar_a">Realizar pago a nombre de:</label>
                        <input type="text" class="form-control" name="pagar_a" id="pagar_a" placeholder="Datos del Beneficiario:" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-3 col-md-3   col-sm-6 col-xs-12">
                        <label for="cuenta">Numero de Cuenta:</label>
                        <input type="number" min="0" class="form-control" name="cuenta" id="cuenta" placeholder="Ingrese número de cuenta" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="cuenta">Tipo de Cuenta:</label>
                        <div style="margin-top: 4px;">
                          <label class="checkbox-inline">
                            <input type="radio" name="tip_cuenta" value="1" id="ahorros"> Ahorros
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" name="tip_cuenta" value="2" id="corriente"> Corriente
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="banco">Banco</label>
                        <input type="text" class="form-control" name="banco" id="banco" placeholder="Banco a consignar:" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label for="valor_comp">Total de la compra:</label>                          
                        <input type="number" class="form-control" min="0" name="valor_comp" id="valor_comp" placeholder="Valor Total compra">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label for="iva">Iva:</label>                          
                        <input type="number" class="form-control" min="0" name="iva" id="iva" placeholder="Impuesto de iva">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label for="valor_cnsgn">Valor a consignar:</label>                          
                        <input type="number" class="form-control" min="0" name="valor_cnsgn" id="valor_cnsgn" placeholder="Valor a consignar">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="destino">Destino de la compra:</label>
                        <input type="text" class="form-control" name="destino" id="destino" placeholder="Ingrese información sobre el destino que se le asignará a la compra:" required="" onKeyUp="this.value=this.value.toUpperCase();">
                      </div>
                    </div>
                  </div>
                </div><!-- Fin primera fila de datos de contrato -->
                <div class="row"> <!-- Inicio cuarta fila de datos de contrato -->
                  <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      <label>Descripción de productos</label>
                      <!-- <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right"> -->
                    </div>
                    <div class="panel-body">
                      <div class="form-check col-lg-1 col-md-1 col-sm-12 col-xs-12 align-self-end">
                        <label class="form-check-label" for="item_cant">Cantidad:</label>
                        <input type="number" class="form-control" min="1" name="item_cant" id="item_cant" placeholder="Cant.">
                      </div>
                      <div class="form-check col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="form-check-label" for="item_descp">Descripcion:</label>
                        <input type="text" class="form-control" min="0" name="item_descp" id="item_descp" placeholder="Descripción del producto">
                      </div>
                      <div class="form-check col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="form-check-label" for="item_val">Valor Unitario:</label>
                        <input type="number" class="form-control" min="0" name="item_val" id="item_val" placeholder="Valor unitario.">
                      </div>
                      <div class="form-check col-lg-2 col-md-3 col-sm-12 col-xs-12" style="margin-top: 24px">
                        <button id="btnAgregarProducto" type="button" class="btn btn-success" onclick="agregarProducto()">
                          <span class="fa fa-plus"></span>
                            Agregar producto
                        </button>
                      </div>
                    </div>
                  </div>
                </div> <!-- Fin cuarta fila de datos de contrato -->
                <div class="row">
                  <div class="panel-body table-responsive" id="listadoregistros">
                    <table id="tbldetalle" class="table table-striped table-border table-condensed table-hover">
                      <thead style="background-color: #CEE3F6;">
                        <th>Opciones</th>     
                        <th>Cant</th>     
                        <th>Descripciòn</th>     
                        <th>Valor Unitario</th>   
                        <th>Subtotal</th>  
                      </thead>
                      <tbody>
                        <!-- Cuerpo de la tabla -->
                      </tbody>
                      <tfoot>
                        <th>Cant. Items</th>
                        <th></th>
                        <th><input type="hidden" name="minimo_mensual" id="minimo_mensual"></th>
                        <th>TOTAL</th>
                        <th><h4 id="total">$/.  00</h4></th>
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
<!-- Ventana modal proveedor-->
<div class="modal fade " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Listado de proveedores</h4>
      </div>
      <div class="modal-body">
        <label>Presione click sobre el boton para seleccionar un proveedor </label>
        <br>
        <table id="tblproveedor" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #CEE3F6;">
            <th></th>     
            <th>No.</th>     
            <th>Empresa</th>     
            <th>Vendedor</th>     
            <th>Telefono</th>     
            <th>Dirección</th>     
          </thead>
          <tbody>
            <!-- Cuerpo de la tabla   -->
          </tbody>
          <tfoot>
            <th></th>     
            <th>No.</th>     
            <th>Empresa</th>     
            <th>Vendedor</th>     
            <th>Telefono</th>     
            <th>Dirección</th>     
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana proveedor -->
<?php
    }
    else
    {
      require 'sinacceso.php';
    }
require 'footer.php';
?>
<script type="text/javascript" src="scripts/generarCompra.js"></script>  
<?php
}
ob_end_flush();
?>