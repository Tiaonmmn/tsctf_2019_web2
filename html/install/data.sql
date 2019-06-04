DROP TABLE IF EXISTS `caicaicms_about`;
CREATE TABLE `caicaicms_about` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(50) default NULL,
  `content` longtext,
  `link` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_admin`;
CREATE TABLE `caicaicms_admin` (
  `id` int(11) NOT NULL auto_increment,
  `groupid` int(11) default NULL,
  `admin` char(50) default NULL,
  `pass` char(50) default NULL,
  `logins` int(11) default '0',
  `loginip` char(50) default NULL,
  `lastlogintime` datetime default NULL,
  `showloginip` char(50) default NULL,
  `showlogintime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_login_times`;
CREATE TABLE `caicaicms_login_times` (
  `id` int(11) NOT NULL auto_increment,
  `ip` char(50) default NULL,
  `count` int(11) default '0',
  `sendtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_admingroup`;
CREATE TABLE `caicaicms_admingroup` (
  `id` int(11) NOT NULL auto_increment,
  `groupname` char(50) default NULL,
  `config` varchar(1000) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_admingroup` values('1','超级管理员','zs#zs_modify#zs_del#zsclass#zskeyword#dl#dl_add#dl_modify#dl_del#guestbook#zh#zh_add#zh_modify#zh_del#zhclass#zx#zx_add#zx_modify#zx_del#zxclass#zxpinglun#zxtag#pp#pp_modify#pp_del#job#job_modify#job_del#jobclass#special#special_add#special_modify#special_del#specialclass#wangkan#wangkan_add#wangkan_modify#wangkan_del#wangkanclass#baojia#baojia_modify#baojia_del#ask#ask_add#ask_modify#ask_del#askclass#adv#adv_add#adv_modify#adv_del#advclass#adv_user#user#user_modify#user_del#usernoreg#userclass#usergroup#friendlink#friendlink_add#friendlink_modify#friendlink_del#about#about_add#about_modify#about_del#label#label_add#label_modify#label_del#licence#fankui#badusermessage#uploadfiles#sendmessage#sendmail#sendsms#announcement#helps#siteconfig#adminmanage#admingroup');
replace into `caicaicms_admingroup` values('2','管理员(演示用)','zs#zs_modify#zskeyword#dl#dl_add#dl_modify#guestbook#zh#zh_add#zh_modify#zx#zx_add#zx_modify#zxpinglun#zxtag#pp#pp_modify#job#job_modify#special#special_add#special_modify#wangkan#wangkan_add#wangkan_modify#baojia#baojia_modify#ask#ask_add#ask_modify#adv#user#usernoreg#friendlink#about#label#licence#fankui#badusermessage#sendmessage#sendmail#sendsms');

DROP TABLE IF EXISTS `caicaicms_bad`;
CREATE TABLE `caicaicms_bad` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `ip` char(50) default NULL,
  `dose` char(255) default NULL,
  `sendtime` datetime default NULL,
  `lockip` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_main`;
CREATE TABLE `caicaicms_main` (
  `id` int(4) NOT NULL auto_increment,
  `proname` char(50) default NULL,
  `link` char(255) default NULL,
  `szm` char(100) default NULL,
  `prouse` char(255) default NULL,
  `procompany` char(50) default NULL,
  `tz` char(25) default NULL,
  `sm` text,
  `xuhao` int(4) default NULL,
  `bigclassid` tinyint(4) default 0,
  `smallclassid` tinyint(4) default 0,
  `smallclassids` char(50) default NULL,
  `img` char(255) default NULL,
  `flv` char(255) default NULL,
  `province` char(50) default NULL,
  `city` char(50) default NULL,
  `xiancheng` char(50) default NULL,
  `province_user` char(50) default NULL,
  `city_user` char(50) default NULL,
  `xiancheng_user` char(50) default NULL,
  `zc` char(255) default NULL,
  `yq` char(255) default NULL,
  `other` char(255) default NULL,
  `shuxing_value`  char(255) default NULL,
  `sendtime` datetime default NULL,
  `timefororder` char(50) default NULL,
  `editor` char(50) default NULL,
  `elitestarttime` datetime default NULL,
  `eliteendtime` datetime default NULL,
  `title` char(255) default NULL,
  `keywords` char(255) default NULL,
  `description` char(255) default NULL,
  `refresh` int(11) default '0',
  `hit` int(11) default '0',
  `elite` tinyint(4) default '0',
  `passed` tinyint(4) default '0',
  `userid` int(11) default '0',
  `comane` char(255) default NULL,
  `qq` char(50) default NULL,
  `groupid` int(11) default '0',
  `renzheng` tinyint(4) default '0',
  `ppid` int(11) default '0',
  `gjzpm` tinyint(4) default '0',
  `tag` char(255) default NULL,
  `skin` char(25) default NULL,  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_main` ADD INDEX (  `province` ,  `city` ,  `xiancheng` ) ;
