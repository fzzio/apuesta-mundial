	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>

		<div class="login_wrapper">
			<div class="animate form login_form fondo-opacidad pl-20 pr-20">
				<section class="login_content">
					<?php echo form_open('superadmin/login' , array('class' => '', 'id' => 'frm-login')); ?>
						<h1 class="mt-0 mb-20">
							Super Admin
						</h1>
						<p class="mt-0 mb-5 text-justify texto-sin-sombra">
							Ingrese su usuario y contraseña
						</p>
						<div>
							<?php echo form_error('sa-username'); ?>
							<?php echo form_input(array(
								'name' => 'sa-username',
								'value' => '',
								'placeholder' => 'Usuario',
								'class' => 'form-control',
								'maxlength' => 30
							));?>
						</div>
						<div>
							<?php echo form_error('sa-password'); ?>
							<?php echo form_password(array(
								'name' => 'sa-password',
								'value' => '',
								'placeholder' => 'Contraseña',
								'class' => 'form-control',
								'maxlength' => 30
							));?>
						</div>
						<div>
							<?php 
                                echo form_submit(array(
                                    'name' => 'sa-acceder',
                                    'value' => 'Iniciar sesión',
                                    'class' => 'btn btn-azul submit btn-azul-oscuro-hover'
                            ));?>
							<a class="reset_pass" href="#">Recuperar contraseña</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<?php /*
							// @cajanegraec Eliminar en producción
							<p class="change_link">New to site?
								<a href="#signup" class="to_register"> Create Account </a>
							</p>

							<div class="clearfix"></div>
							<br />
							*/ ?>
							<div>
								<h1>
									<i class="fa fa-user-secret"></i> <?php echo PROYECTO_NOMBRE; ?>
								</h1>
								<p>
									<?php echo PROYECTO_AUTOR; ?> &copy; <?php echo date("Y"); ?>. Todos los derechos reservados.
									<br />
									<small>
										 Desarrollado por <a href="http://www.cajanegra.com.ec" target="_blank"><?php echo PROYECTO_DESARROLLADOR; ?></a>
									</small>
								</p>
							</div>
						</div>
					<?php echo form_close(); ?>
				</section>
			</div>

			<?php /*
			// @cajanegraec Eliminar en producción
			<div id="register" class="animate form registration_form">
				<section class="login_content">
					<form>
						<h1>Create Account</h1>
						<div>
							<input type="text" class="form-control" placeholder="Username" required="" />
						</div>
						<div>
							<input type="email" class="form-control" placeholder="Email" required="" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Password" required="" />
						</div>
						<div>
							<a class="btn btn-default submit" href="index.html">Submit</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">Already a member ?
								<a href="#signin" class="to_register"> Log in </a>
							</p>

							<div class="clearfix"></div>
							<br />

							<div>
								<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
								<p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
							</div>
						</div>
					</form>
				</section>
			</div>
			*/ ?>
		</div>
	</div>