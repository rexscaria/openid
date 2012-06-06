<?php

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/openid/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<div class="openid_input-form" id="opnid_wraper">
	<p id="openid_text">Login to ATutor with any of these accounts.</p>
<div id="openid_vertical_divider">
	<div id="openid_indicator_arrow"></div>
	<div id="openid_login-btns-wrapper">
		<fieldset>
			<span style="padding-left: 20px;">Click to login</span>
		</fieldset>
		   	
			<li><a href="mods/openid/google_login/login.php?login&openid_provider=google" class="openid_one-click-login openid_social_label" id="openid_google">Login with Google</a></li>
			<li><a href="mods/openid/facebook_login" class="openid_one-click-login openid_social_label" id="openid_facebook">Login with Facebook</a></li>
			<li><a href="mods/openid/twitter_login" class="openid_one-click-login openid_social_label" id="openid_twitter">Login with Twitter</a></li>
		  
	</div>
</div>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>
