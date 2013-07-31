-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2013 at 11:53 AM
-- Server version: 5.0.95
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
-- Table structure for table `predictive`
--

CREATE TABLE IF NOT EXISTS `predictive` (
  `sno` bigint(20) NOT NULL auto_increment,
  `dest` varchar(45) NOT NULL,
  `agent` varchar(45) NOT NULL,
  `agentname` varchar(45) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` varchar(45) NOT NULL,
  `uniqueid` varchar(45) NOT NULL,
  `reason` varchar(45) NOT NULL,
  PRIMARY KEY  (`sno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `predictive`
--

