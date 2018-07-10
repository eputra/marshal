<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
	public function pecah_tanggal($tanggal) {
		$pecah_tanggal 	= explode("-", $tanggal);
		$data 			= array(
			'tanggal'	=> $pecah_tanggal[2],
			'bulan' 	=> $pecah_tanggal[1],
			'tahun' 	=> $pecah_tanggal[0]
		);
		return (object)$data;
	}
}

/* End of file Util_model.php */
/* Location: ./application/models/Util_model.php */