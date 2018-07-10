<?php 
if ($this->session->flashdata('profile_edit')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('profile_edit'); ?>
	</div>
	<?php
}
?>
<table class="profil">
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $profile->profile_nama; ?></td>
	</tr>
	<tr>
		<td>Jam Buka</td>
		<td>:</td>
		<td><?php echo $profile->jam_buka; ?></td>
	</tr>
	<tr>
		<td>Jam Tutup</td>
		<td>:</td>
		<td><?php echo $profile->jam_tutup; ?></td>
	</tr>
	<tr>
		<td>Harga</td>
		<td>:</td>
		<td><?php echo $profile->harga; ?></td>
	</tr>
</table>
<a class="btn btn-hijau" 
	href="<?php echo base_url('pengaturan/edit/'.$profile->profile_id); ?>">Edit
</a>