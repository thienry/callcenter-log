<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu" >
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
        <li class="nav-item">
          <a href="/dashboard" class='nav-link <?php if( $isActiveDashboard === 1 ){ ?> active <?php } ?>'>
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              <?php echo htmlspecialchars( $dashboard, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </p>
          </a>
        </li>
        <?php if( $user["admin"] == 1 ){ ?>
        <li class="nav-item">
          <a href="/usuarios" class='nav-link <?php if( $isActiveUsers === 1 ){ ?> active <?php } ?>'>
            <i class="nav-icon fas fa-users"></i>
            <p>
              <?php echo htmlspecialchars( $users, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </p>
          </a>
        </li>
        <?php } ?> 
        <li class="nav-item">
          <a href="/marcacoes" class='nav-link <?php if( $isActiveAppointment === 1 ){ ?> active <?php } ?>'>
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              <?php echo htmlspecialchars( $appointment, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

