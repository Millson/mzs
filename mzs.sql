-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 07 月 30 日 07:43
-- 服务器版本: 5.1.63
-- PHP 版本: 5.3.3-7+squeeze13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mzs`
--
DROP DATABASE `mzs`;
CREATE DATABASE `mzs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mzs`;

-- --------------------------------------------------------

--
-- 表的结构 `mzs_comment`
--

DROP TABLE IF EXISTS `mzs_comment`;
CREATE TABLE IF NOT EXISTS `mzs_comment` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `author` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `mzs_comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `mzs_meta`
--

DROP TABLE IF EXISTS `mzs_meta`;
CREATE TABLE IF NOT EXISTS `mzs_meta` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` enum('category','tag') NOT NULL,
  `count` int(10) NOT NULL DEFAULT '0',
  `order` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `mzs_meta`
--

INSERT INTO `mzs_meta` (`mid`, `slug`, `name`, `type`, `count`, `order`) VALUES
(1, '默认分类', '默认分类', 'category', 1, 0),
(2, 'Linux', 'Linux', 'tag', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mzs_post`
--

DROP TABLE IF EXISTS `mzs_post`;
CREATE TABLE IF NOT EXISTS `mzs_post` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `slug` varchar(80) NOT NULL COMMENT '缩略名',
  `title` varchar(20) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `created` int(10) NOT NULL COMMENT '创建时间',
  `modified` int(10) NOT NULL COMMENT '更改时间',
  `type` varchar(16) NOT NULL,
  `views` int(10) NOT NULL,
  `comments` int(10) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `mzs_post`
--

INSERT INTO `mzs_post` (`pid`, `slug`, `title`, `content`, `created`, `modified`, `type`, `views`, `comments`) VALUES
(1, 'qidong', '启东！启东！', '新浪微薄全面封禁启东关键字', 1343572718, 1343572718, 'post', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mzs_relation`
--

DROP TABLE IF EXISTS `mzs_relation`;
CREATE TABLE IF NOT EXISTS `mzs_relation` (
  `pid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  PRIMARY KEY (`pid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mzs_relation`
--

INSERT INTO `mzs_relation` (`pid`, `mid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `mzs_sessions`
--

DROP TABLE IF EXISTS `mzs_sessions`;
CREATE TABLE IF NOT EXISTS `mzs_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mzs_sessions`
--

INSERT INTO `mzs_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('155955926bb5c6b647254afb977f0bc8', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686; rv:14.0) Gecko/20100101 Firefox/14.0.1', 1343573263, '');
