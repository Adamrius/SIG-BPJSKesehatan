<!DOCTYPE html>
<html>

<head>
    <?php $web = $this->main_model->get_web(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title><?php echo $web['meta_description']; ?> | <?php echo $web['name']; ?></title>
    <meta name="description" content="<?php echo $web['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $web['meta_keywords']; ?>">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/backoffice/images/<?php echo $web['favicon']; ?>" rel="stylesheet">

    <!-- feather icons -->
    <link href="<?php echo base_url(); ?>assets/backoffice/fonts/feather-font/css/iconfont.css" rel="stylesheet">

    <!-- flag icon -->
    <link href="<?php echo base_url(); ?>assets/backoffice/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap/css/bootstrap.css">

    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/summernote/summernote-bs4.css">

    <!-- sweet alert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.min.css">

    <!-- toast -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/toastr/toastr.css">

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

    <!-- daterangepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-daterangepicker/daterangepicker.css">

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

    <!-- style -->
    <link href="<?php echo base_url(); ?>assets/backoffice/vendors/core/core.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backoffice/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backoffice/css/custome.css" rel="stylesheet">

    <!-- core js -->
    <!-- <script src="<?php echo base_url(); ?>assets/backoffice/vendors/core/core.js"></script> -->

    <!-- jquery -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery/jquery.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery/jquery.js"></script> -->

    <!-- toast -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/toastr/toastr.min.js"></script>

    <!-- sweet alert -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/sweetalert2/sweetalert2.min.js"></script>

    <style type="text/css">
        .opt1-hide option:nth-child(1) {
            display: none !important;
        }

        .btn-delete-record {
            position: absolute;
            left: 15em;
            z-index: 10;
        }
    </style>

    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })
    </script>
</head>


