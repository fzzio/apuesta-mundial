        <?php if ($this->router->method != 'login'): ?>
                <!-- footer content -->
                <footer>
                  <div class="pull-right">
                    <?php echo PROYECTO_AUTOR; ?> &copy; <?php echo date("Y"); ?>. Todos los derechos reservados. Desarrollado por <a href="http://www.cajanegra.com.ec" target="_blank"><?php echo PROYECTO_DESARROLLADOR; ?></a>
                  </div>
                  <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
              </div>
            </div>
        <?php endif ?>



        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <?php if (isset($js_files)): ?>
            <!-- grocerycrud -->
            <?php foreach($js_files as $file): ?>
                <script type="text/javascript" src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>
            <!-- grocerycrud -->
        <?php else: ?>
        <?php endif ?>

        <!-- FastClick -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/gentelella/vendors/fastclick/lib/fastclick.js'); ?>"></script>
        <!-- NProgress -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/gentelella/vendors/nprogress/nprogress.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('bower_components/gentelella/vendors/iCheck/icheck.min.js'); ?>"></script>
        <!-- bootstrap-daterangepicker -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/gentelella/vendors/moment/min/moment.min.js'); ?>"></script>


        <!-- Script NEAR -->
        <script type="text/javascript" src="<?php echo base_url('assets/apuestamundial/js/script-admin.js'); ?>"></script>

    </body>
</html>