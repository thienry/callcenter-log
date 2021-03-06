<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CallCenter Log | Log in</title>
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
    <!-- icheck bootstrap -->
    <link
      rel="stylesheet"
      href="/res/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- Toastr -->
    <link
      rel="stylesheet"
      href="/res/admin-lte/plugins/toastr/toastr.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="/res/admin-lte/dist/css/adminlte.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
      rel="stylesheet"
    />
  </head>

  <body class="hold-transition login-page" style="background: darkblue">
    <div class="login-box">
      <?php if( $erro == 1 ){ ?>
        <span id="loginError"></span>
      <?php } ?>
      <div class="login-logo text-white">
        <i class="nav-icon fas fa-headset"></i>
        <strong>CallCenter Log</strong>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Faça Login para Entrar</p>

          <form action="/login" method="post">
            <div class="input-group mb-3">
              <input
                id="input-login"
                type="text"
                name="login"
                class="form-control"
                placeholder="Login ou Email"
                
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                id="input-password"
                type="password"
                name="despassword"
                class="form-control"
                placeholder="Senha"
                
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block btn-login">
                  Entrar
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="text-center mt-4">
            <p class="mb-1 mt-4">
              <a href="/esqueci-a-senha">Esqueci a Senha</a>
            </p>

            <!--<p class="mb-0">
              <a href="/cadastro" class="text-center">Cadastrar Novo Usuário</a>
            </p>
          --></div>
        </div>
        <!-- /.login-card-body -->
      </div>

      <div class="lockscreen-footer text-center text-white">
        Copyright &copy; <span class="year"></span>
        <b
          ><a href="http://fasortec.com.br" target="_blank" class="text-white"
            >Fasortec</a
          ></b
        ><br />
        Todos os direitos reservados.
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/res/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/res/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr -->
    <script src="/res/admin-lte/plugins/toastr/toastr.min.js"></script>
    <script src="/res/js/index.js"></script>
    <script>
      const url = window.location.href;
      $(function() {
        if (url === "http://callcenterlog.local/login?erro=1") {
          $("#loginError").ready(function() {
            toastr.error("ERROR, Usuário ou senha errada.");
          });
        }

        //Login Form Validation
        $(".btn-login").click(function () {
          let emptyField = false;

          if ($("#input-login").val() == "") {
            $("#input-login").css({ "border-color": "#f00" });
            emptyField = true;
          } else {
            $("#input-login").css({ "border-color": "#CCC" });
          }

          if ($("#input-password").val() == "") {
            $("#input-password").css({ "border-color": "#f00" });
            emptyField = true;
          } else {
            $("#input-password").css({ "border-color": "#CCC" });
          }

          if (emptyField) return false;
        });
      });
    </script>
  </body>
</html>
