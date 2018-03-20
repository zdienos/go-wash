<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* Kelas Customer.
* Siapa saja yang baru membuat akun default menjadi customer.
*/
class Customer extends CI_Controller
{
	var $header = 'customer/header';

	public function __construct()
	{
		parent::__construct();

		$role = $this->session->userdata('role');

		if ($role == FALSE) {
			redirect('auth');
		} elseif ($role == '1') {
			redirect('admin');
		} elseif ($role == '3') {
			redirect('washer');
		}

		$this->load->model('model_barang','',TRUE);	
		$this->load->model('model_user','',TRUE);
		$this->load->model('model_order','',TRUE);
		$this->load->model('model_customer','',TRUE);
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata('id');
		$data['user'] = $this->session->userdata('username');
		$data['header'] = $this->header;
		$data['page'] = 'customer/dashboard';

		$this->load->view('layout/app', $data);
	}

	public function order()
	{
		$id = $this->session->userdata('id');
		$user = $this->model_user->get_user($id);
		if ($user == TRUE) {
			$data = array(
				"user_id"	=> $user["user_id"],
				"user" 		=> $this->session->userdata('username'),
				"alamat"	=> $user["alamat"],
				"no_hp"		=> $user["no_hp"],
				"items"		=> $this->model_barang->read(),
				"header"	=> $this->header,
				"page"		=> 'customer/order'
			);
			$this->load->view('layout/app', $data);
		}
	}

	public function do_order()
	{

		$config_rules = array(
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'selected_items',
				'label' => 'Pilih Item',
				'rules' => 'required|trim'
			),
		);

		$this->form_validation->set_rules($config_rules);

		if ($this->form_validation->run() == FALSE) {
			$this->order();
		} else {

			//inserting to tabel order and order_details
			$id = $this->session->userdata('id');
			$selected_items = $this->input->post('selected_items', TRUE);
			$selected_items = explode(",", $selected_items);
			$selected_items = filter_var_array($selected_items, FILTER_VALIDATE_INT);

			$data_order = array(
				'ordered_by_id' => $id,
				'status_id' 	=> 1,
				'total' 		=> $this->input->post('total', TRUE),
				'ordered_at'	=> date('Y-m-d H:i:s'),
				'choose_to_id'	=> '',
				'paid_at'		=> '',
				'finish_at'		=> '',
			);

			$order_id = $this->model_order->create_get_id('orders', $data_order);

			foreach ($selected_items as $key => $value) {
				
				// $barang_id = $value;

				$data_order_detail = array(
					'order_id' 			=> $order_id,
					'barang_id'			=> $value,
					'qty'				=> '',
					'harga_total_item'	=> ''
				);
				// echo json_encode($data_order_detail);
				$this->model_order->create('order_details', $data_order_detail);
			}

			// $this->proses();
			redirect('customer/proses');
		} // end of running validation
		
	}

	public function profil()
	{
		$id = $this->session->userdata('id');
		$user = $this->model_user->get_user($id);
		if ($user == TRUE) {
			$data = array(
				"user_id"	=> $user["user_id"],
				"user" 	=> $this->session->userdata('username'),
				"alamat"	=> $user["alamat"],
				"no_hp"		=> $user["no_hp"],
				"header"	=> $this->header,
				"page"		=> 'customer/profil'
			);
			$this->load->view('layout/app', $data);
		}
		
	}

	public function profil_update()
	{
		$config_rules = array(
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'no_hp',
				'label' => 'No. Telepon',
				'rules' => 'required|trim'
			),
		);
		
		$user_id = array('user_id' => $this->input->post('user_id', TRUE));

		$data = array(
			'alamat'	=> $this->input->post('alamat', TRUE),
			'no_hp'		=> $this->input->post('no_hp', TRUE),
			'lat'		=> $this->input->post('lat', TRUE),
			'lng'		=> $this->input->post('lng', TRUE)
		);

		$this->form_validation->set_rules($config_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->profil();
		} else {
			// insert into user_profiles
			$this->model_user->update_user('user_profiles', $data, $user_id);
			
			// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          	Update profile <strong>Berhasil</strong>.</div>');

			redirect('customer/profil');			
		}
	}

	public function join()
	{
		$id = $this->session->userdata('id');

		$user = $this->model_user->get_user($id);

		if ($user == TRUE) {
			$data = array(
				"user_id"	=> $user["user_id"],
				"user" 		=> $this->session->userdata('username'),
				"alamat"	=> $user["alamat"],
				"no_hp"		=> $user["no_hp"],
				"header"	=> $this->header,
				"page"		=> 'customer/join',
				"request_join" => $user["request_join"]
			);
			
			$this->load->view('layout/app', $data);
		}
	}

	public function do_join()
	{
		$config_rules = array(
			array(
				'field' => 'agree',
				'label' => 'Saya setuju',
				'rules' => 'required|trim',
				
			)
		);
		$this->form_validation->set_rules($config_rules);
		if ($this->form_validation->run() === FALSE) {
			$this->join();
		} else {
			$id = $this->session->userdata('id');
			$data = array(
				'request_join' => '1'
			);

			$this->model_user->update_user('users', $data, array('id' => $id));
			
			// success message
			$this->session->set_flashdata('message', 'Waiting for admin confirmation');
			redirect('customer');	
		}

	}

	public function pemberitahuan()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header"	=> $this->header,
			"page"		=> 'customer/pemberitahuan'
		);
		$this->load->view('layout/app', $data);
	}

	public function proses()
	{
		$id = $this->session->userdata('id');

		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "customer/proses"
		);
		$this->load->view('layout/app', $data);
	}

	public function proses_data()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"my_order"	=> $this->model_customer->show_my_order($id),
		);

		$this->load->view('customer/proses_data', $data);
	}

	public function getOrderDetails($order_id)
	{
		$data = array(
			'order_details' => $this->model_customer->show_order_details($order_id)
		);
		echo json_encode($data['order_details']);
	}

	public function history()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "customer/history"
		);
		$this->load->view('layout/app', $data);
	}

	public function getHistory()
	{
		$cust_id = $this->session->userdata('id');
		$data = array(
			"my_history" => $this->model_customer->my_history($cust_id)
		);
		$this->load->view('customer/history_data', $data);
	}

	public function send_feedback()
	{
		$order_id = $this->input->post('id', TRUE);
		$komentar = $this->input->post('komentar', TRUE);
		$rating = $this->input->post('rating', TRUE);

		$this->model_customer->send_feedback($order_id, $komentar, $rating);
	}

	public function getKoordinat()
	{
		$id = $this->session->userdata('id');

		$koordinat = $this->model_user->getKoordinat($id);

		echo json_encode($koordinat);

	}

	public function about()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "customer/about"
		);
		$this->load->view('layout/app', $data);
	}
}