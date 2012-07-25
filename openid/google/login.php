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
//$Id: login.php UTF-8 10055 Jun 13, 2012 7:08:49 PM   Author:scari        $

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
#importing required files
require_once  ('libs/google_openid_consts.php');
require_once  ('libs/openid_utility.php');
require_once  ('../openid.vitals.inc.php');

#callback URL
define('CALLBACK_URL',"http://".$_SERVER['SERVER_NAME'].AT_BASE_HREF."mods/openid/login.php" );
define('GOOGLE_IDENTITY_URL','https://www.google.com/accounts/o8/id');
define('OPENID_LOGIN_PAGE_URL',AT_BASE_HREF.'mods/openid/openid_login.php');
define('OPENID_MOD_DIR', AT_BASE_HREF.'mods/openid/');
define('OPENID_PROVIDER','GOOGLE');

#Disable openid if master list is enabled.
if (defined('AT_MASTER_LIST') && AT_MASTER_LIST) {
    $msg->addError('OPENID_MASTERLIST_ENABLED');
    header('Location: '.AT_BASE_HREF.'login.php');
    exit;
}

    try{
        
        #Create OpenID Utility object
        $openid = new OpenIDUtility;        
        if (isset($_GET['login'], $_GET['openid_provider']) && $_GET['login']=='true' && 
            $_GET['openid_provider'] == 'google' &&
            !$openid->mode) {
                  #Set Google indentity URL
                  $openid->identity = GOOGLE_IDENTITY_URL;
                  #setting call back url
                  //$openid->returnUrl = CALLBACK_URL;
                  #Select openid mode as 'checkid_setup'
                  $immediate_mode = ($_openid_config['OPENID_GOOGLE_MODE'] == 'checkid_immediate')?  true : false;
                  #Set the required ax params.
                  $openid->required = array(
                        'email'       =>   'contact/email',
                        'firstname'   =>   'namePerson/first',
                        'lastname'    =>   'namePerson/last',
                      /*'country'     =>   'contact/country/home',
                        'language'    =>   'pref/language'*/
                      );
                  
                  #Should we query the country.
                  if($_openid_config['OPENID_GOOGLE_QUERY_COUNTRY']=='true'){
                      $openid->required['country'] = 'contact/country/home';
                  }
                  
                  #Or lanugage?
                  if($_openid_config['OPENID_GOOGLE_QUERY_LANGUAGE']=='true'){
                      $openid->required['country'] = 'pref/language';
                  }
                                
                  #Set UI params
                  if($_openid_config['OPENID_GOOGLE_ENABLE_UI_MODE'] != 'false'){
                       $openid->use_ui = true;
                       $openid->display_favicon = $_openid_config['OPENID_GOOGLE_UI_ICON'];
                       $openid->ui_mode= $_openid_config['OPENID_GOOGLE_UI_MODE'];
                  }else
                      $openid->use_ui = false;
                 
                                
                  #Set pape params
                  if($_openid_config['OPENID_GOOGLE_ENABLE_PAPE'] == 'true'){
                      $openid->use_pape = true;
                      $openid->max_auth_age = $_openid_config['OPENID_GOOGLE_MAX_AUTH_AGE'];
                  }else
                      $openid->use_pape = false;
                  
                  /*
                   * 
                   * The OAuth is inactive now. But may active in future.
                   */
                  #Set ext2(OAuth 2.0) params
                  $oauth_str = '';
                  if($_openid_config['OPENID_GOOGLE_REQUEST_OAUTH'] == 'true' 
                          && $_openid_config['OPENID_GOOGLE_OAUTH_CONSUMER_KEY'] != ''){
                      #TODO: Add scope.
                      $scopes = array(
                          OAUTH_SCOPE_GOOGLE_YOUTUBE,
			  OAUTH_SCOPE_GOOGLE_DOCS,
		 	  OAUTH_SCOPE_GOOGLE_CALENDAR,                         
                      );
                      $oauth_str = $openid->createOAuthURL($scopes, $_openid_config['OPENID_GOOGLE_OAUTH_CONSUMER_KEY']);
                  }
                                
                  /*
                  * Now everything is set. Find the end point with OpenID
                  * discovery and redirect to the authentication url,
                  */
                  
                  header('Location: ' . $openid->authUrl($immediate_mode) .$oauth_str);
                  exit;
         }else if($openid->mode=='cancel'){
            
            #TODO: Should `cancel` be considered as failed login attempt?
            $msg->addError('OPENID_USER_CANCELLED_REQUEST');
            header('Location: ' .OPENID_LOGIN_PAGE_URL);
            exit;
            
         }else{
             #Google has granted the details. Now, Validate the details before applying it.
             $is_valid = $openid->validate();
             if($is_valid){
                 $attr = $openid->getAttributes();
                 $openid_email    = isset($attr['contact/email'])?$attr['contact/email']:NULL;
                 $openid_fname    = isset($attr['namePerson/first'])?$attr['namePerson/first']:NULL;
                 $openid_lname    = isset($attr['namePerson/last'])?$attr['namePerson/last']:NULL;
                 $openid_language = isset($attr['pref/language'])?$attr['pref/language']:NULL;
                 $openid_country  = isset($attr['contact/country/home'])?$attr['contact/country/home']:NULL;
                 
                 #Can we continue without mail? . No, we can't
                if(empty($openid_email) && !filter_var($openid_email, FILTER_VALIDATE_EMAIL))
                    throw ErrorException("Failed to retrieve valid e-mail address from OpenID provider.");
        
                 
                 if(isset($openid_country))
                     $openid_country = $_openid_countries[$openid_country];
                 
                 if(isset($openid_email) && isset($openid_fname) && isset($openid_lname))
                     throw ErrorException("Failed to retrieve required attributes from OpenID provider.");
                 
                 $default_course_id = 0;
                 #Check whether user exists in db
                 $result = mysql_query("SELECT member_id, login, status, preferences, language, last_login FROM ".TABLE_PREFIX."members WHERE email='$openid_email'",$db);
                 if(!$result){
                     throw ErrorException('Invalid MySQL query : '. mysql_error(),  mysql_errno());
                 }
                 
                 if(mysql_num_rows($result)==0){
                     #Email doesn't exist in DB. Register the user.
                     registerAndLoginWithOpenID($openid, $openid_fname, $openid_lname, $openid_email, $openid_country, NULL);                     
                     header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
                     exit;
                 }else{
                     #User has already registered. It's time to login.
                     makeLoginWithOpenID( $result, $openid);
                     header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
                     exit;
                 }
                 
                 #User has failed to login. Unset the session.
                 unsetSession($db); 
                 
             }else{
                 
                 #User has failed to login. Unset the session.
                 unsetSession($db); 
                 
                 #invalid credentials are detected.
                 $msg->addError('OPENID_INVALID_LOGIN');
                 header('Location: ' .AT_BASE_HREF.'mods/openid/openid_login.php');
                 exit;
             }
         }
    }catch (Exception $e){
 
       #User has failed to login. Unset the session.
       unsetSession($db); 
       
       $msg->addError(array('OPENID_EXCEPTION_OCCURED',$e->getMessage(),$e->getCode()));
       header('Location: ' .AT_BASE_HREF.'mods/openid/openid_login.php');
       exit;
    }


?>


