<?php
	require_once("koneksi.php");
	function is_blokir($pelanggan_id)
	{
		$query = "select * from pelanggan where jumlah_batal='3'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_pelanggan_active()
	{
		$query = "select * from pelanggan where active='1'";
		$pelanggan = mysql_query($query);
		return $pelanggan;
	}

	function get_pelanggan($pelanggan_id) {
		$query = "select * from pelanggan where pelanggan_id='$pelanggan_id'";
		$pelanggan = mysql_fetch_object(mysql_query($query));
		return $pelanggan;
	}

	function add_chat_id($data) {
		$data = (object) $data;
		$query = "update pelanggan set chat_id='$data->chat_id' where pelanggan_id='$data->pelanggan_id'";
		$add_chat_id = mysql_query($query);
		return $add_chat_id;
	}

	function is_pelanggan($pelanggan_id) {
		$query = "select * from pelanggan where pelanggan_id='$pelanggan_id' and active='1'";
		$result = mysql_query($query);
		$status = mysql_num_rows($result);
		if ($status == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_pelanggan($data) {
		$data = (object) $data;
		$query = "insert into pelanggan values('$data->pelanggan_id','$data->chat_id','$data->pelanggan_nama','NULL','0','0')";
		$simpan = mysql_query($query);
		return $simpan;
	}
?>