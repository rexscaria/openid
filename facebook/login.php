<?php

/* * ******************************************************************** */
/* ATutor							       */
/* * ******************************************************************** */
/* Copyright (c) 2002-2012                                             */
/* Inclusive Design Institute	                                       */
/* http://atutor.ca                                                    */
/*                                      			       */
/* This program is free software. You can redistribute it and/or       */
/* modify it under the terms of the GNU General Public License         */
/* as published by the Free Software Foundation.		       */
/* * ******************************************************************** */
// $Id: login.PHP UTF-8 10055 Jul 20, 2012 6:19:37 PM Author:scari  $

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
#importing required files
require_once  ('libs/base_facebook.php');
require_once  ('libs/facebook.php');
require_once  ('../openid.vitals.inc.php');

define('OPENID_LOGIN_PAGE_URL',AT_BASE_HREF.'mods/openid/openid_login.php');
define('OPENID_MOD_DIR', AT_BASE_HREF.'mods/openid/');
define('OPENID_PROVIDER','FACEBOOK');

#Disable openid if master list is enabled.
if (defined('AT_MASTER_LIST') && AT_MASTER_LIST) {
    $msg->addError('OPENID_MASTERLIST_ENABLED');
    header('Location: '.AT_BASE_HREF.'login.php');
    exit;
}

try{

    $facebook = new Facebook(array(
            'appId' => $_openid_config['OPENID_FB_APP_CONSUMER_KEY'],
            'secret' => $_openid_config['OPENID_FB_APP_CONSUMER_SECRET'],
            ));

    $user = $facebook->getUser();

    if ($user) {
        #Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');

        if (!empty($user_profile )) {
            
            # User info ok.
            $openid_username = $user_profile['username'];
            $openid_email    = $user_profile['email'];
            $openid_fname    = $user_profile['first_name'];
            $openid_lname    = $user_profile['last_name'];
            $openid_country  = (isset($user_profile['location'])? $user_profile['location']['name']:NULL);
        
            #Can we continue without mail? . No, we can't, if it is invalid.
            if(!filter_var($openid_email, FILTER_VALIDATE_EMAIL))
                throw new Exception(_AT('openid_email_not_valid'));
        
            $default_course_id = 0;
            #Check whether user exists in db
            $result = mysql_query("SELECT member_id, login, status, preferences, language, last_login FROM ".TABLE_PREFIX."members WHERE email='$openid_email'",$db);
            if(!$result){
                throw new Exception(_AT('openid_mysql_error'). mysql_error(),  mysql_errno());
            }
                 
            if(mysql_num_rows($result)==0){
                #Email doesn't exist in DB. Register the user.
                registerAndLoginWithOpenID(NULL, $openid_fname, $openid_lname, $openid_email, $openid_country, $openid_username);                     
                header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
                exit;  
            }else{
                #User has already registered. It's time to login.
                makeLoginWithOpenID( $result, NULL);
                header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
                exit;
            }
                 
            #User has failed to login. Unset the session.
            unsetSession($db);
            $facebook->destroySession();
        
        
        }else{
            #Failed to fetch the user profile and email.
            throw new Exception(_AT('openid_fb_data_failed'));
        }
    
    } else {
        #User has failed to login. Unset the session.
        unsetSession($db); 
        $facebook->destroySession();
    
        # There's no active session, let's generate one
        $login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
        header("Location: " . $login_url);
        exit;
    }
}  catch (FacebookApiException $e){
    #User has failed to login. Unset the session.
    unsetSession($db); 
    $facebook->destroySession();
    
    #Report the FB exception.
    $msg->addError(array('FACEBOOK_EXCEPTION_OCCURED',$e->getType(),  json_encode($e->getResult())));
    header('Location: ' .OPENID_LOGIN_PAGE_URL);
    exit;
} catch (Exception $e){
    #User has failed to login. Unset the session.
    unsetSession($db);
    $facebook->destroySession();
       
    $msg->addError(array('OPENID_EXCEPTION_OCCURED',$e->getMessage(),$e->getCode()));
    header('Location: ' .OPENID_LOGIN_PAGE_URL);
    exit;
}
?>
