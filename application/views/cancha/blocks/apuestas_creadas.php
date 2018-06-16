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
		<?php foreach ($arrConsolidadoApuestas as $indiceApuesta => $apuesta): ?>
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
					<?php if ( $partidoObj->getEstado() == PARTIDO_FINALIZADO): ?>
						<p class="txt-blanco mb-0">
							<?php echo $partidoObj->getGolesLocal() ?> : <?php echo $partidoObj->getGolesVisitante() ?> (Final)
						</p>
					<?php endif ?>
				</td>
				<td class="text-center centrado-vertical">
					<span class="txt-blanco">
						$ <?php echo number_format($apuesta["montoApuesta"], 2); ?>
					</span>
				</td>
				<td class="text-center centrado-vertical">
					<span class="txt-blanco">
						<?php echo $apuesta["resultadoApostadorStr"]; ?>
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
							<span class="label label-success txt-light">Ganaste</span>
						<?php elseif ( $apuesta["resultadoApuesta"] == RESULTADO_PERDISTE ): ?>
							<span class="label label-danger txt-light">Perdiste</span>
						<?php elseif ( $apuesta["resultadoApuesta"] == RESULTADO_CASA_GANA ): ?>
							<span class="label label-warning txt-light">Ambos pierden</span>
						<?php elseif ( $apuesta["resultadoApuesta"] == RESULTADO_DESIERTA ): ?>
							<span class="label label-default txt-light">Nadie apostó</span>
						<?php else: ?>
							<span class="txt-blanco">
								--
							</span>
						<?php endif ?>
					<?php else: ?>
						--
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>