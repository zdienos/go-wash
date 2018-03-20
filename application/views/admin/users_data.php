<?php foreach ($users as $user): ?>
				<tr data-id="<?php echo $user['id']; ?>">
					<td><?php echo $user['nama']; ?></td>
					<td><?php echo $user['username']; ?></td>
					<td><?php echo $user['email']; ?></td>

					<!-- Role -->
					<?php if($user['role_id'] == '2'): ?>
					<td><span class="label orange lighten-2">Customer</span></td>
					<?php elseif($user['role_id'] == '3'): ?>
					<td><span class="label indigo lighten-2">Washer</span></td>
					<?php endif; ?>

				 	<td><?php echo $user['registered_at']; ?></td>
				 	
				 	<!-- Nominal deposit -->
				 	<?php if(empty($user['nominal']) || $user['nominal'] === ""): ?>
				 	<td>-</td>
				 	<?php else: ?>
				 	<td><?php echo $user['nominal']; ?></td>
				 	<?php endif; ?>
				 	
				 	<!-- Bukti foto deposit -->
				 	<?php if(empty($user['foto'])): ?>
				 		<td>Hasn't uploaded photo</td>
				 	<?php else: ?>
				 		<td><img class="foto" alt="<?php echo $user['foto']; ?>" src="<?php echo base_url('assets/uploads/'.$user['foto']); ?>" width="100px" height="100px" data-zoom-image="<?php echo base_url('assets/uploads/'.$user['foto']); ?>"></td>
				 	<?php endif; ?>

				 	<!-- Tanggal Upload foto deposit -->
				 	<?php if(empty($user['uploaded_at']) || $user['uploaded_at'] == ""): ?>
				 	<td>-</td>
				 	<?php else: ?>
				 	<td><?php echo $user['uploaded_at']; ?></td>
				 	<?php endif; ?>

				 	<!-- Request Join -->
				 	<?php if ($user['request_join'] == 1 && $user['role_id'] == 2): ?>
				 		<td><span class="label label-info">Yes</span></td>
				 	<?php elseif($user['request_join'] == 1 && $user['role_id'] == 3): ?>
				 		<td><span class="label label-success">No</span></td>
				 	<?php elseif($user['request_join'] == 0 ): ?>
				 		<td><span class="label label-default">No</span></td>
				 	<?php endif; ?>

				 	<!-- Change Role and Add deposit button -->
				 	<td>
				 	<?php if ($user['request_join'] == 1 && $user['role_id'] == 2): ?>
					 	<button class="btn btn-sm btn-warning change"><span class="glyphicon glyphicon-cog"></span> Change Role</button>
					<?php elseif($user['request_join'] == 1 && $user['role_id'] == 3): ?>
						<button class="btn btn-sm btn-warning change" disabled><span class="glyphicon glyphicon-cog"></span> Change Role</button>
					<?php elseif($user['request_join'] == 0 ): ?>
						<button class="btn btn-sm btn-warning change" disabled><span class="glyphicon glyphicon-cog"></span> Change Role</button>
					<?php endif; ?>

					<!-- Add Deposit button -->
					<?php if($user['role_id'] == '2'): ?>
					<button class="btn btn-sm btn-primary add_deposit_btn" data-id="<?php echo $user['deposit_id']; ?>" disabled>Add Deposit</button>
					<?php elseif($user['role_id'] == '3'): ?>
					<button class="btn btn-sm btn-primary add_deposit_btn" data-id="<?php echo $user['deposit_id']; ?>">Add Deposit</button>
					<?php endif; ?>

				 	</td>
				</tr>
<?php endforeach; ?>