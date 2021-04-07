<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

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
		$this->load->model('Pemesanan_m');
		$this->load->model('Posts_m');
		$this->load->helper('url');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'/login');
		}else{
			$where = array('jenis' => 2);
			$data['model'] = $this->Posts_m->where($where)->result();
			$data['user'] = $session['userLogin'];
			$this->load->view('/pemesanan', $data);
		}
	}

	public function pesan(){
		$session = $this->session->userdata();
		$max =  $this->Pemesanan_m->max()->result()[0];
		$invoice = 'B00'.($max->id+1);

		$id_user = $session['userLogin']->id;
		$ukuran = $this->input->post('ukuran');
		$lantai = $this->input->post('lantai');
		$luas_bangunan = $this->input->post('luas_bangunan');
		$id_model = $this->input->post('model');
		$kamar = $this->input->post('kamar');
		$kamar_mandi = $this->input->post('kamar_mandi');
		$garasi = $this->input->post('garasi');
		$referensi = $this->input->post('referensi');
		$pesan = $this->input->post('pesan');
		$tanggal = date('Y-m-d H:i:s');

		$data = array(
			'user_id' => $id_user,
			'ukuran' => $ukuran,
			'invoice' => $invoice,
			'lantai' => $lantai,
			'luas_bangunan' => $luas_bangunan,
			'id_model' => $id_model,
			'kamar' => $kamar,
			'kamar_mandi' => $kamar_mandi,
			'garasi' => $garasi,
			'referensi' => $referensi,
			'pesan' => $pesan,
			'tanggal' => $tanggal,
			'status' => 1
		);

		$this->Pemesanan_m->insert($data);
		$result = array(
			'status' => TRUE,
			'message' => "Pemesanan Berhasil!! Pesanan akan dicek oleh tim, lihat Keranjang untuk melihat perkembangannya"
		);
		
		echo json_encode($result);
	}

	function uploadslip(){
		$this->load->library('upload');
		$this->load->helper('file');
		$image_name = 'Image-'.date("Y-m-d_H:i:s");
		$tipe_image = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
		$file_name =  $image_name.'.'.$tipe_image;

		$config['upload_path']          = 'assets/img/imageUpload';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['file_name'] = $file_name;

		$this->upload->initialize($config);
		$this->upload->do_upload('image');
		$post = array(
			'bukti_pembayaran' => $file_name
		);
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->Pemesanan_m->update($post,$where);
		$result = array(
			'status' => TRUE,
			'message' => "Upload Berhasil"
		);
		
		echo json_encode($result);
	}
}
