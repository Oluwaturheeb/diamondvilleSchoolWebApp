<?php
class API {
	private static $_auth = false, $_req, $_cursor, $_data;
	
	public function __construct($uri = null) {
		self::$_req = $uri;
		return;
	}
	
	public static function get ($url, $fn) {
		if (self::type() == 'GET') {
			$check = explode('/__', $url);
			$uri = $check[0];
			if (self::matchUrl($uri)) {
				$fn->call(new API($url));
			}
		}
	}
	
	public static function delete ($url, $fn) {
		$check = explode('/__', $url);
		$uri = $check[0];
		if (self::type() == 'DELETE') {
			if (self::matchUrl($uri)) {
				$fn->call(new API($url));
			}
		}
	}
	
	public static function put ($url, $fn) {
		if (self::type() == 'PUT') {
			if (self::matchUrl($url)) {
				$fn->call(new API());
			}
		}
	}
	
	public static function post ($url, $fn) {
		if (self::type() == 'POST') {
			if (self::matchUrl($url)) {
				$fn->call(new API());
			}
		}
	}
	
	private static function matchUrl ($url) {
		if (inUri($url))
			return true;
		
		return false;
	}
	
	private static function type () {
		return Http::sVar('REQUEST_METHOD');
	}
	
	public static function data ($r = '') {
		switch (self::type()) {
			case 'PUT':
				$in = file_get_contents('php://input');
				parse_str($in, $uri);
				return $uri;
			break;
			case 'POST':
				return req($r);
			break;
			case 'GET':
				return self::request(self::$_req,$r);
			break;
			case 'DELETE':
				return self::request(self::$_req, $r);
			break;
		}
	}
	
	private static function request ($uri, $r) {
		//explodeing the given data
		$u = explode('/__', $uri);
		$data = array_shift($u);
		
		// working on the original url
		$str = strstr(Http::sVar('REQUEST_URI'), $data);
		$uri = explode('/', $str);
		array_shift($uri);
		
		if (count($u) !== count($uri)) {
			error('Parameter does not match the url parameter');
		} else {
			$request = array_combine($u, $uri);
			if ($r) {
				if (isset($request[$r])) 
					return $request[$r];
				else
					return false;
			} else {
				return $request;
			}
		}
		return;
	}
	
	/* private static function auth ($key) {
		$this->table('api_auth')->get(['id'])->where($this->_auth)->res(1);
		
		if ($this->count())
			return $this->_auth = true;
	} */
}