<div class="container">
    <div class="row">
    	<div class="col-md-6 col-md-offset-3" style="text-align: center;">
	    <?php if($request_join == 1): ?>
	    	You have requested to be a washer. Waiting for admin confirmation...
	    <?php else: ?>
    		<h2>Gabung menjadi washer sekarang !!!</h2>
    		<h4>Syarat dan Ketentuan Washer Go Wash</h4>
    		<div class="well" style="text-align: justify;">
	    		<div style="overflow-y: auto; height: 300px;">
	    			<?php echo form_open('customer/do_join') ?>
	    			<p>Syarat :</p>
	    			<ol>
	    				<li>Memiliki alat-alat yang telah ditentukan oleh GoWash</li>
	    				<li>Memiliki sertifikat laundry yang terverifikasi oleh GoWash</li>
	    			</ol>
	    			<p>Pastikan anda memiliki akun yang tervalidasi dan tetap menggunakan akun yang sudah ada. kami akan terus memantau anda demi kenyamanan dan keamanan pengguna. saya menerima tindakan lebih lanjut jika saya melanggar peraturan yang telan di jelaskan dibawah ini :</p>
	    			<p>Dengan ini saya menyetujui segala apa yang telah ditentukan oleh go wash, jika ada hal yang dapat melanggar peraturan yang berlaku maka saya menerima segala bentuk tindakan.</p>
	    			<ol>
	    				<li>Menggunakan kalimat yang tidak sopan</li>
	    				<li>Bersikap melanggar hukum</li>
	    				<li>Mencemarkan nama baik</li>
	    				<li>Tidak terima penilaian yang telah dibeikan customer</li>
	    			</ol>

	    			<p>Ketentuan :</p>
	    			<ol>
	    				<li>Harus mempunyai akun yang jelas</li>
						<li>wajib mengisi nama / judul toko dengan jelas, singkat dan padat.</li>
						<li>Memiliki dan melengkapi ketentuan yang telah ditentukan oleh GOWASH.
						<li>washer wajib mengisi harga yang sesuai.
						<li>washer tidak diperkenankan mencantumkan alamat (e-mail, situs, forum), nomor kontak, ID / PIN / username social media, dan pengisian selain pada kolom yang disediakan.
						<li>washer wajib mengisi kolom yang sudah di sediakan sesuai dengan Aturan Penggunaan di GoWash.</li>
						<li>washer dilarang membuat transaksi fiktif atau palsu demi kepentingan menaikkan feedback. Bukalapak berhak mengambil tindakan seperti pemblokiran akun atau tindakan lainnya apabila ditemukan tindakan kecurangan.</li>
						<li>washer wajib menggunakan layananya sesuai deskripsi yang telah di jelaskan pada profil.</li>
						<li>washer wajib menghargai keluhan yang diberikan customer kepada washer (feedback positif/negatif).</li>
						<li>Apabila washer tidak memberikan pelayanan yang telah ditetukan, maka GoWash berhak atas tindakan pemberhentian jasa di platform GoWash.</li>
						<li>washer wajib memenuhi ketentuan yang sudah ditetapkan oleh GoWash.</li>
	    			</ol>
		    	</div>

		    	<div class="row">
		    		<div class="checkbox col-md-6">
		    			<label><input type="checkbox" name="agree" class="form-controller" required>Saya setuju</label>
		    		</div>
		    		<?php echo form_error('agree'); ?>

		    		<div class="col-md-6" style="text-align: right; padding-top: 10px;">
		    			<button type="submit" class="btn btn-success btn-sm">Gabung</button>
		    		</div>
		    	</div>

	    		

	    		<?php echo form_close(); ?>
    		</div> <!-- end of well -->
    	<?php endif; ?>
    	</div>
    </div>
</div>
