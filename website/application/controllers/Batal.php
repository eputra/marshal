<?php
class Batal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pesanan_model');
	}

	public function index()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pesanan'] = $this->pesanan_model->get_cancel_today();
		$data['title'] = 'Batal';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('batal/today');
		$this->load->view('templates/footer');
	}
}