<?
/**
 * Start for all praise wall related activities. This file does the following:
 * - Find the URL using urlParser
 * - Call the relevant action in the relevant module
 * - Display the result in the required format
 */

ini_set("zend.enable_gc", 0);
ob_start();
// This is the default value set in php.ini
$old_error_level = error_reporting(E_ALL ^ E_NOTICE );
//error_reporting(E_ALL);
session_start();

# Find the prefix of the path
$prefix = substr($_SERVER['PHP_SELF'], 0, stripos($_SERVER['PHP_SELF'], 'index.php', 1) - 1);

require_once('common.php');

$logger = new PwallLogger();
$logger->enabled = true;

$flash_message = "";
$request_type = 'WEB';

$url = isset( $_GET['url'] ) ? $_GET['url'] : "";
$urlParser = new UrlParser( );
$auth = Auth::getInstance();

$nameSpace = $urlParser->getNameSpace();
$action = $page =  $urlParser->getPage();
$module = $urlParser->getModule();
$params = $urlParser->getParams();

/**
 * Add loggable user entity in auth...
 * The Access permision check will be done in the 
 * Security Manager Only!!! 
 */
if ( $auth->isLoggedIn() ) {
	
	$currentuser = $user = $auth->user_data;
	// @TODO: Redirect to home page
} else {
	// @TODO: Redirect to login page
}

if( $auth->canProceed( ) ){

	// @TODO: Add routing logic file here
	$path = "";
	include_once $path;
}

$returnType = $urlParser->getReturnType();
if($returnType == 'json'){
	$logger->info("Displaying JSON: $w/$layout");
	Header("Content-type: application/x-javascript");
	foreach($data as $key=>$value)
		$data[$key] = is_null($data[$key])?array():$data[$key];
	echo json_encode($data);
}else{
    @header("Content-type: text/html; charset=utf-8");       
}
$logger->info("DONE");

ob_flush();
?>
