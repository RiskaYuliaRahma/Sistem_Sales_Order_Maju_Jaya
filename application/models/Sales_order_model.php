<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order_model extends CI_Model {

	public function count_all($user_id = null, $role = null)
	{
		if ($role == 'sales' && $user_id) {
			$this->db->where('created_by', $user_id);
		}
		return $this->db->count_all_results('sales_orders');
	}

	public function total_revenue($user_id = null, $role = null)
	{
		$this->db->select_sum('total_amount');
		$this->db->where('status', 'selesai');
		if ($role == 'sales' && $user_id) {
			$this->db->where('created_by', $user_id);
		}
		$result = $this->db->get('sales_orders')->row();
		return $result->total_amount ?? 0;
	}

	public function get_recent($limit = 5, $user_id = null, $role = null)
	{
		$this->db->select('sales_orders.*, customers.name as customer_name, users.full_name as sales_name');
		$this->db->from('sales_orders');
		$this->db->join('customers', 'customers.id = sales_orders.customer_id');
		$this->db->join('users', 'users.id = sales_orders.created_by');
		if ($role == 'sales' && $user_id) {
			$this->db->where('sales_orders.created_by', $user_id);
		}
		$this->db->order_by('sales_orders.created_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function get_all($user_id = null, $role = null, $search = null)
	{
		$this->db->select('sales_orders.*, customers.name as customer_name, users.full_name as sales_name');
		$this->db->from('sales_orders');
		$this->db->join('customers', 'customers.id = sales_orders.customer_id');
		$this->db->join('users', 'users.id = sales_orders.created_by');
		if ($role == 'sales' && $user_id) {
			$this->db->where('sales_orders.created_by', $user_id);
		}
		if ($search) {
			$this->db->group_start();
			$this->db->like('sales_orders.order_number', $search);
			$this->db->or_like('customers.name', $search);
			$this->db->group_end();
		}
		$this->db->order_by('sales_orders.created_at', 'DESC');
		return $this->db->get()->result();
	}

	public function get_by_id($id)
	{
		$this->db->select('sales_orders.*, customers.name as customer_name, customers.address as customer_address, customers.phone as customer_phone, users.full_name as sales_name');
		$this->db->from('sales_orders');
		$this->db->join('customers', 'customers.id = sales_orders.customer_id');
		$this->db->join('users', 'users.id = sales_orders.created_by');
		$this->db->where('sales_orders.id', $id);
		return $this->db->get()->row();
	}

	public function get_items($order_id)
	{
		$this->db->select('order_items.*, products.code as product_code, products.name as product_name');
		$this->db->from('order_items');
		$this->db->join('products', 'products.id = order_items.product_id');
		$this->db->where('order_items.order_id', $order_id);
		return $this->db->get()->result();
	}

	public function create_order($data, $items)
	{
		$this->db->trans_start();

		$this->db->insert('sales_orders', $data);
		$order_id = $this->db->insert_id();

		foreach ($items as $item) {
			$this->db->insert('order_items', [
				'order_id'   => $order_id,
				'product_id' => $item['product_id'],
				'quantity'   => $item['quantity'],
				'unit_price' => $item['unit_price']
			]);

			$this->db->where('id', $item['product_id']);
			$this->db->set('stock', 'stock - ' . (int)$item['quantity'], FALSE);
			$this->db->update('products');
		}

		$this->db->trans_complete();
		return $this->db->trans_status() ? $order_id : false;
	}

	public function update_order($id, $data)
	{
		return $this->db->where('id', $id)->update('sales_orders', $data);
	}

	public function update_status($id, $status)
	{
		return $this->db->where('id', $id)->update('sales_orders', ['status' => $status]);
	}

	public function delete_order($id)
	{
		return $this->db->where('id', $id)->delete('sales_orders');
	}

	public function generate_order_number()
	{
		$prefix = 'SO/' . date('Y') . '/';
		$this->db->select_max('order_number');
		$this->db->like('order_number', $prefix, 'after');
		$last = $this->db->get('sales_orders')->row();

		if ($last && $last->order_number) {
			$num = (int)substr($last->order_number, -4) + 1;
		} else {
			$num = 1;
		}

		return $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
	}

	public function get_by_status($status, $user_id = null, $role = null)
	{
		$this->db->select('sales_orders.*, customers.name as customer_name, users.full_name as sales_name');
		$this->db->from('sales_orders');
		$this->db->join('customers', 'customers.id = sales_orders.customer_id');
		$this->db->join('users', 'users.id = sales_orders.created_by');
		$this->db->where('sales_orders.status', $status);
		if ($role == 'sales' && $user_id) {
			$this->db->where('sales_orders.created_by', $user_id);
		}
		$this->db->order_by('sales_orders.created_at', 'DESC');
		return $this->db->get()->result();
	}

	public function report_by_sales($start_date = null, $end_date = null)
	{
		$this->db->select('users.id, users.full_name, COUNT(sales_orders.id) as total_orders, SUM(sales_orders.total_amount) as total_revenue');
		$this->db->from('users');
		$this->db->join('sales_orders', 'sales_orders.created_by = users.id');
		$this->db->where('users.role', 'sales');
		if ($start_date && $end_date) {
			$this->db->where('sales_orders.order_date >=', $start_date);
			$this->db->where('sales_orders.order_date <=', $end_date);
		}
		$this->db->group_by('users.id');
		$this->db->order_by('total_revenue', 'DESC');
		return $this->db->get()->result();
	}

	public function report_by_product($start_date = null, $end_date = null)
	{
		$this->db->select('products.id, products.code, products.name, SUM(order_items.quantity) as total_qty, SUM(order_items.subtotal) as total_revenue');
		$this->db->from('order_items');
		$this->db->join('products', 'products.id = order_items.product_id');
		$this->db->join('sales_orders', 'sales_orders.id = order_items.order_id');
		$this->db->where('sales_orders.status !=', 'dibatalkan');
		if ($start_date && $end_date) {
			$this->db->where('sales_orders.order_date >=', $start_date);
			$this->db->where('sales_orders.order_date <=', $end_date);
		}
		$this->db->group_by('products.id');
		$this->db->order_by('total_qty', 'DESC');
		return $this->db->get()->result();
	}

	public function report_by_period($start_date, $end_date)
	{
		$this->db->select('DATE(order_date) as date, COUNT(id) as total_orders, SUM(total_amount) as total_revenue');
		$this->db->from('sales_orders');
		$this->db->where('order_date >=', $start_date);
		$this->db->where('order_date <=', $end_date);
		$this->db->where('status !=', 'dibatalkan');
		$this->db->group_by('DATE(order_date)');
		$this->db->order_by('date', 'ASC');
		return $this->db->get()->result();
	}
}
