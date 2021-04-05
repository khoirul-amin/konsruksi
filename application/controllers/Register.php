<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
			$this->load->view('register');
		}else{
			redirect('/user/home');
		}
	}
	
	function register()
	{
		$nama = $this->input->post('full-name');
		$nik = $this->input->post('no-ktp');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no-hp');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$re_password = $this->input->post('re-password');


		if(empty($nama) || empty($nik) || empty($alamat) || empty($no_telp) || empty($email) || empty($username) || empty($password) || empty($re_password)){
			$response = array(
				'status' => false,
				'message' => "Input Tidak Boleh Kosong."
			);
			echo json_encode($response);
			die();
		}

		if($this->User_m->cek_data_user('username', $username)->result()){
			$response = array(
				'status' => false,
				'message' => "Username sudah terdaftar."
			);
			echo json_encode($response);
			die();
		}

		if($this->User_m->cek_data_user('email', $email)->result()){
			$response = array(
				'status' => false,
				'message' => "Email sudah terdaftar."
			);
			echo json_encode($response);
			die();
		}
		if($this->User_m->cek_data_user('no_telp', $no_telp)->result()){
			$response = array(
				'status' => false,
				'message' => "No. Telp sudah terdaftar."
			);
			echo json_encode($response);
			die();
		}
		if($this->User_m->cek_data_user('nik', $nik)->result()){
			$response = array(
				'status' => false,
				'message' => "No. KTP sudah terdaftar."
			);
			echo json_encode($response);
			die();
		}

		if($password != $re_password){
			$response = array(
				'status' => false,
				'message' => "Password tidak sama."
			);
			echo json_encode($response);
		}else{
			$post = array(
				'nama' => $nama,
				'nik' => $nik,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
				'email' => $email,
				'username' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => 3,
				'timestamps' => date('Y-m-d H:i:s')
			);
			$this->User_m->register($post);
			$response = array(
				'status' => true,
				'message' => "Register berhasil."
			);
			echo json_encode($response);
		}
	}
}
