<?php
/**
 * Rekap Class
 *
 * @author	Awan Pribadi Basuki <awan_pribadi@yahoo.com>
 */
class MasterDosen extends CI_Controller {
	/**
	 * Constructor
	 */
	function masterdosen()
	{
		parent::__Construct();
		$this->load->model('Master_model', '', TRUE);
		$this->load->model('Info_model', '', TRUE);		
		$this->load->library('pagination');
		$this->load->library('table');
	}

	var $limit = 10;
	var $title = 'Dosen';
	
	/**
	 * Memeriksa user state, jika dalam keadaan login akan menjalankan fungsi main()
	 * jika tidak akan meredirect ke halaman login
	 */
	function index()
	{
		if ($this->session->userdata('login') == TRUE)
		{
			$this->get_all();
		}
		else
		{
			redirect('login');
		}
	}
	
	/**
	 * Menampilkan halaman utama rekap absen
	 */
	function get_all()
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Dosen';
		$data['main_view'] = 'master/masterdosen_view';
		$data['left_view'] = 'menumaster.php';
		$data['form_action'] = site_url('masterdosen/get_dosen_by_idnama');
		
		$data['user'] = $this->session->userdata('username');
		
		// ============= Awal Blok Info ada di setiap controller =============
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();		
		$data['flashinfo'] = $dataflashbaris->info;
		// ============= Akhir Blok Info ada di setiap controller =============	
		
		// Offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// Load data
		$dosen = $this->Master_model->get_all_dosen($this->limit, $offset);
		$num_rows = $this->Master_model->count_all_dosen();

		//echo $num_rows;
		// Jumlah data anggota
		//$query_anggota = $this->Master_model->get_anggota_all();
		//$anggota = $query_anggota->result();
		//$num_rows = $query_anggota->num_rows();
		//$baris = $query_anggota->row();	
		
		if ($num_rows > 0)
		{
			// Generate pagination			
			$config['base_url'] = site_url('masterdosen/get_all');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		
			// set table template for zebra row
				$tmpl = array('table_open'=>'<table border="0" cellpadding="0" cellspacing="0">',
							  'row_alt_start'=>'<tr class="zebra">',
							  'row_alt_end'=>'</tr>'
							  );
				$this->table->set_template($tmpl);
				
				// set table header
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('N I P','NAMA','ALAMAT','NO HP','E-MAIL','AKSI');
								
				foreach ($dosen as $row)
				{
					$this->table->add_row($row->idpengambil, $row->nama, $row->alamat,$row->nohp, $row->email,anchor('masterdosen/update/'.$row->idpengambil,'update',array('class' => 'update')).' '.
										anchor('masterdosen/delete/'.$row->idpengambil,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"))
					);
				}
									
				$data['table'] = $this->table->generate();
				$data['link'] = array('link_add' => anchor('masterdosen/add/','Tambah Data', array('class' => 'add')));
				$this->load->view('template', $data);
			}
		}
		
