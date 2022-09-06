<!DOCTYPE html>
<html>

<head>
    <?php $web = $this->main_model->get_web(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/files/logo/<?php echo $web['favicon']; ?>">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/files/logo/<?php echo $web['favicon']; ?>">
    <title><?php echo $web['meta_description']; ?> | <?php echo $web['name']; ?></title>
    <meta name="description" content="<?php echo $web['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $web['meta_keywords']; ?>">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/backoffice/images/<?php echo $web['favicon']; ?>" rel="stylesheet">

    <!-- feather icons -->
    <link href="<?php echo base_url(); ?>assets/backoffice/fonts/feather-font/css/iconfont.css" rel="stylesheet">

    <!-- flag icon -->
    <link href="<?php echo base_url(); ?>assets/backoffice/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">

    <!-- jquery -->
    <!-- <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery/jquery.min.js"></script> -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap/css/bootstrap.css">

    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/summernote/summernote-bs4.css">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.min.css">

    <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/select2/select2.min.css">

    <!-- tags-input -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-tags-input/jquery.tagsinput.min.css">

    <!-- dropzone -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/dropzone/dropzone.min.css">

    <!-- dropify -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/dropify/dist/dropify.min.css">

    <!-- datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <!-- font-awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/font-awesome/css/font-awesome.min.css">

    <!-- bootstrap tempusdominus -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">

    <!-- bootstrap fileupload -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-fileupload/bootstrap-fileupload.css">

    <!-- datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <!-- magnific popup -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/magnific-popup/magnific-popup.css">

    <!-- sweet alert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.min.css">

    <!-- toast -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/toastr/toastr.css">

    <!-- style -->
    <link href="<?php echo base_url(); ?>assets/backoffice/vendors/core/core.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backoffice/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backoffice/css/custome.css" rel="stylesheet">

    <!-- core js -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/core/core.js"></script>

    <!-- validate -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-validation/additional-methods.min.js"></script>

    <!-- toast -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/toastr/toastr.min.js"></script>
</head>


<body>
    <div class="main-wrapper">
        <?php $this->load->view($page); ?>
    </div>


    <!-- magnific popup -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/magnific-popup/magnific-popup.min.js"></script>

    <!-- sweet alert -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/chartjs/Chart.min.js"></script>

    <!-- apex chart -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/apexcharts/apexcharts.min.js"></script>

    <!-- flot -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery.flot/jquery.flot.resize.js"></script>

    <!-- feather icons -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/feather-icons/feather.min.js"></script>

    <!-- main js -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/template.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/dashboard.js"></script>

    <!-- momment -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/moment/moment.min.js"></script>

    <!-- summernote -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/summernote/summernote-bs4.js"></script>

    <!-- polyfill -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/promise-polyfill/polyfill.min.js"></script>

    <!-- bootstrap maxlength -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <!-- select2 -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/select2/select2.min.js"></script>

    <!-- typeahead -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/typeahead.js/typeahead.bundle.min.js"></script>

    <!-- tags-input -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>

    <!-- dropzone -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/dropzone/dropzone.min.js"></script>

    <!-- dropify -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/dropify/dist/dropify.min.js"></script>

    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- bootstrap tempusdominus -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>

    <!-- progress bar -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- bootstrap-fileupload -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <!-- datatables -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

    <!-- init script -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/template.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/dashboard.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/timepicker.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert-fade").fadeTo(800, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000);

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>