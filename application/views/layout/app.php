<!DOCTYPE html>
<html>
<head>
	<title>Go Wash</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/data-tables/DT_bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.css'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/MDB/css/mdb.css'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/MDB/css/mdb.min.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/MDB/css/go_wash.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/rateyo/v2.2.0/jquery.rateyo.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/css.css'); ?>"> -->

	<link rel="shortcut icon"  href="<?php echo base_url('assets/img/cuci.png');?> ">

	<style type="text/css">
		@font-face {
			font-family: Raleway;
			src: url(<?php echo base_url('/assets/fonts/Raleway-Regular.ttf'); ?>);
		}
		body {
			font-family: Raleway;
		}
		td {
			cursor: pointer;
		}

		.editor{
			display: none;
		}
		#map_canvas {         
		    height: 400px;         
		    width: 100%;         
		    margin: 0.6em;       
		}
		#loading-indicator {
			position: absolute;
			left: 50%;
			top: 50%;
			width: 64px;
			height: 64px;
			margin-left: -32px;
			margin-top: -32px;
			border: 0;
			z-index: 999;

	</style>



</head>
<body>
<!-- HEADER -->
<?php $this->load->view($header); ?>


<script type="text/javascript" src="<?php echo base_url('assets/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/data-tables/jquery.dataTables.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/data-tables/DT_bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/MDB/js/mdb.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('assets/MDB/js/mdb.min.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/MDB/js/tether.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/elevatezoom-master/jquery.elevatezoom.js'); ?>"></script>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyDKlvJPnYeiNYLfosGuOnOQHrahxrd4ElI&libraries=places&region=uk&language=en&sensor=false"></script>
<script>
    $(document).ready(function(){
        var table = $('#dtable').DataTable();
    });
</script>



<?php 
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "welcome" ) {	
	if ($this->uri->segment(1) == "welcome" && $this->uri->segment(2) == "about" ) {
		$this->load->view('about');	
	}
	 else{
	 	$this->load->view('home');
	 }

} else {
?>

<br>
<br>
<br>
<div class="container">
	<div class="row">
		<img src="<?php echo base_url('assets/img/loading.gif'); ?>" id="loading-indicator" style="display: none;">
		<!-- CONTENT -->
		<?php $this->load->view($page); ?>
	</div>
</div>

<?php } ?>

<script type="text/javascript">
    
    // giving loading image every ajax calls
    $(document).ajaxSend(function(event, request, settings) {
	    // $('#loading-indicator').show();
	});

	$(document).ajaxComplete(function(event, request, settings) {
	    // $('#loading-indicator').hide();
	});

    $(function () {
    	$(".dropdown").on('click', function(){
            $(".dropdown-menu").slideToggle(400);
        });

        $(".foto").elevateZoom({
        	scrollZoom: true
        });

        /* $(".welcome").hide().delay(3s).fadeIn();
        $("#order").hide().delay(4s).fadeIn();*/

    });
</script>
</body>
</html>

