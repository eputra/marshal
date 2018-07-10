<form class="add-form" data-toggle="validator" role="form" method="post" 
	action="<?php echo base_url('pengaturan/edit/'.$profile->profile_id); ?>">
	<div class="form-group">
		<label for="inputNama" class="control-label">Nama</label>
		<input type="text" class="form-control" id="inputNama" name="nama" value="<?= $profile->profile_nama; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputJamBuka" class="control-label">Jam Buka</label>
		<input type="text" pattern="^[6-9]{1}$" class="form-control" id="inputJamBuka" name="jam_buka" value="<?= $profile->jam_buka; ?>" required>
	</div>
	<div class="form-group">
		<label for="inputJamTutup" class="control-label">Jam Tutup</label>
		<input type="text" pattern="^[18-24]{1}$" class="form-control" id="inputJamTutup" name="jam_tutup" value="<?= $profile->jam_tutup; ?>" required>
	</div>
	<div class="form-group">
		<label for="inputHarga" class="control-label">Harga</label>
		<input type="text" class="form-control" id="inputHarga" name="harga" value="<?= $profile->harga; ?>" required>
	</div>
	<button type="submit" class="btn btn-warning">
		Edit
	</button>
</form>