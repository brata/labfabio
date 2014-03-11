<?php
/**
 * Info_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Info_model extends CI_Model {
	/**
	 * Constructor
	 */
	function Info_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 'tbl_info';
	
	/**
	 * Proses rekap data absensi dengan kriteria semester dan kelas tertentu
	 */
	function get_datainfoall()
	{
		$sql = "SELECT * FROM tbl_info";
			
		return $this->db->query($sql);
	}
	
	function get_flashinfo()
	{
		$sql = "SELECT * FROM 
				tbl_info
				WHERE
				tglawalinfo <= now()
				AND
				tglakhirinfo >= now()
				order by idinfo DESC LIMIT 1";
			
		return $this->db->query($sql);
	}
	
	function upd_lunas($nosl)
	{
		$sql = "UPDATE tagihan
					SET tagihanstatus = 'lunas',
					TagihanTanggalBayar = now()
					WHERE 
					TagihanNoSambungan = '$nosl'";
			
		return $this->db->query($sql);
	}
	
	function insert($info)
	{
		$this->db->insert($this->table, $info);
	}
	
	function delete($idinfo)
	{
		$this->db->delete($this->table, array('idinfo' => $idinfo));
	}
	
	function get_datainfo_byidinfo($idinfo)
	{
		$sql = "SELECT * FROM tbl_info WHERE idinfo = '$idinfo'";
			
		return $this->db->query($sql);
	}
	
	function update($idinfo,$tglawalinfo,$tglakhirinfo,$info)
	{
		$sql = "UPDATE tbl_info
					SET tglawalinfo = '$tglawalinfo',
						tglakhirinfo = '$tglakhirinfo',
						info ='$info'
					WHERE 
					idinfo = '$idinfo'";
			
		return $this->db->query($sql);
	}
	
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */