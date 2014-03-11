<?php
/**
 * BerNPWP Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Bernpwp extends CI_Controller {
	/**
	 * Constructor
	 */
	function Bernpwp()
	{
		parent::__Construct();
		$this->load->model('Surat_model', '', TRUE);
		$this->load->model('Info_model', '', TRUE);
		$this->load->library('session');
        $this->load->library('cfpdf');
	}
	
	var $title = 'Surat';
	
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
		$data['h2_title'] = 'Surat Ber-NPWP';
		$data['main_view'] = 'surat/bernpwp_view';
		$data['left_view'] = 'menusurat.php';
		$data['user'] = $this->session->userdata('username');		
		$data['form_action'] = site_url('bernpwp/add_dokumen');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		$data['option_stskirim'] = $this->Surat_model->getStsKirim();
		
	//========================== Awal counter BPS =========================
		$countbpse = $this->Surat_model->get_counterbps();
		$counterbpsnya = $countbpse->row();
		$num_rows=$countbpse->num_rows();
		
		//echo $num_rows;		
		
		if($counterbpsnya->countbps == 0)
		{
			$data['default']['counterbps']= "1";
		}
		else
		{
			$data['default']['counterbps']=$counterbpsnya->countbps;			
		}

		
	//========================== Akhir counter BPS ========================
						
		$this->load->view('template', $data);
	}
	
	function add_dokumen()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Surat Ber-NPWP';
		$data['main_view'] = 'surat/bernpwp_print';
		$data['left_view'] = 'menusurat.php';
		$data['user'] = $this->session->userdata('username');		
		$data['form_action'] = site_url('bernpwp/cetak_dokumen');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		$data['option_stskirim'] = $this->Surat_model->getStsKirim();
		//========================== Awal counter BPS =========================
		$countbpse = $this->Surat_model->get_counterbps();
		$counterbpsnya = $countbpse->row();
		//echo $counterbpsnya->counterbps;
		$data['default']['counterbps']=$counterbpsnya->countbps;
		
		//========================== Akhir counter BPS ========================
		
		// ====================== Set validation rules ======================
			//$this->form_validation->set_rules('npwp1', 'NPWP', 'required');
			$this->form_validation->set_rules('tglterima', 'Tanggal Terima', 'required');
			$this->form_validation->set_rules('perihal', 'Perihal', 'required');
			$this->form_validation->set_rules('tglsurat', 'Tanggal Surat', 'required');
			$this->form_validation->set_rules('stskirim', 'Status Pengiriman', 'required');
		// ====================== Set validation rules ======================
		
		// ====================== Ambil Data Hasil Post =====================
//			$bps = $this->input->post('nobps1')."". $this->input->post('counterbps') ."". $this->input->post('nobps2')."". $this->input->post('nobpstahun'); Rubah Disini
			$bps = $this->input->post('nobps1')."". $counterbpsnya->countbps ."". $this->input->post('nobps2')."". $this->input->post('nobpstahun');
			
//			$countbps =  $this->input->post('counterbps'); sama disini
			$countbps =  $counterbpsnya->countbps;
  			$mnpwp1 = $this->input->post('mnpwp1');
   			$mnpwp3 = $this->input->post('mnpwp3'); 			
  			$mnpwp = $mnpwp1 ."-529." . $mnpwp3;
  			
  			echo $mnpwp;
  			
  			$idstatuskirim = $this->input->post('stskirim');
  			$tglterima= $this->input->post('tglterima');
  			$perihal= $this->input->post('perihal');
  			$tglsurat= $this->input->post('tglsurat');
  			$jmlcetak= "0";
			//$jmlcetak= $this->input->post('jmlcetak');
  			$idjenisdokumen= "1";  			
  			//$idjenisdokumen= $this->input->post('idjenisdokumen');
  			$usrNama= $this->session->userdata('username');
  			//$usrNama= $this->input->post('usrNama');
  			$idjenispajak= "0";
  			//$idjenispajak= $this->input->post('idjenispajak');
  			$masabulanpajak= "0";
  			//$masabulanpajak= $this->input->post('masabulanpajak');
  			$masatahunpajak= "0";
  			//$masatahunpajak= $this->input->post('masatahunpajak');
  			$idstatuspembetulan= "0";
  			//$idstatuspembetulan= $this->input->post('idstatuspembetulan');
  			$idnkl= "0";
  			//$idnkl= $this->input->post('idnkl');
  			$nominalnkl= "0";
  			//$nominalnkl= $this->input->post('nominalnkl');
  			$idrestkompen= "0";
  			//$idrestkompen= $this->input->post('idrestkompen');
  			//$idstatuskirim= "0";
  			$nominalrestkompen="0";
  			//$nominalrestkompen= $this->input->post('nominalrestkompen');
  			$noketetapan= "0";
  			//$noketetapan= $this->input->post('noketetapan');
  			$tglbayar= "0";
  			//$tglbayar= $this->input->post('tglbayar');
  			$eorm= "m";
  			//$eorm= $this->input->post('eorm');
  			$filecsv= "0";
  			//$filecsv= $this->input->post('filecsv');
		// ====================== Ambil Data Hasil Post =====================

		if ($this->form_validation->run() == TRUE)
		{
		// ====================== Save Data =================================
			$dokumen = array('bps' => $bps ,'counterbps' => $countbps,'mnpwp' => $mnpwp ,'idstatuskirim' => $idstatuskirim,'tglterima' => $tglterima ,'perihal' => $perihal ,'tglsurat' => $tglsurat,'jmlcetak' => $jmlcetak ,'idjenisdokumen' => $idjenisdokumen,'usrNama' => $usrNama ,'idjenispajak' => $idjenispajak ,'masabulanpajak' => $masabulanpajak ,'masatahunpajak' => $masatahunpajak,'idstatuspembetulan' => $idstatuspembetulan,'idnkl' => $idnkl,'nominalnkl' => $nominalnkl,'idrestkompen' => $idrestkompen,'nominalrestkompen' => $nominalrestkompen,'noketetapan' => $noketetapan,'tglbayar' => $tglbayar,'eorm' => $eorm,'filecsv' => $filecsv);
			
			$this->Surat_model->add($dokumen);
			
			$this->session->set_flashdata('message', 'Satu data surat berhasil disimpan!');
						
			//redirect('bernpwp/add_dokumen');				
		// ====================== Save Data =================================
		
		}		
		//======================= Awal Validate NPWP =======================
		//======================= Akhir Validate NPWP =======================
		$nmalmtnpwpe = $this->Surat_model->get_namaalamatmnpwp($mnpwp);
		$nmalmtnpwpnya = $nmalmtnpwpe->row();
		
		$data['default']['nobps'] = $bps;
		$data['default']['mnpwp'] = $mnpwp;
		$data['default']['nama'] = $nmalmtnpwpnya->NAMA;
		$data['default']['alamat'] = $nmalmtnpwpnya->ALAMAT;
		$data['default']['tglterima'] = $tglterima;
		$data['default']['masa'] = $masabulanpajak;
		$data['default']['tahun'] = $masatahunpajak;
		$data['default']['status'] = $idstatuskirim;
		$data['default']['jumlah'] = "0";
		
		
		//echo $nmalmtnpwpnya->NAMA;
		//echo $nmalmtnpwpnya->ALAMAT;
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
			
			//=================================================
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
			$pdf->Cell(8 ,0.6, 'SURAT' ,0,0, 'L');	
			
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
