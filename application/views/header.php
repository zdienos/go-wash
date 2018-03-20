<nav class="navbar home navbar-fixed-top">
    <!-- <div class="container"> -->
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="glyphicon glyphicon-th-list"></span>                        
        </button>
        <a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/img/logo.png');?>" style="margin-top: 10px; margin-right: 10px; margin-left: 10px;" width="100"></a>
      </div>
      <div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
              <li <?php if($this->uri->segment(2) == 'register') echo "class='active'"; ?> ><a href="<?php echo base_url('auth/register'); ?>"><span class="fa fa-male"> </span>&nbsp; Sign Up</a></li>
              <li <?php if($this->uri->segment(1) == 'auth' && $this->uri->segment(2) !== 'register') echo "class='active'"; ?> ><a href="<?php echo base_url('auth'); ?>"><span class="fa fa-sign-in"> </span>&nbsp; Login</a></li>
              <li <?php if($this->uri->segment(1) == 'about') echo "class='active'"; ?> ><a href="<?php echo base_url('welcome/about'); ?>"><span class="fa fa-question-circle"> </span>&nbsp; About</a></li>
          </ul>
        </div>
      </div>
    </div>
</nav>