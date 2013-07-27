-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2013 at 05:14 PM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `logindetail`
--

CREATE TABLE IF NOT EXISTS `logindetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agent` varchar(50) NOT NULL,
  `logout` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL,
  `sessionId` varchar(30) NOT NULL,
  `queue` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`agent`,`logout`,`login`,`sessionId`,`queue`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `logindetail`
--

INSERT INTO `logindetail` (`id`, `agent`, `logout`, `login`, `status`, `sessionId`, `queue`) VALUES
(28, 'agent', '2013-07-27 11:01:17', '2013-07-27 10:59:39', 'loggedout', '1374922779.23', '1,2'),
(29, 'agent', '2013-07-27 11:04:46', '2013-07-27 11:01:37', 'loggedout', '1374922897.95', '2'),
(30, 'agent', '2013-07-27 11:08:18', '2013-07-27 11:04:55', 'loggedout', '1374923095.83', '1'),
(31, 'agent', '2013-07-27 11:11:48', '2013-07-27 11:08:24', 'loggedout', '1374923304.8', '1,2'),
(32, 'agent', '2013-07-27 11:38:50', '2013-07-27 11:11:55', 'loggedout', '1374923514.98', '1,3'),
(33, 'agent', '2013-07-27 11:40:14', '2013-07-27 11:39:00', 'loggedout', '1374925140.77', '4'),
(34, 'agent', '2013-07-27 11:42:17', '2013-07-27 11:40:20', 'loggedout', '1374925220.19', '3,1'),
(35, 'agent', '0000-00-00 00:00:00', '2013-07-27 11:42:23', '', '1374925343.99', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
