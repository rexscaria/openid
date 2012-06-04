<?php
/***********************************************************************/
/* ATutor							       */
/***********************************************************************/
/* Copyright (c) 2002-2010                                             */
/* Inclusive Design Institute	                                       */
/* http://atutor.ca                                                    */
/*                                      			       */
/* This program is free software. You can redistribute it and/or       */
/* modify it under the terms of the GNU General Public License         */
/* as published by the Free Software Foundation.		       */
/***********************************************************************/
// $Id: openid_consumer.php                      scari 			$

/**
 * This class provides a OpenID (1.1 and 2.0) authentication with yadis discovery.
 * 
 */
class OpenIDHelper
{
    public    $returnUrl,
              $data;
    
    private   $identity,
              $claimed_id;
    
    protected $server, 
              $version, 
              $trustRoot;

    function __construct()
    {
        $this->trustRoot = 'http://' . $_SERVER['HTTP_HOST'];
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
            && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        ) {
            $this->trustRoot = 'https://' . $_SERVER['HTTP_HOST'];
        }
        $uri = rtrim(preg_replace('#((?<=\?)|&)openid\.[^&]+#', '', $_SERVER['REQUEST_URI']), '?');
        $this->returnUrl = $this->trustRoot . $uri;

        $this->data = $_POST + $_GET; # OPs may send data as POST or GET.

        if(!function_exists('curl_init') && !in_array('https', stream_get_wrappers())) {
            throw new ErrorException('You must have either https wrappers or curl enabled.');
        }
    }
}

