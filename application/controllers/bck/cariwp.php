<?php
/**
 * CariWP Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Cariwp extends CI_Controller {
	/**
	 * Constructor
	 */
	function Cariwp()
	{
		parent::__Construct();
		$this->load->model('Support_model', '', TRUE);
		$this->load->model('Info_model', '', TRUE);
		$this->load->library('table');
	}
	
	var $title = 'Cari WP';
	
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
		$data['h2_title'] = 'Cari WP';
		$data['main_view'] = 'support/cariwp_view';
		$data['left_view'] = 'menusupport.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('cariwp/get_wp');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
				
		$this->load->view('template', $data);
	}
	
	function get_wp()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Cari WP';
		$data['main_view'] = 'support/cariwp_view';
		$data['left_view'] = 'menusupport.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('cariwp/get_wp');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		$mnpwp_cbox = $this->input->post('mnpwp_check');
		$namawp_cbox = $this->input->post('namawp_check');			
		$alamatwp_cbox =  $this->input->post('alamatwp_check');
			
		$mnpwp = $this->input->post('mnpwp');
		$nama = $this->input->post('namawp');
		$alamat= $this->input->post('alamatwp');
				
		// ====================== Ambil Data Hasil Post =====================
			$chk = $mnpwp_cbox + $namawp_cbox + $alamatwp_cbox;
			//echo $chk;
			
			if($chk == 0)
			{
				$this->session->set_flashdata('message', 'Pilih / Check Kriteria Pencarian!');
				redirect('cariwp');	
			}
			else
			{
			Switch($chk){
				case 1:
					//echo "No BPS";
					$kriteria = "WHERE MNPWP = '$mnpwp'";
					break;
				case 3:	
					//echo "NPWP";
					$kriteria = "WHERE NAMA Like '%$nama%'";
					break;
				case 5:
					//echo "Nama";
					$kriteria = "WHERE ALAMAT Like '%$alamat%'";
					//echo $kriteria;
					break;
				case 4:	
					//echo "Alamat";
					$kriteria = "WHERE MNPWP = '$mnpwp' AND NAMA Like '%$nama%'";
					break;
				case 9:
					//echo "Tanggal Terima";
					$kriteria = "WHERE MNPWP = '$mnpwp' AND NAMA Like '%$nama%' AND ALAMAT Like '%$alamat%'";					
					break;
				case 8:	
					$kriteria = "WHERE NAMA LIKE '%$nama%' AND ALAMAT Like '%$alamat%'";
					break;
				}
			
			//echo $kriteria;
			
			// Load data
		$datawp = $this->Support_model->get_datanpwp($kriteria);
		$datawphasil = $datawp->result();
		$num_rows = $datawp->num_rows();
		$datawpbaris = $datawp->row();
		
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
				$this->table->set_heading('MNPWP','NAMA WAJIB PAJAK','ALAMAT','KABUPATEN','TANGGAL TERDAFTAR','NAMA KLU');
								
	//			foreach ($anggota as $row)
	//			{
					$this->table->add_row($datawpbaris->MNPWP, $datawpbaris->NAMA, $datawpbaris->ALAMAT, $datawpbaris->KT, $datawpbaris->TGL_DAFTAR, $datawpbaris->NM_KLU);
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
				$this->table->set_heading('MNPWP','NAMA WAJIB PAJAK','ALAMAT','KABUPATEN','TANGGAL TERDAFTAR','NAMA KLU');
								
				foreach ($datawphasil as $row)
				{
					$this->table->add_row($row->MNPWP, $row->NAMA, $row->ALAMAT, $row->KT, $row->TGL_DAFTAR, $row->NM_KLU);
				}
				
				$data['table'] = $this->table->generate();
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ditemukan!');
			redirect('cariwp');	
		}	
			}
		
			
		$this->load->view('template', $data);
	}
}
