<?php
if ($this->session->flashdata('add')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('add'); ?>
	</div>
	<?php
}

if ($this->session->flashdata('edit')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('edit'); ?>
	</div>
	<?php
}

if ($this->session->flashdata('delete_')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('delete'); ?>
	</div>
	<?php
}
?>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="pelanggan"){echo "aktif";} ?>" 
	href="<?php echo base_url('pelanggan/pelanggan'); ?>">Pelanggan
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="blokir"){echo "aktif";} ?>" 
	href="<?php echo base_url('pelanggan/blokir'); ?>">Blokir
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="add"){echo "aktif";} ?>" 
	href="<?php echo base_url('pelanggan/add'); ?>">Tambah
</a>
<table>
	<tr>
		<th width='10%'>NO</th>
		<th width='19%'>Telegram ID</th>
		<th width='19%'>Nama</th>
		<th width='16%'>Alamat</th>
		<th width='16%'>Batal</th>
		<th width='16%'>Aksi</th>
	</tr>
	<?php
	$no = 1;
	foreach ($pelanggan as $pelanggan) {
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $pelanggan->pelanggan_id; ?></td>
			<td><?php echo $pelanggan->pelanggan_nama; ?></td>
			<td><?php echo $pelanggan->alamat; ?></td>
			<td><?php echo $pelanggan->jumlah_batal; ?></td>
			<td>
				<a class="btn btn-success btn-sm" 
					href="<?php echo base_url('pelanggan/aktifkan/'.$pelanggan->pelanggan_id); ?>">Aktifkan
				</a>
			</td>
		</tr>
		<?php
		$no++;
	}
	?>
</table>