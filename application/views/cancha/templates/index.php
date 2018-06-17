<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
  		<div class="row top_tiles">
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-usd"></i></div>
					<div class="count"><?php echo number_format($saldoDisponible, 2); ?></div>
					<h3>Total en caja</h3>
					<p>
						$ <?php echo number_format($saldoGanado, 2); ?> (Ganado) - $ <?php echo number_format($saldoBloqueado, 2); ?> (Bloqueado)
					</p>
  				</div>
  			</div>
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="count"><?php echo $numeroAciertos; ?></div>
					<h3>Acertadas</h3>
					<p>Tus apuestas correctos</p>
  				</div>
  			</div>
  			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-xs">
  				<div class="tile-stats">
					<div class="icon"><i class="fa fa-futbol-o"></i></div>
					<div class="count"><?php echo $numeroJugados; ?>/64</div>
					<h3>Partidos</h3>
					<p>Encuentros jugados</p>
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
  			<div class="col-md-12 col-sm-12 col-xs-12">
  				<div class="x_panel">
  					<div class="x_title">
  						<h2>
  							Apuestas abiertas
  							<small>
  								Últimos 5 (<a href="" class="txt-amarillo txt-blanco-hover">ver todos</a>)
  							</small>
  						</h2>
  						<div class="clearfix"></div>
  					</div>
  					<div class="x_content fondo-imagen fondo-3">
  						<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
							<?php $this->load->view('cancha/blocks/apuestas_otros', array('arrApuestas' => $arrConsolidadoOtrasApuestasAbiertas)) ?>
  						</div>
  					</div>
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
							<?php $this->load->view('cancha/blocks/resultados_oficiales', array($partidosJugadosObj)) ?>
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
							<?php $this->load->view('cancha/blocks/siguientes_partidos', array($partidosProximosObj)) ?>
						</div>
					</div>
				</div>
			</div>
  		</div>

  		<?php if ( count( $partidosJugandoObj ) > 0 ): ?>
	  		<div class="row">
	  			<div class="col-md-12 col-sm-12 col-xs-12">
	  				<div class="x_panel">
	  					<div class="x_title">
	  						<h2>
	  							Jugando
	  							<small class="txt-amarillo">
	  								Partidos que están en curso
	  							</small>
	  						</h2>
	  						<div class="clearfix"></div>
	  					</div>
	  					<div class="x_content fondo-imagen fondo-7">
	  						<div class="contenedor-tabla fondo-transparencia-negro-1">
	  							<div class="container-fluid">
	  								<div class="row">
	  									<div class="col-md-6 col-sm-12 col-xs-12">
				  							<table class="table table-hover table-condensed tabla-partidos">
				  								<tbody>
													<?php foreach ($partidosJugandoObj as $indicePartidoJugando => $partidoJugandoObj): ?>
														<tr class="info-partido">
															<td class="text-right centrado-vertical">
																<span class="flag-icon flag-icon-<?php echo strtolower($partidoJugandoObj->getPaisLocal()->getIso()); ?> bandera-normal"></span>
															</td>
															<td class="text-center centrado-vertical">
																<span class="txt-blanco nombre-pais">
																	<?php echo $partidoJugandoObj->getPaisLocal()->getNombre(); ?>
																</span>
															</td>
															<td class="text-center centrado-vertical">
																<span class="txt-amarillo">vs</span>
															</td>
															<td class="text-center centrado-vertical">
																<span class="txt-blanco nombre-pais">
																	<?php echo $partidoJugandoObj->getPaisVisitante()->getNombre(); ?>
																</span>
															</td>
															<td class="text-left centrado-vertical">
																<span class="flag-icon flag-icon-<?php echo strtolower($partidoJugandoObj->getPaisVisitante()->getIso()); ?> bandera-normal"></span>
															</td>
															<td class="text-center centrado-vertical">
																<?php $fechaHoraPartido = DateTime::createFromFormat('Y-m-d H:i:s', $partidoJugandoObj->getFecha()); ?>
																<div class="date">
																	<p class="month"><?php echo $fechaHoraPartido->format('M'); ?></p>
																	<p class="day"><?php echo $fechaHoraPartido->format('d'); ?></p>
																	<p class="time"><?php echo $fechaHoraPartido->format('H:i'); ?></p>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
				  							</table>
	  									</div>
	  									<div class="col-md-6 col-sm-12 col-xs-12">
	  										<ul class="txt-blanco mt-10">
	  											<li class="pb-10">
			  										<span class="">
			  											Las apuestas se procesan al finalizar éstos partidos
			  										</span>
	  											</li>
	  											<li class="pb-10">
			  										<span class="">
			  											No se permite apostar a partidos en vigencia 
			  										</span>
	  											</li>
	  										</ul>
	  									</div>
	  								</div>
	  							</div>
	  						</div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>
  		<?php endif ?>

  		<div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">
  				<div class="x_panel">
  					<div class="x_title">
  						<h2>
  							Mis apuestas
  							<small>
  								Últimos 5 (<a href="" class="txt-amarillo txt-blanco-hover">ver todos</a>)
  							</small>
  						</h2>
  						<div class="clearfix"></div>
  					</div>
  					<div class="x_content fondo-imagen fondo-4">
  						<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
							<?php $this->load->view('cancha/blocks/apuestas_resultado', array('arrApuestas' => $arrConsolidadoApuestas)); ?>
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
  							Desafíos aceptados
  							<small>
  								Últimos 5 (<a href="" class="txt-amarillo txt-blanco-hover">ver todos</a>)
  							</small>
  						</h2>
  						<div class="clearfix"></div>
  					</div>
  					<div class="x_content fondo-imagen fondo-8">
  						<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
							<?php $this->load->view('cancha/blocks/apuestas_resultado', array('arrApuestas' => $arrConsolidadoApostadorParticipaciones)); ?>
  						</div>
  					</div>
  				</div>
			</div>
  		</div>

  	</div>
</div>
<!-- /page content -->

<?php $this->load->view('cancha/blocks/modal_apuesta_crear', array()) ?>
<?php $this->load->view('cancha/blocks/modal_apuesta_unir', array()) ?>