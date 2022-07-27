<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Setting Website</h6>

                <form method="post" id="form-edit-data" enctype="multipart/form-data" role="form" class="">
                    <div class="row">
                        <div class="col-md-6 pr-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail">
                                                <img id="favicon_preview" alt="" style="width: auto; max-height: 60px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: auto; max-height: 60px;"></div>
                                            <div class="favicon_feed">
                                                <span class="btn btn-xs btn-info btn-file">
                                                    <span class="fileupload-new"><i class="fa fa-picture-o"></i> Pilih Gambar</span>
                                                    <span class="fileupload-exists"><i class="fa fa-picture-o"></i> Ganti</span>
                                                    <input type="file" name="favicon" id="favicon">
                                                </span>
                                                <a href="#" class="btn btn-xs btn-danger fileupload-exists" data-dismiss="fileupload">
                                                    <i class="fa fa-trash-o"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Whatsapp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" name="facebook" id="facebook" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 pl-md-5">
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" name="twitter" id="twitter" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" name="instagram" id="instagram" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Youtube</label>
                                <input type="text" name="youtube" id="youtube" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="2" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" id="submit" class="btn btn-sm btn-primary px-4"><i data-feather="save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $.getScript("<?php echo base_url();?>assets/backoffice/js/custome.js");

    $(document).ready(function() {
        load_data();

        $("#form-edit-data").validate({
            rules: {
                favicon: {
                    extension: "jpg|jpeg|png",
                    // filesize: 500000
                },
                name: {
                    required: true
                },
                email: {
                    required: true
                },
                meta_description: {
                    required: true
                },
                meta_keywords: {
                    required: true
                },
            },
            messages: {
                favicon: {
                    extension: "Unggah favicon dengan format .PNG/.JPG/.JPEG",
                    // filesize: "File maksimal 500 Kilobyte."
                },
                name: {
                    required: "Nama situs tidak boleh kosong."
                },
                email: {
                    required: "Email tidak boleh kosong."
                },
                meta_description: {
                    required: "Meta Description tidak boleh kosong."
                },
                meta_keywords: {
                    required: "Meta Keywords tidak boleh kosong."
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
                if(element.is('#favicon')) {
                    error.insertAfter('.favicon_feed');
                } else {
                    error.insertAfter(element);
                }
            }
        });


        function load_data() {
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url();?>backoffice/administrator/web/get_data',
                async : true,
                dataType : 'json',
                success  : function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#whatsapp').val(data.whatsapp);
                    $('#facebook').val(data.facebook);
                    $('#twitter').val(data.twitter);
                    $('#instagram').val(data.instagram);
                    $('#youtube').val(data.youtube);
                    $('textarea#meta_description').val(data.meta_description);
                    $('textarea#meta_keywords').val(data.meta_keywords);

                    if (data.favicon == '') {
                        $('#favicon_preview').attr('src', '<?php echo base_url();?>assets/files/no-images.png');
                    } else {
                        $('#favicon_preview').attr('src', '<?php echo base_url();?>assets/files/logo/'+data.favicon+'');
                    }
                }
            });
        }

        // --------------------------- edit data ---------------------------
            $('#form-edit-data').submit(function(e) {
                e.preventDefault();
                if (jQuery("#form-edit-data").valid()) {

                    $('#submit').buttonLoader('start');

                    $.ajax({
                        url    : '<?php echo base_url();?>backoffice/administrator/web/edit_data',
                        method : 'post',
                        data   : new FormData(this),
                        contentType : false,
                        processData : false,
                        success:function(response) {
                            $('#submit').buttonLoader('stop');

                            if(response == 1) {
                                Toast.fire({ type: 'success', title: 'Berhasil menyimpan perubahan.' });
                                load_data();
                            } 
                            else {
                                Toast.fire({ type: 'error', title: 'Gagal menyimpan perubahan.' });
                            }
                        }
                    })
                }
            });
        // --------------------------- end edit data ---------------------------
    });
</script>