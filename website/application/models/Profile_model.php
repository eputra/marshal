<?php
class Profile_model extends CI_Model {
	public function get_profile()
	{
		$this->db->select('*');
		$this->db->from('profile');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_profile_id($profile_id)
	{
		$this->db->where('profile_id', $profile_id);
		$this->db->select('*');
		$this->db->from('profile');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_profile($profile_id)
	{
		$data = array(
			'profile_nama' => $this->input->post('nama'),
			'jam_buka' => $this->input->post('jam_buka'),
			'jam_tutup' => $this->input->post('jam_tutup'),
			'harga' => $this->input->post('harga')
		);

		$this->db->where('profile_id', $profile_id);
		$this->db->update('profile', $data);
	}
}
?>