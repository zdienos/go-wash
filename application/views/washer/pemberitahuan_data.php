<?php 
error_reporting(0);
	/*
		Kalo dia belum bayar deposit dan admin belum menambahkannya
		maka dia ga bisa terima orderan (visibility order dihilangkan)
	*/
	if(empty($checkIfHasDeposited) || $checkIfClaimed == NULL):
?>
	<div class="well">
		Untuk dapat menerima orderan silahkan membayar <a href="<?php echo base_url('washer/deposit'); ?>">deposit</a> terlebih dahulu
	</div>
<?php
	/*	
		Logika, puyeng mikirnya.
		Jadi gini, ketentuannya si washer ga bisa terima orderan lagi selama
		masih ada status_id di antrian cuciannya = 2
		jadi ngecek apakah di array itu ada 2 nya ngga, kalo ada maka digagalin
		ga bisa accept order lagi.
	*/
	foreach ($checkIfClaimed as $check) {}
	elseif (in_array(2, $check)):
?>
	<div class="well" style="text-align: center;">
		<h2>Selesaikan <a href="<?php echo base_url('washer/proses'); ?>">pesanan</a> anda terlebih dahulu</h2>
	</div>

<?php else: ?>

	<?php foreach ($orders as $order): ?>
	<div class="panel panel-default" data-id="<?php echo $order['id']; ?>">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<b>Order ID: </b> <?php echo $order['id']; ?><br>
					<b>Ordered by: </b><?php echo $order['nama'];  ?>
				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">
					<?php echo $order['ordered_at']; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<!-- <b>Address: </b> <a class="alamat" title="Maps of <?php echo $order['alamat']; ?>"><?php echo $order['alamat']; ?></a> -->
					<b>Address: </b> <?php echo $order['alamat']; ?><br>
					<b>No. Telp: </b> <?php echo $order['no_hp']; ?>

				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">
					<span class="label label-success"><i>Order Tersedia. Terima Sekarang !</i></span>
				</div>
			</div>
		</div>

		<div class="panel-body">
			 <button class="btn btn-info show_order_details" data-id="<?php echo $order['id']; ?>">Show Order Details</button>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-md-6 col-xs-6">

					<b>Total Harga : </b>Rp. <?php echo $order['total']; ?> (sudah termasuk ongkir)

				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">
				<!-- Button Accept -->
				<button class="btn btn-sm btn-success claim" data-id="<?php echo $order['id']; ?>">Terima</button>
				</div>
			</div>
		</div>
	</div>
	
	<?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">

	var getMap = function(opts) {
	  var src = "http://maps.googleapis.com/maps/api/staticmap?",
	      params = $.extend({
	        center: 'Indonesia',
	        zoom: 14,
	        size: '512x512',
	        maptype: 'roadmap',
	        sensor: false,
	        key: 'AIzaSyDKlvJPnYeiNYLfosGuOnOQHrahxrd4ElI'
	      }, opts),
	      query = [];

	  $.each(params, function(k, v) {
	    query.push(k + '=' + encodeURIComponent(v));
	  });

	  src += query.join('&');
	  return '<img src="' + src + '" />';
	}

	var alamat = $(this).text();
	console.log(alamat);
	var content = getMap({center: 'Indonesia'});	

	// pop over the address
	$('.alamat').popover({
		html: true,
		content: content,
		placement: 'bottom'
	});
</script>