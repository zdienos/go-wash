<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Kelas Admin.
* untuk pengaturan seperti daftar barang laundry, harga barang laundry, dll
*/
session_start();
class Admin extends CI_Controller
{
	var $header = 'admin/header';

	public function __construct()
	{
		parent::__construct();
		
		$role = $this->session->userdata('role');
		if ($role == FALSE) {
			redirect('auth');
		} elseif ($role == '2') {
			redirect('customer');
		} elseif ($role == '3') {
			redirect('washer');
		}

		$this->load->helper('text');
		$this->load->model('model_roles','');
		$this->load->model('model_barang','',TRUE);
		$this->load->model('model_user','',TRUE);
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['header'] = $this->header;
		$data['page'] = 'admin/dashboard';

		$this->load->view('layout/app', $data);
		// $this->load->view('admin/header');
		// $this->load->view('admin/dashboard', array(
		// 	"username"=>$data['username'],
		// ));	
	}

	/*
		CRUD Roles
	*/
	public function role()
	{
		$data = array(
			"roles" 	=> $this->model_roles->read(),
			"username"	=> $this->session->userdata('username')
		);
		$data['header'] = $this->header;
		$data['page'] = 'admin/role';

		$this->load->view('layout/app', $data);
	}

	public function role_create()
	{
		echo json_encode(array("id"=>$this->model_roles->create()));
	}

	public function role_update()
	{
		$id= $this->input->post("id", TRUE);
		$value= $this->input->post("value", TRUE);
		$modul= $this->input->post("modul", TRUE);
		$this->model_roles->update($id,$value,$modul);
		echo "{}";
	}

	public function role_delete()
	{
		$id= $this->input->post("id");
		$this->model_roles->delete($id);
		echo "{}";
	}

	/*
		End CRUD Roles
	*/

	/*
		CRUD Barang
	*/
	public function laundry_item()
	{
		$data["barang"]=$this->model_barang->read();
		$data['username'] = $this->session->userdata('username');		
		$data['header'] = $this->header;
		$data['page'] = 'admin/barang';

		$this->load->view('layout/app', $data);
	}

	public function create_barang()
	{
		echo json_encode(array("id"=>$this->model_barang->create()));
	}

	public function update_barang()
	{
		$id= $this->input->post("id", TRUE);
		$value= $this->input->post("value", TRUE);
		$modul= $this->input->post("modul", TRUE);
		$this->model_barang->update($id,$value,$modul);
		echo "{}";
	}

	public function delete_barang()
	{
		$id= $this->input->post("id");
		$this->model_barang->delete($id);
		echo "{}";
	}

	/*
		End CRUD Barang
	*/

	// ngeliat registered users
	public function users()
	{
		$data['header'] = $this->header;
		$data['page'] = 'admin/users';

		$this->load->view('layout/app', $data);
	}

	public function getUsersData()
	{
		$data = array(
			'users' => $this->model_user->getUsersAndDeposit()
		);
		
		$this->load->view('admin/users_data', $data);
	}

	public function update_user_role()
	{
		$id = $this->input->post('id', TRUE);
		$update = $this->model_user->update_user('users', array('role_id' => '3'), array('id' => $id) );
		echo "{}";
	}

	public function add_deposit()
	{
		$deposit_id = $this->input->post('deposit_id', TRUE);
		$inputValue = $this->input->post('inputValue', TRUE);

		$this->model_user->add_deposit($deposit_id, $inputValue);
		echo "{}";


	}



}
