<?php
/**
 * Home Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Adminuser extends CI_Controller {
	/**
	 * Constructor
	 */
	function adminuser()
	{
		parent::__Construct();
		$this->load->model('User_model', '', TRUE);
		$this->load->library('table');
		$this->load->helper('form');
	}
	
	var $title = 'Administrasi Pengguna';
	
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
		$data['main_view'] = 'user/datauser_view';
		$data['left_view'] = 'menuuser.php';
		//$data['form_action'] = 'adminuser/ubahuser';
		$data['user'] = $this->session->userdata('username');
		
		$datauser = $this->User_model->get_datauserall();
		$datauserhasil = $datauser->result();
		$num_rows = $datauser->num_rows();
		$datauserbaris = $datauser->row();
		
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
				$this->table->set_heading('NAMA PENGGUNA','NAMA GROUP','PROFIL PENGGUNA','AKSI');
								
	//			foreach ($anggota as $row)
	//			{
					$this->table->add_row($dokumenbaris->usrNama, $dokumenbaris->namaGroup, $dokumenbaris->usrProfil, anchor('adminuser/ubah/'.$dokumenbaris->usrNama,'Ubah',array('class' => 'update')). ' | '. anchor('adminuser/hapus/'.$dokumenbaris->usrNama,'Hapus',array('class' => 'hapus','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")) .' | '. anchor('adminuser/reset/'.$dokumenbaris->usrNama,'Reset Password',array('class' => 'reset')));
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
				$this->table->set_heading('NAMA PENGGUNA','NAMA GROUP','PROFIL PENGGUNA','AKSI');
								
				foreach ($datauserhasil as $row)
				{
					$this->table->add_row($row->usrNama, $row->namaGroup, $row->usrProfil, anchor('adminuser/ubah/'.$row->usrNama,'Ubah',array('class' => 'update')). ' | '. anchor('adminuser/hapus/'.$row->usrNama,'Hapus',array('class' => 'hapus', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")) .' | '. anchor('adminuser/reset/'.$row->usrNama,'Reset Password',array('class' => 'reset', 'onclick'=>"return confirm('Anda yakin akan me-Reset Password dari Pengguna ini menjadi 123456 ?')")));
				}
				
				$data['table'] = $this->table->generate();
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ditemukan!');
			redirect('adminuser');	
		}
				
		$this->load->view('templateadmin', $data);
	}
	
	function hapus($usrnama)
	{
		$this->User_model->delete($usrnama);
		$this->session->set_flashdata('message', 'Satu data pengguna berhasil dihapus');
		
		redirect('adminuser');
	}
	
	function reset($usrnama)
	{
		$this->User_model->reset($usrnama);
		$this->session->set_flashdata('message', 'Satu password pengguna berhasil di-reset');
		
		redirect('adminuser');
	}
	
	function ubah($usrnama)
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Ubah Pengguna';
		$data['main_view'] = 'user/edituser_view';
		$data['left_view'] = 'menuuser.php';
		$data['form_action'] = site_url('adminuser/ubahuser');		
		$data['default']['readusrnama'] = "TRUE";
		$data['user'] = $this->session->userdata('username');
		
		$data['option_grppengguna'] = $this->User_model->getGrpPengguna();
		
		$datauser = $this->User_model->get_datauser_byusernama($usrnama);
		$datauserbaris = $datauser->row();
		
		//echo $datauserbaris->namaGroup;
		
		$data['default']['usrnama'] = $datauserbaris->usrNama;
		$data['default']['readusrnama'] = 'TRUE';
		$data['default']['passwd1'] = "********";
		$data['default']['passwd2'] = "********";
		$data['default']['grppengguna'] = $datauserbaris->namaGroup;
		$data['default']['profil'] = $datauserbaris->usrProfil;
		$data['default']['tanya'] = $datauserbaris->usrPertanyaan;
		$data['default']['jawab'] = $datauserbaris->usrJawaban;
		
		$this->load->view('templateadmin', $data);		
	}
	
	function ubahuser()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Administrasi Pengguna';
		$data['main_view'] = 'user/datauser_view';
		$data['left_view'] = 'menuuser.php';
		//$data['form_action'] = 'adminuser/ubahuser';
		$data['user'] = $this->session->userdata('username');
		
		$usrnama=$this->input->post('usrnama');
		$grppengguna=$this->input->post('grppengguna');
		$profil=$this->input->post('profil');
		$tanya=$this->input->post('tanya');
		$jawab=$this->input->post('jawab');
		
		$this->User_model->update($usrnama,$grppengguna,$profil,$tanya,$jawab);		
		
		$this->session->set_flashdata('message', 'Satu data pengguna berhasil diubah');
	
		redirect('adminuser');
	}
}
