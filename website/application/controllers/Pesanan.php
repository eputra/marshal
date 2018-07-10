<?php
class Pesanan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pesanan_model');
		$this->load->model('notif_model');
		$this->load->model('util_model');
	}

	public function tunggu()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pesanan'] = $this->pesanan_model->get_wait_today();
		$data['title'] = 'Tunggu';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pesanan/tunggu', $data);
		$this->load->view('templates/footer');
	}

	public function bayar()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pesanan'] = $this->pesanan_model->get_paid_today();
		$data['title'] = 'Bayar';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pesanan/bayar', $data);
		$this->load->view('templates/footer');
	}

	public function batal()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pesanan'] = $this->pesanan_model->get_cancel_today();
		$data['title'] = 'Batal';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pesanan/batal');
		$this->load->view('templates/footer');
	}

	public function set_bayar($pesanan_id, $chat_id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$bayar = $this->pesanan_model->bayar($pesanan_id);
		if ($bayar) {
			$this->notif_model->bayar($pesanan_id, $chat_id);
			redirect('pesanan/bayar');
		} else {
			redirect('pesanan/tunggu');
		}
	}

	public function set_batal($pesanan_id, $telegram_id, $chat_id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$batal = $this->pesanan_model->batal($pesanan_id, $telegram_id);
		if ($batal) {
			$this->notif_model->batal($pesanan_id, $chat_id);
			redirect('pesanan/batal');
		} else {
			redirect('pesanan/tunggu');
		}
	}
}
?>