<?php
/**
 * Home_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Mutasi_model extends CI_Model {
	/**
	 * Constructor
	 */
	function Mutasi_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 'tbl_bahankimia';
		
	/**
	 * Proses SPT
	 */
	 
	 function getStsKirim(){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_pengiriman');
		$this->db->order_by('statuskirim','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            //$result[0]= '-Pilih Pengiriman-';
            $result[$row->idstatuskirim]= $row->statuskirim;
        }
        
        return $result;
	}
	
	function getJenisSPT($paramjenisdok){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_jenisdokumen');
		$this->db->where_in('idjenisdokumen',$paramjenisdok);
		$this->db->order_by('jenisdokumen','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[$row->idjenisdokumen]= $row->jenisdokumen;
        }
        
        return $result;
	}
	
	function getJenisPajak($paramjenisdok){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_jenispajak');
		$this->db->where('idjenisdokumen',$paramjenisdok);
		$this->db->order_by('jenispajak','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
              $result[$row->idjenispajak]= $row->jenispajak;
        }
        
        return $result;
	}
	
	function getPembetulan(){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_statuspembetulan');
		$this->db->order_by('statuspembetulan','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
              $result[$row->idstatuspembetulan]= $row->statuspembetulan;
        }
        
        return $result;
	}
	
	function getNKL(){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_nkl');
		$this->db->order_by('nkl','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
             $result[$row->idnkl]= $row->nkl;
        }
        
        return $result;
	}
	
	function getRestKompen(){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_restkompen');
		$this->db->order_by('restkompen','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[$row->idrestkompen]= $row->restkompen;
        }
        
        return $result;
	}
	 
	function getJenisESPT(){
		$result = array();
		$sql = "SELECT
				*
				FROM
				tbl_jenisdokumen
				WHERE
				idjenisdokumen in ('2','3','4')
				";
				
		$array_keys_values = $this->db->query($sql);
        foreach ($array_keys_values->result() as $row)
        {
       		$result[0]= '-Pilih Jenis Dokumen-';        	
            $result[$row->idjenisdokumen]= $row->jenisdokumen;
        }
        
        return $result;
	} 
	
	function get_mnpwpdata($mnpwp)
	{
		$sql = "SELECT
				*
				FROM
				tbl_npwp
				WHERE
				MNPWP = '$mnpwp'";
			
		return $this->db->query($sql);
	}
	
	function get_counterbps()
	{
		$sql = "select max(tbl_dokumen.counterbps) + 1 as countbps from tbl_dokumen where right(tbl_dokumen.bps,4) = YEAR(NOW()) =1";
		return $this->db->query($sql);		
	} 
	
	function add($dokumen)
	{
		$this->db->insert($this->table, $dokumen);
	}
	
	function get_dokumendata($kriteria)
	{
 		$sql = "SELECT D.bps,D.mnpwp,N.NPWP,N.NAMA,N.ALAMAT,N.KEL,N.KEC,N.KT,D.idjenisdokumen,D.tglterima, D.tglsurat,D.perihal,D.noketetapan,K.statuskirim,JD.jenisdokumen,JP.jenispajak,RK.restkompen,D.idstatuspembetulan FROM tbl_dokumen D LEFT JOIN tbl_npwp N ON D.mnpwp = N.MNPWP JOIN tbl_pengiriman K ON D.idstatuskirim = K.idstatuskirim JOIN tbl_jenisdokumen JD ON D.idjenisdokumen = JD.idjenisdokumen LEFT JOIN tbl_jenispajak JP ON D.idjenispajak = JP.idjenispajak LEFT JOIN tbl_restkompen RK ON D.idrestkompen = RK.idrestkompen $kriteria";
 
 		return $this->db->query($sql);
 	}
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */