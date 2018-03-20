<div class="container">
	<div class="col-md-6 col-md-offset-3">

    <div class="panel panel-primary">
      <div class="panel-heading"><span class="fa fa-briefcase"></span> Laundry Item</div>
    </div>

		<button id="tambah-data" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
		<div>&nbsp;</div>
		<table id="table-data" class="table table-striped">
			<thead>
				<tr>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Keterangan</th>
				</tr>
			</thead>
	
			<tbody id="table-body">
				<?php foreach ($barang as $barang) { ?>
				<tr data-id="<?php echo $barang['id']; ?>">
					<td>
						<span class="span-item caption" data-id="<?php echo $barang['id']; ?>" style="display: inline;"><?php echo $barang['item']; ?></span>
						<input class="field-item form-control editor" type="text" data-id="<?php echo $barang['id']; ?>" value="<?php echo $barang['item']; ?>" style="display: none;">
					</td>
					<td>
						<span class="span-harga caption" data-id="<?php echo $barang['id']; ?>" style="display: inline;"><?php echo $barang['harga']; ?></span>
						<input class="field-harga form-control editor" type="text" data-id="<?php echo $barang['id']; ?>" value="<?php echo $barang['harga']; ?>" style="display: none;">
					</td>
					<td>
						<span class="span-keterangan caption" data-id="<?php echo $barang['id']; ?>" style="display: inline;"><?php echo $barang['keterangan']; ?></span>
						<select class="field-keterangan form-control editor" data-id="<?php echo $barang['id']; ?>" style="display: none;">
							<option>Satuan</option>
							<option>Kiloan</option>
						</select>
					</td>
					<td>
						<button class='btn btn-xs btn-danger hapus' data-id="<?php echo $barang['id']; ?>"><i class='glyphicon glyphicon-remove'></i> Hapus</button>
					</td>
			</tr>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div> <!-- end of container -->

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
		$(this).find("select[class~='editor']").fadeIn().focus();
	});

	// Create
	$("#tambah-data").click(function(){
		$.ajax({
			url:"<?php echo base_url('admin/create_barang'); ?>",
			success: function(a){
			var ele="";
			ele+="<tr data-id='"+a.id+"'>";
			ele+="<td><span class='span-item caption' data-id='"+a.id+"'></span> <input type='text' class='field-item form-control editor'  data-id='"+a.id+"' /></td>";
			ele+="<td><span class='span-harga caption' data-id='"+a.id+"'></span> <input type='text' class='field-harga form-control editor' data-id='"+a.id+"' /></td>";
			ele+="<td><span class='span-keterangan caption' data-id='"+a.id+"'></span> <select class='field-keterangan form-control editor' data-id='"+a.id+"' /></select></td>";	
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
			if (target.is(".field-item")) {
				data.modul="item";
			} else if (target.is(".field-harga")) {
				data.modul="harga";
			}else if (target.is(".field-keterangan")) {
				data.modul="keterangan";
			}

			// Update
			$.ajax({
				data:data,
				url:"<?php echo base_url('admin/update_barang'); ?>",
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
			title:"Hapus Barang",
			text:"Yakin akan menghapus Barang ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Hapus",
			closeOnConfirm: true,
		},
			function(){
			 $.ajax({
				url:"<?php echo base_url('admin/delete_barang'); ?>",
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