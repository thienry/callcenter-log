<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark" style="background: darkblue"> 
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline d-none ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search" />
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item  ">
        <a href="/logout" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i> Sair</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->