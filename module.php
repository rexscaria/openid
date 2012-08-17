<?php
/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) { exit; }

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) { exit(__FILE__ . ' is not a Module'); }

/*******
 * assign the instructor and admin privileges to the constants.
 */
define('AT_PRIV_OPENID',       $this->getPrivilege());
define('AT_ADMIN_PRIV_OPENID', $this->getAdminPrivilege());

// ** possible alternative: **
// the text to display on module "detail view" when sublinks are not available
$this->_pages['mods/openid/openid_login.php']['text']  = _AT('openid_text');

/*******
 * this module is not available to students on the Home or Main Navigation.
 * Only an admin can control the openID settings.
 */

/*******
 * add the admin pages when needed.
 */
if (admin_authenticate(AT_ADMIN_PRIV_HELLO_WORLD, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
	$this->_pages[AT_NAV_ADMIN] = array('mods/openid/openid_settings.php');
	$this->_pages['mods/openid/openid_settings.php']['title_var'] = 'OpenID Settings';
	$this->_pages['mods/openid/openid_settings.php']['parent']    = AT_NAV_ADMIN;
}

/*******
 * instructor or student has nothing to manage in the openID section:
 */

/* public pages are included as a tab to the login page.
 * NOTE: This can be changed.
 * 
 */

$this->_pages['login.php']['children']  = array_merge(array('mods/openid/openid_login.php'), isset($_pages['login.php']['children']) ? $_pages['login.php']['children'] : array());
$this->_pages['mods/openid/openid_login.php']['title_var'] = 'OpenID Login';
$this->_pages['mods/openid/openid_login.php']['parent']    = 'login.php';

/* No my start pages are required */

?>
