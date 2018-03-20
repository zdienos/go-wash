<?php foreach ($my_notif as $notif): ?>
	<div class="panel panel-default" data-id="<?php echo $notif['id']; ?>">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					Your order was claimed by <b><?php echo $notif['nama']; ?></b>
				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">
					Order ID: <b><?php echo $notif['id']; ?></b>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-6">
					
				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">

				</div>
			</div>
		</div>

		<div class="panel-body">
			 <button class="btn btn-info show_order_details" data-id="<?php echo $notif['id']; ?>">Show Order Details</button>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					
				</div>
				<div class="col-md-6 col-xs-6" style="text-align: right;">
				
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>