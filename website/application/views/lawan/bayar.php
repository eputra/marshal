<?php
if ($this->session->flashdata('bayar')) {
	?>
	<div class="bg-success pesan">
		<?php echo $this->session->flashdata('bayar'); ?>
	</div>
	<?php
}
?>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="tunggu"){echo "aktif";} ?>" 
	href="<?php echo base_url('lawan/tunggu'); ?>">Tunggu
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="bayar"){echo "aktif";} ?>" 
	href="<?php echo base_url('lawan/bayar'); ?>">Bayar
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="batal"){echo "aktif";} ?>" 
	href="<?php echo base_url('lawan/batal'); ?>">Batal
</a>
<table>
	<tr>
		<th width="10%">NO</th>
		<th width="19">Telegram ID</th>
		<th width="19%">Nama</th>
		<th width="16%">Lapang</th>
		<th width="16%">Jam Mulai</th>
		<th width="16%">Harga</th>
	</tr>
	<?php
	$no = 1;
	foreach ($lawan as $lawan) {
		?>
		<tr>
			<td rowspan="2"><?= $no; ?></td>
			<td><?= $lawan->p1_id; ?></td>
			<td><?= $lawan->p1_nama; ?></td>
			<td rowspan="2"><?= $lawan->lapang_nama; ?></td>
			<td rowspan="2"><?= $lawan->jam_mulai; ?></td>
			<td rowspan="2">Rp<?= $lawan->harga; ?>.000,00</td>
		</tr>
		<tr>
			<td><?= $lawan->p2_id; ?></td>
			<td><?= $lawan->p2_nama; ?></td>
		</tr>
		<?php
		$no++;
	}
	?>
</table>