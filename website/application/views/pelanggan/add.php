<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?php echo base_url('pelanggan/add'); ?>">
	<div class="form-group">
		<label for="input_telegram_id" class="control-label">Telegram ID</label>
		<input type="text" class="form-control" id="input_telegram_id" name="telegram_id" required>
	</div>
	<div class="form-group">
		<label for="input_nama" class="control-label">Nama</label>
		<input type="text" class="form-control" id="input_nama" name="nama" required>
	</div>
	<div class="form-group">
		<label for="inputAlamat" class="control-label">Alamat</label>
		<textarea class="form-control" id="input_nama" name="alamat" rows="6"></textarea>
	</div>
	<button type="submit" class="btn btn-hijau">
		Tambah
	</button>
</form>