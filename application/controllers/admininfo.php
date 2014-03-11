<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

class Admininfo extends CI_Controller {
	/**
	 * Constructor
	 */
	function Admininfo()
	{
		parent::__Construct();
		$this->load->model('Info_model', '', TRUE);
		$this->load->library('table');
	}
	
	var $title = 'Administrasi Info';
	
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
		$data['h2_title'] = 'Administrasi Info';
		$data['main_view'] = 'info/datainfo_view';
		$data['left_view'] = 'menuinfo.php';
		$data['user'] = $this->session->userdata('username');
		
		$datainfo = $this->Info_model->get_datainfoall();
		$datainfohasil = $datainfo->result();
		$num_rows = $datainfo->num_rows();
		$datainfobaris = $datainfo->row();
		
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
				$this->table->set_heading('ID INFO','TANGGAL AWAL INFO','TANGGAL AWAL INFO','INFO','AKSI');
								
	//			foreach ($anggota as $row)
	//			{
					$this->table->add_row($datainfobaris->idinfo, $datainfobaris->tglawalinfo, $datainfobaris->tglakhirinfo,$datainfobaris->info, anchor('admininfo/ubah/'.$datainfobaris->idinfo,'Ubah',array('class' => 'update')). ' | '. anchor('admininfo/hapus/'.$datainfobaris->idinfo,'Hapus',array('class' => 'hapus','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")));
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
				$this->table->set_heading('ID INFO','TANGGAL AWAL INFO','TANGGAL AWAL INFO','INFO','AKSI');
								
				foreach ($datainfohasil as $row)
				{
					$this->table->add_row($row->idinfo, $row->tglawalinfo, $row->tglakhirinfo , $row->info , anchor('admininfo/ubah/'.$row->idinfo,'Ubah',array('class' => 'update')). ' | '. anchor('admininfo/hapus/'.$row->idinfo,'Hapus',array('class' => 'hapus', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")));
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
	
	function hapus($idinfo)
	{
		$this->Info_model->delete($idinfo);
		$this->session->set_flashdata('message', 'Satu data info berhasil dihapus');
		
		redirect('admininfo');
	}
	
	function ubah($idinfo)
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Ubah Info';
		$data['main_view'] = 'info/editinfo_view';
		$data['left_view'] = 'menuinfo.php';
		$data['form_action'] = site_url('admininfo/ubahinfo');		
		//$data['default']['readusrnama'] = "TRUE";
		$data['user'] = $this->session->userdata('username');
		
		//$data['option_grppengguna'] = $this->User_model->getGrpPengguna();
		
		$datainfo = $this->Info_model->get_datainfo_byidinfo($idinfo);
		$datainfobaris = $datainfo->row();
		
		//echo $datauserbaris->namaGroup;
		$data['default']['idinfo'] = $datainfobaris->idinfo;
		$data['default']['tglawalinfo'] = $datainfobaris->tglawalinfo;
		$data['default']['tglakhirinfo'] = $datainfobaris->tglakhirinfo;
		$data['default']['info'] = $datainfobaris->info;
		
		$this->load->view('templateadmin', $data);		
	}
	
	function ubahinfo()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Administrasi Info';
		$data['main_view'] = 'info/datainfo_view';
		$data['left_view'] = 'menuinfo.php';
		//$data['form_action'] = 'adminuser/ubahuser';
		$data['user'] = $this->session->userdata('username');
		
		$idinfo=$this->input->post('idinfo');
		$tglawalinfo=$this->input->post('tglawalinfo');
		$tglakhirinfo=$this->input->post('tglakhirinfo');
		$info=$this->input->post('info');
		
		$this->Info_model->update($idinfo,$tglawalinfo,$tglakhirinfo,$info);		
		
		$this->session->set_flashdata('message', 'Satu data Info berhasil diubah');
	
		redirect('admininfo');
	}
}

?>