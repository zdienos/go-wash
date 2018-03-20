		<div class="panel panel-primary">
	  <div class="panel-heading"><span class="fa fa-users"></span> Akun Pengguna</div>
	</div>

<div class="container">
	<div class="col-md-12 table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th>Registered at</th>
					<th>Deposit</th>
					<th>Bukti Deposit</th>
					<th>Uploaded At</th>
					<th>Request Join</th>
					<th>Action</th>
				</tr>
				
			</thead>
		
			<tbody class="data">

			</tbody>
		</table>


	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		// getting user data
		var getUsersData = function()
		{
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('admin/getUsersData'); ?>",
				success: function(data)
				{
					$(".data").empty().html(data);
				}
			});
		}
		getUsersData();

		// when user want to join as washer
		$(document).on("click", ".change", function(){
			var id = $(this).parent().parent().attr('data-id');
			console.log(id);
			swal({
				title: "Changing User's Role",
				text: "Are you sure you want to change this user's role?",
				type: "info",
				confirmButtonColor: '#5cb85c',
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			},
				function() {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('admin/update_user_role'); ?>",
						data: {
							id: id
						},
						dataType: "json",
						success: function(){
							setTimeout(function(){
								swal('Ayeey');
								getUsersData();
							}, 2000);
						},
						error: function(jqXHR, textStatus, errorThrown){
							swal('Error: ' + errorThrown);
						}
					});
					// setTimeout(function(){
					// 	swal('Ayeey');
					// }, 2000);
				}
			); // end of swal function
		});

		// Add Deposit Button
		$(document).on("click", ".add_deposit_btn", function(){
			var deposit_id = $(this).attr('data-id');
			swal({
				title: "User Deposit",
				text: "Tulis berdasarkan jumlah deposit yang diterima",
				type: "input",
				inputType: "number",
				showCancelButton: true,
				closeOnConfirm: false,
				animation: "slide-from-top",
				inputPlaceholder: ""
			},
			function(inputValue){
				if (inputValue === false) return false;

				if (inputValue === "") {
				swal.showInputError("You need to write something!");
				return false
				}

				// swal("Nice!", "You wrote: " + inputValue, "success");
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/add_deposit'); ?>",
					data: {
						deposit_id: deposit_id,
						inputValue: inputValue,
					},
					dataType: "json",
					success: function()
					{
						swal("Success", "Deposit telah diubah sebesar "+inputValue, "success");
						getUsersData();
					}
				});
			});
		});

		// zoom image
		$(document).on("click", ".foto", function(){
			$(".foto").elevateZoom({
				scrollZoom: true
			});
		});
		
	});
</script>