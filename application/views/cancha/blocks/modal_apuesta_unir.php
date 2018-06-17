<!-- Modal apuesta unir -->
<div id="modal-unir-apuesta" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<form action="" method="POST" id="form-apuesta-unir" class="form-horizontal form-label-left">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">Aceptar apuesta</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<h5 class="txt-blanco txt-interlineado-normal">
									Hola <span class="txt-amarillo"><?php echo $this->session->userdata('nombre'); ?></span>, vas desafiar a <span class="txt-amarillo" id="apuesta-unir-rival"></span> apostando en el siguiente partido:
								</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 borde-amarillo pt-10 pb-10">
								<table class="table table-hover table-condensed tabla-partidos mt-0 mb-0">
									<tbody>
										<tr class="info-partido">
											<td class="text-right centrado-vertical">
												<span class="flag-icon bandera-normal" id="apuesta-unir-bandera-local"></span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais" id="apuesta-unir-pais-local">

												</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-amarillo">vs</span>
											</td>
											<td class="text-center centrado-vertical">
												<span class="txt-blanco nombre-pais" id="apuesta-unir-pais-visitante">
												</span>
											</td>
											<td class="text-left centrado-vertical">
												<span class="flag-icon bandera-normal" id="apuesta-unir-bandera-visitante"></span>
											</td>
											<td class="text-center centrado-vertical">
												<div class="date no-border">
													<p class="month" id="apuesta-unir-partido-mes"></p>
													<p class="day" id="apuesta-unir-partido-dia"></p>
													<p class="time" id="apuesta-unir-partido-hora"></p>
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
									<label class="control-label col-md-6 col-sm-6 col-xs-12 txt-blanco">
										Tu pronóstico:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 pt-8">
										<span class="txt-amarillo" id="apuesta-unir-pronostico-apostador">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-6 col-sm-6 col-xs-12 txt-blanco">
										Pronóstico del rival:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 pt-8">
										<span class="txt-amarillo" id="apuesta-unir-pronostico-rival">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-6 col-sm-6 col-xs-12 txt-blanco">
										Monto de la apuesta:
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12 pt-8">
										<span class="txt-amarillo" id="apuesta-unir-monto">
										</span>
									</div>
								</div>
								<input type="hidden" id="apuesta-unir-id" name="apuesta-unir-id" value="" />
								<input type="hidden" id="apuesta-unir-apostador" name="apuesta-unir-apostador" value="<?php echo $this->session->userdata('id'); ?>" />
								<input type="hidden" id="apuesta-unir-pronostico" name="apuesta-unir-pronostico" value="" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p class="txt-blanco text-center">
									<small>
										Costo adicional por apuesta: <span class="txt-amarillo" id="apuesta-unir-partido-costo"></span>
									</small>
								</p>
							</div>
						</div>
						<div class="row" id="contenedor-error-unir">
							<div class="col-xs-12">
								<div class="alert alert-danger" role="alert" id="apuesta-unir-mensaje-error">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-negro btn-amarillo-hover" data-dismiss="modal">Cerrar</button>
					<input type="submit" name="apuesta-unir-submit" value="Apostar" class="btn btn-negro btn-amarillo-hover" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /Modal apuesta unir -->