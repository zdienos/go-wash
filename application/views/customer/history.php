<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>Your Order History</h2>
			<div class="data table-responsive"></div>			
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		var getHistory = function()
		{
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('customer/getHistory'); ?>",
				success: function(data)
				{
					$(".data").empty().html(data);
					console.log(data);
				}
			});
		}
		setInterval(getHistory, 2000);
		// getHistory();
	});
</script>