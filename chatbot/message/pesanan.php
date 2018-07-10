<?php
	require_once("koneksi.php");
	require_once("model/pesanan.php");

	function get_message_jadwal_kosong_today()
	{
		$jadwal_kosong = get_jadwal_kosong_today();
		$message = implode(", ", $jadwal_kosong);
		return $message;
	}
?>