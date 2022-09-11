<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow" id="load_data_faskes">
            <div class="col-lg-3 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class=" card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Kecamatan</h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h3 class="mb-0" id="load_data_kecamatan"></h3>
                            </div>
                            <div class="col-6">
                                <div class="color-area bg-info"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // -------------------------- data info --------------------------
        load_data_info();

        function load_data_info() {

            $.ajax({
                method: "post",
                url: "<?php echo base_url(); ?>backoffice/dashboard/data_info",
                dataType: "JSON",
                success: function(response) {

                    $('#load_data_kecamatan').html(response.data_kecamatan);

                    var data_faskes = '';

                    $.each(response.data_faskes, function(i, val) {

                        data_faskes +=
                            '<div class="col-lg-3 col-md-4 col-sm-6 grid-margin stretch-card">' +
                            '<div class="card">' +
                            '<div class="card-body">' +
                            '<div class="d-flex justify-content-between align-items-baseline mb-2">' +
                            '<h6 class="card-title mb-0">' + val.faskes + '</h6>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-6">' +
                            '<h3 class="mb-0">' + val.total + '</h3>' +
                            '</div>' +
                            '<div class="col-6">' +
                            '<div class="color-area" style="background: ' + val.color + ';"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });

                    $('#load_data_faskes').append(data_faskes);
                },
            });
        }
        // -------------------------- end data info --------------------------
    });
</script>