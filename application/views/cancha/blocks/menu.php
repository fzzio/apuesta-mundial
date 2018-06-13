<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo site_url('superadmin/index'); ?>" class="site_title">
        <i class="fa fa-user-circle"></i> <span><?php echo PROYECTO_NOMBRE; ?></span>
      </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Bienvenido,</span>
        <h2>
          <?php echo $this->session->nombre; ?>
        </h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-briefcase"></i> Clientes<span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('entidad/listar'); ?>">
                  <i class="fa fa-building" aria-hidden="true"></i> Entidades
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('administrador/listar'); ?>">
                  <i class="fa fa-user" aria-hidden="true"></i> Administradores
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-users"></i> Personal <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('supervisor/listar'); ?>">
                  <i class="fa fa-check-square-o" aria-hidden="true"></i> Supervisores
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('auxiliar/listar'); ?>">
                  <i class="fa fa-archive" aria-hidden="true"></i> Auxiliares
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('chip/acciones'); ?>">
                  <i class="fa fa-address-card" aria-hidden="true"></i> Miembros
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>Sistema</h3>
        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-shield"></i> Accesos <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('superadmin/listar'); ?>">
                  <i class="fa fa-user-secret" aria-hidden="true"></i> Super Admins
                </a>
              </li>
              <?php /*
              <li>
                <a href="<?php echo site_url('tipotag/listar'); ?>">
                  <i class="fa fa-tags" aria-hidden="true"></i> Tipos de Tag
                </a>
              </li>
              */ ?>
              <li>
                <a href="<?php echo site_url('asistencia/listar'); ?>">
                  <i class="fa fa-history" aria-hidden="true"></i> Asistencias
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <?php 
      /*
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-briefcase"></i> Entidad <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('entidad/ver'); ?>">Ver</a>
              </li>
              <li>
                <a href="<?php echo site_url('entidad/agregar'); ?>">Añadir</a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-users"></i> Personal <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="#">Ver</a>
              </li>
              <li>
                <a href="#">Añadir</a>
              </li>
              <li>
                <a href="#">Subir CSV</a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-user-secret"></i> Supervisores <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="#">Ver</a>
              </li>
              <li>
                <a href="#">Añadir</a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-archive"></i> Auxiliares <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="#">Ver</a>
              </li>
              <li>
                <a href="#">Añadir</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>Sistema</h3>
        <ul class="nav side-menu">
          <li>
            <a>
              <i class="fa fa-cube"></i> Administrador <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="#">Ver</a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-tags"></i> Tags <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="#">Ver</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      */ ?>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Inicio" href="<?php echo site_url('superadmin/index'); ?>">
        <span class="fa fa-home" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Refrescar" href="<?php echo site_url($this->uri->uri_string()); ?>">
        <span class="fa fa-refresh" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logs" href="<?php echo site_url('log/listar'); ?>">
        <span class="fa fa-file-text" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Salir" href="<?php echo site_url('superadmin/logout'); ?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt=""><?php echo $this->session->nombre; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <?php /*
            <li>
              <a href="javascript:;"> Perfil</a>
            </li>
            <li>
              <a href="javascript:;">Ayuda</a>
            </li>
            */ ?>
            <li>
              <a href="<?php echo site_url('superadmin/logout'); ?>">
                <i class="fa fa-sign-out pull-right"></i> Salir
              </a>
            </li>
          </ul>
        </li>

        <?php /*

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">6</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image"><img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image"><img src="<?php echo base_url('assets/apuestamundial/img/near-avatar.png'); ?>" alt="Profile Image" /></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>
            <li>
              <div class="text-center">
                <a>
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>
        */ ?>

      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->