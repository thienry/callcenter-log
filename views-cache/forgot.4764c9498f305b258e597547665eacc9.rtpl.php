<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CallCenter Log | Recuperar Senha</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="/res/admin-lte/plugins/fontawesome-free/css/all.min.css"
    />
    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="/res/admin-lte/dist/css/adminlte.min.css" />
    <!-- Toastr -->
    <link
      rel="stylesheet"
      href="/res/admin-lte/plugins/toastr/toastr.min.css"
    />
    <!-- Google Font: Source Sans Pro -->
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
      rel="stylesheet"
    />
  </head>

  <body class="hold-transition lockscreen" style="background: darkblue">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo text-white">
        <i class="nav-icon fas fa-headset"></i>
        <strong>CallCenter Log</strong>
      </div>
      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen credentials (contains the form) -->
        <?php if( $error == 1 ){ ?>
        <span id="emailNotFound"></span>
        <?php } ?> <?php if( $error == 2 ){ ?>
        <span id="emailNotSent"></span>
        <?php } ?> <?php if( $error == 3 ){ ?>
        <span id="errorLink"></span>
        <?php } ?> <?php if( $error == 4 ){ ?>
        <span id="errorPassword"></span>
        <?php } ?>

        <form action="/esqueci-a-senha" method="post">
          <div class="input-group">
            <input
              id="input-email"
              type="email"
              name="email"
              class="form-control"
              placeholder="Digite seu email"
            />

            <div class="input-group-append">
              <button type="submit" class="btn btn-submit">
                <i class="fas fa-arrow-right text-muted"></i>
              </button>
            </div>
          </div>
        </form>
        <!-- /.lockscreen credentials -->
      </div>
      <!-- /.lockscreen-item -->
      <div class="help-block text-center text-white">
        Digite seu email para dar inicio ao processo de recuperação de senha.
      </div>
      <div class="text-center">
        <a href="/login" class="text-white"
          >Ou entre com um usuário diferente.</a
        >
      </div>
      <div class="lockscreen-footer text-center text-white">
        Copyright &copy; <span class="year"></span>
        <b
          ><a href="http://fasortec.com.br" class="text-white" target="_blank"
            >Fasortec</a
          ></b
        ><br />
        Todos os direitos reservados.
      </div>
    </div>
    <!-- /.center -->

    <!-- jQuery -->
    <script src="/res/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/res/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr -->
    <script src="/res/admin-lte/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/res/admin-lte/dist/js/adminlte.min.js"></script>
    <script src="/res/js/index.js"></script>

    <script>
      const url = window.location.href;

      $(function() {
        if (url === "http://callcenterlog.local/esqueci-a-senha?erro=1") {
          $("#emailNotFound").ready(function () {
            toastr.error("Error, Email não Encontrado, Tente Novamente.");
          });
        }

        if (url === "http://callcenterlog.local/esqueci-a-senha?erro=2") {
          $("#emailNotSent").ready(function () {
            toastr.error("Error, Erro Interno, Tente Novamente Mais Tarde.");
          });
        }

        if (url === "http://callcenterlog.local/esqueci-a-senha?erro=3") {
          $("#errorLink").ready(function () {
            toastr.error("Error, Link de Verificação Expirado ou Com Erro, Tente Novamente Mais Tarde.");
          });
        }

        if (url === "http://callcenterlog.local/esqueci-a-senha?erro=4") {
          $("#errorPassword").ready(function () {
            toastr.error("Error, Não Foi Possivel redefinir senha, Tente Novamente Mais Tarde.");
          });
        }

        //Login Form Validation
        $(".btn-submit").click(function () {
          let emptyField = false;

          if ($("#input-email").val() == "") {
            $("#input-email").css({ "border-color": "#f00" });
            emptyField = true;
          } else {
            $("#input-email").css({ "border-color": "#CCC" });
          }

          if (emptyField) return false;
        });
  
      });
    </script>
  </body>
</html>
