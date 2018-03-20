<?php 

class Model_order extends CI_Model
{

	function __construct(){
		parent::__construct();		
	}

	function create_get_id($table, $data)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();

	}

	function create($table, $data)
	{
		$this->db->insert($table, $data);
	}

}