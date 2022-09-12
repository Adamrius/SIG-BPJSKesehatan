<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tambah Data</h6>

                <form method="post" id="form-add-data" enctype="multipart/form-data" role="form" class="">
                    <div class="row">
                        <div class="col-md-6 pr-md-5">
                            <div class="form-group">
                                <label class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" data-placeholder="Pilih kecamatan" data-allow-clear="false" class="select2 form-select form-control">
                                    <option value="">Pilih kecamatan</option>
                                    <?php $get_kecamatan = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kabupaten = 3302 ORDER BY nama ASC")->result_array(); ?>
                                    <?php foreach ($get_kecamatan as $key_kec) { ?>
                                        <option value="<?php echo $key_kec['id']; ?>"><?php echo $key_kec['nama']; ?></option>
                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kategori</label>
                                <select name="faskes" id="faskes" data-placeholder="Pilih kategori" data-allow-clear="false" class="select2 form-select form-control">
                                    <option value="">Pilih kategori</option>
                                    <?php $get_faskes = $this->db->query("SELECT * FROM tb_faskes ORDER BY id DESC")->result_array(); ?>
                                    <?php foreach ($get_faskes as $key_fk) { ?>
                                        <option value="<?php echo $key_fk['id']; ?>"><?php echo $key_fk['name']; ?></option>
                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kode Faskes</label>
                                <textarea name="kode_faskes" id="kode_faskes" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <textarea name="nama" id="nama" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">No Telp</label>
                                <textarea name="no_telp" id="no_telp" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Foto</label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail">
                                        <img id="foto_preview" src="<?php echo base_url(); ?>assets/files/no-images.png" alt="">
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail"></div>
                                    <div id="foto_feed">
                                        <span class="btn btn-xs btn-info btn-file">
                                            <span class="fileupload-new">Pilih Gambar</span>
                                            <span class="fileupload-exists">Ganti</span>
                                            <input type="file" name="foto" id="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-xs btn-danger fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 pl-md-5">
                            <div class="form-group">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" autocomplete="off" autocorrect="off">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" autocomplete="off" autocorrect="off">
                            </div>

                            <div class="maps-area">
                                <input type="text" name="search_location" id="search_location" class="controls" placeholder="Find your location">
                                <div id="maps-canvas"></div>
                            </div>
                        </div>
                    </div>

                    <div class="block-bottom d-flex justify-content-between mt-3">
                        <input type="hidden" name="param" id="param" value="<?php echo $param; ?>">
                        <input type="hidden" name="id" id="id_laporan" value="<?php echo decrypt_url($id_laporan); ?>">
                        <button type="button" onClick="window.history.back()" class="btn btn-md py-2 px-4 btn-light">Batal</button>
                        <button type="submit" id="submit-form" class="btn btn-md py-2 px-4 btn-primary">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $.getScript("<?php echo base_url(); ?>assets/backoffice/js/custome.js");

    $(document).ready(function() {

        var param = $('#param').val();
        var id_laporan = $('#id_laporan').val();

        // validate
        var validate_form = $("#form-add-data").validate({
            rules: {
                kecamatan: {
                    required: true,
                },
                faskes: {
                    required: true,
                },
                kode_faskes: {
                    required: true,
                    maxlength: 8
                },
                nama: {
                    required: true
                },
                alamat: {
                    required: true
                },
                no_telp: {
                    required: true,
                    number: true
                },
                image: {
                    extension: "jpg|jpeg|png",
                    filesize: 1000000
                },
                longitude: {
                    required: true
                },
                latitude: {
                    required: true
                },
            },
            messages: {
                kecamatan: {
                    required: "Pilih Kecamatan",
                },
                faskes: {
                    required: "Pilih Kategori",
                },
                kode_faskes: {
                    required: "Kode Faskes harus diisi",
                    maxlength: "Telah melebihi 8 digit kode"
                },
                nama: {
                    required: "Nama harus diisi"
                },
                alamat: {
                    required: "Alamat harus diisi"
                },
                no_telp: {
                    required: "No Telp harus diisi",
                    number: "Silahkan masukan no telp dengan benar"
                },
                image: {
                    extension: "Unggah foto dengan format .PNG/.JPG/.JPEG",
                    filesize: "File maksimal 1 Mbps."
                },
                longitude: {
                    required: "Longitude harus diisi"
                },
                latitude: {
                    required: "Latitude harus diisi"
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
                if (element.is('#foto')) {
                    error.insertAfter('#foto_feed').addClass('has-error');
                } else {
                    error.appendTo(element.parent());
                }
            }
        });


        // edit
        if (param == 'edit') {
            load_data_edit()
        }

        function load_data_edit() {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>backoffice/faskes/faskes/get_data',
                dataType: 'json',
                data: {
                    id: id_laporan
                },
                success: function(response) {

                    $("#kecamatan").select2().val(response.id_kecamatan).trigger('change.select2');
                    $("#faskes").select2().val(response.id_faskes).trigger('change.select2');
                    $("textarea#kode_faskes").val(response.kode_faskes);
                    $("textarea#nama").val(response.nama);
                    $("textarea#alamat").val(response.alamat);
                    $("textarea#no_telp").val(response.no_telp);
                    $("textarea#keterangan").val(response.keterangan);
                    $('#longitude').val(response.longitude);
                    $('#latitude').val(response.latitude);

                    if (response.foto == '') {
                        $('#foto_preview').attr('src', '<?php echo base_url(); ?>assets/files/no-images.png');
                    } else {
                        $('#foto_preview').attr('src', '<?php echo base_url(); ?>assets/files/faskes/' + response.foto + '');
                    }
                }
            });
        }


        // post
        $('#form-add-data').submit(function(e) {
            e.preventDefault();

            if (validate_form.valid()) {
                $('#submit-form').buttonLoader('start');

                if (param == 'add') {
                    url = '<?php echo base_url(); ?>backoffice/faskes/faskes/add_data';
                } else {
                    url = '<?php echo base_url(); ?>backoffice/faskes/faskes/edit_data';
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

                        if (response.status == 1) {
                            Toast.fire({
                                type: 'success',
                                title: response.message
                            });
                            $("#form-add-data")[0].reset();
                            top.location.href = "<?php echo base_url(); ?>backoffice/faskes/faskes";
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    }
                })
            }
        });

        $.fn.buttonLoader = function(action) {
            var self = $(this);

            if (action == 'start') {
                if ($(self).attr("disabled") == "disabled") {
                    e.preventDefault();
                }

                $(self).attr('disabled', true);
                $(self).attr('data-btn-text', $(self).text());
                $(self).html('<span class="spinner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &nbsp;Loading</span>');
                $(self).addClass('active');
            }

            if (action == 'stop') {
                $(self).removeAttr('disabled');
                $(self).html($(self).attr('data-btn-text'));
                $(self).removeClass('active');
            }
        }
    });
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8kVr5dj4fb_s-s80rqu8mbehkHKRXgFY&libraries=places"></script>

<script>
    var geocoder;
    var map;
    var infowindow = new google.maps.InfoWindow();
    var marker;
    var g_err = 0;

    function initialize() {

        var markers = [];
        var mapOptions = {
            zoom: 11,
            center: new google.maps.LatLng(-7.4459451, 109.0489305),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            streetViewControl: false
        };
        map = new google.maps.Map(document.getElementById('maps-canvas'), mapOptions);


        // trigg click location
        google.maps.event.addListener(map, 'click', function(e) {
            $('#latitude').val(e.latLng.lat());
            $('#longitude').val(e.latLng.lng());
        });


        // trigg search input location 
        var input = document.getElementById('search_location');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox(input);

        // get location by search input 
        google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            // get the icon, place name, and location.  
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(75, 75),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.  
                var marker = new google.maps.Marker({
                    map: map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });
                $('#latitude').val(marker.position.lat());
                $('#longitude').val(marker.position.lng());

                markers.push(marker);
                bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
        });

        google.maps.event.addListener(map, 'bounds_changed', function() {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>