<?php 

class Model_roles extends CI_Model
{

	function __construct(){
		parent::__construct();		
	}

	function create(){
		$this->db->insert("roles",array("nama"=>""));
		return $this->db->insert_id();
	}


	function read(){
		$this->db->order_by("id","asc");
		$query=$this->db->get("roles");
		return $query->result_array();
	}


	function update($id,$value,$modul){
		$this->db->where(array("id"=>$id));
		$this->db->update("roles",array($modul=>$value));
	}

	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("roles");
	}


}