CREATE TABLE tinyeditor_toolset (
	tinyed_id int(11) NOT NULL auto_increment,
	tinyed_gid int(11) NOT NULL,
	tinyed_row1 text NOT NULL default '',
	tinyed_row2 text NOT NULL default '',
	tinyed_row3 text NOT NULL default '',
	imgwidth int(4) NOT NULL,
	imgheight int(4) NOT NULL,
	diskquota int(15) NOT NULL,
	activeplugs text NOT NULL default '',
	validelements longtext NOT NULL default '',
	extvalidelements longtext NOT NULL default '',
	invalidelements longtext NOT NULL default '',
  PRIMARY KEY (tinyed_id)
) TYPE=MyISAM;

INSERT INTO tinyeditor_toolset VALUES (1, 1, 'fontselect fontsizeselect formatselect styleselect', 'bold italic underline strikethrough separator justifyleft justifycenter justifyright justifyfull separator cut copy paste bullist numlist indent outdent', 'undo redo separator sub sup forecolor backcolor removeformat separator link unlink anchor image cleanup hr charmap separator visualaid code xquote xcode emotions', '500', '500', '5120000', 'xquotecode emotions', '', '', '');
INSERT INTO tinyeditor_toolset VALUES (2, 2, 'fontselect fontsizeselect formatselect styleselect', 'bold italic underline strikethrough separator justifyleft justifycenter justifyright justifyfull separator cut copy paste bullist numlist indent outdent', 'undo redo separator sub sup forecolor backcolor removeformat separator link unlink anchor image cleanup hr charmap separator visualaid code xquote xcode emotions', '500', '500', '5120000', 'xquotecode emotions', '', '', '');
INSERT INTO tinyeditor_toolset VALUES (3, 3, 'fontselect fontsizeselect formatselect styleselect', 'bold italic underline strikethrough separator justifyleft justifycenter justifyright justifyfull separator cut copy paste bullist numlist indent outdent', 'undo redo separator sub sup forecolor backcolor removeformat separator link unlink anchor image cleanup hr charmap separator visualaid code xquote xcode emotions', '500', '500', '5120000', 'xquotecode emotions', '', '', '');

CREATE TABLE tinyeditor_mimetypes (
	tinymt_id int(11) NOT NULL auto_increment,
	tinymt_gid int(11) NOT NULL,
	tinymt_types text NOT NULL default '',
  PRIMARY KEY (tinymt_id)
) TYPE=MyISAM;

INSERT INTO tinyeditor_mimetypes VALUES (1, 1, 'image/jpeg image/pjpeg image/png image/gif');
INSERT INTO tinyeditor_mimetypes VALUES (2, 2, 'image/jpeg image/pjpeg image/png image/gif');
INSERT INTO tinyeditor_mimetypes VALUES (3, 3, 'image/jpeg image/pjpeg image/png image/gif');

CREATE TABLE tinyeditor_chmods (
	tinychmods_id int(11) NOT NULL auto_increment,
	tinychmods_paths text NOT NULL default '',
  PRIMARY KEY (tinychmods_id)
) TYPE=MyISAM;