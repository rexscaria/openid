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
        $result = @mysql_query($sql, $db);
    }
                 unset($_SESSION['login']);
                 unset($_SESSION['valid_user']);
                 unset($_SESSION['member_id']);
                 unset($_SESSION['is_admin']);
                 unset($_SESSION['course_id']);
                 unset($_SESSION['is_super_admin']);
                 unset($_SESSION['dd_question_ids']);
                 #unset($_SESSION['is_openid']);
                 #unset($_SESSION['openid_claimed_id']);

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

?>
