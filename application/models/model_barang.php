<?php 

class Model_barang extends CI_Model
{
// not edited
	function __construct(){
		parent::__construct();		
	}

	function create(){
		$this->db->insert("barang", array("item"=>"",
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


}