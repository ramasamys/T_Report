-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2013 at 11:30 AM
-- Server version: 5.5.32
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asterisk`
--

-- --------------------------------------------------------

--
-- Table structure for table `cel`
--

CREATE TABLE IF NOT EXISTS `cel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eventtype` varchar(30) NOT NULL,
  `eventtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userdeftype` varchar(255) NOT NULL,
  `cid_name` varchar(80) NOT NULL,
  `cid_num` varchar(80) NOT NULL,
  `cid_ani` varchar(80) NOT NULL,
  `cid_rdnis` varchar(80) NOT NULL,
  `cid_dnid` varchar(80) NOT NULL,
  `exten` varchar(80) NOT NULL,
  `context` varchar(80) NOT NULL,
  `channame` varchar(80) NOT NULL,
  `appname` varchar(80) NOT NULL,
  `appdata` varchar(80) NOT NULL,
  `amaflags` int(11) NOT NULL,
  `accountcode` varchar(20) NOT NULL,
  `peeraccount` varchar(20) NOT NULL,
  `uniqueid` varchar(150) NOT NULL,
  `linkedid` varchar(150) NOT NULL,
  `userfield` varchar(255) NOT NULL,
  `peer` varchar(80) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `cel`
--
DROP TRIGGER IF EXISTS `insert_cel`;
DELIMITER //
CREATE TRIGGER `insert_cel` AFTER INSERT ON `cel`
 FOR EACH ROW BEGIN 
if (new.eventtype='APP_START' and new.appdata like '%DAHDI%') then
INSERT INTO manual(uniqueid,time,event,dest) VALUES (NEW.linkedid,NEW.eventtime,NEW.eventtype,NEW.exten); 
elseif new.eventtype='BRIDGE_START' then
update manual set agent=NEW.cid_ani,
event='CONNECT',
time=NEW.eventtime 
where uniqueid=NEW.linkedid;
elseif new.eventtype='HANGUP' then
delete from manual where uniqueid=NEW.linkedid;
END IF;
END
//
DELIMITER ;

--
-- Dumping data for table `cel`
--

