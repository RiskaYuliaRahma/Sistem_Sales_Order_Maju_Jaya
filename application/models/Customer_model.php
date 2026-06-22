<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function count_all()
	{
		return $this->db->count_all('customers');
	}

	public function get_all($search = null)
	{
		if ($search) {
			$this->db->group_start();
			$this->db->like('name', $search);
			$this->db->or_like('phone', $search);
			$this->db->group_end();
		}
		return $this->db->order_by('name', 'ASC')->get('customers')->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('customers', ['id' => $id])->row();
	}

	public function create($data)
	{
		$this->db->insert('customers', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('customers', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('customers');
	}
}
