<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawan_model extends CI_Model {
	public function get_cancel_today()
	{
		$query = $this->db->query("
			select
				l.*,

				p1.pelanggan_id as p1_id,
				p1.chat_id as p1_chat_id,
				p1.pelanggan_nama as p1_nama,

				p2.pelanggan_id as p2_id,
				p2.chat_id as p2_chat_id,
				p2.pelanggan_nama as p2_nama,

				lap.lapang_nama
			from 
				lawan l 
				inner join pelanggan p1 on 
					l.pelanggan1_id = p1.pelanggan_id
				inner join pelanggan p2 on
					l.pelanggan2_id = p2.pelanggan_id
				inner join lapang lap on
					l.lapang_id = lap.lapang_id
			where 
				l.status = 'CANCEL'
			");
		return $query->result();
	}

	public function get_paid_today()
	{
		$query = $this->db->query("
			select
				l.*,

				p1.pelanggan_id as p1_id,
				p1.chat_id as p1_chat_id,
				p1.pelanggan_nama as p1_nama,

				p2.pelanggan_id as p2_id,
				p2.chat_id as p2_chat_id,
				p2.pelanggan_nama as p2_nama,

				lap.lapang_nama
			from 
				lawan l 
				inner join pelanggan p1 on 
					l.pelanggan1_id = p1.pelanggan_id
				inner join pelanggan p2 on
					l.pelanggan2_id = p2.pelanggan_id
				inner join lapang lap on
					l.lapang_id = lap.lapang_id
			where 
				l.status = 'PAID'
			");
		return $query->result();
	}

	public function get_versus_today()
	{
		$query = $this->db->query("
			select
				l.*,

				p1.pelanggan_id as p1_id,
				p1.chat_id as p1_chat_id,
				p1.pelanggan_nama as p1_nama,
				p1.jumlah_batal as p1_batal,

				p2.pelanggan_id as p2_id,
				p2.chat_id as p2_chat_id,
				p2.pelanggan_nama as p2_nama,
				p2.jumlah_batal as p2_batal,

				lap.lapang_nama
			from 
				lawan l 
				inner join pelanggan p1 on 
					l.pelanggan1_id = p1.pelanggan_id
				inner join pelanggan p2 on
					l.pelanggan2_id = p2.pelanggan_id
				inner join lapang lap on
					l.lapang_id = lap.lapang_id
			where 
				l.status = 'VERSUS'
			");
		return $query->result();
	}

	public function get_versus_today_id($id)
	{
		$query = $this->db->query("
			select
				l.*,

				p1.pelanggan_id as p1_id,
				p1.chat_id as p1_chat_id,
				p1.pelanggan_nama as p1_nama,
				p1.jumlah_batal as p1_batal,

				p2.pelanggan_id as p2_id,
				p2.chat_id as p2_chat_id,
				p2.pelanggan_nama as p2_nama,
				p2.jumlah_batal as p2_batal,

				lap.lapang_nama
			from 
				lawan l 
				inner join pelanggan p1 on 
					l.pelanggan1_id = p1.pelanggan_id
				inner join pelanggan p2 on
					l.pelanggan2_id = p2.pelanggan_id
				inner join lapang lap on
					l.lapang_id = lap.lapang_id
			where 
				l.lawan_id = '$id'
			");
		return $query->row();	
	}

	public function bayar($id)
	{
		$data = array('status' => 'PAID');
		$this->db->where('lawan_id', $id);
		$is_bayar_update = $this->db->update('lawan', $data);
		if ($is_bayar_update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function batal($lawan_id, $pelanggan1_id, $pelanggan2_id)
	{
		$data = array('status' => 'CANCEL');
		$this->db->where('lawan_id', $lawan_id);
		$is_status_update = $this->db->update('lawan', $data);

		$this->db->where('pelanggan_id', $pelanggan1_id);
		$this->db->set('jumlah_batal', 'jumlah_batal+1', FALSE);
		$is_batal1_update = $this->db->update('pelanggan');

		$this->db->where('pelanggan_id', $pelanggan2_id);
		$this->db->set('jumlah_batal', 'jumlah_batal+1', FALSE);
		$is_batal2_update = $this->db->update('pelanggan');

		if ($is_status_update && $is_batal1_update && $is_batal2_update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Lawan_model.php */
/* Location: ./application/models/Lawan_model.php */