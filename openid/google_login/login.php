<?php

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'google') {
        // calling login functions
        //googleAuthenticate();
    } 
}
?>
