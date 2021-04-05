<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

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
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect('/login');
		}else{
			$this->load->view('/admin/posts');
		}
	}
    public function get_datatables(){
		$result = $this->Posts_m->get_all()->result();
		$data = array();
        $i = 0;
		foreach($result as $post){
            if($post->jenis == 1){
                $jenis =  "Portofolio";
            }elseif ($post->jenis == 2) {
                $jenis =  "Model Bangunan";
            }
            $i++;
			$row = array();
 
			$row[] = '<td>'.$i.'</td>';
			$row[] = '<td>'.$jenis.'</td>';
			$row[] = '<td>'.$post->judul.'</td>';
			$row[] = '<td>'.substr($post->isi, 0, 50).'</td>';
			$row[] = "<td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick=\"updateInformasi('$post->id')\"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick=\"hapusData('$post->id')\"
						><i class='fas fa-trash'></i></button>

						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick=\"viewInformasi('$post->id')\"
						><i class='fas fa-eye'></i></button>
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
		$result = $this->Posts_m->where($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}
	function hapusdata($id){
		$where = array('id' => $id);
		$this->Posts_m->hapus($where);
		$output = array(
			'status' => TRUE,
			'message' => "Hapus data berhasil"
		);
		
		echo json_encode($output);
	}

	function updatedata(){
		$session = $this->session->userdata();
		$where = array('id'=> $this->input->post('id'));
		$judul = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		$isi = $this->input->post('isi');
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul)));
        $cek_data = $this->Posts_m->where($where)->result()[0];

        if($_FILES["image"]["name"]){
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
			if(!empty($cek_data->image)){
				if(file_exists('assets/img/imageUpload/'.$cek_data->image)){
					unlink('assets/img/imageUpload/'.$cek_data->image);
				}
			}

            $data = array(
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'image' => $file_name,
                'jenis' => $jenis,
                'author' => $session['userLogin']->nama,
                'tanggal' => date('Y-m-d H:i:s')
            );
        }else{
            $data = array(
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'jenis' => $jenis,
                'author' => $session['userLogin']->nama,
                'tanggal' => date('Y-m-d H:i:s')
            );
        }
		$this->Posts_m->update($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => 'Update Data Berhasil'
		);
		
		echo json_encode($result);
	}

	function insertdata(){
		$session = $this->session->userdata();
		$judul = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		$isi = $this->input->post('isi');
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul)));
		if(empty($judul) || empty($jenis) || empty($isi)){
			$response = array(
				'status' => false,
				'message' => "Input Tidak Boleh Kosong."
			);
			echo json_encode($response);
			die();
		}


        if($_FILES["image"]["name"]){
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
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'image' => $file_name,
                'jenis' => $jenis,
                'author' => $session['userLogin']->nama,
                'tanggal' => date('Y-m-d H:i:s')
            );
        }else{
            $post = array(
                'judul' => $judul,
                'slug' => $slug,
                'isi' => $isi,
                'jenis' => $jenis,
                'author' => $session['userLogin']->nama,
                'tanggal' => date('Y-m-d H:i:s')
            );
        }

		$this->Posts_m->insert($post);

		$result = array(
			'status' => TRUE,
			'message' => "Tambah posts Sukses"
		);
		
		echo json_encode($result);
	}
}