<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

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
	}

	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect('/login');
		}else{
			$data = $session['userLogin'];
			$this->load->view('/admin/pelanggan', $data);
		}
		// $this->load->view('/admin/pelanggan');
	}

	public function get_datatables(){
		$where = array('role' => 3);
		$result = $this->User_m->login($where)->result();
		$data = array();

		foreach($result as $users){
			$row = array();
 

			$row[] = '<td>'.$users->nama.'</td>';
			$row[] = '<td>'.$users->tgl_lahir.'</td>';
			$row[] = '<td>'.$users->NIK.'</td>';
			$row[] = '<td>'.$users->no_telp.'</td>';
			$row[] = '<td>'.$users->email.'</td>';
			$row[] = '<td>'.$users->alamat.'</td>';
			$row[] = '<td>'.$users->username.'</td>';
			$row[] = "<td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick=\"updateInformasi('$users->id')\"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick=\"hapusData('$users->id')\"
						><i class='fas fa-trash'></i></button>

						<button type='button' class='btn btn-warning btn-sm'
						onclick=\"lupaPassword('$users->id')\"
						><i class='fas fa-unlock'></i></button>
					</td>";

			$data[] = $row;
		}

		$output = array(
            "data" => $data,
        );
        echo json_encode($output);
	}

	function getByID($id){
		$where = array('id' => $id);
		$result = $this->User_m->login($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}
	function hapusdata($id){
		$where = array('id' => $id);
		$this->User_m->hapus($where);
		$output = array(
			'status' => TRUE,
			'message' => "Hapus data berhasil"
		);
		
		echo json_encode($output);
	}

	function updatedata(){
		$where = array('id'=> $this->input->post('id'));
		$data = array(
			'nama'=> $this->input->post('nama'),
			'tgl_lahir'=> $this->input->post('lahir'),
			'email'=> $this->input->post('email'),
			'username'=> $this->input->post('username'),
			'NIK'=> $this->input->post('NIK'),
			'alamat'=> $this->input->post('alamat'),
			'no_telp'=> $this->input->post('no_telp')
		);
		$this->User_m->login_success($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => 'Update Data Berhasil'
		);
		
		echo json_encode($result);
	}

	function insertdata(){
		$rand = random_bytes(4);
		$password = bin2hex($rand);
		$nama = $this->input->post('nama');
		$tgl_lahir = $this->input->post('lahir');
		$nik = $this->input->post('NIK');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$username = $this->input->post('username');

		if(empty($nama) || empty($tgl_lahir) || empty($nik) || empty($alamat) || empty($no_telp) || empty($email) || empty($username)){
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

		$post = array(
			'nama' => $nama,
			'tgl_lahir' => $tgl_lahir,
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

		$result = array(
			'status' => TRUE,
			'message' => "Penambahan user pelanggan berhasil, pastikan andan menyimpan password berikut"."<br><b>".$password."</b>"
		);
		
		echo json_encode($result);
	}

	function lupapassword($id){
		$rand = random_bytes(4);
		$password = bin2hex($rand);
		$data = array(
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'timestamps' => date('Y-m-d H:i:s')
		);
		$where = array('id' => $id);
		$this->User_m->login_success($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => "Penambahan user pelanggan berhasil, pastikan andan menyimpan password berikut"."<br><b>".$password."</b>"
		);
		
		echo json_encode($result);
	}
}
