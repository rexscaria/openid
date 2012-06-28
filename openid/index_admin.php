<?php
/* * ******************************************************************** */
/* ATutor							          */
/* * ******************************************************************** */
/* Copyright (c) 2002-2012                                                */
/* Inclusive Design Institute	                                          */
/* http://atutor.ca                                                       */
/*                                      			          */
/* This program is free software. You can redistribute it and/or          */
/* modify it under the terms of the GNU General Public License            */
/* as published by the Free Software Foundation.                          */
/* * ******************************************************************** */
//$Id: index_admin.php UTF-8 10055 Jun 13, 2012 7:08:49 PM Author:scari$

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
admin_authenticate(AT_ADMIN_PRIV_HELLO_WORLD);
require (AT_INCLUDE_PATH.'header.inc.php');
?>

Hello Administrator!! :)

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>
