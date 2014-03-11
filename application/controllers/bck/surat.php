<?php
/**
 * Surat Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Surat extends CI_Controller {
	/**
	 * Constructor
	 */
	function surat()
	{
		parent::__Construct();
		$this->load->model('Surat_model', '', TRUE);
		$this->load->model('Info_model', '', TRUE);
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
		$data['h2_title'] = 'Surat';
		$data['main_view'] = 'surat/surat_view';
		$data['left_view'] = 'menusurat.php';
		$data['user'] = $this->session->userdata('username');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
				
		$this->load->view('template', $data);
	}
}
