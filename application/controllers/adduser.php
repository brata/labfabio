<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

class Adduser extends CI_Controller {
	/**
	 * Constructor
	 */
	function adduser()
	{
		parent::__Construct();
		$this->load->model('User_model', '', TRUE);
	}
	
	var $title = 'Tambah Pengguna';
	
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
		$data['h2_title'] = 'Administrasi Pengguna';
		$data['main_view'] = 'user/adduser_view';
		$data['left_view'] = 'menuuser.php';
		$data['form_action'] = site_url('adduser/tambahuser');
		$data['user'] = $this->session->userdata('username');
		
		$data['option_grppengguna'] = $this->User_model->getGrpPengguna();
		$data['default']['readusrnama'] = 'readonly';
		
		$this->load->view('templateadmin', $data);

	}
	
	function tambahuser()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Administrasi Pengguna';
		$data['main_view'] = 'user/datauser_view';
		$data['left_view'] = 'menuuser.php';
		//$data['form_action'] = 'adminuser/ubahuser';
		$data['user'] = $this->session->userdata('username');
		
		$usrnama=$this->input->post('usrnama');
		$password=$this->input->post('passwd1');
		$grppengguna=$this->input->post('grppengguna');
		$profil=$this->input->post('profil');
		$tanya=$this->input->post('tanya');
		$jawab=$this->input->post('jawab');
		
					$user = array('usrNama' 		=> $usrnama,
							'usrPassword'		=> $password,
							'namaGroup'	=> $grppengguna,
							'usrProfil' 		=> $profil,
							'usrPertanyaan'		=> $tanya,
							'usrJawaban'	=> $jawab
						);
		
		$this->User_model->insert($user);		
		
		$this->session->set_flashdata('message', 'Satu data pengguna berhasil diubah');
	
		redirect('adminuser');
	}

}
?>