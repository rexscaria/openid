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
                'Afghanistan'=> 'AF',
                'Albania'=> 'AL',
                'Algeria'=> 'DZ',
                'American Samoa'=> 'AS',
                'Andorra'=> 'AD',
                'Angola'=> 'AO',
                'Anguilla'=> 'AI',
                'Antarctica'=> 'AQ',
                'Antigua and Barbuda'=> 'AG',
                'Argentina'=> 'AR',
                'Armenia'=> 'AM',
                'Aruba'=> 'AW',
                'Australia'=> 'AU',
                'Austria'=> 'AT',
                'Azerbaijan'=> 'AZ',
                'Bahamas'=> 'BS',
                'Bahrain'=> 'BH',
                'Bangladesh'=> 'BD',
                'Barbados'=> 'BB',
                'Belarus'=> 'BY',
                'Belgium'=> 'BE',
                'Belize'=> 'BZ',
                'Benin'=> 'BJ',
                'Bermuda'=> 'BM',
                'Bhutan'=> 'BT',
                'Bolivia'=> 'BO',
                'Bosnia and Herzegovina'=> 'BA',
                'Botswana'=> 'BW',
                'Bouvet Island'=> 'BV',
                'Brazil'=> 'BR',
                'British Indian Ocean Territory'=> 'IO',
                'Brunei Darussalam'=> 'BN',
                'Bulgaria'=> 'BG',
                'Burkina Faso'=> 'BF',
                'Burundi'=> 'BI',
                'Cambodia'=> 'KH',
                'Cameroon'=> 'CM',
                'Canada'=> 'CA',
                'Cape Verde'=> 'CV',
                'Cayman Islands'=> 'KY',
                'Central African Republic'=> 'CF',
                'Chad'=> 'TD',
                'Chile'=> 'CL',
                'China'=> 'CN',
                'Christmas Island'=> 'CX',
                'Cocos (Keeling) Islands'=> 'CC',
                'Colombia'=> 'CO',
                'Comoros'=> 'KM',
                'Congo'=> 'CG',
                'Congo Democratic Republic'=> 'CD',
                'Cook Islands'=> 'CK',
                'Costa Rica'=> 'CR',
                'Cote d\'Ivoire'=> 'CI',
                'Croatia'=> 'HR',
                'Cyprus'=> 'CY',
                'Czech Republic'=> 'CZ',
                'Denmark'=> 'DK',
                'Djibouti'=> 'DJ',
                'Dominica'=> 'DM',
                'Dominican Republic'=> 'DO',
                'East Timor'=> 'TL',
                'Ecuador'=> 'EC',
                'Egypt'=> 'EG',
                'El Salvador'=> 'SV',
                'Equatorial Guinea'=> 'GQ',
                'Eritrea'=> 'ER',
                'Estonia'=> 'EE',
                'Ethiopia'=> 'ET',
                'Falkland Islands (Malvinas)'=> 'FK',
                'Faroe Islands'=> 'FO',
                'Fiji'=> 'FJ',
                'Finland'=> 'FI',
                'France'=> 'FR',
                'French Guiana'=> 'GF',
                'French Polynesia'=> 'PF',
                'French Southern Territories'=> 'TF',
                'Gabon'=> 'GA',
                'Gambia'=> 'GM',
                'Georgia'=> 'GE',
                'Germany'=> 'DE',
                'Ghana'=> 'GH',
                'Gibraltar'=> 'GI',
                'Greece'=> 'GR',
                'Greenland'=> 'GL',
                'Grenada'=> 'GD',
                'Guadeloupe'=> 'GP',
                'Guam'=> 'GU',
                'Guatemala'=> 'GT',
                'Guinea'=> 'GN',
                'Guinea Bissau'=> 'GW',
                'Guyana'=> 'GY',
                'Haiti'=> 'HT',
                'Heard and McDonald Islands'=> 'HM',
                'Honduras'=> 'HN',
                'Hong Kong'=> 'HK',
                'Hungary'=> 'HU',
                'Iceland'=> 'IS',
                'India'=> 'IN',
                'Indonesia'=> 'ID',
                'Iraq'=> 'IQ',
                'Ireland'=> 'IE',
                'Israel'=> 'IL',
                'Italy'=> 'IT',
                'Jamaica'=> 'JM',
                'Japan'=> 'JP',
                'Jordan'=> 'JO',
                'Kazakhstan'=> 'KZ',
                'Kenya'=> 'KE',
                'Kiribati'=> 'KI',
                'Kuwait'=> 'KW',
                'Kyrgyzstan'=> 'KG',
                'Lao People\'s Democratic Republic'=> 'LA',
                'Latvia'=> 'LV',
                'Lebanon'=> 'LB',
                'Lesotho'=> 'LS',
                'Liberia'=> 'LR',
                'Libya'=> 'LY',
                'Liechtenstein'=> 'LI',
                'Lithuania'=> 'LT',
                'Luxembourg'=> 'LU',
                'Macau'=> 'MO',
                'Macedonia'=> 'MK',
                'Madagascar'=> 'MG',
                'Malawi'=> 'MW',
                'Malaysia'=> 'MY',
                'Maldives'=> 'MV',
                'Mali'=> 'ML',
                'Malta'=> 'MT',
                'Marshall Islands'=> 'MH',
                'Martinique'=> 'MQ',
                'Mauritania'=> 'MR',
                'Mauritius'=> 'MU',
                'Mayotte'=> 'YT',
                'Mexico'=> 'MX',
                'Micronesia'=> 'FM',
                'Moldova'=> 'MD',
                'Monaco'=> 'MC',
                'Mongolia'=> 'MN',
                'Montserrat'=> 'MS',
                'Morocco'=> 'MA',
                'Mozambique'=> 'MZ',
                'Namibia'=> 'NA',
                'Nauru'=> 'NR',
                'Nepal'=> 'NP',
                'Netherlands'=> 'NL',
                'Netherlands Antilles'=> 'AN',
                'New Caledonia'=> 'NC',
                'New Zealand'=> 'NZ',
                'Nicaragua'=> 'NI',
                'Niger'=> 'NE',
                'Nigeria'=> 'NG',
                'Niue'=> 'NU',
                'Norfolk Island'=> 'NF',
                'Northern Mariana Islands'=> 'MP',
                'Norway'=> 'NO',
                'Oman'=> 'OM',
                'Pakistan'=> 'PK',
                'Palau'=> 'PW',
                'Palestinian Territory'=> 'PS',
                'Panama'=> 'PA',
                'Papua New Guinea'=> 'PG',
                'Paraguay'=> 'PY',
                'Peru'=> 'PE',
                'Philippines'=> 'PH',
                'Pitcairn'=> 'PN',
                'Poland'=> 'PL',
                'Portugal'=> 'PT',
                'Puerto Rico'=> 'PR',
                'Qatar'=> 'QA',
                'Reunion'=> 'RE',
                'Romania'=> 'RO',
                'Russian Federation'=> 'RU',
                'Rwanda'=> 'RW',
                'Saint Kitts and Nevis'=> 'KN',
                'Saint Lucia'=> 'LC',
                'Saint Vincent and the Grenadines'=> 'VC',
                'Samoa'=> 'WS',
                'San Marino'=> 'SM',
                'Sao Tome and Principe'=> 'ST',
                'Saudi Arabia'=> 'SA',
                'Senegal'=> 'SN',
                'Serbia and Montenegro'=> 'CS',
                'Seychelles'=> 'SC',
                'Sierra Leone'=> 'SL',
                'Singapore'=> 'SG',
                'Slovakia'=> 'SK',
                'Slovenia'=> 'SI',
                'Solomon Islands'=> 'SB',
                'Somalia'=> 'SO',
                'South Africa'=> 'ZA',
                'South Georgia and The South Sandwich Islands'=> 'GS',
                'South Korea'=> 'KR',
                'Spain'=> 'ES',
                'Sri Lanka'=> 'LK',
                'St. Helena'=> 'SH',
                'St. Pierre and Miquelon'=> 'PM',
                'Suriname'=> 'SR',
                'Svalbard and Jan Mayen Islands'=> 'SJ',
                'Swaziland'=> 'SZ',
                'Sweden'=> 'SE',
                'Switzerland'=> 'CH',
                'Taiwan'=> 'TW',
                'Tajikistan'=> 'TJ',
                'Tanzania'=> 'TZ',
                'Thailand'=> 'TH',
                'Togo'=> 'TG',
                'Tokelau'=> 'TK',
                'Tonga'=> 'TO',
                'Trinidad and Tobago'=> 'TT',
                'Tunisia'=> 'TN',
                'Turkey'=> 'TR',
                'Turkmenistan'=> 'TM',
                'Turks and Caicos Islands'=> 'TC',
                'Tuvalu'=> 'TV',
                'Uganda'=> 'UG',
                'Ukraine'=> 'UA',
                'United Arab Emirates'=> 'AE',
                'United Kingdom'=> 'GB',
                'United States'=> 'US',
                'United States Minor Outlying Islands'=> 'UM',
                'Uruguay'=> 'UY',
                'Uzbekistan'=> 'UZ',
                'Vanuatu'=> 'VU',
                'Vatican'=> 'VA',
                'Venezuela'=> 'VE',
                'Viet Nam'=> 'VN',
                'Virgin Islands (British)'=> 'VG',
                'Virgin Islands (U.S.)'=> 'VI',
                'Wallis and Futuna Islands'=> 'WF',
                'Western Sahara'=> 'EH',
                'Yemen'=> 'YE',
                'Zambia'=> 'ZM',
                'Zimbabwe'=> 'ZW' );

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
    $free_login_name = (isset($suggestion) && !isExistLogin($db, $suggestion))? $suggestion
        : (!isExistLogin($db, $fname . $lname))? $fname . $lname
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


function registerAndLoginWithOpenID($openid_obj, $openid_fname, $openid_lname, $openid_email, $openid_country, $username_sugestion) {
        
    global $_config;
    global $msg;
    global $db;
    
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


        #No Email conformation is needed for OpenID login.
        $status = AT_STATUS_STUDENT;
        $now = date('Y-m-d H:i:s');
        $default_private_email = 1;

        #Its time to select a login name.
        $login_name = getFreeLoginName($db, $openid_fname, $openid_lname,$openid_email, $username_sugestion);

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
            $_SESSION['member_id']	= $m_id;
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
            $_SESSION['is_guest']	= 0;
            $_SESSION['lang']	= $language;
            $_SESSION['course_id']  = 0;
            $now = date('Y-m-d H:i:s');
            $default_course_id = 0;

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

?>