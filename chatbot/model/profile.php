<?php
	require_once("koneksi.php");

	function get_profile()
	{
		$profile = mysql_fetch_object(mysql_query("select * from profile"));
		return $profile;
	}

	function get_jadwal_marshal()
	{
		$profile = get_profile();
		$jadwal_marshal = [];
		for ($i=$profile->jam_buka; $i<$profile->jam_tutup; $i++) {
			array_push($jadwal_marshal, $i);
		}
		return $jadwal_marshal;
	}
?>