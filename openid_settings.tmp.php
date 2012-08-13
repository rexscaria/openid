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
// $Id: openid_settings.tmp.php UTF-8 10055 Jul 2, 2012 11:20:09 PM Author:scari  $

if (!defined('AT_INCLUDE_PATH')) { exit; } 

global $_openid_config;
require (AT_INCLUDE_PATH.'header.inc.php'); 
?>

<div class="openid-settings-form">
  <form id="openid_settings_form" action="mods/openid/openid_settings.php" method="post" accept-charset="utf-8" autocomplete="off">
    <ul class="settings">
      <fieldset class="main-fieldset">
        <li>
          <br>
          <img class="main-image" src="mods/openid/images/openid.png" width="84" height="84" alt="OpenID Settings"/>
          <p class="title"><h1>  <?php echo _AT('openid_settings'); ?> </h1></p>
          <p>
              <span>  <?php echo _AT('openid_settings_sub_heading'); ?>  </span>
          </p>
        </li>
        <div id="errorbox" name="errorbox" class="errormsgbox" hidden="true" >  </div>
        <span class="vertical-space"></span>
        
        <fieldset>
          <legend>
            <li>
              <img src="mods/openid/images/google.png" width="84" height="84" alt="Google OpenID Settings"/>
              <p class="title"><h2>  <?php echo _AT('openid_settings_google'); ?>  </h2></p>
              <p>
                <span>  <?php echo _AT('openid_google_sub_heading'); ?>  </span>
              </p>
            </li>
          </legend>
          <div class="settings-content">
            <dl>
              <dt>  <?php echo _AT('openid_google_enable'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_enable" id="google_enable" value="true" label="ss" <?php echo ($_openid_config['OPENID_GOOGLE_ENABLED']=='true')? 'checked' : 'unchecked'?> size="1"/></dd>
            </dl>
            <dl>
              <dt>
                  <?php echo _AT('openid_google_mode'); ?>  
              </dt>
              <dd>
                <select name="google_select_mode" id="google_select_mode" >
                  <option value="checkid_setup" <?php  echo ($_openid_config['OPENID_GOOGLE_MODE']=='checkid_setup')? 'selected' : ''?> label="checkid_setup">
                    checkid_setup
                  </option>
                  <option value="checkid_immediate" <?php  echo ($_openid_config['OPENID_GOOGLE_MODE']=='checkid_immediate')? 'selected' : ''?> label="checkid_immediate">
                    checkid_immediate
                  </option>
                </select>
              </dd>
              <a href="mods/openid/docs/ajax/google_mode.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
              </a>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_google_use_pape'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_use_pape" id="google_use_pape" value="true" <?php echo ($_openid_config['OPENID_GOOGLE_ENABLE_PAPE']=='true')? 'checked' : 'unchecked'?> /></dd>
            </dl>
            <dl>
              <span class="sub-item"><dt>  <?php echo _AT('openid_google_max_auth_age') ; ?>
                </dt>
                <dd><input type="text" name="google_max_auth_age" id="google_max_auth_age" size="5"  value="<?php echo $_openid_config['OPENID_GOOGLE_MAX_AUTH_AGE'] ?>"/></dd></span>
                <a href="mods/openid/docs/ajax/google_pape.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
                </a>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_google_enable_ui_extension'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_use_ui" id="google_use_ui" value="true" <?php echo ($_openid_config['OPENID_GOOGLE_ENABLE_UI_MODE']=='true')? 'checked' : 'unchecked' ?> />
              </dd>
            </dl>
            <dl>
              <span class="sub-item"><dt>  <?php echo _AT('openid_google_enable_ui_mode'); ?>  
                </dt>
                <dd>
                  <select name="google_select_ui_mode" id="google_select_ui_mode">
                    <option value="x-has-session" selected="selected" label="x-has-session">
                      x-has-session
                    </option>
                    <option value="popup" label="popup">
                      popup
                    </option>
                  </select>
                </dd>
              </span>
                <a href="mods/openid/docs/ajax/google_ui_mode.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
                </a>
            </dl>
            <dl>
              <span class="sub-item"><dt>  <?php echo _AT('openid_google_enable_ui_icon'); ?>  
                </dt>
                <dd><input type="checkbox" name="google_use_ui_icon" id="google_use_ui_icon" value="true" <?php echo ($_openid_config['OPENID_GOOGLE_UI_ICON']=='true')? 'checked' : 'unchecked' ?> /></dd></span>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_google_query_country'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_query_country" id="google_query_country" value="true" <?php echo ($_openid_config['OPENID_GOOGLE_QUERY_COUNTRY']=='true')? 'checked' : 'unchecked'?> /></dd>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_google_query_lang'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_query_lang" id="google_query_lang" value="true" <?php echo ($_openid_config['OPENID_GOOGLE_QUERY_LANGUAGE']=='true')? 'checked' : 'unchecked'?> /></dd>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_google_use_oauth'); ?>  
              </dt>
              <dd><input type="checkbox" name="google_use_oauth" id="google_use_oauth"  value="true" <?php echo ($_openid_config['OPENID_GOOGLE_REQUEST_OAUTH']=='true')? 'checked' : 'unchecked'?> /></dd>
              <a href="mods/openid/docs/ajax/google_app_module.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
              </a>
            </dl>
            <dl>
              <span class="sub-item"><dt>  <?php echo _AT('openid_google_oauth_key'); ?>  
                </dt>
                <dd><input type="text" name="google_oauth_key" id="google_oauth_key" value="<?php echo $_openid_config['OPENID_GOOGLE_OAUTH_CONSUMER_KEY'] ?>"/></dd></span>
                <a href="mods/openid/docs/ajax/google_keys.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
                </a>
            </dl>
            <br>
          </div>
        </fieldset>
        <fieldset>
          <legend>
            <li>
              <img src="mods/openid/images/twitter.png" width="84" height="84" alt="Twitter OpenID Settings"/>
              <p class="title"><h2>  <?php echo _AT('openid_settings_twitter'); ?>  </h2></p>
              <p>
                <span>  <?php echo _AT('openid_settings_twitter_sub_heading'); ?>  </span>
              </p>
            </li>
          </legend>
          <div class="settings-content">
            <dl>
              <dt>  <?php echo _AT('openid_twitter_enable'); ?>  
              </dt>
              <dd><input type="checkbox" name="twitter_enable" id="twitter_enable" value="true" <?php echo ($_openid_config['OPENID_TWITTER_ENABLED']=='true')? 'checked' : 'unchecked'?> size="1"/></dd>
              <a href="mods/openid/docs/ajax/twitter_keys.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
              </a>
            </dl>
            <dl>
              <dt>  <?php echo _AT('openid_twitter_mail_confirmation'); ?>  
              </dt>
              <dd><input type="checkbox" name="twitter_email_confirmation" id="twitter_email_confirmation" value="true" <?php echo ($_openid_config['OPENID_TWITTER_CONFIRM_EMAIL_ID']=='true')? 'checked' : 'unchecked'?> size="1"/></dd>
            </dl><i>  <?php echo _AT('openid_recommended'); ?> </i>
            <dl>
              <dt>
                  <?php echo _AT('openid_twitter_app_key'); ?>  
              </dt>
              <dd><input type="text" name="twitter_consumer_key" id="twitter_consumer_key" size="40"  value="<?php echo $_openid_config['OPENID_TWITTER_APP_CONSUMER_KEY'] ?>" /></dd>
            </dl>
            <dl>
              <dt>
                  <?php echo _AT('openid_twitter_app_secret_key'); ?>  
              </dt>
              <dd><input type="text" name="twitter_consumer_secret_key" size="40" id="twitter_consumer_secret_key" value="<?php echo $_openid_config['OPENID_TWITTER_APP_CONSUMER_SECRET'] ?>"  /></dd>
            </dl>
          </div>
        </fieldset>
        <fieldset>
          <legend>
            <li>
              <img src="mods/openid/images/facebook.png" width="84" height="84" alt="Facebook OpenID Settings"/>
              <p class="title"><h2>  <?php echo _AT('openid_settings_fb'); ?>  </h2></p>
              <p>
                <span>  <?php echo _AT('openid_settings_fb_sub_heading'); ?>  </span>
              </p>
            </li>
          </legend>
          <div class="settings-content">
            <dl>
              <dt>  <?php echo _AT('openid_fb_enable'); ?>  
              </dt>
              <dd><input type="checkbox" name="fb_enable" id="fb_enable" value="true" <?php echo ($_openid_config['OPENID_FB_ENABLED']=='true')? 'checked' : 'unchecked'?>  size="1"/></dd>
              <a href="mods/openid/docs/ajax/fb_keys.html" rel="#overlay">
                  <img class="help-img"  style="margin: 0;" src="mods/openid/images/help.png"> 
              </a>
            </dl>
            <dl>
              <dt>
                  <?php echo _AT('openid_fb_app_key'); ?>  
              </dt>
              <dd><input type="text" name="fb_consumer_key" id="fb_consumer_key"  size="40" value="<?php echo $_openid_config['OPENID_FB_APP_CONSUMER_KEY'] ?>" /></dd>
            </dl>
            <dl>
              <dt>
                 <?php echo _AT('openid_fb_app_secret_key'); ?>  
              </dt>
              <dd><input type="text" name="fb_consumer_secret_key" size="40" id="fb_consumer_secret_key"  value="<?php echo $_openid_config['OPENID_FB_APP_CONSUMER_SECRET'] ?>" /></dd>
            </dl>
          </div>
        </fieldset>
        <div class="buttons" style="margin-left: 250px;">
          <button type="submit"  class="positive" name="submit" id="submit" value="submit" >
            <img src="mods/openid/images/submit.png" alt="submit"/>
                <?php echo _AT('submit'); ?>  
          </button>
        </div>
      </fieldset>
    </ul>
  </form>
</div>

<!-- overlayed element -->
<div class="apple_overlay" id="overlay">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php');  ?>
