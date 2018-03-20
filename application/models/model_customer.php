<?php 

class Model_customer extends CI_Model
{
// not edited
	function __construct(){
		parent::__construct();		
	}

	function create(){
		$this->db->insert("order",array("item"=>"",
										 "harga"=>"",
										 "keterangan"=>""
										));
		return $this->db->insert_id();
	}


	function read(){
		$this->db->order_by("id","asc");
		$query=$this->db->get("barang");
		return $query->result_array();
	}


	function update($id,$value,$modul){
		$this->db->where(array("id"=>$id));
		$this->db->update("barang",array($modul=>$value));
	}

	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("barang");
	}

	function show_my_order($id)
	{
		$this->db->select('o.id, nama, alamat, ordered_at, total, status_id, choose_to_id, no_hp');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.choose_to_id=u.id', 'left');
		$this->db->join('user_profiles u_p', 'u_p.user_id=u.id', 'left');
		$this->db->where('ordered_by_id =', $id);
		$this->db->order_by('ordered_at', 'desc');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function show_order_details($order_id)
	{
		$this->db->select('status_id, item, harga, qty, harga_total_item');
		$this->db->from('orders o');
		$this->db->join('order_details o_d', 'o.id=o_d.order_id', 'inner');
		$this->db->join('barang b', 'b.id=o_d.barang_id', 'inner');
		$this->db->where('order_id =', $order_id);
		$query = $this->db->get(); 
		return $query->result_array();
	}

	public function send_feedback($order_id, $komentar, $rating)
	{
		$data = array(
		   'order_id' => $order_id,
		   'komentar' => $komentar,
		   'rating' => $rating
		);

		$this->db->insert('feedbacks', $data); 
	}

	public function my_history($cust_id)
	{
		$this->db->select('nama, alamat, total, ordered_at, komentar, rating');
		$this->db->from('orders o');
		$this->db->join('feedbacks f', 'o.id=f.order_id', 'left');
		$this->db->join('users u', 'o.choose_to_id=u.id', 'inner');
		$this->db->join('user_profiles u_p', 'u.id=u_p.user_id', 'inner');
		$this->db->where('ordered_by_id', $cust_id);
		$query = $this->db->get();
		return $query->result_array();
	}


}