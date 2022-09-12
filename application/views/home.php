<section class="section-maps">
    <div class="container-fluid gx-0">
        <a href="javascript:void(0)" class="toggle-side"><i class="icons fa fa-bars"></i> <span>Menu Grafik</span></a>

        <div class="side-area">
            <div class="side-inner">
                <a href="javascript:void(0)" class="close-side" title="Close"><i class="icons fa fa-times"></i></a>
                <div class="title" id="title_faskes_chart"></div>
                <div id="load_data_faskes_chart"></div>
            </div>
        </div>

        <div class="top-section text-dark">
            <!-- <div class="container"> -->
            <marquee direction="left-" scrollamount="20" bgcolor='#00a2ff '>
                <h1>
                    SELAMAT DATANG <img src="assets/backoffice/images/photo-removebg.png" height="48"> PEMETAAN FASILITAS BPJS KESEHATAN TINGKAT PERTAMA KABUPATEN BANYUMAS <img src="assets/backoffice/images/photo-removebg.png" height="48"> TERIMA KASIH
                </h1>
            </marquee>
            <!-- </div> -->
        </div>

        <div class="content-area">
            <div class="maps-area">
                <div class="maps" id="maps"></div>
            </div>
        </div>

        <div class="bottom-section">
            <div class="container">
                <div class="scrollable h-scrollable">
                    <div class="list-faskes" id="load_data_faskes"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8kVr5dj4fb_s-s80rqu8mbehkHKRXgFY"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8kVr5dj4fb_s-s80rqu8mbehkHKRXgFY&libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/backoffice/vendors/apexcharts/apexcharts.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        load_data_faskes('')

        function load_data_faskes(id_faskes) {
            $.ajax({
                method: 'POST',
                url: '<?php echo base_url(); ?>post/fetch_data_faskes',
                data: {
                    id_faskes: id_faskes
                },
                cache: false,
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    var data_faskes = '';
                    $.each(response.data, function(i, val) {

                        var trigger_filter = 'href="javascript:void(0)" class="trigg-filter" data="' + val.id + '"'
                        data_faskes +=
                            '<div class="list-item">' +
                            '<div class="marker"><a ' + trigger_filter + '><i class="fa fa-hospital" style="color: ' + val.color + ';"></i></a></div>' +
                            '<div class="text">' +
                            '<span><a ' + trigger_filter + '>' + val.name + ' (' + val.total + ')</a></span>' +
                            '<span class="text-muted"><a href="javascript:void(0)" class="trigg-download text-white" data="' + val.id + '"><i class="fa fa-download mr-2"></i> Download</a></span>' +
                            '</div>' +
                            '</div>';

                    });
                    $('#load_data_faskes').html(data_faskes);
                    var data_maps_array = [];
                    $.each(response.laporan, function(i2, val2) {
                        var thumbnails = '';
                        if (val2.foto) {
                            thumbnails =
                                '<div class="wrap-thumb">' +
                                '<img src="' + val2.foto + '" class="img-fluid">' +
                                '</div>';
                        }
                        var content_window =
                            '<div class="widget-info-area">' +
                            thumbnails +
                            '<div class="wrap-info">' +
                            '<h5>' + val2.faskes + '</h5>' +
                            '<ul>' +
                            '<li><i class="icon fa fa-hospital-alt"></i><span>' + val2.nama + '</span></li>' +
                            '<li><i class="icon fa fa-phone-alt"></i><span>' + val2.no_telp + '</span></li>' +
                            '<li><i class="icon fa fa-map-marker-alt"></i><span>' + val2.alamat + '</span></li>' +
                            '<li><span class="fw-500">' + val2.kecamatan + '</span></li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>';
                        var data_maps = [content_window, val2.latitude, val2.longitude, val2.color];
                        data_maps_array.push(data_maps);
                    });
                    initMap(data_maps_array);
                }
            });
        }

        function initMap(data_maps_array) {
            var options = {
                zoom: 11,
                center: new google.maps.LatLng(-7.450221641069655, 109.27323322638935),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                streetViewControl: false,
                disableDefaultUI: true,
                disableFeature: true,
                styles: [{
                        elementType: "geometry",
                        stylers: [{
                            color: "#f5f5f5"
                        }],
                    },
                    {
                        elementType: "labels.icon",
                        stylers: [{

                        }],
                    },
                    {
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#616161"
                        }],
                    },
                    {
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#f5f5f5"
                        }],
                    },
                    {
                        featureType: "administrative.land_parcel",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#bdbdbd"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [{
                            color: "#eeeeee"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#757575"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e5e5e5"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{
                            color: "#ffffff"
                        }],
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#757575"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dadada"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#616161"
                        }],
                    },
                    {
                        featureType: "road.local",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e5e5e5"
                        }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "geometry",
                        stylers: [{
                            color: "#eeeeee"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{
                            color: "#c9c9c9"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                ],

                silver: [{
                        elementType: "geometry",
                        stylers: [{
                            color: "#f5f5f5"
                        }],
                    },
                    {
                        elementType: "labels.icon",
                        stylers: [{
                            visibility: "off"
                        }],
                    },
                    {
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#616161"
                        }],
                    },
                    {
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#f5f5f5"
                        }],
                    },
                    {
                        featureType: "administrative.land_parcel",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#bdbdbd"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [{
                            color: "#eeeeee"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#757575"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e5e5e5"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{
                            color: "#ffffff"
                        }],
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#757575"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dadada"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#616161"
                        }],
                    },
                    {
                        featureType: "road.local",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e5e5e5"
                        }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "geometry",
                        stylers: [{
                            color: "#eeeeee"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{
                            color: "#c9c9c9"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9e9e9e"
                        }],
                    },
                ],

                night: [{
                        elementType: "geometry",
                        stylers: [{
                            color: "#242f3e"
                        }]
                    },
                    {
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#242f3e"
                        }]
                    },
                    {
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#746855"
                        }]
                    },
                    {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#d59563"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#d59563"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{
                            color: "#263c3f"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#6b9a76"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{
                            color: "#38414e"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#212a37"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#9ca5b3"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{
                            color: "#746855"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#1f2835"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#f3d19c"
                        }],
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{
                            color: "#2f3948"
                        }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#d59563"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{
                            color: "#17263c"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#515c6d"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#17263c"
                        }],
                    },
                ],

                retro: [{
                        elementType: "geometry",
                        stylers: [{
                            color: "#ebe3cd"
                        }]
                    },
                    {
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#523735"
                        }]
                    },
                    {
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#f5f1e6"
                        }]
                    },
                    {
                        featureType: "administrative",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#c9b2a6"
                        }],
                    },
                    {
                        featureType: "administrative.land_parcel",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#dcd2be"
                        }],
                    },
                    {
                        featureType: "administrative.land_parcel",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#ae9e90"
                        }],
                    },
                    {
                        featureType: "landscape.natural",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dfd2ae"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dfd2ae"
                        }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#93817c"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#a5b076"
                        }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#447530"
                        }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{
                            color: "#f5f1e6"
                        }],
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [{
                            color: "#fdfcf8"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{
                            color: "#f8c967"
                        }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#e9bc62"
                        }],
                    },
                    {
                        featureType: "road.highway.controlled_access",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e98d58"
                        }],
                    },
                    {
                        featureType: "road.highway.controlled_access",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#db8555"
                        }],
                    },
                    {
                        featureType: "road.local",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#806b63"
                        }],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dfd2ae"
                        }],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#8f7d77"
                        }],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "labels.text.stroke",
                        stylers: [{
                            color: "#ebe3cd"
                        }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dfd2ae"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#b9d3c2"
                        }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{
                            color: "#92998d"
                        }],
                    },
                ],

            };
            var map = new google.maps.Map(document.getElementById('maps'), options);
            var data_maps = data_maps_array;
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < data_maps.length; i++) {
                marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(data_maps[i][1], data_maps[i][2]),
                    animation: google.maps.Animation.DROP,
                    draggable: false,
                    icon: {
                        path: "M448 492v20H0v-20c0-6.627 5.373-12 12-12h20V120c0-13.255 10.745-24 24-24h88V24c0-13.255 10.745-24 24-24h112c13.255 0 24 10.745 24 24v72h88c13.255 0 24 10.745 24 24v360h20c6.627 0 12 5.373 12 12zM308 192h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-168 64h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm104 128h-40c-6.627 0-12 5.373-12 12v84h64v-84c0-6.627-5.373-12-12-12zm64-96h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-116 12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40zM182 96h26v26a6 6 0 0 0 6 6h20a6 6 0 0 0 6-6V96h26a6 6 0 0 0 6-6V70a6 6 0 0 0-6-6h-26V38a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v26h-26a6 6 0 0 0-6 6v20a6 6 0 0 0 6 6z",
                        // path: "M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z",
                        fillColor: data_maps[i][3],
                        fillOpacity: 1,
                        strokeColor: "#ffffff",
                        strokeWeight: 0,
                        rotation: 0,
                        scale: 0.055,
                        anchor: new google.maps.Point(1, 2),
                    },
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(data_maps[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
        $(document).on('click', '.trigg-filter', function() {
            var id_faskes = $(this).attr('data');
            load_data_faskes(id_faskes);
        });

        $(document).on('click', '.trigg-download', function() {

            var id_kriminalitas = $(this).attr('data');

            url_export = '<?php echo base_url(); ?>post/export_data_kriminalitas?id=' + id_kriminalitas;
            $(this).attr('href', url_export);
        });

        // -------------------------- Fasilitas Kesehatan Grafik --------------------------
        load_data_faskes_chart();

        var option_bar = {
            chart: {
                height: 500,
                type: "bar",
                parentHeightOffset: 0
            },
            series: [],
            xaxis: {},
            yaxis: {},
            colors: ["#00E396", "#00E396", "#00E396", "#00E396"],
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: '15%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            grid: {
                borderColor: "#277BC0",
                padding: {
                    bottom: 0
                }
            },
            stroke: {
                show: true,
                width: 2,
                colors: "#00E396"
            },
            noData: {
                text: 'Data tidak tersedia...'
            },
            responsive: [{
                breakpoint: 500,
                options: {
                    legend: {
                        fontSize: "11px"
                    }
                }
            }]
        };

        var data_faskes_chart = new ApexCharts(document.querySelector('#load_data_faskes_chart'), option_bar);
        data_faskes_chart.render();

        function load_data_faskes_chart() {
            $.ajax({
                method: 'get',
                url: '<?php echo base_url(); ?>post/fetch_data_faskes_chart',
                dataType: 'json',
                success: function(response) {

                    if (response.status == 1) {

                        data_faskes_chart.updateSeries(JSON.parse(response.faskes));
                        data_faskes_chart.updateOptions({
                            xaxis: {
                                type: 'text',
                                categories: response.kecamatan
                            },
                        });

                        $('#title_faskes_chart').html(response.title);
                    }
                }
            });
        }
        // -------------------------- Fasilitas Kesehatan Grafik --------------------------


        $('.toggle-side').on('click', function(e) {
            $('.side-area').addClass('active');
            e.preventDefault();
        });
        $('.close-side').on('click', function(e) {
            $('.side-area').removeClass('active');
            e.preventDefault();
        });
        $('.toggle-side').on('click', function(e) {
            $('.side-area').addClass('active');
            e.preventDefault();
        });


    });
</script>