

<div class="col-md-6 col-md-offset-3">
	<div class="data">
		
	</div>
</div>

<!-- Modal Order Details -->
<div id="order_details_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">        
        <table class="table table-striped" id="details">
        	<thead>
	        	<tr>
	        		<th width="30%">Item</th>
	        		<th width="25%">Harga</th>
	        		<th width="20%">Qty</th>
	        		<th width="25%">Total</th>
	        	</tr>
        	<tbody id="order_details">
        	<span><p style="color: red">Press <b>Enter</b> after editing qty</p></span>
	        	<tr>
	        		<!--order details appended here from ajax calls -->
	        	</tr>	      
        	</tbody>
        	<tfoot>
        		<tr>
        			<td colspan="2">Ongkos Kirim: Rp. <span id="ongkir" style="font-weight: bold;">10000</span></td>
        			<td style="text-align: right;">Total Harga</td>
        			<td>Rp. <span id="total_semua" style="font-weight: bold;"></span></td>
        			<input type="hidden" name="total_semua">
        		</tr>
        	</tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-info send_final_price" data-id="">Kirim Harga Final</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal Order Details -->


<script type="text/javascript">
	
	$(function(){		
		// getting proses data
		var getProsesData = function()
		// function getProsesData()
		{
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('washer/proses_data'); ?>",
				success: function(data)
				{
					$('.data').empty().html(data);
				}
			});
		}
		setInterval(getProsesData, 2000);

		// getting order and order details
		$(document).on('click', '.show_order_details', function(){
			var order_id = $(this).attr('data-id');		

			$.ajax({
				type: "GET",
				url: "<?php echo base_url('washer/getOrderDetails'); ?>"+'/'+order_id,
				success: function(data)
				{
					var res = $.parseJSON(data);
					console.log(res);
					$('#order_details_modal').modal('show');

					var order_id = res[0].order_id;
					var total_semua = res[0].total;
					var status_id = res[0].status_id;

					$(".send_final_price").attr("data-id", order_id); // set id to Send Final Price button
					$("#total_semua").text(total_semua); // set harga total semua

					if (status_id < 3) {
						$.each(res, function(index, value){
							var id = value.id;
							var item = value.item;
							var harga = value.harga;
							var qty = value.qty;
							var harga_total_item = value.harga_total_item;
							
							$('#order_details').append('<tr data-id='+id+'>'+
								'<td>'+item+'</td>'+
								'<td>'+
									'Rp. <span class="harga">'+harga+'</span>'+
								'</td>'+
								'<td class="editable">'+
									'<span class="span-qty caption" data-id='+id+' style="display: inline;">'+qty+'</span>'+
									'<input class="field-qty form-control editor" type="number" data-id='+id+' value='+qty+' style="display: none;">'+
								'</td>'+
								'<td>'+
									'<span>Rp. </span>'+
									'<span class="span-total caption_harga" data-id='+id+' style="display: inline;">'+harga_total_item+'</span>'+
									'<input class="field-total form-control editor_harga" type="hidden" data-id='+id+' readonly>'+
								'</td>'+
								'</tr>');
						}); // end of each function

					} else {
						// $(".modal-body").hide();
						$("#order_details").html("<tr style='text-align: center;'><td colspan='4'><h3>You have sent final price</h3></td><tr>");
						$(".send_final_price").prop('disabled', true);
						console.log(status_id);
					}
				}
			});
		});

		// when order details modal is closed, then clear all item list
		$('#order_details_modal').on('hidden.bs.modal', function () {
		    $('#order_details').empty();
		    $(".send_final_price").prop('disabled', false);
		});

		// Click trigger to edit
		$(document).on("click",".editable",function(){
			$(this).find("span[class~='caption']").hide();
			$(this).find("input[class~='editor']").fadeIn().focus();
		});

		// Calculate price * qty
		$(document).on("mouseup keyup", "input[class~='editor']", function() {
		    var qty = $(this).val();
		    var harga = $(this).parent().prev().find("span[class~='harga']").text();
		    var total = qty * harga;
		    var tot = $(this).parent().next().find("span[class~='caption_harga']").text(total);
		    var tot_hidden = $(this).parent().next().find("input[class~='editor_harga']").val(total);
		    var ongkir = parseInt($("#ongkir").text());
		    

		    var elem = $(".caption_harga");
		    var harga_arr = []; // nampung ke array buat disum nantinya

		    // getting each total
		    elem.each(function(key, value){
		    	var column_harga = parseInt($(this).text());
		    	var pushed = harga_arr.push(column_harga);
		    });
		    
		    // sum total row
		    var total_row = harga_arr.reduce(function(a, b){
		    	return a+b;
		    }, 0);

		    // ditambah ongkir
		    var total_semua = total_row + ongkir;
		    $('#total_semua').text(total_semua);
		    $("input[name='total_semua']").val(total_semua);

		});

		// Update total harga on database
		$(document).on("keydown", ".editable", function(e){
			if (e.keyCode==13) // 13 is Enter
			{
				var order_id = $(".show_order_details").attr('data-id');
				var total_semua = $("input[name='total_semua']").val();
				var target = $(e.target);
				var id = target.attr('data-id');
				var value_qty = target.val();
				var value_total = target.parent().next().find("input[class~='editor_harga']").val();
				var data = {
					id: id,
					value_qty: value_qty,
					value_total: value_total,
					order_id: order_id,
					total_semua: total_semua
				};

				$.ajax({
					type: "POST",
					data: data,
					url: "<?php echo base_url('washer/update_detail_cucian'); ?>",
					success: function()
					{
						target.hide(); // inputannya sendiri
						target.siblings("span[class~='caption']").html(value_qty).fadeIn(); // text yang ada di span
						target.parent().next().find("span[class~='caption_harga']").html(value_total).fadeIn(); // text yang ada di total
						getProsesData(); // update page
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						swal(errorThrown);
					}
				});
			}
		});

		// Send final price to customer
		$(document).on("click", ".send_final_price", function(){
			var id=$(this).attr("data-id");
			swal({
				title:"Send Final Price",
				text:"Yakin dengan ketetapan harga yang dikirim?\n Anda tidak dapat mengubah harga kembali setelah mengirim ini",
				type: "warning",
				confirmButtonText: "Kirim",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			},
				function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('washer/send_final_price'); ?>",
						data: {id:id},
						// dataType: "json",
						success: function(){
							setTimeout(function(){
								swal('Ayeey');
								getProsesData();
								$(".modal").modal('hide');
							}, 3000); // end set timeout
						}
					}); // end ajax function
				} // end function after confirmation
			); // end swal function
		}); // end send_final_price click function


		// paid confirmation
		$(document).on("click", ".paid", function(){
			var id=$(this).attr("data-id");
			swal({
				title:"Payment Confirmation",
				text:"Pastikan Customer telah membayar. \n Yakin dengan konfirmasi ini?",
				type: "warning",
				confirmButtonText: "Ya",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			},
				function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('washer/payment_confirmation'); ?>",
						data: {id:id},
						// dataType: "json",
						success: function(){
							setTimeout(function(){
								swal('Ayeey');
								getProsesData();
								$(".modal").modal('hide');
							}, 3000); // end set timeout
						}
					}); // end ajax function
				} // end function after confirmation
			); // end swal function
		}); // end send_final_price click function


		// finish confirmation
		$(document).on("click", ".finish", function(){
			var id=$(this).attr("data-id");
			swal({
				title:"Finish Confirmation",
				text:"Pastikan Anda telah mengembalikan orderan ini. \n Yakin dengan konfirmasi ini?",
				type: "warning",
				confirmButtonText: "Ya",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			},
				function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('washer/finish_confirmation'); ?>",
						data: {id:id},
						// dataType: "json",
						success: function(){
							setTimeout(function(){
								swal('Sukses');
								getProsesData();
								$(".modal").modal('hide');
							}, 3000); // end set timeout
						}
					}); // end ajax function
				} // end function after confirmation
			); // end swal function
		}); // end send_final_price click function


	});
		
		
	
</script>