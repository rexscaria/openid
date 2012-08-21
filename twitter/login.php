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

$_user_location = 'public';

define('AT_INCLUDE_PATH', '../../../include/');
require (AT_INCLUDE_PATH . 'vitals.inc.php');
#importing required files
require_once ('libs/twitter_openid_consts.php');
require_once ('libs/twitteroauth.php');
require_once ('../openid.vitals.inc.php');

#callback URL
define('CALLBACK_URL', generateCallBackURL(NULL));
define('OPENID_LOGIN_PAGE_URL', AT_BASE_HREF . 'mods/openid/openid_login.php');
define('OPENID_MOD_DIR', AT_BASE_HREF . 'mods/openid/');
define('OPENID_PROVIDER', 'TWITTER');

#Disable openid if master list is enabled.
if (defined('AT_MASTER_LIST') && AT_MASTER_LIST) {
    $msg->addError('OPENID_MASTERLIST_ENABLED');
    header('Location: ' . AT_BASE_HREF . 'login.php');
    exit;
}

#We can't proceed without keys
if (!isset($_openid_config['OPENID_TWITTER_APP_CONSUMER_KEY'], $_openid_config['OPENID_TWITTER_APP_CONSUMER_SECRET'])) {
    $msg->addError('OPENID_TWITTER_KEY_FAILED');
    header('location: ' . OPENID_LOGIN_PAGE_URL);
    exit;
}

$_DATA = $_GET + $_POST;

