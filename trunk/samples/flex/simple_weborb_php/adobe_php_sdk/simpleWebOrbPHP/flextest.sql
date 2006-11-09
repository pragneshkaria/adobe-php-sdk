CREATE DATABASE flextest;
USE flextest;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
# DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(255) collate latin1_general_ci NOT NULL,
  `emailaddress` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
#DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` char(16) NOT NULL,
  `password` char(40) NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- ----------------------------
--  Table structure for bad authentication `log`
-- ----------------------------
#DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `logid` int(10) unsigned NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `username` char(16) NOT NULL default '',
  `password` char(40) NOT NULL default '',
  PRIMARY KEY  (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `users` VALUES (NULL,'Joe Foo','joe@foo.edu');
INSERT INTO `users` VALUES (NULL,'Mike Smith','smittty@irornworks.com');
INSERT INTO `users` VALUES (NULL,'Rita Bervage','rb@pcc.edu');
INSERT INTO `users` VALUES (NULL,'Sam Smith','sam@adobe.com');
INSERT INTO `users` VALUES (NULL,'Shirley Coleman','shirley.colemen@abc-corp.com');
INSERT INTO `users` VALUES (NULL,'Big John','john@potts.com');
INSERT INTO `users` VALUES (NULL,'Bob Jones','rjones@bobco.com');
INSERT INTO `users` VALUES (NULL,'Alice Pounder','allicep@heaveto.com');
INSERT INTO `users` VALUES (NULL,'Rich Simpson','rsimpson@asu.edu');
INSERT INTO `users` VALUES (NULL,'Delete Me','spy-bot@fake.com');
INSERT INTO `users` VALUES (NULL,'Delete Me','delete.me@bogusu.edu');

# Note: The `admin` password is US Secure Hash Algorithm 1 (SHA1) encrypted
#       so that snoopy eyes can't read read the passwords from the database.
# The SHA1 password hash is a 40-character hexadecimal number.
INSERT INTO `admin` VALUES ('admin', sha1('admin'));
INSERT INTO `admin` VALUES ('user1', sha1('user11'));
INSERT INTO `admin` VALUES ('user2', sha1('user22'));
INSERT INTO `admin` VALUES ('user3', sha1('user33'));

GRANT SELECT, INSERT, UPDATE, DELETE
on flextest.* to flext@localhost identified by 'p@ssword';