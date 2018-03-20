<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* Kelas Washer.
* semua customer bisa daftar menjadi washer.
*/

class Washer extends CI_Controller
{
	var $header = 'washer/header';
	
	public function __construct()
	{
		parent::__construct();

		$role = $this->session->userdata('role');
		if ($role == FALSE) {
			redirect('auth');
		} elseif ($role == '1') {
			redirect('admin');
		} elseif ($role == '2') {
			redirect('customer');
		}
		
		$this->load->model('model_user');
		$this->load->model('model_washer');
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

	}

	public function index()
	{
		$washer_id = $this->session->userdata('id');
		// $data['message'] = $this->session->set_flashdata('message', 'Congratulation for joining Go Wash!');
		$data = array(
			'header' => $this->header,
			'page' => 'washer/dashboard',
			'user_id' => $washer_id,
			'user' => $this->session->userdata('username'),
			'washer' => $this->model_washer->show_who_orders($washer_id) // penjelasan ada di komentar fungsi show_who_orders
		);
		$this->load->view("layout/app", $data);
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
				"page"		=> 'washer/profil'
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
			)
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
			$update = $this->model_user->update_user('user_profiles', $data, $user_id);
			
			// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          	Update profile <strong>Berhasil</strong>.</div>');
			// echo "yey";
			redirect('washer/profil');			
		}
	}

	public function pemberitahuan()
	{
		$washer_id = $this->session->userdata('id');
		
		$data = array(
			'header' => $this->header,
			'page' => 'washer/pemberitahuan',
			'user_id' => $washer_id,
			'user' => $this->session->userdata('username'),
			'orders' => $this->model_washer->show_who_orders($washer_id), // penjelasan ada di komentar fungsi show_who_orders
		);
		$this->load->view("layout/app", $data);
	}

	public function getOrders()
	{
		$washer_id = $this->session->userdata('id');
		$data = array(
			'user_id' => $washer_id,
			'user' => $this->session->userdata('username'),
			'orders' => $this->model_washer->show_who_orders($washer_id), // penjelasan ada di komentar fungsi show_who_orders
			'show_my_claims' => $this->model_washer->show_my_claims($washer_id),
			'checkIfClaimed' => $this->model_washer->checkIfClaimed($washer_id),
			'checkIfHasDeposited' => $this->model_washer->show_my_deposit($washer_id)
		);
		$this->load->view('washer/pemberitahuan_data', $data);
	}

	public function getOrderDetails($order_id)
	{
		$data = array(
			'order_details' => $this->model_washer->show_order_details($order_id)
		);
		echo json_encode($data['order_details']);
	}

	public function claim_order()
	{
		$order_id = $this->input->post('id', TRUE);
		$washer_id = $this->session->userdata('id');

		$query = $this->model_washer->claim_order($order_id, $washer_id);
		header('Content-Type: application/json');
		if ($query === TRUE) {
			echo json_encode(array('status' => 'true'));
		} else {
			echo json_encode(array('status' => 'false'));
		}
	}

	/*public function skip_order()
	{
		$order_id = $this->input->post('id', TRUE);
		$washer_id = $this->session->userdata('id');

		$query = $this->model_washer->skip_order($order_id, $washer_id);
		if ($query === TRUE) {
			echo json_encode(array('status' => 'true'));
		} else {
			echo json_encode(array('status' => 'false'));
		}
	}*/

	public function proses()
	{
		$washer_id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "washer/proses",
		);
		$this->load->view('layout/app', $data);
	}

	public function proses_data()
	{
		$washer_id = $this->session->userdata('id');
		$data = array(
			'show_my_claims' => $this->model_washer->show_my_claims($washer_id),
			'checkIfClaimed' => $this->model_washer->checkIfClaimed($washer_id)
		);
		$this->load->view('washer/proses_data', $data);
	}

	public function update_detail_cucian()
	{
		$id = $this->input->post("id", TRUE);
		$value_qty = $this->input->post("value_qty", TRUE);
		$value_total = $this->input->post("value_total", TRUE);
		$order_id = $this->input->post("order_id", TRUE);
		$total_semua = $this->input->post("total_semua", TRUE);

		$this->model_washer->update_detail_cucian($id, $value_qty, $value_total);
		$this->model_washer->update_total_order($order_id, $total_semua);
		echo "{}";
	}

	public function send_final_price()
	{
		$order_id = $this->input->post('id', TRUE);
		$this->model_washer->send_final_price($order_id);
	}

	public function payment_confirmation()
	{
		$order_id = $this->input->post('id', TRUE);
		$this->model_washer->payment_confirmation($order_id);
	}

	public function finish_confirmation()
	{
		$order_id = $this->input->post('id', TRUE);
		$this->model_washer->finish_confirmation($order_id);
	}

	public function history()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "washer/history"
		);
		$this->load->view('layout/app', $data);
	}

	public function getHistory()
	{
		$washer_id = $this->session->userdata('id');
		$data = array(
			"my_history" => $this->model_washer->my_history($washer_id),
			"sum_total" => $this->model_washer->getSumTotal($washer_id),
			"rating_avg" => $this->model_washer->getAverageRating($washer_id)
		);

		$this->load->view('washer/history_data', $data);

	}
	public function about()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "washer/about"
		);
		$this->load->view('layout/app', $data);
	}

	public function deposit()
	{
		$washer_id = $this->session->userdata('id');
		$data = array(
			"user" 		=> $this->session->userdata('username'),
			"header" 	=> $this->header,
			"page" 		=> "washer/deposit",
			"my_deposit" => $this->model_washer->show_my_deposit($washer_id)
		);
		$this->load->view('layout/app', $data);
	}




	public function do_upload_deposit()
	{
		$washer_id = $this->session->userdata('id');		

		//UPLOAD FOTO
		$newname = date('YmdHis').'-'.rand();
		$config['file_name']   	 =   $newname;
		$config['file_type'] 	 =	 "image/jpeg";
		$config['upload_path']   =   "assets/uploads/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "300";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);
		
		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		} else {
			$finfo=$this->upload->data();
			// $data['uploadInfo'] = $finfo;
			/*echo '<pre>';
			var_dump($finfo);
			echo '</pre>';*/
			if ($finfo['is_image'] == true) {
				$file_name = $finfo['file_name'];
				$this->model_washer->upload_deposit($washer_id, $file_name);
				redirect('washer/deposit');
			}

		}
		//END UPLOAD FOTO
	}

	public function getKoordinat()
	{
		$id = $this->session->userdata('id');

		$koordinat = $this->model_user->getKoordinat($id);

		echo json_encode($koordinat);
	}
}