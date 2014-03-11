<?php
/**
 * NPWP_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class NPWP_model extends CI_Model {
	/**
	 * Constructor
	 */
	function NPWP_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 'tbl_npwp';
	
	/**
	 * Proses manajemen data surat
	 */
	 
	function add($datanpwp)
	{
		$this->db->insert($this->table, $datanpwp);
	}
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */