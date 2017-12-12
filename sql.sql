SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_event
-- ----------------------------
DROP TABLE IF EXISTS `think_event`;
CREATE TABLE `think_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `envet_descript` varchar(50) DEFAULT NULL COMMENT '时间描述',
  `envet_name` varchar(50) DEFAULT NULL COMMENT '事件名',
  `prestige` int(11) DEFAULT '0' COMMENT '威望',
  `wealth` int(11) DEFAULT '0' COMMENT '财富',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `cycle_days` tinyint(3) DEFAULT '1' COMMENT '周期天数。0是无限长',
  `cycle_count` int(11) DEFAULT '1' COMMENT '每个周期 次数,0是不限',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `delete` tinyint(1) DEFAULT '0' COMMENT '1 是删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_event
-- ----------------------------
INSERT INTO `think_event` VALUES ('1', '测试', 'admin/index', '50', '50', '50', '10', '0', '2017-12-12 00:00:10', '2019-12-12 15:43:27', '0');


SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_event_log
-- ----------------------------
DROP TABLE IF EXISTS `think_event_log`;
CREATE TABLE `think_event_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `event_id` int(11) NOT NULL COMMENT '事件ID',
  `descript` varchar(255) DEFAULT NULL COMMENT '描述',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_wealth` int(11) DEFAULT '0',
  `user_prestige` int(11) DEFAULT '0' COMMENT '威望',
  `user_point` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `think_admin_user`;
CREATE TABLE `think_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_wealth` int(11) DEFAULT '0',
  `user_prestige` int(11) DEFAULT '0' COMMENT '威望',
  `user_point` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_user_log
-- ----------------------------
DROP TABLE IF EXISTS `think_user_log`;
CREATE TABLE `think_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `type` int(4) DEFAULT NULL COMMENT '类型 1 事件',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
