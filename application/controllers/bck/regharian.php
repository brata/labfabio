<?php
/**
 * RegHarian Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
  
class Regharian extends CI_Controller {
	/**
	 * Constructor
	 */
	function Regharian()
	{
		parent::__Construct();
		$this->load->model('Administrasi_model', '', TRUE);	
        $this->load->library('FPDF_AutoWrapTableHarian');
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Register Harian';
	
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
		$data['h2_title'] = 'Register Harian';
		$data['main_view'] = 'administrasi/regharian_view';
		$data['left_view'] = 'menuadministrasi.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('regharian/cetak_regharian');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
				
		$this->load->view('template', $data);
	}
	
	function cetak_regharian()
	{
		$tgl = $this->input->post('tglterima');
		
		$regharian = $this->Administrasi_model->get_dokumenall($tgl);
		$data = $regharian->result();
		$datarow = $regharian->row();	

		//pilihan
		$options = array(
			'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
			'destinationfile' => '', //I=inline browser (default), F=local file, D=download
			'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
			'orientation'=>'L' //orientation: P=portrait, L=landscape
			);
			
		//head
		$isihead  = array(
			'tanggal' => date("j F Y",strtotime($datarow->tglterima))
			);

		$tabel = new FPDF_AutoWrapTableHarian($data,$options,$isihead);
		$tabel->printPDF();
		

//===================== Cara Lama ===============================
//	$this->fpdf->FPDF('L','cm','A4');
//	$this->fpdf->AddPage();
//	$this->fpdf->Ln();
//	$this->fpdf->setFont('Arial','B',9);
//	$this->fpdf->Text(11,1,'DAFTAR SPT YANG DITERIMA DI KP2KP BANJARNEGARA');
//	$this->fpdf->Line(21,1.3,10,1.3);            
//	$this->fpdf->setFont('Arial','B',7);
//	$this->fpdf->Text(14,1.9,'Tanggal : ' . $tgl);
//	$this->fpdf->ln(1.6);
//	//$this->fpdf->write(0,'Tampilan Table MySql Dengan FPDF');
//	$this->fpdf->ln(0.3);
//	$this->fpdf->Cell(4.5,0.5,'BPS',1,0,'C');
//	$this->fpdf->Cell(3,0.5,'MNPWP',1,0,'C');
//	$this->fpdf->Cell(5.5,0.5,'WAJIB PAJAK',1,0,'C');
//	$this->fpdf->Cell(2.5,0.5,'SPT',1,0,'C');
//	$this->fpdf->Cell(2.5,0.5,'PAJAK',1,0,'C');
//	$this->fpdf->Cell(2,0.5,'MASA',1,0,'C');
//	$this->fpdf->Cell(2,0.5,'TAHUN',1,0,'C');
//	$this->fpdf->Cell(2,0.5,'N/K/L',1,0,'C');
//	$this->fpdf->Cell(3,0.5,'NOMINAL',1,0,'C');
//	
//	$this->fpdf->Ln();
//	
//	$query=$this->Administrasi_model->get_dokumenall($tgl);
//		foreach ($query->result() as $row)
//		{
//			$this->fpdf->Cell(4.5,0.5,$row->bps,1,0,'C');
//			$this->fpdf->Cell(3,0.5,$row->mnpwp,1,0,'L');
//			$this->fpdf->Cell(5.5,0.5,$row->NAMA,1,0,'L');
//			$this->fpdf->Cell(2.5,0.5,$row->jenisdokumen,1,0,'L');
//			$this->fpdf->Cell(2.5,0.5,$row->jenispajak,1,0,'L');
//			$this->fpdf->Cell(2,0.5,$row->masabulanpajak,1,0,'L');
//			$this->fpdf->Cell(2,0.5,$row->masatahunpajak,1,0,'L');
//			$this->fpdf->Cell(2,0.5,$row->nkl,1,0,'L');
//			$this->fpdf->Cell(3,0.5,$row->nominalnkl,1,0,'L');
//			$this->fpdf->Ln();
//		}
//	
//	$this->fpdf->Output();
//===================== Cara Lama ===============================
	}
}
