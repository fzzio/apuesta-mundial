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

        <!-- Datatables -->
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/jszip/dist/jszip.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/gentelella/vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>


        <!-- Script NEAR -->
        <script type="text/javascript" src="<?php echo base_url('assets/apuestamundial/js/script-admin.js'); ?>"></script>

    </body>
</html>