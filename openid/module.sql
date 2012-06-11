# sql file for openid module

CREATE TABLE `openid` (
   `openid_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
   `openid_provider_name` varchar(30) NOT NULL default '',
   `openid_provider_account_name` varchar(50) NOT NULL default '',
   `openid_url` varchar(200) NOT NULL default '',
   PRIMARY KEY ( `openid_id` )
);


#Table for OpenID settings.
CREATE TABLE `openid_settings` (
  `property_name` varchar(40) NOT NULL ,
  `property_value` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`property_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#Google settings
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_ENABLED','enable');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_APIKEY','');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_MODE','checkid_setup');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_MAX_AUTH_AGE','60');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_UI_MODE','x-has-session');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_UI_ICON','true');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_QUERY_COUNTRY','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_QUERY_LANGUAGE','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_REQUEST_OAUTH','false');
INSERT INTO `openid_settings` VALUES ('OPENID_GOOGLE_OAUTH_CONSUMER_KEY','');

#FB settings.
INSERT INTO `openid_settings` VALUES ('OPENID_FB_ENABLED','disable');
INSERT INTO `openid_settings` VALUES ('OPENID_FB_APIKEY','');

#Twitter settings.
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_ENABLED','disable');
INSERT INTO `openid_settings` VALUES ('OPENID_TWITTER_APIKEY','');


#Language texts.
INSERT INTO `language_text` VALUES ('en', '_module','openid','OpenID',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','openid_text','ATutor module to enable users to register and log in to the ATutor account without much pain',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_template','openid_login','OpenID Login',NOW(),'global openid login label');
INSERT INTO `language_text` VALUES ('en', '_template','openid_settings','OpenID Settings',NOW(),'global openid settings label');


#Error and warnings.
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_USER_CANCELLED_REQUEST','User has cancelled the authentication. Click "Allow" to grant access.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_EXCEPTION_OCCURED','Fatal exception occured. Please Contact your site admin.<br/><br/>Error Message: %s<br/>Error Code: %s ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OPENID_LOGIN_SUCCESS','Successfully loged in with OpenID.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_INVALID_LOGIN','<b>Invalid request!!</b> Use valid OpenID credentials.',NOW(),'');


