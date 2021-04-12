<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	}

	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'login');
		}else{

			$jumlah_pelanggan = $this->User_m->total_pelanggan()->result();
			
			$data['jumlah_pelanggan'] = $jumlah_pelanggan[0]->id;
			$this->load->view('/admin/index', $data);
		}
	}

	public function overview(){
		$tahun = $this->input->post('tahun');
		$bulan = array();
		$dataPeriodeBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
		$maxTrx = array();
		for($i = 1;$i<=date('m');$i++){
			if($i <= 9){
				$month = '0'.$i;
			}else{
				$month = $i;
			}
			$where = $tahun.'-'.$month;
			$query = "SELECT * FROM pemesanan WHERE tanggal LIKE '%$where%'";
			$res = $this->Pemesanan_m->maxTrx($query)->result();
			$maxTrx[] = count($res);
			$bulan[] = $dataPeriodeBulan[$i];
		};
		$data['bulan'] = $bulan;
		$data['trx'] = $maxTrx;
		echo json_encode($data);
	}
}
