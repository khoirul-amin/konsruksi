<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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
			$id = $session['userLogin']->id;
			$where = array('user_id' => $id);
			$data['pesanan'] = $this->Pemesanan_m->v_pesanan_where($where)->result();
			$this->load->view('/pesanan', $data);
		}
	}
}
