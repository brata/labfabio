/*
MySQL Data Transfer
Source Host: localhost
Source Database: koperasi
Target Host: localhost
Target Database: koperasi
Date: 10/07/2012 11:33:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for s_modul_ref_bck
-- ----------------------------
DROP TABLE IF EXISTS `s_modul_ref_bck`;
CREATE TABLE `s_modul_ref_bck` (
  `nodeID` varchar(10) DEFAULT NULL,
  `nodeText` varchar(50) DEFAULT NULL,
  `nodeLevel` int(11) DEFAULT NULL,
  `childOf` varchar(10) DEFAULT NULL,
  `link` longtext,
  `formname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `s_modul_ref_bck` VALUES ('a1', 'Sisinfokop', '1', 'a', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1000', 'Data Master', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1001', 'Data Anggota', '3', 'a1000', 'SYS_ANGGOTA', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1002', 'Data Kecamatan', '3', 'a1000', 'SYS_KECAMATAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1003', 'Data Desa', '3', 'a1000', 'SYS_KELURAHAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1004', 'Laporan Data Anggota', '3', 'a1000', 'SYS_LAP_ANGGOTA', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1005', 'Laporan Data Anggota Per Desa', '3', 'a1000', 'SYS_LAP_ANGGOTA_DESA', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1100', 'Simpan Pinjam', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1101', 'Setup Data Pinjaman', '3', 'a1100', 'SYS_SETUP_PINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1102', 'Pengajuan Pinjaman', '3', 'a1100', 'SYS_PENGAJUAN_PINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1103', 'Cetak Rekap Ajuan Harian', '3', 'a1100', 'SYS_CETAK_REKAP_AJUAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1104', 'Cetak Daftar  Pinjaman', '3', 'a1100', 'SYS_PENERIMA_PINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1105', 'Pembayaran Pinjaman', '3', 'a1100', 'SYS_PEMBAYARAN_PINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1106', 'Cetak Daftar Penerima Pinjaman', '3', 'a1100', 'SYS_CETAK_PENERIMA', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1107', 'Pencairan Pinjaman', '3', 'a1100', 'SYS_PENCAIRAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1108', 'Tutup Buku Pinjaman', '3', 'a1100', 'SYS_TUTUP_BUKUPINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1109', 'Transaksi Bulanan', '3', 'a1100', 'SYS_TRANSAKSI_BULANAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1110', 'Penyelesaian Pinjaman', '3', 'a1100', 'SYS_SELESAI', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1111', 'Laporan Pinjaman', '3', 'a1100', 'SYS_PINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1112', 'Laporan Simpanan Anggota', '3', 'a1100', 'SYS_LAP_SIMPANAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1113', 'Laporan Sisa Pinjaman', '3', 'a1100', 'SYS_LAP_SISAPINJAMAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1114', 'Laporan Transaksi Harian', '3', 'a1100', 'SYS_TRANSAKSI_HARIAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1115', 'Laporan Transaksi Bulanan', '3', 'a1100', 'SYS_TRANSAKSI_BULANAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1200', 'Akuntansi', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1201', 'Kode Rekening', '3', 'a1200', 'SYS_KODE_REKENING', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1202', 'Jurnal Umum', '3', 'a1200', 'SYS_JURNAL_UMUM', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1203', 'Jurnal Pengeluaran Kas', '3', 'a1200', 'SYS_PENGELUARAN_KAS', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1204', '.', '3', 'a1200', 'SYS_PENERIMAAN_KAS', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1205', 'Posting Buku Besar', '3', 'a1200', 'SYS_POSTING', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1206', 'Laporan Buku Jurnal', '3', 'a1200', 'SYS_BUKU_JURNAL', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1207', '.', '3', 'a1200', 'SYS_NERACA_PERCOBAAN', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1208', 'Hitung SHU', '3', 'a1200', 'SYS_HITUNG_SHU', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1209', 'Neraca', '3', 'a1200', 'SYS_NERACA', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1210', 'Laba Rugi', '3', 'a1200', 'SYS_LABA_RUGI', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1211', 'Tutup Buku', '3', 'a1200', 'SYS_TUTUP_BUKU', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1300', 'Asset', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1301', 'Perolehan Asset', '3', 'a1300', 'SYS_PEROLEHAN_ASSET', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1302', 'Pemeliharaan / Revaluasi', '3', 'a1300', 'SYS_REVALUASI_ASSET', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1303', 'Pemutihan', '3', 'a1300', 'SYS_PEMUTIHAN_ASSET', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1400', 'Mini Market', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a1401', 'Next Version', '3', 'a1400', 'SYS_NEXT_VER', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a9900', 'Tools', '2', 'a1', '0', null);
INSERT INTO `s_modul_ref_bck` VALUES ('a9901', 'Ganti Password', '3', 'a9900', 'SYS_PASSWORD', 'frmChangePassword');
INSERT INTO `s_modul_ref_bck` VALUES ('a9902', 'Registrasi Group', '3', 'a9900', 'SYS_GROUP', 'frmGroup');
INSERT INTO `s_modul_ref_bck` VALUES ('a9903', 'Hak Akses User', '3', 'a9900', 'SYS_AKSES', 'frmUser');
INSERT INTO `s_modul_ref_bck` VALUES ('a9904', 'Hak Akses Group', '3', 'a9900', 'SYS_AKSESGROUP', 'frmHAGroup');
