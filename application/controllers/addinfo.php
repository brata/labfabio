<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

class Addinfo extends CI_Controller {
	/**
	 * Constructor
	 */
	function addinfo()
	{
		parent::__Construct();
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Tambah Info';
	
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
		$data['h2_title'] = 'Tambah Info';
		$data['main_view'] = 'info/addinfo_view';
		$data['left_view'] = 'menuinfo.php';
		$data['form_action'] = site_url('addinfo/tambahinfo');
		$data['user'] = $this->session->userdata('username');
				
		$this->load->view('templateadmin', $data);

	}
	
	function tambahinfo()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Administrasi Info';
		$data['main_view'] = 'info/datainfo_view';
		$data['left_view'] = 'menuinfo.php';
		//$data['form_action'] = 'adminuser/ubahuser';
		$data['user'] = $this->session->userdata('username');
		
		$tglawalinfo=$this->input->post('tglawalinfo');
		$tglakhirinfo=$this->input->post('tglakhirinfo');
		$info=$this->input->post('info');
		
		//echo $info;
				$infodata = array('tglawalinfo' 		=> $tglawalinfo,
							'tglakhirinfo'		=> $tglakhirinfo,
							'info'	=> $info
						);
		
		//echo $infodata;
		$this->Info_model->insert($infodata);		
		
		$this->session->set_flashdata('message', 'Satu data info berhasil ditambahkan');
	
		redirect('admininfo');
	}

}
?>