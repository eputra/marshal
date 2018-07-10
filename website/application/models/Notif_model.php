<?php
class Notif_model extends CI_Model {
	private $bot_token;
	private $telegram_api;

	public function __construct()
	{
		parent::__construct();
		$this->bot_token 	= "YOUR API TOKEN";
		$this->telegram_api = "https://api.telegram.org/bot".$this->bot_token;

		$this->load->model('pesanan_model');
		$this->load->model('util_model');
		$this->load->model('pelanggan_model');
		$this->load->model('lawan_model');
	}

	public function kirim($chat_id, $text)
	{
		$telegram_api = $this->telegram_api;
		file_get_contents($telegram_api."/sendmessage?chat_id=".$chat_id."&text=".$text);
	}

	public function aktifkan($pelanggan_id)
	{
		$pelanggan = $this->pelanggan_model->get_by_id($pelanggan_id);
		$text = "Selamat saudara ".$pelanggan->pelanggan_nama." akun Anda telah aktif kembali.";
		$this->kirim($pelanggan->chat_id, $text);
	}

	public function daftar($pelanggan_id)
	{
		$pelanggan = $this->pelanggan_model->get_by_id($pelanggan_id);
		$text = "Selamat saudara ".$pelanggan->pelanggan_nama." pendaftara akun Telegram Anda di sistem Marshal berhasil. Untuk mengetahui bagaimana cara menggunakan sistem Marshal ini, silahkan ketik bantuan.";
		$this->kirim($pelanggan->chat_id, $text);
	}

	public function bayar($pesanan_id, $chat_id)
	{
		$pesanan 		= $this->pesanan_model->get_by_id($pesanan_id);
		$jam_selesai	= $pesanan->jam_mulai+1;
		$tanggal 		= $this->util_model->pecah_tanggal($pesanan->tanggal);
		$text			= "Terima kasih saudara ".$pesanan->pelanggan_nama." pembayaran Anda sebesar Rp".$pesanan->harga.".000,00 untuk penyewaan lapangan futsal selama 1 jam, dari jam ".$pesanan->jam_mulai."-".$jam_selesai." pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun." telah kami terima.";
		$this->kirim($chat_id, $text);
	}

	public function lawan_bayar($id) {
		$pelanggan = $this->lawan_model->get_versus_today_id($id);
		$tanggal = $this->util_model->pecah_tanggal($pelanggan->tanggal);
		$jam_selesai = $pelanggan->jam_mulai + 1;
		$chat_id1 = $pelanggan->p1_chat_id;
		$chat_id2 = $pelanggan->p2_chat_id;
		$text1 = "Terima kasih saudara ".$pelanggan->p1_nama." pembayaran Anda dan saudara ".$pelanggan->p2_nama." (@".$pelanggan->p2_id.") sebesar Rp".$pelanggan->harga.".000,00 untuk penyewaan lapangan futsal selama 1 jam, dari jam ".$pelanggan->jam_mulai."-".$jam_selesai." pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun." telah kami terima.";
		$text2 = "Terima kasih saudara ".$pelanggan->p2_nama." pembayaran Anda dan saudara ".$pelanggan->p1_nama." (@".$pelanggan->p1_id.") sebesar Rp".$pelanggan->harga.".000,00 untuk penyewaan lapangan futsal selama 1 jam, dari jam ".$pelanggan->jam_mulai."-".$jam_selesai." pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun." telah kami terima.";
		$this->kirim($pelanggan->p1_chat_id, $text1);
		$this->kirim($pelanggan->p2_chat_id, $text2);
	}

	public function lawan_batal($id)
	{
		$pelanggan = $this->lawan_model->get_versus_today_id($id);
		$tanggal = $this->util_model->pecah_tanggal($pelanggan->tanggal);
		$text1 = "";
		$text2 = "";
		if ($pelanggan->p1_batal == 3) {
			$text1 = "Mohon maaf saudara ".$pelanggan->p1_nama." akun Anda diblokir karena sudah 3 kali melakukan pembatalan penyewaan lapangan futsal. Untuk mengaktifkan akun Anda kembali silahkan datang ke Marshal.";
		} else {
			$text1 = "Saudara ".$pelanggan->p1_nama." Anda telah membatalkan penyewaan lapangan futsal yang disewa pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun.". Dengan ini jumlah pembatalan penyewaan lapangan futsal Anda sebanyak ".$pelanggan->p1_batal." kali. Jika jumlah pembatalan telah mencapai 3 kali, maka akun Anda akan diblokir. Untuk mengaktifkan akun Anda kembali, Anda harus datang ke Marshal.";
		}
		if ($pelanggan->p2_batal == 3) {
			$text2 = "Mohon maaf saudara ".$pelanggan->p2_nama." akun Anda diblokir karena sudah 3 kali melakukan pembatalan penyewaan lapangan futsal. Untuk mengaktifkan akun Anda kembali silahkan datang ke Marshal.";
		} else {
			$text2 = "Saudara ".$pelanggan->p2_nama." Anda telah membatalkan penyewaan lapangan futsal yang disewa pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun.". Dengan ini jumlah pembatalan penyewaan lapangan futsal Anda sebanyak ".$pelanggan->p2_batal." kali. Jika jumlah pembatalan telah mencapai 3 kali, maka akun Anda akan diblokir. Untuk mengaktifkan akun Anda kembali, Anda harus datang ke Marshal.";
		}
		$this->kirim($pelanggan->p1_chat_id, $text1);
		$this->kirim($pelanggan->p2_chat_id, $text2);
	}


	public function batal($pesanan_id, $chat_id)
	{
		$pesanan 	= $this->pesanan_model->get_by_id($pesanan_id);
		$tanggal 	= $this->util_model->pecah_tanggal($pesanan->tanggal);
		$text = "";
		if ($pesanan->jumlah_batal == 3) {
			$text = "Mohon maaf saudara ".$pesanan->pelanggan_nama." akun Anda diblokir karena sudah 3 kali melakukan pembatalan penyewaan lapangan futsal. Untuk mengaktifkan akun Anda kembali silahkan datang ke Marshal.";
		} else {
			$text 		= "Saudara ".$pesanan->pelanggan_nama." Anda telah membatalkan penyewaan lapangan futsal yang disewa pada tanggal ".$tanggal->tanggal."/".$tanggal->bulan."/".$tanggal->tahun.". Dengan ini jumlah pembatalan penyewaan lapangan futsal Anda sebanyak ".$pesanan->jumlah_batal." kali. Jika jumlah pembatalan telah mencapai 3 kali, maka akun Anda akan diblokir. Untuk mengaktifkan akun Anda kembali, Anda harus datang ke Marshal.";
		}
		$this->kirim($chat_id, $text);
	}
}
?>