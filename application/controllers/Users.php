<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		check_role(['admin', 'manager']);
		$this->load->model('User_model');
	}
	public function index()
	{
		$data['title'] = 'Data Sales';
		$data['search'] = $this->input->get('search');
		$data['users'] = $this->User_model->get_all_sales($data['search']);
		$this->load->view('templates/backend/header', $data);
		$this->load->view('users/index', $data);
		$this->load->view('templates/backend/footer');
	}
	public function create()
	{
		$data['title'] = 'Tambah Sales';
		$this->load->view('templates/backend/header', $data);
		$this->load->view('users/create');
		$this->load->view('templates/backend/footer');
	}
	public function store()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Sales';
			$this->load->view('templates/backend/header', $data);
			$this->load->view('users/create');
			$this->load->view('templates/backend/footer');
		} else {
			$this->User_model->create([
				'username'  => $this->input->post('username'),
				'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'full_name' => $this->input->post('full_name'),
				'role'      => 'sales'
			]);
			$this->session->set_flashdata('success', 'Sales berhasil ditambahkan');
			redirect('users');
		}
	}
	public function edit($id)
	{
		$data['title'] = 'Edit Sales';
		$data['user'] = $this->User_model->get_by_id($id);
		if (!$data['user'] || $data['user']->role != 'sales') show_404();
		$this->load->view('templates/backend/header', $data);
		$this->load->view('users/edit', $data);
		$this->load->view('templates/backend/footer');
	}
	public function update($id)
	{
		$user = $this->User_model->get_by_id($id);
		if (!$user || $user->role != 'sales') show_404();
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		if ($this->input->post('username') != $user->username) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		}
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Sales';
			$data['user'] = $user;
			$this->load->view('templates/backend/header', $data);
			$this->load->view('users/edit', $data);
			$this->load->view('templates/backend/footer');
		} else {
			$update_data = [
				'username'  => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
			];
			$password = $this->input->post('password');
			if ($password) {
				$update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
			}
			$this->User_model->update($id, $update_data);
			$this->session->set_flashdata('success', 'Sales berhasil diupdate');
			redirect('users');
		}
	}
	public function delete($id)
	{
		$user = $this->User_model->get_by_id($id);
		if ($user && $user->role == 'sales') {
			$this->User_model->delete($id);
			$this->session->set_flashdata('success', 'Sales berhasil dihapus');
		}
		redirect('users');
	}
}
