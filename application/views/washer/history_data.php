<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Order From</th>
			<th>Address</th>
			<th>Total</th>
			<th>Ordered at</th>
			<th>Komentar</th>
			<th>Rating</th>
		</tr>
	</thead>
	<tbody>
	<?php $i=1; foreach($my_history as $history): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $history['nama']; ?></td>
			<td><?php echo $history['alamat']; ?></td>
			<td><?php echo $history['total']; ?></td>
			<td><?php echo $history['ordered_at']; ?></td>
			<td><?php echo $history['komentar']; ?></td>
			<td><?php echo $history['rating']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3"><b>Total Keseluruhan:</b></td>
			<td colspan="2"><?php echo $sum_total['sum_total'];; ?></td>
			<td><b>Rating Average:</b> </td>
			<td><?php echo $rating_avg['rating_avg']; ?></td>
		</tr>
	</tfoot>
</table>