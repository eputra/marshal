<?php
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') == 'admin') {
			redirect('pesanan');
		}
		else {
			$data['title'] = "Marshal";
			$this->load->view('auth', $data);
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			redirect('auth');
		} 
		else {
			$auth = $this->auth_model->auth();
			if ($auth) {
				$get_admin = $this->auth_model->get_admin();
				$row_admin = $get_admin->row();

				$session_admin = array(
					'hak' => 'admin',
					'user' => $row_admin->user
				);

				$this->session->set_userdata($session_admin);
				redirect('pesanan/tunggu');
			}
			else {
				$this->session->set_flashdata('failed_login', 'Username atau password salah.');
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}