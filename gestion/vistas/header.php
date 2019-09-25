<?php 
if (strlen(session_id()) < 1) {
  session_start();
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de gestión :: GlobalPlay</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/CustomInput/css/file-input.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/icon.ico">
    <!-- DATATABLES - Referancias a las hojas de estilo -->
    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
  </head>

  <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="escritorio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Sistema de gestión </b>GlobalPLay</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema de gestión GlobalPlay</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <a href="recaudo.php">
            <span class="label bg-blue">RECAUDO</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav"><!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o" id='contador'> 
                  </i>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">
                   
                  </li>
                  <li>
                    <ul id="notificaciones">
                      
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown user user-menu"> <!-- User Account: style can be found in dropdown.less -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/perfiles/<?php echo $_SESSION['usu_imagen']; ?>" class="user-image" alt="Usuario">
                  <span class="hidden-xs"><?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/perfiles/<?php echo $_SESSION['usu_imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      <span class="hidden-xs"><?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido']." ".$_SESSION['usu_alianza_id'] ?>
                      </span>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-danger btn-flat">
                        Cerrar
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar"><!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar"> <!-- sidebar menu: : style can be found in sidebar.less -->      
          <ul class="sidebar-menu">
            <?php //Acceso
              if ($_SESSION['acceso']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-key"></i> 
                      <span>Acceso</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                      <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Acceso -->
            <?php // Parametrizacion
              if ($_SESSION['paramet']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-cubes"></i>
                      <span>Parametros PQR´s</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="alianza.php">
                          <i class="fa fa-circle-o"></i> 
                          Alianza
                        </a>
                      </li>
                      <li>
                        <a href="canal.php"><i class="fa fa-circle-o"></i> 
                          Canal
                        </a>
                      </li>
                      <li>
                        <a href="categoria.php"><i class="fa fa-circle-o"></i> 
                          Categoria
                        </a>
                      </li>
                      <li>
                        <a href="tipoCanal.php"><i class="fa fa-circle-o"></i> 
                          Tipos de canal
                        </a>
                      </li>
                      <li>
                        <a href="tipoCliente.php">
                          <i class="fa fa-circle-o"></i> 
                          Tipos de clientes
                        </a>
                      </li>
                      <li>
                        <a href="tipoDocumento.php"><i class="fa fa-circle-o"></i> 
                          Tipo de documentos
                        </a>
                      </li>
                      <li>
                        <a href="tipoPqr.php"><i class="fa fa-circle-o"></i> 
                          Tipo de PQR´s
                        </a>
                      </li>
                      <li>
                        <a href="tipoVivienda.php"><i class="fa fa-circle-o"></i> 
                          Tipo de vivienda
                        </a>
                      </li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Parametrizacion -->
            <?php //Configuracion general
              if ($_SESSION['configGeneral']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-cogs"></i>
                      <span>Configuracion general</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">';
                    if ($_SESSION['usu_area_id']==7) 
                    {
                      echo '
                      <li>
                        <a href="area.php"><i class="fa fa-circle-o"></i> 
                          Area laboral
                        </a>
                      </li>
                      <li>
                        <a href="cargo.php"><i class="fa fa-circle-o"></i> 
                          Cargos
                        </a>
                      </li>
                      <li>
                        <a href="ciudad.php"><i class="fa fa-circle-o"></i> 
                          Ciudades
                        </a>
                      </li>
                      <li>
                        <a href="conceptoTransaccion.php"><i class="fa fa-circle-o"></i> 
                          Concepto de transacción
                        </a>
                      </li>';
                    }
                    echo'
                      <li>
                        <a href="sede.php">
                          <i class="fa fa-circle-o"></i> 
                          Sedes
                        </a>
                      </li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Configuracion general -->
            <?php //Gestio de productos
              if ($_SESSION['gestionProductos']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-shopping-cart"></i>
                      <span>Productos</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="producto.php"><i class="fa fa-circle-o"></i> 
                          Productos
                        </a>
                      </li>
                    </ul>';
                  '</li>';  
              }
            ?> <!-- Fin Gestio de productos -->
            <?php //Gestion de suscriptores
              if ($_SESSION['gestionSuscript']==1) {
                echo '
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-slideshare"></i> <span>Suscriptores</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="persona.php">
                        <i class="fa fa-circle-o"></i> 
                        Gestion suscriptores
                      </a>
                    </li>            
                  </ul>
                </li>
                ';
              }
            ?> <!-- Fin Gestion de suscriptores -->
            <?php //Registro de PRRs
              if ($_SESSION['registroPqr']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-tasks"></i>
                      <span>Gestión de PQR´s</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="registroPqr.php"><i class="fa fa-circle-o"></i> 
                          Registro de PQR´s
                        </a>
                      </li>
                      <li>
                        <a href="seguimientoPqr.php"><i class="fa fa-circle-o"></i> 
                          Seguimiento PQR´s
                        </a>
                      </li>
                      
                    </ul>
                  </li>
                ';
               } 
            ?> <!-- Fin Registro de PRRs -->
            <?php //Reportes
              if ($_SESSION['reportes']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="reporteCaja.php"><i class="fa fa-circle-o"></i>Cuadre de caja</a>
                      </li>
                      <!--<li>
                        <a href="consultapqrfecha.php"><i class="fa fa-circle-o"></i>PQR´s por Fecha</a>
                      </li>-->
                      <li>
                        <a href="consultaEfectivoHoy.php"><i class="fa fa-circle-o"></i>Seleccionar Caja efectivo</a>
                      </li> 
                      <li>
                        <a href="../reportes/exEfectivoSedes.php" target="_blanck"><i class="fa fa-circle-o"></i>Efectivo en Sedes x Día</a>
                      </li> 
                      <li>
                        <a href="apertura.php" target="_blanck"><i class="fa fa-circle-o"></i>Hora de acceso al sistema</a>
                      </li>                
                    </ul>
                  </li>
                ';  
              }
            ?> <!-- Fin Reportes -->
            <?php  //Inicio de Informes Administrativos
              if ($_SESSION['informes']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-th-list"></i> <span>Informes Admin</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Consolidado Ventas</a>
                        <ul class="treeview-menu">
                          <li>
                            <a href="consolidadoVentas.php"><i class="fa fa-circle-o"></i>Por año</a>
                          </li>
                          <li>
                            <a href="consolidadoVentasMesActual.php"><i class="fa fa-circle-o"></i>Último mes</a>
                          </li>
                        </ul>
                      </li> 
                      <li>
                        <a href="consultaUsuarios.php">
                          <i class="fa fa-circle-o"></i> 
                          Usuarios por Estado
                        </a>
                      </li> 
                      <li>
                        <a href="nuevosContratos.php">
                          <i class="fa fa-circle-o"></i> 
                          Nuevos contratos
                        </a>
                      </li>                                   
                      <li>
                        <a href="bdGeneral.php">
                          <i class="fa fa-circle-o"></i> 
                          Base general
                        </a>
                      </li>                                   
                    </ul>
                  </li>
                ';  
              }
            ?> <!-- Fin de Informes Administrativos -->
            <?php //Contratos
              if ($_SESSION['contrato']==1) 
              {
                echo '
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-book"></i> <span>Contratos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="contrato.php">
                        <i class="fa fa-circle-o"></i> 
                        Gestión contratos
                      </a>
                    </li>  
                    <li>
                      <a href="#" data-toggle="modal" data-target="#ModalContrato">
                        <i class="fa fa-question-circle"></i> 
                        Ayuda
                      </a>
                    </li>            
                  </ul>
                </li>';
              }
            ?> <!-- Fin Contratos -->
            <?php //Recaudo
                date_default_timezone_set("America/Bogota");
              if ($_SESSION['recaudos']=='1') {
                $hoy = date('Y-m-d');
                require_once "../config/conexion.php";
                $sede = $_SESSION['usu_sede_id'];
                $sql = "SELECT * FROM cierre_final
                        WHERE '$sede' = cie_fin_sede_id
                        ORDER BY cie_fin_id DESC 
                        LIMIT 1
                        ";
                $valida = ejecutarConsultaSimpleFila($sql);
                $result = $valida['cie_fin_estado'];
                $fecha_cierre = new DateTime($valida['cie_fin_fecha']);
                $fecha_cierre->format('Y-m-d');
                
                if ($result != 0) {
                  echo '
                    <li class="treeview">
                      <a href="recaudo.php">
                        <i class="fa fa-money"></i> <span>Recaudos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li>
                          <a href="recaudo.php">
                            <i class="fa fa-circle-o"></i> 
                            Registro de pagos
                          </a>
                        </li>   
                        <li>
                          <a href="cartera.php">
                            <i class="fa fa-circle-o"></i> 
                            Cartera
                          </a>
                        </li>   
                        <li>
                          <a href="cuadreCaja.php">
                            <i class="fa fa-circle-o"></i> 
                            Cuadre de caja
                          </a>
                        </li> 
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-arrow-down"></i> 
                            Cierres
                          </a>
                          <ul class="treeview-menu">
                            <li>
                              <a href="../reportes/exCierreParcial.php?cierre=Cierre parcial de caja" onclick="insertarcierreparcial()" target="_blanck">
                                <i class="fa fa-circle-o"></i> 
                                Cierre parcial
                              </a>
                            </li>';
                            if($_SESSION['usu_sede_id'] == 11 || $_SESSION['usu_sede_id'] == 12)
                            {
                              echo '<li>
                                <a href="../reportes/exRecaudoMensual.php?cierre=Cierre parcial del mes"&sede='.$_SESSION['usu_sede_id'].' target="_blanck">
                                  <i class="fa fa-circle-o"></i> 
                                  Cierre del Mes
                                </a>
                              </li>';
                            }
                            echo '<li>
                              <a  onclick="insertarcierrefinal()">
                                <i class="fa fa-circle-o"></i> 
                                Cierre final
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a href="#" data-toggle="modal" data-target="#ModalRecaudo">
                            <i class="fa fa-question-circle"></i> 
                            Ayuda
                          </a>
                        </li>         
                      </ul>
                    </li>
                  ';
                }
              }
            ?> <!-- Fin Recaudo -->
            <?php // Generar Cuentas de Cobro
              require_once "../config/conexion.php";

              $usuario  =   $_SESSION['usu_id'];
                $sql2   =   "SELECT * FROM cntrl_imp_cuentas
                            WHERE cntrl_imp_cuentas_usu_id = '$usuario'
                            ORDER BY cntrl_imp_cuentas_id DESC 
                            LIMIT 1";

                $valida_imp   =   ejecutarConsultaSimpleFila($sql2);
                $result_imp   =   $valida_imp['cntrl_imp_cuentas_estado'];


              if ($_SESSION['cuentasCobro']==1) 
              {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-file-pdf-o"></i> <span>Cuentas de Cobro</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="cuentaCobroSede.php">
                          <i class="fa fa-circle-o"></i> 
                          Individuales
                        </a>
                      </li>';
                if(empty($result_imp))
                {
                      echo'
                      <li>
                        <a href="../reportes/cobroDuoFinal.php?sede="'.$_SESSION['usu_sede_id'].'>
                          <i class="fa fa-circle-o"></i> 
                          Masivos
                        </a>
                      </li>
                    </ul>
                  </li>';
                }
                else if($result_imp == 0)
                {
                  echo'
                      <li>
                        <a href="../reportes/cobroDuoFinal.php?sede="'.$_SESSION['usu_sede_id'].'>
                          <i class="fa fa-circle-o"></i> 
                          Masivos
                        </a>
                      </li>
                    </ul>
                  </li>'; 
                }
                else
                {
                  echo '
                    </ul>
                  </li>';
                }
              } 
            ?> <!-- Fin Generar Cuentas de Cobro-->
            <?php //Contratos
            echo '
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-credit-card"></i> <span>Compras</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">';
              if ($_SESSION['compras']==1) 
              {
                echo '
                    <li>
                      <a href="generarCompra.php">
                        <i class="fa fa-circle-o"></i> 
                        Generar nueva
                      </a>
                    </li>';
              }
              if ($_SESSION['compra']==2) 
              {
                 echo'
                    <li>
                      <a href="validarCompra.php">
                        <i class="fa fa-circle-o"></i> 
                        Validar solicitudes
                      </a>
                    </li>';
              }
                  echo'
                  </ul>
                </li>';
            ?> <!-- Fin Contratos -->
            
            <?php //Equipos
              if ($_SESSION['equipos']==1) {
                echo '
                  <li class="treeview">
                    <a href="equipos.php">
                      <i class="fa fa-laptop"></i> <span>Equipos</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="referencia.php">
                          <i class="fa fa-circle-o"></i> 
                          Referencias
                        </a>
                      </li>   
                      <li>
                        <a href="equipoTipo.php">
                          <i class="fa fa-circle-o"></i> 
                          Tipos
                        </a>
                      </li>
                      <li>
                        <a href="fabricante.php">
                          <i class="fa fa-circle-o"></i> 
                          Fabricantes
                        </a>
                      </li>    
                      <li>
                        <a href="equipoEstado.php">
                          <i class="fa fa-circle-o"></i> 
                          Estados
                        </a>
                      </li>            
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Equipos -->
            <?php //Inventario
              if ($_SESSION['inventario']==1) {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-pencil-square-o"></i> <span>Inventario</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="">
                          <i class="fa fa-circle-o"></i> 
                          Equipos
                        </a>
                        <ul class="treeview-menu">
                          <li>
                            <a href="equipoDetalle.php">
                              <i class="fa fa-circle"></i> 
                              Nuevo
                            </a>
                          </li>
                          <li>
                            <a href="referencia.php">
                              <i class="fa fa-circle"></i> 
                              Referencias
                            </a>
                          </li>
                          <li>
                            <a href="equipoInstalado.php">
                              <i class="fa fa-circle"></i> 
                              Instalados
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="">
                          <i class="fa fa-circle-o"></i> 
                          Maquinaria
                        </a>
                      </li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Inventario -->             
            <?php //Orden de Trabajo
              if ($_SESSION['ordenTrabajo']==1) {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-motorcycle"></i> <span>Orden de Trabajo</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="ordenTrabajo.php">
                          <i class="fa fa-circle-o"></i> 
                          Nueva OT
                        </a>
                      </li>
                      <li>
                        <a href="seguimientoOT.php">
                          <i class="fa fa-circle-o"></i> 
                          Seguimiento OT
                        </a>
                      </li>
                      <li>
                        <a href="cierresOT.php">
                          <i class="fa fa-circle-o"></i> 
                          OT Cerradas
                        </a>
                      </li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Orden de Trabajo -->
            <?php // Operaciones Tecnicas 
              if ($_SESSION['opTecnicas']==1) {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-wrench"></i> <span>Operaciones Técnicas</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="cortes.php">
                          <i class="fa fa-circle-o"></i> 
                          Cortes
                        </a>
                      </li>
                      
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Orden de Trabajo -->
            <?php // Operaciones Tecnicas 
              if ($_SESSION['opAdmin']==1) {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-black-tie"></i> <span>Operaciones Admin.</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="activarRecaudo.php">
                          <i class="fa fa-circle-o"></i> 
                          Habilitar recuado
                        </a>
                      </li>
                      <li>
                        <a href="facturacion.php">
                          <i class="fa fa-circle-o"></i> 
                          Cargar factura
                        </a>
                      </li>
                      <li>
                        <a href="listarestadodeservicio.php">
                          <i class="fa fa-circle-o"></i> 
                          Seguimiento de estados
                        </a>
                      </li>
                      <li>
                        <a href="cerrarContrato.php">
                          <i class="fa fa-circle-o"></i> 
                          Cerrar contratos
                        </a>
                      </li>
                      <li>
                        <a href="listarpostcierre.php">
                          <i class="fa fa-circle-o"></i> 
                          Activaciones postcierre
                        </a>
                      </li>
                      <li>
                        <a href="cambioFechapp.php">
                          <i class="fa fa-circle-o"></i> 
                          Cambio fecha P.P.
                        </a>
                      </li>
                      <li>
                        <a href="cuentaCobro.php">
                          <i class="fa fa-circle-o"></i> 
                          Impresion de cuentas
                        </a>
                      </li>
                      
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Orden de Trabajo -->
            <?php //Operaciones Contables
              if ($_SESSION['inventario']==1) {
                echo '
                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-line-chart" aria-hidden="true"></i><span>Operaciones Contables</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">';
              if ($_SESSION['notasdebcred']==1) 
              {
                echo '
                      <li>
                        <a href="">
                          <i class="fa fa-usd"></i> <span>Notas a cuenta</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">';
                          
                if ($_SESSION['notasdebito']==1) 
                {         
                        echo'
                          <li>
                            <a href="notaDebito.php">
                              <i class="fa fa-circle-o"></i> 
                                Notas debito
                            </a>
                          </li>';
                }
                if ($_SESSION['notascredito']==1) 
                {         
                  echo
                          '
                          <li>
                            <a href="notaCredito.php">
                              <i class="fa fa-circle-o"></i> 
                                Notas credito
                            </a>
                          </li>';
                }
                  echo '
                        </ul>
                      </li>';
              } 
                echo  '
                      <li>
                        <a href="#">
                          <i class="fa fa-circle"></i> 
                            Gastos
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-circle"></i> 
                            Trasalado Efectivo
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-circle"></i> 
                            Recaudo Admon
                        </a>
                      </li>
                    </ul>
                  </li>
                ';
              }
            ?> <!-- Fin Inventario --> 
          </ul>
        </section>
      </aside><!-- /.sidebar -->
    
