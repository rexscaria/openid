<?php

/* * ********************************************************************   */
/* ATutor                                                                   */
/* * ********************************************************************   */
/* Copyright (c) 2002-2012                                                  */
/* Inclusive Design Institute                                               */
/* http://atutor.ca                                                         */
/*                                                                          */
/* This program is free software. You can redistribute it and/or            */
/* modify it under the terms of the GNU General Public License              */
/* as published by the Free Software Foundation.                            */
/* * ********************************************************************   */
// $Id:openid.vitals.inc.php UTF-8 10055 Jun 15,2012 12:34:48AM Author:scari  $

if (!defined('AT_INCLUDE_PATH')) { exit; }

/* get config variables. if they're not in the db then it uses the installation default value in constants.inc.php */
$sql_stmt    = "SELECT property_name, property_value FROM ".TABLE_PREFIX."openid_settings";
$resultset = mysql_query($sql_stmt, $db);
while ($ret_row = mysql_fetch_assoc($resultset)) { 
	$_openid_config[$ret_row['property_name']] = $ret_row['property_value'];
}




function unsetSession($db){
    if (isset($_SESSION['member_id'])) {
        $sql = "DELETE FROM ".TABLE_PREFIX."users_online WHERE member_id=$_SESSION[member_id]";
        @mysql_query($sql, $db);
    }
                 unset($_SESSION['login']);
                 unset($_SESSION['valid_user']);
                 unset($_SESSION['member_id']);
                 unset($_SESSION['is_admin']);
                 unset($_SESSION['course_id']);
                 unset($_SESSION['is_super_admin']);
                 unset($_SESSION['dd_question_ids']);
                 unset($_SESSION['is_openid']);
                 unset($_SESSION['openid_claimed_id']);

                 $_SESSION['prefs']['PREF_FORM_FOCUS'] = 1;                
} 

function isExistLogin($db, $login) {
    $sql = "SELECT login FROM ".TABLE_PREFIX."members WHERE login='$login'";
    $result = mysql_query($sql,$db) or die(mysql_error());
    return (mysql_num_rows($result)>0);
}

function getFreeLoginName($db, $fname, $lname, $email) {
    
    /*
     * TODO : Make it simple
     * STRATEGY: 1. go for firstname + secondname
     *           2. try secondname + firstname
     *           3. try email id
     *           4. try firstname
     *           5. try last name
     *           If all 5 fails add unique numbers to
     * 
     */
   
    preg_match('/[^@]+/', $email, $match);
    $free_login_name = !isExistLogin($db, $fname . $lname)? $fname . $lname
            : (!isExistLogin($db, $lname.$fname)? $lname.$fname 
            : (!isExistLogin($db,$match[0])? $match[0]
            : (!isExistLogin($db, $fname)? $fname
            : (!isExistLogin($db, $lname)? $lname
            : (!isExistLogin($db, $fname.'_'.$lname)? $fname.'_'.$lname
            : (!isExistLogin($db, $lname.'_'.$fname)? $lname.'_'.$fname
            : (!isExistLogin($db, $fname.'.'.$lname)? $fname.'.'.$lname
            : (!isExistLogin($db, $lname.'.'.$fname)? $lname.'.'.$fname 
            : (!isExistLogin($db, $fname.'-'.$lname)? $fname.'-'.$lname
            : (!isExistLogin($db, $lname.'-'.$fname)? $lname.'-'.$fname 
            : NULL
              ))))))))));
    if($free_login_name==NULL){
        #Append numbers to the end.
        do{
            $free_login_name = $fname . $lname . rand(10,99); 
        }while(!isExistLogin($db, $free_login_name));    
    }
    return $free_login_name;
}


function queryOpenidSettings($db, $settings_name, $default_value=false) {
    $sql = "SELECT property_value FROM ".TABLE_PREFIX."openid_settings WHERE property_name='$settings_name'";
    $result = mysql_query($sql,$db) or die(mysql_error());
    if(mysql_num_rows($result)==0){
        return $default_value;
    }
    $row = mysql_fetch_array($result);  
    return $row['property_value'];
}


