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
					<?php if ( $apuesta["resultadoRival"] == PRONOSTICO_GANA_LOCAL ): ?>
						<span class="txt-blanco">
							Gana Local
						</span>
					<?php else: ?>
						<div class="btn btn-negro btn-amarillo-hover">
							Gana Local
						</div>
					<?php endif ?>
				</td>
				<td class="text-center centrado-vertical">
					<?php if ( $apuesta["resultadoRival"] == PRONOSTICO_EMPATE ): ?>
						<span class="txt-blanco">
							Empate
						</span>
					<?php else: ?>
						<div class="btn btn-negro btn-amarillo-hover">
							Empate
						</div>
					<?php endif ?>
				</td>
				<td class="text-center centrado-vertical">
					<?php if ( $apuesta["resultadoRival"] == PRONOSTICO_GANA_VISITANTE ): ?>
						<span class="txt-blanco">
							Gana Visitante
						</span>
					<?php else: ?>
						<div class="btn btn-negro btn-amarillo-hover">
							Gana Visitante
						</div>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>