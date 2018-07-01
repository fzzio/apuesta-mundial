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
					<div class="btn btn-sm btn-negro btn-amarillo-hover" onclick="modalCrearApuesta(<?php echo $partidoProximoObj->getID(); ?>);">
						Apostar
						<?php if ($partidoProximoObj->getFase() != FASE_GRUPOS): ?>
							<br />
							<span class="txt-btn-pequeno">
								<?php 
									switch ( intval( $partidoProximoObj->getFase() ) ) {
										case FASE_OCTAVOS:
											echo "[ octavos de final ]";
											break;
										case FASE_CUARTOS:
											echo "[ cuartos de final ]";
											break;
										case FASE_SEMIFINAL:
											echo "[ semifinales ]";
											break;
										case FASE_TERCERO:
											echo "[ tercer lugar ]";
											break;
										case FASE_FINAL:
											echo "[ la final ]";
											break;
										
										default:
											break;
									}
								?>
							</span>
						<?php endif ?>
					</div>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>