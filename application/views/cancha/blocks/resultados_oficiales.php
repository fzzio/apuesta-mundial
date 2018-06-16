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