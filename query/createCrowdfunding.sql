/*
Data Set For Final Project 1
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `User`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uname` varchar(40) NOT NULL,
  `uemail` varchar(40) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `credit`	varchar(40) DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of User
-- ----------------------------


-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE SEQUENCE psequence
INCREMENT BY 1
START WITH 1000
MAXVALUE 9999
NOCACHE
NOCYCLE;
CREATE TABLE `project` (
  `pid` INT NOT NULL,
  `uname` varchar(40) NOT NULL,
  `startDate` DATETIME NOT NULL,
  `endDate` DATETIME NOT NULL,
  `minAmount` decimal(10,2) NOT NULL,
  `maxAmount` decimal(10,2) NOT NULL,
  `curAmount` decimal(10,2) NULL,
  `pname` varchar(40) DEFAULT NULL,
  `status` enum('WAIT', 'START', 'FAIL', 'END') DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `description` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  FOREIGN KEY (`uname`) REFERENCES `user` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------

-- ----------------------------
-- Table structure for `progress`
-- ----------------------------
DROP TABLE IF EXISTS `progress`;
CREATE TABLE `progress` (
  `pid` INT NOT NULL,
  `version` INT NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`pid`,`version`),
  FOREIGN KEY (`pid`) REFERENCES `project` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of progress
-- ----------------------------

-- ----------------------------
-- Table structure for `sponsor`
-- ----------------------------
DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE `sponsor` (
  `pid` INT NOT NULL,
  `uname` varchar(40) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `rate` INT NULL,
  `pledgeStatus` enum('CHARGED', 'WAIT') DEFAULT NULL,
  -- Discuss to a waiting project
  `discuss` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`pid`,`uname`),
  FOREIGN KEY (`pid`) REFERENCES `project` (`pid`),
  FOREIGN KEY (`uname`) REFERENCES `user` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sponsor
-- ----------------------------

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `uname` varchar(40) NOT NULL,
  `pid` INT NOT NULL,
  `version` INT NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`uname`, `pid`,`version`),
  FOREIGN KEY (`uname`) REFERENCES `user` (`uname`),
  FOREIGN KEY (`pid`) REFERENCES `project` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for `follower`
-- ----------------------------
DROP TABLE IF EXISTS `follower`;
CREATE TABLE `follower` (
  `uname` varchar(40) NOT NULL,
  `funame` varchar(40) NOT NULL,
  PRIMARY KEY (`uname`,`funame`),
  FOREIGN KEY (`uname`) REFERENCES `user` (`uname`),
  FOREIGN KEY (`funame`) REFERENCES `user` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of follower
-- ----------------------------
