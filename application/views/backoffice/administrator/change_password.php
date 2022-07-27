<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <div class="card-body">
            	<?php if ($this->session->flashdata('callout-success') == TRUE) {; ?>
                    <div class="callout callout-success" id="slide_slow">
                        <p><?php echo $this->session->flashdata('callout-success'); ?></p>
                    </div>
                <?php } if ($this->session->flashdata('callout-danger') == TRUE) {; ?>
                    <div class="callout callout-danger" id="slide_slow">
                        <p><?php echo $this->session->flashdata('callout-danger'); ?></p>
                    </div>
                <?php } if ($this->session->flashdata('callout-info') == TRUE) {; ?>
                    <div class="callout callout-info" id="slide_slow">
                        <p><?php echo $this->session->flashdata('callout-info'); ?></p>
                    </div>
                <?php } if ($this->session->flashdata('callout-warning') == TRUE) {; ?>
                    <div class="callout callout-warning" id="slide_slow">
                        <p><?php echo $this->session->flashdata('callout-warning'); ?></p>
                    </div>
                <?php }; ?>

            	<form method="post" class="form-style needs-validation" novalidate>
            		<div class="form-group">
            			<label>Password Lama</label>
            			<input type="password" name="password_old" id="password_old" placeholder="Isi dengan password lama Anda" class="form-control" required>
            			<div class="invalid-feedback">Password lama tidak boleh kosong.</div> <span id="cek_password_feedback"></span>
            		</div>

            		<div class="form-group">
            			<label>Password Baru</label>
            			<input type="password" name="password" placeholder="Isi dengan password baru Anda" class="form-control" required>
            			<div class="invalid-feedback">Password baru tidak boleh kosong</div>
            		</div>

            		<div class="form-group">
            			<label>Konfirmasi Password Baru</label>
            			<input type="password" name="konf_password" placeholder="Konfirmasi password baru Anda" class="form-control" required>
            			<div class="invalid-feedback">Konfirmasi password baru tidak boleh kosong</div>
            		</div>

            		<div class="block-bottom d-flex justify-content-between mt-5">
            			<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user_bo'); ?>" class="form-control">

            			<button type="button" class="btn btn-sm btn-default" onclick="history.back(-1)"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
            			<button type="submit" name="submit-change-password" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
            		</div>       
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#password_old').change(function() {
        	var id_user = <?php echo $this->session->userdata('id_user_bo'); ?>;
            var passsword_old = $('#password_old').val();

            if(passsword_old != '') {
                $.ajax({
                    url    : '<?php echo base_url();?>admin/cek_password_old',
                    method : 'POST',
                    data   : {id_user:id_user, passsword_old:passsword_old},
                    success:function(data) {
                        $('#cek_password_feedback').html(data);
                        console.log(data);  
                    }
                });
            }
        });
    });
</script> -->