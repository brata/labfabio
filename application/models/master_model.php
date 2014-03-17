<?php
/**
 * Surat_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Master_model extends CI_Model {
	/**
	 * Constructor
	 */
	function master_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel 
	var $table = 'tbl_pengambil';
	var $table1 = 'tbl_bahankimia';
		
	/**
	 * Proses Master Data
	 */
	 
	function get_all_mahasiswa($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_pengambil');
		$this->db->where('idjenispengambil','2');
		$this->db->limit($limit, $offset);
		$this->db->order_by('idpengambil', 'asc');
		return $this->db->get()->result();
	}
	 
	function count_all_mahasiswa()
	{
		return $this->db->count_all('vw_tbl_mahasiswa');
	} 
	
	function get_mahasiswa_by_idnama($kriteria)
	{
		$kriterianama = '%' . $kriteria . '%';
		$sql = "select * from vw_tbl_mahasiswa WHERE idpengambil = '$kriteria' OR nama LIKE '$kriterianama'" ;
		
		return $this->db->query($sql);
	}
	
	function get_all_dosen($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_pengambil');
		$this->db->where('idjenispengambil','1');
		$this->db->limit($limit, $offset);
		$this->db->order_by('idpengambil', 'asc');
		return $this->db->get()->result();
	}
	 
	function count_all_dosen()
	{
		return $this->db->count_all('vw_tbl_dosen');
	} 
	 
	function get_dosen_by_idnama($kriteria)
	{
		$kriterianama = '%' . $kriteria . '%';
		$sql = "select * from vw_tbl_dosen WHERE idpengambil = '$kriteria' OR nama LIKE '$kriterianama'" ;
		
		return $this->db->query($sql);
	}
	
	function get_jk()
	{
		$this->db->order_by('idjeniskelamin');
		return $this->db->get('tbl_jk');
	}
	 
	function get_agama()
	{
		$this->db->order_by('idagama');
		return $this->db->get('tbl_agama');
	}
	
	function get_jurusan()
	{
		$this->db->order_by('idjurusan');
		return $this->db->get('vw_tbl_jurusan');
	}
	
	function addpengambil($pengambil)
	{
		$this->db->insert($this->table, $pengambil);
	}
	
	function get_all_bahankimia($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_bahankimia');
		$this->db->limit($limit, $offset);
		$this->db->order_by('idbahankimia', 'asc');
		return $this->db->get()->result();
	}
	 
	function count_all_bahankimia()
	{
		return $this->db->count_all('tbl_bahankimia');
	} 
	
	function get_bahankimia_by_idnama($kriteria)
	{
		$kriterianama = '%' . $kriteria . '%';
		$sql = "select * from tbl_bahankimia WHERE idbahankimia = '$kriteria' OR namabahankimia LIKE '$kriterianama'" ;
		
		return $this->db->query($sql);
	}
	
	function get_jenisbahankimia()
	{
		$this->db->order_by('idjenisbahankimia');
		return $this->db->get('tbl_jenisbahankimia');
	}
	
	function get_satuan()
	{
		$this->db->order_by('idsatuan');
		return $this->db->get('tbl_satuan');
	}
	
	function addbahankimia($bahankimia)
	{
		$this->db->insert($this->table1, $bahankimia);
	}
	
//======================================================================
	

}