<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Desenvolvido por Thiago Moura
      </div>
      <!-- Default to the left -->
        
      <strong>Copyright &copy; <span class="year"></span> <a href="//fasortec.com.br" target="_blank">Fasortec</a>. Todos os direitos reservados.
    </footer>
  </div>
  <!-- ./wrapper -->


  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="/res/admin-lte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/res/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="/res/admin-lte/plugins/chart.js/Chart.min.js"></script>
  <!-- Toastr -->
  <script src="/res/admin-lte/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/res/admin-lte/dist/js/adminlte.min.js"></script>
  <!-- Custom Script -->
  <script src="/res/js/index.js"></script>
  <script src="/res/js/jquery.maskedinput.min.js"></script>
  <script>
    const url = window.location.href;

    $(document).ready(function () {
      // Users Create URL
      if (url === "http://callcenterlog.local/usuarios?success=1") {
        $(".userCreated").ready(function () {
          toastr.success('SUCESSO, Usuário Criado Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=1") {
        $(".userNotCreated").ready(function () {
          toastr.success('ERROR, Não Foi Possível Criar Usuário.')
        });
      }

      // Users Password Change URL
      if (url === "http://callcenterlog.local/usuarios?success=2") {
        $(".passwordChanged").ready(function () {
          toastr.success('SUCESSO, Senha Alterada Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=2") {
        $(".passwordNotChanged").ready(function () {
          toastr.success('ERROR, Não Foi Possível Alterar Senha.')
        });
      }

      // Users Delete URL
      if (url === "http://callcenterlog.local/usuarios?success=3") {
        $(".userDeleted").ready(function () {
          toastr.success('SUCESSO, Usuário Deletado Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=3") {
        $(".userNotDeleted").ready(function () {
          toastr.success('ERROR, Não Foi Possível Deletar Usuário.')
        });
      }

      // User Update URL
      if (url === "http://callcenterlog.local/usuarios?success=4") {
        $(".userUpdated").ready(function () {
          toastr.success('SUCESSO, Usuário Alterado Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=4") {
        $(".userNotUpdated").ready(function () {
          toastr.success('ERROR, Não Foi Possível Alterar Usuário.')
        });
      }

      // Appointments URL
      if (url === "http://callcenterlog.local/marcacoes?success=1") {
        $("#appointmentSuccess").ready(function () {
          toastr.success('SUCESSO, Marcação Atualizada Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=1") {
        $("#appointmentError").ready(function () {
          toastr.error('ERROR, Não Foi Possível Atualizar a Marcação.')
        });
      }

      // Profile Image Upload URL
      if (url === "http://callcenterlog.local/perfil?success=1") {
        $("#uploadSuccess").ready(function () {
          toastr.success('SUCESSO, Foto de Perfil Aterada Com Sucesso.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=5") {
        $("#appointmentError").ready(function () {
          toastr.error('ERROR, Data Final Não Pode Ser Maior Que a Data Inicial.')
        });
      }

      if (url === "http://callcenterlog.local/marcacoes?error=6") {
        $("#appointmentError").ready(function () {
          toastr.error('ERROR, Datas Iguais Com Hora Final Menor Que a Hora Inicial.')
        });
      }

      //User Create Form Validation
      $(".btn-user-create").click(function () {
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

        if ($("#input-name").val() == "") {
          $("#input-name").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-name").css({ "border-color": "#CCC" });
        }

        if ($("#input-email").val() == "") {
          $("#input-email").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-email").css({ "border-color": "#CCC" });
        }

        if (emptyField) return false;
      });


      //User Update Form Validation
      $(".btn-user-update").click(function () {
        let emptyField = false;

        if ($("#input-login").val() == "") {
          $("#input-login").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-login").css({ "border-color": "#CCC" });
        }

        if ($("#input-name").val() == "") {
          $("#input-name").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-name").css({ "border-color": "#CCC" });
        }

        if ($("#input-email").val() == "") {
          $("#input-email").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-email").css({ "border-color": "#CCC" });
        }

        if (emptyField) return false;
      });

      //User Password Update Form Validation
      $(".btn-user-password-update").click(function () {
        let emptyField = false;

        if ($("#input-password").val() == "") {
          $("#input-password").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-password").css({ "border-color": "#CCC" });
        }

        if ($("#input-confirmPassword").val() == "") {
          $("#input-confirmPassword").css({ "border-color": "#f00" });
          emptyField = true;
        } else {
          $("#input-confirmPassword").css({ "border-color": "#CCC" });
        }

        if (emptyField) return false;
      });

  
    })
  </script>
</body>

</html>