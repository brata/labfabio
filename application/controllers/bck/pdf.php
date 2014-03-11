<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

	class Pdf extends CI_Controller {
		
	    function Pdf()
	    {
	        parent::__construct();
	 
        /* tarik library Cfpdf supaya aktif, bisa juga diletakkan di dalam fungsi
        yang menjalankan pembuatan file PDF, atau kalau nggak mau repot sering menarik
        librarynya masukkan saja ke dalam autoload */
	 
        $this->load->library('cfpdf');
	    }
	 
		function index()
  		{
    	
		}	 
	    function buatpdf()
	    {
	        $pdf = new FPDF();
//	        $pdf->AddPage();
//	        $pdf->SetFont('Arial','',12);
//	        $teks = "Cara Gampang Integrasi FPDF dengan Codeigniter";
//	        // mencetak 10 baris kalimat dalam variable "teks".

			$pdf = new FPDF("L","cm", array(21, 9));
 
			// Fungsi untuk membuat halaman
			$pdf->AddPage();
 
			// Fungsi untuk setting margin halaman (kiri, atas, kanan)
			$pdf->SetMargins(1,0.5,1);
 
			$pdf->Ln();
			$pdf->SetFont('Helvetica','',9);
			$pdf->Line(1   ,1.7,20,1.7);
 
			$pdf->Cell(1    ,0.5,'No'          ,0,'LR', 'C');
			$pdf->Cell(2.4  ,0.5,'Kode'        ,0,'LR', 'L');
			$pdf->Cell(10.4 ,0.5,'Mata Kuliah' ,0,'LR', 'L');
			$pdf->Cell(12.2  ,0.5,'SKS'         ,0,'LR', 'L');
 
 			$pdf->Ln();
			$pdf->SetFont('Helvetica','',9);
			$pdf->Ln();
 			$pdf->Cell(1    ,0.5,'1'          ,0,'LR', 'C');
			$pdf->Cell(2.4  ,0.5,'MKDU100'        ,0,'LR', 'L');
			$pdf->Cell(10.4 ,0.5,'Kewiraan' ,0,'LR', 'L');
			$pdf->Cell(12.2  ,0.5,'3'         ,0,'LR', 'L');
			$pdf->Line(1   ,8.2, 20, 8.2);
 
	        $pdf->Output();
	    }
	}
?>