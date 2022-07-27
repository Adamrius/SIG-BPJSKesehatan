<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow" id="load_data_kriminalitas">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Kecamatan</h6>
                        </div>
                        <h3 class="mb-0" id="load_data_kecamatan"></h3>
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

            function load_data_info(){

                $.ajax({
                    method  : "post",
                    url     : "<?php echo base_url();?>backoffice/dashboard/data_info",
                    dataType: "JSON",
                    success: function(response) {
                        
                        $('#load_data_kecamatan').html(response.data_kecamatan);

                        var data_kriminalitas = '';

	                    $.each(response.data_kriminalitas, function(i, val) {

	                        data_kriminalitas += 
	                        	'<div class="col-md-3 grid-margin stretch-card">'+
                                    '<div class="card">'+
                                        '<div class="card-body">'+
                                            '<div class="d-flex justify-content-between align-items-baseline mb-2">'+
                                                '<h6 class="card-title mb-0">'+val.kriminalitas+'</h6>'+
                                            '</div>'+
                                            '<h3 class="mb-0">'+val.total+'</h3>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                        });

                        $('#load_data_kriminalitas').append(data_kriminalitas);
                    },
                });
            }
        // -------------------------- end data info --------------------------
    });
</script>