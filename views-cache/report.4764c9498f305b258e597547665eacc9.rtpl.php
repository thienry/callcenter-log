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
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $pageTitle, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
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
      <?php } ?> <?php if( $error == 1 ){ ?>
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
              <h3 class="card-title"><?php echo htmlspecialchars( $pageTitle, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
            </div>
            <form role="form" action="/marcacoes" method="GET">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
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
                          value=""
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-md-2">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Hora Inicial</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="far fa-clock"></i
                          ></span>
                        </div>
                        <input
                          type="time"
                          name="hrini"
                          value=""
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>

                  <div class="col-md-1"></div>

                  <div class="col-md-3">
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
                          value=""
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>

                  <div class="col-md-2">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Hora Final</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"
                            ><i class="far fa-clock"></i
                          ></span>
                        </div>
                        <input
                          type="time"
                          name="hrend"
                          value=""
                          class="form-control "
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
                <div class="row">
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
                          value=""
                          placeholder="Digite aqui Marcação, Nome Paciente, Tipo, Médico, Telefone, Status..."
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="card-tools  float-sm-right">
                  <div class="row no-print">
                    <div class="col-12">
                      <a href="#" class="btn btn-sm btn-primary"
                        ><i class="fas fa-print"></i> Gerar Relatório</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
