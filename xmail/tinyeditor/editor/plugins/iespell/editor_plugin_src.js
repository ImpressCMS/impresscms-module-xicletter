tinyMCE.importPluginLanguagePack('iespell');

var TinyMCE_IESpellPlugin = {
	getInfo : function() {
		return {
			longname : 'IESpell (MSIE Only)',
			author : 'Moxiecode Systems AB',
			authorurl : 'http://tinymce.moxiecode.com',
			infourl : 'http://tinymce.moxiecode.com/tinymce/docs/plugin_iespell.html',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	},

	getControlHTML : function(cn) {
		if (cn == "iespell" && (tinyMCE.isMSIE && !tinyMCE.isOpera))
			return tinyMCE.getButtonHTML(cn, 'lang_iespell_desc', '{$pluginurl}/images/iespell.gif', 'mceIESpell');

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {

		if (command == "mceIESpell") {
			try {
				var ieSpell = new ActiveXObject("ieSpell.ieSpellExtension");
				ieSpell.CheckDocumentNode(tinyMCE.getInstanceById(editor_id).contentDocument.documentElement);
			} catch (e) {
				if (e.number == -2146827859) {
					if (confirm(tinyMCE.getLang("lang_iespell_download", "", true)))
						window.open('http://www.iespell.com/download.php', 'ieSpellDownload', '');
				} else
					alert("Error Loading ieSpell: Exception " + e.number);
			}

			return true;
		}

		return false;
	}
};

tinyMCE.addPlugin("iespell", TinyMCE_IESpellPlugin);