function addOAuthTokenToDB($openid_obj, $mem_id, $tab_prefix, $op_provider) {
     global $db;
     $claimed_identity = $openid_obj->identity;
     $token = $openid_obj->getOAuthRequestToken();
     $sql = "REPLACE INTO `$tab_prefix"."openid_oauth_request_token`
                     VALUES ( $mem_id, 
                     '$op_provider',
                     '$claimed_identity',
                     '$token',
                     NOW()
                )";
     return mysql_query($sql, $db) or die(mysql_error());
}

////////////////////////////////////////////////////



function registerAndLogin($openid_obj, $openid_fname, $openid_lname,$openid_email, $openid_country) {
        
    global $_config;
    global $msg;
    global $db;
    
        #Is registration allowed??
        if($_config['allow_registration'] != 1){
            $msg->addInfo('REG_DISABLED');
            header('Location: '.OPENID_LOGIN_PAGE_URL);
            exit;
        }


        #No Email conformation is needed for OpenID login.
        $status = AT_STATUS_STUDENT;
        $now = date('Y-m-d H:i:s');
        $default_private_email = 1;

        #Its time to select a login name.
        $login_name = getFreeLoginName($db, $openid_fname, $openid_lname,$openid_email);

        $sql = "INSERT INTO ".TABLE_PREFIX."members 
                (login,
                email,
                first_name,
                last_name,
                country,
                status,
                preferences,
                creation_date,
                language,
                inbox_notify,
                private_email,
                last_login)
        VALUES ('$login_name',
                '$openid_email',
                '$openid_fname',
                '$openid_lname',
                '$openid_country', 
                 $status, 
                '$_config[pref_defaults]', 
                '$now',
                '$_SESSION[lang]', 
                 $_config[pref_inbox_notify], 
                 $default_private_email, 
                '0000-00-00 00:00:00')";

        $result = mysql_query($sql, $db) or die(mysql_error());
        $m_id   = mysql_insert_id($db);
        if (!$result) {
            $msg->addError('DB_NOT_UPDATED');
            header('Location: '.OPENID_LOGIN_PAGE_URL);
            exit;
        }else{
            #Reset login attempts.
            $sql = "DELETE FROM ".TABLE_PREFIX."member_login_attempt WHERE login='$login_name'";
            mysql_query($sql, $db);

            #If en_id is set, automatically enroll into courses that links with en_id and go to "My Start Page"
            $member_id = $m_id;
            $default_course_id = 0;

            require (AT_INCLUDE_PATH.'html/auto_enroll_courses.inc.php');

            #Update last_login
            $sql = "UPDATE ".TABLE_PREFIX."members 
                    SET last_login=now(), creation_date=creation_date 
                    WHERE member_id=".$member_id;
            mysql_query($sql, $db);


            #Write the token to db, if oauth is requested.
            if($openid_obj->isOAuthRecieved()){
                addOAuthTokenToDB($openid_obj, $m_id, TABLE_PREFIX, OPENID_PROVIDER);
            }


            #Write to session.
            $_SESSION['valid_user'] = true;
            $_SESSION['member_id']	= $m_id;
            $_SESSION['course_id']  = 0;
            $_SESSION['login'] = $login_name;
            assign_session_prefs(unserialize(stripslashes($_config[pref_defaults])), 1);
            $_SESSION['is_guest']	= 0;
            $_SESSION['lang'] = $_SESSION[lang];
            $_SESSION['first_login'] = true;

            #Its an OpenID session
            $_SESSION['is_openid'] = true;
            $_SESSION['openid_claimed_id'] = $openid_obj->identity;
            session_write_close();

            header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
            exit;

        }
}


