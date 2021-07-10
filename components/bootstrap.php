<?php
// call d config file
require_once 'Config.php';

// function helpers
require_once 'funcHelper.php';

// sessions info
ini_set('session.auto_start', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_domain', config('session/domain')); //using this in case of subdomain
session_name(config('session/name'));

// start the session from here
session_start();

// class autoload
spl_autoload_register(function($class){
	if (file_exists(__DIR__. '/'. $class. '.php')) {
		require_once $class.'.php';
	} else {
		require_once 'vendor/autoload.php';
	}
});

// load constants
callfile('constants');

// timezone
date_default_timezone_set(config('project/region'));	

// error handler and logging
function dError ($errno, $errstr, $errfile, $errline) {
	
	$s = config('state/development');
	if ($errno) {
		if ($s) {
			$compact = <<<__here
			Error encountered in $errfile on $errline
			<details open>
				<summary>More details</summary>
				<p style="padding-left: 1rem;">$errstr</p>
			</details>
__here;
			$log = "Error encountered in $errfile on line $errline \n $errstr";
			Logger::log($log, 'Error');
		} else {
			$compact = <<<__here
			Something went wrong, contact Server administrator.
__here;
		}
	} else {
		return;
	}
	header('HTTP/1.1 500 Internal Server Error');
	error($compact);
}

// register_shutdown_function('dError');

// check the db config 
$dbErr = (Db::instance())->error();
if ($dbErr) error($dbErr, 500);

// xss
if (Http::frameView()) error('Sorry, access to this webpage has been deined','Access denied', 403); // view the app in iframe
if (Http::sameSite()) error('Sorry, access to this webpage has been denied','Access denied', 403); // prevent form submission from outside of the app

// development state
if (config('state/development')) {
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
} else {
	ini_set('error_reporting', 0);
	ini_set('display_errors', 0);
}

if (!isAjax())
	set_error_handler('dError');

//logging of requests
if (config('log/log_request'))
	Logger::logReq();
		
// database caching 
if (config('cache/dbcache')) {
	ini_set('mysqlnd_qc.enable_qc', true);
	ini_set('mysqlnd_qc.cache_by_default', true);
}

// csrf validation 
if ($_POST) {
	if (!inUri('api/')) {
		if (isset($_POST['__csrf'])) $f = $_POST['__csrf']; else $f = '';
		Validate::validateCsrf($f);
	}
}

// active login and also redirectLogin
(new Auth())->activeLogin();

//if user visit login page after being logged.
redirectLogin();

callfile('Admin');

Cache::showCache();