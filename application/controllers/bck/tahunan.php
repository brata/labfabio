<?php
/**
 * Tahunan Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Tahunan extends CI_Controller {
	/**
	 * Constructor
	 */
	function Tahunan()
	{
		parent::__Construct();
		$this->load->model('SPT_model', '', TRUE);
		$this->load->model('Surat_model', '', TRUE);
		$this->load->helper('datecbo');
        $this->load->library('cfpdf');	
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Tahunan';
	
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
		$data['h2_title'] = 'SPT Tahunan';
		$data['main_view'] = 'spt/tahunan_view';
		$data['left_view'] = 'menuspt.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('tahunan/add_tahunan');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		$data['option_stskirim'] = $this->SPT_model->getStsKirim();
		$data['option_jenisspt'] = $this->SPT_model->getJenisSPT('4');
		$data['option_jenispajak'] = $this->SPT_model->getJenisPajak('4');
		$data['option_stspembetulan'] = $this->SPT_model->getPembetulan();
		$data['option_nkl'] = $this->SPT_model->getNKL();
		$data['option_restkompen'] = $this->SPT_model->getRestKompen();

		
		//========================== Awal counter BPS =========================
		$countbpse = $this->SPT_model->get_counterbps();
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
		
		if(date('n')== 1 )
		{
			$data['default']['defaultbulan']= 12;
			$data['default']['defaulttahun']= date('Y')-1;			
		}
		else
		{
			$data['default']['defaultbulan']= date('n')-1;
			$data['default']['defaulttahun']= date('Y');
		}
		
		//========================== Akhir counter BPS ========================
						
		$this->load->view('template', $data);
	}
	
	function separator($num, $suffix = '')
	{
 		$ina_format_number = number_format($num, 3, ',','.');
		$result = str_replace(',000',$suffix,$ina_format_number) ;
 
		return $result ;
	}
	
	function add_tahunan()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'SPT Tahunan';
		$data['main_view'] = 'spt/tahunan_print';
		$data['left_view'] = 'menuspt.php';
		$data['user'] = $this->session->userdata('username');		
		$data['form_action'] = site_url('tahunan/cetak_dokumen');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	

		$data['option_stskirim'] = $this->SPT_model->getStsKirim();
		$data['option_jenisspt'] = $this->SPT_model->getJenisSPT('4');
		$data['option_jenispajak'] = $this->SPT_model->getJenisPajak('4');
		$data['option_stspembetulan'] = $this->SPT_model->getPembetulan();
		$data['option_nkl'] = $this->SPT_model->getNKL();
		$data['option_restkompen'] = $this->SPT_model->getRestKompen();

		
		//========================== Awal counter BPS =========================
		$countbpse = $this->SPT_model->get_counterbps();
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
		
		if(date('n')== 1 )
		{
			$data['default']['defaultbulan']= 12;
			$data['default']['defaulttahun']= date('Y')-1;			
		}
		else
		{
			$data['default']['defaultbulan']= date('n')-1;
			$data['default']['defaulttahun']= date('Y');
		}
		
		//========================== Akhir counter BPS ========================
		
				// ====================== Set validation rules ======================
			//$this->form_validation->set_rules('npwp', 'NPWP', 'required');			
			//$this->form_validation->set_rules('tglterima', 'Tanggal Terima', 'required');
			//$this->form_validation->set_rules('nominalrestkompen', 'Nominal Restitusi / Kompensasi', 'required');
			//$this->form_validation->set_rules('nominalnkl', 'Nominal N|K|L', 'required');
			//$this->form_validation->set_rules('noketetapan', 'Nomor Ketetapan', 'required');
			//$this->form_validation->set_rules('tglbayar', 'Tanggal Bayar', 'required');
		// ====================== Set validation rules ======================
		
		// ====================== Ambil Data Hasil Post =====================
//			$bps = $this->input->post('nobps1')."". $this->input->post('counterbps') ."". $this->input->post('nobps2')."". $this->input->post('nobpstahun');
//			$countbps =  $this->input->post('counterbps');
			
			$bps = $this->input->post('nobps1')."". $counterbpsnya->countbps ."". $this->input->post('nobps2')."". $this->input->post('nobpstahun');
			$countbps =  $counterbpsnya->countbps;			
  			$npwp = $this->input->post('npwp');
                        //echo $npwp;

  			$mnpwp = $this->input->post('mnpwp1') ."-529.".$this->input->post('mnpwp3') ;
  			$idstatuskirim = $this->input->post('stskirim');
  			$tglterima= $this->input->post('tglterima');
  			$perihal= $this->input->post('perihal');
  			$tglsurat= $this->input->post('tglsurat');
  			$jmlcetak= "0";
			//$jmlcetak= $this->input->post('jmlcetak');
  			$idjenisdokumen= "4";  			
  			//$idjenisdokumen= $this->input->post('idjenisdokumen');
  			$usrNama= $this->session->userdata('username');
  			//$usrNama= $this->input->post('usrNama');
  			//$idjenispajak= "0";
  			$idjenispajak= $this->input->post('jenispajak');
  			//$masabulanpajak= "0";
  			$masabulanpajak= $this->input->post('cbobulan');
  			//$masatahunpajak= "0";
  			$masatahunpajak= $this->input->post('cbotahun');
  			//$idstatuspembetulan= "0";
  			$idstatuspembetulan= $this->input->post('stsbetul');
  			//$idnkl= "0";
  			$idnkl= $this->input->post('kodenkl');
  			//$nominalnkl= "0";
  			$nominalnkl= $this->input->post('nominalnkl');
  			//$idrestkompen= "0";
  			$idrestkompen= $this->input->post('restkompen');
  			//$nominalrestkompen= "0";
  			$nominalrestkompen= $this->input->post('nominalrestkompen');
  			//$noketetapan= "0";
  			$noketetapan= $this->input->post('noketetapan');
  			//$tglbayar= "0";
  			$tglbayar= $this->input->post('tglbayar');
  			$eorm= "M";
  			//$eorm= $this->input->post('eorm');
  			$filecsv= "0";
  			//$filecsv= $this->input->post('filecsv');
  			
