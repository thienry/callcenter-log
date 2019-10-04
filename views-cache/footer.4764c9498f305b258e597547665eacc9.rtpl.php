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
  <script>
    const dateNow = new Date();
    const fullYear = dateNow.getFullYear();
    const year = document.querySelector(".year");

    year.innerText = fullYear;
  </script>

  <!-- jQuery -->
  <script src="/res/admin-lte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/res/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="/res/admin-lte/plugins/datatables/jquery.dataTables.js"></script>
  <script src="/res/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="/res/admin-lte/dist/js/adminlte.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>
  </body>

</html>