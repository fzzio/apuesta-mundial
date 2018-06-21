<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						Mis apuestas
						<small>
							Se muestran todos
						</small>
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content fondo-imagen fondo-4">
					<div class="contenedor-tabla fondo-transparencia-negro-1 p-10">
						<?php $this->load->view('cancha/blocks/apuestas_resultado', array('arrApuestas' => $arrConsolidadoApuestas)); ?>
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