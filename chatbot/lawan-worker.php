<?php
	require_once("koneksi.php");
	require_once("model/lawan.php");
	date_default_timezone_set("Asia/Bangkok");
	while (true) {
		$cari = get_cari_wait_worker();
		while ($data_cari=mysql_fetch_object($cari)) {
			$sekarang_timestamp = time();
			$selisih = $sekarang_timestamp - $data_cari->lawan_timestamp;
			if ($selisih > 60) {
				mysql_query("delete from lawan where lawan_id='$data_cari->lawan_id'");
				echo $data_cari->lawan_id."\n";
			}
		}
	}
?>