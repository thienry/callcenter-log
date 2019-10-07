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
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Atualizar Usuário</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="/usuarios/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Nome Completo</label>
                  <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    class="form-control"
                    id="name"
                    placeholder="Digite o Nome Completo"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="login">Login</label>
                  <input
                    type="text"
                    name="login"
                    value="<?php echo htmlspecialchars( $user["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    class="form-control"
                    id="login"
                    placeholder="Digite o Login"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    class="form-control"
                    id="email"
                    placeholder="Digite o Email"
                    required
                  />
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input 
                      class="custom-control-input" 
                      name="admin"
                      type="checkbox" 
                      id="admin" 
                      value="1" 
                      <?php if( $user["admin"] == 1 ){ ?>checked<?php } ?> 
                    />
                    <label for="admin" class="custom-control-label"
                      >Acesso de Administrador</label
                    >
                  </div>
                </div>
                <input type="hidden" name="user_status" value="A" />
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
