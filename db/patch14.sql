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
-- Table structure for table `queue_log`
--

CREATE TABLE IF NOT EXISTS `queue_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` char(26) DEFAULT NULL,
  `callid` varchar(32) NOT NULL DEFAULT '',
  `queuename` varchar(32) NOT NULL DEFAULT '',
  `agent` varchar(32) NOT NULL DEFAULT '',
  `event` varchar(32) NOT NULL DEFAULT '',
  `data1` varchar(100) NOT NULL DEFAULT '',
  `data2` varchar(100) NOT NULL DEFAULT '',
  `data3` varchar(100) NOT NULL DEFAULT '',
  `data4` varchar(100) NOT NULL DEFAULT '',
  `data5` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34342 ;

--
-- Triggers `queue_log`
--
DROP TRIGGER IF EXISTS `bi_queueEvents`;
DELIMITER //
CREATE TRIGGER `bi_queueEvents` BEFORE INSERT ON `queue_log`
 FOR EACH ROW BEGIN
IF NEW.event = 'ENTERQUEUE' THEN
REPLACE INTO `call_status` VALUES
(NEW.callid,
NEW.data2,
'inQue',
NEW.time,
NEW.queuename,
'',
'',
'',
'',
0);
ELSEIF NEW.event in ('RINGING') THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
originalPosition = replace(substring(substring_index(NEW.data2, '|', 3), length(substring_index(NEW.data2, '|', 3 - 1)) + 1), '|', ''),
holdtime = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', ''),
callduration = replace(substring(substring_index(NEW.data2, '|', 2), length(substring_index(NEW.data2, '|', 2 - 1)) + 1), '|', '')
where callid = NEW.callid;
INSERT INTO agent_status (agentId,agentStatus,timestamp,callid,queue) VALUES (NEW.agent,'RINGING',NEW.time,NEW.callid,NEW.queuename) ON DUPLICATE KEY UPDATE agentStatus = "RINGING", timestamp =NEW.time, callid = NEW.callid,queue=NEW.queuename;

ELSEIF NEW.event in ('RINGNOANSWER') THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
originalPosition = replace(substring(substring_index(NEW.data2, '|', 3), length(substring_index(NEW.data2, '|', 3 - 1)) + 1), '|', ''),
holdtime = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', ''),
callduration = replace(substring(substring_index(NEW.data2, '|', 2), length(substring_index(NEW.data2, '|', 2 - 1)) + 1), '|', '')
where callid = NEW.callid;
INSERT INTO agent_status (agentId,agentStatus,timestamp,callid,queue) VALUES (NEW.agent,'READY',NEW.time,NEW.callid,NEW.queuename) ON DUPLICATE KEY UPDATE agentStatus = "READY", timestamp =NEW.time, callid = NEW.callid,queue=NEW.queuename;


ELSEIF NEW.event = 'CONNECT' THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
holdtime = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', '')
where callid = NEW.callid;

INSERT INTO agent_status (agentId,agentStatus,timestamp,callid,queue) VALUES
(NEW.agent,NEW.event,
NEW.time,
NEW.callid,NEW.queuename)
ON DUPLICATE KEY UPDATE
agentStatus = NEW.event,
timestamp =NEW.time,
callid = NEW.callid,queue=NEW.queuename;

ELSEIF NEW.event in ('COMPLETECALLER','COMPLETEAGENT') THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
originalPosition = replace(substring(substring_index(NEW.data2, '|', 3), length(substring_index(NEW.data2, '|', 3 - 1)) + 1), '|', ''),
holdtime = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', ''),
callduration = replace(substring(substring_index(NEW.data2, '|', 2), length(substring_index(NEW.data2, '|', 2 - 1)) + 1), '|', '')
where callid = NEW.callid;
INSERT INTO agent_status (agentId,agentStatus,timestamp,callid,queue) VALUES (NEW.agent,'READY',NEW.time,NEW.callid,NEW.queuename) ON DUPLICATE KEY UPDATE agentStatus = "READY", timestamp =NEW.time, callid = NEW.callid,queue=NEW.queuename;

ELSEIF NEW.event in ('TRANSFER') THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
holdtime = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', ''),
callduration = replace(substring(substring_index(NEW.data2, '|', 3), length(substring_index(NEW.data2, '|', 3 - 1)) + 1), '|', '')
where callid = NEW.callid;
INSERT INTO agent_status (agentId,agentStatus,timestamp,callid,queue) VALUES
(CONCAT('SIP/',SUBSTR(NEW.agent,7,3)),'READY',NEW.time,NULL,NEW.queuename)
ON DUPLICATE KEY UPDATE
agentStatus = "READY",
timestamp = NEW.time,
callid = NULL,queue=NEW.queuename;

