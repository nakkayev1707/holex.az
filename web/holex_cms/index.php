<?php

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

define('_VALID_PHP', true);
if (isset($_GET['PHPSESSID'])) {
	header('HTTP/1.1 404 Not Found');
	die();
}

@session_start();

/*
	Entry point.
	Loads configuration files, invokes CMS wich perfoms all neccessary startup operations
	in CMS::init(), resolves page.
*/

define('CONFIG_DIR', 'app/config/');
require_once CONFIG_DIR.'app.php';
require_once CORE_DIR.'CMS.php';
spl_autoload_register(['profit_az\profit_cms\CMS', 'autoload']);
CMS::init();

header('Content-type: text/html; charset=utf-8');
header('X-Frame-Options: DENY');

/*
	Page resolving.
	If no session started and no page specified show login page.
	If no page specified and user is authorized, redirect him to landing page.
	Otherwise let CMS to resolve this controller/action.
	It will check user privilegies and show appropriate page.
	CMS::resolve() going to be called if unauthorized user trying to access password
	recovery page or any other public page except login, or if user is authorized and
	tries to access any controller/action.
*/

if (empty($_SESSION[CMS::$sess_hash]['ses_adm_id']) && empty($_GET['controller'])) {
	print CMS::resolve('base', 'sign_in');
	die();
} else if (!empty($_SESSION[CMS::$sess_hash]['ses_adm_id']) && empty($_GET['controller'])) {
	utils::redirect(SITE.CMS_DIR.CMS::getLandingPage());
	die();
}

print CMS::resolve();

session_write_close();

?>