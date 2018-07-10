<?php
class Pelanggan_model extends CI_Model {
	public function is_pelanggan_not_active($pelanggan_id) {
		$data = array(
			'pelanggan_id' => $pelanggan_id,
			'active' => '0'
		);

		$query = $this->db->get_where('pelanggan', $data);

		if ($query->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_all()
	{
		$this->db->where('active', 1);
		$this->db->where('jumlah_batal <', 3);
		$this->db->select('*');
		$this->db->from('pelanggan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_blokir()
	{
		$this->db->where('active', 1);
		$this->db->where('jumlah_batal =', 3);
		$this->db->select('*');
		$this->db->from('pelanggan');
		$query = $this->db->get();
		return $query->result();
	}

	public function update($pelanggan_id)
	{
		$data = array(
			'pelanggan_nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'active' => 1
		);

		$this->db->where('pelanggan_id', $pelanggan_id);
		$this->db->update('pelanggan', $data);
	}

	public function add()
	{
		$data = array(
			'pelanggan_id' => $this->input->post('telegram_id'),
			'pelanggan_nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'jumlah_batal' => 0,
			'active' => 1
		);

		$this->db->insert('pelanggan', $data);
	}

	public function get_by_id($id)
	{
		$this->db->where('pelanggan_id', $id);
		$this->db->select('*');
		$this->db->from('pelanggan');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit($id)
	{
		$data = array(
			'pelanggan_id' => $this->input->post('telegram_id'),
			'pelanggan_nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('pelanggan_id', $id);
		$this->db->update('pelanggan', $data);
	}

	public function aktifkan($id)
	{
		$data = array('jumlah_batal' => 0);
		$this->db->where('pelanggan_id', $id);
		$status = $this->db->update('pelanggan', $data);
		if ($status) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete($id)
	{
		return $this->db->delete('pelanggan', array('pelanggan_id' => $id));
	}
}
?>