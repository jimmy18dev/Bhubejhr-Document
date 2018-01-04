<?php
session_start();
// session_regenerate_id(true); // regenerated the session, delete the old one.
ob_start();
define('StTime', microtime(true));

date_default_timezone_set('Asia/Bangkok');
// error_reporting(0);

define("VERSION" 	,'0.0.1');

require_once 'config/config.php';
require_once 'class/database.class.php';
require_once 'class/signature.class.php';
require_once 'class/category.class.php';
require_once 'class/keyword.class.php';
require_once 'class/document.class.php';
require_once 'class/user.class.php';
require_once 'class/member.class.php';
include_once 'plugin/mobile-detect/mobile_detect.php';
include_once 'plugin/mobile-detect/desktop_detect.php';

$wpdb 		= new Database; // DATABASE CONNECT...
$user 		= new User;
$detect 	= new Mobile_Detect;
include_once 'plugin/mobile-detect/device.access.php';
// Device define data
define('DEVICE_TYPE',		$deviceType);
define('DEVICE_MODEL',		$deviceModel);
define('DEVICE_OS', 		$deviceOS);
define('DEVICE_BROWSER',	$deviceBrowser);

$user->sec_session_start();
$user_online = $user->loginChecking();

if($user->type == 'admin'){
	$member = new Member();
	$memberPending = $member->countPending();
}else{
	$memberPending = 0;
}
?>