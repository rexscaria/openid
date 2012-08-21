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

$_openid_countries = array(
               'AF' => 'Afghanistan',
                'AL' => 'Albania',
                'DZ' => 'Algeria',
                'AS' => 'American Samoa',
                'AD' => 'Andorra',
                'AO' => 'Angola',
                'AI' => 'Anguilla',
                'AQ' => 'Antarctica',
                'AG' => 'Antigua and Barbuda',
                'AR' => 'Argentina',
                'AM' => 'Armenia',
                'AW' => 'Aruba',
                'AU' => 'Australia',
                'AT' => 'Austria',
                'AZ' => 'Azerbaijan',
                'BS' => 'Bahamas',
                'BH' => 'Bahrain',
                'BD' => 'Bangladesh',
                'BB' => 'Barbados',
                'BY' => 'Belarus',
                'BE' => 'Belgium',
                'BZ' => 'Belize',
                'BJ' => 'Benin',
                'BM' => 'Bermuda',
                'BT' => 'Bhutan',
                'BO' => 'Bolivia',
                'BA' => 'Bosnia and Herzegovina',
                'BW' => 'Botswana',
                'BV' => 'Bouvet Island',
                'BR' => 'Brazil',
                'IO' => 'British Indian Ocean Territory',
                'BN' => 'Brunei Darussalam',
                'BG' => 'Bulgaria',
                'BF' => 'Burkina Faso',
                'BI' => 'Burundi',
                'KH' => 'Cambodia',
                'CM' => 'Cameroon',
                'CA' => 'Canada',
                'CV' => 'Cape Verde',
                'KY' => 'Cayman Islands',
                'CF' => 'Central African Republic',
                'TD' => 'Chad',
                'CL' => 'Chile',
                'CN' => 'China',
                'CX' => 'Christmas Island',
                'CC' => 'Cocos (Keeling) Islands',
                'CO' => 'Colombia',
                'KM' => 'Comoros',
                'CG' => 'Congo',
                'CD' => 'Congo Democratic Republic',
                'CK' => 'Cook Islands',
                'CR' => 'Costa Rica',
                'CT' => 'Cote d\'Ivoire',
                'HR' => 'Croatia',
                'CY' => 'Cyprus',
                'CZ' => 'Czech Republic',
                'DK' => 'Denmark',
                'DJ' => 'Djibouti',
                'DM' => 'Dominica',
                'DO' => 'Dominican Republic',
                'TL' => 'East Timor',
                'EC' => 'Ecuador',
                'EG' => 'Egypt',
                'SV' => 'El Salvador',
                'GQ' => 'Equatorial Guinea',
                'ER' => 'Eritrea',
                'EE' => 'Estonia',
                'ET' => 'Ethiopia',
                'FK' => 'Falkland Islands (Malvinas)',
                'FO' => 'Faroe Islands',
                'FJ' => 'Fiji',
                'FI' => 'Finland',
                'FR' => 'France',
                'GF' => 'French Guiana',
                'PF' => 'French Polynesia',
                'TF' => 'French Southern Territories',
                'GA' => 'Gabon',
                'GM' => 'Gambia',
                'GE' => 'Georgia',
                'DE' => 'Germany',
                'GH' => 'Ghana',
                'GI' => 'Gibraltar',
                'GR' => 'Greece',
                'GL' => 'Greenland',
                'GD' => 'Grenada',
                'GP' => 'Guadeloupe',
                'GU' => 'Guam',
                'GT' => 'Guatemala',
                'GN' => 'Guinea',
                'GW' => 'Guinea Bissau',
                'GY' => 'Guyana',
                'HT' => 'Haiti',
                'HM' => 'Heard and McDonald Islands',
                'HN' => 'Honduras',
                'HK' => 'Hong Kong',
                'HU' => 'Hungary',
                'IS' => 'Iceland',
                'IN' => 'India',
                'ID' => 'Indonesia',
                'IQ' => 'Iraq',
                'IE' => 'Ireland',
                'IL' => 'Israel',
                'IT' => 'Italy',
                'JM' => 'Jamaica',
                'JP' => 'Japan',
                'JO' => 'Jordan',
                'KZ' => 'Kazakhstan',
                'KE' => 'Kenya',
                'KI' => 'Kiribati',
                'KW' => 'Kuwait',
                'KG' => 'Kyrgyzstan',
                'LA ' => 'Lao People\'s Democratic Republic',
                'LV' => 'Latvia',
                'LB' => 'Lebanon',
                'LS' => 'Lesotho',
                'LR' => 'Liberia',
                'LY' => 'Libya',
                'LI' => 'Liechtenstein',
                'LT' => 'Lithuania',
                'LU' => 'Luxembourg',
                'MO' => 'Macau',
                'MK' => 'Macedonia',
                'MG' => 'Madagascar',
                'MW' => 'Malawi',
                'MY' => 'Malaysia',
                'MV' => 'Maldives',
                'ML' => 'Mali',
                'MT' => 'Malta',
                'MH' => 'Marshall Islands',
                'MQ' => 'Martinique',
                'MR' => 'Mauritania',
                'MU' => 'Mauritius',
                'YT' => 'Mayotte',
                'MX' => 'Mexico',
                'FM' => 'Micronesia',
                'MD' => 'Moldova',
                'MC' => 'Monaco',
                'MN' => 'Mongolia',
                'MS' => 'Montserrat',
                'MA' => 'Morocco',
                'MZ' => 'Mozambique',
                'NA' => 'Namibia',
                'NR' => 'Nauru',
                'NP' => 'Nepal',
                'NL' => 'Netherlands',
                'AN' => 'Netherlands Antilles',
                'NC' => 'New Caledonia',
                'NZ' => 'New Zealand',
                'NI' => 'Nicaragua',
                'NE' => 'Niger',
                'NG' => 'Nigeria',
                'NU' => 'Niue',
                'NF' => 'Norfolk Island',
                'MP' => 'Northern Mariana Islands',
                'NO' => 'Norway',
                'OM' => 'Oman',
                'PK' => 'Pakistan',
                'PW' => 'Palau',
                'PS' => 'Palestinian Territory',
                'PA' => 'Panama',
                'PG' => 'Papua New Guinea',
                'PY' => 'Paraguay',
                'PE' => 'Peru',
                'PH' => 'Philippines',
                'PN' => 'Pitcairn',
                'PL' => 'Poland',
                'PT' => 'Portugal',
                'PR' => 'Puerto Rico',
                'QA' => 'Qatar',
                'RE' => 'Reunion',
                'RO' => 'Romania',
                'RU' => 'Russian Federation',
                'RW' => 'Rwanda',
                'KN' => 'Saint Kitts and Nevis',
                'LC' => 'Saint Lucia',
                'VC' => 'Saint Vincent and the Grenadines',
                'WS' => 'Samoa',
                'SM' => 'San Marino',
                'ST' => 'Sao Tome and Principe',
                'SA' => 'Saudi Arabia',
                'SN' => 'Senegal',
                'CS' => 'Serbia and Montenegro',
                'SC' => 'Seychelles',
                'SL' => 'Sierra Leone',
                'SG' => 'Singapore',
                'SK' => 'Slovakia',
                'SI' => 'Slovenia',
                'SB' => 'Solomon Islands',
                'SO' => 'Somalia',
                'ZA' => 'South Africa',
                'GS' => 'South Georgia and The South Sandwich Islands',
                'KR' => 'South Korea',
                'ES' => 'Spain',
                'LK' => 'Sri Lanka',
                'SH' => 'St. Helena',
                'PM' => 'St. Pierre and Miquelon',
                'SR' => 'Suriname',
                'SJ' => 'Svalbard and Jan Mayen Islands',
                'SZ' => 'Swaziland',
                'SE' => 'Sweden',
                'CH' => 'Switzerland',
                'TW' => 'Taiwan',
                'TJ' => 'Tajikistan',
                'TZ' => 'Tanzania',
                'TH' => 'Thailand',
                'TG' => 'Togo',
                'TK' => 'Tokelau',
                'TO' => 'Tonga',
                'TT' => 'Trinidad and Tobago',
                'TN' => 'Tunisia',
                'TR' => 'Turkey',
                'TM' => 'Turkmenistan',
                'TC' => 'Turks and Caicos Islands',
                'TV' => 'Tuvalu',
                'UG' => 'Uganda',
                'UA' => 'Ukraine',
                'AE' => 'United Arab Emirates',
                'GB' => 'United Kingdom',
                'US' => 'United States',
                'UM' => 'United States Minor Outlying Islands',
                'UY' => 'Uruguay',
                'UZ' => 'Uzbekistan',
                'VU' => 'Vanuatu',
                'VA' => 'Vatican',
                'VE' => 'Venezuela',
                'VN' => 'Viet Nam',
                'VG' => 'Virgin Islands (British)',
                'VI' => 'Virgin Islands (U.S.)',
                'WF' => 'Wallis and Futuna Islands',
                'EH' => 'Western Sahara',
                'YE' => 'Yemen',
                'ZM' => 'Zambia',
                'ZW' => 'Zimbabwe' );

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
                 unset($_SESSION['openid_provider']);
                 unset($_SESSION['openid_twitter_oauth_token']);
                 unset($_SESSION['openid_twitter_oauth_token_secret']);
                 unset($_SESSION['openid_twitter_access_token']);
                 unset($_SESSION['email_request_id']);
                 unset($_SESSION['email_reply_timestamp']);
                 unset($_SESSION['email_request_timestamp']);
                 $_SESSION['prefs']['PREF_FORM_FOCUS'] = 1;                
} 

