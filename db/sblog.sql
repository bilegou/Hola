/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : sblog

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-06-10 21:41:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('16', '关于Nginx反向代', 'blabla...', '1', '', '0', '0', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `last_login_ip` varchar(15) DEFAULT NULL,
  `last_login_i_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '管理员', '1', '59352eb810036_thumb.png', '127.0.0.1', '2017526', '2017526', '2017526', '1497071679');
INSERT INTO `user` VALUES ('32', 'editor', '21232f297a57a5a743894a0e4a801fc3', '编辑', '1', '593906264590c_thumb.png', null, null, null, '1496909349', '1496909349');
