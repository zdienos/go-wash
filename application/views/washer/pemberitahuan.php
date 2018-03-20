<div class="col-md-6 col-md-offset-3">
	<div class="data"></div>
</div>

<!-- Modal Order Details -->
<div id="order_details_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">        
        <table class="table table-striped">
        	<thead>
	        	<tr>
	        		<th>Item</th>
	        		<th>Harga</th>
	        	</tr>
        	<tbody id="order_details">
	        	<tr>
	        		<!--order details appended here from ajax calls -->
	        	</tr>
        	</tbody>
        	<tfoot>
        		<tr>
        			<td style="text-align: right;">Total Harga</td>
        			<td>Rp. <span id="total_semua" style="font-weight: bold;"></span></td>
        		</tr>
        	</tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal Order Details -->

<script type="text/javascript">
		
	$(function(){

		// getting orders
		var getOrders = function()
		{
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('washer/getOrders'); ?>",
				success: function(data)
				{
					$('.data').empty().html(data);
				}
			});
		}
		setInterval(getOrders, 2000);
		// getOrders()

		// getting order details
		$(document).on('click', '.show_order_details', function(){
			var order_id = $(this).attr('data-id');
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('washer/getOrderDetails'); ?>"+'/'+order_id,
				success: function(data)
				{
					var res = $.parseJSON(data);
					$('#order_details_modal').modal('show');
					$.each(res, function(index, value){
						var item = value.item;
						var harga = value.harga;
						// $('#order_details').append('<li>'+item+'</li>');
						$('#order_details').append('<tr><td>'+item+'</td><td class="harga">'+harga+'</td></tr>');

						var elem = $(".harga");
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

					    // set total semua
					    $('#total_semua').text(total_row);
					});
				}
			});
		});

		// when order details modal is closed, then clear all item list
		$('#order_details_modal').on('hidden.bs.modal', function () {
		    $('#order_details').empty();
		});

		// when washer want to claim order
		$(document).on('click', '.claim', function(){
			var id = $(this).attr('data-id');
			swal({
				title:"Accept Order",
				text:"Yakin akan menerima orderan ini? \n Anda tidak akan dapat menerima orderan lain \n selama orderan ini belum selesai",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya",
				closeOnConfirm: true,
				showLoaderOnConfirm: true
			},
				function(){
					$.ajax({
					 	type: "POST",
						url:"<?php echo base_url('washer/claim_order'); ?>",
						data:{id:id},
						dataType: "json",
						success: function(data){
							setTimeout(function(){
								swal('Ayeey');
								getOrders();
							}, 3000); // end set timeout
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							swal(errorThrown);
						}
					 });
			});
		});

		// when washer want to skip order
		$(document).on('click', '.skip', function(){
			var id = $(this).attr('data-id');
			swal({
				title:"Skip Order",
				text:"Yakin akan melewati orderan ini?",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya",
				closeOnConfirm: true,
			},
				function(){
				 $.ajax({
					type: "POST",
					url:"<?php echo base_url('washer/skip_order'); ?>",
					data:{id:id},
					dataType: "json",
					success: function(data){
						// $("tr[data-id='"+id+"']").fadeOut("fast",function(){
						// 	$(this).remove();
						// });
						if (data.status == 'true') {
							swal('ayeeey');
							getOrders();
						} else {
							swal('ooops');
						}
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						swal(errorThrown);
					}
				 });
				/*// removing this order
				// $(this).parent().parent().parent().parent().hide();
				$("div[data-id='"+id+"']").fadeOut("fast", function(){
					$(this).remove();
				});*/
			});
			
		});

		
	});

</script>