* $Id: readme.txt
* Module: XMAIL
* Version: v2.0
* Release Date: 18 Março 2005
* Author: Claudia Antonini Vitiello Callegari Gilberto G. de Oliveira (Giba) claudia@foxbrasil.com.br
* Credits: Xoopstotal Team.
* License: GNU
*/

/*
- Xmail is a module 100% made and based upon xoops kernel.
- Smarty is required.
- Your xoops kernel CVS needs to be at least 2.0.5.
- Be sure to thrust the groups you make this mod available to.
*/


Module Capabilities:

- Allows saving messages on the database for later sending.
Accepts html, smiles, photos and special codes:
{X_UID} will return member ID
{X_UNAME} will return member name
{X_UEMAIL} will return members email

- Sending emails, sending personal messages, and whatever is selected on the member’s profile.
, establishing criteria such as:
only one user or several users selected,
only one group or several groups selected,
last login was after (Format yyyy-mm-dd, optional),
last login was before (Format yyyy-mm-dd, optional) ,
last login was more then X days ago (optional),
last login was less then X days ago (optional),
Send mail only to users that accept notification (optional)
Send mail only to inactive members (optional)
If item selected, all messages (including private ones) will be ignored
Registration date is after (Format yyyy-mm-dd, optional),
Registration date is before (Format yyyy-mm-dd, optional)


- Logs sent messages, recording the user who receives them and when he receives it.
This is important to keep trace off what messages were delivered.

- Allows complete visualization of the log or selection of message and user groups.
Module supervisor can view the entire log.
Module user can view his messages (sent and received).


- IMPORTANT: This module respects the user’s option of receiving or not mail notifications. 
If the user does not have this option active, we will not receive any email.
If within the module you activate the option not to check for the previously referred notification, the message 

will be forwarded to the Inbox of the user as a private message in case any one tries to mail him.
Doing so, you wont be violating SPAM rules.


And what can the average user do ??

Submit a message for approval. ( The webmaster will receive an email to approve it)
However, if you optimize the module for auto-approval, the message sending will not require Webmaster or Supervisor 

acceptation.
Send a message after it has been approved.
See the Sent Log.
Change (when not sent or not approved) and delete his sent messages.

What can the Admin do ?
Everything the user can plus...
Send messages that are automatically approved.
Administrate Messages:
Change ( if not yet sent )
Delete ( if sent, will verify parameters ref. Delete message, after x days sent )
Approve ( the user that sent it, will receive a 'message approved' email )
Disapprove ( will deactivate the msg, thus not sending it)

In administration - Change parameters .

There are 12 parameters:

Delete msg after X days sent :
(Within the admin panel, trying to delete a message sent no more then X days ago will not work.)

How many messages can be sent each time :
(To prevent server overload, you can easily set how many messages can be sent at each time.
Example: If you choose 50, you then select a group of 200 users.
After 50 messages have been sent, a form will be displayed requesting your authorization for the remaining 

150. )


Message Sorting Options:
Title
Code
Sent Date (decreasing)
Sent Date (increasing)


Page Limit:
How many messages you wish to display in Administrate messages
and sent Log.

Auto-Approve :
Choose either Yes or NO, depending on whether you want (or not) to auto-approve every single message.
Watch-Out !! Be sure to really need this service if you choose 'Yes'.


Folder to upload file attachments to:
Default : XOOPS_URL/modules/xmail/upload
Folders will be created inside this 'upload' directory, named after the login of the user, on which each user can 

upload the files to be sent with the message.

File types allowed for attachments.

Maximum file size in bytes.

Date Format, based on the php function date.
To display registration date and last sent.

Whether to allow or not file attachments.

