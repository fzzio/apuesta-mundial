<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo site_url('cancha/index'); ?>" class="site_title">
        <i class="fa fa-soccer-ball-o"></i> <span><?php echo PROYECTO_NOMBRE; ?></span>
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
              <i class="fa fa-dashboard"></i> Cancha <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('cancha/index'); ?>">
                  Dashboard
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('cancha/apuestas'); ?>">
                  Mis apuestas
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('cancha/desafios'); ?>">
                  Desafíos aceptados
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('cancha/abiertas'); ?>">
                  Desafíos abiertos
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a>
              <i class="fa fa-briefcase"></i> Información <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
              <li>
                <a href="<?php echo site_url('cancha/instrucciones'); ?>">
                  Instrucciones
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('cancha/mediadores'); ?>">
                  Contacto mediadores
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Inicio" href="<?php echo site_url('cancha/index'); ?>">
        <span class="fa fa-home" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Refrescar" href="<?php echo site_url($this->uri->uri_string()); ?>">
        <span class="fa fa-refresh" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Historial" href="#">
        <span class="fa fa-file-text" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Salir" href="<?php echo site_url('cancha/logout'); ?>">
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
            <?php echo $this->session->nombre; ?>
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
              <a href="<?php echo site_url('cancha/logout'); ?>">
                <i class="fa fa-sign-out pull-right"></i> Salir
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->