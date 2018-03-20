<nav class="navbar customer navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a href="<?php echo base_url('customer'); ?>"><img src="<?php echo base_url('assets/img/logo.png');?>" style="margin-top: 10px; margin-right: 10px; margin-left: 10px;" width="100"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($this->uri->segment(2) == 'order') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/order'); ?>"><span class="fa fa-share-square-o"> </span>&nbsp; Order Sekarang</a></li>
                <li <?php if ($this->uri->segment(2) == 'proses') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/proses'); ?>"><span class="glyphicon glyphicon-shopping-cart"> </span>&nbsp; Proses Barang</a></li>
                <li <?php if ($this->uri->segment(2) == 'history') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/history'); ?>"><span class="fa fa-history"> </span>&nbsp; History</a></li>
                <li <?php if ($this->uri->segment(2) == 'about') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/about'); ?>"><span class="fa fa-question-circle"> </span>&nbsp; Ketentuan</a></li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user-circle"> </span>&nbsp; <?php echo $user; ?>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if ($this->uri->segment(2) == 'profil') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/profil'); ?>"><span class="glyphicon glyphicon-cog"></span> Sunting Profil</a></li>
                        <li <?php if ($this->uri->segment(2) == 'join') echo "class='active'";  ?> ><a href="<?php echo base_url('customer/join'); ?>"><span class="fa fa-street-view"></span> Join</a></li>
                        <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</nav>

