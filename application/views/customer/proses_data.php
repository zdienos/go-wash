<div class="col-md-6 col-md-offset-3">
	<?php foreach ($my_order as $order): ?>
		<div class="panel panel-default" data-id="<?php echo $order['id']; ?>">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<b>Orderan Anda</b><br>
						<?php if($order['choose_to_id'] == 0): ?>

						<?php else: ?>
							<b>Diterima Oleh:</b> <?php echo $order['nama']; ?><br>
							<b>No. Telp:</b> <?php echo $order['no_hp']; ?>
						<?php endif; ?>
					</div>
					<div class="col-md-6 col-xs-6" style="text-align: right;">
						<?php echo $order['ordered_at']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12" style="text-align: right;">
						<?php if($order['status_id'] == 1): ?>
							<span class="label label-info"><i>Menunggu Washer</i></span>
						<?php elseif($order['status_id'] == 2): ?>
							<span class="label label-success"><i><?php echo $order['choose_to_id']; ?> accepted your order. Waiting to get picked up . . .</i></span>
						<?php elseif($order['status_id'] == 3): ?>
							<span class="label label-warning"><i>You haven't pay this order</i></span>
						<?php elseif($order['status_id'] == 4): ?>
							<span class="label label-primary"><i>Waiting for <?php echo $order['choose_to_id']; ?> returning your laundry</i></span>
						<?php elseif($order['status_id'] == 5): ?>
							<span class="label label-danger"><i>Barang Anda Telah Selesai. Berikan Penilaian Sekarang</i></span>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="panel-body">
				 <button class="btn btn-info show_order_details" data-id="<?php echo $order['id']; ?>">Show Order Details</button>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<b>Total Harga: </b>Rp. <?php echo $order['total']; ?>
					</div>
					<div class="col-md-6 col-xs-6" style="text-align: right;">
						<?php if($order['status_id'] == 5): ?>
				 			<button class="btn btn-sm btn-success give_feedback" data-id="<?php echo $order['id']; ?>">Rating</button>
				 		<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>