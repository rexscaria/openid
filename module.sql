# sql file for openid module

#Table for OpenID settings.
CREATE TABLE `openid_settings` (
  `property_name` varchar(40) NOT NULL ,
  `property_value` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`property_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#Table for storing Oauth key
CREATE TABLE `openid_oauth_request_token` (
   `member_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
   `openid_provider_name` varchar(30) NOT NULL default '',
   `openid_claimed_id` varchar(200) NOT NULL default '',
   `openid_request_token` varchar(50) NOT NULL default '',
   `openid_login_time` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   PRIMARY KEY ( `member_id`,`openid_provider_name` )
)ENGINE=MyISAM DEFAULT CHARSET=utf8;


#Table for storing twitter id and email id.
CREATE TABLE `openid_twitter_credentials` (
   `twitter_id` varchar(20) NOT NULL,
   `member_id` mediumint(8) unsigned NOT NULL ,
   PRIMARY KEY ( `twitter_id`,`member_id` ) ,
   UNIQUE (`member_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;


#Google settings
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_ENABLED','true');
#INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_OAUTH_CONSUMER_REALM','');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_MODE','checkid_setup');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_ENABLE_PAPE','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_MAX_AUTH_AGE','60');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_ENABLE_UI_MODE','true');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_UI_MODE','x-has-session');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_UI_ICON','true');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_QUERY_COUNTRY','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_QUERY_LANGUAGE','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_REQUEST_OAUTH','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_OAUTH_CONSUMER_KEY','');

#FB settings.
INSERT INTO `openid_settings` VALUES ('OPENID_FB_ENABLED','false');
INSERT INTO `openid_settings` VALUES ('OPENID_FB_APP_CONSUMER_KEY','');
INSERT INTO `openid_settings` VALUES ('OPENID_FB_APP_CONSUMER_SECRET','');

#Twitter settings.
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_ENABLED','false');
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_APP_CONSUMER_KEY','');
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_APP_CONSUMER_SECRET','');
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_CONFIRM_EMAIL_ID','true');


#Language texts.
INSERT INTO `language_text` VALUES ('en', '_module','openid','OpenID',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','openid_text','ATutor module to enable users to register and log in to the ATutor account without much pain',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_template','openid_login','OpenID Login',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings','OpenID Settings',NOW(),'openid');

#OpenID Errors
INSERT INTO `language_text` VALUES ('en', '_template','openid_email_not_valid','Failed to retrieve valid e-mail address from OpenID provider.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_details_not_valid','Failed to retrieve required attributes from OpenID provider.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_mysql_error','Invalid MySQL query : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_permission_denied','Permission denied!',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_try_again','Refresh the page and try again.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_masterlist_enabled','The masterlist is enabled. OpenID module can\'t work properly with masterlist. Contact the admin to disable this functionality at ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_click_to_login','Click to login',NOW(),'openid');

#FB Errors
INSERT INTO `language_text` VALUES ('en', '_template','openid_fb_data_failed','Failed to Facebook fetch profile information.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_login_with_fb','Login with Facebook',NOW(),'openid');

#Twitter Errors
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_request_token_failed','Failed to request token from twitter. Check your internet connectivity.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_auth_failed','Twitter authentication failed With HTTP response -',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_access_token_failed','Failed to access token from twitter.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_user_denied','Failed to fetch user data.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_cached_access_token_failed','Failed to fetch cached access token.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_invalid_email','Invalid e-mail address.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_login_failed','Twitter login failed.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_invalid_access_token','Access token is invalid',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_email_exists','Email exists. Registration failed!!',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_login_with_twitter','Login with Twitter',NOW(),'openid');

#Google Errors
INSERT INTO `language_text` VALUES ('en', '_template','openid_login_with_google','Login with Google',NOW(),'openid');


#OpenID Settings
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings','OpenID Settings',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_sub_heading','Tune your OpenID.',NOW(),'openid');

INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_google','Google OpenID Settings',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_sub_heading','Tune your Google OpenID.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_enable','Enable Google OpenID : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_mode','Google OpenID mode : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_use_pape','Use PAPE : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_max_auth_age','Enable UI Extension : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_enable_ui_extension','Enable UI Extension : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_enable_ui_mode','UI mode : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_enable_ui_icon','Enable UI Icon : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_query_country','Query Country details : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_query_lang','Query Language details : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_use_oauth','Use OAuth(Work with Google Apps module) : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_google_oauth_key','OAuth consumer key : ',NOW(),'openid');


INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_twitter','Twitter OpenID Settings',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_twitter_sub_heading','Tune your Twitter OpenID.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_enable','Enable twitter : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_mail_confirmation','Enable twitter email confirmation : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_recommended','(Recommended)',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_app_key','Twitter app Consumer key : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_twitter_app_secret_key','Twitter app Consumer secret key : ',NOW(),'openid');


INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_fb','Facebook OpenID Settings',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings_fb_sub_heading','Tune your Facebook OpenID.',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_fb_enable','Enable Facebook : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_fb_app_key','Facebook app Consumer key : ',NOW(),'openid');
INSERT INTO `language_text` VALUES ('en', '_template','openid_fb_app_secret_key','Facebook app Consumer secret key : ',NOW(),'openid');


#Error and warnings.
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_USER_CANCELLED_REQUEST','User has cancelled the authentication. Click "Allow" to grant access.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_EXCEPTION_OCCURED','Fatal exception received. Please Contact your site admin.<br/><br/>Error Message: %s<br/>Error Code: %s ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OPENID_LOGIN_SUCCESS','Successfully loged in with OpenID.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_INVALID_LOGIN','<b>Invalid request!!</b> Use valid OpenID credentials.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_USER_NOT_REGITERED','Login failed!',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_MASTERLIST_ENABLED','The masterlist is enabled. OpenID module can\'t work properly with masterlist. To disable this functionality go to <a href="admin/config_edit.php">System Preferences</a>.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_TWITTER_KEY_FAILED','The twitter app keys are failed.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OPENID_SETTINGS_SAVE_SUCCESS','Your OpenID settings are successfully saved.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_SETTINGS_SAVE_FAILED','Failed to save some OpenID settings. Check you settings.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_FACEBOOK_EXCEPTION_OCCURED','Facebook exception received. <br/><br/>Type: %s<br/>Error Result: %s ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OPENID_REG_THANKS_CONFIRM','Thank-you for registering. Please follow the instructions in the email we sent you on how to confirm your account. You will need to confirm your account before you can login.',NOW(),'');

