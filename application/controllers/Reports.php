<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role(['admin', 'manager']);
		$this->load->model('Sales_order_model');
	}
	public function index()
	{
		$data['title'] = 'Laporan Penjualan';
		$this->load->view('templates/backend/header', $data);
		$this->load->view('reports/index');
		$this->load->view('templates/backend/footer');
	}
	public function sales()
	{
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$data['title'] = 'Laporan Per Sales';
		$data['reports'] = $this->Sales_order_model->report_by_sales($start_date, $end_date);
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('templates/backend/header', $data);
		$this->load->view('reports/sales', $data);
		$this->load->view('templates/backend/footer');
	}
	public function products()
	{
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$data['title'] = 'Laporan Per Produk';
		$data['reports'] = $this->Sales_order_model->report_by_product($start_date, $end_date);
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('templates/backend/header', $data);
		$this->load->view('reports/products', $data);
		$this->load->view('templates/backend/footer');
	}
	public function period()
	{
		$start_date = $this->input->get('start_date') ?: date('Y-m-01');
		$end_date = $this->input->get('end_date') ?: date('Y-m-t');
		$data['title'] = 'Laporan Per Periode';
		$data['reports'] = $this->Sales_order_model->report_by_period($start_date, $end_date);
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('templates/backend/header', $data);
		$this->load->view('reports/period', $data);
		$this->load->view('templates/backend/footer');
	}
	public function export_pdf()
	{
		$this->load->library('pdf');
		$type = $this->input->get('type');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		switch ($type) {
			case 'sales':
				$data['reports'] = $this->Sales_order_model->report_by_sales($start_date, $end_date);
				$html = $this->load->view('reports/pdf_sales', $data, true);
				break;
			case 'products':
				$data['reports'] = $this->Sales_order_model->report_by_product($start_date, $end_date);
				$html = $this->load->view('reports/pdf_products', $data, true);
				break;
			case 'period':
			default:
				$data['reports'] = $this->Sales_order_model->report_by_period($start_date, $end_date);
				$html = $this->load->view('reports/pdf_period', $data, true);
				break;
		}
		$this->pdf->generate($html, 'laporan-penjualan');
	}
}
