<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Kelas Auth.
* untuk pengaturan login
*/
class Auth extends CI_Controller
{
	var $header = 'header';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper(array('form')); // untuk pembuka tag form yang digantikan form_open
		$this->load->library('form_validation'); // library form validation
		$this->load->model('model_user','',TRUE); // load model_user
	}

	public function index()
	{
		$role = $this->session->userdata('role');

		if ($role === '1') {
			redirect('admin');
		} else if ($role === '2') {
			redirect('customer');
		} else if ($role === '3') {
			redirect('washer');
		}
		$data['header'] = $this->header;
		$data['page'] = 'login';

		$this->load->view('layout/app', $data);
			
	}

	public function cek_login()
	{
		$data = array('username' => $this->input->post('username', TRUE),
					  'password' => md5($this->input->post('password', TRUE))
			);

		$hasil = $this->model_user->cek_user($data);

		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Login';
				$sess_data['id'] = $sess->id;
				$sess_data['username'] = $sess->username;
				$sess_data['role'] = $sess->role_id;
				$this->session->set_userdata($sess_data);
			}

			$role = $this->session->userdata('role');
			switch ($role) {
				case '1':
					redirect('admin');
					break;
				case '2':
					redirect('customer');
					break;
				case '3':
					redirect('washer');
					break;
				default:
					redirect('auth');
					break;
			}
		}
		else {	
			echo "<script>alert('Gagal login: Cek username, password!', 'error');history.go(-1);</script>";
		}
	}


	public function register()
	{
		$role = $this->session->userdata('role');

		if ($role === '1') {
			redirect('admin');
		} else if ($role === '2') {
			redirect('customer');
		} else if ($role === '3') {
			redirect('washer');
		}
		$data['header'] = $this->header;
		$data['page'] = 'register';

		$this->load->view('layout/app', $data);
	}

	public function register_user()
	{
		$config_rules = array(
			array(
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|trim|min_length[5]'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|valid_email'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim|min_length[6]'
			),
			array(
				'field' => 'passconf',
				'label' => 'Password Confirmation',
				'rules' => 'required|trim|matches[passconf]'
			),
		);
		
		$data_user = array(
			'nama'		=> $this->input->post('nama', TRUE),
			'username'	=> $this->input->post('username', TRUE),
			'email'		=> $this->input->post('email', TRUE),
			'password'	=> md5($this->input->post('password', TRUE)),
			'role_id' 	=> '2',
			'created_at' => date("Y-m-d H:i:s")
		);
		
		$this->form_validation->set_rules($config_rules);

		if ($this->form_validation->run() == FALSE) {
			$this->register();
		} else {
			$user_id = $this->model_user->add_user('users', $data_user); // ngedapetin user_id dari return $this->db->insert_id()
			$this->model_user->add_user('user_profiles', array(
				'user_id' => $user_id,
				'alamat'  => '', // diisi nanti saat update profil
				'no_hp'	  => '' // diisi nanti saat update profil
			));
			$data['success'] = "Ayo Login";
			$data['header'] = "header";
			$data['page'] = "login";
			$this->load->view('layout/app', $data);
		}
	}



	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		session_destroy();
		redirect('welcome');
	}




}