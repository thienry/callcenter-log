<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo htmlspecialchars( $pageTitle, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><?php echo htmlspecialchars( $pageTitle, ENT_COMPAT, 'UTF-8', FALSE ); ?></li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="/marcacoes">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="counter"><?php echo htmlspecialchars( $confirmedTags, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

                <p>Marcações Confirmadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="/marcacoes">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="counter"><?php echo htmlspecialchars( $noAnswerTags, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

                <p>Marcações Sem Resposta</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="/marcacoes">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="counter"><?php echo htmlspecialchars( $unmarkedTags, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

                <p>Marcações Desmarcadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="/marcacoes">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><span class="counter"><?php echo htmlspecialchars( $totalTags, ENT_COMPAT, 'UTF-8', FALSE ); ?></span></h3>

                <p>Total de Marcações</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- DONUT CHART -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Modelo Gráfico</h3>
        </div>
        <div class="card-body">
          <canvas
            id="donutChart"
            style="height:230px; min-height:345px"
          ></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </section>

  <!-- /.row -->
  <!-- /.content -->
</div>