<body class="sidebar-dark">

    <?php $id_admin = $this->session->userdata('id_admin'); ?>
    <?php $get_admin = $this->db->query("SELECT * FROM admin_user WHERE id_user= " . $id_admin . " ")->row_array(); ?>

    <div class="main-wrapper">
        <!-- sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="<?php echo base_url(); ?>backoffice/dashboard" class="sidebar-brand"><?php echo $web['name']; ?></a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>backoffice/dashboard" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapse-data-kesehatan" role="button" aria-expanded="false" aria-controls="icons">
                            <i class="link-icon" data-feather="monitor"></i>
                            <span class="link-title">Fasilitas Kesehatan</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="collapse-data-kesehatan">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>backoffice/faskes/faskes" class="nav-link">Data Fasilitas Kesehatan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>backoffice/faskes/faskes/add" class="nav-link">Input Fasilitas Kesehatan</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>backoffice/kategori_faskes" class="nav-link">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Kategori Faskes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>backoffice/data_kecamatan" class="nav-link">
                            <i class="link-icon" data-feather="map"></i>
                            <span class="link-title">Data Kecamatan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapse-setting-website" role="button" aria-expanded="false" aria-controls="icons">
                            <i class="link-icon" data-feather="settings"></i>
                            <span class="link-title">Setting</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="collapse-setting-website">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>backoffice/administrator/web" class="nav-link">Setting Website</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>backoffice/administrator/konfigurasi_email" class="nav-link">Konfigurasi Email</a>
                                </li> -->
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>backoffice/administrator/data_administrator" class="nav-link">
                            <i class="link-icon" data-feather="user-plus"></i>
                            <span class="link-title">Data Administrator</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- end sidebar -->

        <div class="page-wrapper">
            <!-- navbar -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($get_admin['photo'] == '') { ?>
                                    <img class="profile-pic" src="<?php echo base_url(); ?>assets/files/no-images.png" alt="">
                                <?php } else { ?>
                                    <img class="profile-pic" src="<?php echo base_url(); ?>assets/files/admin/<?php echo $get_admin['photo']; ?>" alt="">
                                <?php } ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex flex-column">
                                    <div class="info mb-1">
                                        <p class="name font-weight-bold mb-0"><?php echo $get_admin['username']; ?></p>
                                    </div>
                                </div>

                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link btn-edit-profile">
                                                <i data-feather="user"></i>
                                                <span>Edit Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link btn-ubah-password">
                                                <i data-feather="lock"></i>
                                                <span>Rubah Password</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>backoffice/login/logout" class="nav-link">
                                                <i data-feather="log-out"></i>
                                                <span>Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end navbar -->

            <div class="page-content">
                <nav class="page-breadcrumb">
                    <?php if ($breadcrumbs) {
                        echo $breadcrumbs;
                    } ?>
                </nav>

                <?php $this->load->view($page); ?>
            </div>

            <!-- footer -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
                <p class="text-muted text-center text-md-left">Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script> SIG Fasilitas Kesehatan BPJS </a>. All rights reserved</p>
            </footer>
            <!-- end footer -->

        </div>
    </div>

    <div class="modal fade modal-style" id="modal-edit-profile" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h4 class="modal-title">Edit Profile</h4>
                    <br>

                    <form method="post" id="form-edit-profile" enctype="multipart/form-data" class="cmxform">
                        <div class="row">
                            <div class="col-md-6 pr-md-4">

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap2" placeholder="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" id="username2" placeholder="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email2" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 pl-md-4">
                                <div class="form-group">
                                    <label>No. Telephone</label>
                                    <input type="text" name="no_telp" id="no_telp2" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Unggah Foto</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                            <img id="photo_preview2" src="<?php echo base_url(); ?>assets/files/no-images.png" alt="" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px;"></div>
                                        <div id="photo_feed2">
                                            <span class="btn btn-xs btn-info btn-file">
                                                <span class="fileupload-new">Pilih Foto</span>
                                                <span class="fileupload-exists">Ganti</span>
                                                <input type="file" name="photo" id="photo2" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-xs btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="block-bottom d-flex justify-content-between">
                                    <input type="hidden" name="id_admin" id="id_admin2">
                                    <input type="hidden" name="role" id="role2">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="link-icon" data-feather="x"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="check"></i> Selesai</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade modal-style" id="modal-ubah-password" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h4 class="modal-title">Ubah Password</h4>
                    <br>

                    <form method="post" id="form-ubah-password" class="cmxform">
                        <div class="form-group">
                            <input type="password" name="password_res" id="password_res" placeholder="Password baru Anda" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="konf_password_res" id="konf_password_res" placeholder="Konfirmasi password baru Anda" class="form-control">
                        </div>

                        <div class="form-actions">
                            <input type="hidden" name="id_admin_res" id="id_admin_res">
                            <button type="submit" class="btn btn-block btn-primary">Perbarui Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ./main-wrapper -->


    <!-- core js -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/core/core.js"></script>

    <!-- validate -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/jquery-validation/additional-methods.min.js"></script>

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

    <!-- apex chart -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/apexcharts/apexcharts.min.js"></script>

    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap tempusdominus -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>

    <!-- progress bar -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- bootstrap-fileupload -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <!-- datatables -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

    <!-- simple mde -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/simplemde/simplemde.min.js"></script>

    <!-- magnific popup -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/magnific-popup/magnific-popup.min.js"></script>

    <!-- feather icons -->
    <script src="<?php echo base_url(); ?>assets/backoffice/vendors/feather-icons/feather.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/id.js " type="text/javascript"></script> -->

    <!-- init script -->
    <script src="<?php echo base_url(); ?>assets/backoffice/js/template.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/dashboard.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/timepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/backoffice/js/dropify.js"></script>

    <script>
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

        window.setTimeout(function() {
            $(".alert-fade").fadeTo(800, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.btn-edit-profile').on('click', function() {
                $('#modal-edit-profile').modal('show');
                var id_admin = '<?php echo $get_admin['id_user']; ?>';

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>backoffice/dashboard/get_data_admin',
                    dataType: 'json',
                    data: {
                        id: id_admin
                    },
                    success: function(response) {
                        $('#id_admin2').val(response.id_user);
                        $('#nama_lengkap2').val(response.nama_lengkap);
                        $('#username2').val(response.username);
                        $('#email2').val(response.email);
                        $('#no_telp2').val(response.no_telp);
                        $('#role2').val(response.role);

                        if (response.photo) {
                            $('#photo_preview2').attr('src', '<?php echo base_url(); ?>assets/files/admin/' + response.photo + '');
                        } else {
                            $('#photo_preview2').attr('src', '<?php echo base_url(); ?>assets/files/no-images.png');
                        }

                    }
                });
                return false;
            });

            $('#form-edit-profile').submit(function() {

                $.ajax({
                    method: 'post',
                    url: '<?php echo base_url(); ?>backoffice/dashboard/edit_data_admin',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#modal-edit-profile').modal('hide');

                        if (response.status == 1) {
                            $("#form-edit-profile")[0].reset();
                            Toast.fire({
                                type: 'success',
                                title: response.message
                            });
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    }
                })

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            var validate_reset = $("#form-ubah-password").validate({
                rules: {
                    password_res: {
                        required: true,
                        minlength: 5
                    },
                    konf_password_res: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password_res"
                    }
                },
                messages: {
                    password_res: {
                        required: "Password baru harus diisi.",
                        minlength: "Password minimal 5 character."
                    },
                    konf_password_res: {
                        required: "Password baru harus diisi.",
                        minlength: "Password minimal 5 character.",
                        equalTo: "Konfirmasi password tidak sesuai."
                    }
                },
                errorElement: "em",
                errorClass: "has-error",
                highlight: function(element, errorClass) {
                    $(element).parent().addClass('has-error')
                    $(element).addClass('has-error')
                },
                unhighlight: function(element, errorClass) {
                    $(element).parent().removeClass('has-error')
                    $(element).removeClass('has-error')
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });

            $('.btn-ubah-password').on('click', function() {
                $('#modal-ubah-password').modal('show');
                var id_admin = '<?php echo $get_admin['id_user']; ?>';
                $('#id_admin_res').val(id_admin);
            });

            $('#form-ubah-password').submit(function(e) {
                e.preventDefault();

                if ($("#form-ubah-password").valid()) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>backoffice/dashboard/ubah_password_admin',
                        method: 'post',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == 1) {
                                window.location.href = "<?php echo base_url(); ?>backoffice/login";
                            } else {

                            }
                        }
                    })
                }
            });
        });
    </script>

</body>

</html>