Permission setting for the 'upload' directory, (windows OS don't need this).
Default: 0774

Respect the user´s option of receiving or not mail notifications
If 'Yes' and the user doesn't want to receive email, no message will be sent.
If 'No' and the user doesn't want to receive email, a personal message will be sent.


How do the attachments work ?
Will only accept attach. if that option is active.
The process of indexing a file will be done in the 'change' option, where there will be a form for the upload.
After uploading, the file will be auto-annexed with the email, although you can still remove it.
The user will be presented with a list of other uploaded files that can be indexed to his own message.
The above can be done only if the message hasn't been sent yet and hasn't been authorized yet.

Where will the uploaded attach files be ?
They will be stored in the directory set before, on which each user will have its own folder, named after their login.
If the file isn't being used on another message, it will be deleted when you delete the message.


What to do after Install ?

Go to administration and work on the settings.

Which Xoops version do i need to run ?

Xoops must be version 2.05 or higher.
Be sure to check whether your xoops version 2.05 is stable, following the step below:
Go to line 342 in file <path_do_xoops>/class/criteria.php
If that line looks like this:

if ( is_numeric($this->value) ) { // || strtoupper($this->operator) == 'IN') ???

Change it to:

if ( is_numeric($this->value) || strtoupper($this->operator) == 'IN') {


What if you forget to check for it?
In the send email option, when you select one or two groups, you will always receive the 'no user selected' message.



For those upgrading their version ...

I think you all know this, but besides the file substitution, you need to go to administrator and update the module.
Some template changes will only be seen if you do so.

Some unnecessary files where deleted, so you should consider deleting and installing, rather then just upgrading.
IMPORTANT:

To upgrade, besides doing the above, you must run the script:
<xoops_url>/modules/xmail/upgrade1.0X_to_1.0Y.php to do the database changes.
Obs. X is current version
Y is new version
Example: upgrade1.08_to_1.09.php


From version 1.10, to bring up to date the module, after to execute the normal procedures of 
xoops, script must be executed < xoops_url>/modules/xmail/upgrade.php, in which was implemented 
a project of update of the data base using itself xml.

XOOPERS Brazil team would appreciate your feedback.
Pay us a visit at http://www.xoopstotal.com.br , http://www.xoopers.com.br


//---------Implementations for version 2.0

Procedures updating from version 1.10 to 2.0 :

- Copy all file to xmail directory.
- Update the module in Administration.
- Important: run the script http://seusite/xoops/modules/xmail/upgrade1.10_to_2.0.php
to update the tables.
Check if the folder ../xmail/upload has write permissions (chmod 774).

Look the Implementations below.


- Block for account activation request.
(For users the signed up and don’t received the account activation e-mail.
Every activation request will be logged, and the administrator can check it.)

- Block for subscribe or unsubscribe newsletter.
(Here is not necessary be a registered user, just inform your email and if you desire, your profile. But your profile only will be showed if you choose it in the parameters.
The subscriber will receive an email confirmation, avoiding incorrect emails and ensuring the veracity of the solicitation.


New options in main menu:

- Pending Batches
Exclude or restart pending batches.
(When start sending emails or newsletter, and for some reason it doesn’t conclude, will be created control batches to allow user to continue the process.
The administrador will be able to view all pending batch from any user.
The users will be able to see just their own batches.)

- Send Newsletter
Send Newsletter for subscribers.
(If profile scheme is selected in parameters, a list of registered profiles will be showed for selective sending.
You are able to send to all users or choose various profiles or only send to subscribers that don’t selected any profile.

- Log of Newsletters
Consult sent newsletters.


New Options in parameters: 

- Allow Visual Editor? YES or NOT

- Select Visual Editor, spaw, fck, htmlarea, Koivi or tynymce
if you desire.
Editor’s classes must be in XOOPS kernel.

- Want to use profile schemes in newsletter? YES or NOT

--------------------

New options in administration area:

- Manage Activation
( The administrator will see not activated accounts e how many times tried to activate it.
It’s possible to delete or activate an account.)

- Manage Newsletter
- Details of subscribers
(Show the list of subscribers, where administrator will be able to delete it.)

- Optimize BD

- Import Users to subscribers list
(Import XOOPS users to the newsletter subscribers list)

- Manage Table of Profiles
(Include or exclude profile, that subscriber will use when subscribing.
Examples: Male Sex, Female Sex, Age from 12 to 20 years, Age from 21 to 29 years,
Interest in Hardware, Interest in PHP...
The profile list is individual according to site characteristics.

---------------------------------------------------------------------------
For visual editor use, after selecting it in parameters area, it’s necessari download the package of xoopseditor and put it in the directory <xoops_main_folder>/class/
That version of xmail has the xoopseditor packet.
Copy the folder xoopseditor to <xoops_main_folder>/class/ . 

Editors available in the packet : SPAW Editor - FCKeditor - HtmlArea Editor - XK_Editor (koivi)
FCKeditor e XK_Editor (koivi) are compatible with Firefox.

To download the current XoopsEditor Framework check the link below:
http://dev.xoops.org/modules/xfmod/project/showfiles.php?group_id=1155

----------------------------------------------------------------------------
In the message form, for a better view, there's a frankblack suggestion from http://myxoops.org:

Copy the file located in root folder of ...xmail/themeformflat.php to .../<xoops-dir>/class/xoopsformloader.php and include at end of file the following line:

include_once XOOPS_ROOT_PATH."/class/xoopsform/themeformflat.php";

That is! This procedure will make the message form show one table with a single column, showing the title above and the field below.
----------------------------------------------------------------------------
