<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CallCenter Log | Recuperação de Senha</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/res/admin-lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/res/admin-lte/dist/css/AdminLTE.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/res/admin-lte/plugins/toastr/toastr.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>

  <body class="hold-transition lockscreen" style="background: darkblue">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <?php if( $success == 1 ){ ?>
        <span id="emailSent"></span>
      <?php } ?>
      <div class="lockscreen-logo text-white">
        <i class="nav-icon fas fa-headset"></i>
        <strong>CallCenter Log</strong>
      </div>

      <!-- /.lockscreen-item -->
      <div class="help-block text-center">
        <div class="callout callout-success">
          <h4>E-mail enviado!</h4>

          <p>Verifique as instruções no seu e-mail.</p>
        </div>
      </div>
      <div class="lockscreen-footer text-center text-white">
        Copyright &copy; <span class="year"></span>
        <b><a href="http://fasortec.com.br" class="text-white" target="_blank">Fasortec</a></b><br />
        Todos os direitos reservados.
      </div>
    </div>
    <!-- /.center -->

    <!-- jQuery 2.2.3 -->
    <script src="/res/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="/res/admin-lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- Toastr -->
    <script src="/res/admin-lte/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/res/admin-lte/dist/js/adminlte.min.js"></script>
    <script>
      const url = window.location.href;
      $(function () {
        if (url === "http://callcenterlog.local/esqueci-a-senha/enviada?success=1") {
          $("#emailSent").ready(function () {
            toastr.success("SUCESSO, Email Enviado Com Sucesso.");
          });
        }
      });
    </script>
  </body>

</html>