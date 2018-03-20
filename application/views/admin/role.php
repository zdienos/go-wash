<div class="container">
	<div class="col-md-6 col-md-offset-3">

	<div class="panel panel-primary">
      <div class="panel-heading"><span class="fa fa-address-card"></span> Akun Pengguna</div>
    </div>
		<button id="tambah-data" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
		<div>&nbsp;</div>
		<table id="table-data" class="table table-hover">
			<thead>
				<tr>
					<th>Level</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
	
			<tbody id="table-body">
				<?php foreach ($roles as $role) { ?>
				<tr data-id="<?php echo $role['id']; ?>">
					<td>
						<span class="span-level caption" data-id="<?php echo $role['id']; ?>" style="display: inline;"><?php echo $role['level']; ?></span>
						<input class="field-level form-control editor" type="text" data-id="<?php echo $role['id']; ?>" value="<?php echo $role['level']; ?>" style="display: none;">
					</td>
					<td>
						<span class="span-nama caption" data-id="<?php echo $role['id']; ?>" style="display: inline;"><?php echo $role['nama']; ?></span>
						<input class="field-nama form-control editor" type="text" data-id="<?php echo $role['id']; ?>" value="<?php echo $role['nama']; ?>" style="display: none;">
					</td>
					<td>
						<button class='btn btn-xs btn-danger hapus' data-id="<?php echo $role['id']; ?>"><i class='glyphicon glyphicon-trash'></i> Hapus</button>
					</td>
			</tr>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
$(function(){
	
	$.ajaxSetup({
		type:"post",
		cache:false,
		dataType: "json"
	});

	// Click trigger to edit
	$(document).on("click","td",function(){
		$(this).find("span[class~='caption']").hide();
		$(this).find("input[class~='editor']").fadeIn().focus();
	});

	// Create
	$("#tambah-data").click(function(){
		$.ajax({
			url:"<?php echo base_url('admin/role_create'); ?>",
			success: function(a){
			var ele="";
			ele+="<tr data-id='"+a.id+"'>";
			ele+="<td><span class='span-level caption' data-id='"+a.id+"'></span> <input type='text' class='field-level form-control editor'  data-id='"+a.id+"' /></td>";
			ele+="<td><span class='span-nama caption' data-id='"+a.id+"'></span> <input type='text' class='field-nama form-control editor' data-id='"+a.id+"' /></td>";
			ele+="<td><button class='btn btn-xs btn-danger hapus' data-id='"+a.id+"'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>";
			ele+="</tr>";

			var element=$(ele);
			element.hide();
			element.appendTo("#table-body").fadeIn(1500);

			}
		});
	});	

	// Edit
	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13) // 13 is Enter
		{
			var target = $(e.target);
			var value = target.val();
			var id = target.attr("data-id");
			var data = {
				id:id,
				value:value
			};
			if (target.is(".field-level")) {
				data.modul="level";
			} else if (target.is(".field-nama")) {
				data.modul="nama";
			}

			// Update
			$.ajax({
				data:data,
				url:"<?php echo base_url('admin/role_update'); ?>",
				success: function(a){
					target.hide();
					target.siblings("span[class~='caption']").html(value).fadeIn();
				}

			});
		} // end keycode=13 (enter)
	});

	// Delete
	$(document).on("click",".hapus",function(){
		var id=$(this).attr("data-id");
		swal({
			title:"Hapus Role",
			text:"Yakin akan menghapus role ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Hapus",
			closeOnConfirm: true,
		},
			function(){
			 $.ajax({
				url:"<?php echo base_url('admin/role_delete'); ?>",
				data:{id:id},
				success: function(){
					$("tr[data-id='"+id+"']").fadeOut("fast",function(){
						$(this).remove();
					});
				}
			 });
		});
	});






});
	
</script>