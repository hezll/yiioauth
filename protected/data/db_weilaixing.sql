/*
Navicat MySQL Data Transfer

Source Server         : 10.11.5.7
Source Server Version : 50158
Source Host           : 10.11.5.7:3306
Source Database       : db_weilaixing

Target Server Type    : MYSQL
Target Server Version : 50158
File Encoding         : 65001

Date: 2012-04-20 15:30:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mn_answer`
-- ----------------------------
DROP TABLE IF EXISTS `mn_answer`;
CREATE TABLE `mn_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ask_id` int(11) NOT NULL COMMENT '问题ID',
  `uid` int(10) NOT NULL COMMENT '用户ID',
  `username` varchar(45) NOT NULL COMMENT '用户名',
  `ip` char(1) NOT NULL,
  `is_adopt` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被采纳，1是0否',
  `content` varchar(2000) NOT NULL,
  `created` int(10) NOT NULL COMMENT '创建日期',
  `modified` int(10) NOT NULL COMMENT '编辑日期',
  PRIMARY KEY (`id`),
  KEY `fk_mn_answer_mn_ask1` (`ask_id`),
  CONSTRAINT `fk_mn_answer_mn_ask1` FOREIGN KEY (`ask_id`) REFERENCES `mn_ask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='答案';

-- ----------------------------
-- Records of mn_answer
-- ----------------------------
INSERT INTO `mn_answer` VALUES ('1', '1', '2', '占东', '', '1', '打开心门，敞开胸怀。。。', '0', '0');

-- ----------------------------
-- Table structure for `mn_arc_article`
-- ----------------------------
DROP TABLE IF EXISTS `mn_arc_article`;
CREATE TABLE `mn_arc_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mn_arc_article_mn_category1` (`category_id`),
  KEY `fk_mn_arc_article_mn_articles1` (`articles_id`),
  CONSTRAINT `fk_mn_arc_article_mn_articles1` FOREIGN KEY (`articles_id`) REFERENCES `mn_articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mn_arc_article_mn_category1` FOREIGN KEY (`category_id`) REFERENCES `mn_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mn_arc_article
-- ----------------------------
INSERT INTO `mn_arc_article` VALUES ('1', '4', '3', '<p>\r\n	测试阿什顿阿什顿阿什顿阿什顿阿什顿阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('2', '1', '4', '<p>\r\n	测试</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('3', '1', '16', '<p>\r\n	测试深深深</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('7', '1', '29', '<p>\r\n	asdfasdfasdfasdf</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('8', '1', '32', '<p>\r\n	淡淡地</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('9', '1', '34', '<p>\r\n	阿什顿f阿什顿发生的阿什顿是的</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('10', '1', '35', '<p>\r\n	阿什顿阿什顿阿什顿阿什顿阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('11', '1', '35', '<p>\r\n	阿什顿阿什顿阿什顿阿什顿阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('12', '1', '36', '<ol>\r\n	<li>\r\n		<strong><u><span style=\"color:#8b4513;\"><span style=\"font-size: 14px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">水电费阿什顿发生的发生的</span></span></span></u></strong></li>\r\n</ol>\r\n');
INSERT INTO `mn_arc_article` VALUES ('13', '1', '36', '<ol>\r\n	<li>\r\n		<strong><u><span style=\"color:#8b4513;\"><span style=\"font-size: 14px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">水电费阿什顿发生的发生的淡淡的道</span></span></span></u></strong></li>\r\n</ol>\r\n');
INSERT INTO `mn_arc_article` VALUES ('14', '5', '3', '<p>\r\n	测试阿什顿阿什顿阿什顿阿什顿阿什顿阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('15', '3', '32', '<p>\r\n	淡淡地</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('16', '1', '36', '<ol>\r\n	<li>\r\n		<strong><u><span style=\"color:#8b4513;\"><span style=\"font-size: 14px;\"><span style=\"font-family: lucida sans unicode,lucida grande,sans-serif;\">水电费阿什顿发生的发生的</span></span></span></u></strong></li>\r\n</ol>\r\n');
INSERT INTO `mn_arc_article` VALUES ('17', '3', '32', '<p>\r\n	淡淡地</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('18', '5', '7', '<p>\r\n	阿什顿发生的发生的阿什顿阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('19', '7', '24', '<p>\r\n	设定发生的发生的发生的阿什顿</p>\r\n');
INSERT INTO `mn_arc_article` VALUES ('20', '8', '24', '<p>\r\n	设定发生的发生的发生的阿什顿</p>\r\n');

-- ----------------------------
-- Table structure for `mn_arc_images`
-- ----------------------------
DROP TABLE IF EXISTS `mn_arc_images`;
CREATE TABLE `mn_arc_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `images` varchar(2000) NOT NULL COMMENT '图集集合，以|分割',
  `image_path` varchar(45) NOT NULL COMMENT '图片路径',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mn_arc_images_mn_articles1` (`articles_id`),
  KEY `fk_mn_arc_images_mn_category1` (`category_id`),
  CONSTRAINT `fk_mn_arc_images_mn_articles1` FOREIGN KEY (`articles_id`) REFERENCES `mn_articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mn_arc_images_mn_category1` FOREIGN KEY (`category_id`) REFERENCES `mn_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mn_arc_images
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_articles`
-- ----------------------------
DROP TABLE IF EXISTS `mn_articles`;
CREATE TABLE `mn_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL COMMENT '分类ID',
  `category_path` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL COMMENT '文章title',
  `uid` varchar(45) NOT NULL COMMENT '管理员ID',
  `username` varchar(45) NOT NULL COMMENT '管理员',
  `author` varchar(45) NOT NULL COMMENT '作者',
  `thumb` varchar(100) NOT NULL COMMENT '文章缩略图',
  `flag` set('1','2','3') NOT NULL COMMENT '显示标签，1推荐；2幻灯；3跳转',
  `redirecturl` varchar(100) NOT NULL COMMENT '跳转url',
  `visit_count` int(10) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `description` varchar(200) NOT NULL COMMENT '文章描述',
  `seo_keywords` varchar(200) NOT NULL COMMENT '页面关键词',
  `seo_title` varchar(200) NOT NULL COMMENT '页面title',
  `created` int(10) NOT NULL DEFAULT '0',
  `modified` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_mn_articles_mn_category1` (`category_id`),
  CONSTRAINT `fk_mn_articles_mn_category1` FOREIGN KEY (`category_id`) REFERENCES `mn_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of mn_articles
-- ----------------------------
INSERT INTO `mn_articles` VALUES ('1', '1', '', '测试淡淡地', 'admin', 'admin', 'admin', '', '', '', '0', '阿什顿发生的是的', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('2', '4', '', '继续测试', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('3', '5', '', '继续测试', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '1334735237');
INSERT INTO `mn_articles` VALUES ('4', '1', '', 'asd as阿什顿阿什顿阿什顿', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('5', '1', '', '阿什顿阿什顿阿什顿', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('6', '1', '', '阿斯达发生的', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('7', '5', '', '阿什顿发生的阿什顿', 'admin', 'admin', 'admin', '', '1,3', '', '0', '', '', '', '0', '1334816384');
INSERT INTO `mn_articles` VALUES ('8', '1', '', 'asdfa sdf asdfasdf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('9', '1', '', 'adf asdf asd', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('10', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('11', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('12', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('13', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('14', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('15', '1', '', 'asdfasdfadsf', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('16', '1', '', '水水水水', 'admin', 'admin', 'admin', 'D:\\xampp\\htdocs\\mengniu\\protected/../uploads/images/article/20120417/1334643974-21432.jpg', '', '', '0', '', '', '', '0', '0');
INSERT INTO `mn_articles` VALUES ('21', '1', '', '事务测试？？？', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '1334652984', '0');
INSERT INTO `mn_articles` VALUES ('22', '4', '', '淡淡的道', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '1334653045', '0');
INSERT INTO `mn_articles` VALUES ('23', '1', '', '阿什顿发生的发生的', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '1334653112', '0');
INSERT INTO `mn_articles` VALUES ('24', '8', '', '阿什顿发生的发生的', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '1334653161', '1334816440');
INSERT INTO `mn_articles` VALUES ('29', '1', '', '阿什顿发生的发生的', 'admin', 'admin', 'admin', '', '', '', '0', '', '', '', '1334654372', '1334654372');
INSERT INTO `mn_articles` VALUES ('32', '3', '', '和哈哈哈和哈哈哈ssssssssssss', 'admin', 'admin', 'admin', '', '2,3', '', '0', 'sss', '', '', '1334654573', '1334806370');
INSERT INTO `mn_articles` VALUES ('34', '1', '', '深深深水电费的', 'admin', 'admin', 'admin', '/uploads/images/article/20120418/1334719760-21848.jpg', '', '', '0', '阿什顿阿什顿阿什顿阿什顿', '', '', '1334719760', '0');
INSERT INTO `mn_articles` VALUES ('35', '1', '', '阿什顿发生的阿什顿', 'admin', 'admin', 'admin', '/uploads/images/article/20120418/1334719950-20475.jpg', '2', '', '0', '阿什顿阿什顿撒旦阿什顿', '', '', '1334719950', '1334720987');
INSERT INTO `mn_articles` VALUES ('36', '1', '', '测试跳转', 'admin', 'admin', 'admin', '/uploads/images/article/20120418/1334729482-8137.jpg', '1,2,3', 'http://www.google.com', '0', '所深深地阿什顿发生的水水水水', '', '', '1334729482', '1334736570');

-- ----------------------------
-- Table structure for `mn_ask`
-- ----------------------------
DROP TABLE IF EXISTS `mn_ask`;
CREATE TABLE `mn_ask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asktype_id` int(11) NOT NULL COMMENT '问题类型ID',
  `asktype_subid` int(10) NOT NULL COMMENT '问题类型子ID',
  `title` varchar(100) NOT NULL COMMENT '问题',
  `content` varchar(1000) NOT NULL COMMENT '内容',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `username` varchar(45) NOT NULL COMMENT '用户名',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除，1是0否',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶显示，1是0否',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐，1是0否',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态，1已解决，0未解决',
  `answer_count` smallint(5) NOT NULL DEFAULT '0' COMMENT '回答次数',
  `visit_count` smallint(5) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `lastanswer_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后回答时间',
  `expired_time` int(10) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `solve_time` int(10) NOT NULL DEFAULT '0' COMMENT '解决时间',
  `ip` char(1) NOT NULL,
  `created` int(10) NOT NULL DEFAULT '0' COMMENT '创建日期',
  `modified` int(10) NOT NULL DEFAULT '0' COMMENT '编辑日期',
  PRIMARY KEY (`id`),
  KEY `fk_mn_ask_mn_ask_type` (`asktype_id`),
  CONSTRAINT `fk_mn_ask_mn_ask_type` FOREIGN KEY (`asktype_id`) REFERENCES `mn_ask_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='问题';

-- ----------------------------
-- Records of mn_ask
-- ----------------------------
INSERT INTO `mn_ask` VALUES ('1', '1', '1', '怎么才能心情好？', '顺其自然', '1', '东占', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '0');

-- ----------------------------
-- Table structure for `mn_ask_type`
-- ----------------------------
DROP TABLE IF EXISTS `mn_ask_type`;
CREATE TABLE `mn_ask_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `typename` varchar(45) NOT NULL COMMENT '分类名称',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除，1是0否',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `created` int(10) NOT NULL DEFAULT '0',
  `modified` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='问题分类';

-- ----------------------------
-- Records of mn_ask_type
-- ----------------------------
INSERT INTO `mn_ask_type` VALUES ('1', '0', '计算机', '0', '0', '0', '0');
INSERT INTO `mn_ask_type` VALUES ('21', '0', '阿什顿f阿什顿', '0', '0', '1334828230', '0');
INSERT INTO `mn_ask_type` VALUES ('22', '1', 'PHP', '0', '0', '1334903513', '0');

-- ----------------------------
-- Table structure for `mn_category`
-- ----------------------------
DROP TABLE IF EXISTS `mn_category`;
CREATE TABLE `mn_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topid` int(10) NOT NULL DEFAULT '0' COMMENT '顶级ID',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `typename` varchar(45) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除，1是0否',
  `sort` smallint(5) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL DEFAULT '0',
  `modified` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of mn_category
-- ----------------------------
INSERT INTO `mn_category` VALUES ('1', '0', '0', '新闻中心', '0', '0', '1334556792', '1334890872');
INSERT INTO `mn_category` VALUES ('3', '0', '1', '国内新闻2', '0', '0', '1334557239', '1334904852');
INSERT INTO `mn_category` VALUES ('4', '0', '1', '国际新闻', '0', '2', '1334557263', '1334899325');
INSERT INTO `mn_category` VALUES ('5', '0', '0', '产品中心', '0', '0', '1334563923', '1334890104');
INSERT INTO `mn_category` VALUES ('6', '0', '3', '娱乐新闻', '1', '0', '0', '1334903085');
INSERT INTO `mn_category` VALUES ('7', '0', '5', '手机', '0', '0', '0', '1334829967');
INSERT INTO `mn_category` VALUES ('8', '0', '6', '娱乐', '1', '2', '0', '1334895013');
INSERT INTO `mn_category` VALUES ('9', '0', '4', '美国新闻', '1', '0', '0', '1334901504');
INSERT INTO `mn_category` VALUES ('10', '0', '3', '体育新闻', '0', '0', '0', '1334891681');

-- ----------------------------
-- Table structure for `mn_offline_exchange_record`
-- ----------------------------
DROP TABLE IF EXISTS `mn_offline_exchange_record`;
CREATE TABLE `mn_offline_exchange_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `date` datetime NOT NULL COMMENT '日期',
  `ip` char(15) NOT NULL,
  `exchange_prize` int(5) NOT NULL COMMENT '兑换奖品',
  `exchange_score` int(10) NOT NULL DEFAULT '0' COMMENT '兑换所用积分',
  PRIMARY KEY (`id`),
  KEY `user_id_key` (`uid`),
  CONSTRAINT `mn_offline_exchange_record_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `mn_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户兑奖表';

-- ----------------------------
-- Records of mn_offline_exchange_record
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_offline_redeem_Code`
-- ----------------------------
DROP TABLE IF EXISTS `mn_offline_redeem_Code`;
CREATE TABLE `mn_offline_redeem_Code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(16) NOT NULL,
  `effectivetime` int(10) unsigned NOT NULL,
  `isuse` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否中奖',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='兑换码表';

-- ----------------------------
-- Records of mn_offline_redeem_Code
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_offline_redeem_record`
-- ----------------------------
DROP TABLE IF EXISTS `mn_offline_redeem_record`;
CREATE TABLE `mn_offline_redeem_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `date` datetime NOT NULL COMMENT '日期',
  `ip` char(15) NOT NULL,
  `submitcodes` varchar(200) NOT NULL COMMENT '兑换奖品',
  `score` int(10) NOT NULL DEFAULT '0' COMMENT '兑换所用积分',
  PRIMARY KEY (`id`),
  KEY `user_id_key` (`uid`),
  CONSTRAINT `mn_offline_redeem_record_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `mn_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户提交兑换码记录表';

-- ----------------------------
-- Records of mn_offline_redeem_record
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_offline_score`
-- ----------------------------
DROP TABLE IF EXISTS `mn_offline_score`;
CREATE TABLE `mn_offline_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `score` int(10) NOT NULL COMMENT '用户积分',
  `isgift` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否中奖',
  PRIMARY KEY (`id`),
  KEY `user_id_key` (`uid`),
  CONSTRAINT `mn_offline_score_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `mn_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户积分表';

-- ----------------------------
-- Records of mn_offline_score
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `mn_profiles`;
CREATE TABLE `mn_profiles` (
  `user_id` int(20) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `realname` varchar(255) NOT NULL DEFAULT '',
  `sex` int(10) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mn_profiles
-- ----------------------------
INSERT INTO `mn_profiles` VALUES ('1', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('2', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('3', '1987-05-12', '小新1aaa', '2', '中关村ddd', '18611855351');
INSERT INTO `mn_profiles` VALUES ('4', '2012-04-01', '小新1', '0', '啊', '');
INSERT INTO `mn_profiles` VALUES ('5', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('6', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('7', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('8', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('9', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('10', '2012-04-17', 'asdf', '1', '', '');
INSERT INTO `mn_profiles` VALUES ('11', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('12', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('13', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('14', '0000-00-00', '', '0', '', '');
INSERT INTO `mn_profiles` VALUES ('15', '0000-00-00', '', '0', 'asdfasdfasdfasdf', '13465465653');

-- ----------------------------
-- Table structure for `mn_profiles_fields`
-- ----------------------------
DROP TABLE IF EXISTS `mn_profiles_fields`;
CREATE TABLE `mn_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mn_profiles_fields
-- ----------------------------
INSERT INTO `mn_profiles_fields` VALUES ('3', 'birthday', '孩子生日', 'DATE', '0', '0', '0', '', '', '', '', '0000-00-00', 'UWjuidate', '{\"ui-theme\":\"redmond\"}', '3', '1');
INSERT INTO `mn_profiles_fields` VALUES ('4', 'realname', '姓名', 'VARCHAR', '255', '0', '0', '', '', '', '', '', '', '', '0', '1');
INSERT INTO `mn_profiles_fields` VALUES ('5', 'sex', '孩子性别', 'INTEGER', '10', '0', '3', '', '0==未知;1==男;2==女', '', '', '0', '', '', '0', '1');
INSERT INTO `mn_profiles_fields` VALUES ('7', 'address', '通信地址', 'VARCHAR', '255', '0', '3', '', '', '', '', '', '', '', '0', '1');
INSERT INTO `mn_profiles_fields` VALUES ('9', 'mobile', '手机', 'VARCHAR', '255', '0', '3', '/^(((13[0-9]{1})|159|(18[0-9]{1})|(15[0-9]{1}))+\\d{8})$/', '', '手机格式不正确', '', '', '', '', '0', '1');

-- ----------------------------
-- Table structure for `mn_subject`
-- ----------------------------
DROP TABLE IF EXISTS `mn_subject`;
CREATE TABLE `mn_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL COMMENT '主题名称',
  `is_del` tinyint(1) NOT NULL COMMENT '是否删除，1是0否',
  `user_count` int(10) NOT NULL,
  `start_time` int(10) NOT NULL COMMENT '开始时间',
  `end_time` int(10) NOT NULL COMMENT '结束时间',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题';

-- ----------------------------
-- Records of mn_subject
-- ----------------------------

-- ----------------------------
-- Table structure for `mn_users`
-- ----------------------------
DROP TABLE IF EXISTS `mn_users`;
CREATE TABLE `mn_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `platform` varchar(10) NOT NULL,
  `remote_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mn_users
-- ----------------------------
INSERT INTO `mn_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '1261146094', '1334829954', '1', '1', '127.0.0.1', '', '');
INSERT INTO `mn_users` VALUES ('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '1261146096', '0', '0', '1', '', '', '');
INSERT INTO `mn_users` VALUES ('3', 'hezll', 'd41ce751472c88332d79690d64a00d15', 'hezll@msn.com', 'ce5b8053f0b3c2ff9ee64b185e73d104', '1334565781', '1334730428', '0', '1', '10.1.40.41', '', '');
INSERT INTO `mn_users` VALUES ('4', 'hezll1', 'd41ce751472c88332d79690d64a00d15', 'hezll1@msn.com', 'a030902e88fc38c3db891d4fc94cc4e7', '1334566419', '1334566419', '0', '0', '', '', '');
INSERT INTO `mn_users` VALUES ('5', 'hezll2', 'd41ce751472c88332d79690d64a00d15', 'hezll2@msn.com', '3e94b5fe4df40ca950f3128d3a8f098e', '1334652859', '1334720111', '0', '1', '10.1.40.41', '', '');
INSERT INTO `mn_users` VALUES ('6', 'hezll3', 'f5a4f341ecb2859ee2214945ddb80f29', 'hezll3@msn.com', '9332fbab15a046c38476fff52f0aa594', '1334656750', '1334656750', '0', '1', '', '', '');
INSERT INTO `mn_users` VALUES ('7', 'hezll4', 'f5a4f341ecb2859ee2214945ddb80f29', 'hezll4@msn.com', '88cf58710d5cc141b10bf5dd2ea95ce2', '1334715681', '1334715681', '0', '1', '', '', '');
INSERT INTO `mn_users` VALUES ('8', 'hezll5', 'd41ce751472c88332d79690d64a00d15', 'hezll5@msn.com', '324de7761b21455ecb00d05b5afd9d33', '1334716185', '1334730970', '0', '1', '127.0.0.1', '', '');
INSERT INTO `mn_users` VALUES ('9', 'hezll6', 'af6a26301f1225201afe6f8e71aef35f', 'hezll6@msn.com', 'f424d3a7ecbcfd346ed2669a8bb27ff4', '1334718586', '1334718586', '0', '1', '127.0.0.1', '', '');
INSERT INTO `mn_users` VALUES ('10', '蒙牛未来星_qq', 'd41ce751472c88332d79690d64a00d15', 'hezldl@msn.com', '0d1ebcef52d7a072b290442eeb50e654', '0', '1334827641', '0', '1', '10.1.40.41', 'qq', 'weilaixingapi');
INSERT INTO `mn_users` VALUES ('11', '蒙牛未来星成长俱乐部_sohu', '', '', '', '0', '1334828545', '0', '1', '10.1.40.41', 'sohu', '416686391');
INSERT INTO `mn_users` VALUES ('12', '蒙牛未来星__sina', '', '', '', '0', '1334828511', '0', '1', '10.1.40.41', 'sina', '2705169711');
INSERT INTO `mn_users` VALUES ('13', '小新_qq', '', '', '', '1334827764', '1334888561', '0', '1', '10.1.40.41', 'qq', 'hezll1');
INSERT INTO `mn_users` VALUES ('14', 'hezl', 'd41ce751472c88332d79690d64a00d15', 'hezll3a@msn.com', 'bb39ce63cf67e6f02290badc3a2a9972', '1334828613', '1334828613', '0', '1', '10.1.40.41', '', '');
INSERT INTO `mn_users` VALUES ('15', '东占_qq', '96e79218965eb72c92a549dd5a330112', '1111111@163.com', '241d76ddd97aeff40dcf7b17d85c67f7', '1334829622', '1334829869', '1', '1', '127.0.0.1', 'qq', 'dongzhan-best');
