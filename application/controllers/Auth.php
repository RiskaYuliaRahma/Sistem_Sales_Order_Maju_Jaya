<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	public function login()
	{
		if ($this->session->userdata('logged_in')) redirect('dashboard');
		if ($_POST) {
			$user = $this->User_model->get_by_username($this->input->post('username'));
			if ($user && password_verify($this->input->post('password'), $user->password)) {
				$this->session->set_userdata(['user_id'=>$user->id,'username'=>$user->username,'full_name'=>$user->full_name,'role'=>$user->role,'logged_in'=>TRUE]);
				$this->session->set_flashdata('success', 'Selamat datang, ' . $user->full_name . '!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error','Username atau password salah');
				redirect('login');
			}
		}
		$data['title'] = 'Login';
		$this->load->view('templates/auth/header', $data);
		$this->load->view('auth/login');
		$this->load->view('templates/auth/footer');
	}
	public function logout() { $this->session->sess_destroy(); redirect('login'); }
}
