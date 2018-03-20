<div class="container">
	<div class="col-md-8 col-md-offset-2">
        <?php echo $this->session->flashdata('message'); ?>
		<h3 style="text-align: center;">Sunting Profil</h3>
		<?php echo form_open('customer/profil_update'); ?>
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<div>&nbsp;</div>
		<div class="form-group">
			<label for="no_hp"><span class="fa fa-phone"></span> No. Telepon:</label>
			<?php if (!empty($no_hp)): ?>
				<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Telepon Anda" value="<?php echo $no_hp; ?>" required>
			<?php else:  ?>
				<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Telepon Anda" value="<?php echo set_value('no_hp') ?>" required>
			<?php endif; ?>
			<?php echo form_error('no_hp'); ?>
		</div>

		<div class="form-group">
			<label for="alamat"><span class="fa fa-map-marker"></span> Alamat :</label>
			<?php if (!empty($alamat)): ?>
				<input type="text" class="form-control" id="searchTextField" name="alamat" placeholder="Masukkan Alamat Anda" class="searchMaps" value="<?php echo $alamat; ?>" required>	
			<?php else: ?>
				<input type="text" class="form-control" id="searchTextField" name="alamat" placeholder="Masukkan Alamat Anda" class="searchMaps" value="<?php echo set_value('alamat'); ?>" required>
			<?php endif; ?>
			<?php echo form_error('alamat'); ?>
			<div id="map_canvas"></div>
		</div>
        
        <!-- input lat lng buat nyimpen ke databasenya -->
        <input type="hidden" name="lat">
        <input type="hidden" name="lng">
        <!-- / input lat lng buat nyimpen ke databasenya -->

        <div class="form-group" style="text-align: center;">
        	<button class="btn btn-success" type="submit" role="button"><span class="fa fa-cogs"></span> Update Profil</button>
        </div>
		<?php echo form_close(); ?>

	</div>
<script type="text/javascript">

// Get lat lng of maps

$(function(){
    var lat = -6.33731,
        lng = 108.3258329;

    // Getting lat lng from database
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('customer/getKoordinat'); ?>",
        success: function(data)
        {
            var res = $.parseJSON(data);
            lat = res.lat;
            lng = res.lng;
        },
        async: false
    });

    /* prevent supaya enter ga langsung nyimpen ke database
    tapi nyari titik lokasinya dulu*/
    $(':input').keydown(function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
    
    // Javascript Maps Autocomplete

    var latlng = new google.maps.LatLng(lat, lng),
        image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png'; 
         
    var mapOptions = {           
            center: new google.maps.LatLng(lat, lng),           
            zoom: 13,           
            mapTypeId: google.maps.MapTypeId.ROADMAP         
        },
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: image
        });
     
    var input = document.getElementById('searchTextField');         
    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["geocode"]
    });          
    
    autocomplete.bindTo('bounds', map); 
    var infowindow = new google.maps.InfoWindow(); 
 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  
        }
        
        moveMarker(place.name, place.geometry.location);
    }); 
    
    $(".searchMaps").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which === 13) {
                infowindow.close();
                var firstResult = $(".pac-container .pac-item:first").text();                
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({"address":firstResult }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);

                        moveMarker(placeName, latlng);
                        $(".searchMaps").val(firstResult);
                    }
                });
            }
        });
    });

    function moveMarker(placeName, latlng){
        marker.setIcon(image);
        marker.setPosition(latlng);
        infowindow.setContent(placeName);
        infowindow.open(map, marker);
        // console.log(latlng.lat());
        // console.log(latlng.lng());
        $("input[name='lat']").val(latlng.lat());
        $("input[name='lng']").val(latlng.lng());

     }
});
// end of Javascript Maps autocomplete    	
</script>
</div>