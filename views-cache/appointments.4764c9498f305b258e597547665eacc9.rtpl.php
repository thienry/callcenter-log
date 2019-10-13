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
      <?php if( $success == 1 ){ ?>
        <span id="appointmentSuccess"></span>
      <?php } ?>
      <?php if( $error == 1 ){ ?>
        <span id="appointmentError"></span>
      <?php } ?>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-header">
              <h3 class="card-title">Filtrar Marcações</h3>
            </div>
            <form role="form" action="/marcacoes" method="GET">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Data Inicial</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="far fa-calendar-alt"></i
                          ></span>
                        </div>
                        <input
                          type="date"
                          name="dtini"
                          value="<?php echo htmlspecialchars( $dtini, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>

                  <div class="col-6">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Data Final</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="far fa-calendar-alt"></i
                          ></span>
                        </div>
                        <input
                          type="date"
                          name="dtend"
                          value="<?php echo htmlspecialchars( $dtend, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="search">Buscar:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="fas fa-search"></i
                          ></span>
                        </div>
                        <input
                          type="text"
                          name="search"
                          class="form-control"
                          id="search"
                          value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                          placeholder="Digite aqui Marcação, Nome Paciente, Tipo, Médico, Telefone, Status..."
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary float-right">
                  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content mt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">
                <strong>Lista de Marcações</strong>
              </h1>

              <div class="card-tools">
                <div class="row no-print" style="width: 150px;">
                  <div class="col-12">
                    <a
                      href="invoice-print.html"
                      target="_blank"
                      class="btn btn-default"
                      ><i class="fas fa-print"></i> Imprimir</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Marcação</th>
                    <th>Nome Paciente</th>
                    <th>Tipo</th>
                    <th>Médico</th>
                    <th>Data</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($logs) && ( is_array($logs) || $logs instanceof Traversable ) && sizeof($logs) ) foreach( $logs as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["id_marcacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nome_pac"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["Medico"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatDate($value1["Data_hora"]); ?></td>
                    <td>
                      <?php if( $value1["fone_celular"] == '' ){ ?>
                      <span class="text-red">Sem Número Cadastrado</span>
                      <?php }else{ ?> <?php echo htmlspecialchars( $value1["fone_celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?>
                    </td>
                    <td>
                      <strong>
                        <?php if( $value1["Confirmacao"] == '' ){ ?> 
                          <span class="text-yellow">Sem Resposta</span>
                        <?php }elseif( $value1["Confirmacao"] == 'S' ){ ?>
                        <span class="text-blue">Confirmada</span>
                        <?php }else{ ?>
                        <span class="text-red">Desmarcada</span>
                        <?php } ?>
                      </strong>
                    </td>
                    <td>
                      <a
                        href="/marcacoes/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        class="btn btn-primary btn-sm"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Atualizar Marcação"
                        ><i class="fa fa-edit"></i
                      ></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php if( $logs == false ){ ?>
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
                  <br />
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
</div>
