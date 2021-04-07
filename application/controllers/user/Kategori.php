<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
		$this->load->model('Kategori_m');
		$this->load->helper('url');
	}

	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'login');
		}else{
			$this->load->view('admin/kategori_rab');
		}
	}
    public function get_datatables(){
		$result = $this->Kategori_m->get_all()->result();
		$data = array();
        $i = 0;
		foreach($result as $kategori){
            $i++;
			$row = array();
 
			$row[] = '<td>'.$i.'</td>';
			$row[] = '<td>'.$kategori->id.'</td>';
			$row[] = '<td>'.$kategori->nama_kategori.'</td>';
			$row[] = "<td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick=\"updateInformasi('$kategori->id')\"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick=\"hapusData('$kategori->id')\"
						><i class='fas fa-trash'></i></button>
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
		$result = $this->Kategori_m->where($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}
	function hapusdata($id){
		$where = array('id' => $id);
		$this->Kategori_m->hapus($where);
		$output = array(
			'status' => TRUE,
			'message' => "Hapus data berhasil"
		);
		
		echo json_encode($output);
	}

	function updatedata(){
		$where = array('id'=> $this->input->post('id'));
		$data = array(
			'nama_kategori'=> $this->input->post('nama'),
			'timestamp' => date('Y-m-d H:i:s')
		);
		$this->Kategori_m->update($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => 'Update Data Berhasil'
		);
		
		echo json_encode($result);
	}

	function insertdata(){
		$nama_kategori = $this->input->post('nama');

		if(empty($nama_kategori)){
			$response = array(
				'status' => false,
				'message' => "Input Tidak Boleh Kosong."
			);
			echo json_encode($response);
			die();
		}

		$post = array(
			'nama_kategori' => $nama_kategori,
			'timestamp' => date('Y-m-d H:i:s')
		);
		$this->Kategori_m->insert($post);

		$result = array(
			'status' => TRUE,
			'message' => "Tambah kategori RAB Sukses"
		);
		
		echo json_encode($result);
	}
}