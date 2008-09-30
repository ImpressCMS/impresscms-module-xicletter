/**
 * Functions for the ImageManager, used by manager.php only
 * Modifications for TinyMCE - Ryan Demmer
 *@author $Author: frankblacksf $
 * @version $Id: manager.js,v 1.1 2006/04/08 14:37:31 frankblacksf Exp $
 * @package ImageManager
 */


        function myRegexpReplace(in_str, reg_exp, replace_str, opts) {
        if (typeof opts == "undefined")
            opts = 'g';
        var re = new RegExp(reg_exp, opts);
        return in_str.replace(re, replace_str);
        }

        //initialise the form
        //Added modifications for TinyMCE - Ryan Demmer
        init = function ()
        {
                var arrOnOver = new Array(), arrOnOut  = new Array();
                var strOnOver = "", strOnOut  = "";
                var formObj = document.forms[0];
                var uploadForm = document.getElementById('uploadForm');
                if(uploadForm) uploadForm.target = 'imgManager';

                window.focus();
        }

        function MM_findObj(n, d) { //v4.01
                  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
                  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
                  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
                  if(!x && d.getElementById) x=d.getElementById(n); return x;
                }

        //similar to the Files::makeFile() in Files.php
        function makeURL(pathA, pathB)
        {
                if(pathA.substring(pathA.length-1) != '/')
                        pathA += '/';

                if(pathB.charAt(0) == '/');
                        pathB = pathB.substring(1);

                return pathA+pathB;
        }


        function updateDir(selection, msgText)
        {
                var newDir = selection.options[selection.selectedIndex].value;
                changeDir(newDir, msgText);
        }

        function goUpDir(msgText)
        {
                var selection = document.getElementById('dirPath');
                var currentDir = selection.options[selection.selectedIndex].text;
                if(currentDir.length < 2)
                        return false;
                var dirs = currentDir.split('/');

                var search = '';

                for(var i = 0; i < dirs.length - 2; i++)
                {
                        search += dirs[i]+'/';
                }

                for(var i = 0; i < selection.length; i++)
                {
                        var thisDir = selection.options[i].text;
                        if(thisDir == search)
                        {
                                selection.selectedIndex = i;
                                var newDir = selection.options[i].value;
                                changeDir(newDir, msgText);
                                break;
                        }
                }
        }

        function changeDir(newDir, msgText)
        {
                if(typeof imgManager != 'undefined')
                        imgManager.changeDir(newDir, msgText);
        }

        function showMessage(newMessage)
        {
                var message = document.getElementById('message');
                var messages = document.getElementById('messages');
                if(message.firstChild)
                        message.removeChild(message.firstChild);

                message.appendChild(document.createTextNode(newMessage));

                messages.style.display = "block";
        }

        function addEvent(obj, evType, fn)
        {
                if (obj.addEventListener) { obj.addEventListener(evType, fn, true); return true; }
                else if (obj.attachEvent) {  var r = obj.attachEvent("on"+evType, fn);  return r;  }
                else {  return false; }
        }

        function doUpload(text)
        {
                var uploadForm = document.getElementById('uploadForm');
                if(uploadForm)
                        showMessage(text);        
        }

        function refresh()
        {
                var selection = document.getElementById('dirPath');
                updateDir(selection);
        }


        function newFolder()
        {
                var selection = document.getElementById('dirPath');
                var dir = selection.options[selection.selectedIndex].value;

                Dialog("tools/newFolder.php", function(param)
                {
                        if (!param) // user must have pressed Cancel
                                return false;
                        else
                        {
                                var folder = param['f_foldername'];
                                if(folder == thumbdir)
                                {
                                        alert('Invalid folder name, please choose another folder name.');
                                        return false;
                                }

                                if (folder && folder != '' && typeof imgManager != 'undefined')
                                        imgManager.newFolder(dir, encodeURI(folder));
                        }
                }, null);
        }

        addEvent(window, 'load', init);
