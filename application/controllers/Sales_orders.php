<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_orders extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role(['admin', 'sales']);
		$this->load->model('Sales_order_model');
		$this->load->model('Product_model');
		$this->load->model('Customer_model');
	}
	public function index()
	{
		$data['title'] = 'Sales Order';
		$data['search'] = $this->input->get('search');
		$data['orders'] = $this->Sales_order_model->get_all(
			$this->session->userdata('user_id'),
			$this->session->userdata('role'),
			$data['search']
		);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('sales_orders/index', $data);
		$this->load->view('templates/backend/footer');
	}
	public function create()
	{
		$data['title'] = 'Buat Sales Order';
		$data['customers'] = $this->Customer_model->get_all();
		$data['products'] = $this->Product_model->get_all();
		$data['order_number'] = $this->Sales_order_model->generate_order_number();
		$this->load->view('templates/backend/header', $data);
		$this->load->view('sales_orders/create', $data);
		$this->load->view('templates/backend/footer');
	}
	public function store()
	{
		$this->form_validation->set_rules('customer_id', 'Pelanggan', 'required|integer');
		$this->form_validation->set_rules('order_date', 'Tanggal Order', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Buat Sales Order';
			$data['customers'] = $this->Customer_model->get_all();
			$data['products'] = $this->Product_model->get_all();
			$data['order_number'] = $this->Sales_order_model->generate_order_number();
			$this->load->view('templates/backend/header', $data);
			$this->load->view('sales_orders/create', $data);
			$this->load->view('templates/backend/footer');
		} else {
			$product_ids = $this->input->post('product_id');
			$quantities  = $this->input->post('quantity');
			if (empty($product_ids) || empty($quantities)) {
				$this->session->set_flashdata('error', 'Minimal harus memilih satu produk');
				redirect('sales_orders/create');
			}
			$items = [];
			foreach ($product_ids as $i => $pid) {
				if ($pid && $quantities[$i] > 0) {
					$product = $this->Product_model->get_by_id($pid);
					if ($product) {
						$items[] = [
							'product_id' => $pid,
							'quantity'   => $quantities[$i],
							'unit_price' => $product->price
						];
					}
				}
			}
			if (empty($items)) {
				$this->session->set_flashdata('error', 'Tidak ada item valid untuk diproses');
				redirect('sales_orders/create');
			}
			$data = [
				'order_number' => $this->Sales_order_model->generate_order_number(),
				'customer_id'  => $this->input->post('customer_id'),
				'created_by'   => $this->session->userdata('user_id'),
				'order_date'   => $this->input->post('order_date'),
				'notes'        => $this->input->post('notes'),
				'status'       => 'draft'
			];
			$order_id = $this->Sales_order_model->create_order($data, $items);
			if ($order_id) {
				$this->session->set_flashdata('success', 'Sales Order berhasil dibuat');
				redirect('sales_orders/show/'.$order_id);
			} else {
				$this->session->set_flashdata('error', 'Gagal membuat sales order');
				redirect('sales_orders/create');
			}
		}
	}
	public function show($id)
	{
		$data['title'] = 'Detail Sales Order';
		$data['order'] = $this->Sales_order_model->get_by_id($id);
		if (!$data['order']) show_404();
		$data['items'] = $this->Sales_order_model->get_items($id);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('sales_orders/show', $data);
		$this->load->view('templates/backend/footer');
	}
	public function edit($id)
	{
		$data['title'] = 'Edit Sales Order';
		$data['order'] = $this->Sales_order_model->get_by_id($id);
		if (!$data['order']) show_404();
		$data['customers'] = $this->Customer_model->get_all();
		$data['products'] = $this->Product_model->get_all();
		$data['items'] = $this->Sales_order_model->get_items($id);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('sales_orders/edit', $data);
		$this->load->view('templates/backend/footer');
	}
	public function update($id)
	{
		$order = $this->Sales_order_model->get_by_id($id);
		if (!$order) show_404();
		$this->Sales_order_model->update_order($id, [
			'customer_id' => $this->input->post('customer_id'),
			'order_date'  => $this->input->post('order_date'),
			'notes'       => $this->input->post('notes')
		]);
		$this->session->set_flashdata('success', 'Sales Order berhasil diupdate');
		redirect('sales_orders/show/'.$id);
	}
	public function delete($id)
	{
		$this->Sales_order_model->delete_order($id);
		$this->session->set_flashdata('success', 'Sales Order berhasil dihapus');
		redirect('sales_orders');
	}
	public function change_status($id)
	{
		$status = $this->input->post('status');
		$allowed = ['draft', 'dikirim', 'selesai', 'dibatalkan'];
		if (in_array($status, $allowed)) {
			$this->Sales_order_model->update_status($id, $status);
			$this->session->set_flashdata('success', 'Status berhasil diubah');
		}
		redirect('sales_orders/show/'.$id);
	}
}
