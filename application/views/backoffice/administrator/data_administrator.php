<a href="javascript:void(0);" id="add-data" class="btn btn-primary btn-icon-text mb-2">
    <i class="btn-icon-prepend" data-feather="plus-circle"></i>Tambah
</a>
<a href="javascript:void(0)" id="reload-table" class="btn btn-light btn-icon-text mb-2">
    <i class="btn-icon-prepend" data-feather="refresh-ccw"></i>Reload
</a>
<a href="javacript:void(0);" id="delete-data-multiple" class="btn btn-danger invisible btn-icon-text mb-2">
    <i class="btn-icon-prepend" data-feather="trash"></i>Delete
</a>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Admin</h6>

                <div class="table-responsive">
                    <table id="table-data" class="table">
                        <thead>
                            <tr>
                                <th class="text-center py-0"><label class="checkbox-custome"><input type="checkbox" name="check-all-record"></label></th>
                                <th class="text-center">No</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">No Telp</th>
                                <!-- <th class="text-center">Role</th> -->
                                <th class="text-center">Terakhir Login</th>
                                <th class="text-center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-style" id="modal-data" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title"></h4>
                <br>

                <form method="post" id="form-tambah-data" enctype="multipart/form-data" class="cmxform">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Unggah Foto</label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail">
                                        <img id="photo_preview" src="<?php echo base_url(); ?>assets/files/no-images.png" alt="" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 100px;"></div>
                                    <div id="photo_feed">
                                        <span class="btn btn-xs btn-info btn-file">
                                            <span class="fileupload-new">Pilih Foto</span>
                                            <span class="fileupload-exists">Ganti</span>
                                            <input type="file" name="photo" id="photo" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-xs btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" placeholder="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" placeholder="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No. Telephone</label>
                                <input type="text" name="no_telp" id="no_telp" placeholder="" class="form-control">
                            </div>

                            <div class="form-group fg-password">
                                <label>Password</label>
                                <input type="text" name="password" id="password" placeholder="" class="form-control">
                            </div>

                            <!-- <div class="form-group mb-4">
                                <label>Role</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="roleadm" name="role" value="admin" checked>
                                    <label for="roleadm" class="custom-control-label">Admin</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="roleopr" name="role" value="operator">
                                    <label for="roleopr" class="custom-control-label">Operator</label>
                                </div>
                            </div> -->
                        </div>

                        <div class="col-md-12">
                            <div class="block-bottom d-flex justify-content-between">
                                <input type="hidden" name="param" id="param">
                                <input type="hidden" name="id_user" id="id_user">
                                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="link-icon" data-feather="x"></i> Batal</button>
                                <button type="submit" id="submit-tambah-data" class="btn btn-primary"><i class="link-icon" data-feather="check"></i> Selesai</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade modal-style" id="modal-reset-password" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title">Reset Password</h4>
                <br>

                <form>
                    <input type="hidden" name="id" id="id2" value="">
                    <p>Apakah anda yakin ingin me-reset password user ini?<br>Password akan di reset menjadi '<b>123456</b>'</p>

                    <div class="block-bottom d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Batal</button>
                        <button type="button" id="button-reset-password" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php include APPPATH . 'views/backoffice/include_source.php'; ?>

