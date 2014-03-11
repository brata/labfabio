<?php
/**
 * CetakUlang Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Cetakulang extends CI_Controller {
	/**
	 * Constructor
	 */
	function Cetakulang()
	{
		parent::__Construct();
		$this->load->model('Administrasi_model', '', TRUE);
		$this->load->helper('datecbo');
		$this->load->model('Surat_model', '', TRUE);
		$this->load->library('pagination');
		$this->load->library('table');	
        $this->load->library('cfpdf');
		$this->load->model('Info_model', '', TRUE);	
	}
	
	var $title = 'Cetak Ulang';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menjalankan fungsi main()
	 * jika tidak akan meredirect ke halaman login
	 */
	function index()
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$this->main();
		}
		else
		{
			redirect('login');
		}
	}
	
	/**
	 * Menampilkan halaman utama rekap absen
	 */
	function main()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Cetak Ulang';
		$data['main_view'] = 'administrasi/cetakulang_view';
		$data['left_view'] = 'menuadministrasi.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('cetakulang/get_surat');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
				
		$this->load->view('template', $data);
	}
	
	function separator($num, $suffix = '')
	{
 		$ina_format_number = number_format($num, 3, ',','.');
		$result = str_replace(',000',$suffix,$ina_format_number) ;
 
		return $result ;
	}
	
	function get_surat()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Cetak Ulang';
		$data['main_view'] = 'administrasi/cetakulang_view';
		$data['left_view'] = 'menuadministrasi.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('cetakulang/get_surat');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============		
	
		// ====================== Ambil Data Hasil Post =====================
			$nobps_cbox = $this->input->post('nobps_check');
			$tahun_cbox = $this->input->post('tahun_check');
			
			$nobps = $this->input->post('nobps1')."". $this->input->post('counterbps') ."". $this->input->post('nobps2')."". $this->input->post('nobpstahun');
			
			$tahun= $this->input->post('cbotahun');
			
			//echo $bernpwpradio;
  			
		// ====================== Ambil Data Hasil Post =====================
			$chk = $nobps_cbox + $tahun_cbox;
			//echo $chk;
		if($chk == 0)
		{
			$this->session->set_flashdata('message', 'Pilih / Check Kriteria Pencarian!');
			redirect('cetakulang');	
		}
		else
		{
			Switch($chk){
				case 1:
					//echo "No BPS";
					$kriteria = "WHERE D.bps = '$nobps'";
					break;
				case 3:	
					//echo "Tahun";
					$kriteria = "WHERE right(D.bps,4) = '$tahun'";
					break;
				case 4:
					//echo "No BPS dan Tahun";
					$kriteria = "WHERE D.bps = '$nobps' AND right(D.bps,4) = '$tahun'";
					//echo $kriteria;
					break;
			}
			
			//echo $kriteria;
			// Load data
		$dokumen = $this->Surat_model->get_dokumendata($kriteria);
		$dokumenhasil = $dokumen->result();
		$num_rows = $dokumen->num_rows();
		$dokumenbaris = $dokumen->row();
		
		if ($num_rows > 0)
		{
			if ($num_rows == 1)
			{
				// set table template for zebra row
				$tmpl = array('table_open'=>'<table border="0" cellpadding="0" cellspacing="0">',
						  'row_alt_start'=>'<tr class="zebra">',
						  'row_alt_end'=>'</tr>'
					  	);
				$this->table->set_template($tmpl);
				
				// set table header
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('NO BPS','MNPWP','NAMA','ALAMAT','PERIHAL','AKSI');
								
	//			foreach ($anggota as $row)
	//			{
					$this->table->add_row($dokumenbaris->bps, $dokumenbaris->mnpwp, $dokumenbaris->NAMA, $dokumenbaris->ALAMAT, $dokumenbaris->perihal, anchor('cetakulang/detail/'.$dokumenbaris->bps,'Detail',array('class' => 'update')));
//			}
				
				$data['table'] = $this->table->generate();
				//$this->load->view('template', $data);
			}
			else
			{
				// set table template for zebra row
				$tmpl = array('table_open'=>'<table border="0" cellpadding="0" cellspacing="0">',
						  'row_alt_start'=>'<tr class="zebra">',
						  'row_alt_end'=>'</tr>'
					  	);
				$this->table->set_template($tmpl);
				
				// set table header
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('NO BPS','mNPWP','NAMA','ALAMAT','PERIHAL','AKSI');
								
				foreach ($dokumenhasil as $row)
				{
					$this->table->add_row($row->bps, $row->mnpwp, $row->NAMA, $row->ALAMAT, $row->perihal, anchor('cetakulang/detail/'.$row->bps,'Detail',array('class' => 'update')));
				}
				
				$data['table'] = $this->table->generate();
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ditemukan!');
			redirect('cetakulang');	
		}
	}
		$this->load->view('template', $data);
	}

	function detail()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Detail Dokumen';
		$data['main_view'] = 'administrasi/cetakulang_print';
		$data['left_view'] = 'menuadministrasi.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('cetakulang/cetak_dokumen');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment)."/WPJ/32/PPK.05/" . $this->uri->segment(7);
		
		$kriteria = " WHERE d.bps = '" . $offset ."'";
		$dokumene = $this->Surat_model->get_dokumendata($kriteria);
		$dokumennya = $dokumene->row();

		$data['default']['nobps'] = $dokumennya->bps;
		$data['default']['mnpwp'] = $dokumennya->MNPWP;
		$data['default']['nama'] = $dokumennya->NAMA;
		$data['default']['alamat'] = $dokumennya->ALAMAT;
		$data['default']['tglterima'] = date("j F Y",strtotime($dokumennya->tglterima));
		$data['default']['masa'] = $dokumennya->masabulanpajak;
		$data['default']['tahun'] = $dokumennya->masatahunpajak;
		$data['default']['status'] = $dokumennya->statuskirim;
		$data['default']['jenisdokumen'] = $dokumennya->jenisdokumen .'  '. $dokumennya->jenispajak;
		$data['default']['jumlah'] = $this->separator($dokumennya->nominalnkl);			
		$this->load->view('template', $data);
	}	
	
	function cetak_dokumen()
	{
			$bps = $this->input->post('nobps');
			$mnpwp = $this->input->post('mnpwp');
			$nama = $this->input->post('nama');	
			$alamat= $this->input->post('alamat');
			$tglterima = $this->input->post('tglterima');
			$masa = $this->input->post('masa');	
			$tahun = $this->input->post('tahun');
			$status = $this->input->post('status');
			$jumlah = $this->input->post('jumlah');	
			$jenisdokumen = $this->input->post('jenisdokumen');
			
			//===============================================================================
			$pdf = new FPDF("L","cm", array(21, 14.7));
 
			// Fungsi untuk membuat halaman
			$pdf->AddPage();
 
			$pdf->Image('asset/images/logopajak.jpg',1,0.5,3,3);
    		$pdf->SetFont('Arial','B',15);
    		$pdf->Cell(4);
			$pdf->Cell(0  ,0.6,'KEMENTERIAN KEUANGAN REPUBLIK INDONESIA',0,'LR', 'C');
			$pdf->Ln();
    		$pdf->Cell(4);
			$pdf->Cell(0  ,0.6,'DIREKTORAT JENDERAL PAJAK',0,'LR', 'C');
			$pdf->Ln();
    		$pdf->Cell(4);
			$pdf->Cell(0  ,0.6,'KANTOR WILAYAH DJP JAWA TENGAH II',0,'LR', 'C');
			$pdf->Ln();
    		$pdf->Cell(4);
    		$pdf->SetFont('Arial','',10);
			$pdf->Cell(0  ,0.6,'KANTOR PELAYANAN PENYULUHAN DAN KONSULTASI PERPAJAKAN BANJARNEGARA',0,'LR', 'C');
			$pdf->Ln();
						
			$pdf->Cell(4);
    		$pdf->SetFont('Arial','',8);
			$pdf->Cell(0  ,0.6,'Jalan Stadion 2 Banjarnegara 53412                  Telp :  (0286) 591097',0,'LR', 'C');
			$pdf->Ln();
			
			$pdf->Cell(4);
    		$pdf->SetFont('Arial','',8);
			$pdf->Cell(0  ,0.6,'http:/www.pajak.go.id                                         Fax :  (0286) 591097',0,'LR', 'C');
			
    		$pdf->Line(1,4.5,20,4.5);
			$pdf->Ln();
			$pdf->Ln();
			
    		$pdf->SetFont('Arial','B',14);
			$pdf->Cell(0  ,0.6,'BUKTI PENERIMAAN SURAT',0,'LR', 'C');
			$pdf->Ln();
			
			//================================
    		$pdf->SetFont('Arial','',11);
			$pdf->Cell(0  ,0.6,'NO : ' .$bps ,0,'LR', 'C');
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(1.8 ,0.6,'MNPWP',0,0, 'L');
			$pdf->Cell(0.3 ,0.6,' : ',0,0, 'C');
			$pdf->Cell(8 ,0.6, $mnpwp ,0,0, 'L');
			
			$pdf->Cell(2.8 ,0.6,'Tanggal Terima',0,0,'L');
			$pdf->Cell(0.3 ,0.6,':',0,0, 'L');
			$pdf->Cell(8 ,0.6, $tglterima,0,1, 'L');

			$x1 = $pdf->GetX();
			$pdf->Cell(1.8 ,0.6,'Nama',0,0, 'L');
			$pdf->Cell(0.3 ,0.6,' : ',0,0, 'C');	
			
			$x = $pdf->GetX();
			$y = $pdf->GetY();		
			$pdf->MultiCell(7 ,0.6, $nama ,0,'J',0,0,'',false);
			
			$pdf->SetXY($x + 8, $y);
		
			$pdf->Cell(2.8 ,0.6,'Masa',0,0,'L');
			$pdf->Cell(0.3 ,0.6,':',0,0, 'L');
			$pdf->Cell(0 ,0.6, $masa,0,1,'L');

			$pdf->SetXY($x1, $y + 1.2);
			$pdf->Cell(1.8 ,0.6,'Alamat',0,0, 'L');
			$pdf->Cell(0.3 ,0.6,' : ',0,0, 'C');
			$pdf->MultiCell(7 ,0.6, $alamat ,0,'J',0,0,'',false);

			$pdf->SetXY($x + 8, $y+0.6);
			$pdf->Cell(2.8 ,0.6,'Tahun Pajak',0,0,'L');
			$pdf->Cell(0.3 ,0.6,':',0,0, 'L');
			$pdf->Cell(0 ,0.6, $tahun,0,1,'L');
			
			$pdf->SetXY($x + 8, $y+1.2);
			$pdf->Cell(2.8 ,0.6,'Status',0,0,'L');
			$pdf->Cell(0.3 ,0.6,':',0,0, 'L');
			$pdf->Cell(0 ,0.6, $status,0,1,'L');
			
			$pdf->SetXY($x1, $y + 2.4);
			$pdf->Cell(1.8 ,0.6,'Jenis',0,0, 'L');
			$pdf->Cell(0.3 ,0.6,' : ',0,0, 'C');
			$pdf->Cell(8 ,0.6, $jenisdokumen ,0,0, 'L');	
			
			$pdf->SetXY($x + 8, $y+1.8);
			$pdf->Cell(2.8 ,0.6,'Jumlah',0,0,'L');
			$pdf->Cell(0.3 ,0.6,':',0,0, 'L');
			$pdf->Cell(0 ,0.6, $jumlah,0,1,'L');
			$pdf->Ln();

			$pdf->Cell(10 ,0.6,'',0,'LR', 'L');
			$pdf->Cell(10 ,0.6,'Banjarnegara,' . $tglterima ,0,'LR', 'L');
			$pdf->Cell(10 ,0.6,'',0,'LR', 'L');
			$pdf->Cell(10 ,0.6,'Penerima' ,0,'LR', 'L');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(10 ,0.6,'',0,'LR', 'L');
			$pdf->Cell(10 ,0.6,'________________' ,0,'LR', 'L');
	        $pdf->Output();
		
	}
}
