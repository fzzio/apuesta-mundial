<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						Ranking
						<small>
							TOP 10
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
										<span class="txt-amarillo text-uppercase">#</span>
									</th>
									<th class="text-center centrado-vertical">
										<span class="txt-amarillo text-uppercase">Nombre</span>
									</th>
									<th class="text-center centrado-vertical">
										<span class="txt-amarillo text-uppercase">Aciertos</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($arrRanking as $indiceRanking => $itemRanking): ?>
									<tr class="info-partido">
										<td class="text-center centrado-vertical">
											<span class="txt-amarillo">
												<?php echo $indiceRanking + 1; ?>
											</span>
										</td>
										<td class="text-center centrado-vertical">
											<span class="txt-blanco">
												<?php echo $itemRanking["nombre"]; ?>
											</span>
										</td>
										<td class="text-center centrado-vertical">
											<span class="txt-blanco">
												<?php echo $itemRanking["aciertos"]; ?>
											</span>
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
		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			<a href="<?php echo site_url('cancha/index'); ?>" class="btn btn-md btn-negro submit btn-amarillo-hover">
				Volver
			</a>
		</div>
	</div>
</div>
<!-- /page content -->