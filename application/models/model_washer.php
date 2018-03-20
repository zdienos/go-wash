<?php 

class Model_washer extends CI_Model
{

	function __construct(){
		parent::__construct();		
	}
	public function show_who_orders($washer_id)
	{
		/* washer_id itu validasi
		kan tadinya user itu semuanya customer, ketika dia udah jadi washer maka dia ga bisa
		liat postingan order dari dia sendiri
		*/
		$this->db->select('o.id, nama, ordered_at, alamat, total, no_hp');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.ordered_by_id=u.id', 'inner');
		$this->db->join('user_profiles u_p', 'u_p.user_id=u.id', 'inner');
		// $this->db->join('order_claims o_c', 'o_c.order_id=o.id', 'left');
		$this->db->where('ordered_by_id !=', $washer_id);
		$this->db->where('status_id =', 1);
		$this->db->order_by('ordered_at', 'desc');
		// $this->db->where('claimed_by_id !=', $washer_id);
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function show_order_details($order_id)
	{
		$this->db->select('o.id as order_id, o_d.id, item, harga, qty, harga_total_item, total, status_id');
		$this->db->from('orders o');
		$this->db->join('order_details o_d', 'o.id=o_d.order_id', 'inner');
		$this->db->join('barang b', 'b.id=o_d.barang_id', 'inner');
		$this->db->where('order_id =', $order_id);
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function show_my_claims($washer_id)
	{
		$this->db->select('o.id, nama, ordered_at, alamat, total, status_id, no_hp');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.ordered_by_id=u.id', 'inner');
		$this->db->join('user_profiles u_p', 'u_p.user_id=u.id', 'inner');
		$this->db->where('ordered_by_id !=', $washer_id);
		$this->db->where('status_id >=', 2);
		$this->db->where('choose_to_id', $washer_id);

		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function claim_order($order_id, $washer_id)
	{
		$data = array(
			'choose_to_id'	=> $washer_id,
			'status_id'		=> 2
		);
		$this->db->where('id', $order_id);
		$query = $this->db->update('orders', $data);
		return $query;
	}
	
	public function checkIfClaimed($washer_id)
	{
		$this->db->select('status_id');
		$this->db->from('orders');
		// $this->db->where('status_id >=', 2);
		$this->db->where('choose_to_id', $washer_id);
		$query = $this->db->get();
		return $query->result_array();

	}

	/*public function skip_order($order_id, $washer_id)
	{
		$data = array(
			'order_id'		=> $order_id,
			'user_id'		=> $washer_id,
			'claim_status'	=> 2
		);
		$query = $this->db->insert('order_claims', $data);
		return $query;
	}*/

	public function update_detail_cucian($id, $value_qty, $value_total)
	{
		$this->db->where(array("id"=>$id));
		$this->db->update("order_details", array(
			"qty" => $value_qty,
			"harga_total_item" => $value_total
		));
	}

	public function update_total_order($order_id, $total_semua)
	{
		$this->db->where(array("id"=>$order_id));
		$this->db->update("orders", array(
			"total" => $total_semua
		));	
	}

	public function send_final_price($order_id)
	{
		$this->db->where(array("id"=>$order_id));
		$this->db->update("orders", array(
			"status_id" => "3"
		));
	}

	public function payment_confirmation($order_id)
	{
		$this->db->where(array("id"=>$order_id));
		$this->db->update("orders", array(
			"status_id" => "4"
		));
	}

	public function finish_confirmation($order_id)
	{
		$this->db->where(array("id"=>$order_id));
		$this->db->update("orders", array(
			"status_id" => "5"
		));
	}

	public function my_history($washer_id)
	{
		$this->db->select('nama, alamat, total, ordered_at, komentar, rating');
		$this->db->from('orders o');
		$this->db->join('feedbacks f', 'o.id=f.order_id', 'left');
		$this->db->join('users u', 'o.ordered_by_id=u.id', 'inner');
		$this->db->join('user_profiles u_p', 'u.id=u_p.user_id', 'inner');
		$this->db->where('choose_to_id', $washer_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getSumTotal($washer_id)
	{
		$this->db->select('SUM(total) as sum_total');
		$this->db->from('orders');
		$this->db->where('choose_to_id', $washer_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getAverageRating($washer_id)
	{
		$this->db->select('AVG(rating) as rating_avg');
		$this->db->from('orders o');
		$this->db->join('feedbacks f', 'o.id=f.order_id', 'left');
		$this->db->where('choose_to_id', $washer_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function upload_deposit($washer_id, $file_name)
	{
		$data = array(
		   'user_id' => $washer_id,
		   'nominal' => '',
		   'foto' => $file_name,
		   'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('deposit', $data);
		return $this->db->insert_id();
	}

	public function show_my_deposit($washer_id)
	{
		// nampilin foto deposit berdasarkan insert paling terakhir

		$this->db->select('foto, nominal');
		$this->db->from('deposit d');
		$this->db->where('user_id', $washer_id);
		$this->db->order_by('created_at', 'asc');
		$query = $this->db->get();
		return $query->last_row('array');
		// return $ret->foto;
	}


	

}
