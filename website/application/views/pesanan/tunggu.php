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
	href="<?php echo base_url('pesanan/tunggu'); ?>">Tunggu
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="bayar"){echo "aktif";} ?>" 
	href="<?php echo base_url('pesanan/bayar'); ?>">Bayar
</a>
<a class="btn btn-hijau <?php if($this->uri->segment(2)=="batal"){echo "aktif";} ?>" 
	href="<?php echo base_url('pesanan/batal'); ?>">Batal
</a>
<table>
	<tr>
		<th width="10%">NO</th>
		<th width="16">Telegram ID</th>
		<th width="16%">Nama</th>
		<th width="14%">Lapang</th>
		<th width="14%">Jam Mulai</th>
		<th width="14%">Harga</th>
		<th width="14%">Aksi</th>
	</tr>
	<?php
	$no = 1;
	foreach ($pesanan as $pemesan) {
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $pemesan->pelanggan_id; ?></td>
			<td><?php echo $pemesan->pelanggan_nama; ?></td>
			<td><?php echo $pemesan->lapang_nama; ?></td>
			<td><?php echo $pemesan->jam_mulai ?></td>
			<td>Rp<?php echo $pemesan->harga; ?>.000,00</td>
			<td>
				<a class="btn btn-success btn-sm" 
					href="<?php echo base_url('pesanan/set_bayar/'.$pemesan->pesanan_id."/".$pemesan->chat_id); ?>">Bayar
				</a>
				<a class="btn btn-danger btn-sm" 
					href="<?php echo base_url('pesanan/set_batal/'.$pemesan->pesanan_id."/".$pemesan->pelanggan_id."/".$pemesan->chat_id); ?>">Batal
				</a>
			</td>
		</tr>
		<?php
		$no++;
	}
	?>
</table>