OpenID-ATutor
=============
 Version: 1.0 Beta

 License: GPL/ATutor

 OpenID module for ATutor
 ------------------------

    The module provides OpenID feature to the ATutor.  Which enables users to register and  log 
  in to the ATutor without much pain. They can manage their content without keeping a separate 
  username password combination. This module can work with OAuth based Google app module to import 
  Google services to the ATutor. The OpenID module for ATutor is an anytime pluggable module 
  that can help the Atutor users to login from their Google account rather than registering a
  new account.

 
    The OpenID module supports Google, Facebook and Twitter based authentication. The administartor
  can configure these three OpenID services. 

  INDEX
  -----
  1.0 How to install OpenID Module?
  2.0 How to configure OpenID Module?
  3.0 How to use OpenID Module for Login?


  1.0 How to install OpenID Module?
  -------------------
    
  1. Copy the downloaded file into the ATutor mods/ directory and unzip it there. 
     On Windows systems use and application like WinZip the extract the file into
     the mods/ directory.
        On Unix/Linux systems use the command:

        unzip openid.zip

  2. Login to ATutor as the administrator and run Install Module under the Modules
     tab, select the OpenID module, which should be listed as available to be installed
     when the module has been unzipped into the mods directory

  3. Once the module has been installed, and enabled, goto "OpenID Settings" tab.
  
  4. Configure the OpenID the way you want it to be. See "How to configure OpenID Module?".


  2.0 How to configure OpenID Module?
  -----------------------------------

  1. Goto "OpenID Settings" tab. 

  2. Configure Google OpenID.
        
        a). Enable Google OpenID : Choose to enable Google OpenID. If disabled the other 
                                   Google OpenID settings are ignored.
        
        b). Google OpenID Mode   : Specifies whether Google may interact with the user 
                                   to determine the outcome of the request. Valid values are:

                                        "checkid_immediate" (No interaction allowed)
                                        "checkid_setup" (Interaction allowed)

                                    Default option is "checkid_setup".
        
        c). Use PAPE              : Use "OpenID Provider Authentication Policy Extension" which
            (optional)              enables maximum authentication age. (Refer setting 2.d).
        
        d). Maximum auth age(PAPE): Sets the maximum acceptable time (in seconds) since the user
            (optional)              last authenticated. If the session is older, the user will be
                                    prompted to log in again. Setting the value to zero will force
                                    a password reprompt regardless of session age.

        e). UI mode               : Specifies the alternative user interface. The following values
            (optional)              are valid:

                                         "popup"
                                         "x-has-session" (indicate the presence of an authenticated session)

        f). EnableUI Icon         : Displays the favicon of the referring domain in the OpenID approval
            (optional)              page if set.

        g). Query Country details : Fetches country details of the user from Google and saves it in
            (optional)              the ATutor user preferences.

        h). Query Language details: Fetches language details of the user from Google and saves it in
            (optional)              the ATutor user preferences.

        i). Use OAuth             : Instead of Google OpenID, the Google OAuth will be used. This can
            (optional)              work with ATutor Google Apps module. So that it eliminates the need
                                    of authenticating again for the Google Apps module.

        j). OAuth consumer key    : Consumer key provided by Google after registering the site. This is
            (optional)              typically a DNS domain name. 
                                    Refer https://accounts.google.com/ManageDomains

  3. Configure Twitter OpenID.
        
        a). Enable Twitter OpenID : Choose to enable Twitter OpenID. If disabled the other Twitter OpenID
                                    settings are ignored.

        b). Enable Twitter mail 
                   confirmation   : Select this to make sure that the mail id's registered under Twitter
            (Recommended)           OpenID are verified by confirmation mails.

        c). Twitter Consumer key 
                    &               
            Secret Consumer Key   : To setup Twitter OpenID you need to create an app in twitter developer
                                    area. From there the consumer key and secret key are to be noted to 
                                    configure the Twitter OpenID.
                                     See https://dev.twitter.com/apps/new

  4. Configure Facebook OpenID.
        
        a). Enable Facebook OpenID: Choose to enable Facebook OpenID. If disabled the other Facebook OpenID
                                    settings are ignored.

        b). Facebook Consumer key 
                    &               
            Secret Consumer Key   : To setup Facebook OpenID you need to create an app in facebook developer
                                    area. From there the consumer key and secret key are to be noted to 
                                    configure the Facebook OpenID.
                                       See https://developers.facebook.com/apps
  
  For more information refer the docs in OpenID settings page.


  3.0 How to use OpenID Module for Login?
  ---------------------------------------

  1. Goto ATutor login page. and select "OpenID Login" tab.
  
  2. OpenID will not work if the Master List is enabled. Else you can see the "Login with Google", "Login with
     Twitter" and "Login with Facebook" if they are enabled in OpenID settings page.

  3. Click on the OpenID button that you want to login with. The user will be redirected to OpenID providers, 
     where the user will be asked to login and grant access to the app.

  4. After granting access the user will be redirected to ATutor site where the user will be registered and loged
     in to the ATutor. If the user is already registered he can login directly.

  5. In case of Twitter OpenID the user is required to submit their mail id in the prompt screen on redirection from
     Twitter. If Twitter mail confirmation is set, then the user need to confirm his/her mail by clicking on the link
     in the registered mail.

  6. Only instructors and students can login to the ATutor with OpenID. The admins are required to take the login page
     with username, password combo.


