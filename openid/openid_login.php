<?php
/* * ******************************************************************** */
/* ATutor							          */
/* * ******************************************************************** */
/* Copyright (c) 2002-2012                                                */
/* Inclusive Design Institute	                                          */
/* http://atutor.ca                                                       */
/*                                      			          */
/* This program is free software. You can redistribute it and/or          */
/* modify it under the terms of the GNU General Public License            */
/* as published by the Free Software Foundation.                          */
/* * ******************************************************************** */
//$Id: openid_login.php UTF-8 10055 Jun 13, 2012 7:08:49 PM Author:scari   $

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');

require ('openid.vitals.inc.php');
#Unset the session first.
unsetSession($db);

$_custom_css = $_base_path . 'mods/openid/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<div class="openid_input-form" id="opnid_wraper">   
	<p id="openid_text"></p>
<div id="openid_vertical_divider">
	<div id="openid_indicator_arrow"></div>
        <?php 
            #Disable openid if master list is enabled.
            if (defined('AT_MASTER_LIST') && AT_MASTER_LIST) {
        ?> 
            <p id="openid_content_text" style="margin-top: 50px; width: 90%;">The masterlist is enabled. OpenID module can't work properly with masterlist. 
                Contact the admin to disable this functionality at <a href="admin/config_edit.php">System Preferences</a>.
            </p>
        <?php
            }else{
        ?>
	<div id="openid_login-btns-wrapper">
		<fieldset>
			<span style="padding-left: 20px;">Click to login</span>
		</fieldset>
		   	
			<?php 
                              if($_openid_config['OPENID_GOOGLE_ENABLED'] == 'true')  
                                    echo '<li><a href="mods/openid/google_login/login.php?login=true&openid_provider=google" class="openid_one-click-login openid_social_label" id="openid_google">Login with Google</a></li>'; 
                              if($_openid_config['OPENID_FB_ENABLED'] == 'true') 
                                    echo '<li><a href="mods/openid/facebook_login" class="openid_one-click-login openid_social_label" id="openid_facebook">Login with Facebook</a></li>';
                              if($_openid_config['OPENID_TWITTER_ENABLED'] == 'true') 
                                    echo '<li><a href="mods/openid/twitter_login" class="openid_one-click-login openid_social_label" id="openid_twitter">Login with Twitter</a></li>'; 
                        ?>
		  
	</div>
        <?php } ?>
</div>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>                                                                                                                                                                                                                                  
