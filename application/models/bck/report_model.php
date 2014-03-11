<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */
	function get_dokumendata($kriteria)
	{
 		$sql = "SELECT D.bps,D.mnpwp,N.NPWP,N.NAMA,N.ALAMAT,N.KEL,N.KEC,N.KT,D.idjenisdokumen,D.tglterima, D.tglsurat,D.perihal,D.noketetapan,K.statuskirim,JD.jenisdokumen,JP.jenispajak,RK.restkompen,D.idstatuspembetulan FROM tbl_dokumen D LEFT JOIN tbl_npwp N ON D.mnpwp = N.MNPWP JOIN tbl_pengiriman K ON D.idstatuskirim = K.idstatuskirim JOIN tbl_jenisdokumen JD ON D.idjenisdokumen = JD.idjenisdokumen LEFT JOIN tbl_jenispajak JP ON D.idjenispajak = JP.idjenispajak LEFT JOIN tbl_restkompen RK ON D.idrestkompen = RK.idrestkompen '$kriteria'";
 
 		return $this->db->query($sql);
 	}
?>