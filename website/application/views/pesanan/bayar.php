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
		<th width="19">Telegram ID</th>
		<th width="19%">Nama</th>
		<th width="16%">Lapang</th>
		<th width="16%">Jam Mulai</th>
		<th width="16%">Harga</th>
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
		</tr>
		<?php
		$no++;
	}
	?>
</table>