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
              <a href="/dashboard"><?php echo htmlspecialchars( $dashboard, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
            </li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $users, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content mt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <a href="/usuarios/cadastrar" class="btn btn-sm btn-primary"
                  ><i class="fas fa-user-plus"></i> Novo Usuário</a
                >
              </div>
              <div class="card-tools">
                <form action="/usuarios" method="get">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input
                      type="text"
                      name="search"
                      value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      class="form-control float-right"
                      placeholder="Buscar"
                    />

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $counter1=-1;  if( isset($usersdb) && ( is_array($usersdb) || $usersdb instanceof Traversable ) && sizeof($usersdb) ) foreach( $usersdb as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php if( $value1["admin"] == 1 ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                    <td>
                      <a
                        href="/usuarios/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        class="btn btn-primary btn-sm"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Atualizar Usuário"
                        ><i class="fa fa-edit"></i
                      ></a>
                      <a
                        href="/usuarios/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/senha"
                        class="btn btn-warning btn-sm"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Alterar Senha"
                        ><i class="fa fa-unlock"></i
                      ></a>
                      <a
                        href="/usuarios/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"
                        onclick="return confirm('Deseja realmente excluir este registro?')"
                        class="btn btn-danger btn-sm "
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Excluir Usuário"
                        ><i class="fa fa-trash"></i
                      ></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php if( $usersdb == false ){ ?>
            <strong class="text-center pt-5 pb-5"
              >Não há dados para serem exibidos na tabela!</strong
            >
            <?php } ?>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                  <li class="page-item">
                    <a class="page-link" href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
