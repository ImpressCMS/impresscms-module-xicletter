# Module: XMAIL
# Version: v1.10
# Release Date: 17 Fevereiro 2004
# Author: Claudia Antonini Vitiello Callegari
# License: GNU
#


# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xoops
# --------------------------------------------------------
# Server version 3.23.51-nt



#
# Table structure for table 'xoops_xmail_files'
#

CREATE TABLE `xmail_files` (
  `fileid` int(8) NOT NULL auto_increment,
  `filerealname` varchar(255) NOT NULL default '',
  `date` int(10) NOT NULL default '0',
  `ext` varchar(64) NOT NULL default '',
  `minetype` varchar(64) NOT NULL default '',
  `filedescript` text,
  `uid` int(10) NOT NULL default '0',
  `dir_upload` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`fileid`),
  KEY `uid` (`uid`)
) TYPE=MyISAM COMMENT='by Claudia A. V. Callegari';



#
# Table structure for table 'xoops_xmail_men_anexo'
#

CREATE TABLE `xmail_men_anexo` (
  `fileid` int(8) NOT NULL default '0',
  `idmen` int(5) NOT NULL default '0',
  KEY `idmen` (`idmen`),
  KEY `fileid` (`fileid`)
) TYPE=MyISAM COMMENT='by Claudia A. V. Callegari';



#
# Table structure for table 'xoops_xmail_mensage'
#

CREATE TABLE `xmail_mensage` (
  `id_men` int(5) unsigned NOT NULL auto_increment,
  `title_men` varchar(50) NOT NULL default '',
  `subject_men` varchar(80) NOT NULL default '',
  `body_men` text NOT NULL,
  `aprovada` tinyint(1) unsigned NOT NULL default '0',
  `uid` int(6) unsigned NOT NULL default '0',
  `datesub` int(11) unsigned NOT NULL default '0',
  `date_envio` int(11) unsigned NOT NULL default '0',
  `dohtml` tinyint(1) unsigned NOT NULL default '0',
  `dobr` tinyint(1) unsigned NOT NULL ,
  `is_new` tinyint(1) unsigned NOT NULL default '0',
  `body_men_text` text NOT NULL,
  PRIMARY KEY  (`id_men`),
  KEY `title_men` (`title_men`),
  KEY `aprovada` (`aprovada`)
) TYPE=MyISAM COMMENT='by Claudia A. V. Callegari';



#
# Table structure for table 'xoops_xmail_param'
#

CREATE TABLE `xmail_param` (
  `dias_excluir` int(4) unsigned NOT NULL default '100',
  `envia_xmails` int(4) unsigned NOT NULL default '50',
  `ordem_admin` char(2) default 'A' NOT NULL,
  `limite_page` tinyint(4) default '10' NOT NULL,
  `aprov_auto` tinyint(1) NOT NULL default '0',
  `dir_upload` varchar(255) NOT NULL default 'uploads/xmail',
  `selmimetype` text NOT NULL ,
  `maxupload` int(10) NOT NULL default '1048576',
  `format_time` varchar(100) NOT NULL default 'd-M-Y H:i:s',
  `permite_anexo` tinyint(1) NOT NULL default '0',
  `file_mode` varchar(4) NOT NULL default '0774',
  `veri_mailok` tinyint(1) NOT NULL default '1',
  `allow_html` tinyint(1) unsigned NOT NULL default '0',
  `tipo_editor` varchar(10) default '',
  `usa_perf` tinyint(1) NOT NULL default '0',
  `hora_intervalo` tinyint(2) NOT NULL default '0',
  `minutos_intervalo` tinyint(2) NOT NULL default '0',
  `lotes_por_hora` tinyint(3) NOT NULL default 0 
) TYPE=MyISAM;
	
insert into xmail_param (selmimetype) values ('doc lha lzh pdf gtar swf tar tex texinfo texi zip Zip au XM snd mid midi kar mpga mp2 mp3 aif aiff aifc m3u ram rm rpm ra wav wax bmp gif ief jpeg jpg jpe png tiff tif ico pbm ppm rgb xbm xpm css html htm asc txt rtx rtf mpeg mpg mpe qt mov mxu avi');

#
# Table structure for table 'xoops_xmail_send_log'
#

CREATE TABLE `xmail_send_log` (
  `id_user` mediumint(8) unsigned NOT NULL default '0',
  `id_men` int(5) unsigned NOT NULL default '0',
  `dt_envio` int(11) NOT NULL default '0',
  `email_conf` varchar(60) NOT NULL default '' ,
  `is_user_news` tinyint(1) unsigned NOT NULL default '0',
  KEY `id_user` (`id_user`),
  KEY `id_men` (`id_men`),
  KEY `dt_envio` (`dt_envio`)
) TYPE=MyISAM;


# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xoops
# --------------------------------------------------------
# Server version 4.1.7-nt


#
# Table structure for table 'xoops_xmail_ativacao'
#


CREATE TABLE xmail_ativacao (
  id_user smallint(8) unsigned NOT NULL default '0'  ,
  dt_envio int(11) unsigned default NULL,
  user_logado mediumint(8) unsigned default NULL,
  activation_type tinyint(1) unsigned default NULL  ,
  KEY `id_user` (`id_user`)
) TYPE=MyISAM;

#
# Table structure for table 'xoops_xmail_aux_send'
#

CREATE TABLE xmail_aux_send (
  id_user mediumint(8) unsigned NOT NULL default '0' ,
  lote_solicit int(11) NOT NULL default '0' ,
  UNIQUE KEY lote (lote_solicit,id_user)
)TYPE=MyISAM;


#
# Table structure for table 'xoops_xmail_aux_send_l'
#

CREATE TABLE xmail_aux_send_l (
  lote_solicit int(11) unsigned NOT NULL default '0' ,
  id_men int(5) NOT NULL default '0' ,
  user_logado mediumint(11) default NULL ,
  dt_solicit int(11) default NULL ,
  email_conf varchar(60) default NULL ,
  mail_fromname varchar(60) default NULL ,
  mail_fromemail varchar(60) default NULL ,
  mail_send_to varchar(20) default NULL ,
  is_new tinyint(1) default 0 ,
  dt_agenda int(10) default 0 ,
  UNIQUE KEY lote_solicit (lote_solicit),
  UNIQUE KEY user_logado (user_logado,lote_solicit)
) TYPE=MyISAM;

#
# Table structure for table 'xoops_xmail_newsletter'
#

CREATE TABLE xmail_newsletter (
  user_id int(8) unsigned NOT NULL auto_increment,
  user_name varchar(60) default NULL,
  user_nick varchar(25) default NULL,
  user_email varchar(60) NOT NULL default '0' ,
  user_conf varchar(120) default NULL,
  confirmed tinyint(1) default '0',
  user_time datetime default NULL,
  user_host varchar(120) default NULL,
  PRIMARY KEY  (user_id),
  UNIQUE KEY luser_email (user_email)
) TYPE=MyISAM;


CREATE TABLE xmail_perfil_news (
  user_id int(8) unsigned NOT NULL default '0',
  id_perf int(5) unsigned default NULL ,
  UNIQUE KEY user_e_id (id_perf,user_id),
  KEY user_id (user_id)
) TYPE=MyISAM;



CREATE TABLE xmail_tabperfil (
  id_perf int(5) NOT NULL auto_increment,
  descri_perf varchar(60) default NULL,
  system tinyint(1) unsigned default '0',
  PRIMARY KEY  (id_perf)
) TYPE=MyISAM;


INSERT INTO xmail_tabperfil VALUES('1', 'Geral',0);



