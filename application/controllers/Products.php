<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role(['admin']);
		$this->load->model('Product_model');
	}
	public function index()
	{
		$data['title'] = 'Data Produk';
		$data['search'] = $this->input->get('search');
		$data['products'] = $this->Product_model->get_all($data['search']);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('products/index', $data);
		$this->load->view('templates/backend/footer');
	}
	public function create()
	{
		$data['title'] = 'Tambah Produk';
		$this->load->view('templates/backend/header', $data);
		$this->load->view('products/create');
		$this->load->view('templates/backend/footer');
	}
	public function store()
	{
		$this->form_validation->set_rules('code', 'Kode Produk', 'required|is_unique[products.code]');
		$this->form_validation->set_rules('name', 'Nama Produk', 'required');
		$this->form_validation->set_rules('price', 'Harga', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('stock', 'Stok', 'required|integer|greater_than_equal_to[0]');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Produk';
			$this->load->view('templates/backend/header', $data);
			$this->load->view('products/create');
			$this->load->view('templates/backend/footer');
		} else {
			$this->Product_model->create([
				'code'  => $this->input->post('code'),
				'name'  => $this->input->post('name'),
				'price' => str_replace(',', '', $this->input->post('price')),
				'stock' => $this->input->post('stock')
			]);
			$this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
			redirect('products');
		}
	}
	public function edit($id)
	{
		$data['title'] = 'Edit Produk';
		$data['product'] = $this->Product_model->get_by_id($id);
		if (!$data['product']) show_404();
		$this->load->view('templates/backend/header', $data);
		$this->load->view('products/edit', $data);
		$this->load->view('templates/backend/footer');
	}
	public function update($id)
	{
		$product = $this->Product_model->get_by_id($id);
		if (!$product) show_404();
		$this->form_validation->set_rules('name', 'Nama Produk', 'required');
		$this->form_validation->set_rules('price', 'Harga', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('stock', 'Stok', 'required|integer|greater_than_equal_to[0]');
		if ($this->input->post('code') != $product->code) {
			$this->form_validation->set_rules('code', 'Kode Produk', 'required|is_unique[products.code]');
		}
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Produk';
			$data['product'] = $product;
			$this->load->view('templates/backend/header', $data);
			$this->load->view('products/edit', $data);
			$this->load->view('templates/backend/footer');
		} else {
			$this->Product_model->update($id, [
				'code'  => $this->input->post('code'),
				'name'  => $this->input->post('name'),
				'price' => str_replace(',', '', $this->input->post('price')),
				'stock' => $this->input->post('stock')
			]);
			$this->session->set_flashdata('success', 'Produk berhasil diupdate');
			redirect('products');
		}
	}
	public function delete($id)
	{
		$this->Product_model->delete($id);
		$this->session->set_flashdata('success', 'Produk berhasil dihapus');
		redirect('products');
	}
}
