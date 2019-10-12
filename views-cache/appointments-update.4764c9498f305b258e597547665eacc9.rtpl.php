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
              <a href="/dashboard"><?php echo htmlspecialchars( $breadcrumbItem, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
            </li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $appointments, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
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
              <h3 class="card-title">Atualizar <?php echo htmlspecialchars( $appointments, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="/marcacoes/<?php echo htmlspecialchars( $log["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Nome Paciente</label>
                      <input type="text" name="name" value="<?php echo htmlspecialchars( $log["nome_pac"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" id="name" disabled />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Médico</label>
                      <input type="text" name="Medico" value="<?php echo htmlspecialchars( $log["Medico"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="login">Tipo Consulta</label>
                      <input type="text" name="descricao" value="<?php echo htmlspecialchars( $log["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                </div>    
                <div class="row">
                  <div class="col-4">
                    <!-- select -->
                    <div class="form-group">
                      <label>Status Marcação</label>
                      <select name="Confirmacao" class="custom-select">
                        <option value="<?php echo htmlspecialchars( $log["Confirmacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" checked >
                          <?php if( $log["Confirmacao"] == 'S' ){ ?>
                            Marcada
                          <?php }elseif( $log["Confirmacao"] == 'N' ){ ?> 
                            Desmarcada
                          <?php }else{ ?>
                            Sem resposta
                          <?php } ?>
                        </option>
                        <option value="<?php echo htmlspecialchars( $confirm["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Marcada</option>
                        <option value="<?php echo htmlspecialchars( $confirm["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Desmarcada</option>
                        <option value="<?php echo htmlspecialchars( $confirm["2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Sem resposta</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Local</label>
                      <input type="text" name="Medico" value="<?php echo htmlspecialchars( $log["Local"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="login">Número Marcação</label>
                      <input type="text" name="descricao" value="<?php echo htmlspecialchars( $log["id_marcacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Fone Contato</label>
                      <input type="text" name="name" value="<?php echo htmlspecialchars( $log["fone_contato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" id="name" disabled />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name">Fone celular</label>
                      <input type="text" name="Medico" value="<?php echo htmlspecialchars( $log["fone_celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="login">Data</label>
                      <input type="text" name="descricao" value="<?php echo htmlspecialchars( $log["Data_hora"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="name">Data Envio</label>
                      <input type="text" name="name" value="<?php echo htmlspecialchars( $log["dh_envio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" id="name" disabled />
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="name">Data da Confirmacao</label>
                      <input type="text" name="Medico" value="<?php echo htmlspecialchars( $log["dh_confirm"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="login">Cliente</label>
                      <input type="text" name="descricao" value="<?php echo htmlspecialchars( $log["Cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="login">Resposta</label>
                      <input type="text" name="descricao" value="<?php echo htmlspecialchars( $log["Resposta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Observações</label>
                      <textarea class="form-control" rows="3" name="observacao" placeholder="Digite aqui as Observações ..."></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>