ALTER TABLE  `caicaicms_main` ADD INDEX (  `bigclassid` ) ;

DROP TABLE IF EXISTS `caicaicms_dl`;
CREATE TABLE `caicaicms_dl` (
  `id` int(11) NOT NULL auto_increment,
  `classid` tinyint(4) default 0,
  `cpid` int(11) default '0',
  `cp` char(50) default NULL,
  `province` char(50) default NULL,
  `city` char(50) default NULL,
  `xiancheng` char(50) default NULL,
  `content` char(255) default NULL,
  `company` char(50) default NULL,
  `companyname` char(50) default NULL,
  `dlsname` char(50) default NULL,
  `address` char(255) default NULL,
  `tel` char(50) default NULL,
  `email` char(100) default NULL,
  `editor` char(50) default NULL,
  `saver` char(50) default NULL,
  `savergroupid` int(11) default '0',
  `ip` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `looked` tinyint(4) default '0',
  `passed` tinyint(4) default '0',
  `del` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_dl` ADD INDEX (  `province` ,  `city` ,  `xiancheng` ) ;
ALTER TABLE  `caicaicms_dl` ADD INDEX (  `classid` ) ;

DROP TABLE IF EXISTS `caicaicms_baojia`;
CREATE TABLE `caicaicms_baojia` (
  `id` int(11) NOT NULL auto_increment,
  `classid` tinyint(4) default 0,
  `cp` char(50) default NULL,
  `province` char(50) default NULL,
  `city` char(50) default NULL,
  `xiancheng` char(50) default NULL,
  `price` char(50) default NULL,
  `danwei` char(50) default NULL,
  `companyname` char(50) default NULL,
  `truename` char(50) default NULL,
  `address` char(50) default NULL,
  `tel` char(50) default NULL,
  `email` char(100) default NULL,
  `editor` char(50) default NULL,
  `ip` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_baojia` ADD INDEX (  `province` ,  `city` ,  `xiancheng` ) ;
ALTER TABLE  `caicaicms_baojia` ADD INDEX (  `classid` ) ;

DROP TABLE IF EXISTS `caicaicms_guestbook`;
CREATE TABLE `caicaicms_guestbook` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(50) default NULL,
  `content` longtext,
  `sendtime` datetime default NULL,
  `linkmen` char(50) default NULL,
  `phone` char(50) default NULL,
  `email` char(100) default NULL,
  `saver` char(50) default NULL,
  `looked` tinyint(4) default '0',
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_help`;
CREATE TABLE `caicaicms_help` (
  `id` int(11) NOT NULL auto_increment,
  `classid` int(11) default NULL,
  `title` char(50) default NULL,
  `content` longtext,
  `img` char(255) default NULL,
  `elite` tinyint(4) default '0',
  `sendtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_licence`;
CREATE TABLE `caicaicms_licence` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(50) default NULL,
  `img` char(255) default NULL,
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `passed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_link`;
CREATE TABLE `caicaicms_link` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default '0',
  `sitename` char(50) default NULL,
  `url` char(255) default NULL,
  `content` char(255) default NULL,
  `sendtime` datetime default NULL,
  `logo` char(255) default NULL,
  `elite` tinyint(4) default '0',
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_linkclass`;
CREATE TABLE `caicaicms_linkclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `xuhao` int(11) NOT NULL default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_linkclass` values('1','合作网站','0');
replace into `caicaicms_linkclass` values('2','友链网站','0');

DROP TABLE IF EXISTS `caicaicms_looked_dls`;
CREATE TABLE `caicaicms_looked_dls` (
  `id` int(11) NOT NULL auto_increment,
  `dlsid` int(11) default NULL,
  `username` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_looked_dls_number_oneday`;
CREATE TABLE `caicaicms_looked_dls_number_oneday` (
  `id` int(11) NOT NULL auto_increment,
  `looked_dls_number_oneday` int(11) default NULL,
  `username` char(50) default NULL,
  `sendtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_pp`;
CREATE TABLE `caicaicms_pp` (
  `id` int(11) NOT NULL auto_increment,
  `ppname` char(255) default NULL,
  `bigclassid` tinyint(4) default 0,
  `smallclassid` tinyint(4) default 0,
  `sm` longtext,
  `img` char(255) default NULL,
  `sendtime` datetime default NULL,
  `editor` char(50) default NULL,
  `comane` char(50) default NULL,
  `userid` int(11) default '0',
  `hit` int(11) default '0',
  `passed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_pp` ADD INDEX (  `bigclassid` ) ;

DROP TABLE IF EXISTS `caicaicms_jobclass`;
CREATE TABLE `caicaicms_jobclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `parentid` int(11) default '0',
  `classzm` char(50) default NULL,
  `img` char(50) default NULL,
  `skin` char(50) default NULL,
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  `xuhao` int(11) default '0',
  `isshow` tinyint(4) default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_job`;
CREATE TABLE `caicaicms_job` (
  `id` int(11) NOT NULL auto_increment, 
  `bigclassid` int(11) default '0',
  `bigclassname` char(50) default NULL,
  `smallclassid` int(11) default '0',
  `smallclassname` char(50) default NULL,
  `jobname` char(50) default NULL,
  `province` char(50) default NULL,
  `city` char(50) default NULL,
  `xiancheng` char(50) default NULL,
  `sm` varchar(1000) default NULL,
  `editor` char(50) default NULL,
  `comane` char(50) default NULL,
  `userid` int(11) default '0',
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_message`;
CREATE TABLE `caicaicms_message` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(50) default NULL,
  `content` char(255) default NULL,
  `sendtime` datetime default NULL,
  `sendto` char(50) NOT NULL,
  `looked` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_ad`;
CREATE TABLE `caicaicms_ad` (
  `id` int(11) NOT NULL auto_increment,
  `xuhao` int(11) NOT NULL default '0',
  `title` char(50) default NULL,
  `titlecolor` char(255) default NULL,
  `link` char(255) default NULL,
  `sendtime` datetime default NULL,
  `bigclassname` char(50) default NULL,
  `smallclassname` char(50) default NULL,
  `username` char(50) default NULL,
  `nextuser` char(50) default NULL,
  `elite` tinyint(4) NOT NULL default '0',
  `img` char(255) default NULL,
  `starttime` datetime default NULL,
  `endtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_adclass`;
CREATE TABLE `caicaicms_adclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) NOT NULL,
  `parentid` char(50) NOT NULL,
  `xuhao` int(11) NOT NULL default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_adclass` values('1','对联广告右侧','首页','0');
replace into `caicaicms_adclass` values('2','对联广告左侧','首页','0');
replace into `caicaicms_adclass` values('3','漂浮广告','首页','0');
replace into `caicaicms_adclass` values('4','首页顶部','首页','0');
replace into `caicaicms_adclass` values('5','品牌招商','首页','0');
replace into `caicaicms_adclass` values('6','banner','首页','0');
replace into `caicaicms_adclass` values('7','轮显广告','展会页','0');
replace into `caicaicms_adclass` values('8','第二行','首页','0');
replace into `caicaicms_adclass` values('9','轮显广告','首页','0');
replace into `caicaicms_adclass` values('10','第一行','首页','0');
replace into `caicaicms_adclass` values('11','B','首页','0');
replace into `caicaicms_adclass` values('12','A','首页','0');
replace into `caicaicms_adclass` values('13','首页','A','0');

DROP TABLE IF EXISTS `caicaicms_pay`;
CREATE TABLE `caicaicms_pay` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `dowhat` char(50) default NULL,
  `RMB` char(50) default '0',
  `mark` char(255) default NULL,
  `sendtime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_pinglun`;
CREATE TABLE `caicaicms_pinglun` (
  `id` int(11) NOT NULL auto_increment,
  `about` int(11) default '0',
  `content` char(255) default NULL,
  `face` char(50) default NULL,
  `username` char(50) default NULL,
  `ip` char(50) default NULL,
  `sendtime` datetime default NULL,
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_tagzx`;
CREATE TABLE `caicaicms_tagzx` (
  `id` int(11) NOT NULL auto_increment,
  `xuhao` int(11) default '0',
  `keyword` char(50) default NULL,
  `url` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_tagzs`;
CREATE TABLE `caicaicms_tagzs` (
  `id` int(11) NOT NULL auto_increment,
  `keyword` char(50) default NULL,
  `url` char(50) default NULL,
  `xuhao` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_textadv`;
CREATE TABLE `caicaicms_textadv` (
  `id` int(11) NOT NULL auto_increment,
  `adv` char(50) default NULL,
  `company` char(50) NOT NULL,
  `advlink` char(50) default NULL,
  `img` char(255) default NULL,
  `username` char(50) default NULL,
  `gxsj` datetime default NULL,
  `newsid` int(11) NOT NULL default '0',
  `passed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `adv` (`adv`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_user`;
CREATE TABLE `caicaicms_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `passwordtrue` char(50) default NULL,
  `qqid` char(50) default NULL,
  `email` char(100) default NULL,
  `sex` char(50) default NULL,
  `comane` char(50) default NULL,
  `content` longtext,
  `bigclassid` int(11) default '0',
  `smallclassid` int(11) default '0',
  `province` char(50) default NULL,
  `city` char(50) default NULL,
  `xiancheng` char(50) default NULL,
  `img` char(255) default NULL,
  `flv` char(255) default NULL,
  `address` char(100) default NULL,
  `somane` char(50) default NULL,
  `phone` char(50) default NULL,
  `mobile` char(50) default NULL,
  `fox` char(50) default NULL,
  `qq` char(50) default NULL,
  `regdate` datetime default NULL,
  `loginip` char(50) default NULL,
  `logins` int(11) NOT NULL default '0',
  `homepage` char(50) default NULL,
  `lastlogintime` datetime default NULL,
  `lockuser` tinyint(4) NOT NULL default '0',
  `groupid` int(11) NOT NULL default '1',
  `totleRMB` int(11) NOT NULL default '0',
  `startdate` datetime default NULL,
  `enddate` datetime default NULL,
  `showloginip` char(50) default NULL,
  `showlogintime` datetime default NULL,
  `elite` tinyint(4) NOT NULL default '0',
  `renzheng` tinyint(4) NOT NULL default '0',
  `usersf` char(20) default NULL,
  `passed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_usergroup`;
CREATE TABLE `caicaicms_usergroup` (
  `id` int(11) NOT NULL auto_increment,
  `groupid` int(11) NOT NULL default '1',
  `groupname` char(50) NOT NULL,
  `grouppic` char(50) NOT NULL,
  `RMB` int(11) NOT NULL default '0',
  `config` varchar(1000) NOT NULL default '0',
  `looked_dls_number_oneday` int(11) NOT NULL default '0',
  `refresh_number` int(11) NOT NULL default '0',
  `addinfo_number` int(11) NOT NULL default '0',
  `addinfototle_number` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_usergroup` values('1','1','普通会员','/image/level1.gif','0','showad_inzt','10','1','50','100');
replace into `caicaicms_usergroup` values('2','2','vip会员','/image/level2.gif','1999','look_dls_data#look_dls_liuyan','100','3','100','500');
replace into `caicaicms_usergroup` values('3','3','高级会员','/image/level3.gif','2999','look_dls_data#look_dls_liuyan','999','999','999','999');

DROP TABLE IF EXISTS `caicaicms_userclass`;
CREATE TABLE `caicaicms_userclass` (
  `classid` int(11) NOT NULL auto_increment,
  `parentid` int(11) default '0',
  `classname` char(50) NOT NULL,
  `classzm` char(50) default NULL,
  `img` char(50) default NULL,
  `skin` char(50) default NULL,
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  `isshow` tinyint(4) default '0',
  `xuhao` int(11) NOT NULL default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_userclass` values('1','0','生产单位','','','','','','','1','0');
replace into `caicaicms_userclass` values('2','0','经销单位','','','','','','','1','0');
replace into `caicaicms_userclass` values('4','0','展会承办单位','','','','','','','1','0');
replace into `caicaicms_userclass` values('5','0','其它相关行业','','','','','','','1','0');

DROP TABLE IF EXISTS `caicaicms_usermessage`;
CREATE TABLE `caicaicms_usermessage` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(50) default NULL,
  `content` varchar(255) default NULL,
  `sendtime` datetime default NULL,
  `editor` char(50) default NULL,
  `reply` varchar(255) default NULL,
  `replytime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_usernoreg`;
CREATE TABLE `caicaicms_usernoreg` (
  `id` int(11) NOT NULL auto_increment,
  `usersf` char(50) default NULL,
  `username` char(50) NOT NULL,
  `password` char(50) default NULL,
  `comane` char(50) default NULL,
  `kind` int(11) NOT NULL default '0',
  `somane` char(50) default NULL,
  `phone` char(50) default NULL,
  `email` char(100) default NULL,
  `checkcode` char(50) default NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_usersetting`;
CREATE TABLE `caicaicms_usersetting` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `skin` char(50) default '1',
  `skin_mobile` char(50) default '1',
  `tongji` char(255) default NULL,
  `baidu_map` char(50) default NULL,
  `mobile` char(50) default NULL,
  `daohang` char(50) default NULL,
  `bannerbg` char(50) default NULL,
  `bannerheight` int(11) NOT NULL default '160',
  `comanestyle` char(50) default NULL,
  `comanecolor` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_zh`;
CREATE TABLE `caicaicms_zh` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default NULL,
  `title` char(50) default NULL,
  `address` char(100) default NULL,
  `timestart` datetime default NULL,
  `timeend` datetime default NULL,
  `content` longtext,
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) default '0',
  `elite` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_zhclass`;
CREATE TABLE `caicaicms_zhclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `xuhao` int(11) default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_wangkan`;
CREATE TABLE `caicaicms_wangkan` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default NULL,
  `title` char(50) default NULL,
  `content` longtext,
  `img` char(255) default NULL,
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) default '0',
  `elite` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_wangkanclass`;
CREATE TABLE `caicaicms_wangkanclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `xuhao` int(11) default '0',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_zsclass`;
CREATE TABLE `caicaicms_zsclass` (
  `classid` int(11) NOT NULL auto_increment,
  `parentid` int(11) NOT NULL default 0,
  `classname` char(50) NOT NULL,
  `classzm` char(50) default NULL,
  `img` char(50) NOT NULL default '0',
  `skin` char(50) default NULL,
  `xuhao` int(11) NOT NULL default '0',
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  `isshow` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_zx`;
CREATE TABLE `caicaicms_zx` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default NULL,
  `bigclassname` char(50) default NULL,
  `smallclassid` int(11) default NULL,
  `smallclassname` char(50) default NULL,
  `title` char(50) default NULL,
  `link` char(255) default NULL,
  `laiyuan` char(50) default NULL,
  `keywords` char(255) default NULL,
  `description` char(255) default NULL,
  `content` longtext,
  `img` char(255) default NULL,
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) default '0',
  `elite` tinyint(4) default '0',
  `groupid` int(11) default '1',
  `jifen` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_zx` ADD INDEX (`bigclassid`) ;

DROP TABLE IF EXISTS `caicaicms_zxclass`;
CREATE TABLE `caicaicms_zxclass` (
  `classid` int(11) NOT NULL auto_increment,
  `parentid` int(11) default '0',
  `classname` char(50) default NULL,
  `classzm` char(50) default NULL,
  `img` char(50) default NULL,
  `skin` char(50) default NULL,
  `xuhao` int(11) default '0',
  `isshow` tinyint(4) default '1',
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_ask`;
CREATE TABLE `caicaicms_ask` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default NULL,
  `bigclassname` char(50) default NULL,
  `smallclassid` int(11) default NULL,
  `smallclassname` char(50) default NULL,
  `title` char(50) default NULL,
  `content` longtext,
  `img` char(255) default NULL,
  `jifen` int(11) default '0',
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `elite` tinyint(4) default '0',
  `typeid` int(11) default '0',
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_ask` ADD INDEX (  `bigclassid` ) ;

DROP TABLE IF EXISTS `caicaicms_askclass`;
CREATE TABLE `caicaicms_askclass` (
  `classid` int(11) NOT NULL auto_increment,
  `parentid` int(11) default '0',
  `classname` char(50) default NULL,
  `classzm` char(50) default NULL,
  `img` char(50) default NULL,
  `skin` char(50) default NULL,
  `xuhao` int(11) default '0',
  `isshow` tinyint(4) default '1',
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_answer`;
CREATE TABLE `caicaicms_answer` (
  `id` int(11) NOT NULL auto_increment,
  `about` int(11) default '0',
  `content` longtext,
  `face` char(50) default NULL,
  `editor` char(50) default NULL,
  `ip` char(50) default NULL,
  `sendtime` datetime default NULL,
  `caina` tinyint(4) default '0',
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_special`;
CREATE TABLE `caicaicms_special` (
  `id` int(11) NOT NULL auto_increment,
  `bigclassid` int(11) default NULL,
  `bigclassname` char(50) default NULL,
  `smallclassid` int(11) default NULL,
  `smallclassname` char(50) default NULL,
  `title` char(50) default NULL,
  `link` char(255) default NULL,
  `laiyuan` char(50) default NULL,
  `keywords` char(255) default NULL,
  `description` char(255) default NULL,
  `content` longtext,
  `img` char(255) default NULL,
  `editor` char(50) default NULL,
  `sendtime` datetime default NULL,
  `hit` int(11) default '0',
  `passed` tinyint(4) default '0',
  `elite` tinyint(4) default '0',
  `groupid` int(11) default '1',
  `jifen` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
ALTER TABLE  `caicaicms_special` ADD INDEX (  `bigclassid` ) ;

DROP TABLE IF EXISTS `caicaicms_specialclass`;
CREATE TABLE `caicaicms_specialclass` (
  `classid` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `classzm` char(50) default NULL,
  `img` char(50) default NULL,
  `skin` char(50) default NULL,
  `parentid` int(11) default '0',
  `xuhao` int(11) default '0',
  `isshow` tinyint(4) default '1',
  `title` char(255) default NULL,
  `keyword` char(255) default NULL,
  `description` char(255) default NULL,
  PRIMARY KEY  (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
replace into `caicaicms_specialclass` values('1','2015广西药交会','','','','0','0','1','','','');
replace into `caicaicms_specialclass` values('2','访谈','','','','1','1','1','','','');
replace into `caicaicms_specialclass` values('3','名企直击','','','','1','1','1','','','');
replace into `caicaicms_specialclass` values('4','展会现场','','','','1','1','1','','','');
replace into `caicaicms_specialclass` values('5','展会简介','','','','1','1','1','','','');
replace into `caicaicms_specialclass` values('6','大背景图','','','','1','1','1','','','');

DROP TABLE IF EXISTS `caicaicms_msg`;
CREATE TABLE `caicaicms_msg` (
  `id` int(11) NOT NULL auto_increment,
  `content` varchar(1000) NOT NULL,
  `elite` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_userdomain`;
CREATE TABLE `caicaicms_userdomain` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `domain` char(50) default NULL,
  `passed` tinyint(4) default '0',
  `del` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `caicaicms_ztad`;
CREATE TABLE `caicaicms_ztad` (
  `id` int(11) NOT NULL auto_increment,
  `classname` char(50) default NULL,
  `title` char(50) default NULL,
  `link` char(255) default NULL,
  `img` char(255) default NULL,
  `editor` char(50) default NULL,
  `passed` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8