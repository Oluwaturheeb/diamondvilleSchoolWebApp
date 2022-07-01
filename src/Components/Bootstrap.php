<?php
namespace Devtee\Tlyt\Components;
// function helpers
include 'funcHelper.php';
use \Error;
use \Exception;

class Bootstrap {
/**
 ************************************************************
 * Our application bootstrap                                *
 ************************************************************
 */
  public static function applicationBootstrap ($root) {
    define('ROOT', $root . '/');

    // set the default timezone
    date_default_timezone_set(config('project/region'));

    // load constants
    require_once('constants.php');

    // sessions info
    ini_set('session.auto_start', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.cookie_domain', $_SERVER['SERVER_NAME']); //using this in case of subdomain
    session_name(config('session/name'));

    // development state

    if (config('state/development')) {
    	ini_set('error_reporting', E_ALL);
    	ini_set('display_errors', 1);
    } else {
    	ini_set('error_reporting', 0);
    	ini_set('display_errors', 0);
    }

    // start the session from here
    session_start();

    // error handler and logging
    $error_handler = function  ($errno, $errstr, $errfile, $errline) {
			if (isAjax()) return res($errstr, 500);
      $e = new Exception();
      $trace = $e->getTrace();
      if (ob_get_contents()) ob_end_clean();
    	header('HTTP/2 500 Internal Server Error');
      include_once 'template/error/newError.php';
      $log = "Bug!Bug!!Bug!!! spotted at $errfile on line $errline \n $errstr";
      Logger::log($log, 'Error');
      verbose($trace);
      die();
    };

    // check the db config
    $dbErr = (new Db())->error();
    if ($dbErr) error('DB service not running!', 500);

    // xss
    if (Http::frameView()) error('Sorry, access to this webpage has been deined','Access denied', 403); // view the app in iframe
    if (Http::sameSite()) error('Sorry, access to this webpage has been denied','Access denied', 403); // prevent form submission from outside of the app

    // our error handler
    set_error_handler($error_handler);

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
    (new Authentication())->activeLogin();

    //if user visit login page after being logged.
    redirectLogin();
    PageCache::showCache();
    require_once ROOT .'route/route.php';
    PageCache::createCache();
  }
}
