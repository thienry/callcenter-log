<?php if(!class_exists('Rain\Tpl')){exit;}?><aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <!--<img src="#" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8" /> -->
    <i class="nav-icon fas fa-headset ml-3"></i>
    <span class="brand-text  ml-1"><?php echo htmlspecialchars( $title, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-2 d-flex">
      <div class="image">
        <img src="/res/admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2 ml-2" alt="User Image" />
      </div>
      <div class="info">
        <a href="/perfil" class="d-block "><?php echo getUserLogin(); ?></a>
      </div>
    </div>