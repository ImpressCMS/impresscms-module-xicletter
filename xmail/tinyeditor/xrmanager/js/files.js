/**
 * Functions for the image listing, used by files.php only
 * @author $Author: frankblacksf $
 * @version $Id: files.js,v 1.1 2006/04/08 14:37:31 frankblacksf Exp $
 * @package ImageManager
 */

        function i18n(str) {
                if(I18N)
                  return (I18N[str] || str);
                else
                        return str;
        };

	        function changeDir(newDir, msgText)
        {
                showMessage(msgText);
                location.href = "files.php?dir="+newDir;
        }


        function newFolder(dir, newDir)
        {
                location.href = "../files.php?dir="+dir+"&newDir="+newDir;
        }

		// Copy or move a file
		// Added by ralf57
		function copyFile(fileUrl, keep)
        {
				var selection = window.top.document.getElementById('dirPath');
                var dir = selection.options[selection.selectedIndex].value;
				var url = fileUrl;

                Dialog("tools/dirselect.php", function(param)
                {
                        if (!param) // user must have pressed Cancel
								return false;
                        else
                        {
                                var destfolder = param['f_foldername'];

                                if (destfolder && destfolder != '')
								{
									var destdir = encodeURI(destfolder);

									if (keep) {
										var action = "keeporig";
									} else {
										var action = "delorig";
									}

									location.href = "../files.php?dir="+dir+"&file="+url+"&destDir="+destdir+"&fileaction="+action;
								}
                        }
                }, null);
        }

		// Rename file
		// Added by ralf57
		function renameFile(fileUrl)
        {
				var selection = window.top.document.getElementById('dirPath');
                var dir = selection.options[selection.selectedIndex].value;
				var url = fileUrl;

                Dialog("tools/newFolder.php", function(param)
                {
                        if (!param) // user must have pressed Cancel
								return false;
                        else
                        {
                                var newname = param['f_foldername'];

                                if (newname && newname != '')
								{
									location.href = "../files.php?dir="+dir+"&file="+url+"&newname="+newname;
								}
                        }
                }, null);
        }

		// Copy or move a directory
		// Added by ralf57
		function copyFolder(foldPath, keep)
        {
				var selection = window.top.document.getElementById('dirPath');
                var dir = selection.options[selection.selectedIndex].value;
				var path = foldPath;

                Dialog("tools/dirselect.php", function(param)
                {
                        if (!param) // user must have pressed Cancel
								return false;
                        else
                        {
                                var destfolder = param['f_foldername'];

                                if (destfolder && destfolder != '')
								{
									var destdir = encodeURI(destfolder);

									if (keep) {
										var action = "keeporig";
									} else {
										var action = "delorig";
									}
									//alert(dir);
									location.href = "../files.php?dir="+dir+"&folder="+path+"&destDir="+destdir+"&foldaction="+action;
								}
                        }
                }, null);
        }

		// Rename a folder
		// Added by ralf57
		function renameFolder(foldPath)
        {
				var selection = window.top.document.getElementById('dirPath');
                var dir = selection.options[selection.selectedIndex].value;
				var path = foldPath;

                Dialog("tools/newFolder.php", function(param)
                {
                        if (!param) // user must have pressed Cancel
								return false;
                        else
                        {
                                var newname = param['f_foldername'];

                                if (newname && newname != '')
								{
									location.href = "../files.php?dir="+dir+"&folder="+path+"&newname="+newname;
								}
                        }
                }, null);
        }

        //update the dir list in the parent window.
        function updateDir(newDir, msgText)
        {
                var selection = window.top.document.getElementById('dirPath');
                if(selection)
                {
                        for(var i = 0; i < selection.length; i++)
                        {
                                var thisDir = selection.options[i].text;
                                if(thisDir == newDir)
                                {
                                        selection.selectedIndex = i;
                                        showMessage(msgText);
                                        break;
                                }
                        }
                }
        }

		//Modified by ralf57 for TinyEditor
		function insertFile(fileUrl)
		{
			//fileUrl=unescape(fileUrl);
			window.top.opener.fileBrowserReturn(fileUrl);
			window.top.close() ;
			window.top.opener.focus() ;
		}

        function showMessage(newMessage)
        {
                var topDoc = window.top.document;

                var message = topDoc.getElementById('message');
                var messages = topDoc.getElementById('messages');
                if(message && messages)
                {
                        if(message.firstChild)
                                message.removeChild(message.firstChild);

                        message.appendChild(topDoc.createTextNode(i18n(newMessage)));

                        messages.style.display = "block";
                }
        }

        function addEvent(obj, evType, fn)
        {
                if (obj.addEventListener) { obj.addEventListener(evType, fn, true); return true; }
                else if (obj.attachEvent) {  var r = obj.attachEvent("on"+evType, fn);  return r;  }
                else {  return false; }
        }

        function confirmDeleteFile(file)
        {
                if(confirm(i18n("Delete file?")))
                        return true;

                return false;
        }

        function confirmDeleteDir(dir_alert, prompt_text, confirm_text)
        {
		//alert(confirm);
                if(dir_alert == 1)
                {
                        alert(i18n(prompt_text));
                        return;
                }

                if(confirm(i18n(confirm_text)))
                        return true;

                return false;
        }

        addEvent(window, 'load', init);
