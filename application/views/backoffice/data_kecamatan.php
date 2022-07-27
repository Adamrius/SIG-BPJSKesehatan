<div class="d-md-flex justify-content-between flex-wrap grid-margin mb-xl-2 mb-lg-2">
    <div>
        <a href="javascript:void(0);" id="add-data" class="btn btn-primary btn-icon-text ">
            <i class="btn-icon-prepend" data-feather="plus-circle"></i>Tambah
        </a>
        <a href="javascript:void(0)" id="reload-table" class="btn btn-light btn-icon-text">
            <i class="btn-icon-prepend" data-feather="refresh-ccw"></i>Reload
        </a>
        <a href="javacript:void(0);" id="delete-data-multiple" class="btn btn-danger btn-icon-text invisible">
            <i class="btn-icon-prepend" data-feather="trash"></i>Delete
        </a>
    </div>
</div>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><?php echo $title; ?></h6>

                <div class="table-responsive">
                    <table id="table-data" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center py-0"><label class="checkbox-custome"><input type="checkbox" name="check-all-record"></label></th>
                                <th class="text-center">No</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center" width="15%"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-style" id="modal-data" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title"></h4>
                <br>

                <form method="post" id="form-tambah-data" enctype="multipart/form-data" class="cmxform">
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="kode" id="kode" placeholder="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" placeholder="" class="form-control">
                    </div>

                    <div class="block-bottom d-flex justify-content-between">
                        <input type="hidden" name="param" id="param">
                        <input type="hidden" name="id" id="id">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" id="submit-form" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade modal-style" id="detail-data-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title"></h4>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kode :</label>
                            <p class="text-muted" id="d_kode"></p>
                        </div>

                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kecamatan :</label>
                            <p class="text-muted" id="d_kecamatan"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php include APPPATH . 'views/backoffice/include_source.php'; ?>

<script>
    $.getScript("<?php echo base_url(); ?>assets/backoffice/js/custome.js");

    $(document).ready(function() {

        var table = $('#table-data').DataTable({
            ajax: {
                type: 'POST',
                url: "<?php echo base_url(); ?>backoffice/data_kecamatan/datatables",
                complete: function(data, type) {
                    json = data.responseJSON;
                },
            },
            order: [
                [0, "DESC"]
            ],
            pageLength: 10,
            processing: true,
            serverSide: true,
            pagingType: 'full_numbers',
            columnDefs: [{
                    className: 'text-center',
                    targets: [0, 1, -1],
                },
                {
                    targets: [0, -1],
                    orderable: false,
                }
            ],
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

        $.validator.addMethod("cek_kode_kecamatan", function(value, element) {
            $.ajax({
                method: "post",
                url: '<?php echo base_url(); ?>backoffice/data_kecamatan/cek_kode_kecamatan',
                data: {
                    value: value
                },
                success: function(response) {
                    if (response == 1) {
                        result = true;
                    } else {
                        result = false;
                    }
                },
                async: false
            });
            return result;
        });

        $.validator.addMethod("cek_nama_kecamatan", function(value, element) {
            $.ajax({
                method: "post",
                url: '<?php echo base_url(); ?>backoffice/data_kecamatan/cek_nama_kecamatan',
                data: {
                    value: value
                },
                success: function(response) {
                    if (response == 1) {
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

        var validate_form = $("#form-tambah-data").validate({
            rules: {
                kode: {
                    required: true,
                    cek_kode_kecamatan: {
                        depends: function(element) {
                            if ($param_input.val() == "edit") {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                },
                kecamatan: {
                    required: true,
                    cek_nama_kecamatan: {
                        depends: function(element) {
                            if ($param_input.val() == "edit") {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                },
            },
            messages: {
                kode: {
                    required: "Kode kecamatan harus diisi.",
                    cek_kode_kecamatan: "Kode kecamatan sudah digunakan"
                },
                kecamatan: {
                    required: "Nama kecamatan harus diisi.",
                    cek_nama_kecamatan: "Nama kecamatan sudah digunakan"
                },
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
                error.insertAfter(element);
            }
        });


        // --------------------------- add & edit data --------------------------- 
        $('#add-data').on('click', function() {
            save_method = 'add';

            $('#modal-data').modal('show');
            $('.modal-title').text('Tambah data');
            $('#param').val('add');

            $("#form-tambah-data")[0].reset();
        });

        $('#table-data').on('click', '#edit-data', function() {
            save_method = 'edit';

            $('#modal-data').modal('show');
            $('.modal-title').text('Edit data');
            $('#param').val('edit');

            var id = $(this).attr('data');

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>backoffice/data_kecamatan/get_data",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal-data').modal('show');

                    $('#id').val(data.id);
                    $('#kode').val(data.kode);
                    $('#kecamatan').val(data.kecamatan);
                }
            });
            return false;
        });

        $('#form-tambah-data').submit(function(e) {
            e.preventDefault();

            if (validate_form.valid()) {
                $('#submit-form').buttonLoader('start');

                if (save_method == 'add') {
                    url = "<?php echo base_url(); ?>backoffice/data_kecamatan/add_data";
                } else {
                    url = "<?php echo base_url(); ?>backoffice/data_kecamatan/edit_data";
                }

                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#submit-form').buttonLoader('stop');
                        $('#modal-data').modal('hide');

                        if (response == 1) {
                            Toast.fire({
                                type: 'success',
                                title: 'Data berhasil ditambahkan.'
                            });
                            $("#form-tambah-data")[0].reset();
                            table.ajax.reload();
                        } else if (response == 2) {
                            Toast.fire({
                                type: 'error',
                                title: 'Gagal menambah data.'
                            });
                        } else if (response == 3) {
                            Toast.fire({
                                type: 'success',
                                title: 'Data berhasil Disimpan.'
                            });
                            $("#form-tambah-data")[0].reset();
                            table.ajax.reload();
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: 'Gagal menyimpan data.'
                            });
                        }
                    }
                })
            }
        });
        // --------------------------- end add & edit data ---------------------------


        // --------------------------- detail data ---------------------------
        $('#table-data').on('click', '.detail-data', function() {
            var id = $(this).attr('data');
            $('#detail-data-modal').modal('show');
            $('.modal-title').text('Detail');

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>backoffice/data_kecamatan/get_data",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#d_kode').text(data.kode);
                    $('#d_kecamatan').text(data.kecamatan);
                }
            });
            return false;
        });
        // --------------------------- end detail data ---------------------------


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
            var id = $('#id3').val();
            var method = $('#method').val();

            $('#button-delete').buttonLoader('start');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>backoffice/data_kecamatan/delete_data",
                dataType: "JSON",
                data: {
                    id: id,
                    method: method
                },
                success: function(response) {
                    $('#button-delete').buttonLoader('stop');

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

                    $('#modal-delete').modal('hide');
                    table.ajax.reload();
                }
            });
            return false;
        });
        // --------------------------- end delete data ---------------------------
    });
</script>