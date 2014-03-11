<?php
/**
 * Administrasi_model Class
 *
 * @author	Trias Bratakusuma <bratatkr@gmail.com>
 */
class Laporan_model extends CI_Model {
	/**
	 * Constructor
	 */
	function laporan_model()
	{
		parent::__Construct();
	}
	
	// Inisialisasi nama tabel absen
	var $table = 's_user';
	
	/**
	 * Proses rekap data absensi dengan kriteria semester dan kelas tertentu
	 */
	function get_transaksi($nosl)
	{
		$sql = "SELECT
				tagihan.TagihanKDWilayah,
				tagihan.TagihanKDGolongan,
				tagihan.TagihanNamaPelanggan,
				tagihan.TagihanAlamatPelanggan,
				tagihan.TagihanBulanTagihan,
				tagihan.TagihanNoSambungan,
				tagihan.TagihanIDTagihan,
				tagihan.TagihanTahunTagihan,
				tagihan.TagihanDiameter,
				tagihan.TagihanAngkaMAwal,
				tagihan.TagihanAngkaMAkhir,
				tagihan.TagihanJumPakai,
				tagihan.TagihanJumBayar,
				tagihan.TagihanBiayaPipa,
				tagihan.TagihanBiayaMeteran,
				tagihan.TagihanPemeliharaan,
				tagihan.TagihanBiayaAdministrasi,
				tagihan.TagihanTagihanBulan,
				tagihan.TagihanTagihanTotal
				FROM
				tagihan
				WHERE
				tagihan.TagihanNoSambungan = '$nosl'
				AND
				tagihan.TagihanStatus = '0'
				order by tagihan.TagihanBulanTagihan asc";
			
		return $this->db->query($sql);
	}
	
	function get_transaksilunas($nosl)
	{
		$sql = "SELECT
				tagihan.TagihanTanggalBayar
				FROM
				tagihan
				WHERE
				tagihan.TagihanNoSambungan = '$nosl'
				AND
				tagihan.TagihanStatus = 'lunas'
				order by tagihan.TagihanBulanTagihan asc";
			
		return $this->db->query($sql);
	}
	
	function get_dokumenall($tanggal)
	{
		$sql = "SELECT D.bps, D.mnpwp, D.tglterima, D.masabulanpajak, D.masatahunpajak, D.nominalnkl, NKL.nkl, N.NAMA, J.jenispajak, JD.jenisdokumen FROM tbl_dokumen AS D 
Inner Join tbl_npwp AS N ON D.mnpwp = N.MNPWP 
Inner Join tbl_jenispajak AS J ON D.idjenispajak = J.idjenispajak
Inner Join tbl_jenisdokumen AS JD ON D.idjenisdokumen = JD.idjenisdokumen
Inner Join tbl_nkl AS NKL ON D.idnkl = NKL.idnkl
WHERE D.tglterima = '" .  $tanggal . "'";
			
		return $this->db->query($sql);
	}
	
	function get_rekapregharian($tglterima,$blnterima,$thnterima)
	{
		$sql = "SELECT
JD.jenisdokumen,
JP.jenispajak,
SUM(IF(NKL.nkl='NIHIL',1,0)) as JMLNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) as JMLKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as JMLLB,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0)) as NOMINALNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) as NOMINALKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as NOMINALLB,
SUM(IF(NKL.nkl='NIHIL',1,0)) + SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as TOTALJML,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0))  +  SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as JMLNOMINAL,
D.idnkl,
D.nominalnkl,
NKL.nkl,
D.idjenisdokumen,
JP.idjenispajak,
D.idjenispajak
FROM
tbl_dokumen D
Left Join tbl_jenisdokumen JD ON D.idjenisdokumen = JD.idjenisdokumen
Left Join tbl_jenispajak  JP ON JP.idjenispajak = D.idjenispajak AND JP.idjenisdokumen = JD.idjenisdokumen
Inner Join tbl_nkl  NKL ON D.idnkl = NKL.idnkl
Where D.tglterima = '". $thnterima ."-". $blnterima ."-". $tglterima ." 00:00:00'
group by JP.jenispajak,JD.jenisdokumen";
			
		return $this->db->query($sql);
	}
	
	function get_rekapregbulanan($blnterima,$thnterima)
	{
		$sql = "SELECT
JD.jenisdokumen,
JP.jenispajak,
SUM(IF(NKL.nkl='NIHIL',1,0)) as JMLNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) as JMLKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as JMLLB,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0)) as NOMINALNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) as NOMINALKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as NOMINALLB,
SUM(IF(NKL.nkl='NIHIL',1,0)) + SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as TOTALJML,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0))  +  SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as JMLNOMINAL,
D.idnkl,
D.nominalnkl,
NKL.nkl,
D.idjenisdokumen,
JP.idjenispajak,
D.idjenispajak
FROM
tbl_dokumen D
Left Join tbl_jenisdokumen JD ON D.idjenisdokumen = JD.idjenisdokumen
Left Join tbl_jenispajak  JP ON JP.idjenispajak = D.idjenispajak AND JP.idjenisdokumen = JD.idjenisdokumen
Inner Join tbl_nkl  NKL ON D.idnkl = NKL.idnkl
Where month(D.tglterima)='" . $blnterima ."'
and
year(D.tglterima)='" . $thnterima ."'
group by JP.jenispajak,JD.jenisdokumen";
			
		return $this->db->query($sql);
	}
	
	function get_rekapregtahunan($thnterima)
	{
		$sql = "SELECT
JD.jenisdokumen,
JP.jenispajak,
SUM(IF(NKL.nkl='NIHIL',1,0)) as JMLNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) as JMLKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as JMLLB,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0)) as NOMINALNIHIL ,
SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) as NOMINALKB,
SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as NOMINALLB,
SUM(IF(NKL.nkl='NIHIL',1,0)) + SUM(IF(NKL.nkl='KURANG BAYAR',1,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',1,0)) as TOTALJML,
SUM(IF(NKL.nkl='NIHIL',D.nominalnkl,0))  +  SUM(IF(NKL.nkl='KURANG BAYAR',D.nominalnkl,0)) + SUM(IF(NKL.nkl='LEBIH BAYAR',D.nominalnkl,0)) as JMLNOMINAL,
D.idnkl,
D.nominalnkl,
NKL.nkl,
D.idjenisdokumen,
JP.idjenispajak,
D.idjenispajak
FROM
tbl_dokumen D
Left Join tbl_jenisdokumen JD ON D.idjenisdokumen = JD.idjenisdokumen
Left Join tbl_jenispajak  JP ON JP.idjenispajak = D.idjenispajak AND JP.idjenisdokumen = JD.idjenisdokumen
Inner Join tbl_nkl  NKL ON D.idnkl = NKL.idnkl
Where year(D.tglterima)='" . $thnterima . "'
group by JP.jenispajak,JD.jenisdokumen";
			
		return $this->db->query($sql);
	}
}
// END Absen_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/absen_model.php */