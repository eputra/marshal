<?php
class Bayar extends CI_Controller {

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

		$data['pesanan'] = $this->pesanan_model->get_paid_today();
		$data['title'] = 'Bayar';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('bayar', $data);
		$this->load->view('templates/footer');
	}

}
?>