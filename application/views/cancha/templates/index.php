<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
  		<div class="row top_tiles">
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-usd"></i></div>
					<div class="count"><?php echo number_format($saldoApuesta, 2); ?></div>
					<h3>Total</h3>
					<p>Tu saldo en caja</p>
  				</div>
  			</div>
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="count"><?php echo $numeroAciertos; ?></div>
					<h3>Acertadas</h3>
					<p>Tus pronósticos correctos</p>
  				</div>
  			</div>
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-xs">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-futbol-o"></i></div>
					<div class="count"><?php echo count($partidosJugadosObj); ?>/64</div>
					<h3>Partidos</h3>
					<p>Encuentros restantes</p>
  				</div>
  			</div>
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-xs">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="count"><?php echo $totalApostadores; ?></div>
					<h3>Participantes</h3>
					<p>Personas apostando</p>
  				</div>
  			</div>
  		</div>

  		<div class="row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Resultados oficiales
							<small>
								Últimos 5 (<a href="" class="txt-amarillo txt-blanco-hover">ver todos</a>)
							</small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content fondo-imagen fondo-1 ">
						<div class="contenedor-tabla fondo-transparencia-negro-1">
							<table class="table table-hover table-condensed tabla-partidos">
								<tbody>
									<?php foreach ($partidosJugadosObj as $indicePartidoJugado => $partidoJugadoObj): ?>
										<tr class="info-partido">
											<td class="text-center centrado-vertical">
												<?php $fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoJugadoObj->getFecha()); ?>
												<div class="date">
													<p class="month"><?php echo $fechaHoraPartido->format('M'); ?></p>
													<p class="day"><?php echo $fechaHoraPartido->format('d'); ?></p>
													<p class="time"><?php echo $fechaHoraPartido->format('H:i'); ?></p>
												</div>
											</td>
											<td class="text-right centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoJugadoObj->getPaisLocal()->getIso()); ?> bandera-normal"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais">
													<?php echo $partidoJugadoObj->getPaisLocal()->getNombre(); ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-amarillo texto-resultado">
													<?php echo $partidoJugadoObj->getGolesLocal(); ?>:<?php echo $partidoJugadoObj->getGolesVisitante(); ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais">
													<?php echo $partidoJugadoObj->getPaisVisitante()->getNombre(); ?>
												</span>
											</td>
											<td class="text-left centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoJugadoObj->getPaisVisitante()->getIso()); ?> bandera-normal"></span>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Siguientes Partidos
							<small>
								Próximos 5 (<a href="" class="txt-amarillo txt-blanco-hover">ver todos</a>)
							</small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content fondo-imagen fondo-2">
						<div class="contenedor-tabla fondo-transparencia-negro-1">
							<table class="table table-hover table-condensed tabla-partidos">
								<tbody>
									<?php foreach ($partidosProximosObj as $indicePartidoProximo => $partidoProximoObj): ?>
										<tr class="info-partido">
											<td class="text-right centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoProximoObj->getPaisLocal()->getIso()); ?> bandera-normal"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais">
													<?php echo $partidoProximoObj->getPaisLocal()->getNombre(); ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-amarillo">vs</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais">
													<?php echo $partidoProximoObj->getPaisVisitante()->getNombre(); ?>
												</span>
											</td>
											<td class="text-left centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoProximoObj->getPaisVisitante()->getIso()); ?> bandera-normal"></span>
											</td>
											<td class="text-center centrado-vertical">
												<?php $fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoProximoObj->getFecha()); ?>
												<div class="date">
													<p class="month"><?php echo $fechaHoraPartido->format('M'); ?></p>
													<p class="day"><?php echo $fechaHoraPartido->format('d'); ?></p>
													<p class="time"><?php echo $fechaHoraPartido->format('H:i'); ?></p>
												</div>
											</td>
											<td class="text-center centrado-vertical">
												<div class="btn btn-negro btn-amarillo-hover">
													Apostar
												</div>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Mis apuestas iniciadas
							<small>
								<a href="" class="txt-amarillo txt-amarillo-hover">Ver todos</a>
							</small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content fondo-imagen fondo-4">
						<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
							<table class="table table-hover table-condensed tabla-partidos tabla-partidos-apuestas">
								<thead>
									<tr>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Fecha</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Partido</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Monto</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Mi Apuesta</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Rival</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Apuesta del Rival</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Resultado</span>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($arrConsolidadoMisApuestas as $indiceApuesta => $apuesta): ?>
										<?php $partidoObj = $apuesta["partidoObj"]; ?>
										<tr class="info-partido">
											<td class="text-center centrado-vertical">
												<?php $fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoObj->getFecha()); ?>
												<div class="date">
													<p class="month"><?php echo $fechaHoraPartido->format('M'); ?></p>
													<p class="day"><?php echo $fechaHoraPartido->format('d'); ?></p>
													<p class="time"><?php echo $fechaHoraPartido->format('H:i'); ?></p>
												</div>
											</td>
											<td class="text-center centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoObj->getPaisLocal()->getIso()); ?> bandera-md"></span>
												<span class="txt-blanco">
													<?php echo $partidoObj->getPaisLocal()->getNombre(); ?>
												</span>
												<span class="txt-amarillo">vs</span>
												<span class="txt-blanco">
													<?php echo $partidoObj->getPaisVisitante()->getNombre(); ?>
												</span>
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoObj->getPaisVisitante()->getIso()); ?> bandera-md"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													$ <?php echo number_format($apuesta["montoApuesta"], 2); ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													<?php echo $apuesta["resultadoMioStr"]; ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													<?php if ( $apuesta["rivalNombre"] != "" ): ?>
														<?php echo $apuesta["rivalNombre"]; ?>
													<?php else: ?>
														--
													<?php endif ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													<?php if ( $apuesta["resultadoRivalStr"] != "" ): ?>
														<?php echo $apuesta["resultadoRivalStr"]; ?>
													<?php else: ?>
														--
													<?php endif ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<?php if ( !is_null( $apuesta["resultadoApuesta"] ) ): ?>
													<?php if ( $apuesta["resultadoApuesta"] == RESULTADO_GANASTE ): ?>
														<span class="label label-success txt-light">Has Ganado</span>
													<?php elseif ( $apuesta["resultadoApuesta"] == RESULTADO_PERDISTE ): ?>
														<span class="label label-danger txt-light">Has Perdido</span>
													<?php else: ?>
														<span class="label label-default txt-light">Casa gana</span>
													<?php endif ?>
												<?php else: ?>
													--
												<?php endif ?>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Apuestas de otros
							<small>
								<a href="" class="txt-amarillo txt-amarillo-hover">Ver todos</a>
							</small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content fondo-imagen fondo-3">
						<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
							<table class="table table-hover table-condensed tabla-partidos tabla-partidos-apuestas">
								<thead>
									<tr>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Fecha</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Partido</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Rival</span>
										</th>
										<th class="text-center centrado-vertical">
											<span class="txt-amarillo text-uppercase">Monto</span>
										</th>
										<th class="text-center centrado-vertical" colspan="3">
											<span class="txt-amarillo text-uppercase">Apuesta</span>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($arrConsolidadoOtrasApuestas as $indiceApuesta => $apuesta): ?>
										<?php $partidoObj = $apuesta["partidoObj"]; ?>
										<tr class="info-partido">
											<td class="text-center centrado-vertical">
												<?php $fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoObj->getFecha()); ?>
												<div class="date">
													<p class="month"><?php echo $fechaHoraPartido->format('M'); ?></p>
													<p class="day"><?php echo $fechaHoraPartido->format('d'); ?></p>
													<p class="time"><?php echo $fechaHoraPartido->format('H:i'); ?></p>
												</div>
											</td>
											<td class="text-center centrado-vertical">
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoObj->getPaisLocal()->getIso()); ?> bandera-md"></span>
												<span class="txt-blanco">
													<?php echo $partidoObj->getPaisLocal()->getNombre(); ?>
												</span>
												<span class="txt-amarillo">vs</span>
												<span class="txt-blanco">
													<?php echo $partidoObj->getPaisVisitante()->getNombre(); ?>
												</span>
												<span class="flag-icon flag-icon-<?php echo strtolower($partidoObj->getPaisVisitante()->getIso()); ?> bandera-md"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													<?php echo $apuesta["rivalNombre"]; ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco">
													$ <?php echo number_format($apuesta["montoApuesta"], 2); ?>
												</span>
											</td>
											<td class="text-center centrado-vertical">
												<div class="btn btn-negro btn-amarillo-hover">
													Gana Local
												</div>
											</td>
											<td class="text-center centrado-vertical">
												<div class="btn btn-negro btn-amarillo-hover">
													Empate
												</div>
											</td>
											<td class="text-center centrado-vertical">
												<div class="btn btn-negro btn-amarillo-hover">
													Gana Visitante
												</div>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
  		</div>
  	</div>
</div>
<!-- /page content -->