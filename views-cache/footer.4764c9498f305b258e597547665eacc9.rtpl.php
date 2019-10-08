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
  <!-- InputMask -->
  <script src="/res/admin-lte/plugins/inputmask/jquery.inputmask.bundle.js"></script>
  <script src="/res/admin-lte/plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="/res/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- AdminLTE App -->
  <script src="/res/admin-lte/dist/js/adminlte.min.js"></script>
  <script src="/res/js/index.js"></script>
  <script>
    $(function () {
      //Date range picker
      $('#reservation').daterangepicker();
    });
  </script>
</body>

</html>