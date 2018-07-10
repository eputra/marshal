<?php
	require_once("koneksi.php");
	function add_cari($data) {
		$data = (object) $data;
		$query = "insert into lawan(pelanggan1_id,lapang_id,jam_mulai,tanggal,status,harga,lawan_timestamp) values('$data->pelanggan1_id','1','$data->jam_mulai','$data->tanggal','WAIT','$data->harga','$data->lawan_timestamp')";
		$simpan = mysql_query($query);
		return $simpan;
	}

	function add_lawan($data) {
		$data = (object) $data;
		$query = "update lawan set pelanggan2_id='$data->pelanggan2_id', status='VERSUS' where lawan_id='$data->lawan_id'";
		$simpan = mysql_query($query);
		return $simpan;
	}

	function is_lawan_by_pelanggan1($id) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan1_id='$id'";
		$hasil = mysql_query($query);
		$status = mysql_num_rows($hasil);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_lawan_by_pelanggan1($id) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan1_id='$id'";
		$hasil = mysql_fetch_object(mysql_query($query));
		return $hasil;
	}

	function is_lawan_by_pelanggan2($id) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan2_id='$id'";
		$hasil = mysql_query($query);
		$status = mysql_num_rows($hasil);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_lawan_by_pelanggan2($id) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where tanggal='$tanggal' and pelanggan2_id='$id'";
		$hasil = mysql_fetch_object(mysql_query($query));
		return $hasil;
	}


	function get_lawan_by_time($jam_mulai) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where status='WAIT' and tanggal='$tanggal' and jam_mulai='$jam_mulai'";
		$result = mysql_fetch_object(mysql_query($query));
		return $result;
	}

	function is_lawan($jam_mulai) {
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query = "select * from lawan where status='WAIT' and tanggal='$tanggal' and jam_mulai='$jam_mulai'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_cari_wait_broadcast()
	{
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query 		= "select * from lawan where status='WAIT' and tanggal='$tanggal' and broadcast='0'";
		$cari 		= mysql_query($query);
		return $cari;
	}

	function get_cari_wait_worker()
	{
		date_default_timezone_set("Asia/Bangkok");
		$tanggal 	= date('Y-m-d');
		$query 		= "select * from lawan where status='WAIT' and tanggal='$tanggal'";
		$cari 		= mysql_query($query);
		return $cari;
	}

	function set_broadcast($id)
	{
		$query = "update lawan set broadcast='1' where lawan_id='$id'";
		$change = mysql_query($query);
		return $change;
	}
?>