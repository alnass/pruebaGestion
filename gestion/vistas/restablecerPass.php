<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GlobalPlay</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../public/css/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Sistema de gestión</b></a>
        <br>
        <br>
        <img src="../files/Logo_vector.png" alt="" width="200px" height="auto">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos de para restablecer contraseña</p>

        <form method="post" id="frmAcceso">

          <div class="form-group has-feedback">
            <label for="usuario">Ingrese nombre de usuario</label>
            <input type="text" class="form-control" id="logina" name="logina" placeholder="Usuario" required="">
            <span class="fa fa-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <label for="clavea">Ingrese contraseña anterior</label>
            <input type="password" class="form-control" id="clavea" name="clavea" placeholder="Password anterior" required="">
            <div class="input-group-append">
              <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword('clavea')"> 
                <span class="fa fa-eye-slash icon"></span> 
              </button>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="newpass">Ingrese nueva contraseña</label>
            <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Nuevo password" required="">
            <div class="input-group-append">
              <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword('newpass')"> 
                <span class="fa fa-eye-slash icon"></span> 
              </button>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-warning btn-block btn-flat">Guardar</button>
            </div><!-- /.col -->
          </div>
        </form>

        
        <a href="login.html">Volver</a>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
    <!-- Bootbox -->
    <script src="../public/js/bootbox.min.js"></script>

    <script type="text/javascript" src="scripts/restablecerPass.js"></script>
  </body>
</html>
