<div>&nbsp;</div>

	<div class="data">
		
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
	        		<th>Qty</th>
	        		<th>Total</th>
	        	</tr>
        	<tbody id="order_details">
	        	<tr>
	        		<!--order details appended here from ajax calls -->
	        	</tr>
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal Order Details -->



<!-- Modal Give Feedback -->
<div id="give_feedback_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Give Feedback</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
      	<h3>Masukkan Komentar Anda</h3>
      	<textarea class="form-control" name="feedback" required></textarea>        
      	<div id="rateYo"></div>
      	<input type="hidden" name="rating">
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default send_feedback" data-id="">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- /Modal Give Feedback -->

<!-- <script type="text/javascript" scr="<?php echo base_url('assets/rateyo/v2.2.0/jquery.min.js'); ?>"></script>
<script type="text/javascript" scr="<?php echo base_url('assets/rateyo/v2.2.0/jquery.rateyo.js'); ?>"></script> -->
<script type="text/javascript">
	$(function(){

		// initialize star feedback
		$("#rateYo").rateYo({
			rating: 0,
			fullStar: true,
			onSet: function (rating, rateYoInstance) {			 
		    	// rating = rating;
		    	var rate = $("input[name='rating']").val(rating);
		   	}
		});
			

		// getting proses data
		var getProsesData = function()
		{
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('customer/proses_data'); ?>",
				success: function(data)
				{
					$('.data').empty().html(data);
				}
			});
		}
		setInterval(getProsesData, 2000);

		// getting order details
		$(document).on('click', '.show_order_details', function(){
			var order_id = $(this).attr('data-id');
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('customer/getOrderDetails'); ?>"+'/'+order_id,
				success: function(data)
				{
					var res = $.parseJSON(data);
					console.log(res);
					$('#order_details_modal').modal('show');
					var status_id = res[0].status_id;
					if (status_id >= 3) {
						$.each(res, function(index, value){
							var item = value.item;
							var harga = value.harga;
							var qty = value.qty;
							var harga_total_item = value.harga_total_item;

							$('#order_details').append('<tr>'+
								'<td>'+item+'</td>'+
								'<td>'+harga+'</td>'+
								'<td>'+qty+'</td>'+
								'<td>'+harga_total_item+'</td>'+
							'</tr>');
						});	
					}
					else {
						$.each(res, function(index, value){
							var item = value.item;
							var harga = value.harga;

							$('#order_details').append('<tr>'+
								'<td>'+item+'</td>'+
								'<td>'+harga+'</td>'+
								'<td>0</td>'+
								'<td>0</td>'+
							'</tr>');
						});
					}
				}
			});
		});

		// when order details modal is closed, then clear all item list
		$('#order_details_modal').on('hidden.bs.modal', function () {
		    $('#order_details').empty();
		});

		// showing feedback modal
		$(document).on("click", ".give_feedback", function(){
			var id=$(this).attr("data-id");
			console.log(id);
			$("#give_feedback_modal").modal('show');
			$(".send_feedback").attr("data-id", id); // set data-id to order id

		});

		// when send feedback modal is closed, then clear the order id
		$('#give_feedback_modal').on('hidden.bs.modal', function () {
		    $('.send_feedback').attr("data-id", "");
		});

		// send feedback
		$(document).on("click", ".send_feedback", function(){
			var id = $(this).attr("data-id");
			var komentar = $(this).parent().prev().find("textarea").val();
			var rating = $("input[name='rating']").val();
			console.log(id);
			console.log(komentar);
			console.log(rating);
			swal({
				title:"Send Feedback",
				text:"Yakin akan mengirim feedback dan rating? \n Pastikan untuk menggunakan bahasa yang sopan.",
				type: "warning",
				confirmButtonText: "Ya",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			},
				function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('customer/send_feedback'); ?>",
						data: {
							id: id,
							komentar: komentar,
							rating: rating
						},
						// dataType: "json",
						success: function(){
							setTimeout(function(){
								swal('Ayeey');
								$("textarea").val("");
								getProsesData();

								// reset star feedback
								$("#rateYo").rateYo({
									rating: 0,
									fullStar: true,
									onSet: function (rating, rateYoInstance) {			 
								    	// rating = rating;
								    	var rate = $("input[name='rating']").val(rating);
								   	}
								});
								$(".modal").modal('hide');
							}, 3000); // end set timeout
						}
					}); // end ajax function
				} // end function after confirmation
			); // end swal function
		});

		
	});

</script>