function isExistLogin($db, $login) {
    $sql = "SELECT login FROM ".TABLE_PREFIX."members WHERE login='$login'";
    $result = mysql_query($sql,$db) or die(mysql_error());
    return (mysql_num_rows($result)>0);
}

function getFreeLoginName($db, $fname, $lname, $email, $suggestion) {
    
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
    $sugession_array = isset($suggestion)?array($suggestion):array();
    $login_combinations = array_merge($sugession_array, array($fname . $lname, 
                                                            $lname.$fname ,
                                                            $match[0],
                                                            $fname,
                                                            $lname,
                                                            $fname.'_'.$lname,
                                                            $lname.'_'.$fname,
                                                            $fname.'.'.$lname,
                                                            $lname.'.'.$fname,
                                                            $fname.'-'.$lname,
                                                            $lname.'-'.$fname));
    $free_login_name = NULL;
    
    foreach ($login_combinations as $login){
        if(!isExistLogin($db, $login)){ 
                $free_login_name = $login;
                break;
        }
    }
    
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

function isEmailValidationRequired(){
    global $_openid_config;
    return OPENID_PROVIDER == 'TWITTER' && (
                    ($_openid_config['OPENID_TWITTER_CONFIRM_EMAIL_ID'] == 'true')  
                        ||        
                    (defined('AT_EMAIL_CONFIRMATION') && AT_EMAIL_CONFIRMATION )
           );
    
}


function registerAndLoginWithOpenID($openid_obj, $openid_fname, 
                                                 $openid_lname, 
                                                 $openid_email, 
                                                 $openid_country, 
                                                 $username_sugestion) {
        
    global $_config;
    global $msg;
    global $db;
    global $_openid_config;
    
        #Is registration allowed??
        if($_config['allow_registration'] != 1){
            $msg->addInfo('REG_DISABLED');
            header('Location: '.OPENID_LOGIN_PAGE_URL);
            exit;
        }
        
        $result = mysql_query("SELECT * FROM ".TABLE_PREFIX."members WHERE email='$openid_email'",$db);
	if (mysql_num_rows($result) != 0) {
            $msg->addError('LOGIN_EXISTS');
            return;
	}
        
        #Email conformation is recommended for twitter.
        if (isEmailValidationRequired()) {
                $status = AT_STATUS_UNCONFIRMED;
        } else {
                $status = AT_STATUS_STUDENT;
        }
        $now = date('Y-m-d H:i:s');
        $default_private_email = 1;

        #Its time to select a login name.
        $login_name = getFreeLoginName($db, $openid_fname, $openid_lname,$openid_email, $username_sugestion);

        #Make the parameters clean
        $openid_email   = addslashes($openid_email);
        $openid_country = addslashes($openid_country);
        $openid_fname   = addslashes($openid_fname);
        $openid_lname   = addslashes($openid_lname);
        $login_name     = addslashes($login_name);
        
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

            require (AT_INCLUDE_PATH.'html/auto_enroll_courses.inc.php');

            #Update last_login
            $sql = "UPDATE ".TABLE_PREFIX."members 
                    SET last_login=now(), creation_date=creation_date 
                    WHERE member_id=".$member_id;
            mysql_query($sql, $db);


            #Write the token to db, if oauth is requested.
            if(isset($openid_obj) && $openid_obj->isOAuthRecieved()){
                addOAuthTokenToDB($openid_obj, $m_id, TABLE_PREFIX, OPENID_PROVIDER);
            }


            #Write to session.
            $_SESSION['valid_user'] = true;
            $_SESSION['member_id'] = $m_id;
            $_SESSION['course_id']  = 0;
            $_SESSION['login'] = $login_name;
            assign_session_prefs(unserialize(stripslashes($_config[pref_defaults])), 1);
            $_SESSION['is_guest'] = 0;
            $_SESSION['lang'] = $_SESSION[lang];
            $_SESSION['first_login'] = true;

            #Its an OpenID session
            $_SESSION['is_openid'] = true;
            $_SESSION['openid_provider'] = OPENID_PROVIDER;
            session_write_close();
        }
}


