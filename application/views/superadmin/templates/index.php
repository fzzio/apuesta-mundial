<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats borde-azul-oscuro">
          <a href="<?php //echo site_url('entidad/listar'); ?>">
            <div class="icon"><i class="fa fa-briefcase"></i></div>
            <div class="count"><?php //echo $totalEntidades; ?></div>
            <h3>Entidades</h3>
            <p>Instituciones que usan la plataforma</p>
          </a>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats borde-azul-oscuro">
          <a href="<?php //echo site_url('supervisor/listar'); ?>">
            <div class="icon"><i class="fa fa-user-secret"></i></div>
            <div class="count"><?php //echo $totalSupervisores; ?></div>
            <h3>Supervisores</h3>
            <p>Controlan la asistencia</p>
          </a>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats borde-azul-oscuro">
          <a href="<?php //echo site_url('chip/listar'); ?>">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count"><?php //echo $totalChips; ?></div>
            <h3>Chips</h3>
            <p>Miembros que tienen tags</p>
          </a>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats borde-azul-oscuro">
          <a href="<?php //echo site_url('asistencia/listar'); ?>">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
            <div class="count"><?php //echo $totalAsistencias; ?></div>
            <h3>Asistencias</h3>
            <p>Lecturas de plataforma.</p>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="x_panel borde-azul-oscuro">
          <div class="x_title">
            <h2 class="txt-azul-oscuro">
              Asistencias <small>Últimos 5</small>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php //foreach ($ultimasAsistencias as $indice => $asistencia): ?>
              <?php //$fechaAsistencia = DateTime::createFromFormat('Y-m-d H:i:s', $asistencia->getFecha()); ?>
              <article class="media event">
                <a class="pull-left date">
                  <p class="month"><?php //echo $fechaAsistencia->format('M'); ?></p>
                  <p class="day"><?php //echo $fechaAsistencia->format('d'); ?></p>
                  <p class="year"><?php //echo $fechaAsistencia->format('Y'); ?></p>
                </a>
                <div class="media-body">
                  <a class="title" href="#">
                    <?php //echo $fechaAsistencia->format('H:i:s'); ?>
                  </a>
                  <p>
                    <span class="txt-azul-oscuro"><?php //echo $asistencia->getChip()->getMiembro()->getNombreCompletoDesencriptado(); ?></span> ha asistido a <a href="<?php //echo site_url('entidad/ver/' . $asistencia->getAuth()->getEntidad()->getID()); ?>" class="txt-azul-oscuro">
                      <?php //echo textoDesencriptar( $asistencia->getAuth()->getEntidad()->getNombre() ); ?>
                    </a>
                  </p>
                </div>
              </article>
            <?php //endforeach ?>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="x_panel borde-azul-oscuro">
          <div class="x_title">
            <h2 class="txt-azul-oscuro">
              Entidades <small>Últimas 5 registradas o actualizadas</small>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php //foreach ($ultimasEntidadesObj as $indiceEntidad => $entidadObj): ?>
              <?php //$fechaRegistro = DateTime::createFromFormat('Y-m-d H:i:s', $entidadObj->getFechaRegistro()); ?>
              <article class="media event">
                <a class="pull-left date">
                  <p class="month"><?php //echo $fechaRegistro->format('M'); ?></p>
                  <p class="day"><?php //echo $fechaRegistro->format('d'); ?></p>
                  <p class="year"><?php //echo $fechaRegistro->format('Y'); ?></p>
                </a>
                <div class="media-body">
                  <a class="title" href="#">
                    <?php //echo $fechaRegistro->format('H:i:s'); ?>
                  </a>
                  <p>
                    <span class="txt-azul-oscuro">
                      <?php //echo textoDesencriptar( $entidadObj->getNombre() ); ?>
                    </span> se ha registrado o actualizado.
                  </p>
                </div>
              </article>
            <?php //endforeach ?>
          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="x_panel borde-azul-oscuro">
          <div class="x_title">
            <h2 class="txt-azul-oscuro">
              Logs <small>Últimos 5</small>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php //foreach ($ultimosLogsObj as $indiceLogs => $logObj): ?>
              <?php //$fechaLog = DateTime::createFromFormat('Y-m-d H:i:s', $logObj->getFecha()); ?>
              <article class="media event">
                <a class="pull-left date">
                  <p class="month"><?php //echo $fechaLog->format('M'); ?></p>
                  <p class="day"><?php //echo $fechaLog->format('d'); ?></p>
                  <p class="year"><?php //echo $fechaLog->format('Y'); ?></p>
                </a>
                <div class="media-body">
                  <a class="title" href="#">
                    <?php //echo $fechaLog->format('H:i:s'); ?>
                  </a>
                  <p>
                    <?php //echo $logObj->getDescripcion(); ?>
                  </p>
                </div>
              </article>
            <?php //endforeach ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /page content -->