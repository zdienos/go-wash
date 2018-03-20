<?php echo $this->session->flashdata('message'); ?>

<div class="dash-customer">
	<div class="jumbotron">
		<h1>Hello <?php echo $user; ?> !</h1>
		<p class="welcome">Selamat Datang Di Aplikasi Laundry</p>
		<p><a class="btn btn-info btn-lg" href="<?php echo base_url('customer/order'); ?>" id="order" role="button"><span class="fa fa-share-square-o"></span> Order Sekarang</a></p>
	</div>
</div>