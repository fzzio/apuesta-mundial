<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<?php foreach ($paisesObj as $indicePais => $paisObj): ?>
			<span class="flag-icon flag-icon-<?php echo strtolower($paisObj->getIso()); ?>"></span> <?php echo $paisObj->getNombre(); ?> <br />
		<?php endforeach ?>
	</div>
</div>
<!-- /page content -->