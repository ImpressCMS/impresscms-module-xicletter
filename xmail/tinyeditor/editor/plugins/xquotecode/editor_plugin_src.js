tinyMCE.importPluginLanguagePack('xquotecode');
var TinyMCE_XquotecodePlugin = {
	getInfo : function() {
		return {
			longname : 'XquoteCode',
			author : '',
			authorurl : '',
			infourl : '',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	},
	getControlHTML : function(cn) {
		switch (cn) {
			case "xquote":
				return tinyMCE.getButtonHTML(cn, 'lang_insert_xquote_desc', '{$pluginurl}/images/xquote.gif', 'mceXquote');
			case "xcode":
				return tinyMCE.getButtonHTML(cn, 'lang_insert_xcode_desc', '{$pluginurl}/images/xcode.gif', 'mceXcode');
		}

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		switch (command) {
			case "mceXquote":
				var template = new Array();

				template['file'] = '../../plugins/xquotecode/xquote.htm';
				template['width'] = 400;
				template['height'] = 300;
				var qtext = "";
				tinyMCE.openWindow(template, {editor_id : editor_id, qtext : qtext, mceDo : 'insert'});

				return true;

			case "mceXcode":
				var template = new Array();

				template['file'] = '../../plugins/xquotecode/xcode.htm'; // Relative to theme
				template['width'] = 400;
				template['height'] = 300;
				var ctext = "";
				tinyMCE.openWindow(template, {editor_id : editor_id, ctext : ctext, mceDo : 'insert'});

				return true;
		}

		return false;
	}
};

tinyMCE.addPlugin('xquotecode', TinyMCE_XquotecodePlugin);