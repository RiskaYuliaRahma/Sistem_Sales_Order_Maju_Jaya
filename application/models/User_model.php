<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_by_username($username)
	{
		return $this->db->get_where('users', ['username' => $username])->row();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('users', ['id' => $id])->row();
	}

	public function get_all_sales($search = null)
	{
		if ($search) {
			$this->db->group_start();
			$this->db->like('username', $search);
			$this->db->or_like('full_name', $search);
			$this->db->group_end();
		}
		return $this->db->where('role', 'sales')->order_by('full_name', 'ASC')->get('users')->result();
	}

	public function create($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('users', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('users');
	}
}
