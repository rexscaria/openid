# sql file for openid module

CREATE TABLE openid (
   `opnid_id` mediumint(8) unsigned NOT NULL AUTO INCREMENT,
   `openid_provider_name` VARCHAR( 30 ) NOT NULL ,
   `openid_provider_account_name` VARCHAR(50) NOT NULL,
   `openid_url` VARCHAR(200) NOT NULL,
   PRIMARY KEY ( `course_id` )
);

INSERT INTO `language_text` VALUES ('en', '_module','openid','OpenID',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','openid_text','ATutor module to enable users to register and log in to the ATutor account without much pain',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_USER_CANCELLED_REQUEST','User has cancelled the authentication. Click "Allow" to grant access.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OPENID_EXCEPTION_OCCURED','Fatal exception occured. Please Contact your site admin.<br/><br/>Error Message: %s<br/>Error Code: %s ',NOW(),'');