//  			//=================== Tabel NPWP =================
//  			$MNPWP= $this->input->post('mnpwp') .".".$this->input->post('mnpwpcounter');
//  			$NPWP=$this->input->post('npwp');
//  			$KPP=$this->input->post('kpp');
//  			$CAB=$this->input->post('cabang');
//  			$JENIS="0";
//  			$BTK_BDN="0";
// 			$NAMA=$this->input->post('namawp');
//  			$ALAMAT=$this->input->post('alamatwp');
//  			$KEL=$this->input->post('kelurahan');
//  			$KEC=$this->input->post('kecamatan');
//  			$KT=$this->input->post('kota');
//  			$KD_KLU="0";
//  			$NM_KLU="0";
//  			$TGL_DAFTAR="0";
//  			$TANGGAL="0";
//  			$BULAN="0";
//  			$TAHUN="0";
//  			$PKP="0";
//  			$ISNPWP="0";
//  			$NOTNPWPCOUNTER=$this->input->post('mnpwpcounter');
//  			//==================== Tabel NPWP ===============  			
		// ====================== Ambil Data Hasil Post =====================

		//if ($this->form_validation->run() == TRUE)
		//{
		// ====================== Save Data =================================
//			$datanpwp = array('MNPWP'=> $MNPWP,'NPWP'=>$NPWP,'KPP'=>$KPP,'CAB'=>$CAB,'JENIS'=>$JENIS,'BTK_BDN'=>$BTK_BDN,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'KEL'=>$KEL,'KEC'=>$KEC,'KT'=>$KT,'KD_KLU'=>$KD_KLU,'NM_KLU'=>$NM_KLU,'TGL_DAFTAR'=>$TGL_DAFTAR,'TANGGAL'=>$TANGGAL,'BULAN'=>$BULAN,'TAHUN'=>$TAHUN,'PKP'=>$PKP,'ISNPWP'=>$ISNPWP,'NOTNPWPCOUNTER'=>$NOTNPWPCOUNTER);
//			
//			$this->NPWP_model->add($datanpwp);
			
			//$this->session->set_flashdata('message', 'Satu data surat berhasil disimpan!');
			//redirect('tidakbernpwp/add_bps');	
			
			//======================================
			$dokumen = array('bps' => $bps ,'counterbps' => $countbps,'mnpwp' => $mnpwp ,'idstatuskirim' => $idstatuskirim,'tglterima' => $tglterima ,'perihal' => $perihal ,'tglsurat' => $tglsurat,'jmlcetak' => $jmlcetak ,'idjenisdokumen' => $idjenisdokumen,'usrNama' => $usrNama ,'idjenispajak' => $idjenispajak ,'masabulanpajak' => $masabulanpajak ,'masatahunpajak' => $masatahunpajak,'idstatuspembetulan' => $idstatuspembetulan,'idnkl' => $idnkl,'nominalnkl' => $nominalnkl,'idrestkompen' => $idrestkompen,'nominalrestkompen' => $nominalrestkompen,'noketetapan' => $noketetapan,'tglbayar' => $tglbayar,'eorm' => $eorm,'filecsv' => $filecsv);
			
			$this->SPT_model->add($dokumen);
			
			//$this->session->set_flashdata('message', 'Satu data surat berhasil disimpan!');
			//redirect('tahunan');
		//}			
//		$nmalmtnpwpe = $this->Surat_model->get_namaalamatmnpwp($mnpwp);
//		$nmalmtnpwpnya = $nmalmtnpwpe->row();
//			
//                //echo $npwp;
//                //echo $tglterima;        
//
//		$data['default']['nobps'] = $bps;
//		$data['default']['mnpwp'] = $mnpwp;
//		$data['default']['nama'] = $nmalmtnpwpnya->NAMA;
//		$data['default']['alamat'] = $nmalmtnpwpnya->ALAMAT;
//		$data['default']['tglterima'] = $tglterima;
//		$data['default']['masa'] = $masabulanpajak;
//		$data['default']['tahun'] = $masatahunpajak;
//		$data['default']['status'] = $idstatuskirim;
//		$data['default']['jumlah'] = $nominalnkl;
//		$this->load->view('template', $data);

		$kriteria =" WHERE d.bps = '" . $bps ."'" ;
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
			
			//===============================================
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