try {
    #Prepare the keys.
    $consumer_key = $_openid_config['OPENID_TWITTER_APP_CONSUMER_KEY'];
    $consumer_secret = $_openid_config['OPENID_TWITTER_APP_CONSUMER_SECRET'];

    if (empty($_DATA['oauth_verifier']) && empty($_POST['submit'])) {

        #Make twitter Oauth Object first with HMAC-SHA1 as the signature method.
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret);
        #Requesting authentication tokens.
        $request_token = $twitteroauth->getRequestToken(CALLBACK_URL);
        if (empty($request_token['oauth_token']) || empty($request_token['oauth_token_secret'])) {
            throw new Exception(_AT('openid_twitter_request_token_failed'), $twitteroauth->http_code);
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
            throw new Exception(_AT('openid_twitter_auth_failed') +
                    $twitteroauth->http_code + '.', $twitteroauth->http_code);
        }
    } else if (!empty($_GET['oauth_verifier']) &&
            !empty($_SESSION['openid_twitter_oauth_token']) &&
            !empty($_SESSION['openid_twitter_oauth_token_secret']) &&
            empty($_POST['submit'])) {
        #Build a new TwitterOAuth object using consumer key/secret and access key/secret.
        $twitteroauth = new TwitterOAuth($consumer_key,
                        $consumer_secret,
                        $_SESSION['openid_twitter_oauth_token'],
                        $_SESSION['openid_twitter_oauth_token_secret']);

        #Let's request the access token. Once the user tells twitter yes and returns we request the access tokens.
        $access_token = $twitteroauth->getAccessToken($_DATA['oauth_verifier']);

        #Check the User-info which is JSON decoded.
        if (empty($access_token) || $twitteroauth->http_code != 200)
            throw new Exception(_AT('openid_twitter_access_token_failed').' '. _AT('openid_permission_denied'), $twitteroauth->http_code);

        #Save it in a session var
        $_SESSION['openid_twitter_access_token'] = $access_token;
        
        #It's time to verify credentials and to get user data. Let's get the user's info
        $user_info = $twitteroauth->get('account/verify_credentials');

        #Check the User-info which is JSON decoded.
        if ($user_info && $twitteroauth->http_code == 200) {

            #check whether user exists in twitter credential table
            $sql = "SELECT members_table.member_id AS member_id, login, status , preferences, language, last_login ".
                    "FROM ".TABLE_PREFIX."openid_twitter_credentials AS twitter_credentials ".
                    "JOIN ".TABLE_PREFIX."members AS members_table ".
                    "ON twitter_credentials.member_id = members_table.member_id ".
                    "WHERE twitter_id='$user_info->id_str'";
            $result = mysql_query($sql, $db);
            if (!$result) {
                    throw new Exception(_AT('openid_mysql_error'). mysql_error(), mysql_errno());
            }
            if (mysql_num_rows($result) != 0) {
                $default_course_id = 0;
            
                #User has already registered. It's time to login.
                makeLoginWithOpenID($result, NULL);
                header('Location: ' . AT_BASE_HREF . 'bounce.php?course=' . $default_course_id);
                exit;
            } else {
                #Remove fake entry from twitter credential table if it exists.
                $sql = "DELETE FROM ". TABLE_PREFIX . "openid_twitter_credentials WHERE twitter_id='$user_info->id_str'";
                mysql_query($sql);
                $_SESSION['email_request_id'] = uniqid();
                $_SESSION['email_request_timestamp'] = time();
                #Get email id
                header('Location: ' . '../openid_login.php' . "?twitter_email_request=true&request=".$_SESSION['email_request_id']."&stamp=".$_SESSION['email_request_timestamp']);
                exit;
            }
        } else {
            #User denied permission.
            throw new Exception(_AT('openid_twitter_user_denied').' '. _AT('openid_permission_denied'), $twitteroauth->http_code);
        }
    } else if (isset($_POST['submit']) &&
            isset($_POST['twitter_email']) && 
            $_SESSION['email_request_id'] == $_POST['request'] &&
            $_SESSION['email_reply_timestamp'] == $_POST['reply'] &&
            $_POST['submit'] == 'submit') {

        unset($_SESSION['email_request_id']);
        $openid_email = addslashes(trim($_POST['twitter_email']));
      
        #Can we continue without mail? . No, we can't
        if(!filter_var($openid_email, FILTER_VALIDATE_EMAIL))
            throw new Exception(_AT('openid_email_not_valid'));
        
        #Hey it's time to login.
        if (!isset($_SESSION['openid_twitter_access_token']))
            throw new Exception("Access token not found!!");

        $access_token = $_SESSION['openid_twitter_access_token'];
        #Build a new TwitterOAuth object using consumer key/secret and access key/secret.
        $twitteroauth = new TwitterOAuth($consumer_key,
                        $consumer_secret,
                        $access_token['oauth_token'],
                        $access_token['oauth_token_secret']);

        if (empty($access_token))
            throw new Exception(_AT('openid_twitter_cached_access_token_failed').' '. _AT('openid_permission_denied'), 
                                $twitteroauth->http_code);


        #It's time to verify credentials and to get user data. Let's get the user's info
        $user_info = $twitteroauth->get('account/verify_credentials');

        if (!$user_info && 
                $twitteroauth->http_code != 200 &&
                $user_info->screen_name == $access_token['screen_name'] &&
                $user_info->id_str == $access_token['id'])
            throw new Exception(_AT('openid_twitter_invalid_access_token'));

        $name_array = explode(' ', $user_info->name,2);
        preg_match_all('/[^, ]+$/',  $user_info->location, $location_arr, PREG_PATTERN_ORDER);
        
        $openid_email = filter_var($openid_email, FILTER_SANITIZE_EMAIL);
        $openid_fname = $name_array[0];
        $openid_lname = $name_array[1];
        $openid_country = $location_arr[0][0];
        $openid_username = trim($user_info->screen_name);
        $openid_twitter_id = trim($user_info->id_str);


        #Can we continue with mail? . No, we can't, if it is invalid.
        if (!filter_var($openid_email, FILTER_VALIDATE_EMAIL))
            throw new Exception(_AT('openid_twitter_invalid_email'). _AT('openid_twitter_login_failed'), 401);

        if (empty($openid_email) || empty($openid_fname) || empty($openid_twitter_id)) {
            throw new Exception(_AT('openid_details_not_valid') . _AT('openid_twitter_login_failed'), 401);
        }
        
        #Is the mail present in db??
        $sql = "SELECT member_id FROM ".TABLE_PREFIX."members WHERE email='$openid_email'";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) !=0){
            #Email exists. Exit now.
            throw new Exception(_AT('openid_twitter_email_exists'));
        }
        
        $default_course_id = 0;
        registerAndLoginWithOpenID(NULL, $openid_fname, $openid_lname, $openid_email, $openid_country, $openid_username);
        $m_id = $_SESSION['member_id'];
        $sql = "REPLACE INTO `".TABLE_PREFIX."openid_twitter_credentials` VALUES ( '$user_info->id_str', '$m_id')";
        $result = mysql_query($sql);
         if(!$result){
            #Failed to enter twitter data. Now undo the registration and unset session.
            $sql = "DELETE FROM ".TABLE_PREFIX."members WHERE member_id='$m_id'";
            mysql_query($sql);
            unsetSession($db);
        }
        
        $now = date('Y-m-d H:i:s');
         if (isEmailValidationRequired()) {
                $msg->addFeedback('OPENID_REG_THANKS_CONFIRM');

                $code = substr(md5($openid_email . $now . $m_id), 0, 10);
                $confirmation_link = $_base_href . 'confirm.php?id='.$m_id.SEP.'m='.$code;

                /* send the email confirmation message: */
                require(AT_INCLUDE_PATH . 'classes/phpmailer/atutormailer.class.php');
                $mail = new ATutorMailer();

                $mail->From     = $_config['contact_email'];
                $mail->AddAddress($openid_email);
                $mail->Subject = SITE_NAME . ' - ' . _AT('email_confirmation_subject');
                $mail->Body    = _AT('email_confirmation_message', SITE_NAME, $confirmation_link);

                $mail->Send();
                unsetSession($db);
                header('Location: ' . AT_BASE_HREF . 'mods/openid/openid_login.php');
                exit;

	}else{
            header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
            exit;
        }
        
        
    } else {
        #Rarely used path. Don't know what to do!!!!
        #Just throw an exception.
        throw new Exception(_AT('openid_twitter_login_failed'). ' '. _AT('openid_try_again'), 404);
    }
} catch (Exception $e) {

    #User has failed to login. Unset the session.
    unsetSession($db);

    $msg->addError(array('OPENID_EXCEPTION_OCCURED', $e->getMessage(), $e->getCode()));
    header('Location: ' . AT_BASE_HREF . 'mods/openid/openid_login.php');
    exit;
}
?>
