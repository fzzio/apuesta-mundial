<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="description" content="<?php echo PROYECTO_NOMBRE; ?>">
        <meta name="author" content="<?php echo PROYECTO_DESARROLLADOR; ?>">

        <?php /*
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/apuestamundial/img/favicon-32x32.png'); ?>" />
        */ ?>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- NProgress -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/nprogress/nprogress.css'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/iCheck/skins/flat/blue.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/animate.css/animate.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css'); ?>">

        <!-- Switchery -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/switchery/dist/switchery.min.css'); ?>">
        <!-- bootstrap-daterangepicker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>">
        <!-- Bootstrap Colorpicker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'); ?>">

        <!-- Datatables -->
        <link href="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('bower_components/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'); ?>" rel="stylesheet">

        
        <!-- Gentelella -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/gentelella/build/css/custom.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/flag-icon-css/css/flag-icon.min.css'); ?>">

        <!-- Estilo Sistema -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/apuestamundial/css/custom-bootstrap-margin-padding.css'); ?>">

        <?php if (isset($css_files)): ?>
            <!-- grocerycrud -->
            <?php foreach($css_files as $file): ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
            <!-- grocerycrud -->
        <?php endif ?>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/apuestamundial/css/estilo-admin.css'); ?>">

        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';

            var js_site_url = function( urlText ){
                var urlTmp = "<?php echo site_url('" + urlText + "'); ?>";
                return urlTmp;
            }

            var js_base_url = function( urlText ){
                var urlTmp = "<?php echo base_url('" + urlText + "'); ?>";
                return urlTmp;
            }
        </script>
        <title>
            <?php echo PROYECTO_NOMBRE; ?>:: <?php echo $titlePage ?>
        </title>
    </head>
    <?php $claseBody = ($this->router->method == 'login') ? 'login' : 'nav-md' ; ?>
    <body class="<?php echo($claseBody); ?>">
        <?php if ($this->router->method != 'login'): ?>
            <div class="container body">
                <div class="main_container">
        <?php endif ?>