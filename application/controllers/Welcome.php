<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model('Posts_m');
		$this->load->helper('url');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index()
	{
		$where_portffolio = array('jenis' => 1);
		$where_tipe = array('jenis' => 2);

		$portfolio = $this->Posts_m->where($where_portffolio)->result();
		$tipe = $this->Posts_m->where($where_tipe)->result();
		$this->load->view('index', compact("portfolio","tipe"));
	}
}
