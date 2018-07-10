<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?php echo base_url('pelanggan/edit/'.$pelanggan->pelanggan_id); ?>">
	<div class="form-group">
		<label for="input_telegram_id" class="control-label">ID Telegram</label>
		<input type="text" class="form-control" id="input_telegram_id" name="telegram_id" value="<?= $pelanggan->pelanggan_id; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="input_nama" class="control-label">Nama</label>
		<input type="text" class="form-control" id="input_nama" name="nama" value="<?= $pelanggan->pelanggan_nama; ?>" required>
	</div>
	<div class="form-group">
		<label for="inputAlamat" class="control-label">Alamat</label>
		<textarea class="form-control" id="input_nama" name="alamat" rows="6"><?= $pelanggan->alamat; ?></textarea>
	</div>
	<button type="submit" class="btn btn-warning">
		Edit
	</button>
</form>