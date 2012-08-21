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
// $Id: login.php UTF-8 10055 Aug 21, 2012 10:58:06 PM Author:scari  $

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
require ('openid.vitals.inc.php');
try{
    if (!empty($_GET['login']) && !empty($_GET['openid_provider']) && $_GET['login']=='true' ){

        #Check for OpenID Provider

        switch($_GET['openid_provider']){
            
            case 'google':
                    #Redirect to google login.
                    header('Location: ' . AT_BASE_HREF . 'mods/openid/google/login.php');
                    break;
            case 'facebook':
                    #Redirect to google login.
                    header('Location: ' . AT_BASE_HREF . 'mods/openid/facebook/login.php');
                    break;
            case 'twitter':
                    #Redirect to google login.
                    header('Location: ' . AT_BASE_HREF . 'mods/openid/twitter/login.php');
                    break;
            default:
                    #ERROR : throw exception.
                    throw new Exception(_AT('openid_unknown_provider'));
                    exit;
        }
        
        exit;
        
    } else {
        #ERROR : throw exception.
        throw new Exception(_AT('openid_invalid_parameters'));
        exit;

    }
}  catch (Exception $e){
    #User has failed to login. Unset the session.
    unsetSession($db);

    $msg->addError(array('OPENID_EXCEPTION_OCCURED', $e->getMessage(), $e->getCode()));
    header('Location: ' . AT_BASE_HREF . 'mods/openid/openid_login.php');
    exit;
}
?>
