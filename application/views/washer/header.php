<nav class="navbar customer navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a href="<?php echo base_url('washer'); ?>"><img src="<?php echo base_url('assets/img/logo.png');?>" style="margin-top: 10px; margin-right: 10px; margin-left: 10px;" width="100"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($this->uri->segment(2) == 'pemberitahuan') echo "class='active'"; ?>><a href="<?php echo base_url('washer/pemberitahuan'); ?>"><span class="glyphicon glyphicon-globe"> </span>&nbsp; Semua Order</a></li>
                <li <?php if($this->uri->segment(2) == 'proses') echo "class='active'"; ?>><a href="<?php echo base_url('washer/proses'); ?>"><span class="glyphicon glyphicon-shopping-cart"> </span>&nbsp; Proses Barang</a></li>
                <li <?php if($this->uri->segment(2) == 'history') echo "class='active'"; ?>><a href="<?php echo base_url('washer/history'); ?>"><span class="fa fa-history"> </span>&nbsp; History</a></li>
                <li <?php if($this->uri->segment(2) == 'about') echo "class='active'"; ?>><a href="<?php echo base_url('washer/about'); ?>"><span class="fa fa-question-circle"> </span>&nbsp; Ketentuan</a></li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user-circle"> </span>&nbsp; <?php echo $user; ?>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if($this->uri->segment(2) == 'profil') echo "class='active'"; ?>><a href="<?php echo base_url('washer/profil'); ?>"><span class="glyphicon glyphicon-cog"></span> Sunting Profil</a></li>
                        <li <?php if($this->uri->segment(2) == 'deposit') echo "class='active'"; ?>><a href="<?php echo base_url('washer/deposit'); ?>"><span class="fa fa-cogs"></span> Deposit</a></li>
                        <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</nav>