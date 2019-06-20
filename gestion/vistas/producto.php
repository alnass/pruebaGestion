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
  if ($_SESSION['gestionProductos']==1) {
?>
<!-- # encoded by @Francisco Monsalve-->

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
                          <h1 class="box-title">Producto<br><br></h1>
                        </div>
                        <div id="funcion">
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                              <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <select class="form-control" name="filtro" id="filtro" required="">
                              <option>
                                Seleccione un valor para filtrar
                              </option>
                              <option value="1">
                                TODOS
                              </option>
                              <option value="2">
                                PERSONALIZADOS
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
                            <th>Código</th>
                            <th>Prefjo</th>
                            <th>Nombre</th>
                            <th>Decripcion</th>
                            <th>Valor</th>
                            <th>Dcto PP</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Id.</th>
                            <th>Código</th>
                            <th>Prefjo</th>
                            <th>Nombre</th>
                            <th>Decripcion</th>
                            <th>Valor</th>
                            <th>Dcto PP</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: 400px;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                            <label for="codigo">Código:</label>
                            <input type="hidden"  name="prod_id" id="prod_id">
                            <input type="text" class="form-control" name="codigo" id="codigo" maxlength="45" placeholder="Código" required="">
                          </div>

                          <!-- Captura de Descripción -->
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="prefijo">Prefijo:</label>
                            <select class="form-control" name="prefijo" id="prefijo" data-toggle="tooltip" title="Prefijo que identifica el producto" required="">
                              <option>
                                Seleccione un valor
                              </option>
                              <option value="TVA">
                                TVA
                              </option>
                              <option value="INT">
                                INT
                              </option>
                              <option value="TVD">
                                TVD
                              </option>
                            </select> 
                          </div>
                          <!-- Captura de Tiempo -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="512" placeholder="Descripción" required="">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <label for="desc">Descripción:</label>
                            <input type="text" class="form-control" name="desc" id="desc" maxlength="512" placeholder="Ingrese una descripción del producto" required="">
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="valor">Valor:</label>
                            <input type="number" min="10000" class="form-control" name="valor" id="valor" placeholder="Valor Mensual" required="">
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="valorptopago" data-toggle="tooltip" title="Valor descuento pronto pago">Descuento PP:</label>
                            <input type="number" class="form-control" data-toggle="tooltip" title="Valor descuento pronto pago" name="valorptopago" id="valorptopago" min="1000" placeholder="Pronto Pago">
                          </div>
                
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="stock">Stock:</label>
                            <input type="number" min="1" class="form-control" name="stock" id="stock" placeholder="Stock">
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="stock">Personalizado</label>
                            <select class="form-control" name="personalizado" id="personalizado" data-toggle="tooltip" title="Producto aplicado solo a un contrato" required="">
                              <option>
                                Seleccione un valor
                              </option>
                              <option value="1">
                                SI
                              </option>
                              <option value="0">
                                NO
                              </option>
                            </select> 
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
 <script type="text/javascript" src="scripts/producto.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>