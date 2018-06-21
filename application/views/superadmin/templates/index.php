<!-- page content -->
<div class="right_col" role="main">
	<!-- top tiles -->
	<div class="row tile_count">
		<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Apostadores</span>
			<div class="count"><?php echo $totalApostadores; ?></div>
			<span class="count_bottom">Personas apostando</span>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-usd"></i> Comisiones</span>
			<div class="count"><?php echo number_format( $totalComisionesReal, 2); ?></div>
			<span class="count_bottom">
				$ <?php echo number_format( $totalComisiones, 2); ?> (Total) - $ <?php echo number_format( $totalComisionesInvitados, 2); ?> (Invitados)
			</span>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Dinero</span>
			<div class="count green"><?php echo number_format( $totalInicialReal, 2); ?></div>
			<span class="count_bottom">
				$ <?php echo number_format( $totalInicial, 2); ?> (Total) - $ <?php echo number_format( $totalInicialInvitados, 2); ?> (Invitados)
			</span>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Devolución</span>
			<div class="count"><?php echo number_format( $totalDisponibleReal, 2); ?></div>
			<span class="count_bottom">
				$ <?php echo number_format( $totalDisponible, 2); ?> (Total) - $ <?php echo number_format( $totalDisponibleInvitados, 2); ?> (Invitados)
			</span>
		</div>
	</div>
	<!-- /top tiles -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-hover" id="datatable-buttons">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Cédula
						</th>
						<th>
							Nombre
						</th>
						<th>
							Email
						</th>
						<th>
							Aciertos
						</th>
						<th>
							$ Disppnible
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($apostadoresObj as $indiceApostador => $apostadorObj): ?>
						<tr>
							<td>
								<?php echo $indiceApostador + 1; ?>
							</td>
							<td>
								<?php echo $apostadorObj->getCedula(); ?>
							</td>
							<td>
								<?php echo $apostadorObj->getNombre(); ?>
							</td>
							<td>
								<?php echo $apostadorObj->getEmail(); ?>
							</td>
							<td>
								<?php echo $apostadorObj->getNumeroGanadas(); ?>
							</td>
							<td>
								$ <?php echo number_format( $apostadorObj->getValorDisponible(), 2); ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>


	<div class="row">
	<?php foreach ($paisesObj as $indicePais => $paisObj): ?>
		<div class="col-xs-3">
			<span class="flag-icon flag-icon-<?php echo strtolower($paisObj->getIso()); ?>"></span>
			<span><?php echo $paisObj->getNombre(); ?></span>
			<span class="txt-negrita"><?php echo $paisObj->getID(); ?></span>
		</div>
	<?php endforeach ?>
	</div>
</div>
<!-- /page content -->