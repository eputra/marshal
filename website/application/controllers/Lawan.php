<?php
class Lawan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lawan_model');
		$this->load->model('notif_model');
	}

	public function tunggu()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['lawan'] = $this->lawan_model->get_versus_today();
		$data['title'] = 'Tunggu';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('lawan/tunggu');
		$this->load->view('templates/footer');
	}

	public function bayar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['lawan'] = $this->lawan_model->get_paid_today();
		$data['title'] = 'Bayar';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('lawan/bayar');
		$this->load->view('templates/footer');
	}

	public function batal()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}
		$data['lawan'] = $this->lawan_model->get_cancel_today();
		$data['title'] = 'Batal';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('lawan/batal');
		$this->load->view('templates/footer');
	}

	public function set_bayar($id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$bayar = $this->lawan_model->bayar($id);
		if ($bayar) {
			$this->notif_model->lawan_bayar($id);
			redirect('lawan/bayar');
		} else {
			redirect('lawan/tunggu');
		}
	}

	public function set_batal($lawan_id, $pelanggan1_id, $pelanggan2_id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$batal = $this->lawan_model->batal($lawan_id, $pelanggan1_id, $pelanggan2_id);
		if ($batal) {
			$this->notif_model->lawan_batal($lawan_id);
			redirect('lawan/batal');
		} else {
			redirect('lawan/tunggu');
		}
	}
}