<?php
/**
 * Home Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Home extends CI_Controller {
	/**
	 * Constructor
	 */
	function home()
	{
		parent::__Construct();
		$this->load->model('Home_model', '', TRUE);
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Home';
	
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
		$data['h2_title'] = 'Home';
		$data['main_view'] = 'home/deskripsi';
		$data['left_view'] = 'menuhome.php';
		$data['user'] = $this->session->userdata('username');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============		
				
		$this->load->view('template', $data);
	}
}
