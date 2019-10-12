<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CallCenter Log | Bloqueio de tela</title>
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
    <!-- Google Font: Source Sans Pro -->
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
      rel="stylesheet"
    />
  </head>

  <body class="hold-transition lockscreen" style="background: darkblue;">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo text-white">
        <i class="nav-icon fas fa-headset"></i>
        <strong>CallCenter Log</strong>
      </div>
      <!-- User name -->
      <div class="lockscreen-name text-white">
        <?php echo getfirstAndLastName(); ?>
      </div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img
            src="<?php echo htmlspecialchars( $image["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
            alt='Imagem de <?php echo getfirstAndLastName(); ?>'
          />
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="/login" method="POST">
          <div class="input-group">
            <input
              id="input-password"
              name="despassword"
              type="password"
              class="form-control"
              placeholder="senha"
            />
            <input type="hidden" class="form-control" name="login" value="<?php echo htmlspecialchars( $user["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <div class="input-group-append">
              <button type="submit" class="btn btn-screen-lock">
                <i class="fas fa-arrow-right text-muted"></i>
              </button>
            </div>
          </div>
        </form>
        <!-- /.lockscreen credentials -->
      </div>
      <!-- /.lockscreen-item -->
      <div class="help-block text-center text-white">
        Digite sua senha para recuperar sua sessão.
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

    <script>
      $(document).ready(function() {
        //Screen Lock Form Validation
        $(".btn-screen-lock").click(function() {
          let emptyField = false;

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
