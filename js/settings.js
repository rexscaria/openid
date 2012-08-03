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
// $Id: settings.js   UTF-8 10055 Jul 2, 2012 11:20:09 PM Author:scari  $

var google_enable = '#google_enable';
var google_mode = '#google_select_mode';
var google_use_pape = '#google_use_pape';
var google_max_auth_age = '#google_max_auth_age';
var google_use_ui = '#google_use_ui';
var google_ui_mode = '#google_select_ui_mode';
var google_use_ui_icon = '#google_use_ui_icon';
var google_query_country = '#google_query_country';
var google_query_lang = '#google_query_lang';
var google_use_oauth = '#google_use_oauth';
var google_oauth_key = '#google_oauth_key';
var twitter_enable = '#twitter_enable';
var fb_enable = '#fb_enable';


function addError(msg){
    jQuery('#errorbox').text(msg);
    jQuery('#errorbox').show();
    jQuery(window).scrollTop(jQuery('#errorbox').offset().top);

}

function validate_auth_age(){ 
    if(jQuery(google_enable).is(':checked') && jQuery(google_use_pape).is(':checked'))
        if(isNaN(parseInt(jQuery(google_max_auth_age).val())))
            return false;
    return true;
}

function  validate_oauth_key(){
    if(jQuery(google_use_oauth).is(':checked') && jQuery(google_oauth_key).val() =='')
        return false;
    return true;
}

function  validate_twitter_key(){
    if(jQuery(twitter_enable).is(':checked') && jQuery('#twitter_consumer_key').val() =='')
        return false;
    return true;
}

function  validate_twitter_secret(){
    if(jQuery(twitter_enable).is(':checked') && jQuery('#twitter_consumer_secret_key').val() =='')
        return false;
    return true;
}

function  validate_fb_key(){
    if(jQuery(fb_enable).is(':checked') && jQuery('#fb_consumer_key').val() =='')
        return false;
    return true;
}

function  validate_fb_secret(){
    if(jQuery(fb_enable).is(':checked') && jQuery('#fb_consumer_secret_key').val() =='')
        return false;
    return true;
}


function validate_form(){
    if(!validate_auth_age()){
        addError('Google Max authentication age is invalid!');
        return false;
    }else if(!validate_oauth_key()){
        addError('Google Oauth key is invalid!');
        return false;
    }else if(!validate_twitter_key()){
        addError('Twitter Oauth key is invalid!');
        return false;
    }else if(!validate_twitter_secret()){
        addError('Twitter Oauth secret key is invalid!');
        return false;
    }else if(!validate_fb_key()){
        addError('Facebook Oauth key is invalid!');
        return false;
    }else if(!validate_fb_secret()){
        addError('Facebook Oauth secret key is invalid!');
        return false;
    }
    
    return true;
}


function checkbox_google_enable() {
    if(!jQuery(google_enable).is(':checked')){
        jQuery('input[id^=google_]').attr('disabled','disabled');
        jQuery('select[id^=google_]').attr('disabled','disabled');
        jQuery('input'+google_enable).removeAttr('disabled');
    }
    else{
        jQuery('input[id^=google_]').removeAttr('disabled');
        jQuery('select[id^=google_]').removeAttr('disabled');
    }
}
        
function checkbox_google_use_pape(){
    if(!jQuery(google_use_pape).is(':checked'))
        jQuery('input'+google_max_auth_age).attr('disabled','disabled');
    else
        jQuery('input'+google_max_auth_age).removeAttr('disabled');
}
        
function checkbox_google_use_ui(){
    if(!jQuery(google_use_ui).is(':checked')){
        jQuery('select'+google_ui_mode).attr('disabled','disabled');
        jQuery('input'+google_use_ui_icon).attr('disabled','disabled');
    }
    else{
        jQuery('select'+google_ui_mode).removeAttr('disabled');
        jQuery('input'+google_use_ui_icon).removeAttr('disabled');
    }
}

function checkbox_google_use_oauth(){
    if(!jQuery(google_use_oauth).is(':checked'))
        jQuery('input'+google_oauth_key).attr('disabled','disabled');
    else
        jQuery('input'+google_oauth_key).removeAttr('disabled');
}

function checkbox_twitter_enable(){
    if(!jQuery(twitter_enable).is(':checked')){
        jQuery('input[id^=twitter_]').attr('disabled','disabled');
        jQuery('input'+twitter_enable).removeAttr('disabled');
    }
    else
        jQuery('input[id^=twitter_]').removeAttr('disabled');
}

function checkbox_fb_enable(){
    if(!jQuery(fb_enable).is(':checked')){
        jQuery('input[id^=fb_]').attr('disabled','disabled');
        jQuery('input'+fb_enable).removeAttr('disabled');
    }else
        jQuery('input[id^=fb_]').removeAttr('disabled');
}



jQuery(document).ready(function () {
    jQuery('#openid_settings_form').submit(validate_form);

    jQuery(google_enable).click( checkbox_google_enable );
    jQuery(google_use_pape).click( checkbox_google_use_pape );
    jQuery(google_use_ui).click( checkbox_google_use_ui );
    jQuery(google_use_oauth).click( checkbox_google_use_oauth );
    jQuery(twitter_enable).click( checkbox_twitter_enable );
    jQuery(fb_enable).click( checkbox_fb_enable );
    
    checkbox_google_enable ();
    checkbox_google_use_pape ();
    checkbox_google_use_ui ();
    checkbox_google_use_oauth();
    checkbox_twitter_enable ();
    checkbox_fb_enable ();
  });

