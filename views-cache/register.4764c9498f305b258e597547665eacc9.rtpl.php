<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CallCenter Log | Cadastro de Usuário</title>
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
    <!-- Theme style -->
    <link rel="stylesheet" href="/res/admin-lte/dist/css/adminlte.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
      rel="stylesheet"
    />
  </head>

  <body class="hold-transition register-page" style="background: darkblue">
    <div class="register-box">
      <div class="register-logo text-white">
        <i class="nav-icon fas fa-headset"></i>
        <strong>CallCenter Log</strong>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Cadastre um Novo Usuário</p>

          <form action="/cadastro" method="post">
            <div class="input-group mb-3">
              <input
                required
                type="text"
                name="name"
                class="form-control"
                placeholder="Nome Completo"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                required
                type="text"
                name="login"
                class="form-control"
                placeholder="Login"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                required
                type="email"
                name="email"
                class="form-control"
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                required
                name="despassword"
                type="password"
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
              <div class="col-12">
                <div class="icheck-primary">
                  <input required type="checkbox" id="agreeTerms" />
                  <label for="agreeTerms">
                    Eu concordo com os <a href="#">termos</a>
                  </label>
                </div>
              </div>

              <input type="hidden" name="admin" value="0" />
              <input type="hidden" name="user_status" value="A" />
              <!-- /.col -->
              <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary btn-block">
                  Cadastrar Novo Usuário
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <div class="text-center mt-4">
            <a href="/login">Já Sou um Usuário</a>
          </div>
        </div>
        <!-- /.form-box -->
      </div>
      <!-- /.card -->
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
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="/res/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/res/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/res/js/index.js"></script>
  </body>
</html>
