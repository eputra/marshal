<?php
class Pesanan_model extends CI_Model {
	public function get_wait_today()
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('lapang', 'lapang.lapang_id = pesanan.lapang_id');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = pesanan.pelanggan_id');
		$this->db->where('status', 'WAIT');
		$query = $this->db->get();
		return $query->result();
	}


	public function get_paid_today()
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('lapang', 'lapang.lapang_id = pesanan.lapang_id');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = pesanan.pelanggan_id');
		$this->db->where('status', 'PAID');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_cancel_today()
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('lapang', 'lapang.lapang_id = pesanan.lapang_id');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = pesanan.pelanggan_id');
		$this->db->where('status', 'CANCEL');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($pesanan_id)
	{
		$this->db->select('*');
		$this->db->from('pesanan');
		$this->db->join('lapang', 'lapang.lapang_id = pesanan.lapang_id');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = pesanan.pelanggan_id');
		$this->db->where('pesanan_id', $pesanan_id);
		return $this->db->get()->row();
	}

	public function bayar($pesanan_id)
	{
		$data = array('status' => 'PAID');
		$this->db->where('pesanan_id', $pesanan_id);
		$is_bayar_update = $this->db->update('pesanan', $data);
		if ($is_bayar_update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function batal($pesanan_id, $pelanggan_id)
	{
		$data = array('status' => 'CANCEL');
		$this->db->where('pesanan_id', $pesanan_id);
		$is_status_update = $this->db->update('pesanan', $data);

		$this->db->where('pelanggan_id', $pelanggan_id);
		$this->db->set('jumlah_batal', 'jumlah_batal+1', FALSE);
		$is_batal_update = $this->db->update('pelanggan');

		if ($is_status_update && $is_batal_update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>