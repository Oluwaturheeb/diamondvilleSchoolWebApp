<?php

namespace Devtee\Tlyt\Components;

class Route
{
	/** @var string $_requestUri Get the server request_uri */
	protected static $_requestUri = null;

	/** @var string $_request Contain requests data */
	protected static $_request = null;

	/** @var string $_url Contain requests path */
	protected static $_url;

	/** @var bool $_hit stop processing after we hit d right spot */
	protected static $_hit = false;

	/**
	 * Initialize the Route class
	 *
	 * @param string
	 * @return false
	 **/

	public function __construct($uri = null)
	{
		self::$_requestUri = $_SERVER['REQUEST_URI'];
	}

	/**
	 * GET
	 *
	 * Handle Http GET request
	 *
	 * @param string $path Path to the get request
	 * @param mixed $fn Data to return if conditions are met
	 **/

	public static function get(string $path, mixed $fn)
	{
		if (self::type() == 'GET' && !self::$_hit)
			if (self::validateGetUrl($path)) return self::returnFunctionData($fn, $path);
	}

	/**
	 * DELETE
	 *
	 * Handle Http DELETE request
	 *
	 * @param string $path Path to the delete request
	 * @param mixed $fn closure to excute if conditions are met
	 **/

	public static function delete($path, $fn)
	{
		if (self::type() == 'DELETE' && !self::$_hit)
			if (self::validateGetUrl($path)) return self::returnFunctionData($fn, $path);
	}

	public static function put($url, $fn)
	{
		if (self::type() == 'PUT' && !self::$_hit)
			if (self::validateGetUrl($url)) return self::returnFunctionData($fn, $url);
	}

	public static function post($url, $fn)
	{
		if (self::type() == 'POST'  && !self::$_hit)
			if (self::validatePostUrl($url)) return self::returnFunctionData($fn, $url);
	}

	public static function request(bool $toArray = false)
	{
		if (self::$_request) {
			if ($toArray) return Utils::toArr(self::$_request);
			else return Utils::toObj(self::$_request);
		}
		return;
	}

	public static function url()
	{
		return self::$_url;
	}

	public static function fallBack(string $msg = '', $status = 404)
	{
	  if (!self::$_hit) error(($msg) ? $msg : 'Cannot find the resource you are looking for on this server!', Http::responseStatus($status), $status);
	}

	protected static function validateGetUrl(string $url){
		// GET request from server
		$serverRequest = self::$_requestUri = $_SERVER['REQUEST_URI'];
		// server querystring
		$queryString = (isset($_SERVER['QUERY_STRING'])) ? ($_SERVER['QUERY_STRING'] != '') ? $_SERVER['QUERY_STRING'] : false : false;
		// passed value
		if (strlen($url) == 1) return $serverRequest === $url;
		else {
			// get query string in handy for check
			// @return object
			$urlFn = (function () use ($url) {
				// remove all optional query param first
				$optParam = explode('/_?', $url);
				$reqParam = explode('/__', $optParam[0]);
				$pathCount = count(explode('/', $optParam[0]));
				$path = ($reqParam[0]) ? $reqParam[0] : '/';
				array_shift($optParam);
				array_shift($reqParam);
				return (object) [
					'path' => $path,
					'pCount' => $pathCount,
					'required' => count($reqParam),
					'optional' => (empty($optParam)) ? 0 : count($reqParam) + count($optParam)
				];
			})();
			// match the url
			if ($serverRequest === $urlFn->path) $lengthCheck = 1;
			else {
			  if ($queryString) {
			    $serverArray = explode('/', explode('?', $serverRequest)[0]);
			    $req = join('/', array_splice($serverArray, 0, $urlFn->pCount));
			  } else {
			    $serverArray = explode('/', $serverRequest);
			    $req = join('/', array_splice($serverArray, 0, $urlFn->pCount - 1));
			  }

			  if ($req === $urlFn->path) {
			    $left = count(explode('/', mb_strcut($serverRequest, strlen($urlFn->path)))) -1;
          if ($urlFn->required  === $left) $lengthCheck = 1;
          elseif ($urlFn->optional >= $left) $lengthCheck = 1;
			  } else $lengthCheck = false;
			}

			if ($lengthCheck) {
  				// set the url now that we are in safe zone
  				self::$_url = $urlFn->path;
  				$paramFromUrl = explode('/_', mb_strstr($url, '/_'));

  				// making key => value pair for survivers if there is parameter passed!
  				if (count($paramFromUrl) > 1 && $_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
  					$paramArray = [];
  					foreach ($paramFromUrl as $key => $value)
  						if ($key > 0) $paramArray[] = substr($value, 1);

  					$paramFromRequest = explode('/', mb_strcut($serverRequest, strlen($urlFn->path) + 1));
  					$paramFromRequest = array_map('urldecode', $paramFromRequest);
  					$rCount = count($paramFromRequest);
  					$pCount = count($paramArray);
  					if ($rCount == $pCount) self::$_request = array_combine($paramArray, $paramFromRequest);
  					else self::$_request = array_combine($paramArray, array_pad($paramFromRequest, $pCount, ''));
  					// append possible querystring
  					if ($queryString) self::$_request = array_merge(self::$_request, $_GET);
  				}
  				return true;
  			}
		}
	}

	protected static function validatePostUrl(string $url)
	{
		// GET request from server
		self::$_requestUri = $serverRequest = $_SERVER['REQUEST_URI'];
		// passed value
		if (strlen($url) == 1) return $serverRequest === $url;
		else {
			if ($url === $serverRequest) {
				$path = $url;
				// check array length with url
				if (count(explode('/', $serverRequest)) !== count(explode('/', $url))) return false;
				// append possible querystring
				if (isset($_SERVER['QUERY_STRING'])) self::$_request = array_merge($_POST, $_GET);
				return true;
			}
		}
	}

	protected static function returnFunctionData(mixed $fn, $path)
	{
		self::$_hit = true;
		if (is_string($fn) || is_numeric($fn)) $funcData = $fn;
		elseif (is_object($fn) && !is_countable($fn)) $funcData = $fn->call(new Route($path));
		elseif (is_countable($fn)) {
			if (is_array($fn))
				if (array_key_exists(0, $fn))
					if (class_exists($fn[0]) && is_string($fn[0])) return self::execClassArray($fn); // ensure its a class
					else $funcData = $fn;
				else $funcData = $fn;
		}

		// lets go
		if ($funcData) {
			// parse and return $funcData
			if (is_string($funcData) || is_numeric($funcData)) echo $funcData;
			else {
				Http::jsonResponse($funcData);
			}
		}
		return;
	}

	protected static function type()
	{
		return Http::sVar('REQUEST_METHOD');
	}

	protected static function execClassArray(array $fn)
	{
		$funcData = call_user_func([new $fn[0](), $fn[1]]);
		if ($funcData) {
			// parse and return $funcData
			if (is_string($funcData) || is_numeric($funcData)) echo $funcData;
			else {
				Http::jsonResponse($funcData);
			}
		}
	}
}
