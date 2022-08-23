<section class="section-maps">
    <div class="container-fluid gx-0">
        <div class="top-section">
            <div class="container">
                <h2>PEMETAAN FASILITAS KESEHATAN BPJS WILAYAH BANYUMAS</h2>
            </div>
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
                    console.log(response)
                    var data_faskes = '';
                    $.each(response.data, function(i, val) {
                        data_faskes +=
                            '<a class="list-item trigg-filter" data="' + val.id + '">' +
                            '<div class="marker"><i class="fa fa-map-marker-alt" style="color: ' + val.color + ';"></i></div>' +
                            '<div class="text section-description">' + val.name + ' (' + val.total + ')</div>' +
                            '</a>';
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
                center: new google.maps.LatLng(-7.4459451, 109.0489305),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                streetViewControl: true
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
                        path: "M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z",
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
    });
</script>