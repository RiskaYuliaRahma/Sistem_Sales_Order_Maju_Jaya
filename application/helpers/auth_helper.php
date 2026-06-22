<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_role')) {
	function check_role($roles = [])
	{
		$ci =& get_instance();
		if (!$ci->session->userdata('logged_in')) {
			redirect('login');
		}
		if (!empty($roles) && !in_array($ci->session->userdata('role'), $roles)) {
			show_error('Anda tidak memiliki akses ke halaman ini', 403);
		}
	}
}

if (!function_exists('is_logged_in')) {
	function is_logged_in()
	{
		$ci =& get_instance();
		return $ci->session->userdata('logged_in') === TRUE;
	}
}
