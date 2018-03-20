<div class="container">
    <div class="row">
    	<div class="col-md-6 col-md-offset-3">
    		<h3 style="text-align: center;">Masukkan Rincian</h3>
    		
    		<?php echo form_open('customer/do_order', array(
                'method' => 'POST',
                'id' => 'form'
            )); ?>
    			<div class="form-group">
    				<label for="nama">Tentukan Alamat Anda:</label>
    				<select class="form-control" name="alamat" required>
    					<option value="">Pilih Alamat</option>
                        <?php if (!empty($alamat)): ?>
                            <option value="<?php echo $alamat; ?>"><?php echo $alamat; ?></option>
                        <?php endif; ?>
                        
    				</select>
                    <?php echo form_error('alamat'); ?>
    				Belum memiliki alamat? Atur sekarang di <a href="<?php echo base_url('customer/profil'); ?>" style="color: blue;">Profil Anda</a>
                </div>

                <div class="form-group">
                	<label for="item">Pilih Item:</label>
                	<div class="well" style="height: 250px; overflow-y: auto;">
                		<table class="table">
                			<tr>
                				<th>Pilih</th>
                				<th>Item</th>
                				<th>Harga</th>
                			</tr>
                		<?php foreach ($items as $item) { ?>
                			<div class="checkbox">
                			<tr>
                				<td><input type="checkbox" name="items[]" value="<?php echo $item['id']; ?>" class="items" style="cursor: pointer;" <?php echo set_checkbox('items[]', $item['id']); ?>></td>
                				<td class="item"><?php echo $item['item']; ?></td>
                				<td class="harga"><?php echo $item['harga']; ?></td>
                			</tr>
                			</div>
                		<?php } ?>
                		</table>
                	</div>
                    <?php echo form_error('selected_items'); ?>
                </div>

                <div class="col-md-12">
                    <div class="col-md-8">
                        Ongkir: <b><span class="ongkir">10000</span></b><br>
                        <u>Item Selected:</u>
                        <div class="selected_items">
                            
                        </div>
                        <input type="hidden" name="selected_items">
                    </div>            
                    <div class="col-md-4" style="text-align: right;">Harga Total: <b><span id="total"></span></b></div>
                    <input type="hidden" name="total">
                </div>

                <div style="text-align: center;">
                    <button class="btn btn-success" type="submit" role="button" id="order">Order</button>
                </div>

    		<?php echo form_close(); ?>
    	</div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
        
        // using array
        var ongkir = 10000;
        var ids = [];
        var item_arr = [];
        var harga_arr = [];
        var total;
        harga_arr.push(ongkir);

        $('.items').change(function(){
            var id = Number($(this).val());
            var item = $(this).parent().parent().contents().filter("td.item").text();
            var harga = Number($(this).parent().parent().contents().filter("td.harga").text());
            
            // this.checked ? console.log("checked") : console.log("unchecked");
            if (this.checked) {
                ids.push(id);
                item_arr.push(item);
                harga_arr.push(harga);
                console.log(ids);
                console.log(item_arr);
                console.log(harga_arr);

                total = harga_arr.reduce(function(a, b) {
                    return a + b;
                }, 0);
                console.log(total);
                $("#total").text(total);
                $(".selected_items").text(item_arr);
                $("input[name='total']").val(total);
                $("input[name='selected_items']").val(ids);

            } else if (!this.checked) {
                var removeId = ids.indexOf(id);
                var removeItem = item_arr.indexOf(item);
                var removeHarga = harga_arr.indexOf(harga);
                
                ids.splice(removeId, 1);
                item_arr.splice(removeItem, 1);
                harga_arr.splice(removeHarga, 1);
                console.log(ids);
                console.log(item_arr);
                console.log(harga_arr);

                total = harga_arr.reduce(function(a, b) {
                    return a + b;
                }, 0);
                console.log(total);
                $("#total").text(total);
                $(".selected_items").text(item_arr);
                $("input[name='total']").val(total);
                $("input[name='selected_items']").val(ids);
            }

        });

        /*$(document).on("click", "#order", function(){
            swal('are u sure?');
        });*/

        /*$("#order").click(function(event){
            event.preventDefault();        
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('customer/do_order'); ?>",
                dataType: "json",
                data: $('#form').serialize(),
                success: function(data)
                {
                    if (data) {
                        alert('Success');
                        location.href = '<?php echo base_url('customer'); ?>';
                    }
                },
                error: function(jQXHR, textStatus, errorThrown)
                {
                    // alert(errorThrown);
                    console.log(errorThrown);
                }
            });
        });*/

        /*//using object
        var myObj = {};

        $('.items').change(function(){
            var id = $(this).val();
            var item = $(this).parent().parent().contents().filter("td.item").text();
            var harga = Number($(this).parent().parent().contents().filter("td.harga").text());

            if (this.checked) {

            }
        });*/
	});
</script>