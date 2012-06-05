<?php

// importing required files
require_once 'openid_utility.php';
// callback URL
define('CALLBACK_URL',"http://".$_SERVER['SERVER_NAME']."/ATutor/mods/openid/google_login/login.php" );

function googleAuthenticate() {
    // Creating new instance
    $openid = new OpenIDUtility;
    $openid->identity = 'https://www.google.com/accounts/o8/id';
    //setting call back url
    $openid->returnUrl = CALLBACK_URL;
    //finding open id end point from google
    $endpoint = $openid->discover('https://www.google.com/accounts/o8/id');
    $fields =
            '?openid.ns=' . urlencode('http://specs.openid.net/auth/2.0') .
            '&openid.return_to=' . urlencode($openid->returnUrl) .
            '&openid.claimed_id=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.identity=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.mode=' . urlencode('checkid_setup') .
            '&openid.ns.ax=' . urlencode('http://openid.net/srv/ax/1.0') .
            '&openid.ax.mode=' . urlencode('fetch_request') .
            '&openid.ax.required=' . urlencode('email,firstname,lastname,language,country') .
            '&openid.ax.type.firstname=' . urlencode('http://axschema.org/namePerson/first') .
            '&openid.ax.type.lastname=' . urlencode('http://axschema.org/namePerson/last') .
            '&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email').
            '&openid.ax.type.country=' . urlencode('http://axschema.org/contact/country/home') .
            '&openid.ax.type.language=' . urlencode('http://axschema.org/pref/language').
            '&openid.ns.pape='.urlencode('http://specs.openid.net/extensions/pape/1.0').
            '&openid.pape.max_auth_age='.urlencode('0');
    header('Location: ' . $endpoint . $fields);
}



if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'google') {
        // calling login functions
        googleAuthenticate();
    } 
}
?>

