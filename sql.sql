CREATE TABLE `think_book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_title` varchar(50) DEFAULT NULL COMMENT '文章标题',
  `book_text` text,
  `delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


CREATE TABLE `think_note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_name` varchar(50) DEFAULT NULL COMMENT '节点名称',
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT '0 是大类',
  `delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `note_name` (`note_name`,`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

CREATE TABLE `think_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL COMMENT '问题',
  `delete` tinyint(1) DEFAULT '0' COMMENT '1是删除',
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `think_user_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user_anwers` varchar(50) DEFAULT NULL COMMENT '回答',
  `delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
