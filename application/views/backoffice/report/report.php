<div class="row mb-4">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Pendapatan Tahun Ini</h6>
                        </div>
                        <h3 class="mb-0" id="load_total_pendapatan_1"></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Pendapatan Bulan Ini</h6>
                        </div>
                        <h3 class="mb-0" id="load_total_pendapatan_2"></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Total Pendapatan Hari Ini</h6>
                        </div>
                        <h3 class="mb-0" id="load_total_pendapatan_3"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <form id="filter-report" class="d-flex align-items-center justify-content-end flex-wrap text-nowrap mb-4">
    <div class="form-group mb-0 mr-2">
        <div class="input-group d-xl-flex rounded-sm" style="width: 280px;">
            <input name="fil_tanggal" value="" class="form-control" readonly='true'>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-sm btn-primary"><i class="btn-icon-prepend fa fa-filter"></i></button>
    </div>
</form> -->

<!-- <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Lorem ipsum</h6>

                <div id="chart_report"></div>
            </div>
        </div>
    </div>
</div> -->


<script type="text/javascript">
    $(document).ready(function() {
        // -------------------------- data info --------------------------
        load_data_pendapatan();

        function load_data_pendapatan() {

            $.ajax({
                method: "post",
                url: "<?php echo base_url(); ?>backoffice/report/report/fetch_data_pendapatan",
                dataType: "JSON",
                success: function(response) {
                    $('#load_total_pendapatan_1').html(response.pendapatan_by_years);
                    $('#load_total_pendapatan_2').html(response.pendapatan_by_month);
                    $('#load_total_pendapatan_3').html(response.pendapatan_by_today);
                },
            });
        }
        // -------------------------- end data info --------------------------

        // $('input[name="fil_tanggal"]').daterangepicker({
        //     "startDate": moment().startOf('day'),
        //     "endDate":moment().endOf('day'),
        //     "locale": {
        //         format: 'DD/MM/YYYY'
        //     },
        // });

        // load_data_report();

        // var init_chart_report = {
        //     chart: {
        //         height: 300,
        //         type: "bar",
        //         parentHeightOffset: 0
        //     },
        //     series: [],
        //     xaxis: {},
        //     colors: ["#7ee5e5","#4d8af0","#82BB41", "#f77eb9"],
        //     plotOptions: {
        //         bar: {
        //         horizontal: false,
        //         columnWidth: '55%'
        //         },
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     stroke: {
        //         show: true,
        //         width: 2,
        //         colors: ['transparent']
        //     },
        //     yaxis: {
        //         title: {
        //         text: 'Total'
        //         }
        //     },
        //     noData: {
        //         text: 'Data tidak tersedia...'
        //     },
        //     responsive: [{
        //         breakpoint: 500,
        //         options: {
        //             legend: {
        //                 fontSize: "11px"
        //             }
        //         }
        //     }]
        // };

        // var chart_data_report = new ApexCharts(
        //     document.querySelector('#chart_report'), 
        //     init_chart_report
        // );

        // chart_data_report.render();

        // $('#filter-report').submit(function (e) {
        //     e.preventDefault();
        //     filter_report = $(this).serialize();
        //     load_data_report();
        // });

        // function load_data_report()
        // {
        //     filter_report = $('#filter-page-view').serialize();

        //     $.ajax({
        //         method  : "get",
        //         url     : "<?php echo base_url(); ?>backoffice/report/report/data_report?" + filter_report,
        //         dataType: "JSON",
        //         success: function(response) {
        //             console.log(response.init_chart_report);
        //             if (response.success == 1) {
        //                 chart_data_report.updateSeries(JSON.parse(response.init_chart_report));
        //                 chart_data_report.updateOptions( {
        //                     xaxis: {
        //                         type: "text",
        //                         categories: response.data_kategori
        //                     }
        //                 });
        //             }
        //         },
        //         error: function (err) {
        //         }
        //     });
        // }
    });
</script>