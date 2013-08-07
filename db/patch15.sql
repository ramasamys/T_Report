-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2013 at 11:31 AM
-- Server version: 5.5.32
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asterisk1`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue_member_table`
--

CREATE TABLE IF NOT EXISTS `queue_member_table` (
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  `membername` varchar(40) NOT NULL DEFAULT '',
  `queue_name` varchar(128) NOT NULL DEFAULT '',
  `interface` varchar(128) DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  `paused` int(11) DEFAULT NULL,
  `timee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uniqueid`),
  UNIQUE KEY `membername` (`membername`),
  UNIQUE KEY `queue_interface` (`queue_name`,`interface`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9654 ;

--
-- Triggers `queue_member_table`
--
DROP TRIGGER IF EXISTS `after_insert_qm`;
DELIMITER //
CREATE TRIGGER `after_insert_qm` AFTER INSERT ON `queue_member_table`
 FOR EACH ROW BEGIN 
INSERT INTO agent_status( agentid, agentStatus, queue ) 
VALUES (NEW.membername,'READY', NEW.queue_name);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `updatepause`;
DELIMITER //
CREATE TRIGGER `updatepause` BEFORE UPDATE ON `queue_member_table`
 FOR EACH ROW BEGIN
IF NEW.paused = '1' THEN
insert into qpause(id,queue,membername,start)values(new.uniqueid,new.queue_name,new.membername,now());
ELSEIF NEW.paused = '0' THEN
UPDATE qpause qp SET
end = now()
where id=OLD.uniqueid;
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bi_UPDATEEvents`;
DELIMITER //
CREATE TRIGGER `bi_UPDATEEvents` AFTER UPDATE ON `queue_member_table`
 FOR EACH ROW BEGIN
IF NEW.paused = '0' THEN
UPDATE `agent_status` SET
agentStatus = "READY"
where agentId = OLD.membername AND queue=OLD.queue_name;
ELSEIF NEW.paused = '1' THEN
UPDATE `agent_status` SET
agentStatus = "PAUSED"
where agentId = OLD.membername AND queue=OLD.queue_name;
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bi_DELETEEvents`;
DELIMITER //
CREATE TRIGGER `bi_DELETEEvents` AFTER DELETE ON `queue_member_table`
 FOR EACH ROW BEGIN  
        DELETE FROM agent_status WHERE agentId = OLD.membername;  
    END
//
DELIMITER ;

--
-- Dumping data for table `queue_member_table`
--

