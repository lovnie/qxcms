/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : qxcms

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-12-03 16:21:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qx_admin
-- ----------------------------
DROP TABLE IF EXISTS `qx_admin`;
CREATE TABLE `qx_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用 1：启用0：禁用',
  `salt` tinyint(3) unsigned NOT NULL COMMENT '随机密钥(10-99之间的随机数)',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `realname` varchar(30) NOT NULL COMMENT '保存名字',
  `hits` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `ip` varchar(15) NOT NULL COMMENT '登陆ip',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `logintime` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of qx_admin
-- ----------------------------
INSERT INTO `qx_admin` VALUES ('1', 'admin', '0de78b65460f41cfa48e642114fa12c3', '1', '33', '', '', '90', '127.0.0.1', '0', '1480752964');

-- ----------------------------
-- Table structure for qx_cate
-- ----------------------------
DROP TABLE IF EXISTS `qx_cate`;
CREATE TABLE `qx_cate` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '栏目名',
  `uname` varchar(15) NOT NULL DEFAULT '' COMMENT '别名 urlname',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `path` varchar(15) NOT NULL DEFAULT '' COMMENT '分类路径',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '分类等级',
  `attrid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '分类所属 0 =news 1=商品',
  `keyword` varchar(30) NOT NULL DEFAULT '' COMMENT '标题关键字',
  `description` varchar(60) NOT NULL COMMENT '栏目简介	',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`uname`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qx_cate
-- ----------------------------
INSERT INTO `qx_cate` VALUES ('11', '新闻资讯', 'xwzx', '0', '0,11', '1', '0', '', '');
INSERT INTO `qx_cate` VALUES ('12', '企业新闻', 'news', '11', '0,11,12', '2', '0', '', '');
INSERT INTO `qx_cate` VALUES ('13', '行业资讯', 'info', '11', '0,11,13', '2', '0', '', '');
INSERT INTO `qx_cate` VALUES ('14', '服装服饰', 'fzfs', '0', '0,14', '1', '1', '', '');
INSERT INTO `qx_cate` VALUES ('15', '女装', 'nvz', '14', '0,14,15', '2', '1', '', '');
INSERT INTO `qx_cate` VALUES ('16', '男装', 'nanz', '14', '0,14,16', '2', '1', '', '');
INSERT INTO `qx_cate` VALUES ('17', '产品问答', 'cpwd', '11', '0,11,17', '2', '0', '', '');
INSERT INTO `qx_cate` VALUES ('23', '测试顶级栏目', 'testd', '0', '0,23', '1', '0', '', '');
INSERT INTO `qx_cate` VALUES ('38', '测试三级分类', 'ce3j', '37', '0,23,37,38', '3', '0', '', '');
INSERT INTO `qx_cate` VALUES ('37', '测试二级栏目', 'ceej', '23', '0,23,37', '2', '0', '', '');

-- ----------------------------
-- Table structure for qx_news
-- ----------------------------
DROP TABLE IF EXISTS `qx_news`;
CREATE TABLE `qx_news` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `cate_id` int(11) NOT NULL,
  `keword` varchar(100) NOT NULL COMMENT '文章关键字',
  `content` text NOT NULL COMMENT '新闻内容',
  `img` varchar(100) DEFAULT '' COMMENT '大图地址',
  `time` int(11) NOT NULL,
  `flag` enum('h','c','f','a','s','p','j','d') NOT NULL COMMENT '文章属性',
  `isback` int(2) NOT NULL DEFAULT '0' COMMENT '是否为回收站',
  `isopen` varchar(2) DEFAULT '0' COMMENT '0代表审核不通过 1代表审核通过',
  PRIMARY KEY (`id`),
  KEY `news_title` (`title`),
  KEY `news_columnid` (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qx_news
-- ----------------------------
