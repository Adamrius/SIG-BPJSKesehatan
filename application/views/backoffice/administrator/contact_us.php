<div class="d-md-flex justify-content-between flex-wrap mb-xl-2 mb-lg-2">
    <div>
        <button type="button" id="reload-table" class="btn btn-light btn-icon-text">
            <i class="btn-icon-prepend" data-feather="refresh-ccw"></i>Reload
        </button>
        <button type="button" id="delete-data-multiple" class="btn btn-danger btn-icon-text invisible">
            <i class="btn-icon-prepend" data-feather="trash"></i>Delete
        </button>
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Date</th>
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


<div class="modal fade modal-style" id="detail-data-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title"></h4>

                <div class="row">
                    <div class="col-lg-12 email-content">
                        <div class="email-head">
                            <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">

                                <table class="list-info">
                                    <tr class="list-items">
                                        <td class="py-2"><label>Name</label></td>
                                        <td class="py-2 px-3">:</td>
                                        <td class="py-2"><p class="text-muted" id="name"></p></td>
                                    </tr>
                                    <tr class="list-items">
                                        <td class="py-2"><label>Email</label></td>
                                        <td class="py-2 px-3">:</td>
                                        <td class="py-2"><p class="text-muted" id="email"></p></td>
                                    </tr>
                                    <tr class="list-items">
                                        <td class="py-2"><label>Phone</label></td>
                                        <td class="py-2 px-3">:</td>
                                        <td class="py-2"><p class="text-muted" id="phone"></p></td>
                                    </tr>
                                    <tr class="list-items">
                                        <td class="py-2"><label>Date</label></td>
                                        <td class="py-2 px-3">:</td>
                                        <td class="py-2"><p class="text-muted" id="date"></p></td>
                                    </tr>
                                    <tr class="list-items">
                                        <td class="py-2"><label>Subject</label></td>
                                        <td class="py-2 px-3">:</td>
                                        <td class="py-2"><p class="text-muted" id="subject"></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="email-body">
                            <p id="message">Hello,</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
</div>


<?php include APPPATH.'views/ultrapanel/include_source.php'; ?>


<script>
    $.getScript("<?php echo base_url();?>assets/ultrapanel/js/custome.js");

    $(document).ready(function() {

        var table = $('#table-data').DataTable({
            ajax: {
                url : "<?php echo base_url('ultrapanel/administrator/contact_us/datatables'); ?>",
                complete: function(data, type) {
                    json = data.responseJSON;
                },
            },
            processing : true,
            ordering   : false,
            searching  : true,
            info       : true,
            pagingType : "full_numbers",
            columnDefs : [
                {
                    className: "text-center",
                    targets: [0, 1, -1],
                }
            ],
            language: {
                search: "",
                searchPlaceholder: "Search ...",
                lengthMenu: '<select class="form-control form-control-sm">'+
                                '<option value="10">10</option>'+
                                '<option value="50">50</option>'+
                                '<option value="100">100</option>'+
                                '<option value="500">500</option>'+
                                '<option value="1000">1000</option>'+
                                '<option value="-1">All</option>'+
                            '</select>',
                zeroRecords: "Data tidak ditemukan"
            }
        });

        $('#reload-table').on('click', function() {
            table.ajax.reload();
        });


        // --------------------------- filter & export data ---------------------------
            $('#form-filter').submit(function (e) {
                e.preventDefault();

                filter = $(this).serialize();

                url_reload = '<?php echo base_url();?>ultrapanel/administrator/contact_us/datatables/?' + filter;
                table.ajax.url(url_reload).load();

                url_export = '<?php echo base_url();?>ultrapanel/administrator/contact_us/export/?' + filter;
                $('#export').attr('href', url_export);

            });
        // --------------------------- filter & export data ---------------------------


        $('#table-data').on('click', '.detail-data', function() {
            var id = $(this).attr('data');
            $('#detail-data-modal').modal('show');
            $('.modal-title').text('Detail Contact Us');

            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('ultrapanel/administrator/contact_us/get_data'); ?>",
                dataType : "json",
                data : { id:id },
                success: function(data) {
                    $('#name').text(data.name);
                    $('#email').text(data.email);
                    $('#phone').text(data.phone);
                    $('#date').text(data.date);
                    $('#subject').text(data.subject);
                    $('#message').text(data.message);
                }
            });
            return false;
        });

            
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

                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url();?>ultrapanel/administrator/contact_us/delete_data",
                    dataType : "JSON",
                    data : { id:id, method:method },
                    success: function(response) {
                        if(response == 1) {
                            Toast.fire({ type: 'success', title: 'Data berhasil dihapus.' });
                        } else if(response == 2) {
                            Toast.fire({ type: 'success', title: 'Data berhasil dihapus.' });
                            $('#delete-data-multiple').addClass('invisible', true);
                        } else {
                            Toast.fire({ type: 'error', title: 'Gagal menghapus data.' });
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