-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2013 at 11:24 AM
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
-- Table structure for table `agent_status`
--

CREATE TABLE IF NOT EXISTS `agent_status` (
  `agentId` varchar(40) NOT NULL,
  `agentName` varchar(40) DEFAULT NULL,
  `agentStatus` varchar(30) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `callid` varchar(32) DEFAULT '0.000000',
  `queue` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`agentId`),
  KEY `agentName` (`agentName`),
  KEY `agentStatus` (`agentStatus`,`timestamp`,`callid`),
  KEY `queue` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_status`
--

INSERT INTO `agent_status` (`agentId`, `agentName`, `agentStatus`, `timestamp`, `callid`, `queue`) VALUES
('SIP/201', NULL, 'READY', '2013-07-24 11:41:36', '0.000000', '500'),
('SIP/555', NULL, 'READY', '2013-08-07 10:55:35', '0.000000', '500'),
('SIP/552', NULL, 'READY', '2013-07-31 17:08:33', '1375270700.30', 'Technical'),
('SIP/551', NULL, 'RINGING', '2013-07-30 16:31:43', '1375182056.1', 'Billing');
