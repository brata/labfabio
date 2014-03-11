<?php
/**
 * RekapReg Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Rekapreg extends CI_Controller {
	/**
	 * Constructor
	 */
	function Rekapreg()
	{
		parent::__Construct();
		$this->load->model('Administrasi_model', '', TRUE);
		$this->load->helper('datecbo');	
        $this->load->library('FPDF');
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Rekap Register';
	
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
		$data['h2_title'] = 'Rekap Register';
		$data['main_view'] = 'administrasi/rekapreg_view';
		$data['left_view'] = 'menuadministrasi.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('rekapreg/cetak_rekap');
		
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
	
	function cetak_rekap()
	{
		$tglterima_cbox = $this->input->post('tglterima_check');
		$bulanterima_cbox = $this->input->post('bulanterima_check');
		$tahunterima_cbox = $this->input->post('tahunterima_check');
		
		$tglterimah = $this->input->post('cbotgl');
		if(strlen($tglterimah)==1) 
		{
			$tglterima="0".$tglterimah;
		}else{
			$tglterima=$tglterimah;			
		}
		
		$blnterima= $this->input->post('cbobulan');
		$thnterima= $this->input->post('cbotahun');
		
		$chk = $tglterima_cbox + $bulanterima_cbox + $tahunterima_cbox;
		
		Switch($chk){
			case 1:
				//echo "Tanggal";				
				$this->cetak_rekapregharian($tglterima,$blnterima,$thnterima);
				break;
			case 4:	
				//echo "Tanggal";
				$this->cetak_rekapregharian($tglterima,$blnterima,$thnterima);
				break;
			case 6:
				//echo "Tanggal";
				$this->cetak_rekapregharian($tglterima,$blnterima,$thnterima);
				//echo $kriteria;
				break;
			case 9:
				//echo "Tanggal";
				$this->cetak_rekapregharian($tglterima,$blnterima,$thnterima);
				//echo $kriteria;
				break;
			case 3:	
				//echo "Bulan";
				$this->cetak_rekapregbulanan($blnterima,$thnterima);
				break;
			case 8:
				//echo "Bulan";
				$this->cetak_rekapregbulanan($blnterima,$thnterima);
				//echo $kriteria;
				break;
			case 5:
				//echo "Tahun";
				$this->cetak_rekapregtahunan($thnterima);
				//echo $kriteria;
				break;
			}
			
	
	}
	
	function cetak_rekapregharian($tglterima,$blnterima,$thnterima)
	{

	$this->fpdf->FPDF('L','cm','A4');
	$this->fpdf->AddPage();
	$this->fpdf->Ln();
	$this->fpdf->setFont('Arial','B',9);
	$this->fpdf->Text(11,1,'REKAP SPT YANG DITERIMA DI KP2KP BANJARNEGARA');
	$this->fpdf->Line(21,1.3,10,1.3);            
	$this->fpdf->setFont('Arial','B',7);
	$this->fpdf->Text(14,1.9,'Tanggal : ' . $tglterima .' Bulan : ' . $blnterima . ' Tahun : ' . $thnterima);
	$this->fpdf->ln(1.6);
	//$this->fpdf->write(0,'Tampilan Table MySql Dengan FPDF');
	$this->fpdf->ln(0.3);
	$this->fpdf->Cell(2.5,0.5,'JENIS SPT',1,0,'C');
	$this->fpdf->Cell(3,0.5,'JENIS PAJAK',1,0,'C');
	$this->fpdf->Cell(2,0.5,'SPT NIHIL',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'JUMLAH SPT',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,' JUMLAH NOMINAL',1,0,'C');
	
	$this->fpdf->Ln();
	
	$query=$this->Administrasi_model->get_rekapregharian($tglterima,$blnterima,$thnterima);
		foreach ($query->result() as $row)
		{
			$this->fpdf->Cell(2.5,0.5,$row->jenisdokumen,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->jenispajak,1,0,'C');
			$this->fpdf->Cell(2,0.5,$row->JMLNIHIL,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->JMLKB,1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$row->JMLLB,1,0,'C');
			$this->fpdf->Cell(3,0.5,$this->separator($row->NOMINALKB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->NOMINALLB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->TOTALJML),1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->JMLNOMINAL),1,0,'R');
			$this->fpdf->Ln();
		}
	
	$this->fpdf->Output();

	}
	
	function cetak_rekapregbulanan($blnterima,$thnterima)
	{
		$tgl = $this->input->post('tglterima');

	$this->fpdf->FPDF('L','cm','A4');
	$this->fpdf->AddPage();
	$this->fpdf->Ln();
	$this->fpdf->setFont('Arial','B',9);
	$this->fpdf->Text(11,1,'REKAP SPT YANG DITERIMA DI KP2KP BANJARNEGARA');
	$this->fpdf->Line(21,1.3,10,1.3);            
	$this->fpdf->setFont('Arial','B',7);
	$this->fpdf->Text(14,1.9,'Bulan : ' . $blnterima . ' Tahun : ' . $thnterima);
	$this->fpdf->ln(1.6);
	//$this->fpdf->write(0,'Tampilan Table MySql Dengan FPDF');
	$this->fpdf->ln(0.3);
	$this->fpdf->Cell(2.5,0.5,'JENIS SPT',1,0,'C');
	$this->fpdf->Cell(3,0.5,'JENIS PAJAK',1,0,'C');
	$this->fpdf->Cell(2,0.5,'SPT NIHIL',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'JUMLAH SPT',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,' JUMLAH NOMINAL',1,0,'C');
	
	$this->fpdf->Ln();
	
	$query=$this->Administrasi_model->get_rekapregbulanan($blnterima,$thnterima);
		foreach ($query->result() as $row)
		{
			$this->fpdf->Cell(2.5,0.5,$row->jenisdokumen,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->jenispajak,1,0,'C');
			$this->fpdf->Cell(2,0.5,$row->JMLNIHIL,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->JMLKB,1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$row->JMLLB,1,0,'C');
			$this->fpdf->Cell(3,0.5,$this->separator($row->NOMINALKB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->NOMINALLB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->TOTALJML),1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->JMLNOMINAL),1,0,'R');
			$this->fpdf->Ln();
		}
	
	$this->fpdf->Output();

	}
	
	function cetak_rekapregtahunan($thnterima)
	{
		$tgl = $this->input->post('tglterima');

	$this->fpdf->FPDF('L','cm','A4');
	$this->fpdf->AddPage();
	$this->fpdf->Ln();
	$this->fpdf->setFont('Arial','B',9);
	$this->fpdf->Text(11,1,'REKAP SPT YANG DITERIMA DI KP2KP BANJARNEGARA');
	$this->fpdf->Line(21,1.3,10,1.3);            
	$this->fpdf->setFont('Arial','B',7);
	$this->fpdf->Text(14,1.9,'Tahun : ' . $thnterima);
	$this->fpdf->ln(1.6);
	//$this->fpdf->write(0,'Tampilan Table MySql Dengan FPDF');
	$this->fpdf->ln(0.3);
	$this->fpdf->Cell(2.5,0.5,'JENIS SPT',1,0,'C');
	$this->fpdf->Cell(3,0.5,'JENIS PAJAK',1,0,'C');
	$this->fpdf->Cell(2,0.5,'SPT NIHIL',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL KURANG BAYAR',1,0,'C');
	$this->fpdf->Cell(3,0.5,'SPT LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'NOMINAL LEBIH BAYAR',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,'JUMLAH SPT',1,0,'C');
	$this->fpdf->Cell(3.5,0.5,' JUMLAH NOMINAL',1,0,'C');
	
	$this->fpdf->Ln();
	
	$query=$this->Administrasi_model->get_rekapregtahunan($thnterima);
		foreach ($query->result() as $row)
		{
			$this->fpdf->Cell(2.5,0.5,$row->jenisdokumen,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->jenispajak,1,0,'C');
			$this->fpdf->Cell(2,0.5,$row->JMLNIHIL,1,0,'C');
			$this->fpdf->Cell(3,0.5,$row->JMLKB,1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$row->JMLLB,1,0,'C');
			$this->fpdf->Cell(3,0.5,$this->separator($row->NOMINALKB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->NOMINALLB),1,0,'R');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->TOTALJML),1,0,'C');
			$this->fpdf->Cell(3.5,0.5,$this->separator($row->JMLNOMINAL),1,0,'R');
			$this->fpdf->Ln();
		}
	
	$this->fpdf->Output();

	}
}
