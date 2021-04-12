<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
	}

	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'login');
		}else{
			$where = array('id' => $session['userLogin']->id);
			$result = $this->User_m->login($where)->result();
			$data['user'] = $result[0];
			$this->load->view('admin/setting',$data);
		}
	}

	public function getData($id){
		$where = array('id' => $id);
		$result = $this->User_m->login($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}

	public function updatedata(){
		$session = $this->session->userdata();
		$where = array('id' => $session['userLogin']->id);

		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');

		if(!empty($old_password) || !empty($new_password)){
			$res = $this->User_m->login($where)->result();
			if(!password_verify($old_password, $res[0]->password)){
				$response = array(
					'status' => false,
					'message' => "Password lama yang anda masukkan tidak sesuai."
				);
				echo json_encode($response);
				die();
			}elseif(!empty($new_password)){
				$post = array(
					'nama' => $nama,
					'alamat' => $alamat,
					'tgl_lahir' => $tgl_lahir,
					'password' => password_hash($new_password, PASSWORD_DEFAULT)
				);
			}else{
				$post = array(
					'nama' => $nama,
					'alamat' => $alamat,
					'tgl_lahir' => $tgl_lahir
				);
			}
		}else{
			$post = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'tgl_lahir' => $tgl_lahir
			);
		}

		$this->User_m->login_success($post,$where);
		$response = array(
			'status' => true,
			'message' => "Update data berhasil."
		);
		echo json_encode($response);
	}

	public function uploadimage(){
		$url = base_url();
		$session = $this->session->userdata();
		$where = array('id'=> $session['userLogin']->id);
        $cek_data = $this->User_m->login($where)->result()[0];

        if($_FILES["image"]["name"]){
            $this->load->library('upload');
            $this->load->helper('file');
            $image_name = 'Image-'.date("Y-m-d_H_i_s");
            $tipe_image = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $file_name =  $image_name.'.'.$tipe_image;

            $config['upload_path']          = './assets/img/imageProfile';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['file_name'] = $file_name;
    
            $this->upload->initialize($config);
            $this->upload->do_upload('image');
			if(!empty($cek_data->avatar)){
				if(file_exists('./assets/img/imageProfile/'.$cek_data->avatar)){
					unlink('./assets/img/imageProfile/'.$cek_data->avatar);
				}
			}
			$data = array(
				'avatar' => $file_name
			);
		}
		$this->User_m->login_success($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => 'Update Imaage Berhasil'
		);
		
		echo json_encode($result);
	}
}
