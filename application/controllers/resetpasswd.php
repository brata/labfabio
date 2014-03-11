<?php
/**
 * Resetpasswd Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
  
class Resetpasswd extends CI_Controller {
	/**
	 * Constructor
	 */
	function resetpasswd()
	{
		parent::__Construct();
		$this->load->model('User_model', '', TRUE);	
		$this->load->model('Info_model', '', TRUE);
	}
	
	var $title = 'Reset Password';
	
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
		$data['main_view'] = 'user/resetpasswd_view';
		$data['left_view'] = 'menuhome.php';
		$data['user'] = $this->session->userdata('username');
		$data['form_action'] = site_url('resetpasswd/update');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		$data['default']['usrnama'] = $this->session->userdata('username');
				
		$this->load->view('template', $data);
	}
	
	function update()
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
		
		$usrnama = $this->input->post('usrnama');
		$oldpasswd = $this->input->post('oldpass');
		$passwd1 = $this->input->post('newpass1');
		$passwd2 = $this->input->post('newpass2');
		
		$datapass = $this->User_model->get_datauser_byusernama($usrnama);
		$datapassbaris = $datapass->row();
		
//		echo $datapassbaris->usrPassword;
//		echo $oldpasswd;
//		echo $passwd1;
		
		if($oldpasswd == $datapassbaris->usrPassword)
		{
			$this->User_model->reset_byuser($usrnama,$passwd1);
		}
		else
		{
			$this->session->set_flashdata('message', 'Password Anda tidak berhasil dirubah, password lama anda salah!');
			redirect('home');
		}
		
		$this->session->set_flashdata('message', 'Password Anda berhasil dirubah!');
		redirect('home');
	}
}
