<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo htmlspecialchars( $pageTitle, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard"><?php echo htmlspecialchars( $breadcrumbItem, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $userProfile, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img
                  class="profile-user-img img-fluid img-circle"
                  src="/res/admin-lte/dist/img/user4-128x128.jpg"
                  alt="User profile picture"
                />
              </div>
              <h3 class="profile-username text-center"><?php echo getUserName(); ?></h3>
              <p class="text-muted text-center">@<?php echo getUserLogin(); ?></p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sobre Mim</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Nome</strong>
              <p class="text-muted">
                <?php echo getUserName(); ?>
              </p>
              <hr />
              <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
              <p class="text-muted"><?php echo getUserEmail(); ?></p>
              <hr />
              <strong><i class="fas fa-pencil-alt mr-1"></i> Login</strong>
              <p class="text-muted">
                <?php echo getUserLogin(); ?>
              </p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-3"></div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
