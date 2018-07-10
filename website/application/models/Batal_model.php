<?php
class Batal_model extends CI_Model {
	public function get_batal()
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('lapang', 'lapang.id_lapang = pesanan.id_lapang');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan');
		$this->db->where('status', 2);
		$query = $this->db->get();
		return $query->result();
	}

	public function batal($id_pesanan, $id_pelanggan)
	{
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->set('batal', 'batal+1', FALSE);
		$this->db->update('pelanggan');

		$data2 = array('status' => '2');
		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->update('pesanan', $data2);
	}
}
?>