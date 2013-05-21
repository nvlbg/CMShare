SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `articles` (
  `article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(3) unsigned NOT NULL,
  `date_added` int(10) unsigned NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `title` varchar(56) CHARACTER SET utf8 NOT NULL,
  `seen` int(11) unsigned NOT NULL DEFAULT '0',
  `article` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`article_id`),
  FULLTEXT KEY `article` (`article`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
  `category_id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `comment` varchar(400) CHARACTER SET utf8 NOT NULL,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_written` int(10) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  KEY `author_id` (`author_id`),
  KEY `article_id` (`article_id`),
  PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `feedback` (
  `name` varchar(56) NOT NULL,
  `title` varchar(56) NOT NULL,
  `message` varchar(500) NOT NULL,
  `email` varchar(56) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `frriend_requests` (
  `request` int(11) NOT NULL,
  `recieve` int(11) NOT NULL,
  KEY `recieve` (`recieve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `online_users` (
  `user_id` int(11) NOT NULL,
  `last_seen` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pm` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(512) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `title` varchar(56) NOT NULL,
  `date_written` int(11) NOT NULL,
  `read` enum('t','f') NOT NULL DEFAULT 'f',
  `del_reciever` enum('t','f') NOT NULL DEFAULT 'f',
  `del_sender` enum('t','f') NOT NULL DEFAULT 'f',
  PRIMARY KEY (`message_id`),
  KEY `reciever_id` (`reciever_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `stats` (
  `ip` varchar(15) NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `time` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(32) CHARACTER SET utf8 NOT NULL,
  KEY `article_id` (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `tag_map` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `description` varchar(400) CHARACTER SET utf8 NOT NULL,
  `date_registred` int(11) unsigned NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `permissions` enum('n','m','a') CHARACTER SET utf8 NOT NULL DEFAULT 'n',
  `sex` enum('f','m') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;