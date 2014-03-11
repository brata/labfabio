/*
MySQL Data Transfer
Source Host: localhost
Source Database: koperasi
Target Host: localhost
Target Database: koperasi
Date: 10/07/2012 11:32:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for s_user
-- ----------------------------
DROP TABLE IF EXISTS `s_user`;
CREATE TABLE `s_user` (
  `usrNama` varchar(20) NOT NULL DEFAULT '',
  `usrPassword` varchar(15) DEFAULT NULL,
  `namaGroup` varchar(30) DEFAULT NULL,
  `usrProfil` varchar(50) DEFAULT NULL,
  `usrPertanyaan` varchar(100) DEFAULT NULL,
  `usrJawaban` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`usrNama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `s_user` VALUES ('Admin', '123', 'SysAdmin', 'Administrator', 'angka', 'urutawal3');
INSERT INTO `s_user` VALUES ('parmoedi', '651', 'DBAdmin', 'Petugas Laboratorium', 'Pemain brasil ?', 'oliviera');
