<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<?php if ( isset($output) ): ?>
				    <div class="box-header well" data-original-title="">
				        <h2>
				            <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $titlePage; ?>
				        </h2>
				    </div>
				    <div class="box-content">
				        <?php echo $output; ?>
				    </div>
				<?php else: ?>
				    <div class="box-header well" data-original-title="">
				        <h2>
				            <i class="glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;Atención
				        </h2>
				    </div>
				    <div class="box-content text-center">
				        <h3>No se encontró contenido</h3>
				    </div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->