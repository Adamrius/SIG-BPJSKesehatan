<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Setting All Access</h6>

                <form method="post" id="form-edit-data" enctype="multipart/form-data" role="form" class="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Host</label>
                                <input type="text" name="host" id="host" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>SMTP Auth</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="authtrue" name="smtpauth" value="true" checked>
                                    <label for="authtrue" class="custom-control-label">True</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="authfalse" name="smtpauth" value="false">
                                    <label for="authfalse" class="custom-control-label">False</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>SMTP Secure</label>
                                <input type="text" name="smtpsecure" id="smtpsecure" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Port</label>
                                <input type="text" name="port" id="port" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Set From</label>
                                <input type="text" name="setfrom" id="setfrom" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-sm btn-primary px-4"><i data-feather="save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.getScript("<?php echo base_url();?>assets/ultrapanel/js/custome.js");

        load_data();
            
        $("#form-edit-data").validate({
            rules: {
                host: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                smtpsecure: {
                    required: true
                },
                port: {
                    required: true
                },
                setfrom: {
                    required: true
                },
            },
            messages: {
                host: {
                    required: "Host tidak boleh kosong."
                },
                email: {
                    required: "Email tidak boleh kosong.",
                    email: "Silahkan masukan email dengan benar."
                },
                password: {
                    required: "Password tidak boleh kosong."
                },
                smtpsecure: {
                    required: "SMTP Secure tidak boleh kosong."
                },
                port: {
                    required: "Port tidak boleh kosong."
                },
                setfrom: {
                    required: "Set From tidak boleh kosong."
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


        function load_data() {
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url('ultrapanel/administrator/konfigurasi_email/get_data'); ?>',
                async : true,
                dataType : 'json',
                success  : function(data) {
                    $('#id').val(data.id);
                    $('#host').val(data.host);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $('#smtpsecure').val(data.smtpsecure);
                    $('#port').val(data.port);
                    $('#setfrom').val(data.setfrom);

                    if (data.smtpauth == 'true') {
                        $('#authtrue').prop("checked", true);
                    } else {
                        $('#authfalse').prop("checked", true);
                    }
                }
            });
        }

        // --------------------------- edit data ---------------------------
            $('#form-edit-data').submit(function(e) {
                e.preventDefault();
                if (jQuery("#form-edit-data").valid()) {
                    $.ajax({
                        url    : '<?php echo base_url('ultrapanel/administrator/konfigurasi_email/edit_data'); ?>',
                        method : 'post',
                        data   : new FormData(this),
                        contentType : false,
                        processData : false,
                        success:function(response) {
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