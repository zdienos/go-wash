<nav class="navbar admin navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a href="<?php echo base_url('admin'); ?>"><img src="<?php echo base_url('assets/img/logo.png');?>" style="margin-top: 10px; margin-right: 10px; margin-left: 10px;" width="100"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($this->uri->segment(2)=='role') echo "class='active'" ?> ><a href="<?php echo base_url('admin/role'); ?>"><span class="fa fa-address-card"></span> Role</a></li>
                <li <?php if($this->uri->segment(2)=='laundry-item') echo "class='active'" ?> ><a href="<?php echo base_url('admin/laundry-item'); ?>"><span class="fa fa-briefcase"></span> Laundry Item</a></li>
                <li <?php if($this->uri->segment(2)=='users') echo "class='active'" ?> ><a href="<?php echo base_url('admin/users'); ?>"><span class="fa fa-users"></span> Users</a></li>
                <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>

    </div>
</nav>


