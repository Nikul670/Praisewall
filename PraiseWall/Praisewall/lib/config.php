<?php

global $_ENV;

define('UTIL_PATH', $_ENV['PW_WWW']. DIRECTORY_SEPARATOR . "pwall" . DIRECTORY_SEPARATOR . "helper");

require_once(UTIL_PATH.'/INIParser.php');

?>
