/**
 * $RCSfile: editor_plugin.js,v $
 * $Revision: 1.2 $
 * $Date: 2006/07/09 11:23:19 $
 *
 * @author Moxiecode
 * @copyright Copyright ? 2004-2006, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('ximagemanager');

// Plucin static class
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

	/**
	 * Returns the HTML contents of the emotions control.
	 */
	getControlHTML : function(cn) {
		switch (cn) {
			case "ximagemanager":
				return tinyMCE.getButtonHTML(cn, 'lang_ximagemanager_title', '{$pluginurl}/images/ximagemanager.gif', 'ximagemanager');
		}

		return "";
	},

	/**
	 * Executes the mceEmotion command.
	 */
	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			case "ximagemanager":
				var template = new Array();

				template['file'] = '../../plugins/ximagemanager/tinyedimagemanager.php'; // Relative to theme
				template['width'] = 600;
				template['height'] = 600;

				// Language specific width and height addons
				template['width'] += tinyMCE.getLang('lang_ximagemanager_delta_width', 0);
				template['height'] += tinyMCE.getLang('lang_ximagemanager_delta_height', 0);

				tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes", scrollbars : "yes"});

				return true;
		}

		// Pass to next handler in chain
		return false;
	}
};

// Register plugin
tinyMCE.addPlugin('ximagemanager', TinyMCE_XimagemanagerPlugin);
