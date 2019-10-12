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
            <li class="breadcrumb-item">
              <a href="/dashboard"><?php echo htmlspecialchars( $breadcrumbItem, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
            </li>
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
        <?php if( $success == 1 ){ ?>
        <span id="uploadSuccess"></span>
        <?php } ?>
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <form
                action="/perfil"
                method="POST"
                enctype="multipart/form-data"
              >
                <div class="text-center">
                  <img
                    id="image-preview"
                    class="profile-user-img img-fluid img-circle "
                    src="<?php echo htmlspecialchars( $img["desphoto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    class="rounded-circle z-depth-1-half avatar-pic"
                    alt="example placeholder avatar"
                  />
                </div>
                <div
                  class="upload-btn-wrapper mt-2"
                  style="display: flex; justify-content: center;"
                >
                  <button class="btn btn-sm btn-primary text-center">
                    Escolha Foto de Perfil
                  </button>
                  <input type="file" id="file" name="file" />
                </div>
                <button
                  type="submit"
                  class="btn btn-default btn-sm float-sm-right"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Enviar Foto"
                >
                  <i class="fas fa-file-upload"></i>
                </button>
              </form>
              <h3 class="profile-username text-center mt-2">
                <?php echo getUserName(); ?>
              </h3>
              <p class="text-muted text-center">@<?php echo getUserLogin(); ?></p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sobre</h3>
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

<script>
  document.querySelector("#file").addEventListener("change", function () {
    let file = new FileReader();
    file.onload = function () {
      document.querySelector("#image-preview").src = file.result;
    };
    file.readAsDataURL(this.files[0]);
  });
</script>