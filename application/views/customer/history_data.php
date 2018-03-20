<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Washer</th>
			<th>Total</th>
			<th>Ordered at</th>
			<th>Komentar Saya</th>
			<th>Rating</th>
		</tr>
	</thead>
	<tbody>
	<?php $i=1; foreach($my_history as $history): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $history['nama']; ?></td>
			<td><?php echo $history['total']; ?></td>
			<td><?php echo $history['ordered_at']; ?></td>
			<td><?php echo $history['komentar']; ?></td>
			<td><?php echo $history['rating']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
	</tfoot>
</table>