<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

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
			redirect('/login');
		}else{
			$data = $session['userLogin'];
			$this->load->view('/admin/proyek', $data);
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


	public function get_datatables(){
		$result = $this->Pemesanan_m->v_menunggu()->result();
		$data = array();

		$no1 = 0;
		foreach($result as $pesanan){
			$row = array();
			$no1++;
 

			$row[] = '<td>'.$no1.'</td>';
			$row[] = '<td>'.$pesanan->invoice.'</td>';
			$row[] = '<td>'.$pesanan->nama.'</td>';
			$row[] = '<td>'.$pesanan->tanggal.'</td>';
			// $row[] = "<td>
			// 			<a href='/user/proyek/pesanan/$pesanan->id' class='btn btn-success btn-sm'><i class='far fa-file-alt'></i> File RAB</a>
			// 		</td>";
			$row[] = "<td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick=\"updateInformasi('$pesanan->id')\"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i> Rubah Status</button>
						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick=\"viewInformasi('$pesanan->id')\"
						><i class='fas fa-eye'></i></button>
					</td>";

			$data[] = $row;
		}

		$output = array(
            "data" => $data,
        );
        echo json_encode($output);
	}
	public function get_datatables1(){
		$result = $this->Pemesanan_m->v_proses()->result();
		$data = array();

		$no1 = 0;
		foreach($result as $pesanan){
			$row = array();
			$no1++;
			$btn_rab = "";
 
			if($pesanan->status == 2){
				$status = "Proses";
				$btn_rab = "
						<button type='button' 
						onClick=\"setIDForm('$pesanan->id')\" 
						data-toggle='modal' data-target='#modalUpload'
						class='btn btn-success btn-sm'>
						<i class='far fa-file-alt'></i> Upload Desain
						</button>
					";
			}elseif($pesanan->status == 3){
				$status = "Reject";
			}elseif($pesanan->status == 4){
				$status = "Menunggu Pembayaran";
			}elseif($pesanan->status == 5){
				$status = "Selesai";
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
			$row[] = '<td>'.$pesanan->admin.'</td>';
			$row[] = '<td>'.$status.'</td>';
			$row[] = "<td>
						<a href='/user/proyek/rab/$pesanan->id' class='btn btn-success btn-sm'><i class='far fa-file-alt'></i> Buat RAB</a>
					
						<button type='button' class='btn btn-primary btn-sm'
						onclick=\"updateInformasi('$pesanan->id')\"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i> Ubah Status</button>
						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick=\"viewInformasi('$pesanan->id')\"
						><i class='fas fa-eye'></i> Cetak Pesanan</button>
						$btn_rab $button_bukti
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
			redirect('/login');
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

	public function insertRab(){
		$keterangan = $this->input->post('keterangan');
		$id_pemesanan = $this->input->post('id');
		$id_kategri = $this->input->post('kategori');
		$satuan = $this->input->post('satuan');
		$harga_satuan = $this->input->post('harga');
		$volume = $this->input->post('volume');
		$total = $volume*$harga_satuan;

		$post = array(
			'keterangan' => $keterangan,
			'id_pemesanan' => $id_pemesanan,
			'id_kategori' => $id_kategri,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'volume' => $volume,
			'total' => $total
		);
		$this->Rab_m->insert($post);

		$result = array(
			'status' => TRUE,
			'message' => "Berhasil"
		);
		
		echo json_encode($result);
	}

	function cetak($id){
		require './assets/fpdf/fpdf.php';
		// $rab =  $this->Rab_m->where($where)->result();
		$kategori =  $this->Kategori_m->get_all()->result();
		$gol = $kategori;

		$where1 = array(
			'id_pemesanan' => $id
		);
		$total = $this->Rab_m->sum($where1)->result()[0];



		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(190,7,'RENCANAN ANGGARAN BIAYA',0,1,'C');
		$pdf->Cell(10,7,'',0,1);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,"KEGIATAN",1,0);
		$pdf->Cell(150,6,'Konstruksi',1,1);
		$pdf->Cell(40,6,"PEKERJAAN",1,0);
		$pdf->Cell(150,6,'Pembuatan bangunan',1,1);
		// $pdf->Cell(40,6,"LOKASI",1,0);
		// $pdf->Cell(150,6,'Jumlah Keseluruhan',1,1);

		$pdf->Cell(10,7,'',0,1);

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(15,6,'NO',1,0);
		$pdf->Cell(85,6,'URAIAN PEKERJAAN',1,0);
		$pdf->Cell(15,6,'SAT',1,0);
		$pdf->Cell(10,6,'VOL',1,0);
		$pdf->Cell(25,6,'HARGA SAT.',1,0);
		$pdf->Cell(40,6,'TOTAL',1,1);

		$pdf->SetFont('Arial','',10);
		$no = 0;
		foreach($gol as $gol){
			$no++;
			$where = array(
				'id_pemesanan' => $id,
				'id_kategori' => $gol->id
			);
			$rab =  $this->Rab_m->where($where)->result();
			$col = "";
			$pdf->Cell(15,6,$no,1,0);
			$pdf->Cell(175,6,$gol->nama_kategori,1,1);
			$no1 = 0;
			foreach($rab as $rab){
				$no1++;
				$pdf->Cell(15,6,'',1,0);
				$pdf->Cell(10,6,$no1,1,0);
				$pdf->Cell(75,6,$rab->keterangan,1,0);
				$pdf->Cell(15,6,$rab->satuan,1,0);
				$pdf->Cell(10,6,$rab->volume,1,0);
				$pdf->Cell(25,6,'Rp. '.number_format($rab->harga_satuan),1,0);
				$pdf->Cell(40,6,'Rp. '.number_format($rab->total),1,1);
			}
		}
		$pdf->Cell(150,6,'Jumlah Keseluruhan',1,0);
		$pdf->Cell(40,6,'Rp. '.number_format($total->total),1,1);
		$pdf->SetTitle('RAB');

		$pdf->Output('D', 'RAB-Bangunan.pdf');
	}

	function cetakdesain($id){
		require './assets/fpdf/fpdf.php';
		$where = array('id' => $id);
		$result = $this->Pemesanan_m->v_pesanan_where($where)->result()[0];

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(190,7,'Pesanan Pelanggan',0,1,'C');
		$pdf->Cell(10,7,'',0,1);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,"Invoice",1,0);
		$pdf->Cell(150,6,$result->invoice,1,1);
		$pdf->Cell(40,6,"Nama",1,0);
		$pdf->Cell(150,6,$result->nama,1,1);
		$pdf->Cell(40,6,"NIK",1,0);
		$pdf->Cell(150,6,$result->nik,1,1);
		$pdf->Cell(40,6,"Alamat",1,0);
		$pdf->Cell(150,6,$result->alamat,1,1);
		$pdf->Cell(40,6,"Telpon",1,0);
		$pdf->Cell(150,6,$result->no_telp,1,1);
		$pdf->Cell(40,6,"Type Rumah",1,0);
		$pdf->Cell(150,6,$result->model,1,1);
		$pdf->Cell(40,6,"Luas Tanah",1,0);
		$pdf->Cell(150,6,$result->ukuran,1,1);
		$pdf->Cell(40,6,"Kamar Tidur",1,0);
		$pdf->Cell(150,6,$result->kamar,1,1);
		$pdf->Cell(40,6,"Kamar Mandi",1,0);
		$pdf->Cell(150,6,$result->kamar_mandi,1,1);
		$pdf->Cell(40,6,"Luas Bangunan",1,0);
		$pdf->Cell(150,6,$result->luas_bangunan,1,1);
		$pdf->Cell(40,6,"Garasi",1,0);
		$pdf->Cell(150,6,$result->garasi,1,1);
		$pdf->Cell(40,12,"Referensi",1,0);
		$pdf->MultiCell(150,6,$result->referensi,1,1);
		$pdf->SetTitle('Pesanan');

		// $pdf->Output();
		$pdf->Output('D', 'Pesanan'.$result->invoice.'.pdf');
	}

	function uploaddesain(){

		$this->load->library('upload');
		$this->load->helper('file');
		$pdf_name = 'pdf-'.date("Y-m-d_H:i:s");
		$tipe_pdf = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);
		$file_name =  $pdf_name.'.'.$tipe_pdf;

		$config['upload_path']          = 'assets/pdfUpload';
		$config['allowed_types']        = 'pdf';
		$config['file_name'] = $file_name;

		$this->upload->initialize($config);
		$this->upload->do_upload('pdf');

		$post = array(
			'desain_rumah' => $file_name
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
