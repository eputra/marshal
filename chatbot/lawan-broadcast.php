<?php
	require_once("model/lawan.php");
	require_once("model/pelanggan.php");
	require_once("message/lawan.php");
	while (true) {
		$cari = get_cari_wait_broadcast();
		$pelanggan = get_pelanggan_active();
		while ($data_cari=mysql_fetch_object($cari)) {
			$profile_cari = get_pelanggan($data_cari->pelanggan1_id);
			$broadcast_to = [];
			while ($data_pelanggan=mysql_fetch_object($pelanggan)) {
				if ($data_cari->pelanggan1_id != $data_pelanggan->pelanggan_id) {
					$data_notif = array(
						'nama' 	=> $profile_cari->pelanggan_nama,
						'id' 	=> $profile_cari->pelanggan_id,
						'jam' 	=> $data_cari->jam_mulai,
						'chat_id' => $data_pelanggan->chat_id
					);
					notif_cari($data_notif);
					$data_broadcast = $data_pelanggan->pelanggan_nama." (@".$data_pelanggan->pelanggan_id.")";
					array_push($broadcast_to, $data_broadcast);
				}
			}
			set_broadcast($data_cari->lawan_id);
			echo "Sang pencari 	: ".$profile_cari->pelanggan_nama." (@".$profile_cari->pelanggan_id.")";
			echo "\nBroadcast to 	: ".implode(", ", $broadcast_to)."\n\n";
		}
	}
?>