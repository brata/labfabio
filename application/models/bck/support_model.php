<?php
/**
 * Support_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Support_model extends CI_Model {
	/**
	 * Constructor
	 */
	function support_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 'tbl_npwp';
	
	/**
	 * Proses rekap data absensi dengan kriteria semester dan kelas tertentu
	 */
	function get_datanpwp($kriteria)
	{
		$sql = "SELECT * FROM tbl_npwp $kriteria";
			
		return $this->db->query($sql);
	}
	
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */