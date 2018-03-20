<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Model_user extends CI_Model {
	
	public function cek_user($data) {

		$query = $this->db->get_where('users', $data);
		return $query;
	}
	public function add_user($table, $data)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}
	public function getUsersAndDeposit()
	{
		/*$this->db->select('u.id, u.nama, u.username, u.email, u.role_id, u.created_at, d.nominal, d.foto, d.created_at as uploaded_at, u.request_join, d.id as deposit_id');
		$this->db->from('users u');
		$this->db->join('deposit d', 'u.id=d.user_id', 'left');
		$this->db->where('u.role_id != 1');
		$this->db->order_by("uploaded_at","desc");		
		$this->db->group_by('');
		$this->db->distinct('id');
		// $this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();*/

		/*
		Ceritanya ini nyeleksi tabel users dan join ke tabel deposit
		dimana di deposit itu hanya menampilkan last insert dari bukti foto
		pengupload-an depositnya (created_at)
		GROUP BY nya user_id di tabel deposit
		a = users
		b = deposit
		c = GROUP BY user_id pada tabel deposit dan select created_at paling terakhir
		d = select tabel deposit
		*/
		$query = $this->db->query("
			SELECT 
				a.*, a.created_at as registered_at, b.*, b.created_at as uploaded_at
			FROM
				users a
			LEFT JOIN
				(SELECT d.id as deposit_id, d.user_id, d.nominal, d.foto, d.created_at
			     	FROM
			     		(SELECT
			             id, user_id, nominal, foto,
			             MAX(created_at) created_at
			             FROM deposit
			             GROUP BY user_id
			             ) c
			     JOIN
			     deposit d
			     ON c.user_id = d.user_id AND d.created_at = c.created_at
			     ) b
			ON a.id = b.user_id
			WHERE a.id != 1
			-- ORDER BY registered_at desc
		");

		return $query->result_array();
	}

	public function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
		$this->db->where(array('users.id' => $id));

		$query = $this->db->get();

		return $query->row_array();
	}

	public function get_user_profile($id)
	{
		$query = $this->db->get_where("user_profiles", "user_id = $id");
		return $query->result_array();
	}

	public function update_user($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);
		return $query;
	}

	public function getKoordinat($id)
	{
		$this->db->select('lat, lng');
		$this->db->from('user_profiles');
		$this->db->where('user_id', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function add_deposit($deposit_id, $inputValue)
	{
		// table, data[], where[]
		$query = $this->db->update('deposit', array('nominal'=>$inputValue), array('id'=>$deposit_id));
		return $query;
	}

}
