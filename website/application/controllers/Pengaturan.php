<?php
class Pengaturan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('login');
		}

		$data['profile'] = $this->profile_model->get_profile();
		$data['title'] = 'Pengaturan';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pengaturan/profile');
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('login');
		}

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('jam_buka', 'Jam Buka', 'required');
		$this->form_validation->set_rules('jam_tutup', 'Jam Tutup', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['profile'] = $this->profile_model->get_profile_id($id);
			$data['title'] = 'Edit Profile';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu', $data);
			$this->load->view('pengaturan/edit');
			$this->load->view('templates/footer');
		} else {
			$this->profile_model->edit_profile($id);
			$this->session->set_flashdata('profile_edit', 'Profile berhasil diedit.');
			redirect('pengaturan');
		}		
	}
}