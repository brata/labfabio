/*
MySQL Data Transfer
Source Host: localhost
Source Database: koperasi
Target Host: localhost
Target Database: koperasi
Date: 10/07/2012 11:33:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for s_group_user
-- ----------------------------
DROP TABLE IF EXISTS `s_group_user`;
CREATE TABLE `s_group_user` (
  `groupNama` varchar(30) NOT NULL,
  `groupKeterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`groupNama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `s_group_user` VALUES ('DBAdmin', 'DBAdmin');
INSERT INTO `s_group_user` VALUES ('SysAdmin', 'SysAdmin');
INSERT INTO `s_group_user` VALUES ('User', 'Group User');
