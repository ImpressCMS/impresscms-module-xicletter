<?php
####################################################################################################
## Sample update module in use
####################################################################################################
include 'admin_header.php';

$myurl = XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=" . $xoopsModule->getVar('dirname');

redirect_header($myurl,'0','');

xoops_cp_footer();
?>
