<?php if ($checkIfClaimed > 0): ?>
	<?php foreach($show_my_claims as $claim): ?>
		<div class="panel panel-default" data-id="<?php echo $claim['id']; ?>">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<b>Order ID:</b> <?php echo $claim['id']; ?><br>
						<b>Ordered by: </b><?php echo $claim['nama'];?>
					</div>
					<div class="col-md-6 col-xs-6" style="text-align: right;">
						<?php echo $claim['ordered_at']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<b>Address: </b><?php echo $claim['alamat']; ?><br>
						<b>No. Telp: </b><?php echo $claim['no_hp']; ?>
					</div>
					<div class="col-md-6 col-xs-6" style="text-align: right;">
						<?php if($claim['status_id'] == 1): ?>
							<span class="label label-success"><i>Order Tersedia. Terima Sekarang !</i></span>
						<?php elseif($claim['status_id'] == 2): ?>
							<span class="label label-success"><i><?php echo $claim['nama']; ?> is waiting you. Go now!</i></span>
						<?php elseif($claim['status_id'] == 3): ?>
							<span class="label label-warning"><i>You have sent final price. <?php echo $claim['nama']; ?> hasn't paid. <br> Go Wash now!</i></span>
						<?php elseif($claim['status_id'] == 4): ?>
							<span class="label label-primary"><i><?php echo $claim['nama']; ?> has paid. Finish and send it back</i></span>
						<?php elseif($claim['status_id'] == 5): ?>
							<span class="label label-danger"><i>You have finished this order. <br> Go Wash another order!</i></span>
						<?php endif; ?>

					</div>
				</div>
			</div>

			<div class="panel-body">
				 <button class="btn btn-info show_order_details" data-id="<?php echo $claim['id']; ?>">Show Order Details</button>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<b>Total Harga: </b>Rp. <?php echo $claim['total']; ?>
					</div>
					<div class="col-md-6 col-xs-6" style="text-align: right;">
					<!-- Button Accept -->
					<?php if($claim['status_id'] == 3 ): ?>
						<button class="btn btn-sm btn-warning paid" data-id="<?php echo $claim['id']; ?>">Paid</button>
						<button class="btn btn-sm btn-success finish" data-id="<?php echo $claim['id']; ?>" disabled>Finish</button>
					<?php elseif($claim['status_id'] == 4): ?>
						<button class="btn btn-sm btn-warning paid" data-id="<?php echo $claim['id']; ?>" disabled>Paid</button>
						<button class="btn btn-sm btn-success finish" data-id="<?php echo $claim['id']; ?>">Finish</button>
					<?php else: ?>
						<button class="btn btn-sm btn-warning paid" data-id="<?php echo $claim['id']; ?>" disabled>Paid</button>
						<button class="btn btn-sm btn-success finish" data-id="<?php echo $claim['id']; ?>" disabled>Finish</button>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	Go <a href="<?php echo base_url('washer/pemberitahuan'); ?>">Order List</a> for laundry orders!
<?php endif; ?>