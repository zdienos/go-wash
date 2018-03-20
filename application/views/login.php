<br>
<br>
<?php
if (!empty($success)) {
    echo "<div class='alert alert-success'>
          <strong>Registrasi berhasil!</strong> $success.
        </div>";
} else {
    echo "";
}
?>
<br><br>

<div class="col-md-6 col-md-offset-3">
  <div class="card">
    <div class="card-block">
        <div class="sign-in">
          
           <div class="text-center">
            <h3><img id="profile-img" class="profile-img-card" src="<?php echo base_url('assets/img/logo_item.png');?>"></h3>
            <hr class="mt-2 mb-2">
          </div>

          <?php echo validation_errors(); ?>
          <?php echo form_open('auth/cek_login'); ?>
          <!--Body-->
          <div class="md-form">
              <i class="fa fa-user prefix"></i>
              <input type="text" name="username" id="form2" class="form-control">
              <label for="form2">Username</label>
          </div>

          <div class="md-form">
              <i class="fa fa-lock prefix"></i>
              <input type="password" name="password" id="form4" class="form-control">
              <label for="form4">Your password</label>
          </div>

          <div class="text-center">
              <button href="<?php echo base_url("auth/cek_login"); ?>" class="btn btn-primary"><span class="fa fa-sign-in"></span>&nbsp; <strong>Login</strong></button>
          </div>
          <?php echo form_close(); ?>

        </div>
    </div>
</div>
</div>