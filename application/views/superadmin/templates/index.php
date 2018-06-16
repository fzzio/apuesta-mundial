<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="row">
		<?php foreach ($paisesObj as $indicePais => $paisObj): ?>
			<div class="col-xs-3">
				<span class="flag-icon flag-icon-<?php echo strtolower($paisObj->getIso()); ?>"></span>
				<span><?php echo $paisObj->getNombre(); ?></span>
				<span class="text-negrita"><?php echo $paisObj->getID(); ?></span>
			</div>
		<?php endforeach ?>
		</div>
	</div>
</div>
<!-- /page content -->