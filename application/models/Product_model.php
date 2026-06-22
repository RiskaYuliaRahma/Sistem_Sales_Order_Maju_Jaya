<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function count_all()
	{
		return $this->db->count_all('products');
	}

	public function get_all($search = null)
	{
		if ($search) {
			$this->db->group_start();
			$this->db->like('name', $search);
			$this->db->or_like('code', $search);
			$this->db->group_end();
		}
		return $this->db->order_by('name', 'ASC')->get('products')->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('products', ['id' => $id])->row();
	}

	public function create($data)
	{
		$this->db->insert('products', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('products', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('products');
	}

	public function get_by_code($code)
	{
		return $this->db->get_where('products', ['code' => $code])->row();
	}
}