function makeLoginWithOpenID( $mysql_result, $openid_obj) {

    global $_config;
    global $msg;
    global $db;
    
        #Shouldn't login if account exists.
	if (mysql_num_rows($mysql_result) == 0) {
            $msg->addError('OPENID_USER_NOT_REGITERED');
            return;
	}
    
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
            if(isset($openid_obj) && $openid_obj->isOAuthRecieved()){  
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
            $_SESSION['is_guest'] = 0;
            $_SESSION['lang']	= $language;
            $_SESSION['course_id']  = 0;
            $now = date('Y-m-d H:i:s');

            #Its an OpenID session
            $_SESSION['is_openid'] = true;
            $_SESSION['openid_provider'] = OPENID_PROVIDER;

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
        }
}


function storeSettingsToDB($settings) {
    global $db;
    foreach ($settings as $key_setting => $setting_value) {
        $sql = "UPDATE `".TABLE_PREFIX."openid_settings` 
                SET property_value='$setting_value' 
                WHERE property_name='$key_setting'
                ";
        if(!mysql_query($sql))
            return false;
    }
    return true;
}


function generateCallBackURL($custom_url) {
    $root = 'http://' . $_SERVER['HTTP_HOST'];
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
            && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        ) {
            $root = 'https://' . $_SERVER['HTTP_HOST'];
    }
    $root = isset($custom_url)? $custom_url : $root;
    $uri = rtrim(preg_replace('#((?<=\?)|&)openid\.[^&]+#', '', $_SERVER['REQUEST_URI']), '?');
    return $root . $uri;
    
}


if (!function_exists ('filter_var')) {
  # define the VALIDATE FILTER-constants you would like to use, more info on php.net
  define ('FILTER_VALIDATE_EMAIL', '/^([A-Za-z0-9\.\_\%\+\-]{1,39})@([a-zA-Z0-9\.\-]{2,34})\.[a-zA-Z]{2,5}$/');
  define ('FILTER_VALIDATE_BOOLEAN', '/^(1|yes|true|on)$/i');
 
  # the filter_var function
  function filter_var ($variable, $filter) {
       return preg_match ($filter, $variable)? $variable : FALSE;
  }
}

?>