<div class="d-md-flex justify-content-between flex-wrap grid-margin mb-xl-2 mb-lg-2">
    <div>
        <a href="<?php echo base_url(); ?>backoffice/faskes/faskes/add" class="btn btn-primary btn-icon-text ">
            <i class="btn-icon-prepend" data-feather="plus-circle"></i>Tambah
        </a>
        <a href="javascript:void(0)" id="reload-table" class="btn btn-light btn-icon-text">
            <i class="btn-icon-prepend" data-feather="refresh-ccw"></i>Reload
        </a>
        <a href="javacript:void(0);" id="delete-data-multiple" class="btn btn-danger btn-icon-text invisible">
            <i class="btn-icon-prepend" data-feather="trash"></i>Delete
        </a>
    </div>
    <div>
        <form id="form-filter" class="d-flex align-items-center flex-wrap text-nowrap">
            <a type="submit" href="<?php echo base_url(); ?>backoffice/faskes/faskes/export_excel" name="export" id="export_excel" class="btn btn-primary btn-icon-text mr-md-0 mr-2">
                <i class="btn-icon-prepend" data-feather="file-text"></i> Export
            </a>
        </form>
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
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No Telp</th>

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

<div class="modal fade modal-style" id="detail-data-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title"></h4>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kecamatan :</label>
                            <p class="text-muted" id="d_kecamatan"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kategori :</label>
                            <p class="text-muted" id="d_faskes"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kode Faskes :</label>
                            <p class="text-muted" id="d_kode_faskes"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Nama :</label>
                            <p class="text-muted" id="d_nama"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Alamat :</label>
                            <p class="text-muted" id="d_alamat"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">No Telp :</label>
                            <p class="text-muted" id="d_no_telp"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">longitude :</label>
                            <p class="text-muted" id="d_longitude"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">latitude :</label>
                            <p class="text-muted" id="d_latitude"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Keterangan :</label>
                            <p class="text-muted" id="d_keterangan"></p>
                        </div>
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Tanggal :</label>
                            <p class="text-muted" id="d_tanggal"></p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Foto :</label>
                            <p class="text-muted">
                                <img id="d_foto" class="img-fluid" style="max-width: 200px; max-height: 150px;">
                            </p>
                        </div>

                        <div class="maps-area">
                            <div id="maps-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include APPPATH . 'views/backoffice/include_source.php'; ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8kVr5dj4fb_s-s80rqu8mbehkHKRXgFY&libraries=places"></script>

<script>
    $.getScript("<?php echo base_url(); ?>assets/backoffice/js/custome.js");

    $(document).ready(function() {
        var table = $('#table-data').DataTable({
            ajax: {
                type: 'POST',
                url: "<?php echo base_url(); ?>backoffice/faskes/faskes/datatables",
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
            deferRender: true,
            scrollX: false,
            scrollCollapse: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [{
                    className: 'text-center',
                    targets: [0, 1, -2, -1],
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

        $('#form-filter').submit(function(e) {
            e.preventDefault();

            // filter = $(this).serialize();
            // url_reload = '<?php echo base_url(); ?>backoffice/data_user/data_user/datatables/?' + filter;
            // table.ajax.url(url_reload).load();

            // export excel
            url_export = '<?php echo base_url(); ?>backoffice/faskes/faskes/export_excel/?' + filter;
            $('#export_excel').attr('href', url_export);
        });

        // --------------------------- detail data ---------------------------
        $('#table-data').on('click', '.detail-data', function() {
            var id = $(this).attr('data');
            $('#detail-data-modal').modal('show');
            $('.modal-title').text('Detail');

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>backoffice/faskes/faskes/get_detail_data",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#d_kecamatan').html(response.kecamatan);
                    $('#d_faskes').html(response.faskes);
                    $('#d_kode_faskes').html(response.kode_faskes);
                    $('#d_nama').html(response.nama);
                    $('#d_alamat').html(response.alamat);
                    $('#d_no_telp').html(response.no_telp);
                    $('#d_keterangan').html(response.keterangan);
                    $('#d_tanggal').html(response.tanggal);
                    $('#d_longitude').html(response.longitude);
                    $('#d_latitude').html(response.latitude);
                    $('#d_foto').attr('src', response.foto);

                    var data_maps = [response.latitude, response.longitude, response.color]

                    initMap(data_maps);
                }
            });
            return false;
        });

        function initMap(data_maps) {
            console.log(data_maps)

            var positions = new google.maps.LatLng(data_maps[0], data_maps[1]);

            var options = {
                zoom: 10,
                center: positions,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                streetViewControl: false
            };

            var map = new google.maps.Map(document.getElementById('maps-canvas'), options);

            var marker = new google.maps.Marker({
                position: positions,
                animation: google.maps.Animation.DROP,
                draggable: false,
                icon: {
                    path: "M448 492v20H0v-20c0-6.627 5.373-12 12-12h20V120c0-13.255 10.745-24 24-24h88V24c0-13.255 10.745-24 24-24h112c13.255 0 24 10.745 24 24v72h88c13.255 0 24 10.745 24 24v360h20c6.627 0 12 5.373 12 12zM308 192h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-168 64h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm104 128h-40c-6.627 0-12 5.373-12 12v84h64v-84c0-6.627-5.373-12-12-12zm64-96h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-116 12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40zM182 96h26v26a6 6 0 0 0 6 6h20a6 6 0 0 0 6-6V96h26a6 6 0 0 0 6-6V70a6 6 0 0 0-6-6h-26V38a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v26h-26a6 6 0 0 0-6 6v20a6 6 0 0 0 6 6z",
                    // path: "M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z",
                    fillColor: data_maps[2],
                    fillOpacity: 1,
                    strokeColor: "#ffffff",
                    strokeWeight: 0,
                    rotation: 0,
                    scale: 0.055,
                },
            });

            marker.setMap(map);
        }
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
                url: "<?php echo base_url(); ?>backoffice/faskes/faskes/delete_data",
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