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
		<?php foreach ($arrApuestas as $indiceApuesta => $apuesta): ?>
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
							Gana <?php echo $partidoObj->getPaisLocal()->getNombre(); ?>
						</span>
					<?php else: ?>
						<div class="btn btn-sm btn-negro btn-amarillo-hover" onclick="modalUnirApuesta(<?php echo $apuesta['apuestaID']; ?>, <?php echo PRONOSTICO_GANA_LOCAL; ?>);">
							Gana <?php echo $partidoObj->getPaisLocal()->getNombre(); ?>
						</div>
					<?php endif ?>
				</td>
				<td class="text-center centrado-vertical">
					<?php if ($partidoObj->getFase() == FASE_GRUPOS ): ?>
						<?php if ( $apuesta["resultadoRival"] == PRONOSTICO_EMPATE ): ?>
							<span class="txt-blanco">
								Empate
							</span>
						<?php else: ?>
							<div class="btn btn-sm btn-negro btn-amarillo-hover" onclick="modalUnirApuesta(<?php echo $apuesta['apuestaID']; ?>, <?php echo PRONOSTICO_EMPATE; ?>);">
								Empate
							</div>
						<?php endif ?>
					<?php else: ?>
						--
					<?php endif ?>
				</td>
				<td class="text-center centrado-vertical">
					<?php if ( $apuesta["resultadoRival"] == PRONOSTICO_GANA_VISITANTE ): ?>
						<span class="txt-blanco">
							Gana <?php echo $partidoObj->getPaisVisitante()->getNombre(); ?>
						</span>
					<?php else: ?>
						<div class="btn btn-sm btn-negro btn-amarillo-hover" onclick="modalUnirApuesta(<?php echo $apuesta['apuestaID']; ?>, <?php echo PRONOSTICO_GANA_VISITANTE; ?>);">
							Gana <?php echo $partidoObj->getPaisVisitante()->getNombre(); ?>
						</div>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>