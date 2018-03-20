<div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">
  <div class="card">
  <div class="card-block">
    <div class="sign-up">
              <!--Header-->
        
                <div class="text-center">
                  <h3><img id="profile-img" class="profile-img-card" src="<?php echo base_url('assets/img/logo_item.png');?>"></h3>
                  <hr class="mt-2 mb-2">
                </div>

                <?php echo validation_errors(); ?>
                <?php echo form_open('auth/register_user'); ?>
                <div class="row">

                  <div class="col-md-6">
                    <div class="md-form">
                      <input type="text"
                       name="nama" id="form1" class="form-control" value="<?php echo set_value('nama'); ?>">
                      <label for="form1">Nama</label>
                    </div>
                  </div>  

                  <div class="col-md-6">
                    <div class="md-form">
                      <input type="text" name="username" id="form2" class="form-control" value="<?php echo set_value('nama'); ?>">
                      <label for="form2">Username</label>
                    </div>
                  </div>

                </div>

                <div class="md-form">
                  <input type="text" name="email" id="form3" class="form-control">
                  <label for="form3">Email</label>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="md-form">
                      <input type="password" name="password" id="form2" class="form-control">
                      <label for="form2">Password</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="md-form">
                      <input type="password" name="passconf" id="form2" class="form-control">
                      <label for="form2">Konfirmasi Password</label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary"><span class="fa fa-id-badge"></span>&nbsp; <strong>Daftar</strong></button>
                </div>
                <?php echo form_close(); ?>
              
    </div>
  </div>
</div>
</div>
