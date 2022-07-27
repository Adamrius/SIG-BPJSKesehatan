<!DOCTYPE html>
<html lang="en">

<head>
    <?php $web = $this->main_model->get_web(); ?>

    <title><?php echo $web['meta_description']; ?> | <?php echo $web['name']; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#17C9C3">
    <meta name="description" content="<?php echo $web['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $web['meta_keywords']; ?>">
    <meta name="author" content="">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo $web['name']; ?>">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/files/logo/<?php echo $web['favicon']; ?>">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/files/logo/<?php echo $web['favicon']; ?>">

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style.css">

    <script defer src="<?php echo base_url(); ?>assets/front/vendor/fontawesome/js/all.js"></script>

    <!-- jquery -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/jquery/jquery.min.js"></script>

    <!-- select2 -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/select2/js/select2.min.js" type="text/javascript"></script>

    <!-- bootstrap -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js" defer="defer"></script>

    <!-- theia.sticky -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/jquery.theia.sticky.js"></script>

    <!-- lazyload -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/lazyload/jquery.lazy.min.js"></script>

    <!-- main -->
    <!-- <script src="<?php echo base_url(); ?>assets/front/js/main.js"></script> -->
</head>

<body oncontextmenu="return false" data-spy="scroll" data-target=".site-navbar-target" data-offset="300" data-background="<?php echo base_url(); ?>assets/front/img/body-bg.png">

    <!-- site wrap -->
    <div class="site-wrap">

        <main class="wrap-main">
            <?php $this->load->view($page); ?>
        </main>
    </div>

</body>

</html>