ELSEIF NEW.event in ('ABANDON','EXITEMPTY') THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp =NEW.time,
queue = NEW.queuename,
position = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', ''),
originalPosition = replace(substring(substring_index(NEW.data2, '|', 2), length(substring_index(NEW.data2, '|', 2 - 1)) + 1), '|', ''),
holdtime = replace(substring(substring_index(NEW.data2, '|', 3), length(substring_index(NEW.data2, '|', 3 - 1)) + 1), '|', '')
where callid = NEW.callid;
UPDATE agent_status SET agentStatus='READY' WHERE callid = NEW.callid;

ELSEIF NEW.event = 'EXITWITHKEY'THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
position = replace(substring(substring_index(NEW.data2, '|', 2), length(substring_index(NEW.data2, '|', 2 - 1)) + 1), '|', ''),
keyPressed = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', '')
where callid = NEW.callid;

ELSEIF NEW.event = 'EXITWITHTIMEOUT' THEN
UPDATE `call_status` SET
callid = NEW.callid,
status = NEW.event,
timestamp = NEW.time,
queue = NEW.queuename,
position = replace(substring(substring_index(NEW.data2, '|', 1), length(substring_index(NEW.data2, '|', 1 - 1)) + 1), '|', '')
where callid = NEW.callid;
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_queue_log`;
DELIMITER //
CREATE TRIGGER `insert_queue_log` AFTER INSERT ON `queue_log`
 FOR EACH ROW BEGIN 
if new.event='ENTERQUEUE' then
INSERT INTO pop(id,timee,phone) VALUES (NEW.callid,NEW.time,NEW.data2); 
elseif new.event='CONNECT' then
update pop set name=NEW.agent where id =NEW.callid;
END IF;
END
//
DELIMITER ;

--
-- Dumping data for table `queue_log`
--

INSERT INTO `queue_log` (`id`, `time`, `callid`, `queuename`, `agent`, `event`, `data1`, `data2`, `data3`, `data4`, `data5`) VALUES
(34006, '2013-07-23 21:26:35.331192', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34007, '2013-07-23 16:13:29.464232', '1374576197.106', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34008, '2013-07-23 16:17:16.781965', '1374576197.106', 'Billing', 'NONE', 'ABANDON', '1', '1', '227', '', ''),
(34009, '2013-07-23 16:18:47.314160', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34010, '2013-07-23 16:19:19.736630', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34011, '2013-07-23 16:19:19.737867', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34012, '2013-07-23 16:19:40.299963', '1374576570.0', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34013, '2013-07-23 16:19:46.939229', '1374576570.0', 'Billing', 'SIP/551', 'CONNECT', '6', '1374576580.1', '6', '', ''),
(34014, '2013-07-23 16:19:58.620542', '1374576570.0', 'Billing', 'SIP/551', 'COMPLETEAGENT', '6', '12', '1', '', ''),
(34015, '2013-07-23 17:03:19.405897', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34016, '2013-07-23 17:03:19.406348', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'REMOVEMEMBER', '', '', '', '', ''),
(34017, '2013-07-23 17:03:19.406611', '1374579168.5', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '222', '1', '', ''),
(34018, '2013-07-23 17:03:31.644650', '1374579168.5', 'Billing', 'SIP/551', 'CONNECT', '12', '1374579199.6', '11', '', ''),
(34019, '2013-07-23 17:04:41.877686', '1374579258.9', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34020, '2013-07-23 17:06:13.189149', '1374579258.9', 'Billing', 'NONE', 'ABANDON', '1', '1', '92', '', ''),
(34021, '2013-07-23 17:06:24.437985', '1374579168.5', 'Billing', 'SIP/551', 'COMPLETECALLER', '12', '173', '1', '', ''),
(34022, '2013-07-23 17:07:02.380601', 'REALTIME', 'Technical', 'LOCAL/552@default/n,0,552,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34023, '2013-07-23 17:07:02.382230', '1374579400.10', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34024, '2013-07-23 17:07:10.682375', '1374579400.10', 'Technical', 'SIP/552', 'CONNECT', '8', '1374579422.11', '7', '', ''),
(34025, '2013-07-23 17:07:40.097879', '1374579446.14', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '222', '1', '', ''),
(34026, '2013-07-23 17:07:45.210092', '1374579446.14', 'Billing', 'SIP/551', 'CONNECT', '5', '1374579460.15', '4', '', ''),
(34027, '2013-07-23 17:08:18.432178', '1374579400.10', 'Technical', 'SIP/552', 'COMPLETEAGENT', '8', '68', '1', '', ''),
(34028, '2013-07-23 17:08:27.683736', '1374579446.14', 'Billing', 'SIP/551', 'COMPLETECALLER', '5', '42', '1', '', ''),
(34029, '2013-07-23 17:08:40.887450', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34030, '2013-07-23 17:08:51.690782', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34031, '2013-07-23 17:13:04.892109', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34032, '2013-07-23 17:13:04.893432', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34033, '2013-07-23 17:13:04.894188', '1374579772.18', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34034, '2013-07-23 17:13:20.900522', '1374579772.18', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34035, '2013-07-23 17:13:42.239802', '1374579772.18', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34036, '2013-07-23 17:14:03.579870', '1374579772.18', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34037, '2013-07-23 17:14:24.977035', '1374579772.18', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34038, '2013-07-23 17:14:46.329183', '1374579772.18', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34039, '2013-07-23 17:15:07.755387', '1374579772.18', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34040, '2013-07-23 17:15:29.157504', '1374579772.18', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34041, '2013-07-23 17:15:50.532667', '1374579772.18', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34042, '2013-07-23 17:16:11.930840', '1374579772.18', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34043, '2013-07-23 17:16:27.421928', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34044, '2013-07-23 17:16:33.384228', '1374579772.18', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34045, '2013-07-23 17:16:33.395757', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34046, '2013-07-23 17:16:33.396544', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34047, '2013-07-23 17:16:38', '1374579772.18', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34048, '2013-07-23 17:16:51.590977', '1374579772.18', 'Billing', 'NONE', 'ABANDON', '1', '1', '227', '', ''),
(34049, '2013-07-23 17:17:09.883848', 'REALTIME', 'Technical', 'LOCAL/552@default/n,0,552,hint:5', 'ADDMEMBER', '', '', '', '', ''),
(34050, '2013-07-23 17:17:09.884912', '1374580020.52', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34051, '2013-07-23 17:17:09', '1374580020.52', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34052, '2013-07-23 17:17:15.609560', '1374580020.52', 'Technical', 'SIP/552', 'CONNECT', '6', '1374580029.53', '5', '', ''),
(34053, '2013-07-23 17:22:59.600208', '1374580020.52', 'Technical', 'SIP/552', 'COMPLETECALLER', '6', '344', '1', '', ''),
(34054, '2013-07-23 17:23:40.654371', '1374580409.56', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34055, '2013-07-23 17:23:40', '1374580409.56', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34056, '2013-07-23 17:23:56.651538', '1374580409.56', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34057, '2013-07-23 17:24:02', '1374580409.56', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34058, '2013-07-23 17:24:18.105544', '1374580409.56', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34059, '2013-07-23 17:24:23', '1374580409.56', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34060, '2013-07-23 17:24:39.552684', '1374580409.56', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34061, '2013-07-23 17:24:44', '1374580409.56', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34062, '2013-07-23 17:25:00.949860', '1374580409.56', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34063, '2013-07-23 17:25:04.503816', '1374580409.56', 'Billing', 'NONE', 'ABANDON', '1', '1', '84', '', ''),
(34064, '2013-07-23 17:25:39.854929', '1374580522.69', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34065, '2013-07-23 17:25:39', '1374580522.69', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34066, '2013-07-23 17:25:55.910394', '1374580522.69', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34067, '2013-07-23 17:25:58.530913', '1374580522.69', 'Billing', 'NONE', 'ABANDON', '1', '1', '19', '', ''),
(34068, '2013-07-23 17:26:23.518375', '1374580568.73', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34069, '2013-07-23 17:26:23', '1374580568.73', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34070, '2013-07-23 17:26:39.567615', '1374580568.73', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34071, '2013-07-23 17:26:44', '1374580568.73', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34072, '2013-07-23 17:27:00.946792', '1374580568.73', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34073, '2013-07-23 17:27:06', '1374580568.73', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34074, '2013-07-23 17:27:22.305969', '1374580568.73', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34075, '2013-07-23 17:27:27', '1374580568.73', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34076, '2013-07-23 17:27:40.705838', '1374580568.73', 'Billing', 'SIP/333', 'RINGNOANSWER', '13000', '', '', '', ''),
(34077, '2013-07-23 17:27:40', '1374580568.73', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34078, '2013-07-23 17:27:43.711105', '1374580568.73', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34079, '2013-07-23 17:27:49', '1374580568.73', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34080, '2013-07-23 17:28:05.095248', '1374580568.73', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34081, '2013-07-23 17:28:10', '1374580568.73', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34082, '2013-07-23 17:28:15.794073', '1374580568.73', 'Billing', 'SIP/333', 'RINGNOANSWER', '5000', '', '', '', ''),
(34083, '2013-07-23 17:28:15', '1374580568.73', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34084, '2013-07-23 17:28:22.281427', '1374580568.73', 'Billing', 'NONE', 'ABANDON', '1', '1', '119', '', ''),
(34085, '2013-07-23 17:28:44.881214', '1374580716.98', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34086, '2013-07-23 17:28:44', '1374580716.98', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34087, '2013-07-23 17:28:50.048749', '1374580716.98', 'Billing', 'SIP/551', 'RINGNOANSWER', '6000', '', '', '', ''),
(34088, '2013-07-23 17:28:50', '1374580716.98', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34089, '2013-07-23 17:28:57.600735', '1374580716.98', 'Billing', 'SIP/333', 'RINGNOANSWER', '7000', '', '', '', ''),
(34090, '2013-07-23 17:29:02', '1374580716.98', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34091, '2013-07-23 17:29:07.702074', '1374580716.98', 'Billing', 'SIP/551', 'RINGNOANSWER', '5000', '', '', '', ''),
(34092, '2013-07-23 17:29:07', '1374580716.98', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34093, '2013-07-23 17:29:12.611630', '1374580716.98', 'Billing', 'SIP/333', 'CONNECT', '28', '1374580747.108', '8', '', ''),
(34094, '2013-07-23 17:30:00.910666', '1374580716.98', 'Billing', 'SIP/333', 'COMPLETEAGENT', '28', '48', '1', '', ''),
(34095, NULL, '1374580716.98', 'Billing', 'SIP/333', 'ABANDON', '', '', '', '', ''),
(34096, '2013-07-23 17:33:49.678742', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'REMOVEMEMBER', '', '', '', '', ''),
(34097, '2013-07-23 17:33:49.679784', '1374581018.111', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34098, '2013-07-23 17:33:49', '1374581018.111', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34099, '2013-07-23 17:33:56.499800', '1374581018.111', 'Billing', 'SIP/551', 'CONNECT', '7', '1374581029.112', '6', '', ''),
(34100, '2013-07-23 17:34:23.547219', 'REALTIME', 'Technical', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34101, '2013-07-23 17:34:23.548717', '1374581051.115', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34102, '2013-07-23 17:34:23', '1374581051.115', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34103, '2013-07-23 17:34:33.720766', '1374581051.115', 'Technical', 'SIP/552', 'CONNECT', '10', '1374581063.116', '9', '', ''),
(34104, '2013-07-23 17:34:46.356415', '1374581018.111', 'Billing', 'SIP/551', 'COMPLETECALLER', '7', '50', '1', '', ''),
(34105, '2013-07-23 17:34:52.778960', '1374581051.115', 'Technical', 'SIP/552', 'COMPLETEAGENT', '10', '19', '1', '', ''),
(34106, '2013-07-23 17:35:18.728745', '1374581107.119', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34107, '2013-07-23 17:35:18', '1374581107.119', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34108, '2013-07-23 17:35:26.855549', '1374581107.119', 'Billing', 'SIP/551', 'CONNECT', '8', '1374581118.120', '7', '', ''),
(34109, '2013-07-23 17:35:59.811404', '1374581143.123', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '111', '1', '', ''),
(34110, '2013-07-23 17:35:59', '1374581143.123', 'Technical', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34111, '2013-07-23 17:36:02.068679', '1374581143.123', 'Technical', 'SIP/333', 'CONNECT', '3', '1374581159.124', '2', '', ''),
(34112, '2013-07-23 17:36:29.756422', '1374581143.123', 'Technical', 'SIP/333', 'COMPLETEAGENT', '3', '27', '1', '', ''),
(34113, '2013-07-23 17:36:45.932125', '1374581195.127', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34114, '2013-07-23 17:36:45', '1374581195.127', 'Technical', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34115, '2013-07-23 17:37:01.956348', '1374581195.127', 'Technical', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34116, '2013-07-23 17:37:07', '1374581195.127', 'Technical', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34117, '2013-07-23 17:37:23.314521', '1374581195.127', 'Technical', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34118, '2013-07-23 17:37:28', '1374581195.127', 'Technical', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34119, '2013-07-23 17:37:44.191603', '1374581195.127', 'Technical', 'SIP/333', 'CONNECT', '59', '1374581248.134', '14', '', ''),
(34120, '2013-07-23 17:37:45.520785', '1374581107.119', 'Billing', 'SIP/551', 'COMPLETEAGENT', '8', '139', '1', '', ''),
(34121, '2013-07-23 17:38:10.921986', '1374581195.127', 'Technical', 'SIP/333', 'COMPLETEAGENT', '59', '26', '1', '', ''),
(34122, '2013-07-23 17:41:32.313737', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34123, '2013-07-23 17:41:32.314600', '1374581482.137', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34124, '2013-07-23 17:41:32', '1374581482.137', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34125, '2013-07-23 17:41:36.359813', '1374581482.137', 'Billing', 'SIP/551', 'CONNECT', '4', '1374581492.138', '3', '', ''),
(34126, '2013-07-23 17:42:00.206726', '1374581482.137', 'Billing', 'SIP/551', 'COMPLETECALLER', '4', '24', '1', '', ''),
(34127, '2013-07-23 17:43:04.266751', '1374581576.142', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34128, '2013-07-23 17:43:04', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34129, '2013-07-23 17:43:20.299216', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34130, '2013-07-23 17:43:25', '1374581576.142', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34131, '2013-07-23 17:43:41.700367', '1374581576.142', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34132, '2013-07-23 17:43:47', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34133, '2013-07-23 17:44:03.108596', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34134, '2013-07-23 17:44:08', '1374581576.142', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34135, '2013-07-23 17:44:24.550693', '1374581576.142', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34136, '2013-07-23 17:44:29', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34137, '2013-07-23 17:44:45.944895', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34138, '2013-07-23 17:44:51', '1374581576.142', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34139, '2013-07-23 17:45:07.357399', '1374581576.142', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34140, '2013-07-23 17:45:12', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34141, '2013-07-23 17:45:28.744207', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34142, '2013-07-23 17:45:34', '1374581576.142', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34143, '2013-07-23 17:45:50.100558', '1374581576.142', 'Billing', 'SIP/551', 'RINGNOANSWER', '15000', '', '', '', ''),
(34144, '2013-07-23 17:45:50.123453', 'REALTIME', 'Billing', 'LOCAL/551@default/n,0,551,hint:5', 'REMOVEMEMBER', '', '', '', '', ''),
(34145, '2013-07-23 17:45:55', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34146, '2013-07-23 17:46:11.517084', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34147, '2013-07-23 17:46:16', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34148, '2013-07-23 17:46:32.934694', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34149, '2013-07-23 17:46:38', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34150, '2013-07-23 17:46:54.291882', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34151, '2013-07-23 17:46:59', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34152, '2013-07-23 17:47:15.690989', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34153, '2013-07-23 17:47:21', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34154, '2013-07-23 17:47:37.034148', '1374581576.142', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34155, '2013-07-23 17:47:42', '1374581576.142', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34156, '2013-07-23 17:47:42.564210', '1374581576.142', 'Billing', 'NONE', 'ABANDON', '1', '1', '278', '', ''),
(34157, '2013-07-23 18:25:55.927420', 'REALTIME', 'Technical', 'LOCAL/333@default/n,0,333,hint:3', 'REMOVEMEMBER', '', '', '', '', ''),
(34158, '2013-07-23 18:25:55.927803', '1374584142.185', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34159, '2013-07-23 18:25:55', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34160, '2013-07-23 18:26:11.982791', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34161, '2013-07-23 18:26:17', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34162, '2013-07-23 18:26:33.395908', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34163, '2013-07-23 18:26:38', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34164, '2013-07-23 18:26:54.792137', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34165, '2013-07-23 18:27:00', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34166, '2013-07-23 18:27:16.184244', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34167, '2013-07-23 18:27:21', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34168, '2013-07-23 18:27:37.606408', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34169, '2013-07-23 18:27:43', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34170, '2013-07-23 18:27:59.014556', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34171, '2013-07-23 18:28:04', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34172, '2013-07-23 18:28:20.389725', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34173, '2013-07-23 18:28:25', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34174, '2013-07-23 18:28:41.798896', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34175, '2013-07-23 18:28:47', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34176, '2013-07-23 18:29:03.200079', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34177, '2013-07-23 18:29:08', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34178, '2013-07-23 18:29:24.570519', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34179, '2013-07-23 18:29:29', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34180, '2013-07-23 18:29:45.947372', '1374584142.185', 'Technical', 'SIP/552', 'RINGNOANSWER', '15000', '', '', '', ''),
(34181, '2013-07-23 18:29:51', '1374584142.185', 'Technical', 'SIP/552', 'RINGING', '', '', '', '', ''),
(34182, '2013-07-23 18:30:03.088739', '1374584142.185', 'Technical', 'SIP/552', 'CONNECT', '248', '1374584391.219', '11', '', ''),
(34183, '2013-07-23 18:36:51.917910', '1374584142.185', 'Technical', 'SIP/552', 'COMPLETEAGENT', '248', '408', '1', '', ''),
(34184, '2013-07-24 15:24:11.968105', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34185, '2013-07-24 15:36:15.280118', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34186, '2013-07-24 16:56:50.383008', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34187, '2013-07-24 17:09:30.271843', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34188, '2013-07-24 17:18:28.227238', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34189, '2013-07-24 17:22:32.447120', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34190, '2013-07-24 17:28:08.818915', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34191, '2013-07-25 10:45:59.460968', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34192, '2013-07-25 10:48:57.882764', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34193, '2013-07-25 10:48:57.884014', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'REMOVEMEMBER', '', '', '', '', ''),
(34194, '2013-07-25 10:50:10.384952', '1374729592.225', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34195, '2013-07-25 10:50:10', '1374729592.225', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34196, '2013-07-25 10:50:13.162018', '1374729592.225', 'Billing', 'SIP/333', 'CONNECT', '3', '1374729610.226', '2', '', ''),
(34197, '2013-07-25 10:52:15.361633', '1374729592.225', 'Billing', 'SIP/333', 'COMPLETEAGENT', '3', '122', '1', '', ''),
(34198, '2013-07-25 17:52:21.575625', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34199, '2013-07-25 17:52:21.616098', 'REALTIME', '500', 'SIP/201', 'ADDMEMBER', '', '', '', '', ''),
(34200, '2013-07-25 17:59:16.079637', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34201, '2013-07-25 17:59:16.080611', '1374755336.0', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34202, '2013-07-25 17:59:16', '1374755336.0', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34203, '2013-07-25 17:59:24.337711', '1374755336.0', 'Billing', 'SIP/333', 'CONNECT', '8', '1374755356.1', '7', '', ''),
(34204, '2013-07-25 18:01:40.588564', '1374755336.0', 'Billing', 'SIP/333', 'COMPLETEAGENT', '8', '136', '1', '', ''),
(34205, '2013-07-25 18:05:32.088058', '1374755719.4', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34206, '2013-07-25 18:05:32', '1374755719.4', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34207, '2013-07-25 18:05:36.216087', '1374755719.4', 'Billing', 'SIP/333', 'CONNECT', '4', '1374755732.5', '3', '', ''),
(34208, '2013-07-25 18:05:50.463409', '1374755719.4', 'Billing', 'SIP/333', 'COMPLETEAGENT', '4', '14', '1', '', ''),
(34209, '2013-07-25 18:07:14.667157', '1374755824.8', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34210, '2013-07-25 18:07:14', '1374755824.8', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34211, '2013-07-25 18:07:22.962974', '1374755824.8', 'Billing', 'SIP/333', 'CONNECT', '8', '1374755834.9', '7', '', ''),
(34212, '2013-07-25 18:07:46.052378', '1374755824.8', 'Billing', 'SIP/333', 'COMPLETEAGENT', '8', '24', '1', '', ''),
(34213, '2013-07-25 18:08:00.836905', '1374755872.12', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34214, '2013-07-25 18:08:00', '1374755872.12', 'Billing', 'SIP/333', 'RINGING', '', '', '', '', ''),
(34215, '2013-07-25 18:08:06.131151', '1374755872.12', 'Billing', 'SIP/333', 'CONNECT', '6', '1374755880.13', '4', '', ''),
(34216, '2013-07-25 18:11:23.902844', '1374755872.12', 'Billing', 'SIP/333', 'COMPLETEAGENT', '6', '197', '1', '', ''),
(34217, '2013-07-25 19:05:22.053026', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34218, '2013-07-25 13:49:46.704122', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34219, '2013-07-25 13:51:39.520046', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34220, '2013-07-25 13:51:39.523861', 'REALTIME', '500', 'SIP/201', 'ADDMEMBER', '', '', '', '', ''),
(34221, '2013-07-25 16:55:54.218629', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34222, '2013-07-25 17:06:43.510918', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34223, '2013-07-25 17:08:38.897413', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34224, '2013-07-25 17:08:41.680256', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34225, '2013-07-25 17:30:24.507138', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34226, '2013-07-25 17:30:24.511887', 'REALTIME', '500', 'SIP/201', 'ADDMEMBER', '', '', '', '', ''),
(34227, '2013-07-25 17:30:52.576109', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34228, '2013-07-25 17:35:08.166775', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34229, '2013-07-25 17:35:51.718123', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34230, '2013-07-25 17:40:04.686217', 'CLI', 'testing', 'SIP/551', 'ADDMEMBER', '', '', '', '', ''),
(34231, '2013-07-25 18:24:30.627718', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34232, '2013-07-26 15:59:11.646954', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34233, '2013-07-26 15:59:11.673924', 'REALTIME', '500', 'SIP/201', 'ADDMEMBER', '', '', '', '', ''),
(34234, '2013-07-27 13:17:51.570776', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34235, '2013-07-27 13:18:15.892056', 'REALTIME', '500', 'SIP/201', 'ADDMEMBER', '', '', '', '', ''),
(34236, '2013-07-27 13:30:09.830577', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34237, '2013-07-27 13:31:11.063724', 'CLI', '501', 'SIP/201', 'REMOVEMEMBER', '', '', '', '', ''),
(34238, '2013-07-27 13:58:45.480980', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34239, '2013-07-27 13:59:30.233578', 'CLI', '501', '201', 'REMOVEMEMBER', '', '', '', '', ''),
(34240, '2013-07-27 14:00:14.471127', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34241, '2013-07-27 14:03:38.071499', 'CLI', 'Billing', 'SIP/333', 'ADDMEMBER', '', '', '', '', ''),
(34242, '2013-07-27 14:04:07.703346', '1374914033.1', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34243, '2013-07-27 14:04:31.992052', '1374914033.1', 'Billing', 'NONE', 'ABANDON', '1', '1', '24', '', ''),
(34244, '2013-07-27 14:05:06.446893', '1374914088.2', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34245, '2013-07-27 14:05:37.284382', '1374914088.2', 'Billing', 'NONE', 'ABANDON', '1', '1', '31', '', ''),
(34246, '2013-07-27 14:07:16.127111', '1374914215.4', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34247, '2013-07-27 14:07:36.810517', '1374914215.4', 'Billing', 'NONE', 'ABANDON', '1', '1', '20', '', ''),
(34248, '2013-07-29 16:14:20.743983', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34249, '2013-07-29 16:14:20.744621', 'REALTIME', 'Billing', 'LOCAL/333@default/n,0,333,hint:3', 'ADDMEMBER', '', '', '', '', ''),
(34250, '2013-07-30 09:44:27.092388', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34251, '2013-07-30 09:44:27.094711', '1375157632.2', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34252, '2013-07-30 09:44:34.570699', '1375157632.2', 'Billing', 'SIP/333', 'CONNECT', '10', '1375157667.3', '6', '', ''),
(34253, '2013-07-30 09:45:12.163042', '1375157632.2', 'Billing', 'SIP/333', 'COMPLETEAGENT', '10', '38', '1', '', ''),
(34254, '2013-07-30 09:49:35.883718', '1375157920.7', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '552', '1', '', ''),
(34255, '2013-07-30 09:49:38.742592', '1375157920.7', 'Billing', 'SIP/333', 'CONNECT', '6', '1375157975.8', '2', '', ''),
(34256, '2013-07-30 09:49:51.581778', '1375157920.7', 'Billing', 'SIP/333', 'COMPLETECALLER', '6', '13', '1', '', ''),
(34257, '2013-07-30 09:49:51', '1375157920.7', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34258, '2013-07-30 12:57:44.971218', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34259, '2013-07-30 13:06:54.798396', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34260, '2013-07-30 13:20:21.434872', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34261, '2013-07-30 13:23:10.164186', '1375170738.38', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '552', '1', '', ''),
(34262, '2013-07-30 13:23:25.913787', '1375170738.38', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34263, '2013-07-30 13:23:43.045584', '1375170738.38', 'Billing', 'SIP/333', 'CONNECT', '36', '1375170819.40', '3', '', ''),
(34264, '2013-07-30 13:24:56.299213', 'CLI', 'Technical', 'SIP/551', 'ADDMEMBER', '', '', '', '', ''),
(34265, '2013-07-30 13:25:15.655337', '1375170738.38', 'Billing', 'SIP/333', 'COMPLETECALLER', '36', '92', '1', '', ''),
(34266, '2013-07-30 13:25:18.669578', '1375170738.38', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '552', '1', '', ''),
(34267, '2013-07-30 13:25:26.090817', '1375170738.38', 'Technical', 'SIP/551', 'CONNECT', '11', '1375170918.41', '7', '', ''),
(34268, '2013-07-30 13:25:40.525918', '1375170738.38', 'Technical', 'SIP/551', 'COMPLETECALLER', '11', '14', '1', '', ''),
(34269, '2013-07-30 13:27:19.089446', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34270, '2013-07-30 13:27:28.283501', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34271, '2013-07-30 13:27:41.317963', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34272, '2013-07-30 13:27:53.589544', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34273, '2013-07-30 13:28:28.785918', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34274, '2013-07-30 15:23:42.656161', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34275, '2013-07-30 15:23:42.658321', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34276, '2013-07-30 15:26:52.472478', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34277, '2013-07-30 16:31:27.429753', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34278, '2013-07-30 16:31:27.430957', '1375182056.1', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '552', '1', '', ''),
(34279, '2013-07-30 16:31:30.497462', '1375182056.1', 'Billing', 'SIP/333', 'CONNECT', '6', '1375182087.2', '2', '', ''),
(34280, '2013-07-30 16:31:43.056426', '1375182056.1', 'Billing', 'SIP/333', 'COMPLETECALLER', '6', '13', '1', '', ''),
(34281, '2013-07-30 16:31:43', '1375182056.1', 'Billing', 'SIP/551', 'RINGING', '', '', '', '', ''),
(34282, '2013-07-30 16:34:21.842696', '1375182220.4', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '552', '1', '', ''),
(34283, '2013-07-30 16:34:37.582845', '1375182220.4', 'Billing', 'SIP/333', 'RINGNOANSWER', '15000', '', '', '', ''),
(34284, '2013-07-30 16:34:52.759500', '1375182220.4', 'Billing', 'SIP/333', 'CONNECT', '34', '1375182291.6', '1', '', ''),
(34285, '2013-07-30 16:38:41.185007', '1375182220.4', 'Billing', 'SIP/333', 'COMPLETEAGENT', '34', '229', '1', '', ''),
(34286, '2013-07-31 14:12:50.982273', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34287, '2013-07-31 14:13:12.387366', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34288, '2013-07-31 14:13:22.928551', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34289, '2013-07-31 14:16:41.014577', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34290, '2013-07-31 14:25:13.187848', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34291, '2013-07-31 14:43:20.985887', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34292, '2013-07-31 17:03:35.916090', '1375270391.26', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '553', '1', '', ''),
(34293, '2013-07-31 17:03:41.057045', '1375270391.26', 'Billing', 'SIP/333', 'CONNECT', '9', '1375270415.27', '4', '', ''),
(34294, '2013-07-31 17:04:04.770148', '1375270441.28', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34295, '2013-07-31 17:04:17.836401', '1375270441.28', 'Technical', 'NONE', 'ABANDON', '1', '1', '16', '', ''),
(34296, '2013-07-31 17:04:31.247893', '1375270468.29', 'Billing', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34297, '2013-07-31 17:04:39.960249', '1375270468.29', 'Billing', 'NONE', 'ABANDON', '1', '1', '11', '', ''),
(34298, '2013-07-31 17:05:51.709203', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34299, '2013-07-31 17:05:59.194853', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34300, '2013-07-31 17:07:59.519866', 'CLI', 'Technical', 'SIP/552', 'ADDMEMBER', '', '', '', '', ''),
(34301, '2013-07-31 17:08:23.358937', '1375270700.30', 'Technical', 'NONE', 'ENTERQUEUE', 'subq', '333', '1', '', ''),
(34302, '2013-07-31 17:08:26.694179', '1375270700.30', 'Technical', 'SIP/552', 'CONNECT', '6', '1375270703.31', '3', '', ''),
(34303, '2013-07-31 17:08:33.309760', '1375270700.30', 'Technical', 'SIP/552', 'COMPLETEAGENT', '6', '7', '1', '', ''),
(34304, '2013-07-31 17:56:13.938924', '1375270391.26', 'Billing', 'SIP/333', 'COMPLETECALLER', '9', '3152', '1', '', ''),
(34305, '2013-08-02 14:41:33.359407', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34306, '2013-08-02 14:41:33.359856', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34307, '2013-08-02 14:42:50.004992', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34308, '2013-08-02 14:44:32.951675', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34309, '2013-08-02 14:55:24.131934', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34310, '2013-08-02 15:00:11.175341', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34311, '2013-08-02 15:00:16.082408', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34312, '2013-08-02 15:06:48.366422', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34313, '2013-08-02 15:28:48.295811', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34314, '2013-08-02 15:31:04.860730', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34315, '2013-08-02 15:39:10.382230', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34316, '2013-08-02 15:39:10.384143', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34317, '2013-08-02 15:40:08.815521', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34318, '2013-08-02 15:41:26.006438', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34319, '2013-08-02 15:47:19.135926', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34320, '2013-08-02 15:50:33.561226', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34321, '2013-08-02 15:50:39.788269', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34322, '2013-08-02 15:51:11.847004', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34323, '2013-08-02 17:24:11.467520', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34324, '2013-08-02 17:28:06.445840', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34325, '2013-08-05 10:43:50.905988', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34326, '2013-08-05 10:43:50.928077', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34327, '2013-08-05 11:03:31.711138', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34328, '2013-08-05 11:09:16.429975', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34329, '2013-08-05 11:10:32.077480', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34330, '2013-08-06 13:03:19.380865', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34331, '2013-08-06 14:26:21.633353', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34332, '2013-08-06 14:27:52.931773', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34333, '2013-08-06 15:00:56.436141', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34334, '2013-08-06 15:17:22.924840', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34335, '2013-08-06 15:18:36.793810', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34336, '2013-08-06 15:21:19.089705', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34337, '2013-08-06 15:30:43.728733', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34338, '2013-08-06 15:45:38.229344', 'NONE', 'NONE', 'NONE', 'QUEUESTART', '', '', '', '', ''),
(34339, '2013-08-06 15:45:38.229890', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34340, '2013-08-06 18:05:20.041145', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', ''),
(34341, '2013-08-06 18:10:05.787898', 'NONE', 'NONE', 'NONE', 'CONFIGRELOAD', '', '', '', '', '');
