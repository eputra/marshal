<?php
	require_once("koneksi.php");
	require_once("profile.php");

	function get_jadwal_kosong_today()
	{
		date_default_timezone_set("Asia/Bangkok");
		$jam_sekarang	= date('G');
		$tanggal 		= date('Y-m-d');
		$jadwal_marshal = get_jadwal_marshal();
		$jadwal_booked 	= [];
		
		$pesanan_query 	= "select * from pesanan where status='WAIT' and tanggal='$tanggal'";
		$pesanan 		= mysql_query($pesanan_query);
		while ($pesanan_data = mysql_fetch_object($pesanan)) {
			array_push($jadwal_booked, $pesanan_data->jam_mulai);
		}

		$lawan_query	="select * from lawan where status='WAIT' and tanggal='$tanggal'";
		$lawan 			= mysql_query($lawan_query);
		while ($lawan_data = mysql_fetch_object($lawan)) {
			array_push($jadwal_booked, $lawan_data->jam_mulai);
		}
		
		$jadwal_kosong = array_diff($jadwal_marshal, $jadwal_booked);
		$jadwal_kosong_fix = [];
		foreach ($jadwal_kosong as $jam_mulai) {
			if ($jam_mulai > $jam_sekarang) {
				array_push($jadwal_kosong_fix, $jam_mulai);
			}
		}
		return $jadwal_kosong_fix;
	}

	function add_pesanan($data) {
		$data = (object) $data;
		$query = "insert into pesanan values('NULL','$data->pelanggan_id','1','$data->jam_mulai','$data->tanggal','WAIT','$data->harga')";
		$add_pesanan = mysql_query($query);
		return $add_pesanan;
	}

	function get_pesanan_wait($pelanggan_id)
	{
		$tanggal = date('Y-m-d');
		$query = "select * from pesanan where tanggal='$tanggal' and pelanggan_id='$pelanggan_id' and status='WAIT'";
		$hasil = mysql_fetch_object(mysql_query($query));
		return $hasil;
	}

	function get_pesanan_by_id($pelanggan_id)
	{
		$tanggal = date('Y-m-d');
		$query = "select * from pesanan where tanggal='$tanggal' and pelanggan_id='$pelanggan_id'";
		$hasil = mysql_fetch_object(mysql_query($query));
		return $hasil;
	}

	function batal($pesanan_id, $pelanggan_id)
	{
		$query = "update pesanan set status='CANCEL' where pesanan_id='$pesanan_id'";
		$status = mysql_query($query);

		$query2 = "update pelanggan set jumlah_batal=(jumlah_batal+1) where pelanggan_id='$pelanggan_id'";
		$status2 = mysql_query($query2);
	}

	function is_pesanan_cancel($pelanggan_id) {
		$tanggal = date('Y-m-d');
		$query = "select * from pesanan where tanggal='$tanggal' and pelanggan_id='$pelanggan_id' and status='CANCEL'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_pesanan_paid($pelanggan_id) {
		$tanggal = date('Y-m-d');
		$query = "select * from pesanan where tanggal='$tanggal' and pelanggan_id='$pelanggan_id' and status='PAID'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_pesanan_double($pelanggan_id)
	{
		$tanggal = date('Y-m-d');
		$query = "select * from pesanan where tanggal='$tanggal' and pelanggan_id='$pelanggan_id'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_cari_double($pelanggan_id)
	{
		$tanggal = date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan1_id='$pelanggan_id'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_lawan_double($pelanggan_id)
	{
		$tanggal = date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan2_id='$pelanggan_id'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
?>