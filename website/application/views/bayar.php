<table>
	<tr>
		<th width="10%">NO</th>
		<th width="19">Telegram ID</th>
		<th width="19%">Nama</th>
		<th width="16%">Lapang</th>
		<th width="16%">Jam</th>
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
			<td><?php echo $pemesan->jam_mulai ?> - <?php echo $pemesan->jam_mulai + 1; ?></td>
			<td>Rp<?php echo $pemesan->harga; ?>.000,00</td>
		</tr>
		<?php
		$no++;
	}
	?>
</table>