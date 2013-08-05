-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_mi_user`
-- 

CREATE TABLE `tl_mi_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `token` blob NULL,
  `startdate` varchar(10) NOT NULL default '',
  `enddate` varchar(10) NOT NULL default '',
  `api` char(1) NOT NULL default '',
  `core` char(1) NOT NULL default '',
  `extensions` char(1) NOT NULL default '',
  `members` char(1) NOT NULL default '',
  `users` char(1) NOT NULL default '',
  `php` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;