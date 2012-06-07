<?php

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
#importing required files
require 'openid_utility.php';

#callback URL
define('CALLBACK_URL',"http://".$_SERVER['SERVER_NAME']."/ATutor/mods/openid/google_login/get_googleData.php" );
define('GOOGLE_IDENTITY_URL','https://www.google.com/accounts/o8/id');

    try{
        
        #Create OpenID Utility object
        $openid = new OpenIDUtility;        
        if (isset($_GET['login']) && $_GET['login']=='true' && 
            isset($_GET['openid_provider']) &&  $_GET['openid_provider'] == 'google' &&
            !$openid->mode) {
                  #Set Google indentity URL
                  $openid->identity = GOOGLE_IDENTITY_URL;
                  #For different call back url uncomment the next line.
                  #$openid->returnUrl = CALLBACK_URL;
                  #Select openid mode as 'checkid_setup'
                  $immediate_mode = false;
                  #Set the required ax params.
                  $openid->required = array(
                        'email'       =>   'contact/email',
                        'firstname'   =>   'namePerson/first',
                        'lastname'    =>   'namePerson/last',
                        'country'     =>   'contact/country/home',
                        'language'    =>   'pref/language'
                      );
                                
                  #Set UI params
                  $openid->display_favicon = true;
                  $openid->ui_mode='x-has-session';
                                
                  #Set pape params
                  $openid->pape_enabled = false;
                  $openid->max_auth_age = '60';
                                
                  /*
                  * Now everything is set. Find the end point with OpenID
                  * discovery and redirect to the authentication url,
                  */
                  
                  header('Location: ' . $openid->authUrl());
         }
         else if($openid->mode=='cancel'){
            
            $msg->addError('OPENID_USER_CANCELLED_REQUEST');
            header('Location: ' .AT_BASE_HREF.'mods/openid/openid_login.php');
            
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
                 if(!$openid_email && !$openid_fname && !$openid_lname)
                     throw ErrorException("Failed to retrieve required attributes from OpenID provider.");
                 
                 echo 'Details Returned<br/>++++++++++++<br/> First Name: '.$openid_fname.
                         '<br/>Second Name: '.$openid_lname. '<br/>Email: '.$openid_email.
                         '<br/> Language: '.$openid_language.'<br/> Country: '.$openid_country;
                 
                 echo '<br/>Stay tuned for login with this credentials.';
                 
             
	}
    }catch (Exception $e){
 
       $msg->addERROR(array('OPENID_EXCEPTION_OCCURED',$e->getMessage(),$e->getCode()));
       header('Location: ' .AT_BASE_HREF.'mods/openid/openid_login.php');
    }


?>

