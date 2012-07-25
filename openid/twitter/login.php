<?php

/* * ******************************************************************** */
/* ATutor                                                                 */
/* * ******************************************************************** */
/* Copyright (c) 2002-2012                                                */
/* Inclusive Design Institute                                             */
/* http://atutor.ca                                                       */
/*                                                                        */
/* This program is free software. You can redistribute it and/or          */
/* modify it under the terms of the GNU General Public License            */
/* as published by the Free Software Foundation.                          */
/* * ******************************************************************** */
// $Id: login_twitter.php UTF-8 10055 Jun 26, 2012 9:56:41 PM Author:scari  $

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
#importing required files
require_once  ('libs/twitter_openid_consts.php');
require_once  ('libs/twitteroauth.php');
require_once  ('../openid.vitals.inc.php');

#callback URL
define('CALLBACK_URL',  generateCallBackURL() );
define('OPENID_LOGIN_PAGE_URL',AT_BASE_HREF.'mods/openid/openid_login.php');
define('OPENID_MOD_DIR', AT_BASE_HREF.'mods/openid/');
define('OPENID_PROVIDER','TWITTER');

#Disable openid if master list is enabled.
if (defined('AT_MASTER_LIST') && AT_MASTER_LIST) {
    $msg->addError('OPENID_MASTERLIST_ENABLED');
    header('Location: '.AT_BASE_HREF.'login.php');
    exit;
}

#We can't proceed without keys
if(!isset($_openid_config['OPENID_TWITTER_APP_CONSUMER_KEY'], $_openid_config['OPENID_TWITTER_APP_CONSUMER_SECRET'])){
    $msg->addError('OPENID_TWITTER_KEY_FAILED');
    header('location: '.OPENID_LOGIN_PAGE_URL);
    exit;
}

$_DATA = $_GET + $_POST;

try{
    #Prepare the keys.
    $consumer_key = $_openid_config['OPENID_TWITTER_APP_CONSUMER_KEY'];
    $consumer_secret = $_openid_config['OPENID_TWITTER_APP_CONSUMER_SECRET'];  
   
    if (empty($_DATA['oauth_verifier'])) {
    
        #Make twitter Oauth Object first with HMAC-SHA1 as the signature method.
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret);
        #Requesting authentication tokens.
        $request_token = $twitteroauth->getRequestToken(CALLBACK_URL);
        if(empty($request_token['oauth_token']) ||empty($request_token['oauth_token_secret'])){
            throw new Exception("Failed to request token from twitter. Check your internet connectivity.",408);
        }

        if ($twitteroauth->http_code == 200) {
   
            #Save the tokens for when the user returns from Twitter.
            $_SESSION['openid_twitter_oauth_token'] = $request_token['oauth_token'];
            $_SESSION['openid_twitter_oauth_token_secret'] = $request_token['oauth_token_secret'];

            #Let's generate the URL and redirect for authentication.
            $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
            #save the token to session.
            header('Location: ' . $url);
            exit;
        } else {
            #Some HTTP Error happened. 
            throw new ErrorException('Twitter authentication failed With HTTP response -'+
                    $twitteroauth->http_code +'.',404);
        }
    
        
    }else if (!empty($_GET['oauth_verifier']) && 
                !empty($_SESSION['openid_twitter_oauth_token']) && 
                !empty($_SESSION['openid_twitter_oauth_token_secret'])) {
            #Build a new TwitterOAuth object using consumer key/secret and access key/secret.
            $twitteroauth = new TwitterOAuth($consumer_key, 
                                             $consumer_secret, 
                                             $_SESSION['openid_twitter_oauth_token'], 
                                             $_SESSION['openid_twitter_oauth_token_secret']);

            #Let's request the access token. Once the user tells twitter yes and returns we request the access tokens.
            $access_token = $twitteroauth->getAccessToken($_DATA['oauth_verifier']);
            if(empty($access_token))
                 throw new Exception("Failed to access token from twitter. Check your internet connectivity.",408);
            #Save it in a session var
            $_SESSION['openid_twitter_access_token'] = $access_token;
            
            #It's time to verify credentials and to get user data. Let's get the user's info
            $user_info = $twitteroauth->get('account/verify_credentials');
        
            #Check the User-info which is JSON decoded.
            if($user_info){
                 echo '<pre>';
                print_r($user_info);
                echo '</pre><br/>';
            }else{
                #User denied permission.
                throw new Exception("Failed to fetch user data. Permission denied.", 403);
            }
            
    }
    
} catch (Exception $e){

    #User has failed to login. Unset the session.
    unsetSession($db); 

    $msg->addError(array('OPENID_EXCEPTION_OCCURED',$e->getMessage(),$e->getCode()));
    header('Location: ' .AT_BASE_HREF.'mods/openid/openid_login.php');
    exit;    
}


?>
