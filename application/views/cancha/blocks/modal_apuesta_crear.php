<!-- Modal apuesta crear -->
<div id="modal-crear-apuesta" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<form action="" method="POST" id="form-apuesta-crear" class="form-horizontal form-label-left">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Crear Apuesta</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<h5 class="txt-blanco">
									Hola <span class="txt-amarillo"><?php echo $this->session->userdata('nombre'); ?></span>, vas a apostar en el siguiente partido:
								</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 borde-amarillo pt-10 pb-10">
								<table class="table table-hover table-condensed tabla-partidos mt-0 mb-0">
									<tbody>
										<tr class="info-partido">
											<td class="text-right centrado-vertical">
												<span class="flag-icon bandera-normal" id="apuesta-bandera-local"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais" id="apuesta-pais-local">

												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-amarillo">vs</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais" id="apuesta-pais-visitante">
												</span>
											</td>
											<td class="text-left centrado-vertical">
												<span class="flag-icon bandera-normal" id="apuesta-bandera-visitante"></span>
											</td>
											<td class="text-center centrado-vertical">
												<div class="date no-border">
													<p class="month" id="apuesta-partido-mes"></p>
													<p class="day" id="apuesta-partido-dia"></p>
													<p class="time" id="apuesta-partido-hora"></p>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 pt-10 pb-10">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12 txt-blanco" for="apuesta-pronostico">
										Resultado:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select name="apuesta-pronostico" id="apuesta-pronostico" class="form-control" required>
											<option value="">Seleccionar</option>
											<option value="<?php echo PRONOSTICO_GANA_LOCAL; ?>" id="apuesta-pronostico-ganalocal"></option>
											<option value="<?php echo PRONOSTICO_EMPATE; ?>">Empate</option>
											<option value="<?php echo PRONOSTICO_GANA_VISITANTE; ?>" id="apuesta-pronostico-ganavisitante"></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12 txt-blanco" for="apuesta-monto">
										Monto: <br />
										<small class="txt-light">(Disponible $ <?php echo number_format($saldoDisponible, 2); ?>)</small>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="apuesta-monto" value="" id="apuesta-monto" class="form-control col-md-7 col-xs-12" placeholder="1.00" required>
									</div>
								</div>
								<input type="hidden" id="apuesta-apostador" name="apuesta-apostador" value="<?php echo $this->session->userdata('id'); ?>" />
								<input type="hidden" id="apuesta-partido" name="apuesta-partido" value="" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p class="txt-blanco text-center">
									<small>El costo por apostar en esta fase es de <span class="txt-amarillo" id="apuesta-partido-costo"></span></small>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-negro btn-amarillo-hover" data-dismiss="modal">Cerrar</button>
					<input type="submit" name="apuesta-submit" value="Apostar" class="btn btn-negro btn-amarillo-hover" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /Modal apuesta crear -->