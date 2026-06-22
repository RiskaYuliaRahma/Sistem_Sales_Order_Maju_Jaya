<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role(['admin']);
		$this->load->model('Customer_model');
	}
	public function index()
	{
		$data['title'] = 'Data Pelanggan';
		$data['search'] = $this->input->get('search');
		$data['customers'] = $this->Customer_model->get_all($data['search']);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('customers/index', $data);
		$this->load->view('templates/backend/footer');
	}
	public function create()
	{
		$data['title'] = 'Tambah Pelanggan';
		$this->load->view('templates/backend/header', $data);
		$this->load->view('customers/create');
		$this->load->view('templates/backend/footer');
	}
	public function store()
	{
		$this->form_validation->set_rules('name', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('phone', 'No. Telepon', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Pelanggan';
			$this->load->view('templates/backend/header', $data);
			$this->load->view('customers/create');
			$this->load->view('templates/backend/footer');
		} else {
			$this->Customer_model->create([
				'name'    => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone'   => $this->input->post('phone')
			]);
			$this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan');
			redirect('customers');
		}
	}
	public function edit($id)
	{
		$data['title'] = 'Edit Pelanggan';
		$data['customer'] = $this->Customer_model->get_by_id($id);
		if (!$data['customer']) show_404();
		$this->load->view('templates/backend/header', $data);
		$this->load->view('customers/edit', $data);
		$this->load->view('templates/backend/footer');
	}
	public function update($id)
	{
		$customer = $this->Customer_model->get_by_id($id);
		if (!$customer) show_404();
		$this->form_validation->set_rules('name', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('phone', 'No. Telepon', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Pelanggan';
			$data['customer'] = $customer;
			$this->load->view('templates/backend/header', $data);
			$this->load->view('customers/edit', $data);
			$this->load->view('templates/backend/footer');
		} else {
			$this->Customer_model->update($id, [
				'name'    => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone'   => $this->input->post('phone')
			]);
			$this->session->set_flashdata('success', 'Pelanggan berhasil diupdate');
			redirect('customers');
		}
	}
	public function delete($id)
	{
		$this->Customer_model->delete($id);
		$this->session->set_flashdata('success', 'Pelanggan berhasil dihapus');
		redirect('customers');
	}
}
