<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role();
	}
	public function index()
	{
		$this->load->model('Sales_order_model');
		$this->load->model('Product_model');
		$this->load->model('Customer_model');
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');

		$data['title'] = 'Dashboard';
		$data['total_orders'] = $this->Sales_order_model->count_all($user_id, $role);
		$data['total_products'] = $this->Product_model->count_all();
		$data['total_customers'] = $this->Customer_model->count_all();
		$data['total_revenue'] = $this->Sales_order_model->total_revenue($user_id, $role);
		$data['recent_orders'] = $this->Sales_order_model->get_recent(5, $user_id, $role);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/backend/footer');
	}
}
