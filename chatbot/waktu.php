<?php
	require_once("model/profile.php");
	require_once("model/pesanan.php");
	require_once("model/pelanggan.php");
	require_once("model/lawan.php");
	require_once("message/lawan.php");
	function waktu($jam_mulai, $cmd, $chat_id, $pelanggan_id) {
		date_default_timezone_set("Asia/Bangkok");
		$jam_sekarang	= date('G');
		$profile 		= get_profile();
		$tanggal 		= date('Y-m-d');
		$fsl_buka		= $profile->jam_buka;
		$fsl_tutup		= $profile->jam_tutup;
		$harga			= $profile->harga;

		if ($jam_mulai <= $jam_sekarang) {
			return "Maaf pesanan tidak dapat diproses. Sekarang jam ".$jam_sekarang." dan jam pemesanan lapangan futsal Anda adalah jam ".$jam_mulai.". Pemesanan lapangan futsal hanya dapat diproses jika jam pemesanan lebih besar dari jam sekarang.";
		}

		if ($jam_mulai < 1 || $jam_mulai > 24) {
			return "Format perintah yang benar adalah: ".$cmd." <jam mulai>";
		}

		if (is_blokir($pelanggan_id)) {
			return "Mohon maaf akun Mashal Anda saat ini sedang dalam keadaan terblokir karena Anda sudah 3 kali melakukan pembatalan penyewaan lapangan futsal. Untuk mengaktifkan akun Anda kembali silahkan datang ke Marshal.";
		}

		if (is_pesanan_double($pelanggan_id)) {
			return "Maaf Anda hanya dapat melakukan satu kali pemesanan lapang futsal untuk setiap harinya.";
		}

		if (is_cari_double($pelanggan_id)) {
			return "Maaf Anda hanya dapat melakukan satu kali pemesanan lapang futsal untuk setiap harinya.";
		}

		if (is_lawan_double($pelanggan_id)) {
			return "Maaf Anda hanya dapat melakukan satu kali pemesanan lapang futsal untuk setiap harinya.";
		}		

		if (!in_array($jam_mulai, get_jadwal_kosong_today())) {
			if ($cmd == "pesan" || $cmd == "cari") {
				return "Mohon maaf untuk jadwal jam ".$jam_mulai." sudah dipesan oleh orang lain. Untuk mengetahui jadwal yang kosong silahkan kirim pesan 'kosong'.";
			}
		} 

		if ($jam_mulai < $fsl_buka) {
			return "Futsal kami hanya buka pada jam ".$fsl_buka." sampai dengan ".$fsl_tutup;
		}

		if ($jam_mulai >= $fsl_tutup) {
			return "Futsal kami hanya buka pada jam ".$fsl_buka." sampai dengan ".$fsl_tutup;
		}

		switch ($cmd) {
			case "pesan":
				$data_pesanan = array(
					'pelanggan_id' => $pelanggan_id,
					'jam_mulai' => $jam_mulai,
					'tanggal' => $tanggal,
					'harga' => $harga
				);
				$add_pesanan = add_pesanan($data_pesanan);
				
				if ($add_pesanan) {
					return "Terima kasih pesanan anda telah diterima, seharga Rp. ".$harga.".000.";
				} else {
					return "Maaf sedang ada masalah dengan sistem.";
				}
				break;
			case "cari":
				$cari_lawan = array(
					'pelanggan1_id' => $pelanggan_id,
					'jam_mulai' => $jam_mulai,
					'tanggal' => $tanggal,
					'harga' => $harga,
					'lawan_timestamp' => time()
				);
				$add_cari = add_cari($cari_lawan);

				if ($add_cari) {
					return "Terima kasih pesanan anda telah diterima. Silahkan tunggu pesan berikutnya untuk info mengenai siapa yang akan menjadi lawan anda";
				} else {
					return "Maaf sedang ada masalah dengan sistem.";
				}
				break;
			case "lawan":
				if (is_lawan($jam_mulai)) {
					$cari = get_lawan_by_time($jam_mulai);
					$cari = (object) $cari;
					$data_lawan = array(
						'pelanggan2_id' => $pelanggan_id,
						'lawan_id' => $cari->lawan_id
					);
					$add_lawan = add_lawan($data_lawan);
					if ($add_lawan) {
						$profile_lawan = get_pelanggan($cari->pelanggan1_id);
						$profile_penerima = get_pelanggan($pelanggan_id);
						$data_notif = array(
							'cari_chat_id' => $profile_lawan->chat_id,
							'lawan_nama' => $profile_penerima->pelanggan_nama,
							'lawan_tel_id' => $profile_penerima->pelanggan_id
						);
						notif_lawan($data_notif);
						return "Selamat saudara ".$profile_lawan->pelanggan_nama." (@".$profile_lawan->pelanggan_id.") menjadi lawan Anda.";
					}
				} else {
					return "Maaf tidak ada yang mencari lawan pada jam ".$jam_mulai;
				}
				break;
		}
	}
?>