	/**
	 * Menampilkan halaman utama rekap absen
	 */
	function get_dosen_by_idnama($kriteria = '')
	{
		$data['title'] = $this->title;
		$data['h2_title'] = 'Data Anggota';
		$data['main_view'] = 'master/mastermahasiswa_view';
		$data['left_view'] = 'menumaster.php';
		$data['form_action'] = site_url('mastermahasiswa/get_anggota_by_idnama');
		
		//tangkap kriteria
		$kriteria = $this->input->post('kriteria');
		//echo $kriteria;
		
		// Load data
		$anggota = $this->Master_model->get_anggota_by_idnama($kriteria);
		$anggotahasil = $anggota->result();
		$num_rows = $anggota->num_rows();
		$anggotabaris = $anggota->row();
		//echo $anggotabaris->Nama;
		//echo $num_rows;
		
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
				$this->table->set_heading('NO ANGGOTA','NAMA','ALAMAT','DESA','KECAMATAN','AKSI');
								
	//			foreach ($anggota as $row)
	//			{
					$this->table->add_row($anggotabaris->NoAnggota, $anggotabaris->Nama, $anggotabaris->Alamat, $anggotabaris->NamaDesa, $anggotabaris->NamaKec, anchor('anggota/update/'.$anggotabaris->NoAnggota,'update',array('class' => 'update')).' '. anchor('anggota/delete/'.$anggotabaris->NoAnggota,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")));
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
				$this->table->set_heading('NO ANGGOTA','NAMA','ALAMAT','DESA','KECAMATAN','AKSI');
								
				foreach ($anggotahasil as $row)
				{
					$this->table->add_row($row->NoAnggota, $row->Nama, $row->Alamat, $row->NamaDesa, $row->NamaKec, anchor('anggota/update/'.$row->NoAnggota,'update',array('class' => 'update')).' '. anchor('anggota/delete/'.$row->NoAnggota,'hapus',array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")));
				}
				
				$data['table'] = $this->table->generate();
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ditemukan!');
			redirect('anggota');	
		}
		$this->load->view('template', $data);
	}
		
	function delete($noanggota)
	{
		$this->Master_model->delete($noanggota);
		$this->session->set_flashdata('message', '1 data anggota berhasil dihapus');
		
		redirect('anggota');
	}
	
	function select_desa(){
    	if('IS_AJAX') {
        $data['option_desa'] = $this->Master_model->getDesaList();		
		$this->load->view('master/desadd',$data);
            }
		
	}
	
//	function tampilkan_subkategori()
//	{
//		$kategori = $this->uri->segment(3);
//
//		$data['subkategori']=$this->Master_model->get_desa_by_idkec($kategori);
//		$this->load->view('template', $data);
//	}
	
	function add()
	{		
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Anggota > Tambah Data';
		$data['main_view'] 		= 'master/anggota_form';
		$data['left_view']		= 'menumaster.php';
		$data['form_action']	= site_url('anggota/add_process');
		$data['link'] 			= array('link_back' => anchor('anggota','kembali', array('class' => 'back'))
										);

		// data Kecamatan untuk dropdown menu
		//$data['kategori'] = $this->db->get('kecamatan');		
		$data['option_kecamatan'] = $this->Master_model->getKecamatanList();
		
		$data['option_desa']= $this->Master_model->getDesaList();
					
		// data Jenis Kelamin untuk dropdown menu
		$jk = $this->Master_model->get_jk()->result();
		
		foreach($jk as $row)
		{
			$data['options_jk'][$row->Kodejk] = $row->NamaJK;
		}
		
		// data Status untuk dropdown menu
		$sts = $this->Master_model->get_sts()->result();
		
		foreach($sts as $row)
		{
			$data['options_status'][$row->kodestatus] = $row->deskripsi;
		}
		
		// data Agama untuk dropdown menu
		$agama = $this->Master_model->get_agama()->result();
		
		foreach($agama as $row)
		{
			$data['options_agama'][$row->kodeagama] = $row->deskripsi;
		}
		
		$this->load->view('template', $data);
	}
	
	function add_process()
	{		
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Anggota > Tambah Data';
		$data['main_view'] 		= 'master/anggota_form';
		$data['left_view']		= 'menumaster.php';
		$data['form_action']	= site_url('anggota/add_process');
		$data['link'] 			= array('link_back' => anchor('anggota','kembali', array('class' => 'back'))
										);
										
		// data Kecamatan untuk dropdown menu
		$data['option_kecamatan'] = $this->Master_model->getKecamatanList();
										
		// data Jenis Kelamin untuk dropdown menu
		$jk = $this->Master_model->get_jk()->result();
		
		foreach($jk as $row)
		{
			$data['options_jk'][$row->Kodejk] = $row->NamaJK;
		}
		
		// data Status untuk dropdown menu
		$sts = $this->Master_model->get_sts()->result();
		
		foreach($sts as $row)
		{
			$data['options_status'][$row->kodestatus] = $row->deskripsi;
		}
		
		// data Agama untuk dropdown menu
		$agama = $this->Master_model->get_agama()->result();
		
		foreach($agama as $row)
		{
			$data['options_agama'][$row->kodeagama] = $row->deskripsi;
		}
		
		// Set validation rules
		$this->form_validation->set_rules('noanggota', 'No Anggota', 'required|exact_length[4]|numeric|callback_valid_noanggota');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('id_agama', 'Agama', 'required');
		$this->form_validation->set_rules('tglmasuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('id_status', 'Status', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$anggota = array('noanggota' 		=> $this->input->post('noanggota'),
							'nama'		=> $this->input->post('nama'),
							'alamat'	=> $this->input->post('alamat'),
							'id' 		=> $this->input->post('desa_id'),
							'jeniskelamin'		=> $this->input->post('id_jk'),
							'kdagama'	=> $this->input->post('id_agama'),
							'tglmasuk' 		=> $this->input->post('tglmasuk'),
							'statusanggota'		=> $this->input->post('id_status')
						);
			$this->Master_model->add($anggota);
			
			$this->session->set_flashdata('message', 'Satu data siswa berhasil disimpan!');
			redirect('anggota/get_all');
		}
		else
		{	
			//$data['default']['id_kelas'] = $this->input->post('id_kelas');
			$this->load->view('template', $data);
		}	
		
		$this->load->view('template', $data);
	}

	function update($noanggota)
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Anggota > Update';
		$data['main_view'] 		= 'master/anggota_form';
		$data['left_view']		= 'menumaster.php';
		$data['form_action']	= site_url('anggota/update_process');
		$data['link'] 			= array('link_back' => anchor('anggota','kembali', array('class' => 'back'))
										);
										
		// data Kecamatan untuk dropdown menu
		$data['option_kecamatan'] = $this->Master_model->getKecamatanList();
		
											
		// data Jenis Kelamin untuk dropdown menu
		$jk = $this->Master_model->get_jk()->result();
		
		foreach($jk as $row)
		{
			$data['options_jk'][$row->Kodejk] = $row->NamaJK;
		}
		
		// data Status untuk dropdown menu
		$sts = $this->Master_model->get_sts()->result();
		
		foreach($sts as $row)
		{
			$data['options_status'][$row->kodestatus] = $row->deskripsi;
		}
		
		// data Agama untuk dropdown menu
		$agama = $this->Master_model->get_agama()->result();
		
		foreach($agama as $row)
		{
			$data['options_agama'][$row->kodeagama] = $row->deskripsi;
		}
		
		// cari data dari database
		$anggota = $this->Master_model->get_anggota_by_id($noanggota);
		
		// data Desa untuk dropdown menu
		//$idkec = '01';
		//echo $anggota->id;
		$data['option_desa'] = $this->Master_model->getDesaListEdit($anggota->idkec);

		// buat session untuk menyimpan data primary key (nis)
		$this->session->set_userdata('noanggota', $anggota->noanggota);
		
		//$data['subkategori'] = $this->Master_model->get_desa_by_idkec($anggota->kategori);
		
		// Data untuk mengisi field2 form
		$data['default']['noanggota'] 		= $anggota->noanggota;
		$data['default']['nama'] 		= $anggota->nama;		
		$data['default']['alamat']	= $anggota->alamat;
		$data['default']['idkec'] 		= $anggota->idkec;
		$data['default']['iddesa'] 		= $anggota->iddesa;		
		$data['default']['id_jk']	= $anggota->JenisKelamin;
		$data['default']['id_agama'] 		= $anggota->Agama;
		$data['default']['tglmasuk'] 		= $anggota->TglMasuk;		
		$data['default']['id_status']	= $anggota->Status;
				
		$this->load->view('template', $data);
	}
	
	/**
	 * Proses update data siswa
	 */
	function update_process()
	{
		$data['title'] 			= $this->title;
		$data['h2_title'] 		= 'Anggota > Update';
		$data['main_view'] 		= 'master/anggota_form';
		$data['left_view']		= 'menumaster.php';
		$data['form_action']	= site_url('anggota/update_process');
		$data['link'] 			= array('link_back' => anchor('anggota','kembali', array('class' => 'back'))
										);
		
									
		// data Kecamatan untuk dropdown menu
		$data['option_kecamatan'] = $this->Master_model->getKecamatanList();
		
		$data['option_desa']= $this->Master_model->getDesaList();			
										
		// data Jenis Kelamin untuk dropdown menu
		$jk = $this->Master_model->get_jk()->result();
		
		foreach($jk as $row)
		{
			$data['options_jk'][$row->Kodejk] = $row->NamaJK;
		}
		
		// data Status untuk dropdown menu
		$sts = $this->Master_model->get_sts()->result();
		
		foreach($sts as $row)
		{
			$data['options_status'][$row->kodestatus] = $row->deskripsi;
		}
		
		// data Agama untuk dropdown menu
		$agama = $this->Master_model->get_agama()->result();
		
		foreach($agama as $row)
		{
			$data['options_agama'][$row->kodeagama] = $row->deskripsi;
		}
		
		
		// Set validation rules
		$this->form_validation->set_rules('noanggota', 'No Anggota', 'required|exact_length[4]|numeric|callback_valid_noanggota');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('iddesa', 'Kode Desa', 'required');
		$this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('id_agama', 'Agama', 'required');
		$this->form_validation->set_rules('tglmasuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('id_status', 'Status', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			// save data
			$anggota = array('noanggota' 		=> $this->input->post('noanggota'),
							'nama'		=> $this->input->post('nama'),
							'alamat'	=> $this->input->post('alamat'),
							'iddesa' 		=> $this->input->post('iddesa'),
							'JenisKelamin'		=> $this->input->post('id_jk'),
							'kdagama'	=> $this->input->post('id_agama'),
							'tglmasuk' 		=> $this->input->post('tglmasuk'),
							'StatusAnggota'		=> $this->input->post('id_status')
						);
			
			$this->Master_model->update($this->session->userdata('noanggota'), $anggota);
			
			// set pesan
			$this->session->set_flashdata('message', 'Satu data anggota berhasil diupdate!');
			redirect('anggota');
		}
		else
		{
			$this->load->view('template', $data);
		}
	}
}				
// END Rekap Class

/* End of file rekap.php */
/* Location: ./system/application/controllers/rekap.php */