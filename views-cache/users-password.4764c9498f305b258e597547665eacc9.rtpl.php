<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
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
              <a href="/dashboard"><?php echo htmlspecialchars( $dashboard, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
            </li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $users, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md">

        <?php if( $msgError !== '' ){ ?>  
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Erro!</h5>
            <?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
          </div>
        <?php } ?>

        <?php if( $msgSuccess !== '' ){ ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
            <?php echo htmlspecialchars( $msgSuccess, ENT_COMPAT, 'UTF-8', FALSE ); ?>
          </div>
        <?php } ?>
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Atualizar Senha de Usuário</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="/usuarios/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/senha" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="despassword">Nova Senha</label>
                  <input type="password" name="despassword" class="form-control" id="password"
                    placeholder="Digite a Nova Senha" required />
                </div>
                <div class="form-group">
                  <label for="confirmPassword">Confirme a Senha</label>
                  <input type="password" name="confirmPassword" class="form-control" id="confirmPassword"
                    placeholder="Confirme a Nova Senha" required />
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>