function makeLogin( $mysql_result, $openid_obj) {

    global $_config;
    global $msg;
    global $db;
        #Garbage collect for maximum login attempts table
        if (rand(1, 100) == 1){
            $sql = 'DELETE FROM '.TABLE_PREFIX.'member_login_attempt WHERE expiry < '. time();
            mysql_query($sql, $db);
        }

        if (version_compare(PHP_VERSION, '5.1.0', '>=')) {
            session_regenerate_id(TRUE);
        }

        #Get the login name, member id, status and preferences.
        list($m_id, $login_name, $status, $preferences, $language, $last_login) = mysql_fetch_array($mysql_result);

        #Check if this account has exceeded maximum attempts
        $sql = 'SELECT login, attempt, expiry FROM '.TABLE_PREFIX."member_login_attempt WHERE login='$login_name'";

        $result = mysql_query($sql, $db);
        if ($result && mysql_numrows($result) > 0){
            list($attempt_login_name, $attempt_login, $attempt_expiry) = mysql_fetch_array($result);
        } else {
            $attempt_login_name = '';
            $attempt_login = 0;
            $attempt_expiry = 0;
        }

        if($attempt_expiry > 0 && $attempt_expiry < time()){

            #Clear entry if it has expired
            $sql = 'DELETE FROM '.TABLE_PREFIX."member_login_attempt WHERE login='$login_name'";
            mysql_query($sql, $db);
            $attempt_login = 0;	
            $attempt_expiry = 0;
        }

        if($_config['max_login'] > 0 && $attempt_login >= $_config['max_login']){
            $msg->addError('MAX_LOGIN_ATTEMPT');
            header('Location: ' .OPENID_MOD_DIR.'openid_login.php');
            exit;
        } else if ($status == AT_STATUS_UNCONFIRMED) {
            $msg->addError('NOT_CONFIRMED');
            #TODO: Make the mail id as conformed.
            header('Location: ' .OPENID_MOD_DIR.'openid_login.php');
            exit;
        } else if ($status == AT_STATUS_DISABLED) {
            $msg->addError('ACCOUNT_DISABLED');
            header('Location: ' .OPENID_MOD_DIR.'openid_login.php');
            exit;
        }else{


            #Write the token to db, if oauth is requested.
            if($openid_obj->isOAuthRecieved()){  
                addOAuthTokenToDB($openid_obj, $m_id, TABLE_PREFIX, OPENID_PROVIDER);
            }                

            #Everythings OK. Make Login.
            $_SESSION['valid_user'] = true;
            $_SESSION['member_id']  = intval($m_id);
            $_SESSION['login']	 = $login_name;
            if ($preferences == "")
            assign_session_prefs(unserialize(stripslashes($_config["pref_defaults"])), 1);
            else
            assign_session_prefs(unserialize(stripslashes($preferences)), 1);
            $_SESSION['is_guest']	= 0;
            $_SESSION['lang']	= $language;
            $_SESSION['course_id']  = 0;
            $now = date('Y-m-d H:i:s');
            $default_course_id = 0;

            #Its an OpenID session
            $_SESSION['is_openid'] = true;
            $_SESSION['openid_claimed_id'] = $openid_obj->identity;

            $_SESSION['first_login'] = false;
            if ($last_login == null || $last_login == '' 
            || $last_login == '0000-00-00 00:00:00' 
            || $_SESSION['prefs']['PREF_MODIFIED']!==1) {

                $_SESSION['first_login'] = true;
            }

            $sql = "UPDATE ".TABLE_PREFIX."members SET creation_date=creation_date, last_login='$now' WHERE member_id=$_SESSION[member_id]";
            mysql_query($sql, $db);

            #Clear login attempt on successful login
            $sql = 'DELETE FROM '.TABLE_PREFIX."member_login_attempt WHERE login='$login_name'";
            mysql_query($sql, $db);

            $msg->addFeedback('LOGIN_SUCCESS');

            header('Location: '.AT_BASE_HREF.'bounce.php?course='.$default_course_id);
            exit;
        }
}


?>
