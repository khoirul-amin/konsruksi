<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();		
		$this->load->model('User_m');
		$this->load->helper('url');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			$this->load->view('login');
		}else{
			redirect('/user/home');
		}
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		if(empty($username) || empty($password)){
			$response = array(
				'status' => false,
				'message' => "Input Tidak Boleh Kosong."
			);
			echo json_encode($response);
			die();
		}
		$where = array('username' => $username);
		$result = $this->User_m->login($where)->result();
		if($result){
			if(!password_verify($password, $result[0]->password)){
				$response = array(
					'status' => false,
					'message' => "Pasword salah."
				);
				echo json_encode($response);
				die();
			}else{
				$data = array('timestamps'=> date('Y-m-d H:i:s'));
				$this->User_m->login_success($data, $where);
				$this->session->set_userdata('userLogin',$result[0]);
				// redirect('/user/home');
				$response = array(
					'status' => true,
					'message' => "Login Berhasil."
				);
				echo json_encode($response);
				die();
			}
		}else{
			$response = array(
				'status' => false,
				'message' => "Username tidak terdaftar."
			);
			echo json_encode($response);
			die();
		}
	}


	function logout(){
		$this->session->sess_destroy();
		redirect('/login');
	}
}
