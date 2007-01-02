CREATE DATABASE flextest;
USE flextest;

CREATE TABLE `users` (
  `userid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(255) collate latin1_general_ci NOT NULL default '',
  `emailaddress` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


GRANT SELECT, INSERT, UPDATE, DELETE
on flextest.* to flext@localhost identified by 'p@ssword';

INSERT INTO users VALUES ('', 'Sue Hansen', 'sue.hansen@flextest.com');
INSERT INTO users VALUES ('', 'George Johnson', 'george.johnson@flextest.com');