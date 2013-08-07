-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2013 at 11:26 AM
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
-- Table structure for table `manual`
--

CREATE TABLE IF NOT EXISTS `manual` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(50) NOT NULL,
  `agent` varchar(30) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniqueid` (`uniqueid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1601 ;

--
-- Triggers `manual`
--
DROP TRIGGER IF EXISTS `manual_agent`;
DELIMITER //
CREATE TRIGGER `manual_agent` AFTER INSERT ON `manual`
 FOR EACH ROW BEGIN 
update `agent_status1` set status='DialledOut' where agent=NEW.agent;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `delAgent`;
DELIMITER //
CREATE TRIGGER `delAgent` AFTER DELETE ON `manual`
 FOR EACH ROW BEGIN
update agent_status1 set status='READY' where agent=old.agent;
end
//
DELIMITER ;

--
-- Dumping data for table `manual`
--

