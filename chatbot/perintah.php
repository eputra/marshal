<?php
	require_once("waktu.php");
	require_once("message/pesanan.php");
	require_once("model/pelanggan.php");
	require_once("model/pesanan.php");
	require_once("model/profile.php");

	function perintah($nama_depan, $nama_belakang, $text, $chat_id, $pelanggan_id) {
		if ($text == "/start" && $pelanggan_id == "") {
			$pelanggan_nama = $nama_depan." ".$nama_belakang;
			return "Selamat datang ".$pelanggan_nama.". Untuk saat ini Anda masih belum bisa menggunakan sistem Marshal karena akun Telegram Anda belum terdaftar di sistem Marshal. Selain itu Username atau Telegram ID akun Telegram Anda juga belum diatur, silahkan atur terlebih dahulu Username atau Telegram ID Anda dengan cara: 1. Kembali ke menu utama Telegram terlebih dahulu; 2. Klik menu yang di pojok kiri atas; 3. Klik settings; 4. Di menu info Anda klik Username; 5. Masukan username untuk akun Telegram Anda; 6. Jika sudah memasukan Username untuk akun Telegram Anda, klik ceklis yang di pojok kanan atas. Jika Anda kesulitan untuk mengatur username akun Telegram Anda, silahan datang ke Marshal, nanti petugas kami akan membantu Anda. Username Telegram ini akan menjadi Telegram ID Anda ketika nanti mendaftar di Marshal. Selanjutnya Anda tinggal datang ke Marshal untuk mendaftarkan akun Telegram Anda di sistem Marshal.";
		}

		if ($pelanggan_id == "") {
			$pelanggan_nama = $nama_depan." ".$nama_belakang;
			return "Untuk saat ini Anda masih belum bisa menggunakan sistem Marshal karena akun Telegram Anda belum terdaftar di sistem Marshal. Selain itu Username atau Telegram ID akun Telegram Anda juga belum diatur, silahkan atur terlebih dahulu Username atau Telegram ID Anda dengan cara: 1. Kembali ke menu utama Telegram terlebih dahulu; 2. Klik menu yang di pojok kiri atas; 3. Klik settings; 4. Di menu info Anda klik Username; 5. Masukan username untuk akun Telegram Anda; 6. Jika sudah memasukan Username untuk akun Telegram Anda, klik ceklis yang di pojok kanan atas. Jika Anda kesulitan untuk mengatur username akun Telegram Anda, silahan datang ke Marshal, nanti petugas kami akan membantu Anda. Username Telegram ini akan menjadi Telegram ID Anda ketika nanti mendaftar di Marshal. Selanjutnya Anda tinggal datang ke Marshal untuk mendaftarkan akun Telegram Anda di sistem Marshal.";
		}		

		if ($text == "/start" && is_pelanggan($pelanggan_id) == FALSE) {
			$pelanggan_nama = $nama_depan." ".$nama_belakang;
			$data = array(
				'pelanggan_id' => $pelanggan_id,
				'chat_id' => $chat_id,
				'pelanggan_nama' => $pelanggan_nama
			);
			add_pelanggan($data);
			return "Selamat datang ".$pelanggan_nama.". Untuk saat ini Anda masih belum bisa menggunakan sistem Marshal ini karena akun Telegram Anda belum terdaftar di sistem Marshal. Silahkan datang ke Marshal untuk mendaftarkan akun Telegram Anda dengan Telegram ID : ".$pelanggan_id.".";
		}

		if ($text == "/start" && is_pelanggan($pelanggan_id)) {
			$data = array(
				'chat_id' => $chat_id,
				'pelanggan_id' => $pelanggan_id
			);
			add_chat_id($data);
			$pelanggan = get_pelanggan($pelanggan_id);
			return "Selamat datang ".$pelanggan->pelanggan_nama.". Silahkan ketik bantuan untuk mengetahui bagaimana cara menggunakan sistem Marshal ini.";
		}

		if (is_pelanggan($pelanggan_id) == FALSE) {
			$pelanggan_nama = $nama_depan." ".$nama_belakang;
			$data = array(
				'pelanggan_id' => $pelanggan_id,
				'chat_id' => $chat_id,
				'pelanggan_nama' => $pelanggan_nama
			);
			add_pelanggan($data);
			return "Maaf Anda tidak dapat menggunakan sistem Marshal karena akun Telegram Anda belum terdaftar di sistem Marshal. Silahkan datang ke Marshal untuk mendaftarkan akun Telegram Anda dengan Telegram ID : ".$pelanggan_id.".";
		}

		$pch_text	= explode(" ", $text);
		$cmd		= strtolower($pch_text[0]);
		switch ($cmd) {
			case 'pesan':
			case 'lawan':
			case 'cari':
				if (isset($pch_text[1])) {
					$jam_mulai	= $pch_text[1];
					if(preg_match("/^(\d\d?)\z/", $jam_mulai)) {
						if (sizeof(get_jadwal_kosong_today()) == 0) {
							return "Maaf pesanan tidak dapat diproses karena untuk jadwal hari ini sudah penuh, silahkan pesan kembali besok.";
						}
						return waktu($jam_mulai, $cmd, $chat_id, $pelanggan_id);
					} else {
						return "Format perintah yang benar adalah: ".$cmd." <jam mulai>";
					}
				} else {
					return "Format perintah yang benar adalah: ".$cmd." <jam mulai>";
				}
				break;
			case "kosong":
				if (sizeof(get_jadwal_kosong_today()) == 0) {
					return "Maaf untuk jadwal hari ini sudah penuh, silahkan pesan kembali besok.";
				}
				$jadwal_kosong = get_message_jadwal_kosong_today();
				return "Jadwal kosong: ".$jadwal_kosong.".";
			case "bantuan":
				$text = "*Perintah Chatbot Marshal*%0A%0A*pesan* `<jam mulai>`%0AUntuk memesan lapangan futsal.%0A%0A*cari* `<jam mulai>`%0AUntuk mencari lawan bertanding.%0A%0A*lawan* `<jam mulai>`%0AUntuk menerima lawan bertanding.%0A%0A*kosong*%0AUntuk melihat jadwal kosong.%0A%0A*info*%0AUntuk melihat informasi tentang Marshal.%0A%0A*status*%0AUntuk melihat status pemesanan hari ini.%0A%0A*batal*%0AUntuk membatalkan pemesanan, tetapi hanya bisa untuk membatalkan pemesanan yang dipesan dengan perintah *pesan*.%0A%0A*bantuan*%0AUntuk melihat perintah apa saja yang dimengerti oleh chatbot Marshal.";
				return $text;
			case "info":
				$profile = get_profile();
				$text = "Nama : Marshal%0AJam buka : ".$profile->jam_buka."%0AJam tutup : ".$profile->jam_tutup."%0AHarga : Rp".$profile->harga.".000/jam";
				return $text;
				break;
			case "status":
				if (is_lawan_by_pelanggan1($pelanggan_id)) {
					$lawan = get_lawan_by_pelanggan1($pelanggan_id);
					return "Hari ini Anda memiliki pesanan dengan saudara @".$lawan->pelanggan2_id." dengan status ".$lawan->status." pada jam ".$lawan->jam_mulai.".";
				}

				if (is_lawan_by_pelanggan2($pelanggan_id)) {
					$lawan = get_lawan_by_pelanggan2($pelanggan_id);
					return "Hari ini Anda memiliki pesanan dengan saudara @".$lawan->pelanggan1_id." dengan status ".$lawan->status." pada jam ".$lawan->jam_mulai.".";
				}

				if (!is_pesanan_double($pelanggan_id)) {
					return "Anda belum memesan apapun hari ini.";
				}

				$pesanan = get_pesanan_by_id($pelanggan_id);
				$text = "Hari ini Anda memiliki pesanan dengan status ".$pesanan->status." pada jam ".$pesanan->jam_mulai.".";
				return $text;
				break;
			case "batal":
				if (!is_pesanan_double($pelanggan_id)) {
					return "Anda belum memesan apapun hari ini.";
				}
				if (is_pesanan_cancel($pelanggan_id)) {
					return "Pesanan Anda hari ini sudah dalam keadaan tercancel.";
				}
				if (is_pesanan_paid($pelanggan_id)) {
					return "Pesanan Anda hari ini sudah dibayar.";
				}
				$pesanan = get_pesanan_wait($pelanggan_id);
				$batal = batal($pesanan->pesanan_id, $pelanggan_id);
				$pelanggan = get_pelanggan($pelanggan_id);
				$text = "";
				if ($pelanggan->jumlah_batal == 3) {
					$text = "Mohon maaf saudara ".$pelanggan->pelanggan_nama." akun Anda diblokir karena sudah 3 kali melakukan pembatalan penyewaan lapangan futsal. Untuk mengaktifkan akun Anda kembali silahkan datang ke Marshal.";
				} else {
					$text = "Saudara ".$pelanggan->pelanggan_nama." Anda telah membatalkan penyewaan lapangan futsal yang disewa pada tanggal ".$pesanan->tanggal.". Dengan ini jumlah pembatalan penyewaan lapangan futsal Anda sebanyak ".$pelanggan->jumlah_batal." kali. Jika jumlah pembatalan telah mencapai 3 kali, maka akun Anda akan diblokir. Untuk mengaktifkan akun Anda kembali, Anda harus datang ke Marshal.";
				}
				return $text;
				break;
			default:
				return "Saya tidak mengerti perintah tersebut. Untuk melihat perintah apa saja yang saya mengerti, silahkan ketik bantuan.";
				break;
		}
	}
?>