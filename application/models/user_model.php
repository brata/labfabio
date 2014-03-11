<?php
/**
 * User_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class User_model extends CI_Model {
	/**
	 * Constructor
	 */
	function User_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 's_user';
	
	/**
	 * Proses rekap data absensi dengan kriteria semester dan kelas tertentu
	 */
	function get_datauserall()
	{
		$sql = "SELECT * FROM s_user";
			
		return $this->db->query($sql);
	}
	
	function get_datauser_byusernama($usrnama)
	{
		$sql = "SELECT * FROM s_user WHERE usrNama = '$usrnama'";
			
		return $this->db->query($sql);
	}
	
	function delete($usrnama)
	{
		$this->db->delete($this->table, array('usrNama' => $usrnama));
	}
	
	function getGrpPengguna()
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('s_group_user');
		$this->db->order_by('groupNama','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Group-';
            $result[$row->groupNama]= $row->groupKeterangan;
        }
        
        return $result;
	}
	
	function reset($usrnama)
	{
		$sql = "UPDATE s_user
					SET usrPassword = '123456'
					WHERE 
					usrNama = '$usrnama'";
			
		return $this->db->query($sql);
	}
	
	function reset_byuser($usrnama,$passwd)
	{
		$sql = "UPDATE s_user
					SET usrPassword = '$passwd'
					WHERE 
					usrNama = '$usrnama'";
			
		return $this->db->query($sql);
	}
	
	function update($usrnama,$grppengguna,$profil,$tanya,$jawab)
	{
		$sql = "UPDATE s_user
					SET s_user.namaGroup = '$grppengguna',
						s_user.usrProfil = '$profil',
						s_user.usrPertanyaan ='$tanya',
						s_user.usrJawaban = '$jawab'
					WHERE 
					usrNama = '$usrnama'";
			
		return $this->db->query($sql);
	}
	
	function insert($user)
	{
		$this->db->insert($this->table, $user);
	}
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */