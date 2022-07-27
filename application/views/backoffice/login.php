<?php $web = $this->main_model->get_web(); ?>

<div class="page-wrapper full-page auth-login">
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-xl-6 col-lg-8 col-md-10 mx-auto">
                <div class="card auth-card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0 d-none d-md-block">
                            <div class="auth-thumbnails">
                                <img class="auth-left-wrapper mx-auto img-fluid" src="<?php echo base_url();?>assets/backoffice/images/login-thumbnails.png">
                            </div>
                        </div>

                        <div class="col-md-8 pl-md-0 d-md-flex align-items-center h-100">
                            <div class="auth-form py-5">
                                <h2 class="text-accent fw-bold noble-ui-logo mb-2">Administrator</h2>
                                <h5 class="text-muted font-weight-normal mb-4">Masukan email dan password Anda.</h5>

                                <div class="feedback-login"></div>

                                <form method="post" id="form-login">
                                    <div class="form-group">
                                        <label class="text-muted mb-1">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted mb-1">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="********">
                                    </div>

                                    <div class="form-actions text-center mt-4">
                                        <button type="submit" name="submit-form" class="btn btn-accent btn-block text-white">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    $.getScript("<?php echo base_url();?>assets/backoffice/js/custome.js");

    $(document).ready(function() {

        $.validator.addMethod("cek_email", function(value, element) {
            $.ajax({
                method : "post",
                url    : '<?php echo base_url();?>backoffice/login/cek_email',
                data   : { value:value },
                success: function(response) {
                    if(response == 1) {
                        result = true;
                    } else {
                        result = false;
                    }
                },
                async: false
            });
            return result;
        });

        var validate_login = $("#form-login").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    cek_email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email harus diisi.",
                    email: "Masukkan email dengan benar.",
                    cek_email: "Email Anda tidak ditemukan."
                },
                password: {
                    required: "Password harus diisi."
                }
            },
            errorElement: "em",
            errorClass: "has-error",
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

        $('#form-login').submit(function(e) {
            e.preventDefault();

            if (validate_login.valid()) {
                $('#submit-form').buttonLoader('start');

                $.ajax({
                    url      : '<?php echo base_url();?>backoffice/login/post_login',
                    method   : 'post',
                    data     : new FormData(this),
                    dataType : 'json',
                    contentType : false,
                    processData : false,
                    success:function(response) {
                        $('#submit-form').buttonLoader('stop');

                        if(response.status == 1) {
                            $("#form-login")[0].reset();
                            top.location.href="<?php echo base_url();?>backoffice/dashboard";
                        }
                        else {
                            $('.feedback-login').html(
                                '<div class="alert alert-pro alert-danger alert-fade mb-2">'+
                                    '<button type="button" class="close icon" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<span>'+response.message+'</span>'+
                                '</div>'
                            );
                        }
                    }
                })
            }
        });
    });
</script>