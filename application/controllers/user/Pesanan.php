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
		$this->load->model('Pemesanan_m');
		$this->load->model('Kategori_m');
		$this->load->model('Rab_m');
		$this->load->helper('url');
	}
	public function index()
	{
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'login');
		}else{
			$data = $session['userLogin'];
			$this->load->view('/admin/pesanan', $data);
		}
	}
	function getByID($id){
		$where = array('id' => $id);
		$result = $this->Pemesanan_m->where($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}
	function getID($id){
		$where = array('id' => $id);
		$result = $this->Pemesanan_m->v_pesanan_where($where)->result();
		return $this->output->set_output(json_encode($result[0]));
	}

	public function get_datatables1(){
		$url = base_url();
		$session = $this->session->userdata();
		
        $where = array('user_id' => $session['userLogin']->id);
		$result = $this->Pemesanan_m->v_pesanan_where($where)->result();
		$data = array();

		$no1 = 0;
		foreach($result as $pesanan){
			$row = array();
			$no1++;
            $admin = "";
            $status = "";
			if($pesanan->status == 2){
				$status = "Proses";
			}elseif($pesanan->status == 3){
				$status = "Reject";
                $admin = $pesanan->admin;
			}elseif($pesanan->status == 4){
				$status = "Menunggu Pembayaran";
                $admin = $pesanan->admin;
			}elseif($pesanan->status == 5){
				$status = "Selesai";
                $admin = $pesanan->admin;
			}elseif($pesanan->status == 1){
				$status = "Menunggu";
			}
            $desain_rumah = "";
            if(!empty($pesanan->desain_rumah)){
                $desain_rumah = "<a download href='$url/assets/pdfUpload/$pesanan->desain_rumah' class='btn btn-success btn-sm'>
                    <i class='far fa-file-alt'></i> Download Desain
                </a>";
            }

			$button_bukti = "";
			if(!empty($pesanan->bukti_pembayaran)){
				$button_bukti = "<button type='button' class='btn btn-success btn-sm'
				data-toggle='modal' data-target='#modalBukti'
				onclick=\"viewBukti('$pesanan->bukti_pembayaran')\"
				><i class='fas fa-eye'></i> Bukti Pembayaran</button>";
			}


			$row[] = '<td>'.$no1.'</td>';
			$row[] = '<td>'.$pesanan->invoice.'</td>';
			$row[] = '<td>'.$pesanan->nama.'</td>';
			$row[] = '<td>'.$pesanan->tanggal.'</td>';
			$row[] = '<td>'.$admin.'</td>';
			$row[] = '<td>'.$status.'</td>';
			$row[] = "<td>
						<a href='$url/user/proyek/cetak/$pesanan->id' class='btn btn-success btn-sm'><i class='far fa-file-alt'></i> Cetak RAB</a>
						$desain_rumah $button_bukti
					</td>";

			$data[] = $row;
		}

		$output = array(
            "data" => $data,
        );
        echo json_encode($output);
	}

	function proses(){
		$session = $this->session->userdata();
		$where = array('id'=> $this->input->post('id'));
		$data = array(
			'status'=> $this->input->post('proses'),
			'admin_id'=> $session['userLogin']->id,
			'ket_ditolak'=> $this->input->post('keterangan')
		);
		$this->Pemesanan_m->update($data, $where);
		$result = array(
			'status' => TRUE,
			'message' => 'Pesanan berhasil diproses'
		);
		
		echo json_encode($result);
	}

	public function rab($id){
		$session = $this->session->userdata();
		if(empty($session['userLogin'])){
			redirect(base_url().'/login');
		}else{
			// $rab =  $this->Rab_m->where($where)->result();
			$kategori =  $this->Kategori_m->get_all()->result();
			$gol = $kategori;
			$title =  array();
			foreach($gol as $gol){
				$where = array(
					'id_pemesanan' => $id,
					'id_kategori' => $gol->id
				);
				$rab =  $this->Rab_m->where($where)->result();
				$col = "";
				foreach($rab as $rab){
					$col = $col."<tr>
						<td class='mr-auto'>$rab->keterangan</td>
						<td class='mr-2'>$rab->satuan</td>
						<td class='mr-2'>Rp. ".number_format($rab->harga_satuan)."</td>
						<td class='mr-2'>$rab->volume</td>
						<td class='mr-2'>Rp. ".number_format($rab->total)."</td>
					</tr>"; 
				}
				$table = "<table class='table'>$col</table>";
				$title[] = "<h4 class='text-center'>$gol->nama_kategori</h4>".$table; 
			}

			$where1 = array(
				'id_pemesanan' => $id
			);
			$total = $this->Rab_m->sum($where1)->result()[0];
			// print_r($total);
			$kategori1 = $kategori;
			$id_projek = $id;
			$id = $id;
			$rab = $title;
			$this->load->view('/admin/form_rab', compact("id","rab","kategori","id_projek","kategori1","total"));
		}
	}

}