<script>
    $.getScript("<?php echo base_url(); ?>assets/backoffice/js/custome.js");

    var save_method;

    $(document).ready(function() {

        var table = $('#table-data').DataTable({
            ajax: {
                url: "<?php echo base_url(); ?>backoffice/administrator/data_administrator/datatables",
                complete: function(data, type) {
                    json = data.responseJSON;
                },
            },
            order: [
                [0, "desc"]
            ],
            pageLength: 10,
            processing: true,
            serverSide: true,
            searching: true,
            info: true,
            pagingType: 'full_numbers',
            columnDefs: [{
                className: "text-center",
                targets: [0, 1, -3, -2, -1],
            }],
            language: {
                search: "",
                searchPlaceholder: "Search ...",
                lengthMenu: '<select class="form-control form-control-sm">' +
                    '<option value="10">10</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="500">500</option>' +
                    '<option value="1000">1000</option>' +
                    '</select>',
                zeroRecords: "Data tidak ditemukan"
            }
        });

        $('#reload-table').on('click', function() {
            table.ajax.reload();
        });

        $.validator.addMethod("cek_email", function(value, element) {
            $.ajax({
                method: "post",
                url: "<?php echo base_url(); ?>backoffice/administrator/data_administrator/cek_email",
                data: {
                    email: value
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == '1') {
                        result = true;
                    } else {
                        result = false;
                    }
                },
                async: false
            });
            return result;
        });

        var $param_input = $('#param');

        $("#form-tambah-data").validate({
            rules: {
                photo: {
                    extension: "jpg|jpeg|png",
                    // filesize: 1000000
                },
                username: {
                    required: true
                },
                nama_lengkap: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    cek_email: {
                        depends: function(element) {
                            if ($param_input.val() == "edit") {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                },
                no_telp: {
                    required: true,
                    number: true
                },
                password: {
                    required: {
                        depends: function(element) {
                            if ($param_input.val() == "edit") {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },
            messages: {
                photo: {
                    extension: "Unggah photo dengan format .PNG/.JPG/.JPEG",
                    // filesize: "File maksimal 1 Mbps."
                },
                username: {
                    required: "Username harus diisi."
                },
                nama: {
                    required: "Nama harus diisi."
                },
                email: {
                    required: "Email harus diisi.",
                    email: "Silahkan masukan alamat email dengan benar",
                    cek_email: "Email sudah terdaftar"
                },
                no_telp: {
                    required: "No Telp harus diisi.",
                    number: "Silahkan masukan no telp dengan benar"
                },
                password: {
                    required: "Password harus diisi."
                }
            },
            highlight: function(element, errorClass) {
                $(element).parent().addClass('has-error')
                $(element).addClass('has-error')
            },
            unhighlight: function(element, errorClass) {
                $(element).parent().removeClass('has-error')
                $(element).removeClass('has-error')
            },
            errorPlacement: function(error, element) {
                if (element.is('#photo')) {
                    error.insertAfter('#photo_feed').addClass('has-error');
                } else {
                    error.insertAfter(element);
                }
            }
        });


        // --------------------------- add & edit data --------------------------- 
        $('#add-data').on('click', function() {
            save_method = 'add';
            $('#modal-data').modal('show');
            $('.modal-title').text('Tambah data');
            $('#param').val('add');
            $("#form-tambah-data")[0].reset();
            $('#photo_preview').attr('src', '<?php echo base_url(); ?>assets/files/no-images.png');
        });

        $('#table-data').on('click', '#edit-data', function() {
            var id = $(this).attr('data');
            save_method = 'edit';
            $('#modal-data').modal('show');
            $('.modal-title').text('Edit data');
            $('#param').val('edit');
            $("#form-tambah-data")[0].reset();
            $('#photo_preview').attr('src', '<?php echo base_url(); ?>assets/files/no-images.png');

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>backoffice/administrator/data_administrator/get_data",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#id_user').val(data.id_user);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#no_telp').val(data.no_telp);

                    if (data.photo == '') {
                        $('#photo_preview').attr('src', '<?php echo base_url(); ?>assets/files/no-images.png');
                    } else {
                        $('#photo_preview').attr('src', '<?php echo base_url(); ?>assets/files/admin/' + data.photo + '');
                    }

                    // if (data.role_admin == 'admin') {
                    //     $('#roleadm').prop("checked", true);
                    // } else if (data.role_admin == 'operator') {
                    //     $('#roleopr').prop("checked", true);
                    // }
                }
            });
            return false;
        });


        $('#form-tambah-data').submit(function(e) {
            e.preventDefault();
            if (jQuery("#form-tambah-data").valid()) {

                // $('#submit-tambah-data').buttonLoader('start');

                if (save_method == 'add') {
                    url = "<?php echo base_url(); ?>backoffice/administrator/data_administrator/add_data";
                } else {
                    url = "<?php echo base_url(); ?>backoffice/administrator/data_administrator/edit_data";
                }

                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#modal-data').modal('hide');
                        // $('#submit-tambah-data').buttonLoader('stop');

                        if (response.status == 1) {
                            $("#form-tambah-data")[0].reset();
                            table.ajax.reload();
                            Toast.fire({
                                type: 'success',
                                title: response.message
                            });
                        } else if (response.status == 2) {
                            Toast.fire({
                                type: 'error',
                                title: response.message
                            });
                        } else if (response.status == 3) {
                            $("#form-tambah-data")[0].reset();
                            table.ajax.reload();
                            Toast.fire({
                                type: 'success',
                                title: response.message
                            });
                        } else if (response.status == 4) {
                            Toast.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    }
                })
            }
        });
        // --------------------------- end add & edit data ---------------------------


        // --------------------------- reset password ---------------------------
        $('#table-data').on('click', '#reset-password', function() {
            var id = $(this).attr('data');
            $('#modal-reset-password').modal('show');
            $('.modal-title').text('Reset Password');
            $('#id2').val(id);
        });

        $('#button-reset-password').on('click', function() {

            // $('#button-reset-password').buttonLoader('start');
            var id = $('#id2').val();

            $.ajax({
                url: '<?php echo base_url(); ?>backoffice/administrator/data_administrator/reset_password',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // $('#button-reset-password').buttonLoader('stop');
                    $('#modal-reset-password').modal('hide');
                    table.ajax.reload();

                    if (response == 1) {
                        Toast.fire({
                            type: 'success',
                            title: 'Password berhasil di-reset.'
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: 'Gagal reset password.'
                        });
                    }

                }
            })
        });
        // --------------------------- reset password ---------------------------


        // --------------------------- delete data ---------------------------
        // delete sigle
        $('#table-data').on('click', '#delete-data', function() {
            var id = $(this).attr('data');
            $('#modal-delete').modal('show');
            $('#id3').val(id);
            $('#method').val('single');
        });

        // post delete
        $('#button-delete').on('click', function() {

            // $('#button-delete').buttonLoader('start');
            var id = $('#id3').val();
            var method = $('#method').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>backoffice/administrator/data_administrator/delete_data",
                dataType: "JSON",
                data: {
                    id: id,
                    method: method
                },
                success: function(response) {
                    // $('#button-delete').buttonLoader('stop');
                    $('#modal-delete').modal('hide');
                    table.ajax.reload();

                    if (response == 1) {
                        Toast.fire({
                            type: 'success',
                            title: 'Data berhasil dihapus.'
                        });
                    } else if (response == 2) {
                        Toast.fire({
                            type: 'success',
                            title: 'Data berhasil dihapus.'
                        });
                        $('#delete-data-multiple').addClass('invisible', true);
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: 'Gagal menghapus data.'
                        });
                    }

                }
            });
            return false;
        });
        // --------------------------- end delete data ---------------------------
    });
</script>