/*
 Navicat Premium Data Transfer

 Source Server         : centos6.5
 Source Server Type    : MySQL
 Source Server Version : 50536
 Source Host           : 192.168.162.134
 Source Database       : PROCESS

 Target Server Type    : MySQL
 Target Server Version : 50536
 File Encoding         : utf-8

 Date: 08/18/2014 15:46:01 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `php_process`
-- ----------------------------
DROP TABLE IF EXISTS `php_process`;
CREATE TABLE `php_process` (
  `pid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
