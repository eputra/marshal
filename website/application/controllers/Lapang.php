<?php
class Lapang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('login');
		}

		$data['title'] = 'Lapang';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('templates/footer');
	}
}