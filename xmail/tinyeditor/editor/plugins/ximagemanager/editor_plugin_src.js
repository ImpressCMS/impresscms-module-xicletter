tinyMCE.importPluginLanguagePack('ximagemanager');

var TinyMCE_XimagemanagerPlugin = {
	getInfo : function() {
		return {
			longname : 'XOOPS Imagemanager',
			author : '',
			authorurl : '',
			infourl : '',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case "ximagemanager":
				return tinyMCE.getButtonHTML(cn, 'lang_ximagemanager_title', '{$pluginurl}/images/ximagemanager.gif', 'ximagemanager');
		}

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {

		switch (command) {
			case "ximagemanager":
				var template = new Array();

				template['file'] = '../../plugins/ximagemanager/tinyedimagemanager.php';
				template['width'] = 600;
				template['height'] = 600;

				template['width'] += tinyMCE.getLang('lang_ximagemanager_delta_width', 0);
				template['height'] += tinyMCE.getLang('lang_ximagemanager_delta_height', 0);

				tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes", scrollbars : "yes"});

				return true;
		}
		return false;
	}
};

tinyMCE.addPlugin('ximagemanager', TinyMCE_XimagemanagerPlugin);