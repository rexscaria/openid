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
// $Id: openid_settings.php UTF-8 10055 Jul 2, 2012 11:06:14 PM Author:scari  $

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_OPENID);
$_custom_css = $_base_path . 'mods/openid/css/settings.css';
$_custom_head = '<script type="text/javascript" src="mods/openid/js/settings.js" ></script>
                ';

require ('openid.vitals.inc.php');


if(isset($_POST['submit']) && $_POST['submit']=='submit'){
    
    $params = array();
    if(isset($_POST['google_enable']) && $_POST['google_enable']=="true"){
        
        $params['OPENID_GOOGLE_ENABLED'] = 'true'; 
        #Set google mode
        if(isset($_POST['google_select_mode']) && preg_match('/(?:checkid_setup)|(?:checkid_immediate)/',$_POST['google_select_mode']))
            $params['OPENID_GOOGLE_MODE'] = $_POST['google_select_mode'];
        else
            $params['OPENID_GOOGLE_MODE'] = 'checkid_setup';
        
        #Set pape status.
        if(isset($_POST['google_use_pape']) && $_POST['google_use_pape']){
            $params['OPENID_GOOGLE_ENABLE_PAPE'] = 'true';
            #set max auth age.
            if(isset($_POST['google_max_auth_age']) && is_int(intval($_POST['google_max_auth_age'])))
                $params['OPENID_GOOGLE_MAX_AUTH_AGE'] = intval ($_POST['google_max_auth_age']);
            else{
                $params['OPENID_GOOGLE_ENABLE_PAPE'] = 'false';
            }
        }else
            $params['OPENID_GOOGLE_ENABLE_PAPE'] = 'false';
        
        #Set UI extension.
        if(isset($_POST['google_use_ui']) && $_POST['google_use_ui'] = 'true'){
            $params['OPENID_GOOGLE_ENABLE_UI_MODE'] = 'true';
            
            #Set ui mode
            if(isset($_POST['google_select_ui_mode']) && preg_match('(x-has-session)|(popup)',$_POST['google_select_ui_mode']))
                $params['OPENID_GOOGLE_UI_MODE'] = $_POST['google_select_ui_mode'];
            else
                $params['OPENID_GOOGLE_UI_MODE'] = 'x-has-session';
            
            #Set ui icon status.
            if(isset($_POST['google_use_ui_icon']) && $_POST['google_use_ui_icon'] = 'true')
                $params['OPENID_GOOGLE_UI_ICON'] = 'true';
            else
                $params['OPENID_GOOGLE_UI_ICON'] = 'false';           
            
        }else
            $params['OPENID_GOOGLE_ENABLE_UI_MODE'] = 'false';
        
        #Set Query country status.
        if(isset($_POST['google_query_country']) && $_POST['google_query_country'] = 'true')
            $params['OPENID_GOOGLE_QUERY_COUNTRY'] = 'true';
        else
            $params['OPENID_GOOGLE_QUERY_COUNTRY'] = 'false';      
        
        
        #Set Query lang status.
        if(isset($_POST['google_query_lang']) && $_POST['google_query_lang'] = 'true')
            $params['OPENID_GOOGLE_QUERY_LANGUAGE'] = 'true';
        else
            $params['OPENID_GOOGLE_QUERY_LANGUAGE'] = 'false';
        
        #Set oauth status.
        if(isset($_POST['google_use_oauth']) && $_POST['google_use_oauth'] = 'true'){
            $params['OPENID_GOOGLE_REQUEST_OAUTH'] = 'true';
            
            #Set Oauth key
            if(isset($_POST['google_oauth_key']) && $_POST['google_oauth_key'] != '')
                $params['OPENID_GOOGLE_OAUTH_CONSUMER_KEY'] = $_POST['google_oauth_key'];
            else
                $params['OPENID_GOOGLE_REQUEST_OAUTH'] = 'false';
            
        }else
            $params['OPENID_GOOGLE_REQUEST_OAUTH'] = 'false';
        
    }else
        $params['OPENID_GOOGLE_ENABLED'] = 'false';
    
    #Twitter settings
    if(isset($_POST['twitter_enable']) && $_POST['twitter_enable']=="true"){
        $params['OPENID_TWITTER_ENABLED'] = 'true';
        
        #Set Twitter Oauth key
        if(isset($_POST['twitter_consumer_key']) && $_POST['twitter_consumer_key'] != ''){
            $params['OPENID_TWITTER_APP_CONSUMER_KEY'] = $_POST['twitter_consumer_key'];
            
            #Set Twitter secret Oauth key
            if(isset($_POST['twitter_consumer_secret_key']) && $_POST['twitter_consumer_secret_key'] != '')
                $params['OPENID_TWITTER_APP_CONSUMER_SECRET'] = $_POST['twitter_consumer_secret_key'];
            else
                $params['OPENID_TWITTER_ENABLED'] = 'false';
            
            
        }else
            $params['OPENID_TWITTER_ENABLED'] = 'false';
        
        
    }else
        $params['OPENID_TWITTER_ENABLED'] = 'false';
    
    
    #Facebook settings
    if(isset($_POST['fb_enable']) && $_POST['fb_enable']=="true"){
        $params['OPENID_FB_ENABLED'] = 'true';
        
        #Set Twitter Oauth key
        if(isset($_POST['fb_consumer_key']) && $_POST['fb_consumer_key'] != ''){
            $params['OPENID_FB_APP_CONSUMER_KEY'] = $_POST['fb_consumer_key'];
            
            #Set Twitter secret Oauth key
            if(isset($_POST['fb_consumer_secret_key']) && $_POST['fb_consumer_secret_key'] != '')
                $params['OPENID_FB_APP_CONSUMER_SECRET'] = $_POST['fb_consumer_secret_key'];
            else
                $params['OPENID_FB_ENABLED'] = 'false';
        }else
            $params['OPENID_FB_ENABLED'] = 'false';
    }else
        $params['OPENID_FB_ENABLED'] = 'false';
    
    #Save params to db
    if(!storeSettingsToDB($params))
        $msg->addError('OPENID_SETTINGS_SAVED_FAILED');
    else
        $msg->addFeedback('OPENID_SETTINGS_SAVED_SUCCESS');
    
    header('Location: '.AT_BASE_HREF.'mods/openid/openid_settings.php');
    exit;
    
}else {
    $savant->display('openid_settings.tmp.php');
    
}


