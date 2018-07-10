<?php
class Pelanggan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('notif_model');
	}

	public function pelanggan()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pelanggan'] = $this->pelanggan_model->get_all();
		$data['title'] = 'Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pelanggan/list');
		$this->load->view('templates/footer');
	}

	public function blokir()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$data['pelanggan'] = $this->pelanggan_model->get_blokir();
		$data['title'] = 'Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pelanggan/blokir');
		$this->load->view('templates/footer');
	}

	public function aktifkan($pelanggan_id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$aktif = $this->pelanggan_model->aktifkan($pelanggan_id);
		if ($aktif) {
			$this->notif_model->aktifkan($pelanggan_id);
			redirect('pelanggan/pelanggan');
		} else {
			redirect('pelanggan/blokir');
		}
	}

	public function add()
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$this->form_validation->set_rules('telegram_id', 'Telegram ID', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = 'Tambah';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu', $data);
			$this->load->view('pelanggan/add');
			$this->load->view('templates/footer');
		} else {
			if ($this->pelanggan_model->is_pelanggan_not_active($this->input->post('telegram_id'))) {
				$this->notif_model->daftar($this->input->post('telegram_id'));
				$this->pelanggan_model->update($this->input->post('telegram_id'));
				$this->session->set_flashdata('add', 'Pelanggan berhasil ditambah.');
			} else {
				$this->pelanggan_model->add();
				$this->session->set_flashdata('add', 'Pelanggan berhasil ditambah.');
			}
			redirect('pelanggan/pelanggan');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$this->form_validation->set_rules('telegram_id', 'Telegram ID', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['pelanggan'] = $this->pelanggan_model->get_by_id($id);
			$data['title'] = 'Edit';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu', $data);
			$this->load->view('pelanggan/edit');
			$this->load->view('templates/footer');
		} else {
			$this->pelanggan_model->edit($id);
			$this->session->set_flashdata('edit', 'Pelanggan berhasil diedit.');
			redirect('pelanggan/pelanggan');
		}
	}

	public function delete($id)
	{
		if ($this->session->userdata('hak') != 'admin') {
			redirect('auth');
		}

		$status = $this->pelanggan_model->delete($id);
		if ($status) {
			redirect('pelanggan/pelanggan');
		} else {
			redirect('pelanggan/pelanggan');
		}
	}
}