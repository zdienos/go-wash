<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
            <div class="well">
                <h3>Deposit Anda</h3>
                <?php if(empty($my_deposit['nominal']) || $my_deposit['nominal'] == ""): ?>
                    Anda belum memiliki saldo.
                <?php else: ?>
                    Saldo anda tersisa <b>Rp. <?php echo $my_deposit['nominal']; ?></b>
                <?php endif; ?>
                <hr>
                <h3>Bukti Anda</h3>
                <?php if(empty($my_deposit['foto']) || $my_deposit['foto'] == NULL || is_null($my_deposit['foto'])): ?>
                    Upload Bukti Foto Deposit Anda
                <?php else: ?>
                    <img class="foto" alt="<?php echo $my_deposit['foto']; ?>" src="<?php echo base_url('assets/uploads/'.$my_deposit['foto']); ?>" data-zoom-image="<?php echo base_url('assets/uploads/'.$my_deposit['foto']); ?>">
                <?php endif; ?>
                <hr>
                <h3>Upload Bukti Pembayaran Deposit</h3>
                <?php echo form_open_multipart('washer/do_upload_deposit');?>
                <input class="form-control" type="file" name="userfile">
                <input class="btn btn-default btn-block" type="submit" value="Upload">
                <?php echo form_close(); ?>
            </div>
    	</div>
    </div>
</div>
